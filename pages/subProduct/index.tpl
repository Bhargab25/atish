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
                    <?php if(!$this->view){ ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                        </div>
                        <div class="card-body">
                            <form id="productForm" role="form" action="index.php" method="post">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="productId" name="id" value="">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Category</label>
                                        <input type="text" class="form-control" id="tags" placeholder="Enter Category" name="category" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Product</label>
                                        <input type="text" class="form-control" id="pName" placeholder="Enter Name" name="name" required>
                                    </div>
                                </div>
                            </div>
                                <button class="btn btn-secondary mr-2" type="reset">Cancel</button>
                                <button class="btn btn-primary" name="addp" type="submit">Add Product</button>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- End Add Sub Product -->


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">All Product</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Created At</th>
                                            <th>Stock</th>
                                            <?php if(!$this->view){ ?>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach($this->products as $p){ ?>
                                        <tr>
                                            <th><?php echo $i++; ?></th>
                                            <th><?php echo $p->main_prod; ?></th>
                                            <th><?php echo $p->name; ?></th>
                                            <th><?php echo $p->created_at; ?></th>
                                            <th><?php echo $p->current_stock; ?></th>
                                            <?php if(!$this->view){ ?>
                                            <th><?php echo ($p->status == 1) ? '<a href="#" style="width:15px;height:24px;" class="btn btn-success btn-circle rounded-circle"></a>' : '<a href="#" style="width:15px;height:24px;" class="btn btn-danger btn-circle"></a>'; ?></th>
                                            <th>
                                            <a href="#" class="btn btn-warning btn-circle openModalBtnWithData" data-id="<?php echo $p->id; ?>"><i class="fa fa-eye"></i></a> 
                                            <?php echo ($p->status == 1) ? '<a href="deactive.php?id=' . $p->id . '" class="btn btn-danger btn-circle"><i class="fa fa-ban"></i></a>' : '<a href="active.php?id=' . $p->id . '" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>'; ?>
                                            </th>
                                            <?php } ?>
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
                    $('#productId').val(data.id);
                    $('#tags').val(data.main_prod);
                    $('#pName').val(data.name);

                    //$('#addProductModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                }
            });
        });

var availableTags = [];   
 $('#tags').keyup(function() {
        var input = $(this).val();
        if (input.length >= 1) {
            $.ajax({
                url: 'getNames.php',
                type: 'GET',
                data: { q: input },
                dataType: 'json',
                success: function(response) {
                    var availableTags = response;
                    $( "#tags" ).autocomplete({
                        source: availableTags
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                }
            });
        }
    });

    });
</script>

</body>

</html>