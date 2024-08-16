<?php
require('configure.php');
require("check_data.php");

$user_id = $_SESSION['id'];
$formId = $_GET['id'];
$formDetails = [];

if ($formId > 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM forms WHERE form_id = :form_id AND user_id = :user_id");
        $stmt->bindParam(':form_id', $formId);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $formDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: rgb(240, 240, 240);
        }
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
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn-custom {
            margin-left: 10px;
        }
    </style>
</head>
<body>
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

<div class="container">
    <h1 class="text-center my-4" style="font-size: 70px; font-family: 'Times New Roman', serif;">Form Details</h1>
    <form method="post" action="">
        <button type="submit" name="delete_selected" class="btn btn-danger mt-3 mb-3" onclick="return confirm('Are you sure you want to delete selected staff members?');">Delete Selected</button>
        <a href="form_detail_form.php?id=<?php echo htmlspecialchars($formId); ?>" class="btn btn-success mt-3 mb-3">
            <i class="bi bi-plus-circle"></i> Add
        </a>
    </form>
    <?php if ($formDetails): ?>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Label</th>
                    <th>Placeholder</th>
                    <th>Type</th>
                    <th>Condition/Options</th>
                    <th>Edit</th>
                    <th>Delete</th>
            
                </tr>
            </thead>
            <tbody>
                <?php foreach ($formDetails as $detail): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['label']); ?></td>
                        <td><?php echo htmlspecialchars($detail['placeholder']); ?></td>
                        <td><?php echo htmlspecialchars($detail['type']); ?></td>
                        <td>
                            <?php
                            if ($detail['type'] == 'radio' || $detail['type'] == 'checkbox') {
                                $optionsString = $detail['options'];
                                $options = explode(';', $optionsString);
                                foreach ($options as $option) {
                                    list($label, $value) = explode('=>', $option);
                                    echo htmlspecialchars($label) . ': ' . htmlspecialchars($value) . '<br>';
                                }
                            } else {
                                echo 'NA';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="edit_label.php?id=<?php echo $detail['id']; ?>" style="color:black;text-decoration:none;">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </td>
                        <td>
                            
                            <a href="delete_label.php?id=<?php echo htmlspecialchars($detail['id']); ?>" onclick="return confirm('Are you sure you want to delete this form?')" style="color:black;text-decoration:none;">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No form details found for the specified form ID.</p>
    <?php endif; ?>

   
</div>

<script>
    document.getElementById('select-all').onclick = function() {
        var checkboxes = document.querySelectorAll('input[name="selected_staff[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>
</body>
</html>
