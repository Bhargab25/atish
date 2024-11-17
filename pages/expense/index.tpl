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
                            <h6 class="m-0 font-weight-bold text-primary">Add Expenses</h6>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" name="add_expense" action="index.php">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" name="name" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Ammount</label>
                                        <input type="text" class="form-control" placeholder="Ammount" id="ammount" name="amount" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Remarks</label>
                                        <input type="text" class="form-control" placeholder="Remarks" name="remarks">
                                    </div>
                                </div>
                            </div>
                                <button class="btn btn-secondary mr-2" type="reset">Cancel</button>
                                <button id="add_btn" class="btn btn-primary" name="addExp" type="submit">Add New</button>
                            </form>
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
</body>

</html>