<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);
    
    // Create users table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        loginid VARCHAR(30) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        die("Error creating table: " . $conn->error);
    }
} else {
    die("Error creating database: " . $conn->error);
}

// Handle Registration
if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $loginid = $conn->real_escape_string($_POST['loginid']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user already exists
    $check = $conn->query("SELECT loginid FROM users WHERE loginid='$loginid'");
    if ($check->num_rows > 0) {
        die("Login ID already exists!");
    }

    $sql = "INSERT INTO users (username, email, loginid, password) 
            VALUES ('$username', '$email', '$loginid', '$password')";

    if ($conn->query($sql)) {
        echo "Registration successful! <a href='Login_page.html'>Login now</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $loginid = $conn->real_escape_string($_POST['loginid']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE loginid='$loginid'");
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['loginid'] = $user['loginid'];
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>