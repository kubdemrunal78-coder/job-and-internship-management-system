<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "job_internship_db";

$conn = new mysqli($host, $user, $pass, $db, 3307);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
