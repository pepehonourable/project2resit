<?php
    include "header.php";
    include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Main</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="stylesheet.css" type="text/css">
    </head>
    <body>
        <div class="content">
            <h1>Main</h1>
            <div class="product">
            <form name="sort" action="" method="post">
            <select name="order">
                <option value="">Sort by</option>
                <option value="Title Asc">Name Asc</option>
                <option value="Title Desc">Name Desc</option>
                <option value="Price Asc">Price Asc</option>
                <option value="Price Desc">Price Desc</option>
            </select>
            <input type="submit" value="Sort"/>
            </form>
                <?php
                    $sort = @$_POST['order']; 
                    if (!empty($sort)) { 
                        $sql = "SELECT * FROM product ORDER BY ".$sort."";
                        $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                            echo "<li>Album: " . $row["Title"] . "<br>Description: " . $row["Description"] . "<br> Category: ". $row["Category"] . "<br>Price: €" . $row["Price"]. "</li>";
                            } 
                            } else { 
                            $sql = "SELECT * FROM product ORDER BY Title Asc";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                            echo "<li>Album: " . $row["Title"] . "<br>Description: " . $row["Description"] . "<br>Category: ". $row["Category"] . "<br>Price: €" . $row["Price"]. "</li>";
                            }}
                ?>
            </div>
        </div>
    </body>
</html>