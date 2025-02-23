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
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">All Customer</h6>
                            <a href="#" data-toggle="modal" id="openModalBtnBlank" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">Add Customer</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Due</th>
                                            <th>Gst</th>
                                            <th>Created at</th>
                                            <th>Created By</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Due</th>
                                            <th>Gst</th>
                                            <th>Created at</th>
                                            <th>Created By</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach($this->products as $p){ ?>
                                        <tr>
                                            <th><?php echo $i++; ?></th>
                                            <th><?php echo $p->merchant_name; ?></th>
                                            <th><?php echo $p->mobile; ?></th>
                                            <th><?php echo $p->email; ?></th>
                                            <th><?php echo $p->address; ?></th>
                                            <th><?php echo $p->due_ammount; ?></th>
                                            <th><?php echo $p->gst; ?></th>
                                            <th><?php echo $p->created_at; ?></th>
                                            <th><?php echo $p->uid; ?></th>
                                            <th><?php echo ($p->status == 1) ? '<a href="#" style="width:15px;height:24px;" class="btn btn-success btn-circle rounded-circle"></a>' : '<a href="#" style="width:15px;height:24px;" class="btn btn-danger btn-circle"></a>'; ?></th>
                                            <th style="display:flex; gap:5px;">
                                            <a href="#" class="btn btn-warning btn-circle openModalBtnWithData" data-id="<?php echo $p->id; ?>"><i class="fa fa-eye"></i></a> 
                                            <?php echo ($p->status == 1) ? '<a href="deactive.php?id=' . $p->id . '" class="btn btn-danger btn-circle"><i class="fa fa-ban"></i></a>' : '<a href="active.php?id=' . $p->id . '" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>'; ?>
                                            </th>
                                        </tr>
                                    <?php } ?>
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                 <form id="productForm" role="form" action="index.php" method="post">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="sdId" name="id" value="">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="sdName" placeholder="Enter Name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" id="sdMobile" placeholder="Enter Mobile" name="mobile" maxlength="10">
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="sdEmail" placeholder="sample@email.com" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="sdAddress" placeholder="Enter Address" maxlength="40" name="address">
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-6">
                                    <label>Gst</label>
                                    <input type="text" class="form-control" id="sdGst" placeholder="GST No." maxlength="15" name="gst">
                                </div>
                                </div>
                            </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset">Cancel</button>
                    <button class="btn btn-primary" name="addp" type="submit">Add Customer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
   <?php echo $this->script ?>
   <script>
    $(document).ready(function() {
        // Function to open modal with blank inputs
        $('#openModalBtnBlank').click(function() {
            $('#productForm')[0].reset();
            $('#addProductModal').modal('show');
        });

        // Function to open modal with pre-filled inputs using Ajax
        $('.openModalBtnWithData').click(function(e) {
            e.preventDefault();
            var sdId = $(this).data('id');
            $.ajax({
                url: 'update.php?id=' + sdId,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#sdId').val(data.id);
                    $('#sdName').val(data.merchant_name);
                    $('#sdMobile').val(data.mobile);
                    $('#sdEmail').val(data.email);
                    $('#sdAddress').val(data.address);
                    $('#sdGst').val(data.gst);

                    $('#addProductModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                }
            });
        });
    });
</script>

</body>

</html>