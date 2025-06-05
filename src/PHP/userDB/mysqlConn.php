<?php
$host = getenv('DB_HOST');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: '3306';

$conn = new mysqli($host, $username, $password, $database, $port);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>