<?php
session_start();
include('includes/db.php');   // REQUIRED

// -------------------------------------------------
// HANDLE LOGIN
// -------------------------------------------------
if (isset($_POST['login_btn'])) {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT id, username, password, user_type 
              FROM register 
              WHERE email = ? 
              LIMIT 1";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            // ROLE REDIRECT
            if ($user['user_type'] === 'admin') {
                header("Location: index.php");
            } else {
                header("Location: index2.php");
            }
            exit();

        } else {
            $_SESSION['status'] = "Invalid password";
        }

    } else {
        $_SESSION['status'] = "No account found with that email";
    }

    header("Location: login.php");
    exit();
}
?>

<!-- ================= HTML OUTPUT ================= -->

<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<div class="container mt-5">
    <h2 class="mb-4">Login</h2>

    <?php
    if (isset($_SESSION['status'])) {
        echo "<div class='alert alert-danger'>{$_SESSION['status']}</div>";
        unset($_SESSION['status']);
    }
    ?>

    <form action="login.php" method="POST">
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="login_btn" class="btn btn-primary w-100">
            Login
        </button>
    </form>

    <p class="mt-3 text-center">
        Don’t have an account? <a href="register.php">Register</a>
    </p>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
