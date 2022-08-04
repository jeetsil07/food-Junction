<?php
    function loginform($usertype,$emailid,$passid){
        echo '
        <form>
            <div class="form-group">
                <label for="'.$emailid.'">Email address</label>
                <input type="email" class="form-control" id="'.$emailid.'" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="'.$passid.'">Password</label>
                <input type="password" class="form-control" id="'.$passid.'">
            </div>
            <button type="submit" id="'.$usertype.'" class="btn btn-primary">Submit</button>
        </form>';
    }
?>
<?php function modals($modaltype, $modaltitle,$usertype,$emailid,$passid){ ?>
    <div class="modal fade" tabindex="-1" id="<?php echo $modaltype ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $modaltitle ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        loginform($usertype,$emailid,$passid);
                    ?>
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-5">
                            <a href="#">forget password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php } ?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <section id="loginarea">
        <div id="users">
            <button class="btn supadminbtn btn-danger m-2 btn-lg">Super Admin</button>
            <button class="btn adminbtn btn-success m-2 btn-lg">Admin</button>
            <button class="btn staffbtn btn-primary m-2 btn-lg">Restaurant Staff</button>
            <button class="btn dlbtn btn-warning m-2 btn-lg">Delivery Agent</button>
            <button class="btn customerbtn btn-info m-2 btn-lg">Customer</button>
        </div>       
    </section>
    <!-- --------------------------super admin login modal------------------------- -->
    <?php modals('supadm-login-modal', 'Super Admin Login','supadm','semail','spass'); ?>
    <!-- --------------------------admin login modal------------------------- -->
    <?php modals('admin-login-modal', 'Admin Login','adm','aemail','apass'); ?>   
    <!-- --------------------------Resturant Staff login modal------------------------ -->
    <?php modals('staff-login-modal', 'Restaurant Login','staff','stemail','stpass'); ?>
    <!-- --------------------------Delivary Agent modal------------------------------- -->
    <?php modals('delivery-login-modal', 'Delivery Agent Login','delivery','demail','dpass'); ?>

    <?php include 'customerreglog.php' ?>

    <!-- ------------------------------customer loginmodal-------------------------- -->
    <!-- <div class="modal fade" tabindex="-1" id="customer-login-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">customer Login Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="customerloginform">
                        <div class="form-group">
                            <label for="customeremailid">Email address</label>
                            <input type="email" class="form-control" id="customeremailid" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="customerpass">Password</label>
                            <input type="password" class="form-control" id="customerpass">
                        </div>
                        <button type="submit" id="customerlogsubmit" class="btn btn-primary">Submit</button>
                    </form>
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-5">
                            <a href="#">forget password</a>
                            <a href="#" class="ml-2" id="customer-signup">Signup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<!-- ------------------------------customer Registration-------------------------- -->
<!-- <div class="modal fade" tabindex="-1" id="customer-reg-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Registration Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="customerregform">
                        <div class="form-group">
                            <label for="customername">Name</label>
                            <input type="text" class="form-control" id="customername" name="customername">
                        </div>
                        <div class="form-group">
                            <label for="customeremail">Email address</label>
                            <input type="email" class="form-control" id="customeremail" name="customeremail" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="customerpass">Password</label>
                            <input type="password" class="form-control" id="customerpass" name="customerpass">
                        </div>
                        <div class="form-group">
                            <label for="customerimg">Upload Image</label>
                            <input type="file" class="form-control" id="customerimg" name="customerimg" accept="image/*">
                        </div>
                        <input type="submit" id="customerregsubmit" value="Submit" name="customerregsubmit" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    

    <div class="homeicon">
        <a class="text-dark" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/custom.js"></script>
    <script src="./js/customajax.js"></script>
    
</body>
</html>