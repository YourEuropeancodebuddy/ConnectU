<?php
// feedback.php
session_start();

$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = '';

switch($status) {
    case 'success':
        $message = "Activity was successfully created!";
        break;
    case 'error':
        $message = "Error creating activity. Please try again.";
        break;
    case 'auth_error':
        $message = "Authentication failed. Please check your username and password.";
        break;
    default:
        $message = "Unknown status.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Status</title>
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
        <h1>Status</h1>
    </div>

    <div class="slogan-words">
        <p><?php echo htmlspecialchars($message); ?></p>
        <p><a href="activity.html">Back to Add Activity</a></p>
    </div>
</body>
</html>