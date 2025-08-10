<?php
$placename = $_POST['placename'];
$numberofguests = $_POST['numberofguests'];
$arrivaldate = $_POST['arrivaldate'];  // should be string like "2025-06-12"
$leavingdate = $_POST['leavingdate'];

$host = "localhost";
$dbname = "travelsite";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname,3308);
if (mysqli_connect_errno()){
    die("Connection error: ". mysqli_connect_error());
}

$sql = "INSERT INTO bookingdetails (placename, numberofguests, arrivaldate, leavingdate)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

// placename = string, numberofguests = int, arrivaldate = string, leavingdate = string
mysqli_stmt_bind_param($stmt, "siss", $placename, $numberofguests, $arrivaldate, $leavingdate);

mysqli_stmt_execute($stmt);

echo "Booking successful!";
?>
