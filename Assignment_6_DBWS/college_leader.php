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
    $leader_type = $_POST['leader_type'];
    $is_on_duty = isset($_POST['is_on_duty']) ? 1 : 0;
    
    $college_leader_id = mt_rand(100000, 999999);  // Generates a random 6-digit number
  
    
    $stmt = $conn->prepare("INSERT INTO College_leader (college_leader_id, is_on_duty, leader_type, leader_name, leader_surname, leader_email_address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $college_leader_id, $is_on_duty, $leader_type, $leader_name, $leader_surname, $leader_email_address);

    if ($stmt->execute()) {
        header("Location: feedback.php?status=success");
    } else {
        header("Location: feedback.php?status=error");
    }
       

    $stmt->close();
    $conn->close();
}
?>
