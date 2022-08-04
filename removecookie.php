<?php
    if(isset($_POST['id']) && $_POST['cookie'] == 'remove'){
        setcookie('fooditem['.$_POST['id'].']','xyz',time()-3600,"/");
        // header('location: cart.php');
        echo 1;
    }else{
        echo 0;
    }
?>