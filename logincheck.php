<?php
    session_start();
    function check($table){
        include 'db.php';
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM $table WHERE email = '$email'";
        $runsql = mysqli_query($conn,$sql);

        if(mysqli_num_rows($runsql)>0){
            $data = mysqli_fetch_assoc($runsql);
            if(password_verify($pass,$data['pass'])){
                $_SESSION['user']=['usertype'=>$table,'custid'=>$data['id'],'name'=>$data['name'],'email'=>$data['email'],'img'=>$data['img']];
                // echo $_SESSION['user']['img'];
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 2;
        }
    }
    
    if(isset($_POST['user']) && $_POST['user']=='superadmin'){
        check('super_admin');
    }
    if(isset($_POST['user']) && $_POST['user']=='admin'){
        check('admin');
    }
    if(isset($_POST['user']) && $_POST['user']=='staff'){
        check('staff');
    }
    if(isset($_POST['user']) && $_POST['user']=='customer'){
        check('customer');
        if(isset($_COOKIE['fooditem'])){
            header('location: cookie.php');
        }
    }
?>