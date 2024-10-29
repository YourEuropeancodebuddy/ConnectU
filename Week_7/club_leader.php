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
    $leader_name = $_POST['leader_name'];
    $leader_surname = $_POST['leader_surname'];
    $leader_email_address = $_POST['leader_email_address'];
    $leader_role = $_POST['leader_role'];
    $is_organiser = isset($_POST['is_organiser']) ? 1 : 0;
    
    $club_leader_id = mt_rand(100000, 999999);  // Generates a random 6-digit number
  
    
    $stmt = $conn->prepare("INSERT INTO Club_leader (club_leader_id, is_organiser, leader_role, leader_name, leader_surname, leader_email_address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $club_leader_id, $is_organiser, $leader_role, $leader_name, $leader_surname, $leader_email_address);

    if ($stmt->execute()) {
        header("Location: feedback.php?status=success");
    } else {
        header("Location: feedback.php?status=error");
    }
       

    $stmt->close();
    $conn->close();
}
?>
