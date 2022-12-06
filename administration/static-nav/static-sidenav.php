<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Core</div>

                    <a class="nav-link" href="admin_dashboard.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-speedometer"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="liveChat.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-chat-dots-fill"></i></div>
                        Live-Chat
                    </a>

                    <div class="sb-sidenav-menu-heading">Maintenance</div>

                    <a class="nav-link" href="staff.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-person-vcard-fill"></i></div>
                        Staff Account
                    </a>
                    <a class="nav-link" href="delivery.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-truck"></i></div>
                        Sales Delivery
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#stockPage" aria-expanded="false" aria-controls="stockPage">
                        <div class="sb-nav-link-icon"><i class="bi bi-table"></i></div>
                        Stock
                        <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down"></i></div>
                    </a>
                    <div class="collapse" id="stockPage" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="stock_hq.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-table"></i></div>
                                HQ's Stock
                            </a>
                            <a class="nav-link" href="stock_branch.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-table"></i></div>
                                Branch's Stock
                            </a>
                            <a class="nav-link" href="remove_details.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-table"></i></div>
                                Remove Product Quantity
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link" href="category.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-funnel"></i></div>
                        Category
                    </a>
                    <a class="nav-link" href="promotion.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-ticket-fill"></i></div>
                        Promotion
                    </a>
                    <a class="nav-link" href="store.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-buildings"></i></div>
                        Store
                    </a>
                    
                    <div class="sb-sidenav-menu-heading">Generate Report</div>
                     <a class="nav-link" href="salesReport.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-file-earmark"></i></div>
                        Sales Report
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php
                if (empty($_SESSION['username'])) {
                    echo "null";
                } else {
                    echo $_SESSION['username'];
                }
                ?>
            </div>
        </nav>
    </div>
