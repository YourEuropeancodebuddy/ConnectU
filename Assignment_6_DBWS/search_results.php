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

// Initialize the WHERE clause
$where_clauses = array();
$params = array();
$types = "";

// Check each search parameter and build the query
if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $where_clauses[] = "activity_date BETWEEN ? AND ?";
    $params[] = $_GET['start_date'];
    $params[] = $_GET['end_date'];
    $types .= "ss";
}

if (!empty($_GET['location'])) {
    $where_clauses[] = "activity_location LIKE ?";
    $params[] = "%" . $_GET['location'] . "%";
    $types .= "s";
}

if (!empty($_GET['activity_name'])) {
    $where_clauses[] = "activity_name LIKE ?";
    $params[] = "%" . $_GET['activity_name'] . "%";
    $types .= "s";
}

if (isset($_GET['open_to_everyone'])) {
    $where_clauses[] = "open_to_everyone = ?";
    $params[] = 1;
    $types .= "i";
}

// Construct the final query
$sql = "SELECT * FROM Activity";
if (!empty($where_clauses)) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="navbar">
        <div class="icon">
            <h2 class="logo"><img src="ConnectU_Logo.png" alt="Logo"></h2>
        </div>

        <div class="menu-search">
            <div class="menu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="maintenance.html">Maintenance</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="slogan">
        <h1>Search Results</h1>
    </div>

    <div class="slogan-words">
        <?php if ($result->num_rows > 0): ?>
            <div class="results-list">
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="result-item">
                        <h3><?php echo htmlspecialchars($row['activity_name']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($row['activity_location']); ?></p>
                        <p>Date: <?php echo htmlspecialchars($row['activity_date']); ?></p>
                        <a href="activity_detail.php?id=<?php echo urlencode($row['activity_id']); ?>">View Details</a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No activities found matching your search criteria.</p>
        <?php endif; ?>
        
        <p><a href="search_form.html">Back to Search</a></p>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>