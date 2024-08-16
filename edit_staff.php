<?php
require("configure.php");
require("check_data.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM staff WHERE id = :id";
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
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>
<style>
    label {
        font-size: 23px; 
        font-family: 'Bodoni Moda SC', serif;
    }
    h1 {
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
<h1 style="font-size: 38px; font-family: 'Bodoni Moda SC', serif; margin-top:10px;">Update Staff Information</h1>
        <form action="update_staff.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="first_name">Staff Name:</label>
                <input type="text" id="staff_name" class="form-control" name="first_name" value="<?php echo $row['Staff_name']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>">
            </div>
            <div class="form-group">
                <label for="Contact">Contact:</label>
                <input type="number" id="Contact" class="form-control" name="Contact" value="<?php echo $row['phone_number']; ?>">
            </div>
            <div class="form-group">
                <label for="course">Department  </label>
                <select class="form-control" id="department" name="course" required>
                  <option value="">Select a course</option>
                  <option value="HR" <?php echo ($row['department'] == 'HR') ? 'selected' : ''; ?>>HR</option>
                  <option value="IT" <?php echo ($row['department'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                  <option value="Finance" <?php echo ($row['department'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
                  <option value="Marketing" <?php echo ($row['department'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                </select>
            </div>
            <div class="form-group">
    <label for="position">Staff Position:</label>
    <input type="text" id="position" class="form-control" name="position" value="<?php echo $row['Staff_Position']; ?>">
</div>
            <div class="form-group">    
                <label for="address">Hire Date</label>
                <input type="date" id="hire_date" class="form-control" name="dob" value="<?php echo $row['hire_date']; ?>">
            </div>
           <div class="form-group">
                <center><input type="submit" value="Update" class="form-control" style="width:200px;"></center>
            </div>
        </form>
    </div>
</body>
</html>
        <?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "Invalid request.";
}
?>