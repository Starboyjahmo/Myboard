<?php
session_start();
include('includes/db.php');

// ----------------------
// Add User/Admin
// ----------------------
if(isset($_POST['registerbtn'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];
    $role = $_POST['role'] ?? 'user';

    if($password !== $cpassword){
        $_SESSION['status'] = "Passwords do not match";
        header("Location: register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($connection,"INSERT INTO register (username,email,password,user_type) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"ssss",$username,$email,$hashed_password,$role);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = ucfirst($role)." added successfully!";
    header("Location: register.php");
    exit();
}

// ----------------------
// Delete User/Admin
// ----------------------
if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_id'];
    $role = $_POST['role'] ?? 'user';

    $stmt = mysqli_prepare($connection,"DELETE FROM register WHERE id=?");
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = ucfirst($role)." deleted successfully!";
    header("Location: register.php");
    exit();
}

// ----------------------
// Open Edit Modal
// ----------------------
if(isset($_POST['edit_btn_modal'])){
    $id = $_POST['edit_id'];
    $stmt = mysqli_prepare($connection,"SELECT * FROM register WHERE id=?");
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $_SESSION['edit_user'] = mysqli_fetch_assoc($result);

    header("Location: register.php");
    exit();
}

// ----------------------
// Update User/Admin
// ----------------------
if(isset($_POST['edit_btn'])){
    $id = $_POST['edit_id'];
    $role = $_POST['role'] ?? 'user';
    $username = trim($_POST['edit_username']);
    $email = trim($_POST['edit_email']);
    $password = $_POST['edit_password'] ?? '';
    $cpassword = $_POST['edit_confirm_password'] ?? '';

    if(!empty($password)){
        if($password !== $cpassword){
            $_SESSION['status'] = "Passwords do not match";
            header("Location: register.php");
            exit();
        }
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($connection,"UPDATE register SET username=?,email=?,password=?,user_type=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,"ssssi",$username,$email,$hashed_password,$role,$id);
    } else {
        $stmt = mysqli_prepare($connection,"UPDATE register SET username=?,email=?,user_type=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,"sssi",$username,$email,$role,$id);
    }
    mysqli_stmt_execute($stmt);
    $_SESSION['success'] = ucfirst($role)." updated successfully!";
    header("Location: register.php");
    exit();
}

$_SESSION['status'] = "Invalid request";
header("Location: register.php");
exit();
?>
