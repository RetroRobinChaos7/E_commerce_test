<?php

$servername = "sql202.infinityfree.com";
$dbUsername = "if0_39173446";
$password = "Retropaswoord";
$datebaseName = 'if0_39173446_userbase_db';

$conn = new mysqli($servername, $dbUsername, $password, $datebaseName);

if ($conn->connect_error) {
    die("Connection Failed". $conn->connect_error);
}
?>