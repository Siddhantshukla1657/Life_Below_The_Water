<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Welcome, <?php echo $_SESSION['loginid']; ?>!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>