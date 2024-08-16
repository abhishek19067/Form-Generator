<?php
require("configure.php");
require("check_data.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $company_name = $_POST['company_name'];
    $Contact = $_POST['Contact'];
    $company_email = $_POST['company_email'];
    $Company_website = $_POST['Company_website'];
    $company_services = $_POST['company_services'];
    $addtion_info = $_POST['addtion_info'];

    $query = "UPDATE company SET company_name = :company_name, company_phone = :company_phone, company_email = :company_email, Company_website = :Company_website, company_services = :company_services, addtion_info = :addtion_info WHERE id = :id";
    
    $stmt = $conn->prepare($query);
    
    $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':company_phone', $Contact);
    $stmt->bindParam(':company_email', $company_email);
    $stmt->bindParam(':Company_website', $Company_website);
    $stmt->bindParam(':company_services', $company_services);
    $stmt->bindParam(':addtion_info', $addtion_info);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header("Location: manage_company.php");
        exit();
    } else {
        echo "Failed to update record.";
    }
} else {
    echo "Invalid request.";
}
?>
