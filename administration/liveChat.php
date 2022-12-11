<?php
require 'dbconnect_pdo.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <script src="js/scripts.js"></script>
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
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Online User List</h5>
                            <hr>
                            <div id="login_users"></div>
                            <div id="chat_modal"></div>
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
                setInterval(function () {
                    update_activity_status();
                    get_users();
                    update_chat_history();
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

                function update_activity_status() {
                    $.ajax({
                        url: "liveChat_function/update_activity_status.php",
                        success: function () {
                        }
                    })
                }

                function chat_box(to_user_id, to_user_name) {
                    var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + ' ">';
                    modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
                    modal_content += get_to_user_chat_history(to_user_id);
                    modal_content += '</div>';
                    modal_content += '<div class="form-group">';
                    modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control"></textarea>';
                    modal_content += '</div><div class="form-group" align="right">';
                    modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-info send_chat">Send</button></div></div>';
                    $('#chat_modal').html(modal_content);
                }
                $(document).on('click', '.start_chat', function () {
                    var to_user_id = $(this).data('touserid');
                    var to_user_name = $(this).data('tousername');
                    chat_box(to_user_id, to_user_name);
                    $("#user_dialog_" + to_user_id).dialog({
                        autoOpen: false,
                        width: 400
                    });
                    $('#user_dialog_' + to_user_id).dialog('open');
                });

                $(document).on('click', '.send_chat', function () {
                    var to_user_id = $(this).attr('id');
                    var chat_message = $('#chat_message_' + to_user_id).val();
                    $.ajax({
                        url: "livechat_function/start_conversation.php",
                        method: "POST",
                        data: {to_user_id: to_user_id, chat_message: chat_message},
                        success: function (data)
                        {
                            $('#chat_message_' + to_user_id).val('');
                            $('#chat_history_' + to_user_id).html(data);
                        }
                    })
                });

                function get_to_user_chat_history(to_user_id) {
                    $.ajax({
                        url: "liveChat_function/get_to_user_chat_history.php",
                        method: "POST",
                        data: {
                            to_user_id: to_user_id
                        },
                        success: function (data) {
                            $('#chat_history_' + to_user_id).html(data);
                        }
                    })
                }

                function update_chat_history() {
                    $('.chat_history').each(function () {
                        var to_user_id = $(this).data('touserid');
                        get_to_user_chat_history(to_user_id);
                    });
                }

                $(document).on('click', '.ui-button-icon', function () {
                    $('.user_dialog').dialog('destroy').remove();
                });

                $(document).on('click', '.remove_message', function () {
                    var message_id = $(this).attr('id');
                    if (confirm("Are you sure you want to remove this message in the chat ?")) {
                        $.ajax({
                            url: "liveChat_function/remove_message.php",
                            method: "POST",
                            data: {message_id: message_id},
                            success: function (data) {
                                update_chat_history();
                            }
                        })
                    }
                });

            });

        </script>