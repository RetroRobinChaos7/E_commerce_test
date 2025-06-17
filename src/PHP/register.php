<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}
loadEnv(__DIR__ . '/../../.env');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $uName = htmlspecialchars($_POST["username"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);

    if (empty($email) || empty($uName) || empty($dob) || empty($pass) || empty($cPass) || $cPass !== $pass) {
        header("Location: ../Pages/Register/register.html");
        exit();
    } else {
        include("userDB/mysqlConn.php");

        $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $conn->prepare('INSERT INTO users(email, userName, dob, password) VALUES(?,?,?,?)');
        $stmt->bind_param('ssss', $email, $uName, $dob, $hashedPass);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Registration Successful...');
                  </script>";
        } else {
            echo "<script>
                    alert('Registration Failed...');
                    window.location.href = '../register.php';
                  </script>";
        }
        $stmt->close();
        $conn->close();

        header("Location: ../Pages/Login/login.html");
    }
} else {
    header("Location: ../Pages/Register/register.html");
}
?>