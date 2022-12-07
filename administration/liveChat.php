<?php
require 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <!-- Jquery only -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="js/scripts.js"></script>
    </head>

    <body class="sb-nav-fixed">

        <?php
        require 'static-nav/static-headnav.php';
        require 'static-nav/static-sidenav.php';
        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Live-Chat</h1>
                </div>

                <div class="row">
                    <div class="col-sm-4 py-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Online User List</h5>
                                <hr>
                                <div id="login_users"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 py-2">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include 'static-include/footer.php'; ?>

        <script>
            $(document).ready(function () 
            {
                get_users();
                
                //this update activity status function set every 5 seconds update the users status.  
                setInterval(function(){
                    update_activity_status();
                    get_users();
                }, 5000);
                
                function get_users()
                {
                    $.ajax({
                        url: "liveChat_function/get_login_users.php",
                        method: "POST",
                        success: function (data) {
                            $('#login_users').html(data);
                        }
                    })
                }
                
                function update_activity_status(){
                    $.ajax({
                        url:"liveChat_function/update_activity_status.php";
                        success: function(){
                            
                        }
                    })
                }
                
            });

        </script>