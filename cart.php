<?php
    include "header.php";
    include "connect.php";
    include "utils.php";
    session_start();
    //$_SESSION['Table'] = basename(__FILE__, '.php');
    $_SESSION['Table'] = "cart";


    if(isset($_POST['createOrder'])){ //check if form was submitted
        $input = $_POST['title']; //get input text
        $message = "Success! You entered: ".$input;
      } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Cart</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="stylesheet.css" type="text/css">
    </head>
    <body>
        <div class="content">
            <form action="<?=$_SERVER['PHP_SELF'];?>" id="myform" method="POST">
                <table>
                    <th>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Unit Price €</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th>Remove item</th>
                        </tr>
                    </th>
                    <?php
                    cart();
                    ?>
                </table>
                <input type='submit' name='createOrder' value='Place order'>
            </form>
        </div>
    </body>
</html>