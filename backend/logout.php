<?php
    session_start();
    if($_SESSION['user']['usertype']=='super_admin' || $_SESSION['user']['usertype']=='admin'){
        unset($_SESSION['user']);
    }
    header('location: ../index.php');
?>