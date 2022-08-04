<?php
    session_start();
    if($_SESSION['user']['usertype']=='customer'){
        unset($_SESSION['user']);
    }
    header('location: index.php');
?>

