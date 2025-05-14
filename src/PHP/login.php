<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uName = trim(strtolower(htmlspecialchars($_POST["username"])));
    $pass = $_POST["password"];
    $cPass = $_POST["cpassword"];

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
    header("Location: ../Pages/login/login.html");
    exit();
}