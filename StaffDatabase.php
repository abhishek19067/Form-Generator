<?php

require_once 'configure.php';
require("check_data.php");

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Session ID not set. Please log in.'); window.location.replace('login.php');</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $hireDate = $_POST['hireDate'];
    $id=$_SESSION['id'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.replace('form.php');</script>";
        exit();
    }
    echo "Full Name: $fullName<br>";
    echo "Email: $email<br>";
    echo "Phone: $phone<br>";
    echo "Department: $department<br>";
    echo "Position: $position<br>";
    echo "Hire Date: $hireDate<br>";

    $stmt = $conn->prepare("INSERT INTO staff (user_id, Staff_name, Email, phone_number, department, Staff_Position, hire_date) VALUES ('$id','$fullName', '$email', '$phone', '$department', '$position', '$hireDate')");
if ($stmt->execute()) {
        $_SESSION['form_submitted'] = true;
        header("Location: manage_staff.php");
        exit();
    } else {
        $error = $stmt->error;
        echo "<script>alert('Error: $error'); window.location.replace('form.php');</script>";
    }
    $stmt->close();
}
?>
