<?php
    date_default_timezone_set('Asia/Kolkata');
    include 'db.php';

    if(isset($_POST['customername']) && isset($_POST['customeremail'])){
        $filename = $_FILES['customerimg']['name'];
        $tmpname = $_FILES['customerimg']['tmp_name'];
        $name = mysqli_real_escape_string($conn,$_POST['customername']);
        $email = mysqli_real_escape_string($conn,$_POST['customeremail']);
        $pass =  password_hash($_POST['customerpass'],PASSWORD_DEFAULT);

        $exe = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

        if($exe == 'jpg' || $exe == 'png' || $exe == 'jpeg'){
            $filename = uniqid()."-".date("Y-m-d").$exe;
            $path = "customerassets/images/".$filename;
            move_uploaded_file($tmpname,$path);
            $created_at = date('Y-m-d h:i:s',strtotime('now'));
            $sql = "INSERT INTO customer (name,email,pass,img,created_at) VALUES 
            ('$name','$email','$pass','$path','$created_at')";
            $runsql = mysqli_query($conn,$sql);
            if($runsql){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 2;
        }
    }

?>