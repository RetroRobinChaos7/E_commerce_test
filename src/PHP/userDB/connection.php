<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $uName = $_POST['username'];
        $dob = $_POST['dob'];
        $pass = $_POST['password'];

        $hasedPass = password_hash($pass, PASSWORD_BCRYPT);

        

        if ($conn->connect_error) {
            die('Connection failed : '. $conn->connect_error);
        }else{
            $stmt = $conn->prepare('Insert into users(email,userName,dob,password)values(?,?,?,?)');
            $stmt->bind_param('ssss', $email,$uName,$dob,$hasedPass);
            if($stmt->execute()){
                echo "<script>
                    alert('Registration Successfully...');
                    window.location.href = 'index.php';
                </script>";
            }else{
                echo "<script>
                    alert('Registration Failed...');
                    window.location.href = 'index.php';
                </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }
?>