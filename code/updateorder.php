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
                        <h4>Order Status of Product</h4>
                    </div>
                    <div class="card-body">

                        <form action="updateorder.php" method="POST">

                            <div class="form-group mb-3">
                                <label for="">Order ID</label>
                                <input type="text" name="orderid" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Status of Order</label>
                                <select  name="orderstatus" class="form-control" >
                                <option value="Order Processing">Order Processing</option>
                                <option value="Order Packaged">Order Packaged</option>
                                <option value="Order Send">Order Send</option>
                                <option value="Order Delivered">Order Delivered</option>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date Delivered</label>
                                <input type="date" name="orderdate" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="submito" class="btn btn-primary">Update Data</button>
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

if(isset($_POST['submito']))
{ 
     $OrderId = $row['orderid'];
    $Delivered = $row['orderstatus'];
    $DateOrdered = $row['orderdate']; 
    
    $query = "UPDATE order SET Delivered=?, DateOrdered=? WHERE OrderId=? ";
 
    if($statement = mysqli_prepare($con,$query)){

        mysqli_stmt_bind_param($statement, 'sii',$Delivered,$DateOrdered,$OrderId);
        mysqli_stmt_execute($statement);
    
        $_SESSION['updateproduct'] = "Data Updated Successfully";
        header("Location: admin.php");
    }
}

?>
