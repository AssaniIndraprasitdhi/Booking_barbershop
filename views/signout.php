<?php
    session_start();
    unset($_SESSION["member_login"]);
    unset($_SESSION["admin_login"]);
    header("location:signin.php");
?>