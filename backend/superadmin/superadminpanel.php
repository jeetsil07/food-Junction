<?php
    // session_start();
    $title = "Super Admin Panel";
    include '../panellayout1.php';
?>
            <div class="container">
                <div class="row">                    
                    <div class="col">
                        <h1 class="my-3 text-center">Welcome <?php echo $_SESSION['user']['name'] ?></h1>
                    </div>
                </div>
            </div>
           
<?php
    include '../panellayout2.php';
?>