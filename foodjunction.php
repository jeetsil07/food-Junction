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
    <title>Food Junction</title>
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
    <!-- ------------------------------------food category------------------------------------------ -->
    <?php
        $sql = "SELECT * FROM food_category";
        $runsql = mysqli_query($conn,$sql);
    ?>
    <section id="foodcategory">
        <div class="container my-5">
            <h1 class="text-center m-5">Food Category</h1>
            <div class="row row-cols-3 row-cols-lg-5">
                <?php
                    while($data = mysqli_fetch_assoc($runsql)){
                        echo '
                            <div class="col mb-4">
                                <div class="card shadow h-100">
                                    <img src="backend/'.$data['cat_img'].'" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$data['food_cat'].'</h5>                            
                                    </div>
                                    <div class="card-footer bg-white">
                                        <a href="#" class="btn btn-block btn-info food-items" data-catid="'.$data['id'].'">Food Items</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- ---------------------------food items modal--------------------------------- -->
    <div class="modal fade food-item-modal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Food Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-3 row-cols-lg-5 fooditem-container">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <li><a href="cart.php" class="text-white px-4"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge badge-pill badge-success ml-2">
                            <?php 
                                if(isset($_COOKIE['item'])){
                                    echo count($_COOKIE['item']); 
                                }else{
                                    echo 0;
                                }
                            ?></span></a></li>
                    <li class="text-center py-3"><a href="login.php" class="text-white">login/signup</a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/custom.js"></script>
    <script src="./js/customajax.js"></script>
</body>
</html>