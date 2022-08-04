<?php
$title = "Employee";
date_default_timezone_set('Asia/Kolkata');
// session_start();
include "../../db.php";
$action="";
$msg="";

// ---------------------------------------------Insert Employee---------------------------------------------
if(isset($_POST['empsubmitbtn'])){
    // echo 'ok';
    $emp_name = mysqli_real_escape_string($conn,$_POST['empname']);
    $emp_cat = mysqli_real_escape_string($conn,$_POST['empcat']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,password_hash($_POST['pass'],PASSWORD_DEFAULT));
    $cpass = mysqli_real_escape_string($conn,password_hash($_POST['cpass'],PASSWORD_DEFAULT));
    $created_by = mysqli_real_escape_string($conn,$_POST['creater']);
    // print_r($_FILES['empimg']);
    $filename = $_FILES['empimg']['name'];
    $tmp_name = $_FILES['empimg']['tmp_name'];
    $size = $_FILES['empimg']['size'];

    $exe = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    // echo $exe;
    if($exe == 'jpg' || $exe == 'jpeg' || $exe == 'png'){           
        $filename= date('Y-m-d').'_'.uniqid().'.'.$exe; 
        if($emp_cat == 1){
            $path = "../empimages/superadmin/".$filename;
            $dbpath = "empimages/superadmin/".$filename;
            move_uploaded_file($tmp_name,$path);
            $created_at = date('Y-m-d h:i:s',strtotime('now'));
            $sql = "INSERT INTO super_admin (name,email,img,category,pass ,cpass,created_at,created_by ) values
            ('$emp_name','$email','$dbpath',$emp_cat,'$pass','$cpass','$created_at','$created_by')";
            $runsql = mysqli_query($conn,$sql);
            if($runsql){
                $action = "success";
                $msg = "Insertion Successful...";
            }else{
                $action = "danger";
                $msg = "Cant Insert Data Something Went Wrong...";
            }
        }elseif($emp_cat == 2){
            $path = "../empimages/admin/".$filename;
            $dbpath = "empimages/admin/".$filename;
            move_uploaded_file($tmp_name,$path);
            $created_at = date('Y-m-d h:i:s',strtotime('now'));
            $sql = "INSERT INTO admin (name,email,img,category,pass ,cpass,created_at,created_by ) values
            ('$emp_name','$email','$dbpath',$emp_cat,'$pass','$cpass','$created_at','$created_by')";
            $runsql = mysqli_query($conn,$sql);
            if($runsql){
                $action = "success";
                $msg = "Insertion Successful...";
            }else{
                $action = "danger";
                $msg = "Cant Insert Data Something Went Wrong...";
            }
        }elseif($emp_cat == 3){
            $path = "../empimages/staff/".$filename;
            $dbpath = "empimages/staff/".$filename;
            move_uploaded_file($tmp_name,$path);
            $created_at = date('Y-m-d h:i:s',strtotime('now'));
            $sql = "INSERT INTO staff (name,email,img,category,pass ,cpass,created_at,created_by ) values
            ('$emp_name','$email','$dbpath',$emp_cat,'$pass','$cpass','$created_at','$created_by')";
            $runsql = mysqli_query($conn,$sql);
            if($runsql){
                $action = "success";
                $msg = "Insertion Successful...";
            }else{
                $action = "danger";
                $msg = "Cant Insert Data Something Went Wrong...";
            }
        }elseif($emp_cat == 4){
            $path = "../empimages/deliveryagent/".$filename;
            $dbpath = "empimages/deliveryagent/".$filename;
            move_uploaded_file($tmp_name,$path);
            $created_at = date('Y-m-d h:i:s',strtotime('now'));
            $sql = "INSERT INTO deliveryagent (name,email,img,category,pass ,cpass,created_at,created_by ) values
            ('$emp_name','$email','$dbpath',$emp_cat,'$pass','$cpass','$created_at','$created_by')";
            $runsql = mysqli_query($conn,$sql);
            if($runsql){
                $action = "success";
                $msg = "Insertion Successful...";
            }else{
                $action = "danger";
                $msg = "Cant Insert Data Something Went Wrong...";
            }
        }
    }else{
      $action ="danger";
      $msg = "Only jpg/png/jpeg files required";
    }
   $_SESSION['alert']=['action'=>$action,'msg'=>$msg]; 
}
// $_SESSION['alert']=['action'=>$action,'msg'=>$msg];

//   ------------------------------------------------------------------------------------------------------------
$sql = "SELECT * FROM employee_category";
$runsql = mysqli_query($conn,$sql);
include "../panellayout1.php";
?>
<?php
    if(isset($_SESSION['alert'])){
        echo'<div class="alert alert-'.$_SESSION['alert']['action'].' alert-dismissible fade show" role="alert">'.$_SESSION['alert']['msg'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    
    unset($_SESSION['alert']);
 ?>
<div class="container">
    <h1 class="text-center mb-3 abc">Employee Details</h1>
    <a href="#" class="btn btn-primary mb-3" id="addempbtn">Add Employee</a>
    <a href="#" class="btn btn-warning mb-3" id="showsuperadmin">Super Admins</a>
    <a href="#" class="btn btn-danger mb-3" id="showadmin">Admins</a>
    <a href="#" class="btn btn-info mb-3" id="showstaff">Restaurant Staffs</a>
    <a href="#" class="btn btn-success mb-3" id="showdeliveryagent">Delivery Agents</a>
    <div class="row">
        <div class="col table-responsive" id="showemptable">
            
        </div>
    </div>
      <!-- --------------------------------------Register Employees-------------------------------   -->
      <div class="modal fade" tabindex="-1" id="empregformmodal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register Employee Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="empregform" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="empname">Name</label>
                            <input type="text" class="form-control" name="empname" id="empname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="empimg">Upload Image</label>
                            <input type="file" class="form-control" name="empimg" id="empimg" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="empcat">Example select</label>
                            <select class="form-control" name="empcat" id="empcat">
                            <?php
                                while($data = mysqli_fetch_assoc($runsql)){
                            ?>
                                    <option value="<?= $data['id']; ?>"><?= $data['emp_cat']; ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="pass" id="pass">
                        </div>
                        <div class="form-group">
                            <label for="cpass">Confirm Password</label>
                            <input type="password" class="form-control" name="cpass" id="cpass">
                        </div>
                        <div class="form-group">
                            <label for="creater">Created By</label>
                            <input type="text" class="form-control" name="creater" id="creater">
                        </div>
                        <button type="submit" name="empsubmitbtn" id="empsubmitbtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
<!-- --------------------------------------------------Employee Edit modal---------------------------------- -->
<div class="modal" tabindex="-1" id="emp-edit-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Employee Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="empeditformcontainer">
        
      </div>
    </div>
  </div>
</div>

<?php
    include "../panellayout2.php";
?>