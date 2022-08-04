<?php
    date_default_timezone_set('Asia/Kolkata');
    // session_start();
    $title = "Product";
    include "../../db.php";
    $action="";
    $msg="";
  // -----------------------Insert Food Category With Upload image File-----------------------------------
    if(isset($_POST['foodcatsubmit'])){
      $food_cat = mysqli_real_escape_string($conn,$_POST['categoryname']);
      // print_r($_FILES['catimg']);
      $filename = $_FILES['catimg']['name'];
      $tmp_name = $_FILES['catimg']['tmp_name'];
      $size = $_FILES['catimg']['size'];

      $exe = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
      // echo $exe;
      if($exe == 'jpg' || $exe == 'jpeg' || $exe == 'png'){
          if($size <= 1024*200){
            // echo "ok";
              $filename= date('Y-m-d').'_'.uniqid().'.'.$exe;
              $path = "../foodimages/category/".$filename;
              $dbpath = "foodimages/category/".$filename;
              move_uploaded_file($tmp_name,$path);
              $sql = "INSERT INTO food_category (food_cat,cat_img) values('$food_cat','$dbpath')";
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
            $msg = "Image size should be under 20kb";
          }
      }else{
        $action ="danger";
        $msg = "Only jpg/png/jpeg files required";
      }
    }
    // ---------------------------------Insert Food items---------------------------------------------------------
    if(isset($_POST['fooditemsubmit'])){
      $food_name = mysqli_real_escape_string($conn,$_POST['foodname']);
      $food_cat = mysqli_real_escape_string($conn,$_POST['foodcat']);
      $mrp = mysqli_real_escape_string($conn,$_POST['mrp']);
      $gst = mysqli_real_escape_string($conn,$_POST['gst']);
      $created_by = mysqli_real_escape_string($conn,$_POST['creater']);
      // print_r($_FILES['foodimg']);
      $filename = $_FILES['foodimg']['name'];
      $tmp_name = $_FILES['foodimg']['tmp_name'];
      $size = $_FILES['foodimg']['size'];

      $exe = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
      // echo $exe;
      if($exe == 'jpg' || $exe == 'jpeg' || $exe == 'png'){
          if($size <= 1024*200){
            // echo "ok";
              $filename= date('Y-m-d').'_'.uniqid().'.'.$exe;
              $path = "../foodimages/fooditems/".$filename;
              $dbpath = "foodimages/fooditems/".$filename;
              move_uploaded_file($tmp_name,$path);
              $created_at = date('Y-m-d h:i:s',strtotime('now'));
              $sql = "INSERT INTO food_items (food_name,food_cat,mrp,gst,food_img ,created_at,created_by ) values
              ('$food_name',$food_cat,$mrp,$gst,'$dbpath','$created_at','$created_by')";
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
            $msg = "Image size should be under 20kb";
          }
      }else{
        $action ="danger";
        $msg = "Only jpg/png/jpeg files required";
      }
      $_SESSION['alert']=['action'=>$action,'msg'=>$msg];
    }


    // $_SESSION['alert']=['action'=>$action,'msg'=>$msg];
//  -------------------------------------------------------------------------------------------------   
    $sql = "SELECT * FROM food_category";
    $runsql = mysqli_query($conn,$sql);
    include '../panellayout1.php';
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
            <h1 class="text-center mb-2">All Food ITEMS</h1>
            <a href="#" class="btn btn-primary mb-3" id="addfoodbtn">Add Food Items</a>
            <a href="#" class="btn btn-warning mb-3" id="addfoodcatbtn">Add Food Category</a>
            <!-- <a href="#" class="btn btn-success mb-3" id="showproducttable">Show Product Table</a> -->
            <div class="row">
                <div class="col table-responsive" id="producttablecontainer">
                    
                </div>
            </div>
        </div>
    <!-- --------------------------------------Register Food Item-------------------------------   -->
    <div class="modal " tabindex="-1" id="foodregform">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register Food Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="foodname">Food Item</label>
                        <input name="foodname" required type="text" class="form-control" id="foodname">
                        <small class="form-text text-muted">Enter the Food Item name</small>
                      </div>
                      <div class="form-group">
                        <label for="foodcat">Example select</label>
                        <select class="form-control" name="foodcat" id="foodcat">
                          <?php
                            while($data = mysqli_fetch_assoc($runsql)){
                          ?>
                                <option value="<?= $data['id']; ?>"><?= $data['food_cat']; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="mrp">MRP</label>
                        <input name="mrp" required type="number" class="form-control" id="mrp">
                        <small class="form-text text-muted">Enter the Food Item name</small>
                      </div>
                      <div class="form-group">
                          <label for="gst">GST</label>
                          <input name="gst" required type="number" class="form-control" id="gst">
                        <small class="form-text text-muted">Enter Gst %</small>
                      </div>
                      <div class="form-group">
                        <label for="foodimg">Upload Image</label>
                        <input name="foodimg" required type="file" class="form-control" accept="image/*" id="foodimg">
                        <small class="form-text text-muted">Upload Food Item Image 100*150</small>
                      </div>
                      <div class="form-group">
                        <label for="creater">Created By</label>
                        <input name="creater" required type="text" class="form-control" id="creater">
                      </div>
                      <button type="submit" id="fooditemsubmit" name="fooditemsubmit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <!-- ---------------------------------------Food Category Modal-------------------------- -->
      <div class="modal" tabindex="-1" id="foodcatregform">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Food Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="foodcatform" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="categoryname">Enter Food Category Name</label>
                    <input type="text" class="form-control" name="categoryname" id="categoryname">
                  </div>
                  <div class="form-group">
                    <label for="catimg">Upload Image</label>
                    <input type="file" class="form-control" accept="image/*" name="catimg" id="catimg">
                    <small class="form-text text-muted">Upload Food Item Image 100*200</small>
                  </div>
                  <button type="submit" name="foodcatsubmit" id="foodcatsubmit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- ------------------------------------------Edit Modal--------------------------------------- -->
      <div class="modal" tabindex="-1" id="product-edit-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Food Item Edit Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="producteditform">
              
            </div>
          </div>
        </div>
      </div>

<?php
    include '../panellayout2.php';
?>