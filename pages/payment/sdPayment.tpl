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
                            <h6 class="m-0 font-weight-bold text-primary">SD Payment</h6>
                        </div>
                        <div class="card-body">
                            <form id="stock_form" role="form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" class="form-control" id="sc_id" name="sc_id" required>
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="tags" placeholder="Enter Name" name="name" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" required readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Address</label>
                                        <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Due Ammount</label>
                                        <input type="text" class="form-control" placeholder="Due Ammount" id="due_ammount" name="due_ammount" required readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Recive Date</label>
                                        <input type="date" class="form-control" name="r_date" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Paid Amount</label>
                                        <input type="number" class="form-control" placeholder="Paid Amount" name="p_amount" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Remarks</label>
                                        <input type="text" class="form-control" placeholder="Remarks" name="remarks" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Pay Mode</label>
                                        <select class="form-control" name="pay_mode" required>
                                        <option value="upi">UPI</option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="online">Online</option>                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <button class="btn btn-secondary mr-2" type="reset">Cancel</button>
                                <button id="add_btn" class="btn btn-primary" name="addp" type="submit">Paid Ammount</button>
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
   
   <script>
    $(document).ready(function() {
    // Initialize autocomplete for the 'tags' field
    $('#tags').autocomplete({
        source: function(request, response) {
            var input = request.term;
            if (input.length >= 2) {
                $.ajax({
                    url: '../stock/getName.php',
                    type: 'GET',
                    data: { sd: input },
                    dataType: 'json',
                    success: function(data) {
                        response(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax Error:', error);
                    }
                });
            } else {
                response([]);
            }
        }
    });

    // Populate fields when 'tags' field loses focus
    $("#tags").blur(function() {
        var name = $('#tags').val();
        if (name.length >= 2) {
            $.ajax({
                url: '../stock/getDetails.php',
                type: 'GET',
                data: { sd: name },
                dataType: 'json',
                success: function(response) {
                    $('#sc_id').val(response.id);
                    $('#mobile').val(response.mobile);
                    $('#address').val(response.address);
                    $('#due_ammount').val(response.due_ammount);
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                }
            });
        }
    });

    // Handle form submission
    $("#stock_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#add_btn").val('Adding...');

        $.ajax({
            url: 'addSdPayment.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
               let ress = JSON.parse(res);
                // Check status and handle the response
                if (ress.status == 1) {
                    console.log(ress);
                    alert('Payment added successfully!');
                    $("#stock_form")[0].reset();
                    //window.location.reload();
                } else {
                    alert('Failed to add stock!');
                    console.log(res.error);
                }

                $("#add_btn").val('Add Payment');
            },
            error: function(xhr, status, error) {
                console.error('Ajax Error:', error);
                $("#add_btn").val('Add Payment');
            }
        });
    });

});

    </script>

</body>

</html>