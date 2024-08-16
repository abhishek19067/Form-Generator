<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

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
<body style="background-color: rgb(223, 221, 221);">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <h1 style="font-family: 'Bodoni Moda SC', serif " >Dashboard</h1>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
          </li>
          </ul>
        </div>
      </nav>  
      <br><br><br>
      <div class="container mt-3" style="border: 2px solid #333; width: 600px; height: 1030px; background-color: #333; color: white; border-radius: 50px;">
    <h1 style="font-size: 38px; font-family: 'Bodoni Moda SC', serif; margin-top:10px;">Company Registration Form</h1>
    <form action="company.php" method="post">
        <div class="form-group">
            <label for="companyName" style="font-size: 23px; font-family: 'Bodoni Moda SC', serif">Company Name:</label>
            <input type="text"  class="form-control" id="companyName" name="companyName" required>
        </div>
        <div class="form-group">
            <label for="contactPerson" style="font-size: 23px; font-family: 'Bodoni Moda SC', cursive;">Contact Person Name:</label>
            <input type="text"  class="form-control" id="contactPerson" name="contactPerson" required>
        </div>
        <div class="form-group">
            <label for="email" style="font-size: 23px; font-family: 'Bodoni Moda SC', cursive;">Email Address:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone" style="font-size: 23px; font-family: 'Bodoni Moda SC', cursive;">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="address" style="font-size: 23px; font-family: 'Bodoni Moda SC', cursive;">Company Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="website" style="font-size: 23px; font-family: 'Bodoni Moda SC', cursive;">Company Website (if any):</label>
            <input type="url" class="form-control" id="website" name="website">
        </div>
        <div class="form-group">
            <label for="services" style="font-size: 23px; font-family: 'Bodoni Moda SC', cursive;">Services Offered:</label>
            <textarea id="services" class="form-control" name="services" rows="4" placeholder="Describe the services or courses offered by your company"></textarea>
        </div>
        <div class="form-group">
            <label for="additionalInfo" style="font-size: 23px; font-family: 'Bodoni Moda SC', cursive;">Additional Information:</label>
            <textarea id="additionalInfo" class="form-control" name="additionalInfo" rows="4" placeholder="Any other details or information you would like to provide"></textarea>
        </div>
        <div class="form-group">
           <center> <input type="submit"  class="form-control" value="Submit" style="width:200px;"></center>
        </div>
    </form>
</div>
</body>
</html>