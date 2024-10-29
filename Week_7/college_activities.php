<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $activity_name = $_POST['activity_name'];
    $activity_description = $_POST['activity_description'];
    $activity_location = $_POST['activity_location'];
    $open_to_everyone = isset($_POST['open_to_everyone']) ? 1 : 0;
    $activity_date = $_POST['activity_date'];
    $starting_time = $_POST['starting_time'];
    $closing_time = $_POST['closing_time'];
    $college_name = $_POST['college_name'];

    $activity_id = uniqid('act_');  // This ID will be used to link both tables
    
    $stmt = $conn->prepare("INSERT INTO Activity (activity_id, activity_name, activity_description, activity_location, open_to_everyone, activity_date, starting_time, closing_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss", $activity_id, $activity_name, $activity_description, $activity_location, $open_to_everyone, $activity_date, $starting_time, $closing_time);

    if ($stmt->execute()) {
        $stmt2 = $conn->prepare("INSERT INTO College_activities (activity_id, college_name) VALUES (?, ?)");
        $stmt2->bind_param("ss", $activity_id, $college_name);  // Insert the same activity_id into College_activities

        if ($stmt2->execute()) {
            // Success - redirect to feedback page with success status
            header("Location: feedback.php?status=success");
        } else {
            header("Location: feedback.php?status=error");
        }
        $stmt2->close();
    } else {
        header("Location: feedback.php?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>
