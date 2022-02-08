<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <section class="register-form">
        <h1>Register Here</h1>
        <div class="positionBoxLogin">
            <div class="LoginBox">
                <form action="register.php" method="post">
                    <input type="text" name="name" placeholder="Full name...">
                    <input type="text" name="email" placeholder="Email...">
                    <input type="password" name="pwd" placeholder="Password...">
                    <input type="password" name="pwdrepeat" placeholder="Repeat Password...">
                    <button type="submit" name="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </section>

    <?php

    if (isset($_POST["submit"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdrepeat"];

        require_once 'db_conn.php';
        require_once 'functions.php';

        if (emptyInputRegister($name, $email, $pwd, $pwdRepeat) == true) {
            header("location: Register.php?error=emptyinput");
            exit();
        }

        if (InvalidName($name) !== false) {
            header("location: Register.php?error=invaliduid");
            exit();
        }
        if (IsValidEmail($email) == true) {
            header("location: Register.php?error=invalidemail");
            exit();
        }
        if (invalidpwdMatch($pwd, $pwdRepeat) !== false) {
            header("location: Register.php?error=invalidpwd");
            exit();
        }
        if (UidExist($name, $conn, $email) !== false) {
            header("location: Register.php?error=nametaken");
            exit();
        }

        CreateUser($conn, $name, $email, $pwd);
    }


    ?>
</body>

</html>
