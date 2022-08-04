<?php
    include 'db.php';
    if(isset($_POST['catid']) && $_POST['fooditem'] == true){
        $catid = $_POST['catid'];
        $sql = "SELECT * FROM food_items WHERE food_cat = $catid";
        // echo $sql;
        $runsql = mysqli_query($conn,$sql);

        $output = '';
        while($data = mysqli_fetch_assoc($runsql)){
            $output .='
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="backend/'.$data['food_img'].'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'.$data['food_name'].'</h5>
                            <p class="card-text"><i class="fa fa-inr mr-2" aria-hidden="true"></i>'.$data['mrp'].'</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-block btn-outline-success food-cart" data-foodid="'.$data['id'].'">Add To Cart</a>
                        </div>
                    </div>
                </div>
            ';
        } 
        echo $output;
    }
    // <a href="#" class="btn btn-block btn-outline-success">Order Now</a>

?>