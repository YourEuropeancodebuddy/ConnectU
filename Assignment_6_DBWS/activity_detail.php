<?php

$host = '5.75.182.107'; 
$db = 'ngerard_db'; 
$user = 'ngerard'; 
$password = 'lIYHAl';

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get activity ID from URL
$activity_id = isset($_GET['id']) ? $_GET['id'] : '';

// Prepare and execute query
$stmt = $conn->prepare("SELECT * FROM Activity WHERE activity_id = ?");
$stmt->bind_param("s", $activity_id);
$stmt->execute();
$result = $stmt->get_result();
$activity = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Details</title>
    <link rel="stylesheet" href="ConnectU.css">
</head>
<body>
    <div class="navbar">
        <div class="icon">
            <h2 class="logo"><img src="ConnectU_Logo.png" alt="Logo"></h2>
        </div>

        <div class="menu-search">
            <div class="menu">
                <ul>
                    <li><a href="ConnectU.html">Home</a></li>
                    <li><a href="maintenance.html">Maintenance</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="slogan">
        <h1>Activity Details</h1>
    </div>

    <div class="slogan-words">
        <?php if ($activity): ?>
            <div class="activity-detail">
                <h2><?php echo htmlspecialchars($activity['activity_name']); ?></h2>
                
                <div class="detail-section">
                    <h3>Description</h3>
                    <p><?php echo htmlspecialchars($activity['activity_description']); ?></p>
                </div>

                <div class="detail-section">
                    <h3>Location</h3>
                    <p><?php echo htmlspecialchars($activity['activity_location']); ?></p>
                </div>

                <div class="detail-section">
                    <h3>Date and Time</h3>
                    <p>Date: <?php echo htmlspecialchars($activity['activity_date']); ?></p>
                    <p>Start Time: <?php echo htmlspecialchars($activity['starting_time']); ?></p>
                    <p>End Time: <?php echo htmlspecialchars($activity['closing_time']); ?></p>
                </div>

                <div class="detail-section">
                    <h3>Accessibility</h3>
                    <p><?php echo $activity['open_to_everyone'] ? 'Open to Everyone' : 'Restricted Access'; ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>Activity not found.</p>
        <?php endif; ?>

        <p><a href="javascript:history.back()">Back to Results</a></p>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>