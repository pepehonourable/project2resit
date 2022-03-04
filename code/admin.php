<?php 
    include ("header.php");
    require_once("conn.php");
    $query = "SELECT * FROM `user`";
    $result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheet.css">
    <title>View All Data</title>
</head>
<body class="backgroundforadmin">
<h1 class="Titlepanel">User Panel</h1>
        <div class="containerusers">
            <div class="row">
                <div class="col m-auto">
                    <div class="card mt-5">
                        <table class="table table-bordered">
                            <tr> 
                                <td class="td"> User ID </td>
                                <td class="td"> User Name </td>
                                <td class="td"> User Email </td>
                                <td class="td"> Edit Data  </td>
                                <td class="td"> Delete </td>
                            </tr>

                            <?php 
                                    
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        $UserID = $row['userId'];
                                        $UserName = $row['userName'];
                                        $UserEmail = $row['usersEmail'];
                                        
                            ?>
                                    <tr>
                                        <td class="td"><?php echo $UserID ?></td>
                                        <td class="td"><?php echo $UserName ?></td>
                                        <td class="td"><?php echo $UserEmail ?></td>
                                        
                                        <td class="td"><a href="updatecustomers.php"class="td" >Edit</a></td>
                                        <td class="td"><a href="admin.php?id=<?php echo $row['userId']; ?>" class="td">Delete</a></td>
                                    </tr>        
                            <?php 
                                    }  
                            ?>                                                                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php   //selects Id from userId and deletes it
 include 'conn.php';  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `user` WHERE userId = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:admin.php');  
      }else{  
           echo "Error: ".mysqli_error($conn);  
      }  
 }  
 ?>  
 <?php 

require_once("conn.php");
$query = "SELECT * FROM `product`";
$result = mysqli_query($conn,$query);
?>
    <div class="containerproduct">
        <h1 class="Titlepanel">Product Panel</h1>
        <br>
        <a href="addproduct.php" class="editproduct">Add New Product</a>
        <br>
        <a href="editprice.php" class="editproduct">Edit Price of specific product</a>
            <div class="row">
                <div class="col m-auto">
                    <div>
                        <table class="table table-bordered">
                            <tr>
                                <td class="td"> Product ID </td>
                                <td class="td"> Title </td>
                                <td class="td"> Price </td>
                                <td class="td">Description</td>
                                <td class="td">Catagory</td>
                                <td class="td">Image</td>
                                <td class="td"> Edit Price  </td>
                                <td class="td"> Delete </td>
                            </tr>

                            <?php 
                                    // scans all data / rows of products
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        $productID = $row['ProductId'];
                                        $productName = $row['Title'];
                                        $price = $row['Price'];
                                        $Descr = $row['Description'];
                                        $category = $row['Category'];
                                        $imag = $row['Image'];
                                        
                            ?>
                                    <tr>
                                        <td class="td"><?php echo $productID ?></td>
                                        <td class="td"><?php echo $productName ?></td>
                                        <td class="td"><?php echo $price ?></td>
                                        <td class="td"><?php echo $Descr ?></td>
                                        <td class="td"><?php echo $category ?></td>
                                        <td class="td"><?php echo $imag ?></td>
                                        <td class="td"><a href="updateproduct.php" class="td">Edit</a></td>
                                        <td class="td"><a href="admin.php?idp=<?php echo $row['ProductId']; ?>" class="td">Delete</a></td>
                                    </tr>        
                            <?php 
                                    }  
                            ?>                                                                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php   
 include 'conn.php';  // check Id for product and can be deleted
 if (isset($_GET['idp'])) {  
      $idp = $_GET['idp'];  
      $query = "DELETE FROM `product` WHERE ProductId = '$idp'";  
      if (mysqli_query($conn,$query)) {  
        
      }else{  
           echo "Error: ".mysqli_error($conn);  
      }  
 }  
 ?>  

<?php 

require_once("conn.php");
$query = "SELECT * FROM `orders`";
$result = mysqli_query($conn,$query);
?>
    <div class="containerproduct">
        <h1 class="Titlepanel">Orders Display</h1>
        <br>
        <a href="updateorder.php" class="editproduct">Edit Order Status</a>
            <div class="row">
                <div class="col m-auto">
                    <div>
                        <table class="table table-bordered">
                            <tr>
                                <td class="td"> Order ID </td>
                                <td class="td"> User ID </td>
                                <td class="td"> Product ID </td>
                                <td class="td">Delivered</td>
                                <td class="td">Date Ordered</td>
                                <td class="td"> Edit Price  </td>
                                <td class="td"> Delete </td>
                            </tr>

                            <?php 
                                    // scans all data / rows of products
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        $OrderId = $row['OrderId'];
                                        $UserID = $row['userId'];
                                        $productID = $row['ProductId'];
                                        $Delivered = $row['Delivered'];
                                        $DateOrdered = $row['DateOrdered']; 
                            ?>
                                    <tr>
                                        <td class="td"><?php echo $OrderId ?></td>
                                        <td class="td"><?php echo $UserID ?></td>
                                        <td class="td"><?php echo $productID ?></td>
                                        <td class="td"><?php echo $Delivered ?></td>
                                        <td class="td"><?php echo $DateOrdered ?></td>
                                        <td class="td"><a href="updateorder.php" class="td">Edit</a></td>
                                        <td class="td"><a href="admin.php?ido=<?php echo $row['OrderId']; ?>" class="td">Delete</a></td>
                                    </tr>                                                                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php   
 include 'conn.php';  // check Id for orders and can be deleted
 if (isset($_GET['ido'])) {  
      $ido = $_GET['ido'];  
      $query = "DELETE FROM `orders` WHERE OrderId = '$ido'";  
      if (mysqli_query($conn,$query)) {  
        
      }else{  
           echo "Error: ".mysqli_error($conn);  
            }  
        }
    } 
?>
<?php
include ("footer.php");
?>
</body>
</html>
