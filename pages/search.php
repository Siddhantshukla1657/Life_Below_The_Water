<?php
session_start();

// Check if query is provided
if (!isset($_GET['query']) || trim($_GET['query']) === '') {
    header("Location: ../index.php");
    exit();
}

$searchQuery = trim($_GET['query']);

// Database connection parameters
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db"; // Adjust if needed

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare query for an exact name match
$stmt = $conn->prepare("SELECT id FROM marine_animals WHERE name = ?");
$stmt->bind_param("s", $searchQuery);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // If found, redirect to animal_data.php (located in root)
    $row = $result->fetch_assoc();
    $speciesId = $row['id'];
    header("Location:../pages/animal_data.php?id=" . $speciesId);
    exit();
} else {
    // Not found; redirect to 404 page in pages folder
    header("Location:../pages/404.php");
    exit();
}

$stmt->close();
$conn->close();
?>
