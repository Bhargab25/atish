<?php echo $this->header; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    <!-- Modal -->
        <div class="modal" id="invoiceModal">
            <div class="modal-content" id="invoiceContent">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="in-body">
                <main class="main" id="inv-body">
                        <h4>Invoice</h4>
                        <div class="box">
                            <div class="top">
                                <div class="top-l">
                                    <div class="seller">
                                        <h3 id="seller-name">NEW ANNAPURNA FRUIT SHOP</h3>
                                        <p id="seller-add-1">Atish Chiney</p>
                                        <p id="seller-add-1">8436833830 / 9732615108 (Atish)</p>
                                        <p id="seller-gst">New Market, Kolkata- 700087, 7-8 M Block</p>
                                    </div>
                                    <div class="buyer">
                                        <p>Buyer</p>
                                        <p>Name: <span id="buyer-name"></span></p>
                                        <p>Address: <span id="buyer-add"></span></p>
                                        <p>Mobile: <span id="buyer-mobile"></span></p>
                                        <p>GST: <span id="buyer-gst"></span></p>
                                    </div>
                                </div>
                                <div class="top-r">
                                    <div>
                                        <p class="top-p">Invoice No.</p>
                                        <p id="invoice-no"></p>
                                    </div>
                                    <div>
                                        <p class="top-p">Dated</p>
                                        <p id="dated"></p>
                                    </div>
                                    <div>
                                        <p class="top-p">Delivery Note</p>
                                        <p id="delivery-note"></p>
                                    </div>
                                    <div>
                                        <p class="top-p">Mode/Terms of Payment</p>
                                        <p id="pay-mode"></p>
                                    </div>
                                    
                                    <div>
                                        <p class="top-p">Despatch Document No.</p>
                                        <p id="des-doc-no"></p>
                                    </div>
                                    <div>
                                        <p class="top-p">Delivery Note Date</p>
                                        <p id="delvry-note-date"></p>
                                    </div>
                                    <div>
                                        <p class="top-p">Despatched through</p>
                                        <p id="despatch-thou"></p>
                                    </div>
                                    <div>
                                        <p class="top-p">Destination</p>
                                        <p id="destination"></p>
                                    </div>
                                    <div>
                                        <p class="top-p">Terms of Delivery</p>
                                        <p id="term-delivery"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Top End -->

                            <div class="table-box">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="sl">Sl No.</th>
                                            <th class="des">Description of Goods</th>
                                            <th>Quantity</th>
                                            <th class="per">Rate</th>
                                            <th>Per</th>
                                            <th class="amount">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>Total</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="total-amount" class="total"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Labour Charge</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="labour-charge">0.00</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Cartage Service</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="cartage-service">0.00</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="sub-total" class="total">0.00</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Total</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="ftotal-amount"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="end">
                                <p>Amount Chargeable :</p>
                                <h4 id="amount-word"></h4>
                            </div>
                            <div class="end">
                                <p>Bank Details :</p>
                                <h4 id="amount-word"></h4>
                            </div>
                            <div class="foot">
                                <div class="foot-1">
                                    <p>Declaration</p>
                                    <p class="top-p">We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct</p>
                                </div>
                                <div class="foot-2">
                                    <h4>Authorised Signatory</h4>
                                </div>
                            </div>
                        </div>
                        <h4 class="top-p">This is a Computer Generated Invoice</h4>
                </main>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="downloadInvoice" type="button" class="btn btn-primary">Print</button>
              </div>
            </div>
          
        </div>

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
                            <h6 class="m-0 font-weight-bold text-primary">All Product</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Invoice</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Date</th>
                                            <th>Mode</th>
                                            <th>Destination</th>
                                            <th>Total</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach($this->products as $p){ ?>
                                        <tr>
                                            <th><?php echo $i++; ?></th>
                                            <th><?php echo $p->invoice_no; ?></th>
                                            <th><?php echo $p->name; ?></th>
                                            <th><?php echo $p->c_mobile; ?></th>
                                            <th><?php echo $p->invoice_date; ?></th>
                                            <th><?php echo $p->mode_pay; ?></th>
                                            <th><?php echo $p->destination; ?></th>
                                            <th><?php echo $p->total_amount; ?></th>
                                            <th><?php echo $p->created_at; ?></th>
                                            <th>
                                            <div style="display:flex; gap:5px;">
                                            <a href="#" class="btn btn-warning btn-circle openModalBtnWithData" data-id="<?php echo $p->id; ?>"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-circle delete-button" data-id="<?php echo $p->id; ?>"><i class="fa fa-trash"></i></a>
                                            </div>
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


    <!-- Bootstrap core JavaScript-->
   <?php echo $this->script ?>
   <!-- Include html2pdf.js for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
   <script>
    $(document).ready(function() {

        // Function to open modal with pre-filled inputs using Ajax
        $('.openModalBtnWithData').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'getInvoice.php?id=' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data.history);
                    generateInvoiceContent(data.main,data.history);
                    $('#invoiceModal').modal('show');
                    //$('#productId').val(data.id);
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                }
            });
        });

        function generateInvoiceContent(data,products) {
            $("#invoice-no").text(data.invoice_no);
            $("#dated").text(data.invoice_date);
            $("#pay-mode").text(data.mode_pay);
            $("#destination").text(data.destination);
            $("#delivery-note").text(data.delivery_note);
            $("#despatch-thou").text(data.despatched_throug);
            
            $("#buyer-name").text(data.name);
            $("#buyer-mobile").text(data.c_mobile);
            $("#buyer-gst").text(data.c_gst);
            $("#buyer-add").text(data.c_address);
            
            var tableRows = '';
            var totalRows = 19; // The number of rows we want in total
            var productCount = products.length;

            // Loop through the products and generate table rows
            $.each(products, function(index, item) {
                tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item[4]}</td>
                        <td>${item[5]}</td>
                        <td class="rate">${item[7]}</td>
                        <td class="pc">${item[6]}</td>
                        <td class="amnt">${item[8]}</td>
                    </tr>`;
            });

            // If the product count is less than 19, generate blank rows
            for (var i = productCount; i < totalRows; i++) {
                tableRows += `
                    <tr>
                        <td>${i + 1}</td>
                        <td></td>
                        <td></td>
                        <td class="rate"></td>
                        <td class="pc"></td>
                        <td class="amnt"></td>
                    </tr>`;
            }

            // Update the table with the generated rows
            $("#invoiceModal table tbody").html(tableRows);

            $("#total-amount").text(data.total_amount);
            $("#shi-charge").text(data.shipping + ".00");
            $("#ftotal-amount").text(data.total_amount);

            $("#amount-word").text(data.word);
        }

        $("#downloadInvoice").click(function() {
            var element = document.getElementById('inv-body');
            html2pdf().from(element).save('invoice.pdf');
        });



        $('.delete-button').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var url = 'delete.php?id=' + id;

        // Ask for confirmation before sending the request
        if (confirm("Are you sure you want to delete this item?")) {
            // Send the GET request via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    alert("Item deleted successfully!");
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert("There was an error deleting the item.");
                }
            });
        } else {
            // If user cancels, do nothing
            return false;
        }
    });

    });
</script>

</body>

</html>