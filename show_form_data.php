<?php
require("configure.php");
require("check_data.php");
$user_id = $_GET['id'];
$sql = "SELECT * FROM form_responses WHERE form_id = :user_id ORDER BY created_at DESC";
$result = $conn->prepare($sql);
$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$result->execute();

if (!$result) {
    die("Query failed: " . $conn->errorInfo()[2]);
}

$rows = $result->fetchAll(PDO::FETCH_ASSOC);
$groupedEntries = [];
foreach ($rows as $row) {
    $timestamp = $row['created_at'];
    if (!isset($groupedEntries[$timestamp])) {
        $groupedEntries[$timestamp] = [];
    }s
    $groupedEntries[$timestamp][] = $row;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Information Table</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th:nth-child(1), .table td:nth-child(1) {
            width: 5%;
        }
        .table th:nth-child(2), .table td:nth-child(2) {
            width: 5%;
        }
        .table th:nth-child(3), .table td:nth-child(3) {
            width: 15%;
        }
        .table th:nth-child(4), .table td:nth-child(4) {
            width: 20%;
        }
        .table th:nth-child(5), .table td:nth-child(5) {
            width: 15%;
        }
        .table th:nth-child(6), .table td:nth-child(6) {
            width: 15%;
        }
        .table th:nth-child(7), .table td:nth-child(7) {
            width: 20%;
        }
        .table th:nth-child(8), .table td:nth-child(8) {
            width: 20%;
        }
        .table th:nth-child(9), .table td:nth-child(9) {
            width: 30%;
        }
        .table th:nth-child(10), .table td:nth-child(10) {
            width: 15%;
        }
        @media (max-width: 768px) {
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
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
<h1 style="text-align:center; font-size:70px; font-family: serif; font-weight:500;"><?php echo htmlspecialchars($_GET['name']); ?> Information Table</h1>

<form method="post" action="">
    
    <?php foreach ($groupedEntries as $timestamp => $entries) { ?>
        <h2 class="text-center">Entries from <?php echo htmlspecialchars($timestamp); ?></h2>
        <table class="table table-hover">
            <thead>
                <tr>
                   <th scope="col">Label Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Entry Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries as $row) { ?>
                    <tr>
                       <td><?php echo htmlspecialchars($row['label']); ?></td>
                        <td><?php echo htmlspecialchars($row['field_value']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</form>

<script>
    document.querySelectorAll('input[id^="select-all-"]').forEach(function(selectAllCheckbox) {
        selectAllCheckbox.onclick = function() {
            var timestamp = this.id.split('-').pop();
            var checkboxes = document.querySelectorAll('input[name="selected_companies[]"][data-timestamp="' + timestamp + '"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    });
</script>

</body>
</html>
