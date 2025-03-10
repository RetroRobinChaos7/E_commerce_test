<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $uName = htmlspecialchars($_POST["username"]);
    $pass = htmlspecialchars($_POST["password"]);
    $cPass = htmlspecialchars($_POST["cpassword"]);

    if ($cPass === $pass && !empty($uName) && !empty($pass) && !empty($cPass)){
        $conn = new mysqli('localhost','root','','userbase_db');
        if ($conn->connect_error) {
            die('Connection failed : '. $conn->connect_error);
        }else{
            $stmt = $conn->prepare('Select password from users where username = ?');
            $stmt->bind_param("s",$$uName);
            if($stmt->execute()){
                $stmt-> bind_result($storedpassword);
                if(password_verify($pass,$storedpassword)) {
                    echo"<script>
                        alert('Login Successfull!');
                        window.location.href = '../index.html';
                        </script>";
                }else{
                    echo "<script>
                        alert('Password doesnt match!');
                        setTimeout(function() { window.location.href = 'login.php'; }, 2000);
                        </script>";
                }
            }else{
                echo "<script>
                    alert('Username does'nt match!');
                    setTimeout(function() { window.location.href = 'login.php'; }, 2000);
                    </script>";
            }            
            $stmt->close();
            $conn->close();
        }
    }else{
        echo "<script>
            alert('Please fill all fields and ensure passwords match!');
            setTimeout(function() { window.location.href = '../Pages/login.html'; }, 2000);
        </script>";
    }
}else{
    header("Location: ../Pages/login.html");
}