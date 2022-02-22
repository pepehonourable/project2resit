<?php
include "connect.php";
if(isset($_POST['input'])){
    
    $input = $_POST['input'];

    $query = "SELECT * FROM product WHERE Title LIKE '{$input}%'"; // if input is set then this query will run, % - represents 1 or multiple characters 
    
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $Title = $row['Title'];
        echo  '<a href = "orderUser.php">$Title</a>';
      }

    }else{
        echo "<h6 class='text-danger text-center mt-3'>No data found</h6>";
    }
    
}
?>