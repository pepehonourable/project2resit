<?php
    include "header.php";
    include "connect.php";
    include "utils.php";
    session_start();
    //$_SESSION['Table'] = basename(__FILE__, '.php');
    $_SESSION['Table'] = "orders";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Orders</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="stylesheet.css" type="text/css">
    </head>
    <body>
        <div class="content">
            <h1>Orders</h1>
            <div class="orders">
                <?php
                    order();
                ?>
            </div>
        </div>
    </body>
</html>