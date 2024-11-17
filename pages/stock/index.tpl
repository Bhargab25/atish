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
                            <h6 class="m-0 font-weight-bold text-primary">Stock Entry</h6>
                        </div>
                        <div class="card-body">
                            <form id="stcok_form" role="form">
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
                                    <label>Challan Number</label>
                                    <input type="text" class="form-control" placeholder="Enter number" name="number" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Recive Date</label>
                                    <input type="date" class="form-control" name="r_date" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Toatl Amount</label>
                                    <input type="number" class="form-control" placeholder="Enter Total Amount" name="t_amount" required>
                                </div>
                                </div>
                                <div class="py-4 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                                </div>

                                <div id="items">
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <select class="form-control js-example-basic-single" placeholder="Product" name="products[0][product]">
                                                <?php 
                                                $pro = subproductModel::ReadAll(); 
                                                foreach ($pro as $p) {
                                                    echo "<option value='$p->id'>$p->name</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="Qty" name="products[0][qty]" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="Price" name="products[0][price]">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-success add_item_btn">Add More</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="btn btn-secondary mr-2" type="reset">Cancel</button>
                                <button id="add_btn" class="btn btn-primary" name="addp" type="submit">Add Product</button>
                                
                            </form>
                            
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
    // Initialize autocomplete for the 'tags' field
    $('#tags').autocomplete({
        source: function(request, response) {
            var input = request.term;
            if (input.length >= 2) {
                $.ajax({
                    url: 'getName.php',
                    type: 'GET',
                    data: { q: input },
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

    // Handle form submission
    $("#stcok_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#add_btn").val('Adding...');

        $.ajax({
            url: 'addStock.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
               let ress = JSON.parse(res);
                // Check status and handle the response
                if (ress.status == 1) {
                    alert('Stock added successfully!');
                    $("#stcok_form")[0].reset();
                    //window.location.reload();
                } else {
                    alert('Failed to add stock!');
                    console.log(res.error);
                }

                $("#add_btn").val('Add Stock');
            },
            error: function(xhr, status, error) {
                console.error('Ajax Error:', error);
                $("#add_btn").val('Add Stock'); // Restore button text on error
            }
        });
    });

    // Populate fields when 'tags' field loses focus
    $("#tags").blur(function() {
        var name = $('#tags').val();
        if (name.length >= 2) {
            $.ajax({
                url: 'getDetails.php',
                type: 'GET',
                data: { q: name },
                dataType: 'json',
                success: function(response) {
                    $('#sc_id').val(response.id);
                    $('#mobile').val(response.mobile);
                    $('#address').val(response.address);
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                }
            });
        }
    });

    // Add more products
    var itemCount = 1; // Initialize counter for product items
    $(".add_item_btn").click(function(e) {
        e.preventDefault();
        $("#items").append(`
            <div class="row mb-2">
                <div class="col-md-4">
                    <select class="form-control js-example-basic-single" placeholder="Product" name="products[${itemCount}][product]">
                        <?php 
                        $pro = subproductModel::ReadAll(); 
                        foreach ($pro as $p) {
                            echo "<option value='$p->id'>$p->name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Qty" name="products[${itemCount}][qty]" required>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Price" name="products[${itemCount}][price]">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger remove_item_btn">Remove</button>
                </div>
            </div>`);
        $('.js-example-basic-single').select2(); // Initialize select2
        itemCount++; // Increment counter
    });

    // Remove a product entry
    $(document).on('click', '.remove_item_btn', function(e) {
        e.preventDefault();
        $(this).closest('.row').remove();
    });

    // Initialize select2 for existing selects
    $('.js-example-basic-single').select2();
});

    </script>

</body>

</html>