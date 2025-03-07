<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = htmlspecialchars($_POST["email"]);
    $uName = htmlspecialchars($_POST["username"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);

    if (empty($email)||empty($uName)||empty($dob)||empty($pass)||empty($cPass)){
        header("Location: ../Pages/register.html");
        exit();
    }else{
        header("Location: ../index.html");
    }
}else{
    header("Location: ../Pages/register.html");
}