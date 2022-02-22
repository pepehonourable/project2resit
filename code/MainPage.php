<?php
    include "header.php";
    include "connect.php";
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
            <p></p>
            <span><h1>Welcome to Vinyal Record Store!</h1></span>
            <p></p>
            <p></p>
            <h2>Find any records you want!</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method=POST>
            <div class="search-box">
            <div class ="label">
               <label for="Contact type"><p>What do you want to find?</p></label>
               <pre>
                    <select name="type">
                        <option disabled selected>Category</option>
                        <option value = "Alt">Alt</option>
                        <option value = "Soundtrack">Soundtrack</option>
                        <option value = "Rock">Rock</option>
                    </select>
            </div>
            <input type="submit" value="Find" name="submit" <button class="custom-btn btn-8"></button>
            </form>
            <p></p>
            <table id="table">
                <tr>
                <td><p>Title</p></td>
                <td><p>Category</p></td>
                <td><p>Description</p></td>
                </tr>

                <?php
                    if(isset($_POST['submit'])) { 
                        if(isset($_POST['type'])){
                        echo $_POST['type'];
                        $submit = $_POST['submit'];
                        $query = "SELECT * FROM product WHERE Title LIKE '{$submit}%'";
                        $result = mysqli_query($conn, $query);
                        
                        $row = mysqli_fetch_assoc($result);
                        $Title = $row['Title'];
                        echo "<div><a href ='orderUser.php?Title=".$row['Title']."' ><h4> ".$row["Title"]."</h4></a></div>"; 
                        }
                    }
                
                    if(isset($_POST['title'])){
                        $result = mysqli_query($conn,"SELECT * FROM product where title='".$_GET['title']."'");
                    }
                    else{
                        $result = mysqli_query($conn,"SELECT * FROM product");
                    }
                    while($info = mysqli_fetch_array($result)) {
                ?>

                <tr>
                <td><p><?php echo $info['Title']; ?></p></td>
                <td><p><?php echo $info['Category']; ?></p></td>
                <td><p><?php echo $info['Description']; ?></p></td>
                </tr>
                <?php
                }
                ?>
                </table>

          <div class="content">
            <div class = "records">
               <div class = "record">
                  <img src="img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30 </p>
                </div> 
                <p></p>
                <div class = "record">
                  <img src= "img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30 </p>
                </div> 
                <p></p>
                <div class = "record">
                  <img src= "img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30 </p>
                </div> 
                <p></p>
                <div class = "record">
                  <img src= "img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30 </p>
                </div> 
                <p></p>
                <div class = "record">
                  <img src= "img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30</p>
                </div> 
                <p></p>
                <div class = "record">
                  <img src= "img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30</p>
                </div> 
                <p></p>
                <div class = "record">
                  <img src= "img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30</p>
                </div> 
                <p></p>
                <div class = "record">
                  <img src= "img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro 30,30</p>
                </div> 
                <p></p>
            </div>
        </div>
<?php include "footer.php" ?>