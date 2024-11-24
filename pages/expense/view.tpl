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
                            <h6 class="m-0 font-weight-bold text-primary">All Expenses</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>date</th>
                                            <th>remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1; 
                                    foreach($this->exp as $p){ ?>
                                        <tr>
                                            <th><?php echo $i++; ?></th>
                                            <th><?php echo $p->name; ?></th>
                                            <th><?php echo $p->amount; ?></th>
                                            <th><?php echo $p->date; ?></th>
                                            <th><?php echo $p->remarks; ?></th>
                                            <th>
                                            <div style="display:flex; gap:5px;">
                                                <a href="delete.php?id=<?php echo $p->id; ?>;" class="btn btn-danger btn-circle delete-button"><i class="fa fa-trash"></i></a>
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

</body>

</html>