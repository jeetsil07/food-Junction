<?php
    include 'db.php';
    session_start();
    if(!isset($_COOKIE['fooditem']) && isset($_POST['foodid']) && isset($_SESSION['user']) && $_SESSION['user']['usertype']=="customer"){
        $fid = $_POST['foodid'];
        $sql = "SELECT * FROM food_items WHERE id = $fid";
        $runsql = mysqli_query($conn,$sql);

        $data = mysqli_fetch_assoc($runsql);

        $food_item = $data['food_name'];
        $mrp = $data['mrp'];
        $gst = $data['gst'];
        $img = $data['food_img'];
        $food_cat = $data['food_cat'];
        $customer_id = $_SESSION['user']['custid'];

        $srchcartsql = "SELECT * FROM cart WHERE food_item = '$food_item' and customer_id =$customer_id";
        $srchcartrunsql = mysqli_query($conn,$srchcartsql);

        if(mysqli_num_rows($srchcartrunsql)>0){
            echo $_SESSION['user']['name']." Item is already in cart";
        }else{
            $cartsql = "INSERT INTO cart(food_item,mrp,gst,img,food_cat,customer_id) VALUES
            ('$food_item','$mrp','$gst','$img','$food_cat','$customer_id')";
            $runcartsql = mysqli_query($conn,$cartsql);
    
            if($runcartsql){
                echo $_SESSION['user']['name']." add To cart successfull";
            }else{
                echo $_SESSION['user']['name']." add To cart not successfull";
            }
        }
    }
    else if(!isset($_SESSION['user']) && isset($_POST['foodid']) && $_POST['cookie'] == true){
        $i =0;
        if(isset($_COOKIE['fooditem']) && !empty($_COOKIE['fooditem'])){
            foreach($_COOKIE['fooditem'] as $key => $val){
                if($_POST['foodid'] == $val){
                    echo "Already In The Cart";
                    exit();
                }else{
                    $i = $key;
                }            
            }
            $i++;
            setcookie('fooditem['.$i.']',$_POST['foodid'],time()+240,"/");
            echo "Add To Cart Successfull";
        }else{
            setcookie('fooditem['.$i.']',$_POST['foodid'],time()+240,"/");
            echo "Add To Cart Successfull";
        }        
    }else if(isset($_COOKIE['fooditem']) && $_SESSION['user']['usertype'] == 'customer'){
        // echo "skjefbsdb";
        foreach($_COOKIE['fooditem'] as $key => $val){
            $fid = $val;  
            $sql = "SELECT * FROM food_items WHERE id = $fid";
            $runsql = mysqli_query($conn,$sql);

            $data = mysqli_fetch_assoc($runsql);

            $food_item = $data['food_name'];
            $mrp = $data['mrp'];
            $gst = $data['gst'];
            $img = $data['food_img'];
            $food_cat = $data['food_cat'];
            $customer_id = $_SESSION['user']['custid'];

            $srchcartsql = "SELECT * FROM cart WHERE food_item = '$food_item' and customer_id =$customer_id";
            $srchcartrunsql = mysqli_query($conn,$srchcartsql);

            if(mysqli_num_rows($srchcartrunsql)>0){
                echo $_SESSION['user']['name']." Item is already in cart";
            }else{
                $cartsql = "INSERT INTO cart(food_item,mrp,gst,img,food_cat,customer_id) VALUES
                ('$food_item','$mrp','$gst','$img','$food_cat','$customer_id')";
                $runcartsql = mysqli_query($conn,$cartsql);
        
                if($runcartsql){
                    echo $_SESSION['user']['name']." add To cart successfull";
                }else{
                    echo $_SESSION['user']['name']." add To cart unsuccessfull";
                }
            }       
        }
    }
    
    // print_r($_COOKIE['item']);
    // echo count($_COOKIE['item']);

?>