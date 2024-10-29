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
    $intellectual_club_name = $_POST['intellectual_club_name'];

    $id = uniqid('I_'); 

    
    $stmt = $conn->prepare("INSERT INTO Intellectual_club_activities (intellectual_club_name) VALUES (?, ?)");
    $stmt->bind_param("s,s", $id, $intellectual_club_name);

    if ($stmt->execute()) {
        header("Location: feedback.php?status=success");
    } else {
        header("Location: feedback.php?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>