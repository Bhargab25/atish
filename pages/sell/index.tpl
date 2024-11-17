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
                <button id="closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="downloadInvoice" type="button" class="btn btn-primary">Download</button>
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
                    <!-- Add Sub Product -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Create Invoice</h6>
                        </div>
                        <div class="card-body">
                            <form id="sell_form" role="form">
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-3">
                                    <input type="hidden" class="form-control" id="sd_id" name="sd_id" required>
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="tags" placeholder="Enter Name" name="name" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
                                </div>
                                <div class="col-md-3">
                                    <label>Invoice No.</label>
                                    <input type="text" class="form-control" placeholder="Invoice No." id="invoice_no" name="invoice_no" readonly required>
                                </div>
                                <div class="col-md-3">
                                    <label>Create Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Delivery Note</label>
                                    <input type="text" class="form-control" placeholder="Enter Note" name="d_note">
                                </div>
                                <div class="col-md-3">
                                    <label>Mode of Payment</label>
                                    <select class="form-control" name="pay_mode">
                                        <option>Cash</option>
                                        <option>Online</option>
                                        <option>UPI</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Despatched through</label>
                                    <input type="text" class="form-control" placeholder="Despatched through" name="despatch">
                                </div>
                                <div class="col-md-3">
                                    <label>Destination</label>
                                    <input type="text" class="form-control" placeholder="Destination" name="destination">
                                </div>
                                <div class="col-md-3">
                                    <label>Total Amount</label>
                                    <input type="text" class="form-control" placeholder="Total Amount" id="total_amount" name="total_amount" readonly required>
                                    <input type="hidden" class="form-control" id="amount_word" name="amount_word">
                                </div>
                                </div>
                                <div class="py-4 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                                </div>

                                <div id="items">
                                    <div class="row mb-2">
                                        <input type="hidden" class="form-control" name="products[0][id]" required>
                                        <div class="col-md-2">
                                            <select class="form-control js-example-basic-single product" placeholder="Product" name="products[0][product]">
                                                <option value=''>Select Product</option>
                                                <?php 
                                                $pro = subproductModel::ReadAll(); 
                                                foreach ($pro as $p) {
                                                    echo "<option value='$p->id'>$p->name</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" placeholder="Current Stock" name="products[0][stock]" readonly required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control qty" step="0.01" min="0" placeholder="Qty" name="products[0][qty]" required>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" placeholder="Unit" name="products[0][unit]" readonly required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control price" placeholder="Price" name="products[0][price]">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" placeholder="Total Price" name="products[0][t_price]" readonly>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-success add_item_btn"><i class="fas fa-fw fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="btn btn-secondary mr-2" type="reset">Cancel</button>
                                <button id="add_btn" class="btn btn-primary" name="addp" type="submit">Create</button>
                                
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
   <!-- Include html2pdf.js for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
   
   <script>
    $(document).ready(function() {

    function invoiceNo(){
        $.ajax({
            url: 'getInvoiceNo.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#invoice_no').val(data);
            },
            error: function(xhr, status, error) {
                console.error('Ajax Error:', error);
            }
        });
    }

    invoiceNo();


    // Initialize autocomplete for the 'tags' field
    $('#tags').autocomplete({
        source: function(request, response) {
            var input = request.term;
            if (input.length >= 2) {
                $.ajax({
                    url: 'getSD.php',
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

    // Populate fields when 'tags' field loses focus
    $("#tags").blur(function() {
        var name = $('#tags').val();
        if (name.length >= 2) {
            $.ajax({
                url: 'getSdDetails.php',
                type: 'GET',
                data: { q: name },
                dataType: 'json',
                success: function(response) {
                    $('#sd_id').val(response.id);
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
            <input type="hidden" class="form-control" name="products[${itemCount}][id]" required>
                <div class="col-md-2">
                    <select class="form-control js-example-basic-single product" placeholder="Product" name="products[${itemCount}][product]">
                        <option value=''>Select Product</option>
                        <?php 
                        $pro = subproductModel::ReadAll(); 
                        foreach ($pro as $p) {
                            echo "<option value='$p->id'>$p->name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" placeholder="Current Stock" name="products[${itemCount}][stock]" readonly required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control qty" step="0.01" min="0" placeholder="Qty" name="products[${itemCount}][qty]" required>
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control" placeholder="Unit" name="products[${itemCount}][unit]" readonly required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control price" placeholder="Price" name="products[${itemCount}][price]">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Total Price" name="products[${itemCount}][t_price]" readonly>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger remove_item_btn"><i class="fas fa-fw fa-trash"></i></button>
                </div>
            </div>`);
        $('.js-example-basic-single').select2(); 
        itemCount++; 
    });

   $(document).on('click', '.remove_item_btn', function(e) {
    e.preventDefault();
    
    const $thisRow = $(this).closest('.row');
    const id = $thisRow.find('input[name^="products"][name$="[id]"]').val();
    const tPrice = parseFloat($thisRow.find('input[name^="products"][name$="[t_price]"]').val()) || 0;

    updateTotal(tPrice,"neg");

    if (id && enteredId.includes(id)) {
        const index = enteredId.indexOf(id);
        if (index > -1) {
            enteredId.splice(index, 1); 
        }
    }

    $thisRow.remove(); 
});

    // Initialize select2 for existing selects
    $('.js-example-basic-single').select2();


    var enteredId = [];
     // Handle barcode input to fetch product details
    $(document).on('change', '.product', function () {
        const $thisRow = $(this).closest('.row');
        const productId = $(this).val();

        if (productId.length != 0 && !enteredId.includes(productId)) {
            enteredId.push(productId);

            $.ajax({
                url: 'getInvoiceNo.php',
                type: 'GET',
                data: { pid: productId },
                dataType: 'json',
                success: function (response) {
                    if (response.error) {
                        $thisRow.find('input[name^="products"]').val('');
                        alert("No data found!");
                        return;
                    }

                    //const formattedPrice = parseFloat(response.Price).toFixed(2);
                    //const formattedTotalPrice = (response.Price * response.qty).toFixed(2);

                    $thisRow.find('input[name^="products"][name$="[id]"]').val(response.name);
                    $thisRow.find('input[name^="products"][name$="[unit]"]').val(response.main_prod);
                    $thisRow.find('input[name^="products"][name$="[stock]"]').val(response.current_stock);
                    $thisRow.find('input[name^="products"][name$="[qty]"]').attr({ min: 0, max: response.current_stock });

                    //updateTotals();
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else if (enteredId.includes(productId)) {
            alert("Product already selected!");
        }
    });

function numToWordsRec(number) {
    const words = {
        0: 'Zero', 1: 'One', 2: 'Two',
        3: 'Three', 4: 'Four', 5: 'Five',
        6: 'Six', 7: 'Seven', 8: 'Eight',
        9: 'Nine', 10: 'Ten', 11: 'Eleven',
        12: 'Twelve', 13: 'Thirteen',
        14: 'Fourteen', 15: 'Fifteen',
        16: 'Sixteen', 17: 'Seventeen', 18: 'Eighteen',
        19: 'Nineteen', 20: 'Twenty', 30: 'Thirty',
        40: 'Forty', 50: 'Fifty', 60: 'Sixty',
        70: 'Seventy', 80: 'Eighty',
        90: 'Ninety'
    };

    if (number < 20) return words[number];
    if (number < 100) return words[10 * Math.floor(number / 10)] + (number % 10 ? ' ' + words[number % 10] : '');
    if (number < 1000) return words[Math.floor(number / 100)] + ' hundred' + (number % 100 ? ' ' + numToWordsRec(number % 100) : '');
    if (number < 1000000) return numToWordsRec(Math.floor(number / 1000)) + ' thousand' + (number % 1000 ? ' ' + numToWordsRec(number % 1000) : '');
    return numToWordsRec(Math.floor(number / 1000000)) + ' million' + (number % 1000000 ? ' ' + numToWordsRec(number % 1000000) : '');
}

function numToWordsWithDecimals(number) {
    const integerPart = Math.floor(number);
    const decimalPart = Math.round((number - integerPart) * 100);

    let result = numToWordsRec(integerPart);
    result += ' Rupees ' + numToWordsRec(decimalPart) + ' Paise ';
    //if (decimalPart > 0) {
    //}
    return result;
}



 function updateTotal(amount, type) {
    const currentValue = parseFloat($('#total_amount').val()) || 0;
    let newValue;

    if (type === "neg") {
        newValue = currentValue - parseFloat(amount);
    } else {
        newValue = currentValue + parseFloat(amount);
    }
    const word = numToWordsWithDecimals(newValue.toFixed(2));
    $('#amount_word').val(word);
    $('#total_amount').val(newValue.toFixed(2)); 
}

   $(document).on('blur', '.price, .qty', function () {
    const $thisRow = $(this).closest('.row');
    
    // Get numeric values and handle empty cases
    const price = +$thisRow.find('.price').val() || 0;
    const qty = +$thisRow.find('.qty').val() || 0;

    // Calculate the total price
    const totalPrice = (price * qty).toFixed(2);

    // Update the total price field
    updateTotal(totalPrice,"pos")
    $thisRow.find('input[name^="products"][name$="[t_price]"]').val(totalPrice);
});


    // Handle form submission
    $("#sell_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#add_btn").val('Adding...');

        $.ajax({
            url: 'sell.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
               let ress = JSON.parse(res);
               //console.log(ress);
                // Check status and handle the response
                if (ress.status == 'success') {
                    generateInvoiceContent(ress.data);
                    $('#invoiceModal').modal('show');
                    $("#sell_form")[0].reset();
                    //window.location.reload();
                } else {
                    alert('Failed to add stock!');
                    console.log(res.error);
                }

                $("#add_btn").val('Add Stock');
            },
            error: function(xhr, status, error) {
                console.error('Ajax Error:', error);
                $("#add_btn").val('Add Stock');
            }
        });
    });

function generateInvoiceContent(data) {
    $("#invoice-no").text(data.invoice_no);
    $("#dated").text(data.date);
    $("#pay-mode").text(data.pay_mode);
    $("#destination").text(data.destination);
    $("#delivery-note").text(data.d_note);
    $("#despatch-thou").text(data.despatch);
     
    $("#buyer-name").text(data.name);
    $("#buyer-mobile").text(data.mobile);
    $("#buyer-gst").text(data.gst);
    $("#buyer-add").text(data.address);
    
    var tableRows = '';
    var totalRows = 19; // The number of rows we want in total
    var productCount = data.products.length;

    // Loop through the products and generate table rows
    $.each(data.products, function(index, item) {
        tableRows += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.id}</td>
                <td>${item.qty}</td>
                <td class="rate">${item.price}</td>
                <td class="pc">${item.unit}</td>
                <td class="amnt">${item.t_price}</td>
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
    $("table tbody").html(tableRows);

    $("#total-amount").text(data.total_amount);
    $("#shi-charge").text(data.shipping + ".00");
    $("#ftotal-amount").text(data.total_amount);

    $("#amount-word").text(data.amount_word);
}

$("#downloadInvoice").click(function() {
    var element = document.getElementById('inv-body');
    const name = $("#buyer-name").text();
    html2pdf().from(element).save(name + '-invoice.pdf');
});

$("#closeModal").click(function() {
    $("#invoiceModal").modal('hide');
     window.location.reload();
});

//$('#invoiceModal').modal('show');

});
</script>

</body>

</html>