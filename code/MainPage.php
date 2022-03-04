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
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method=get>
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
            <input value="Find" type="submit" name="submit" class="custom-btn btn-8">
            </form> 

            <table class="hideTable">
              <tr>
                <td>Title</td>
                <td>Description</td>
                <td>Category</td>
                <td>Price</td>
              </tr>
            
            <?php

              if(isset($_GET['submit'])) {

                  if(isset($_GET['type'])){

                    $query = $conn ->prepare("SELECT * FROM product WHERE Category ='".$_GET['type']."'");

                    if(!$query) {
                      die(mysqli_error($conn));
                    }

                    $query->execute();

                    if(!$query) {
                      die(mysqli_error($conn));
                    }

                    $result = $query->get_result();

                    $musicData = $result->fetch_all(MYSQLI_ASSOC);

                    $query -> close();
                    
                  }else{
                    echo 'No category selected';
                  }
                  foreach($musicData as $music) {
                
              
            ?>

            <tr>
              <td><?php echo $music['Title'] ?></td>
              <td><?php echo $music['Description'] ?></td>
              <td><?php echo $music['Category'] ?></td>
              <td><?php echo $music['Price'] ?></td>
            </tr>
            <?php
              }
            }
            ?>
          </table>
          
          
          <a href='cartAdd.php?id="<?php.$row['ProductId'] ?>Add to Cart</a>
          

          <div class="content">
            <div class = "records">
               <div class = "record">
                  <h2>Queens</h2>
                  <p>Queen are a British rock band formed in London in 1970. Their classic line-up was Freddie Mercury, Brian May, Roger Taylor and John Deacon.</p>
                  <img src="img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro; 30,30 </p> 
                </div> 
                <p></p>
                <div class = "record">
                  <h2>Queens</h2>
                  <p>Queen are a British rock band formed in London in 1970. Their classic line-up was Freddie Mercury, Brian May, Roger Taylor and John Deacon.</p>
                  <img src="img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro; 30,30 </p> 
                </div> 
                <p></p>
                <div class = "record">
                  <h2>Queens</h2>
                  <p>Queen are a British rock band formed in London in 1970. Their classic line-up was Freddie Mercury, Brian May, Roger Taylor and John Deacon.</p>
                  <img src="img/queens.jpg" class="imgqueens" alt = "Records">
                  <p> &euro; 30,30 </p> 
                </div> 
                <p></p>
            </div>
        </div>
<?php include "footer.php" ?>

