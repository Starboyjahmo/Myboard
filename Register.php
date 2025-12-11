<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

    <!-- BUTTON + HEADER -->
    <div class="shadow mb-4">
        <div class="header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Admin Profile</h6>

            <!-- Button to open modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal">
                Add Admin Profile
            </button>
        </div>

        <!-- CARD -->
        <div class="card">

     <?php
        if (isset($_SESSION['success']) && $_SESSION['success'] != '') 
            { echo '<h2>'.$_SESSION['success'].'</h2>'; 
                unset($_SESSION['success']);
        
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] != '') 
            { echo '<h2 class=" bg-info">'.$_SESSION['status'].'</h2>'; 
                unset($_SESSION['status']);
                }

             ?>

            <div class="table-responsive">
                <h3>Admin Table</h3>

                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start Date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- REAL MODAL (must be outside table/card) -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Admin Data</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="Code.php" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label>UserName</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>