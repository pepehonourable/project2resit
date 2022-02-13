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
            <h3>Find any records you want!</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method=POST>
            <div class="search-box">
            <div class ="label">
               <label for="Contact type">What do you want to find?</label>
               <pre>
                    <select name="type">
                        <option disabled selected>Category</option>
                        <option value = "Alt">Alt</option>
                        <option value = "Soundtrack">Soundtrack</option>
                        <option value = "Rock">Rock</option>
                    </select>
            </div>
            <input type="submit" value="Find" name="submit"/>
</form>

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
                ?>

            <div class="records">
                <div class = "record">
                    <img src = "/project2resit/code/img/img.jpeg" alt="record">
                </div>
                <div class = "record">
                    <img src = "/code/img/img.jpeg" alt="record">
                </div>
                <div class = "record">
                    <img src = "/code/img/img.jpeg" alt="record">
                </div>
                <div class = "record">
                    <img src = "/code/img/img.jpeg" alt="record">
                </div>
                <div class = "record">
                    <img src = "/code/img/img.jpeg" alt="record">
                </div>
                <div class = "record">
                    <img src = "/code/img/img.jpeg" alt="record">
                </div>
                <div class = "record">
                    <img src = "/code/img/img.jpeg" alt="record">
                </div>
                <div class = "record">
                    <img src = "/code/img/img.jpeg" alt="record">
                </div>
            </div>
        <?php include "footer.php" ?>
    
