<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();  
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = htmlspecialchars($_POST['title']);
    $price = htmlspecialchars($_POST['price']);
    $cat = htmlspecialchars($_POST['cat']);
    $desc = htmlspecialchars($_POST['desc']);
    $username = $_SESSION['username'];

    include '../PHP/userDB/mysqlConn.php';
    
    $imageDir = "../Images/Uploads/";
    $imageName = basename($_FILES["listImg"]["name"]);
    $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $uniqueName = uniqid().".".$imageType;
    $targetFile = $imageDir.$uniqueName;

    $allowedTypes = ['image/jpeg','image/png'];
    $fileType = mime_content_type($_FILES["listImg"]["tmp_name"]);

    if(!in_array($fileType,$allowedTypes)){
        echo "<script>alert('only JPG and PNG file are allowed for images!')</script>";
        exit();
    }
    if(move_uploaded_file($_FILES["listImg"]["tmp_name"], $targetFile)) {
        $listImg = "Images/Uploads/". $uniqueName;
    }else {
        echo "<script>alert('The file failed to upload!')</script>";
        exit();
    }

    $stmt = $conn->prepare('Insert Into listdb(title,price,cat,description,itemImage,user) values (?,?,?,?,?,?)');
    $stmt->bind_param('sdssss', $title, $price, $cat, $desc, $listImg, $username);
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

    header('location: ../Pages/Listings/list.php');
    exit();
}