<?php
session_start();
include('includes/db.php');

// Check if edit modal should be opened
$edit_user = $_SESSION['edit_user'] ?? null;
unset($_SESSION['edit_user']);

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="shadow mb-4">
        <div class="header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Register Users/Admins</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">
                Add User/Admin
            </button>
        </div>

        <div class="card mt-3">
            <!-- Session messages -->
            <?php
            if(!empty($_SESSION['success'])){
                echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }
            if(!empty($_SESSION['status'])){
                echo '<div class="alert alert-danger">'.$_SESSION['status'].'</div>';
                unset($_SESSION['status']);
            }
            ?>

            <!-- Table -->
            <div class="table-responsive p-3">
                <?php
                $query = "SELECT * FROM register";
                $result = mysqli_query($connection,$query);
                ?>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= htmlspecialchars($row['username']); ?></td>
                                    <td><?= htmlspecialchars($row['email']); ?></td>
                                    <td><?= $row['user_type']; ?></td>
                                    <td>
                                        <form method="POST" action="Code.php">
                                            <input type="hidden" name="edit_btn_modal" value="1">
                                            <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="Code.php">
                                            <input type="hidden" name="delete_btn" value="1">
                                            <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                                            <input type="hidden" name="role" value="<?= $row['user_type']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this account?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center">No accounts found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal (Add/Edit User/Admin) -->
<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="Code.php">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $edit_user ? 'Edit' : 'Add' ?> User/Admin</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="<?= $edit_user ? 'edit_btn' : 'registerbtn' ?>" value="1">
                    <input type="hidden" name="edit_id" value="<?= $edit_user['id'] ?? '' ?>">
                    <div class="form-group">
                        <label>User Type</label>
                        <select name="<?= $edit_user ? 'role' : 'role' ?>" class="form-control" required>
                            <option value="">Select Role</option>
                            <option value="user" <?= $edit_user && $edit_user['user_type']=='user' ? 'selected':'' ?>>User</option>
                            <option value="admin" <?= $edit_user && $edit_user['user_type']=='admin' ? 'selected':'' ?>>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="<?= $edit_user ? 'edit_username' : 'username' ?>" class="form-control" required
                               value="<?= $edit_user['username'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="<?= $edit_user ? 'edit_email' : 'email' ?>" class="form-control" required
                               value="<?= $edit_user['email'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="<?= $edit_user ? 'edit_password' : 'password' ?>" class="form-control" <?= $edit_user ? '' : 'required' ?>>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="<?= $edit_user ? 'edit_confirm_password' : 'confirm_password' ?>" class="form-control" <?= $edit_user ? '' : 'required' ?>>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?= $edit_user ? 'Update' : 'Save' ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include('includes/script.php');
include('includes/footer.php');
?>

<?php if($edit_user): ?>
<script>
    $(document).ready(function(){
        $("#userModal").modal('show');
    });
</script>
<?php endif; ?>


<?php
include('includes/script.php');
include('includes/footer.php');
?>
