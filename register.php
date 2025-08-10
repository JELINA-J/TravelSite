<?php

// Get data from POST
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Simple validation
if (empty($email) || empty($password)) {
    die('Email and password are required.');
}

// Connect to DB
$host = "localhost";
$dbname = "travelsite";
$username = "root";
$dbpassword = ""; // change if you set a password
$conn = mysqli_connect($host, $username, $dbpassword, $dbname, 3308);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if email already exists
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("SQL error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    die("Email already registered. Please login instead.");
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("SQL error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
if (mysqli_stmt_execute($stmt)) {
    echo "Registration successful! You can now login.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);


?>


