<?php
    include "header.php";
    include "connect.php";
    include "utils.php";
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
            <table style="width: 100%;">
                <th>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Unit Price €</th>
                        <th>Quantity</th>
                        <th>Total Price €</th>
                    </tr>
                </th>
                <?php
                cart()
                ?>
	</div>
</div>
    </body>
</html>