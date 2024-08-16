<?php
require("configure.php");


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
} else {
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM company WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        header("Location: form.php");
        exit();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM company WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni Moda SC&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>
<style>
    label{
        font-size: 23px; 
        font-family: 'Bodoni Moda SC', serif;
        }
    h1{
        text-align:center;
    }
</style>
<body style="background-color: rgb(223, 221, 221);">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <h1 style="font-family: 'Bodoni Moda SC', serif ;color:white" >Dashboard</h1>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link bn" href="admin.php" style="color:white;">Home</a>
    </li>   
    <li class="nav-item">
      <a class="nav-link" href="logout.php" style="color:white;">Logout</a>
    </li>
  </ul>
</div>
      </nav>  
      <br><br><br>
    
<div class="container mt-3" style="border: 2px solid #333; width: 600px; height: 750px; background-color: #333; color: white; border-radius: 50px;">
<h1 style="font-size: 38px; font-family: 'Bodoni Moda SC', serif; margin-top:10px;">Update Company Registration Form</h1>
        <form action="update.php" method="post">

                <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <div class="form-group">
            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name"  class="form-control" name="company_name" value="<?php echo htmlspecialchars($row['company_name']); ?>">
    </div>
    <div class="form-group">
            <label for="Contact" >Contact:</label>
            <input type="text" id="Contact"  class="form-control" name="Contact" value="<?php echo htmlspecialchars($row['company_phone']); ?>">
            </div>
            <div class="form-group">
            <label for="company_email">Email:</label>
            <input type="email" id="company_email"  class="form-control" name="company_email" value="<?php echo htmlspecialchars($row['company_email']); ?>">
            </div>
            <div class="form-group">
            <label for="Company_website">Website:</label>
            <input type="text" id="Company_website"  class="form-control" name="Company_website" value="<?php echo htmlspecialchars($row['Company_website']); ?>">
            </div>
            <div class="form-group">
            <label for="company_services">Services:</label>
            <input type="text" id="company_services"  class="form-control" name="company_services" value="<?php echo htmlspecialchars($row['company_services']); ?>">
            </div>
            <div class="form-group">
            <label for="addtion_info">Additional Info:</label>
            <input type="text" id="addtion_info"  class="form-control" name="addtion_info" value="<?php echo htmlspecialchars($row['addtion_info']); ?>">
            </div>
            <div class="form-group">
           <center> <input type="submit" value="Update" class="form-control" value="Submit" style="width:200px;"></center>
            </div>
        </form>
    </div>
        </body>
        <?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "Invalid request.";
}
?>
