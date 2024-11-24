<?php echo $this->header; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php echo $this->sidebar ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php echo $this->topbar ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Add Sub Product -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                        </div>
                        <div class="card-body">
                            <form id="userForm" role="form" action="index.php" method="post">
                        
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="userid">Userid</label>
                                        <input type="text" class="form-control" id="userid" placeholder="Enter UserID" name="userid" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="1">Admin</option>
                                            <option value="2">Manager</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                                    </div>
                                </div>
                            </div>
                                <button class="btn btn-secondary mr-2" type="reset">Cancel</button>
                                <button class="btn btn-primary" name="addp" type="submit">Add User</button>
                            </form>
                        </div>
                    </div>
                    <!-- End Add Sub Product -->


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">All User</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach($this->users as $p){ ?>
                                        <tr>
                                            <th><?php echo $i++; ?></th>
                                            <th><?php echo $p->name; ?></th>
                                            <th><?php echo $p->role; ?></th>
                                            <th><?php echo $p->mobile; ?></th>
                                            <th><?php echo $p->email; ?></th>
                                            <th><?php echo ($p->status == 1) ? '<a href="#" style="width:15px;height:24px;" class="btn btn-success btn-circle rounded-circle"></a>' : '<a href="#" style="width:15px;height:24px;" class="btn btn-danger btn-circle"></a>'; ?></th>
                                            <th>
                                            <a href="#" class="btn btn-warning btn-circle openModalBtnWithData" data-id="<?php echo $p->uid; ?>"><i class="fa fa-eye"></i></a> 
                                            <?php echo ($p->status == 1) ? '<a href="deactive.php?id=' . $p->uid . '" class="btn btn-danger btn-circle"><i class="fa fa-ban"></i></a>' : '<a href="active.php?id=' . $p->uid . '" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>'; ?>
                                            </th>
                                            <?php } ?>
                                        </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php echo $this->footer; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php echo $this->logout ?>


    <!-- Bootstrap core JavaScript-->
   <?php echo $this->script ?>
   
   <script>
    $(document).ready(function() {

    });
</script>

</body>

</html>