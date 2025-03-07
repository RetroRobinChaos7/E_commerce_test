<?php 
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = htmlspecialchars($_POST["email"]);
    $uName = htmlspecialchars($_POST["username"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);


    

    header("Location: ../index.html");

}else{
    header("Location: ../Pages/login.html");
}