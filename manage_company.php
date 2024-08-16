<?php
require("configure.php");
require("check_data.php");

$user_id = $_SESSION['id'];
if (isset($_SESSION['message'])) {
  echo '
  <style>
 
  .alert {
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 20px;
}

.alert-success {
  background-color: #dff0d8;
  color: #3c763d;
  border-color: #d6e9c6;
}</style>   <p><br></p><div class="alert alert-success">
       <p>' . $_SESSION['message'] . '</p>
        </div>';
  unset($_SESSION['message']);
}
$sql = "SELECT * FROM company WHERE user_id = :user_id";
$result = $conn->prepare($sql);
$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$result->execute();

if (!$result) {
    die("Query failed: " . $conn->errorInfo()[2]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_selected'])) {
    if (!empty($_POST['selected_companies'])) {
        $ids = implode(',', array_map('intval', $_POST['selected_companies']));
        $delete_sql = "DELETE FROM company WHERE id IN ($ids)";
        $delete_stmt = $conn->prepare($delete_sql);
        if ($delete_stmt->execute()) {
            header("Location: manage_company.php");
            exit;
        } else {
            echo "Error deleting records: " . $conn->errorInfo()[2];
        }
    }
}
?>

<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<style>
  .navbar-brand {
  letter-spacing: 3px;
  color: white;
}

.navbar-brand:hover {
	color: white;
}

.navbar-scroll .nav-link,
.navbar-scroll .fa-bars {
    color: white;
}

.navbar-scrolled .nav-link,
.navbar-scrolled .fa-bars {
    color: white;
}

.navbar-scrolled {
  background-color: white;
}
</style>
<body style="background-color: rgb(240, 240, 240);">
<nav class="navbar navbar-expand-lg fixed-top navbar-scroll shadow-0" style="background-color: black;">
  <div class="container">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
      aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="d-flex justify-content-start align-items-center">
        <i class="fas fa-bars"></i>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarExample01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link px-3" href="admin.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="manage.php">Students Information</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="manage_staff.php">Staff Information</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link px-3" href="manage_company.php">Company Information</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="manage_form.php">Customize Form</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" href="logout.php">Logout</a>
        </li>
      </ul>

      
    </div>
  </div>
</nav>
<br><br><br>
<h1 style="text-align:center; font-size:70px; font-family:  serif; font-optical-sizing: auto; font-weight: 500; font-style:normal;">Company Information Table</h1>

<form method="post" action="">
    <button type="submit" name="delete_selected" class="btn btn-danger mt-3 mb-3" onclick="return confirm('Are you sure you want to delete selected companies?');">Delete Selected</button>
    <button class="btn btn-success mt-3 mb-3"><a href="form.php" style="color:white; text-decoration:none;"><i class="bi bi-plus-circle"></i> Add</a></button>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="select-all"></th>
                <th scope="col">ID</th>
                <th scope="col">Company Name</th>
                <th scope="col">Company Email</th>
                <th scope="col">Company Phone</th>
                <th scope="col">Company Website</th>
                <th scope="col">Company Services</th>
                <th scope="col">Additional Info</th>
                <th scope="col">Company Address</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $results = $result->fetchAll();
            foreach($results as $row) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='selected_companies[]' value='".$row['id']."'></td>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['company_name']."</td>";
                echo "<td>".$row['company_email']."</td>";
                echo "<td>".$row['company_phone']."</td>";
                echo "<td>".$row['Company_website']."</td>";
                echo "<td>".$row['company_services']."</td>";
                echo "<td>".$row['addtion_info']."</td>";
                echo "<td>" . $row['company_address'] . "</td>";
                echo "<td><a href='edit_company.php?id=" . $row['id'] . "' style='color:black; text-decoration:none;'><i class='bi bi-pencil-square'></i> Edit</a></td>";
                echo "<td><a href='delete_company.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this item?\")' style='color:black; text-decoration:none;'><i class='bi bi-trash'></i> Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>

<script>
    document.getElementById('select-all').onclick = function() {
        var checkboxes = document.querySelectorAll('input[name="selected_companies[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>

</body>
</html>
