<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = htmlspecialchars($_POST["email"]);
    $uName = htmlspecialchars($_POST["username"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);

    if (empty($email)||empty($uName)||empty($dob)||empty($pass)||empty($cPass) && $cPass === $pass){
        header("Location: ../Pages/Register/register.html");
        exit();
    }else{
        include "userDB/mysqlConn.php";

        $hasedPass = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $conn->prepare('Insert into Users(email,userName,dob,password)values(?,?,?,?)');
            $stmt->bind_param('ssss', $email,$uName,$dob,$hasedPass);
            if($stmt->execute()){
                echo "<script>
                    alert('Registration Successfully...');
                </script>";
            }else{
                echo "<script>
                    alert('Registration Failed...');
                    window.location.href = '../register.php';
                </script>";
            }
            $stmt->close();
            $conn->close();

        header("Location: login.php");
    }
}else{
    header("Location: ../Pages/Register/register.html");
}
