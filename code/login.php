<!DOCTYPE html>
<html>
<head>
<title>Log in</title>
</head>
<link rel="stylesheet" href="Styling/design.css">
<body>
    <section>
 <form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" >
     <div class="positionBoxLogin">
     <div class="LoginBox">
     <h1>Log in</h1>
 <label >Email:</label><br>
  <input type="email" class="inputBoxLogin" name="email" value=""><br>
  <label >Password:</label><br>
  <input type="password" class="inputBoxLogin" name="pwd" value=""><br><br>
  <input type="submit" name="submit"value="Log in" class="submitforLogin">
  <a href="Register.php">Register</a>
</div>
</div>
</form>
<?php

if (!empty($_GET['error'])) {

    if ($_GET["error"] == "emptyinput") {
        echo "Fill in all fields!";
    }
    else if ($_GET["error"] == "invalidemail"){
        echo "choose a proper email!";
    }
    else if ($_GET["error"] == "wronglogin"){
        echo "incorrect login requirements";
    }
    else if ($_GET['error'] == "wrongpsw"){
        echo "password doesn't match!";
    }
    else if ($_GET["error"] == "stmtfailed"){
        echo "something went wrong try again!";
    }
    else if ($_GET["error" == "Emailtaken"]){
        echo "The Email is already Taken!";
    }
    else if ($_GET["error"] == "none") {
        echo "You have Logged In!";
    }
}
if (isset($_POST["submit"])){

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    require_once 'db_conn.php';
    require_once 'functions.php';

    if (emptyInputLogin($email, $pwd) !== false) {
        header("location: login.php?error=emptyinput");
        
    }
    loginUser($conn, $email, $pwd);
}
?>
</section>
</body>
</html>

<?php
