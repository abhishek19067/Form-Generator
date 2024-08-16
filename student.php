<?php
require("check_data.php");
require_once 'configure.php';

if (!isset($_SESSION['id'])) {
    die('Session is not active. Please log in.');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $id=$_SESSION["id"];

    try {
     
        $stmt = $conn->prepare("INSERT INTO student_info (user_id, first_name, last_name, email, phone, dob, gender, address, course) VALUES('$id' , '$firstName', '$lastName', '$email', '$phone', '$dob', '$gender', '$address', '$course');");
                if ($stmt->execute()) {
            $_SESSION['form_submitted'] = true;
            header("Location: manage.php");
            exit();
        } else {
            $error = $stmt->error;
            echo "<script>alert('Error: $error'); window.location.replace('form.php');</script>";
        }
        $stmt->close();

    } catch (Exception $e) {
        echo "<script>alert('Database connection error: {$e->getMessage()}'); window.location.replace('form.php');</script>";
    }
}
?>
