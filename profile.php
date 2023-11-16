<!DOCTYPE html>
<html lang="en">
<?php $menu = "profile"; ?>
<?php include("head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include("navbar.php"); ?>
        <!-- /.navbar -->
        <?php include("menu.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="m-0 text-dark">จัดการบัญชี</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">จัดการบัญชี</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title" style="line-height: 2.1rem"><i class="fas fa-cart-arrow-down"></i> จัดการบัญชี</h3>
                                </div>
                                <div class="card-body">
                                    <div class="container-xl px-4 mt-4">
                                        <!-- Account page navigation-->
                                        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                                            <hr class="mt-0 mb-4">
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <!-- Profile picture card-->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <div class="card-header">Profile Picture</div>
                                                        <div class="card-body text-center">
                                                            <!-- Profile picture image-->
                                                            <input type="hidden" value="#" required class="form-control" name="photo2">
                                                            <img loading="lazy" class="img-account-profile mb-2" src="p_img/993532342.jpg" id="previewImg" alt="">
                                                            <!-- Profile picture help block-->
                                                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                                            <div class="div file btn btn btn-primary">
                                                                Upload new image
                                                                <input class="input" type="file" id="imgInput" name="photo" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <!-- Account details card-->
                                                    <div class="card mb-4">
                                                        <div class="card-header">Account Details</div>
                                                        <div class="card-body">
                                                            <!-- Form Group (username)-->
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <input type="hidden" readonly value="<?php echo $data['user_id']; ?>" required class="form-control" name="user_id">
                                                                    <label class="small mb-1" for="inputUsername">Username</label>
                                                                    <input class="form-control" type="text" name="user" readonly placeholder="Enter your username" value="0004034">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputPosition">Position</label>
                                                                    <input class="form-control" type="text" name="position" placeholder="Enter your position" readonly value="<?php echo $data['position']; ?>">
                                                                </div>
                                                            </div>
                                                            <!-- Form Row-->
                                                            <div class="row gx-3 mb-3">
                                                                <!-- Form Group (first name)-->
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                                                    <input class="form-control" type="text" name="firstname" placeholder="Enter your first name" value="<?php echo $data['firstname']; ?>">
                                                                </div>
                                                                <!-- Form Group (last name)-->
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                                                    <input class="form-control" type="text" name="lastname" placeholder="Enter your last name" value="<?php echo $data['lastname']; ?>">
                                                                </div>
                                                            </div>
                                                            <!-- Form Row        -->
                                                            <div class="row gx-3 mb-3">
                                                                <!-- Form Group (organization name)-->
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputBank">Bank</label>
                                                                    <select name="bank" class="form-control">
                                                                        <option value="ABA" <?php if ($data['bank'] == "ABA") {
                                                                                                echo "selected";
                                                                                            } ?>>ABA</option>
                                                                        <option value="ACLEDA" <?php if ($data['bank'] == "ACLEDA") {
                                                                                                    echo "selected";
                                                                                                } ?>>ACLEDA</option>
                                                                    </select>
                                                                </div>
                                                                <!-- Form Group (location)-->
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputBank_number">Bank number</label>
                                                                    <input class="form-control" type="text" name="bank_number" placeholder="Enter your bank number" value="<?php echo $data['bank_number']; ?>">
                                                                </div>
                                                            </div>
                                                            <!-- Form Row-->
                                                            <div class="row gx-3 mb-3">
                                                                <!-- Form Group (phone number)-->
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                                                    <input class="form-control" type="text" name="phone" placeholder="Enter your phone number" value="<?php echo $data['phone']; ?>">
                                                                </div>
                                                                <!-- Form Group (birthday)-->
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputSponsor">Sponsor</label>
                                                                    <input class="form-control" type="text" name="sponsor" placeholder="Enter your sponsor" readonly value="<?php echo $data['sponsor']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="inputAddress">Address</label>
                                                                <input class="form-control" type="text" name="address" placeholder="Enter your address" value="<?php echo $data['address']; ?>">
                                                            </div>
                                                            <!-- Save changes button-->
                                                            <button class="btn btn-primary" name="update" type="submit">Save changes</button>
                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_password<?php echo $data['user_id']; ?>">
                                                                Change Password
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </form>
                                    </div>
                                    <!-- /.container-xl -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Modal -->
        <div class="modal fade" id="edit_password<?php echo $data['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" method="post" action="edit_password_p.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label class="mb-1" for="NewPassword">New Password</label>
                                <input class="form-control" type="password" name="password" required placeholder="Enter your password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                            <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /. Modal -->
        <?php include("footer.php"); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php include("script.php"); ?>
</body>

</html>