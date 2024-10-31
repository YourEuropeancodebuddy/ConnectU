<?php
$host = '5.75.182.107'; 
$db = 'ngerard_db'; 
$user = 'ngerard'; 
$password = 'lIYHAl';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $club_leader_id = $_POST['club_leader_id'];
    $activity_id = $_POST['activity_id'];

    $stmt = $conn->prepare("INSERT INTO Leads (club_leader_id, activity_id) VALUES (?, ?)");
    $stmt->bind_param("is", $club_leader_id, $activity_id);  

    if ($stmt->execute()) {
        header("Location: feedback.php?status=success");
    } else {
        header("Location: feedback.php?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>
