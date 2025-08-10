<?php
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$host = "localhost";
$dbname = "onthego";
$username = "root";
$password = "";  // keep it blank as you have no password
$conn = mysqli_connect($host, $username, $password, $dbname,3308);

if (mysqli_connect_errno()){
    die("Connection error: ". mysqli_connect_error());
}

$sql = "INSERT INTO contact (name, email, number, subject, message) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssiss", $name, $email, $number, $subject, $message);

mysqli_stmt_execute($stmt);

echo "Message sent!";
?>
