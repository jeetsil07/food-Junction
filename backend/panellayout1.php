<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../css/slick.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <section id="r" class="bg-color1 stillheader">
        <div class="container-md container-fluid px-md-0 p-2">
            <div class="row align-items-center justify-content-between">
                <div class="col-2" id="logo">
                    <img class="img-fluid rounded-circle" src="<?php echo '../'.$_SESSION['user']['img']; ?>" alt="" width="50">
                </div>
                <div class="col d-lg-block d-none">
                    <div class="row">
                        <ul class="d-flex ml-auto align-items-center list-unstyled my-0">
                            <li><a href="../../index.php" class="text-white px-4">Home</a></li>
                            <li><a href="../../foodjunction.php" class="text-white px-4">Food Junction</a></li>
                            <li><a href="../../index.php#todayspecial" class="text-white px-4">Today's Special</a></li>
                            <li><a href="../../cart.php" class="text-white px-4">cart</a></li>
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
    <section class="usercontent">
        <div class="sidemenu">
            <button class=" d-block btn  sidemenubtn">
                <span class="menuicon bg-dark"></span>
                <span class="menuicon bg-dark"></span>
                <span class="menuicon bg-dark"></span>
            </button>
        </div>
        <div class="sidebar">
            <button class="ml-auto d-block btn sidemenubtn">
                <span class="menuicon bg-white"></span>
                <span class="menuicon bg-white"></span>
                <span class="menuicon bg-white"></span>
            </button>
            <ul class="list-unstyled">
                <li class="my-5 pl-2"><a class="text-white" href="superadminpanel.php"><i class="mr-2 fa fa-home" aria-hidden="true"></i> Home</a></li>
                <li class="my-5 pl-2"><a class="text-white" href="product.php"><i class="mr-2 fa fa-cutlery" aria-hidden="true"></i> Product</a></li>
                <li class="my-5 pl-2"><a class="text-white" href="employee.php"><i class="mr-2 fa fa-users" aria-hidden="true"></i> Employees</a></li>
                <li class="my-5 pl-2"><a class="text-white" href="maintain.php"><i class="mr-2 fa fa-line-chart" aria-hidden="true"></i> Maintainance</a></li>
                <li class="my-5 pl-2"><a class="text-white" href="../logout.php"><i class="mr-1 fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
        </div>
