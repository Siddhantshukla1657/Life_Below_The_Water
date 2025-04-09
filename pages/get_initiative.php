<?php
// get_initiative.php

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "user_db";

// Connect to database
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed."]));
}

// Get the initiative ID from the URL
if (isset($_GET['id'])) {
    $initiative_id = intval($_GET['id']);
    $sql = "SELECT * FROM initiatives WHERE id = $initiative_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Initiative not found."]);
    }
} else {
    echo json_encode(["error" => "No ID provided."]);
}

$conn->close();
?>
