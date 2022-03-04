<?php

use function PHPSTORM_META\sql_injection_subst;

function emptyInputRegister($name, $email, $pwd, $pwdRepeat,$age)
{

    if (empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat) || empty($age)) {
        return true;
    } else {
        return false;
    }
}

function InvalidName($name)
{

    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {

        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function IsValidEmail($email)
{

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}
function invalidpwdMatch($pwd, $pwdRepeat)
{

    if ($pwd !== $pwdRepeat) {

        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function Invalidage($age){
  if  ($age >16){
      $result = false;
  }
else if($age <18) {
    $result = true;
}
return $result;
}
function UidExist($conn, $email)//Testing if there is an existing account or not
{
    $sql = "SELECT * FROM  user WHERE usersEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: Register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultDATA = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultDATA)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}
function CreateUser($conn, $name, $email, $pwd)//Creating an account for Users
{
    $sql = "SELECT usersEmail FROM user WHERE usersEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: Register.php?error=stmtfailed");
        exit();
        mysqli_stmt_bind_param($stmt, "s",  $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$usedEmails);
    mysqli_stmt_store_result($stmt);
    }
    if(mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);
        header("location: Register.php?error=emailused");
        exit();
    }else{
        $sql = "INSERT INTO user(userName, usersEmail, usersPwd) VALUES(?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: Register.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT,);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: login.php");
    } 
}
?>

<?php
function emptyInputLogin($email, $pwd)
{

    if (empty($email) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
    
}

function adminlogin($conn, $email, $pwd){
    //log in for admins
    $idExist = UidExist($conn, $email, $pwd);
    $admin ="admin@hotmail.com";
    $adminpsw ="admin";

    if ($idExist == false) {
        header("location: login.php?error=wronglogin"); 
    }

    $hashedPwd = $idExist["usersPwd"];
    $checkPwd = password_verify($adminpsw, $hashedPwd);
    $email = IsValidEmail($admin);

    if ($checkPwd == false ){
        header("location: login.php?error=wrongpsw");
        echo "Wrong Password or Email";
       
    }
     else if ($checkPwd == true ){ 
            session_start();
             $_SESSION["userid"] = $idExist["usersId"];
            header("location: admin.php");
        }
     }

    
    



 function loginUser($conn, $email, $pwd){
//login for  users
    $admin = "admin@hotmail.com";
    $idExist = UidExist($conn, $email, $pwd);

    if(adminlogin($conn,$email,$admin) !== false){
    header("Location: admin.php");
    }

    if ($idExist == false) {
        header("location: login.php?error=wronglogin"); 
    }

    $hashedPwd = $idExist["usersPwd"];
    $checkPwd = password_verify($pwd, $hashedPwd);
    

    if ($checkPwd == false){
        header("location: login.php?error=wrongpsw");
       
    }
     else if ($checkPwd == true){ 
            session_start();
             $_SESSION["userid"] = $idExist["usersId"];
            header("location: Mainpage.php");
        }
     }
?>
<?php
//Secerity file types of different types
$filetmpname = $_FILES['image']['tmp_name'];
    $filesize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $filetype = $_FILES['image']['type'];
    $fileExt = explode('.',$imag);
    $fileactualext = strtolower(end($fileExt));
    $allowed = array('jpg','jpeg','png','pdf');

    if (in_array($fileactualext,$allowed)) {
        if($fileError === 0){
            if($filesize < 2500000){
                $filenamenew = uniqid('',true).".". $fileactualext;
                $filedestination = 'img/'. $filenamenew;
                move_uploaded_file($filetmpname,$filedestination);
            }else{
                echo"Your file is Huge!";
            }
            }else {
                echo "There was an error uploading your file!";
            }
        }
     else{
        echo "You cannot upload this file type!";
    }
?>
