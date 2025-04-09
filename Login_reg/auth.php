<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password);

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
    ) ENGINE=InnoDB";

    if (!$conn->query($sql)) {
        die("Error creating table: " . $conn->error);
    }
} else {
    die("Error creating database: " . $conn->error);
}

// Hardcoded admin credentials
$admin_ids = array('admin1', 'admin2', 'admin3');
$admin_passwords = array(
    'admin1' => 'admin1pass',
    'admin2' => 'admin2pass',
    'admin3' => 'admin3pass'
);

// Process registration if form submitted
if (isset($_POST['register'])) {
    // Registration process
    $username_input = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $loginid = $conn->real_escape_string($_POST['loginid']);
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user already exists
    $check = $conn->query("SELECT loginid FROM users WHERE loginid='$loginid'");
    if ($check->num_rows > 0) {
        echo "<script>
                alert('Login ID already exists!');
                window.location.href = 'register_page.php';
              </script>";
        exit();
    }

    $sql = "INSERT INTO users (username, email, loginid, password) 
            VALUES ('$username_input', '$email', '$loginid', '$passwordHash')";

    if ($conn->query($sql)) {
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'Login_page.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Registration failed: " . $conn->error . "');
                window.location.href = 'register_page.php';
              </script>";
        exit();
    }
} elseif (isset($_POST['login'])) {
    // Login process
    $loginid = $conn->real_escape_string($_POST['loginid']);
    $password = $_POST['password'];

    // Check if loginid is one of the hardcoded admin IDs
    if (in_array($loginid, $admin_ids)) {
        if (isset($admin_passwords[$loginid]) && $password === $admin_passwords[$loginid]) {
            // Successful admin login
            $_SESSION['user_id'] = 0; // Admins may not have a DB user ID
            $_SESSION['loginid'] = $loginid;
            $_SESSION['username'] = $loginid; // Username is the admin ID
            header("Location: ../pages/admin.php");  // Redirect to admin dashboard
            exit();
        } else {
            echo "<script>
                    alert('Invalid admin credentials!');
                    window.location.href = 'Login_page.php';
                  </script>";
            exit();
        }
    } else {
        // Normal user login process
        $result = $conn->query("SELECT * FROM users WHERE loginid='$loginid'");
    
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['loginid'] = $user['loginid'];
                $_SESSION['username'] = $user['username'];
                header("Location: ../index.php");  // Redirect to main index
                exit();
            } else {
                echo "<script>
                        alert('Invalid password!');
                        window.location.href = 'Login_page.php';
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('User not found!');
                    window.location.href = 'Login_page.php';
                  </script>";
            exit();
        }
    }
}

$conn->close();
?>
