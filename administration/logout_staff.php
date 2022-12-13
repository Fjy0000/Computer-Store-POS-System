<?php
//logout clear session value
session_start();
session_destroy();

header("Location:http://localhost/Computer-Store-POS-System/administration/login_staff.php");
exit(0);

