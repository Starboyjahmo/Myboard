<?php
session_start();
include('includes/db.php');

// Handle form submission
if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = 'user'; // always user

    $query = "INSERT INTO register (username, email, password, user_type) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt,"ssss",$username,$email,$password,$user_type);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Registration successful!";
    } else {
        $_SESSION['status'] = "Registration failed.";
    }
}

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <h2>User Registration</h2>

    <?php
    if (!empty($_SESSION['success'])) {
        echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
        unset($_SESSION['success']);
    }
    if (!empty($_SESSION['status'])) {
        echo '<div class="alert alert-danger">'.$_SESSION['status'].'</div>';
        unset($_SESSION['status']);
    }
    ?>

    <form method="POST">
        <div class="form-group mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>

        <button type="submit" name="registerbtn" class="btn btn-primary">Register</button>
    </form>
</div>

<?php
include('includes/script.php');
include('includes/footer.php');
?>
