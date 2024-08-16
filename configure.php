<?php
session_start();
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'students';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
