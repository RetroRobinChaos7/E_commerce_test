<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $uName = htmlspecialchars($_POST["username"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);

    //temporary login until i can get a databsase up and running on this guy
    if ($uName === "Retro" && $pass === "retropaswoord7" && $cPass === $pass || !empty($uName) || !empty($pass) || !empty($cPass)){
        header("Location: ../index.html");
    }else{
        header("Location: ../Pages/login.html");
        exit();
    }
}else{
    header("Location: ../Pages/login.html");
}