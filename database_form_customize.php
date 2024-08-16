<?php
require("configure.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $title = trim($_POST['title']);
   
    
    $stmt = $conn->prepare("INSERT INTO form (user_id, Title_name) VALUES (:user_id, :title)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':title', $title);
   
    $stmt->execute();
    echo "Form data inserted successfully!";
    header("Location: manage_form.php");
    exit(); 

    $conn = null;
}
?>
