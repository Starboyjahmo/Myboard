<?php 
session_start();

// database connection using mysqli
$connection = mysqli_connect("localhost", "root", "", "adminpanel");

if (!$connection) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST['registerbtn'])) {

    $username   = $_POST['username'];        
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $cpassword  = $_POST['confirm_password'];

    // Check password match
    if ($password === $cpassword) {

        $query = "INSERT INTO register (username, email, password) 
                  VALUES ('$username', '$email', '$password')";

        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "Admin profile added successfully";
            header('Location: register.php');
            exit();
        } else {
            $_SESSION['status'] = "Admin not saved: " . mysqli_error($connection);
            header('Location: register.php');
            exit();
        }

    } else {
        $_SESSION['status'] = "Password and Confirm Password do not match";
        header('Location: register.php');
        exit();
    }

} else {
    $_SESSION['status'] = "Invalid request";
    header('Location: register.php');
    exit();
}
?>
