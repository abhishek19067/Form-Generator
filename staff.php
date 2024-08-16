<?php
require("configure.php");
require("check_data.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:wght@400;900&family=Josefin+Sans:wght@100;700&display=swap" rel="stylesheet">
</head>
<body style="background-color: rgb(223, 221, 221);">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <h1 style="font-family: 'Bodoni Moda SC', serif;">Dashboard</h1>
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
        </div>
    </nav>  
    <br><br><br>
    <div class="container mt-3" style="border: 2px solid #333; width: 600px; background-color: #333; color: white; border-radius: 20px;">
        <h1 style="font-size: 38px; font-family: 'Bodoni Moda SC', serif; margin-top:10px;">Staff Information Form</h1>
        <form action="staffDatabase.php" method="post">
    <div class="form-group">
        <label for="fullName" style="font-family: 'Bodoni Moda SC';font-size:20px">Full Name</label>
        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name" required>
    </div>
    <div class="form-group">
        <label for="email" style="font-family: 'Bodoni Moda SC';font-size:20px">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="phone" style="font-family: 'Bodoni Moda SC';font-size:20px">Phone Number</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
    </div>
    <div class="form-group">
        <label for="department" style="font-family: 'Bodoni Moda SC';font-size:20px">Department</label>
        <select class="form-control" id="department" name="department" required>
            <option value="">Select department</option>
            <option value="HR">HR</option>
            <option value="IT">IT</option>
            <option value="Finance">Finance</option>
            <option value="Marketing">Marketing</option>
        </select>
    </div>
    <div class="form-group">
        <label for="position" style="font-family: 'Bodoni Moda SC';font-size:20px">Position</label>
        <input type="text" class="form-control" id="position" name="position" placeholder="Enter position" required>
    </div>
    <div class="form-group">
        <label for="hireDate" style="font-family: 'Bodoni Moda SC';font-size:20px">Date of Hire</label>
        <input type="date" class="form-control" id="hireDate" name="hireDate" required>
    </div>
    <center>
        <button type="submit" class="btn btn-success" style="width:200px; font-size:20px;font-family: 'Bodoni Moda SC';">Submit</button>
    </center>
</form>

    </div>
</body>
</html>

