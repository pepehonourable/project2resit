<?php
    include "header.php";
    include "connect.php";
    session_start();
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
 
	//unset quantity
	unset($_SESSION['quantityArray'])
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
            <form name="sort" action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
            <select name="order">
                <option value="Title Asc">Sort by</option>
                <option value="Title Asc">Name Asc</option>
                <option value="Title Desc">Name Desc</option>
                <option value="Price Asc">Price Asc</option>
                <option value="Price Desc">Price Desc</option>
            </select>
            <input type="submit" value="Sort"/>
            </form>
                <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                    if(isset($_POST['order'])) {
                        if(!empty($_POST['order'])) {
                            $sort = $_POST['order'];
                            $sql = "SELECT * FROM product ORDER BY ".$sort."";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<li>Album: " . $row["Title"] . "<br>Description: " . $row["Description"] . "<br>Category: ". $row["Category"] . "<br>Price: €" . $row["Price"]. "</li>" ."<a href='cartAdd.php?id=".$row['ProductId']."'>Add to Cart</a>";
                            }
                        }
                    }
                    else {
                        $sql = "SELECT * FROM product ORDER BY Title Asc";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<li>Album: " . $row["Title"] . "<br>Description: " . $row["Description"] . "<br>Category: ". $row["Category"] . "<br>Price: €" . $row["Price"]. "</li>" ."<a href='cartAdd.php?id=".$row['ProductId']."'>Add to Cart</a>";
                        }
                    }
                    
                    var_dump($_SESSION['cart']);
                ?>
            </div>
        </div>
    </body>
</html>