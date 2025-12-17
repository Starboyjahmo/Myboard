<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
$hostname = "sql211.infinityfree.com";
$username = "if0_40659737";          // your MySQL username
$password = "0723375447Kin";         // your MySQL password
$database = "if0_40659737_admin_panel"; // your MySQL database name

// Create connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
