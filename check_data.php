<?php
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
$company_check_sql = "SELECT COUNT(*) FROM company WHERE user_id = :user_id";
$company_check_stmt = $conn->prepare($company_check_sql);
$company_check_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$company_check_stmt->execute();
$company_count = $company_check_stmt->fetchColumn();

if ($company_count != 0) {
   
    header("Location: form.php");
    exit;
}
?><?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>