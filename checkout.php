<?php
    session_start();
    if(isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'customer'){
        echo 1;
    }else{
        echo 0;
    }
?>