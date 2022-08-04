<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
</head>
<body>
    <h1>Hello  <?php echo $_SESSION['user']['name']; ?></h1>
    <img src="<?php echo '../'.$_SESSION['user']['img']; ?>" alt="">

    <?php
        unset($_SESSION['user']);
    ?>
</body>
</html>