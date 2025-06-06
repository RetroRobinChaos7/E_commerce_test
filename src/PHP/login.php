<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Load the .env file (optional, kept for future reCAPTCHA use)
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
    $uName = trim(strtolower(htmlspecialchars($_POST["username"])));
    $pass = $_POST["password"];
    $cPass = $_POST["cpassword"];

    if ($cPass === $pass && !empty($uName) && !empty($pass) && !empty($cPass)) {
        include("userDB/mysqlConn.php");
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $stmt = $conn->prepare('SELECT username, password, is_admin FROM users WHERE LOWER(username) = LOWER(?)');
        if ($stmt) {
            $stmt->bind_param("s", $uName);
            if ($stmt->execute()) {
                $stmt->bind_result($dbUsername, $storedpassword, $isAdmin);
                if ($stmt->fetch()) {
                    if (password_verify($pass, $storedpassword)) {
                        $_SESSION['username'] = $dbUsername;
                        $_SESSION['is_admin'] = $isAdmin;
                        $stmt->close();
                        $conn->close();
                        $_SESSION['login_message'] = "Login Successful!";
                        if ($isAdmin) {
                            header("Location: ../Pages/Admin/admin.php");
                        } else {
                            header("Location: ../../index.php");
                        }
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
    header("Location: ../Pages/Login/login.html");
    exit();
}
?>