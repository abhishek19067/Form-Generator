<?php
require_once 'configure.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['companyName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $website = $_POST['website'];
    $services = $_POST['services'];
    $add = $_POST['additionalInfo'];
    $id=$_SESSION['id'];

    $_SESSION['company_name'] = $name;

    
    $stmt = $conn->prepare("INSERT INTO company (user_id, company_name, company_email, company_phone, company_address, Company_website, company_services, addtion_info) VALUES ('$id','$name','$email','$phone',' $address', '$website',' $services', '$add')");
    if ($stmt->execute()) {
        $_SESSION['form_submitted'] = true;
        header("Location: manage_company.php");
        exit();
    } else {
        $error = $stmt->error;
        echo "<script>alert('Error: $error'); window.location.replace('form.php');</script>";
    }

    $stmt->close();
}
?>
