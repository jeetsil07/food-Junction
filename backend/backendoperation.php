<?php
// ----------------------------------Employee Tables----------------------------
    function showTables($table){
        include '../db.php';
        $output='';
        $limit = 3;
        $page =0;
        if(isset($_POST['page_no'])){
            $page = $_POST['page_no'];
        }else{
            $page = 1;
        }
        $start = ($page -1)*$limit;
        $sql = "SELECT EMP.id, EMP.name, EMP.email, EC.emp_cat, EMP.created_at, EMP.created_by, EMP.img FROM $table EMP  INNER JOIN employee_category EC ON EMP.category = EC.id LIMIT $start, $limit";
        $runsql = mysqli_query($conn,$sql);
        $output .= '
            <table class="table table-striped table-dark table table-bordered">
                <thead class="bg-color1">
                    <tr>
                    <th scope="col">Sl. No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Category</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>                    
        ';
        if(mysqli_num_rows($runsql)>0){
            $i = $start;
            while($data = mysqli_fetch_assoc($runsql)){
                $i++;
                $output .= '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$data['name'].'</td>
                        <td>'.$data['email'].'</td>
                        <td>'.$data['emp_cat'].'</td>
                        <td>'.$data['created_at'].'</td>
                        <td>'.$data['created_by'].'</td>
                        <td>
                            <img class="img-fluid" src="../'.$data['img'].'" alt="" width="50" height="50">
                        </td>
                        <td>
                            <button class="btn btn-danger '.$table.'dlbtn" data-'.$table.'id="'.$data['id'].'">Delete</button>
                        </td>
                        <td>
                            <button class="btn btn-warning '.$table.'editbtn" data-'.$table.'id="'.$data['id'].'">edit</button>
                        </td>
                    </tr>
                ';
            }
            $output .='
                </tbody>
              </table>  
            ';
            
            $output .= '
            <ul class="pagination">';
                if($page > 1){
                        $output .='<li class="page-item"><a class="page-link '.$table.'epno" id="'.($page-1).'" href="#">Previous</a></li>';
                }                       
                $sql = "SELECT * FROM $table";
                $runsql = mysqli_query($conn, $sql);
                $totaldata = mysqli_num_rows($runsql);
                $totalpage = ceil($totaldata/$limit); 
                for($i = 1 ; $i <= $totalpage ; $i++){
                    if($i == $page){
                        $active = 'bg-color1';
                    }else{
                        $active ='';
                    }
                    $output .= '<li  class="page-item "><a class="page-link '.$table.'epno '.$active.'" href="#" id="'.$i.'">'.$i.'</a></li>';
                } 
                if($page < $totalpage){
                    $output .= '<li class="page-item"><a class="page-link '.$table.'epno" id="'.($page+1).'" href="#">Next</a></li>';
                }                           
                    
            $output .= '</ul>';

        }else{
            $output .= '            
                <tr>
                    <td colspan="8">No Record Found</td>
                </tr>
            </tbody>
        </table> ';
        }    
        echo $output;
    }
    
    
    if(isset($_POST['show']) && $_POST['show'] == 'superadmin'){
        showTables('super_admin');
    }
    if(isset($_POST['show']) && $_POST['show'] == 'admin'){
        showTables('admin');
    }
    if(isset($_POST['show']) && $_POST['show'] == 'staff'){
        showTables('staff');
    }
    if(isset($_POST['show']) && $_POST['show'] == 'deliveryagent'){
        showTables('deliveryagent');
    }
    // -----------------------------------------------------------------------------------------------
    if(isset($_POST['show']) && $_POST['show'] == 'food_items'){
        include '../db.php';
        $limit = 5;
        $page = 0;
        $output = '';
        if(isset($_POST['page_no'])){
            $page = $_POST['page_no'];
        }else{
            $page = 1;
        }  
        $start = ($page - 1) * $limit;
        
        $sql = "SELECT * FROM food_items LIMIT $start, $limit";
        $runsql = mysqli_query($conn, $sql);
        $totaldata = mysqli_num_rows($runsql);
        
        $output .= '<table class="table table-striped table-dark">
                        <thead>
                            <tr class="bg-color1">
                                <th scope="col">Sl no.</th>
                                <th scope="col">Food Item</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Created BY</th>
                                <th scope="col">Image</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                            
        if($totaldata > 0){
            $i = $start;
            while($data = mysqli_fetch_assoc($runsql)){
                $i++;
                $output .= '<tr>
                                <td>'.$i.'</td>
                                <td>'.$data['food_name'].'</td>
                                <td>'.$data['food_cat'].'</td>
                                <td>'.$data['mrp'].'</td>
                                <td>'.$data['created_at'].'</td>
                                <td>'.$data['created_by'].'</td>
                                <td><img class="img-thumbnail" src="../'.$data['food_img'].'" alt="" width="50" height="50"></td>    
                                <td><button class="btn btn-warning peditbtn" data-pid="'.$data['id'].'">Edit</button></td>
                                <td><button class="btn btn-danger pdltbtn" data-pid="'.$data['id'].'">Delete</button></td>
                            </tr>
                            ';
            }
                $output .= '</tbody>
                        </table>';
            $output .= '
                        <ul class="pagination">';
            if($page > 1){
                    $output .='<li class="page-item"><a class="page-link ppno" id="'.($page-1).'" href="#">Previous</a></li>';
            }                       
            $sql = "SELECT * FROM food_items";
            $runsql = mysqli_query($conn, $sql);
            $totaldata = mysqli_num_rows($runsql);
            $totalpage = ceil($totaldata/$limit); 
            for($i = 1 ; $i <= $totalpage ; $i++){
                if($i == $page){
                    $active = 'bg-color1';
                }else{
                    $active ='';
                }
                $output .= '<li  class="page-item "><a class="page-link ppno '.$active.'" href="#" id="'.$i.'">'.$i.'</a></li>';
            } 
            if($page < $totalpage){
                $output .= '<li class="page-item"><a class="page-link ppno" id="'.($page+1).'" href="#">Next</a></li>';
            }                           
                
                $output .= '</ul>';


        }else{
                        $output .= '
                                    <tr>
                                        <td colspan="5">Record Not Found</td>
                                    </tr>
                                </tbody>   
                        </table>';
        }
        echo $output;                    
    }
?>