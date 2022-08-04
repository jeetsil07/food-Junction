<?php
    session_start();
    include 'db.php';
    $bannersql = "SELECT * FROM banner";
    $runbannersql = mysqli_query($conn,$bannersql);

    $servicesql = "SELECT * FROM service";
    $runservicesql = mysqli_query($conn,$servicesql);

    $partnerssql = "SELECT * FROM partners";
    $runpartnerssql = mysqli_query($conn,$partnerssql);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Resturant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <section id="header">
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
                            <li><a href="#todayspecial" class="text-white px-4">Today's Special</a></li>
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
                    <li class="text-center py-3"><a href="#todayspecial" class="text-white">Today's Special</a></li>
                    <li class="text-center py-3"><a href="cart.php" class="text-white">cart</a></li>
                    <li class="text-center py-3"><a href="login.php" class="text-white">login/signup</a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      
    <section id="food-banner">
        <div id="layer">
            <div id="bannercontent" class="text-center">
                <h2 class="my-5">Search Your Favourite food from here</h2>
                <form class="form-inline my-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-10 col-9 p-0">
                                <input class="form-control w-100" type="search" placeholder="Search Your Favourite Food" aria-label="Search">
                            </div>
                            <div class="col-lg-2 col-3 p-0">
                                <button class="btn btn-success w-100" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row slides">
                <?php
                    while($data = mysqli_fetch_assoc($runbannersql)){
                        echo '
                            <div class="slide">
                                <img class="img-fluid w-100" src="backend/'.$data['img'].'" alt="">
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </section>
    <section id="todayspecial" class="py-5">
        <div class="container">
            <h2 class="text-center m-5">Today's Special Offer</h2>
            <div class="row special">
                <div class="slide">
                    <div class="card-food text-center my-3">
                        <img class="w-100 img-fluid"  src="./images/egg.jpg" alt="">
                        <div class="food-details  p-2">
                            <p>Food item</p>
                            <p>mrp Rs. 250/-</p>
                            <a class="btn btn-block btn-outline-secondary m-1">Add To Cart</a>
                            <a class="btn btn-block btn-outline-secondary m-1">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="card-food text-center my-3">
                        <img class="w-100 img-fluid"  src="./images/pst.jpg" alt="">
                        <div class="food-details  p-2">
                            <p>Food item</p>
                            <p>mrp Rs. 250/-</p>
                            <a class="btn btn-block btn-outline-secondary m-1">Add To Cart</a>
                            <a class="btn btn-block btn-outline-secondary m-1">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                   <div class="card-food text-center my-3">
                        <img class="w-100 img-fluid" src="./images/bur2.jpg" alt="">
                        <div class="food-details  p-2">
                            <p>Food item</p>
                            <p>mrp Rs. 250/-</p>
                            <a class="btn btn-block btn-outline-secondary m-1">Add To Cart</a>
                            <a class="btn btn-block btn-outline-secondary m-1">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="card-food text-center my-3">
                        <img class="w-100 img-fluid"  src="./images/french.jpg" alt="">
                        <div class="food-details  p-2">
                            <p>Food item</p>
                            <p>mrp Rs. 250/-</p>
                            <a class="btn btn-block btn-outline-secondary m-1">Add To Cart</a>
                            <a class="btn btn-block btn-outline-secondary m-1">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="card-food text-center my-3">
                        <img class="w-100 img-fluid"  src="./images/egg.jpg" alt="">
                        <div class="food-details  p-2">
                            <p>Food item</p>
                            <p>mrp Rs. 250/-</p>
                            <a class="btn btn-block btn-outline-secondary m-1">Add To Cart</a>
                            <a class="btn btn-block btn-outline-secondary m-1">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="card-food text-center my-3">
                        <img class="w-100 img-fluid"  src="./images/egg.jpg" alt="">
                        <div class="food-details  p-2">
                            <p>Food item</p>
                            <p>mrp Rs. 250/-</p>
                            <a class="btn btn-block btn-outline-secondary m-1">Add To Cart</a>
                            <a class="btn btn-block btn-outline-secondary m-1">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="card-food text-center my-3">
                        <img class="w-100 img-fluid"  src="./images/egg.jpg" alt="">
                        <div class="food-details  p-2">
                            <p>Food item</p>
                            <p>mrp Rs. 250/-</p>
                            <a class="btn btn-block btn-outline-secondary m-1">Add To Cart</a>
                            <a class="btn btn-block btn-outline-secondary m-1">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>
    <section id="staff" class=" pb-5">
        <div class="container-fluid">
            <h2 class="text-center my-5 py-3">Our Employees</h2>
            <div class="row testimonial">
                <div class="slide my-2">
                    <div class="testi mx-5 my-2 py-3 ">
                        <img class="m-auto" src="./images/testi1.jpg" alt=""width="80%">
                        <div class="staffdetails py-3 border border-2">
                            <h3 class="text-center">Jhon Doe</h3>
                            <p  class="text-center">Main Chef</p>                        
                        </div>
                    </div>
                </div>
                <div class="slide my-2">
                    <div class="testi mx-5 my-2 py-3 ">
                        <img class="m-auto" src="./images/testi5.jpg" alt=""width="80%">
                        <div class="staffdetails py-3 border border-2">
                            <h3  class="text-center">Jhon Doe</h3>
                            <p class="text-center">Main Chef</p>                        
                        </div>
                    </div>
                </div>
                <div class="slide my-2">
                    <div class="testi mx-5 my-2 py-3 ">
                        <img class="m-auto" src="./images/testi2.jpg" alt=""width="80%">
                        <div class="staffdetails py-3 border border-2">
                            <h3 class="text-center">Jhon Doe</h3>
                            <p class="text-center">Main Chef</p>                        
                        </div>
                    </div>
                </div>
                <div class="slide my-2">
                    <div class="testi mx-5 my-2 py-3 ">
                        <img class="m-auto" src="./images/testi3.jpg" alt="" width="80%">
                        <div class="staffdetails py-3 border border-2">
                            <h3 class="text-center">Jhon Doe</h3>
                            <p class="text-center">Main Chef</p>                        
                        </div>
                    </div>
                </div>
                <div class="slide my-2">
                    <div class="testi mx-5 my-2 py-3 ">
                        <img class="m-auto" src="./images/testi4.jpg" alt="" width="80%">
                        <div class="staffdetails py-3 border border-2">
                            <h3 class="text-center">Jhon Doe</h3>
                            <p class="text-center">Main Chef</p>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="service" class="p-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-6">
                    <div class="service-slides">
                        <?php
                            while($data = mysqli_fetch_assoc($runservicesql)){
                                echo '
                                    <div class="slide">
                                        <img class="img-fluid w-100" src="backend/'.$data['img'].'" alt="">
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-8 p-5">
                    <h2 class="text-justify">Our Service</h2>
                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi asperiores repellat praesentium distinctio ad, enim minima fugit quidem, voluptatem neque saepe quia quam magnam expedita nobis animi veniam maiores. Doloremque facere fuga error nemo ratione quam itaque eveniet at aliquid? Sequi voluptate, labore soluta corrupti, omnis qui in dicta non magnam aliquam impedit quisquam, minima temporibus iure vero quo! Qui laborum consectetur rem molestias, inventore in, enim nisi a quod magnam, alias modi eligendi labore sit. Itaque vel eligendi vitae iusto mollitia incidunt nesciunt fugit officiis nostrum dolores? Maiores, est eos! Quae nihil id repellendus rerum velit ipsum asperiores earum.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="partners" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Official Partners</h2>
            <div class="row partner">
                <?php
                    while($data = mysqli_fetch_assoc($runpartnerssql)){
                        echo '
                            <div class="col d-flex align-items-center slide m-2">
                                <img class="img-fluid" src="backend/'.$data['img'].'" alt="" width="50%" height="50%">
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </section>
    <section id="footer" class="bg-color3 px-3">
        <div class="container-fluid">
            <h2 class="text-center p-5">Contact Us</h2>
            <div class="row align-items-center justify-content-around">
                <div class="col">
                    <div class="social-icons d-flex justify-content-around">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    </div>
                    <div class="my-5">
                        <form id="subscribeform" class="form-inline my-2 my-lg-0">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-9 p-0">
                                        <input class="form-control w-100" type="search" placeholder="Enter Email and Subscribe" aria-label="Search">
                                    </div>
                                    <div class="col-3 p-0">
                                        <button class="btn bg-color1 w-100" type="submit">Subscribe</button>
                                    </div>
                                </div>
                            </div>                           
                        </form>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.4341286915023!2d88.3450098147507!3d22.749264832196378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89b1ec3cd6ac5%3A0xc2e39fbe14d31ac5!2sSerampore%20Battala!5e0!3m2!1sen!2sin!4v1656485703715!5m2!1sen!2sin" width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col d-flex justify-content-center mt-md-0 mt-5">
                    <form id="contactform">
                        <div class="form-row">
                          <div class="col py-2">
                            <input type="text" class="form-control" id="fname"  name="fname" placeholder="First name" required>
                          </div>
                          <div class="col py-2">
                            <input type="text" class="form-control" id="lname"  name="lname" placeholder="Last name" required>
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 py-2">
                            <input type="email" class="form-control" id="email"  name="email" placeholder="Email id @gmail.com" required>

                            </div>
                            <div class="col-12 py-2">
                                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Give your feedback" required></textarea>
                            </div>
                        </div>
                        <input type="submit" value="Send" id="send" name="send" class="btn bg-color1 btn-block py-2">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-center mt-5"><small>&copy; Copyright 2022, JEET SIL. All Right Reserved</small></p>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/custom.js"></script>
</body>
</html>