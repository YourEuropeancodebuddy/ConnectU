<?php
$host = 'localhost'; 
$db = 'isulaiman_db'; 
$user = 'isulaiman'; 
$password = 'ZCblyA';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $college_leader_id = $_POST['college_leader_id'];
    $activity_id = $_POST['activity_id'];

    $stmt = $conn->prepare("INSERT INTO Manages (college_leader_id, activity_id) VALUES (?, ?)");
    $stmt->bind_param("is", $college_leader_id, $activity_id);  

    if ($stmt->execute()) {
        header("Location: feedback.php?status=success");
    } else {
        header("Location: feedback.php?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>
