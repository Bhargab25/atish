<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
               <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->

                <div class="sidebar-brand-text mx-3">ANNAPURNA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../home/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-boxes fa-fw"></i>
                    <span>Inventory</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Stock:</h6>
                        <a class="collapse-item" href="../stock/">Add Stock</a>
                        <a class="collapse-item" href="../subProduct/index.php?view=true">View Stock</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInvoice"
                    aria-expanded="true" aria-controls="collapseInvoice">
                    <i class="fas fa-file-invoice fa-fw"></i>
                    <span>Invoice</span>
                </a>
                <div id="collapseInvoice" class="collapse" aria-labelledby="headingInvoice" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Invoice:</h6>
                        <a class="collapse-item" href="../sell/">Create Invoice</a>
                        <a class="collapse-item" href="../sell/view.php">View Invoice</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-coins fa-fw"></i>
                    <span>Finance</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">finance</h6>
                        <a class="collapse-item" href="../payment/scPayment.php">Payment Payable</a>
                        <a class="collapse-item" href="../payment/sdPayment.php">Payment Receivable</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExp"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-money-bill-wave fa-fw"></i>
                    <span>Expenses</span>
                </a>
                <div id="collapseExp" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Expense</h6>
                        <a class="collapse-item" href="../expense/">Add Expense</a>
                        <a class="collapse-item" href="../expense/view.php">View Expenses</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-database fa-fw"></i>
                    <span>Management</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products:</h6>
                        <a class="collapse-item" href="../product/">Category</a>
                        <a class="collapse-item" href="../subProduct/">Product</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Client:</h6>
                        <a class="collapse-item" href="../sc/">Supplier</a>
                        <a class="collapse-item" href="../sd/">Customer</a>
                        <a class="collapse-item" href="../user/">User</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
         <!--  <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>  -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>