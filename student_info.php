<?php
require("check_data.php");
require("configure.php");

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
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body style="background-color: rgb(223, 221, 221);">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <h1>Dashboard</h1>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">LogOut</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <br><br><br>
      <div class="container mt-3" style="border: 2px solid #333; width: 600px; height: 900px; background-color: #333; color: white; border-radius: 50px;"> <br>
        <form action="student.php" method="post">
          <div class="form-group">
            <label for="firstName" style="font-size: 23px; font-family: 'Pacifico', cursive;">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
          </div>
          <div class="form-group">
            <label for="lastName" style="font-size: 23px; font-family: 'Pacifico', cursive;">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
          </div>
          <div class="form-group">
            <label for="email" class="lbl" style="font-size: 23px; font-family: 'Pacifico', cursive;">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
            <label for="phone" style="font-size: 23px; font-family: 'Pacifico', cursive;">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
          </div>
          <div class="form-group">
            <label for="dob" style="font-size: 23px; font-family: 'Pacifico', cursive;">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
          </div>
          <div class="form-group">
            <label for="gender" style="font-size: 23px; font-family: 'Pacifico', cursive;">Gender</label>
            <select class="form-control" id="gender" name="gender" required>
              <option value="">Select your gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="address" style="font-size: 23px; font-family: 'Pacifico', cursive;">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
          </div>
          <div class="form-group">
            <label for="course" style="font-size: 23px; font-family: 'Pacifico', cursive;">Course Interested In</label>
            <select class="form-control" id="course" name="course" required>
              <option value="">Select a course</option>
              <option value="bca">BCA</option>
              <option value="bba">BBA</option>
              <option value="btech">B.Tech</option>
              <option value="mba">MBA</option>
            </select>
          </div>
          <center><button type="submit" class="btn btn-success" style="width: 200px;">Submit</button></center>
        </form><br><br>
      </div>
</body>
</html>
