<?php
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$host = "localhost";
$dbname = "travelsite";
$username = "root";
$dbpassword = "";

$conn = mysqli_connect($host, $username, $dbpassword, $dbname, 3308);
if (!$conn) {
    echo "Connection failed!";
    exit;
}

$sql = "SELECT password FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $hashedPassword);
mysqli_stmt_fetch($stmt);

if ($hashedPassword && password_verify($password, $hashedPassword)) {
    echo "Login successful!";
} else {
    echo "Invalid email or password.";
}
?>
