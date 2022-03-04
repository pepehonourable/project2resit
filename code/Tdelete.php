<?php // delete function for admin panel
    $id=$_GET['id'];
    include('conn.php');
    mysqli_query($conn,"DELETE FROM user WHERE userId='$id'");
    header('location: admin.php');
?>
