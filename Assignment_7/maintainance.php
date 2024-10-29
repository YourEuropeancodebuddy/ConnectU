<?php
// Database connection details
$servername = "localhost";
$username = "isulaiman";
$password = "ZCblyA";
$dbname = "isulaiman_db";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
function is_logged_in() {
    global $conn;
    if (isset($_SESSION['username'])) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password'] == $_SESSION['password']) {
                return true;
            }
        }
    }
    return false;
}

// Login function
function login($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['password'] == $password) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            return true;
        }
    }
    return false;
}

// Logout function
function logout() {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
}

// Maintenance page example
session_start();
if (is_logged_in()) {
    // User is logged in, allow access to maintenance functionality
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle maintenance actions (INSERT, UPDATE, DELETE)
        // ...
    }
    // Display maintenance page
    include 'maintenance_page.php';
} else {
    // User is not logged in, show login form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (login($username, $password)) {
            // Redirect to maintenance page
            header('Location: maintenance.php');
            exit;
        } else {
            $error_message = 'Invalid username or password.';
        }
    }
    include 'login_page.php';
}
?>