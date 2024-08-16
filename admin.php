<?php
require("configure.php"); 


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

try {
    
    $query = "SELECT * FROM company WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) == 0) {
        header("Location: form.php");
        exit();
    }
} catch (PDOException $e) {
    
    error_log("Admin Page Error: " . $e->getMessage());
    echo "An error occurred. Please try again later.";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <style>
      body {
          font-family: 'Arial', sans-serif;
          background-color: rgb(240, 240, 240);
}
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-align: left;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575d63;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .btn a{
            color:white;
            text-decoration:none;   
        }
        .btn{
            display:flex;
           margin-left:130px;
        }
    </style>
</head>
<body>  
<div class="sidebar">
    <h1 style="color:white; text-align:center;">Admin</h1>
    <a href="#dashboard">Dashboard</a>
    <a href="manage_company.php">Manage Company Information</a>
    <a href="Manage.php">Manage Student Information  </a>
    <a href="Manage_staff.php">Manage Staff Information   </a>
    <a href="manage_form.php"> Customize Form</a>
       <a href="#settings">Settings</a>
    <a href="logout.php">Logout</a>
</div>


<div class="content">
    <h1 style=" text-align:center;font-size:70px;font-family: 'Bodoni Moda SC, serif';font-optical-sizing: auto;font-weight: 500;font-style:normal;" >Admin Dashboard</h1>
    
    


    
    

