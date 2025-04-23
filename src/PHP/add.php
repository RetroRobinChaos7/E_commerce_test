<?php
session_start();  
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = htmlspecialchars($_POST['title']);
    $price = htmlspecialchars($_POST['price']);
    $cat = htmlspecialchars($_POST['cat']);
    $desc = htmlspecialchars($_POST['desc']);
    $listImg = htmlspecialchars($_POST['listImg']); 
    $username = $_SESSION['username'];

    include 'mysqlConn.php';
    $imageLikn = "";
    $stmt = $conn->prepare('Insert Into listdb(title,price,cat,description,itemImage,user)');
    $stmt->bind_param('sdssbs', $title, $price, $cat, $desc, $listImg, $username);
    if($stmt->execute()){
        echo "<script>
                    alert('Item Listed!');
              </script>";
    }else{
        echo "<script>
                    alert('Something went wrong!');
              </script>";
    }
    $stmt->close();
    $conn->close();
    header('location: ../Pages/Listings/list.html');
}