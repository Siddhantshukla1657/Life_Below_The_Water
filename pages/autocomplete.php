<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$term = isset($_GET['term']) ? $conn->real_escape_string($_GET['term']) : '';

if ($term !== '') {
    $stmt = $conn->prepare("SELECT name FROM marine_animals WHERE name LIKE CONCAT('%', ?, '%') LIMIT 10");
    $stmt->bind_param("s", $term);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['name'];
    }

    echo json_encode($suggestions);
}
$conn->close();
?>
