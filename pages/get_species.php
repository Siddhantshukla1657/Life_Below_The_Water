<?php
// get_species.php

// Database connection details
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM marine_animals WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["error" => $conn->error]);
        exit();
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo json_encode(["error" => $stmt->error]);
        exit();
    }
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data ? $data : ["error" => "No species found with that ID"]);
}
$conn->close();
?>
