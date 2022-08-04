<?php
    //<!-- ------------------------------customer loginmodal-------------------------- -->
    echo '<div class="modal fade" tabindex="-1" id="customer-login-modal">
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
    </div>';

//<!-- ------------------------------customer Registration-------------------------- -->
   echo '<div class="modal fade" tabindex="-1" id="customer-reg-modal">
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
    </div> ';

?>