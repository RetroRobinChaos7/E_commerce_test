<?php 
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $uName = htmlspecialchars($_POST["username"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);

    if ($uName === "Retro" && $pass === "retropaswoord7" && $cPass === $pass || !empty($uName) || !empty($pass) || !empty($cPass)){
        header("Location: ../index.html");
    }else{
        header("Location: ../Pages/login.html");
        exit();
    }

    //header("Location:../Pages/login.html");

}else{
    header("Location: ../Pages/login.html");
}