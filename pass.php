<?php
    echo password_hash('jeet',PASSWORD_DEFAULT).'<br>';
    echo password_hash('superadmin',PASSWORD_DEFAULT).'<br>';
    echo password_hash('admin',PASSWORD_DEFAULT);
?>

<?php
    // function loginform($usertype,$formname){
    //     echo '
        // <form>
        //     <div class="form-group" id="'.$formname.'">
        //         <label for="email">Email address</label>
        //         <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
        //         <small id="emailHelp" class="form-text text-muted">We never share your email with anyone else.</small>
        //     </div>
        //     <div class="form-group">
        //         <label for="pass">Password</label>
        //         <input type="password" class="form-control" id="pass">
        //     </div>
        //     <button type="submit" id="'.$usertype.'" class="btn btn-primary">Submit</button>
        // </form>';
    // }
?>
<?php// function modals($modaltype, $modaltitle,$usertype,$formname){ ?>
    <!-- <div class="modal fade" tabindex="-1" id="<?php echo $modaltype ?>">
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
                        loginform($usertype,$formname);
                    ?>
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-5">
                            <a href="#">forget password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
 <?php //} ?>   


 <!-- --------------------------super admin login modal------------------------- -->
 <?php //modals('supadm-login-modal', 'Super Admin Login','supadm','supadmform'); ?>
    <!-- --------------------------admin login modal------------------------- -->
    <?php //modals('admin-login-modal', 'Admin Login','adm','admform'); ?>   
    <!-- ---------------------------------------Employee login modal------------------------------------------- -->
    <?php //modals('emp-login-modal', 'Employee Login','emp','empform'); ?>
    <!-- --------------------------------------------Admin Registration form------------------------------- -->
    <!-- <div class="modal fade" tabindex="-1" id="admin-reg-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputname">Name</label>
                            <input type="text" class="form-control" id="exampleInputname" aria-describedby="emailHelp">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                          </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- --------------------------------------------Employee Registration form------------------------------- -->
    <!-- <div class="modal fade" tabindex="-1" id="emp-reg-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Employee Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputname">Name</label>
                            <input type="text" class="form-control" id="exampleInputname" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->