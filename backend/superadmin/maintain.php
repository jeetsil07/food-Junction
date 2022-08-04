<?php
    date_default_timezone_set('Asia/Kolkata');
    // session_start();
    $title = "Maintainance";
    $action="";
    $msg="";
  // --------------------------------------datainsert function-----------------------------------------
  function datainsert($imgfile,$dir,$table){
    include "../../db.php";

    $created_by = mysqli_real_escape_string($conn,$_POST['creater']);
    $filename = $_FILES[$imgfile]['name'];
    $tmp_name = $_FILES[$imgfile]['tmp_name'];

    $exe = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    // echo $exe;
    if($exe == 'jpg' || $exe == 'jpeg' || $exe == 'png'){
      $filename= date('Y-m-d').'_'.uniqid().'.'.$exe;
      $path = "../".$dir.$filename;
      $dbpath = $dir.$filename;
      move_uploaded_file($tmp_name,$path);
      $created_at = date('Y-m-d h:i:s',strtotime('now'));
      $sql = "INSERT INTO $table (img,created_at,created_by ) values
      ('$dbpath','$created_at','$created_by')";
      $runsql = mysqli_query($conn,$sql);
      if($runsql){
        $action = "success";
        $msg = "Insertion Successful...";
      }else{
        $action = "danger";
        $msg = "Cant Insert Data Something Went Wrong...";
      }
    }else{
      $action ="danger";
      $msg = "Only jpg/png/jpeg files required";
    }
  }
    //<!-- -----------------------------------------Modal------------------------------------------------------ -->
    function addon($modalid,$modaltitle,$formid,$inputid,$submitid){
      echo'<div class="modal fade" tabindex="-1" id="'.$modalid.'">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">'.$modaltitle.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form method="POST" id="'.$formid.'" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="'.$inputid.'">Upload Image</label>
                      <input type="file" accept="image/*" class="form-control" name="'.$inputid.'" id="'.$inputid.'">
                    </div>
                    <div class="form-group">
                      <label for="creater">Email address</label>
                      <input type="text" class="form-control" name="creater" id="creater">
                    </div>
                    <button type="submit" name="'.$submitid.'" id="'.$submitid.'" class="btn btn-primary">Upload</button>
                  </form>  
                  </div>
                </div>
              </div>
            </div>';
    }
    
    // ------------------------------------------------------insert modals data---------------------------------
    if(isset($_POST['bannersubmit'])){
      datainsert('bannerimg','maintainance/banner/','banner');      
    }
    if(isset($_POST['servicesubmit'])){
      datainsert('serviceimg','maintainance/service/','service');
    }
    if(isset($_POST['employeesubmit'])){
      datainsert('employeeimg','maintainance/employee/','employee');
    }
    if(isset($_POST['partnersubmit'])){
      datainsert('partnersimg','maintainance/partners/','partners');
    }

    include '../panellayout1.php';
?>
<div class="container" id="maintainance">
    <div class="row">
        <div class="col p-0">
            <ul class="list-unstyled d-flex m-0">
              <li><a href="#" class="d-block p-2 mr-2 rounded text-white bg-primary nav-link">Banner</a>
                <ul class="list-unstyled rounded mt-2 border border-primary">
                  <li><a class="text-primary d-block nav-link p-2" href="#" id="openbannermodalform">Add Slide</a></li>
                  <li><a class="text-primary nav-link d-block p-2" href="#">Banner Details</a></li>
                </ul>
              </li>
              <li><a href="#" class="d-block p-2 mr-2 rounded text-white bg-success">Service</a>
                <ul class="list-unstyled rounded mt-2 border border-success">
                  <li><a class="text-success d-block nav-link p-2" href="#" id="openservicemodalform">Add Slide</a></li>
                  <li><a class="text-success nav-link d-block p-2" href="#">Banner Details</a></li>
                </ul>
              </li>
              <li><a href="#" class="d-block p-2 mr-2 rounded text-white bg-warning">Employees</a>
                <ul class="list-unstyled rounded mt-2 border border-warning">
                  <li><a class="text-warning d-block nav-link p-2" href="#" id="openemployeemodalform">Add Slide</a></li>
                  <li><a class="text-warning nav-link d-block p-2" href="#">Banner Details</a></li>
                </ul>
              </li>
              <li><a href="#" class="d-block p-2 mr-2 rounded text-white bg-info">Partners</a>
                <ul class="list-unstyled rounded mt-2 border border-info">
                  <li><a class="text-info d-block nav-link p-2" href="#" id="openpartnermodalform">Add Slide</a></li>
                  <li><a class="text-info nav-link d-block p-2" href="#">Banner Details</a></li>
                </ul>
              </li>
            </ul>
        </div>
    </div>
</div>
<?php
    addon('bannermodal','Add Banner Slide','bannerform','bannerimg','bannersubmit');
    addon('servicemodal','Add Service Slide','serviceform','serviceimg','servicesubmit');
    addon('employeemodal','Add Employee Slide','employeeform','employeeimg','employeesubmit');
    addon('partnermodal','Add Partner Slide','partnerform','partnersimg','partnersubmit');
    include '../panellayout2.php';
?>