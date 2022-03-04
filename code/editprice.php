<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php 
                    if(isset($_SESSION['updateproduct']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['updateproduct']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['updateproduct']);
                    }
                ?>

                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Price of Product</h4>
                    </div>
                    <div class="card-body">

                        <form action="editprice.php" method="POST">

                            <div class="form-group mb-3">
                                <label for="">Product ID</label>
                                <input type="text" name="itemid" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Price</label>
                                <input type="number" name="itemprice" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Discount</label>
                                <input type="number" name="itemdiscount" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="updateprice" class="btn btn-primary">Update Data</button>
                                <a href="admin.php" class="displaystylebutton">Back to Display</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
//Updating product data
$con = mysqli_connect("localhost","root","","shop");

if(isset($_POST['updateprice']))
{
    $idp =$_POST['itemid'];
    $oldprice = $_POST['itemprice'];
    $discount = $_POST['itemdiscount'];

    $discount_value = ($oldprice / 100) * $discount;

    $price = $oldprice - $discount_value;
   

    $query = "UPDATE product SET Price=? WHERE ProductId=? ";
 
    if($statement = mysqli_prepare($con,$query)){

        mysqli_stmt_bind_param($statement, 'si',$price,$idp);
        mysqli_stmt_execute($statement);
    
        $_SESSION['updateproduct'] = "Data Updated Successfully";
        header("Location: admin.php");
    }
}

?>
