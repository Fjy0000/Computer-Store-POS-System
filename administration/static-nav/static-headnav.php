<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="admin_dashboard.php">POS Management</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    
    <form class="d-none d-md-inline-block form-inline ms-auto">
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li> <a class="btn btn-primary m-md-2" href="http://localhost/Computer-Store-POS-System/client/home.php">Preview</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person" style="font-size: 30px;"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="user_profile.php?id=<?php
                        if (empty($_SESSION['id'])) {
                            echo "null";
                        } else {
                            echo $_SESSION['id'];
                        }
                        ?>">User's Profile</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout_staff.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </form>
</nav>
