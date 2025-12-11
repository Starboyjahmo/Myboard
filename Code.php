<?php
session_start();

// Database connection using InfinityFree credentials
$connection = mysqli_connect(
    "sql211.infinityfree.com",   // Hostname
    "if0_40659737",              // Username
    "0723375447Kin",             // Password
    "if0_40659737_admin_panel"   // Database name
);

// Check connection
if (!$connection) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST['registerbtn'])) {

    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];
    $cpassword = $_POST['confirm_password'];

    // Check password match
    if ($password === $cpassword) {

        // Hash password before saving
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO register (username, email, password) 
                  VALUES ('$username', '$email', '$hashed_password')";

        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "Admin profile added successfully";
            header('Location: Register.php');
            exit();
        } else {
            $_SESSION['status'] = "Admin not saved: " . mysqli_error($connection);
            header('Location: Register.php');
            exit();
        }

    } else {
        $_SESSION['status'] = "Passwords do not match";
        header('Location: Register.php');
        exit();
    }

} else {
    $_SESSION['status'] = "Invalid request";
    header('Location: Register.php');
    exit();
}
?>
