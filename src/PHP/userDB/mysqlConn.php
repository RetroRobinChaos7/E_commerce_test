<?php
$servername = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USERNAME') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: 'your_database_name';
$port = getenv('DB_PORT') ?: '3306';

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
} else {
    error_log("Database connected successfully");
}
?>