<?php
    include "header.php";
    include "connect.php";
    session_start();
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
            <h1>Positive feedback</h1>
            <h2>Love the purchase? Lets us know with a picture of you and your music!</h2>
            <form name="sort" action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
            <p>Details of purchase</p>
            <p>Upload image here!</p>
            </form>
        </div>
    </body>