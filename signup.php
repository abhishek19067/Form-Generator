<?php


require("configure.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $mail = $_POST['mail'];
    $pass = $_POST['password'];

      $stmt = $conn->prepare("INSERT INTO users (user_name, user_password, user_Email) VALUES (:user, :pass, :mail)");
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':mail', $mail);

        if ($stmt->execute()) {
            echo "<SCRIPT> 
            alert('Account Created Successfully please Login Your Account')
            window.location.replace('login.php');
        </SCRIPT>";
            exit();
        } else {
            $error_message = 'Problem in creating account';
        }
    }


$conn = null;
?>