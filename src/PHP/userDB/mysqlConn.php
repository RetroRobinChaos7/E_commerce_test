<?php
$servername = "localhost";
$dbUsername = "root";
$password = "";
$datebaseName = "userbase_db";

$conn = new mysqli($servername, $dbUsername, $password, $datebaseName);

if ($conn->connect_error) {
    die("Connection Failed". $conn->connect_error);
}
?>