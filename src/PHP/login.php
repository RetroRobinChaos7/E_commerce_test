<?php 
session_start();
//loading the .env file by pasing each line into a format that php understands
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


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uName = trim(strtolower(htmlspecialchars($_POST["username"])));
    $pass = $_POST["password"];
    $cPass = $_POST["cpassword"];
    //recapta variables and fetching results
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_Secret = getenv('RECAPTCHA_SECRET_KEY');
    $recaptcha_Respons = $_POST['g-recaptcha-response'];

    $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_Secret.'&response='.$recaptcha_Respons);
    $recaptcha=json_decode($recaptcha,   true);
    //recaptcha verification
    if($recaptcha['success']==1 AND $recaptcha['score'] >= 0.5 AND $recaptcha['action'] == 'login'){
        if ($cPass === $pass && !empty($uName) && !empty($pass) && !empty($cPass)) {
            $conn = new mysqli('localhost', 'root', '', 'userbase_db');
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }
    
            $stmt = $conn->prepare('SELECT username, password FROM Users WHERE LOWER(username) = LOWER(?)');
            if ($stmt) {
                $stmt->bind_param("s", $uName);
                if ($stmt->execute()) {
                    $stmt->bind_result($dbUsername, $storedpassword);
                    if ($stmt->fetch()) {
                        if (password_verify($pass, $storedpassword)) {
                            $_SESSION['username'] = $dbUsername;
                            $stmt->close();
                            $conn->close();
                            echo "<script>
                                    alert('Login Successful!');
                                    window.location.href = '../index.php';
                                  </script>";
                            exit();
                        } else {
                            $stmt->close();
                            $conn->close();
                            echo "<script>
                                    alert('Incorrect password!');
                                    window.location.href = 'login.php';
                                  </script>";
                            exit();
                        }
                    } else {
                        $stmt->close();
                        $conn->close();
                        echo "<script>
                                alert('Username not found!');
                                window.location.href = 'login.php';
                              </script>";
                        exit();
                    }
                } else {
                    $stmt->close();
                    $conn->close();
                    echo "<script>
                            alert('Database execution error!');
                            window.location.href = 'login.php';
                          </script>";
                    exit();
                }
            } else {
                $conn->close();
                echo "<script>
                        alert('Failed to prepare SQL statement!');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('Please fill all fields and ensure passwords match!');
                    window.location.href = '../Pages/Login/login.html';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                    alert('reCaptcha failed, please try again!');
                    window.location.href = '../Pages/Login/login.html';
                  </script>";
            exit();
    }
} else {
    header("Location: ../Pages/login/login.html");
    exit();
}