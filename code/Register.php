<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>
<link rel="stylesheet" href="../code/stylesheet.css">
<body>
<div class="positionBoxLogin">
    <section class="register-form">
    <div class="LoginBox">
        <h1>Register Here</h1>
                <form action="register.php" method="post">
                    <input type="text" name="name" placeholder="Full name..." class="registerboxspacing">
                    <br>
                    <input type="number" name="age" placeholder="Age..." class="registerboxspacing">
                    <br>
                    <input type="email" name="email" placeholder="Email..." class="registerboxspacing">
                    <br>
                    <input type="password" name="pwd" placeholder="Password..." class="registerboxspacing">
                    <br>
                    <input type="password" name="pwdrepeat" placeholder="Repeat Password..." class="registerboxspacing">
                    <br>
                    <button type="submit" name="submit" class="submitforLogin">Sign Up</button>
                </form>
            </div>
        </div>
    </section>

    <?php

    if (isset($_POST["submit"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdrepeat"];

        require_once 'db_conn.php';
        require_once 'functions.php';

        if (emptyInputRegister($name, $email,$age, $pwd, $pwdRepeat) == true) {
            header("location: Register.php?error=emptyinput");
            exit();
        }

        if (InvalidName($name) !== false) {
            echo "Invalid ID";
            header("location: Register.php?error=invaliduid");
            exit();
        }
        if (IsValidEmail($email) == true) {
            echo "Invalid Email";
            header("location: Register.php?error=invalidemail");
            exit();
        }
        if(Invalidage($age) !==false){
            echo "Invalid Age";
            header("location: Register.php?error=Invalidage");
            exit();
        }
        if (invalidpwdMatch($pwd, $pwdRepeat) !== false) {
            echo "Invalid Password";
            header("location: Register.php?error=invalidpwd");
            exit();
        }
        if (UidExist($conn,$name, $email) == true) {
            header("location: login.php");
            exit();
        }

        CreateUser($conn, $name, $email, $pwd);
    }


    ?>
</body>

</html>
