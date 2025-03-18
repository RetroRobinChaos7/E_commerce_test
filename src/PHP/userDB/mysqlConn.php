<?php

$servername = "localhost";
$username = "root";
$password = "";
$datebaseName = "userbase_db";

$conn = new mysqli($servername, $username, $password, $datebaseName);

if ($conn->connect_error) {
    die("Connection Failed". $conn->connect_error);
}
?>