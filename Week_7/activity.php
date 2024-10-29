<?php
session_start(); // Start the session at the beginning

$host = 'localhost'; 
$db = 'isulaiman_db'; 
$user = 'isulaiman'; 
$password = 'ZCblyA';

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if user is authenticated
function is_authenticated($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Check if this is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get authentication credentials
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $pwd = isset($_POST['password']) ? $_POST['password'] : '';

    // First, check if the user is authenticated
    if (!is_authenticated($conn, $username, $pwd)) {
        // Authentication failed
        header("Location: feedback.php?status=auth_error");
        exit();
    }

    // If we get here, the user is authenticated, proceed with activity creation
    $activity_name = $_POST['activity_name'];
    $activity_description = $_POST['activity_description'];
    $activity_location = $_POST['activity_location'];
    $open_to_everyone = isset($_POST['open_to_everyone']) ? 1 : 0;
    $activity_date = $_POST['activity_date'];
    $starting_time = $_POST['starting_time'];
    $closing_time = $_POST['closing_time'];

    $activity_id = uniqid('act_');

    // Prepare the activity insertion statement
    $stmt = $conn->prepare("INSERT INTO Activity (activity_id, activity_name, activity_description, activity_location, open_to_everyone, activity_date, starting_time, closing_time, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Note: added created_by field to track who created the activity
    $stmt->bind_param("ssssisss", 
        $activity_id, 
        $activity_name, 
        $activity_description, 
        $activity_location, 
        $open_to_everyone, 
        $activity_date, 
        $starting_time, 
        $closing_time,
        $username
    );

    if ($stmt->execute()) {
        // Success - redirect to feedback page with success status
        header("Location: feedback.php?status=success");
    } else {
        // Error inserting activity
        header("Location: feedback.php?status=error");
    }

    $stmt->close();
    $conn->close();
} else {
    // Not a POST request, redirect to the form page
    header("Location: add_activity.html");
    exit();
}
?>