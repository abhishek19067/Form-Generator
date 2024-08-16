<?php

require_once 'configure.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id, user_password FROM users WHERE user_Email = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
           
            if(($password== $user['user_password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];

                $stmtCompany = $conn->prepare("SELECT * FROM company WHERE user_id = :id");
                $stmtCompany->bindParam(':id', $user['id']);
                $stmtCompany->execute();

                if ($stmtCompany->rowCount() > 0) {
                    header("location: admin.php");
                    exit();
                } else {
                    header("location: form.php");
                    exit();
                }
            } else {
                echo "<script>alert('Invalid Password'); window.location.replace('login.php');</script>";
                exit();
            }
        } else {
            echo "<script>alert('No user found with that email'); window.location.replace('login.php');</script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.replace('login.php');</script>";
        exit();
    }
}
?>