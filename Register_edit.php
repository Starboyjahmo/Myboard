<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
include('includes/db.php');

// Ensure the form is submitted
if (!isset($_POST['edit_btn'])) {
    $_SESSION['status'] = "Invalid Request";
    header("Location: Register.php");
    exit();
}

$id = $_POST['edit_id'];
$table = $_POST['table_type'] ?? 'register'; // default to normal users

// Validate table
if (!in_array($table, ['register', 'register_user'])) {
    $_SESSION['status'] = "Invalid table";
    header("Location: Register.php");
    exit();
}

// Fetch user record securely
$query = "SELECT * FROM $table WHERE id = ? LIMIT 1";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // Record found, ready to display in form
} else {
    $_SESSION['status'] = "Record Not Found";
    header("Location: Register.php");
    exit();
}
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
        </div>

        <div class="card-body">
            <form action="Code.php" method="POST">
                <input type="hidden" name="edit_id" value="<?= htmlspecialchars($row['id']); ?>">
                <input type="hidden" name="table_type" value="<?= htmlspecialchars($table); ?>">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="edit_username" value="<?= htmlspecialchars($row['username']); ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit_email" value="<?= htmlspecialchars($row['email']); ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>New Password (leave blank to keep current)</label>
                    <input type="password" name="edit_password" class="form-control">
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="edit_confirm_password" class="form-control">
                </div>

                <button type="submit" name="update_btn" class="btn btn-primary">Update</button>
                <a href="Register.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php
include('includes/script.php');
include('includes/footer.php');
?>
