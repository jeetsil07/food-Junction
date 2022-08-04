<?php
    include '../db.php';
    if(isset($_POST['pid']) && $_POST['pid'] == true){
        $id = $_POST['pid'];
        $output = '';
        $sql = "SELECT * FROM food_items WHERE id = $id";
        $runsql = mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($runsql);
        $output .= '<form id="proucteditform">
                        <div class="form-group">
                            <label for="ufoodname">Food Name</label>
                            <input type="text" class="form-control" value="'.$data['food_name'].'" name="ufoodname" id="ufoodname">
                        </div>
                        <div class="form-group">';
                        $catsql = "SELECT * FROM food_category";
                        $catrunsql = mysqli_query($conn,$catsql);
                        
                 $output .='<label for="ufoodcategory">Select Food Category</label>
                            <select class="form-control" id="ufoodcat">';
                            while($catdata = mysqli_fetch_assoc($catrunsql)){
                                $output .= '<option value="'. $catdata['id'].'">'.$catdata['food_cat'].'</option>';
                            }
                $output .= '</select>
                        </div>
                        <div class="form-group">
                            <label for="ufoodmrp">Mrp</label>
                            <input type="number" class="form-control" value="'.$data['mrp'].'" id="ufoodmrp">
                        </div>
                        <div class="form-group">
                            <label for="ufoodgst">Gst</label>
                            <input type="number" class="form-control" value="'.$data['gst'].'" id="ufoodgst">
                        </div>
                        <button type="submit" name="foodedit" id="foodedit" data-foodeditid="'.$data['id'].'" class="btn btn-primary">Upate</button>
                    </form>';
                
        echo $output;
    }
    // ------------------------------------------------Edit & store Updated Food Items--------------------------------------------
    if(isset($_POST['edit']) && $_POST['edit'] == 'fooditems'){
        $food_name = $_POST['ufoodname'];
        $food_cat = $_POST['ufoodcat'];
        $mrp = $_POST['ufoodmrp'];
        $gst = $_POST['ufoodgst'];
        $id = $_POST['foodedit'];
        $sql = "UPDATE food_items SET food_name = '$food_name' ,food_cat = '$food_cat' ,mrp = $mrp ,gst = $gst  WHERE id = $id";
        $runsql = mysqli_query($conn,$sql);
        if($runsql){
            echo "successfull update";
        }
    }
    // -----------------------------------------------------Delete----------------------------------------------------------------
    if(isset($_POST['delete']) && $_POST['delete'] == true){
        $id = $_POST['dfoodid'];
        $imgsql = "SELECT food_img FROM food_items WHERE id = $id";
        $imgrunsql = mysqli_query($conn,$imgsql);
        $imgdata = mysqli_fetch_assoc($imgrunsql);
        unlink($imgdata['food_img']);

        $sql = "DELETE FROM food_items WHERE id = $id";
        $runsql = mysqli_query($conn,$sql);
        if($runsql){
            echo "successfull data Deleted";
        }
    }
    // -----------------------------------------------empeditform function() ---------------------------------------
    function empeditform($table,$id){
        include '../db.php';
        $sql = "SELECT EMP.id, EMP.name, EMP.email, EC.emp_cat FROM $table EMP  INNER JOIN employee_category EC ON EMP.category = EC.id WHERE EMP.id = $id";
        $runsql = mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($runsql);
        $output ='';
        $output .= '
                    <form>
                        <div class="form-group">
                            <label for="uempname">Employee Name</label>
                            <input type="text" class="form-control" id="uempname" value="'.$data['name'].'" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="uempemail">Employee Email</label>
                            <input type="email" class="form-control" id="uempemail" value="'.$data['email'].'" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="uempcat">Employee Name</label>
                            <input readonly type="text" class="form-control" id="uempcat" value="'.$data['emp_cat'].'" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" name="'.$table.'editsubmit" id="'.$table.'editsubmit" data-'.$table.'editid="'.$data['id'].'" class="btn btn-primary">Upate</button>
                    </form>

        ';
        echo $output;
    }
    // -------------------------------------Employee Edit Confirmation function()-------------------------------------------
    function empeditconfirmation($table){
            include '../db.php';
            $name = $_POST['uempname'];
            $email = $_POST['uempemail'];
            $empid = $_POST['empid'];

            $sql = "UPDATE $table SET name = '$name', email = '$email' WHERE id= $empid";
            $runsql = mysqli_query($conn,$sql);
            if($runsql){
                echo "Employee Upation successfull";
            }else{
                echo "Employee updation Unsuccesfull Tyry Again later";
            }
        
    }
    //--------------------------------Edit Employee update--------------------------------
    if(isset($_POST['staffedit']) && $_POST['staffedit'] == true){
        // echo $_POST['staffid'];
        empeditform('staff',$_POST['staffid']);
    }
    if(isset($_POST['adminedit']) && $_POST['adminedit'] == true){
        // echo $_POST['adminid'];
        empeditform('admin',$_POST['adminid']);
    }
    if(isset($_POST['superadminedit']) && $_POST['superadminedit'] == true){
        // echo $_POST['adminid'];
        empeditform('super_admin',$_POST['superadminid']);
    }
    if(isset($_POST['superadminedit']) && $_POST['superadminedit'] == true){
        // echo $_POST['adminid'];
        empeditform('deliveryagent',$_POST['deliveryagentid']);
    }
    // --------------------------------update & store Employeedetails------------------------
    if(isset($_POST['edit']) && $_POST['edit']=='editstaffdetails'){
        empeditconfirmation('staff');
    }
    if(isset($_POST['edit']) && $_POST['edit']=='editadmindetails'){
        empeditconfirmation('admin');
    }
    if(isset($_POST['edit']) && $_POST['edit']=='editsuperadmindetails'){
        empeditconfirmation('super_admin');
    }
    if(isset($_POST['edit']) && $_POST['edit']=='editsuperadmindetails'){
        empeditconfirmation('deliveryagent');
    }
?>