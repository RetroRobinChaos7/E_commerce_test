<?php 
session_start();
function loadEnv($path){
    if(!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line){
        if(strpos(trim($line),'#') === 0)continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name).'='.trim($value));
    }
}
loadEnv(__DIR__.'/../../.env');

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = htmlspecialchars($_POST["email"]);
    $uName = htmlspecialchars($_POST["username"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_Secret = getenv('RECAPTCHA_SECRET_KEY');
    $recaptcha_Respons = $_POST['g-recaptcha-response'];

    $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_Secret.'&response='.$recaptcha_Respons);
    $recaptcha=json_decode($recaptcha,   true);

    if($recaptcha['success']==1 AND $recaptcha['score'] >= 0.5 AND $recaptcha['action'] == 'login'){
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
    } else {
        echo "<script>
                    alert('reCaptcha failed, please try again!');
                    window.location.href = '../Pages/Login/login.html';
                  </script>";
        exit();
    }
}else{
    header("Location: ../Pages/Register/register.html");
}