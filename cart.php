<?php
    session_start();
    include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <section class="bg-color1 stillheader">
        <div class="container-md container-fluid px-md-0 p-2">
            <div class="row align-items-center justify-content-between">
                <div class="col-2" id="logo">
                    <?php
                        if(isset($_SESSION['user']) && $_SESSION['user']['usertype']=="customer") {
                            echo '<img class="img-fluid rounded-circle" src="'.$_SESSION['user']['img'].'" alt="" width="50" height="50">';
                        }else{
                            echo '<img class="img-fluid rounded-circle" src="./images/logo.png" alt="" width="70" height="70">';
                        }
                    ?>
                </div>
                <div class="col d-lg-block d-none">
                    <div class="row">
                        <ul class="d-flex ml-auto align-items-center list-unstyled my-0">
                            <li><a href="index.php" class="text-white px-4">Home</a></li>
                            <li><a href="foodjunction.php" class="text-white px-4">Food Junction</a></li>
                            <li><a href="index.php#todayspecial" class="text-white px-4">Today's Special</a></li>
                            <li><a href="cart.php" class="text-white px-4"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge badge-pill badge-success ml-2">
                            <?php 
                                if(!isset($_SESSION['user']) && isset($_COOKIE['fooditem'])){
                                    echo count($_COOKIE['fooditem']); 
                                }elseif(isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'customer'){
                                    $custid = $_SESSION['user']['custid'];
                                    // echo $custid;
                                    $countsql = "SELECT * FROM cart where customer_id = $custid";
                                    // echo $countsql;
                                    $runcountsql = mysqli_query($conn,$countsql);
                                    echo mysqli_num_rows($runcountsql);
                                }else{
                                    echo 0;
                                } 
                            ?></span></a></li>
                            <li>
                                <?php
                                    if(isset($_SESSION['user']) && $_SESSION['user']['usertype']=="customer") {
                                        echo '<a href="customerlogout.php" class="text-white px-4">logout</a>';
                                    }else{
                                        echo '<a href="login.php" class="text-white px-4">login</a>';
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="d-lg-none mr-3 d-block btn" id="menubtn">
                    <span class="menuicon"></span>
                    <span class="menuicon"></span>
                    <span class="menuicon"></span>
                </button>
            </div>
        </div>
    </section>
    <section id="cartcontent">
        <div class="container my-5">
            <div class="row bg-color2" style="max-height: 550px; overflow: auto;">
                <div class="col-7">
                    <div class="row">
                        <div class="col-12">
                            <?php
                                if(isset($_SESSION['user']) && $_SESSION['user']['usertype'] == "customer" && !isset($_COOKIE['fooditem'])){
                                    $mrp = 0;
                                    $cust_id = $_SESSION['user']['custid'];
                                    $sql = "SELECT * FROM cart where customer_id = $cust_id";
                                    $runsql = mysqli_query($conn,$sql);
                                    while($data = mysqli_fetch_assoc($runsql)){
                                        $mrp += $data['mrp'];
                                        echo '
                                        <div class="card mx-auto my-3 shadow-lg p-3 mb-5 bg-white rounded" style="min-width: 18rem;">
                                            <div class="row no-gutters">
                                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                    <img src="backend/'.$data['img'].'" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">'.$data['food_item'].'</h5>
                                                        <p><i class="fa fa-inr mr-2" aria-hidden="true"></i><input readonly class="price" name="price" type="text" value="'.$data['mrp'].'" style="border: none; outline: none;"></p>
                                                        <input class="pl-2 quantity" value="1" min="1" max="50" data-price="'.$data['mrp'].'" type="number" style="width: 60px;"><br>
                                                        <button class="btn btn-danger mt-3 rmvitem" data-foodid = "'.$data['id'].'" >Remove From Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }                                    
                                }
                                else if(!isset($_SESSION['user']) && isset($_COOKIE['fooditem'])){
                                    $mrp = 0;
                                    foreach($_COOKIE['fooditem'] as $key => $val){
                                        $sql = "SELECT * FROM food_items where id = $val";
                                        $runsql = mysqli_query($conn,$sql);
                                        while($data = mysqli_fetch_assoc($runsql)){
                                            $mrp += $data['mrp'];
                                            echo '
                                            <div class="card mx-auto my-3 shadow-lg p-3 mb-5 bg-white rounded" style="min-width: 18rem;">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                        <img src="backend/'.$data['food_img'].'" alt="...">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">'.$data['food_name'].'</h5>
                                                            <p><i class="fa fa-inr mr-2" aria-hidden="true"></i><input readonly class="price" name="price" type="text" value="'.$data['mrp'].'" style="border: none; outline: none;"></p>
                                                            <input class="pl-2 quantity" value="1" min="1" max="50" data-price="'.$data['mrp'].'" type="number" style="width: 60px;"><br>
                                                            <button class="btn btn-danger mt-3 rmvcookie" data-cookieid = "'.$key.'" >Remove From Cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            ';
                                        }
                                    }
                                }
                                else if(isset($_SESSION['user']) && $_SESSION['user']['usertype'] == "customer" && isset($_COOKIE['fooditem'])){
                                    foreach($_COOKIE['fooditem'] as $key => $val){
                                        setcookie('fooditem['.$key.']',''.$val.'',time()-3600,"/");
                                    }
                                    $mrp = 0;
                                    $cust_id = $_SESSION['user']['custid'];
                                    $sql = "SELECT * FROM cart where customer_id = $cust_id";
                                    $runsql = mysqli_query($conn,$sql);
                                    while($data = mysqli_fetch_assoc($runsql)){
                                        $mrp += $data['mrp'];
                                        echo '
                                        <div class="card mx-auto my-3 shadow-lg p-3 mb-5 bg-white rounded" style="min-width: 18rem;">
                                            <div class="row no-gutters">
                                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                    <img src="backend/'.$data['img'].'" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">'.$data['food_item'].'</h5>
                                                        <p><i class="fa fa-inr mr-2" aria-hidden="true"></i><input readonly class="price" name="price" type="text" value="'.$data['mrp'].'" style="border: none; outline: none;"></p>
                                                        <input class="pl-2 quantity" value="1" min="1" max="50" data-price="'.$data['mrp'].'" type="number" style="width: 60px;"><br>
                                                        <button class="btn btn-danger mt-3 rmvitem" data-foodid = "'.$data['id'].'" >Remove From Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    } 
                                }
                                else{
                                    echo "No Product Selected";
                                }
                                // echo $mrp;
                            ?>                                                      
                        </div>
                    </div>
                </div>
                <div class="col-5"">
                    <?php
                        if(isset($_SESSION['user']) && $_SESSION['user']['usertype'] == "customer" && !isset($_COOKIE['fooditem'])){
                            $gst = ($mrp*12)/100;
                            $total = $mrp+$gst; 
                        echo' 
                            <div class="card shadow-lg my-3" style="min-width: 15rem;" >
                                <div class="card-header bg-transparent">Price Details</div>
                                    <div class="card-body ">
                                        <table class="w-100">
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>Price</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="mrp" value="'.$mrp.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>GST</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="gst" value="'.$gst.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>Total Price</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="total" value="'.$total.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer bg-transparent border-success"><a href="#" class="btn btn-warning btn-block checkout">Check Out</a></div>
                                </div>
                            </div>';
                        }
                        else if(isset($_COOKIE['fooditem'])){
                            $gst = ($mrp*12)/100;
                            $total = $mrp+$gst; 
                           echo' 
                            <div class="card shadow-lg my-3" style="min-width: 15rem;">
                                <div class="card-header bg-transparent">Price Details</div>
                                    <div class="card-body ">
                                        <table class="w-100">
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>Price</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="mrp" value="'.$mrp.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>GST</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="gst" value="'.$gst.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>Total Price</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="total" value="'.$total.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer bg-transparent border-success"><a href="#" class="btn btn-warning btn-block checkout">Check Out</a></div>
                                </div>
                            </div>';
                        }else if(isset($_SESSION['user']) && $_SESSION['user']['usertype'] == "customer" && isset($_COOKIE['fooditem'])){
                            $gst = ($mrp*12)/100;
                            $total = $mrp+$gst; 
                           echo' 
                            <div class="card shadow-lg my-3" style="min-width: 15rem;">
                                <div class="card-header bg-transparent">Price Details</div>
                                    <div class="card-body ">
                                        <table class="w-100">
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>Price</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="mrp" value="'.$mrp.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>GST</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="gst" value="'.$gst.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                            <tr class="d-flex justify-content-between py-3">
                                                <td>Total Price</td>
                                                <td><i class="fa fa-inr mr-2" aria-hidden="true"><input readonly id="total" value="'.$total.'" type="text" style="width
                                                :80px; border: none; outline: none;"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer bg-transparent border-success"><a href="#" class="btn btn-warning btn-block checkout">Check Out</a></div>
                                </div>
                            </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- ---------------------------------menu modal----------------------------------------- -->
    <div class="modal" id="menumodal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content bg-color1">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li class="text-center py-3"><a href="index.php" class="text-white">Home</a></li>
                    <li class="text-center py-3"><a href="foodjunction.php" class="text-white">Food Junction</a></li>
                    <li class="text-center py-3"><a href="index.php#todayspecial" class="text-white">Today's Special</a></li>
                    <li class="text-center py-3"><a href="cart.php" class="text-white">cart</a></li>
                    <li class="text-center py-3"><a href="login.php" class="text-white">login/signup</a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <?php include 'customerreglog.php' ?>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/custom.js"></script>
    <script src="./js/customajax.js"></script>
    
</body>
</html>