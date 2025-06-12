<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('You must be logged in to list an item.');</script>";
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include("../PHP/userDB/mysqlConn.php");
    if (isset($_POST['delete_item']) && isset($_POST['item_id'])) {
        $item_id = intval();
    }

    
}


?>