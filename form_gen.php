<?php
require('configure.php');
require("check_data.php");
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}

$formId = $_GET["id"];
$name = $_GET['name'];
if ($formId > 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM forms WHERE form_id = :form_id");
        $stmt->bindParam(':form_id', $formId);
        $stmt->execute();
        $forms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($forms) {
            $_SESSION['label_id'] = $forms[0]['id'];

            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Form</title>
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { background-color: #f8f9fa; }
                    .form-container {
                        max-width: 600px;
                        padding-bottom: 100px;
                        margin: auto;
                        padding: 20px;
                        background: #ffffff;
                        border-radius: 8px;
                        box-shadow: 0 8px 100px rgba(0,0,0,0.1);
                    }
                    .form-group label { font-weight: bold; }
                    .btn-custom {
                        background-color: #007bff;
                        color: white;
                        border: none;
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
                    .btn-custom:hover { background-color: #0056b3; color: white; }
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
<br><br>    
                <div class="container form-container mt-3">
                    <h1 class="text-center mb-4">' . htmlspecialchars($name) . '</h1>
                    <form method="POST" action="input_data.php?id=' . $formId . '">
                        <input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token']) . '">';

            foreach ($forms as $form) {
                switch ($form['type']) {
                    case 'text':
                        echo '<div class="form-group">';
                        echo '<label for="input_' . htmlspecialchars($form['id']) . '">' . htmlspecialchars($form['label']) . ':</label>';
                        echo '<input type="text" class="form-control" name="input_' . htmlspecialchars($form['id']) . '" placeholder="' . htmlspecialchars($form['placeholder']) . '" required>';
                        echo '</div>';
                        break;

                    case 'textarea':
                        echo '<div class="form-group">';
                        echo '<label for="input_' . htmlspecialchars($form['id']) . '">' . htmlspecialchars($form['label']) . ':</label>';
                        echo '<textarea class="form-control" name="input_' . htmlspecialchars($form['id']) . '" placeholder="' . htmlspecialchars($form['placeholder']) . '" required></textarea>';
                        echo '</div>';
                        break;

                    case 'radio':
                    case 'checkbox':
                        $optionsString = $form['options'];
                        $options = explode(';', $optionsString);

                        if ($options) {
                            echo '<div class="form-group">';
                            echo '<label>' . htmlspecialchars($form['label']) . ':</label><br>';

                            foreach ($options as $option) {
                                list($label, $value) = explode('=>', $option);
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="' . htmlspecialchars($form['type']) . '" name="input_' . htmlspecialchars($form['id']) . '[]" value="' . htmlspecialchars($value) . '">';
                                echo '<label class="form-check-label">';
                                echo htmlspecialchars($label);
                                echo '</label>';
                                echo '</div>';
                            }

                            echo '</div>';
                        }
                        break;

                    default:
                        echo '<p>Invalid form type.</p>';
                        break;
                }
            }

            echo '<div class="text-center">
                    <button type="submit" class="btn btn-custom">Submit</button>
                </div>';
            echo '</form>
                </div>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </body>
            </html>';
        } else {
            echo "Form not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid form ID.";
}

$conn = null;
?>
