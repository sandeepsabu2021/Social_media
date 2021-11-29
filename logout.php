<?php
    session_start();
    session_destroy();
    setcookie("email","");
    setcookie("password","");
    header("location:index.php");
?>