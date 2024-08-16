<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Form Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        .form-container {
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #333;
            border-radius: 10px;
            width: 600px;
            background-color: #f8f9fa;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .add-more {
            margin-top: 10px;
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
</nav><br><br>  
    <div class="container form-container">
        <h2 class="text-center">Form Generator</h2>
        <form id="dynamicForm" method="post" action="customize_form_database.php">
               
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>"> 
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"> 
                <div class="form-group">
                <label for="formLabel">Label Name :</label>
                <input type="text" class="form-control" id="formLabel" name="label" placeholder="Enter label name" required>
            </div>
            <div class="form-group">
                <label for="formPlaceholder">Placeholder :</label>
                <input type="text" class="form-control" id="formPlaceholder" name="placeholder" placeholder="Enter placeholder" required>
            </div>
            <div class="form-group">
                <label for="formType">Select Type :</label>
                <select class="form-control" id="formType" name="formType" required>
                    <option value="">Choose Type</option>
                    <option value="text">Text</option>
                    <option value="radio">Radio Button</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="textarea">Textarea</option>
                </select>
            </div>
            <div id="dynamicFields"></div>
            <div id="additionalFieldsContainer"></div>
            <button type="button" class="btn btn-secondary add-more" onclick="addMoreFields()">Add More Options</button>
            <div class="form-group mt-4">
                <center><input type="submit" class="btn btn-primary" value="Submit Form"></center>
            </div>
        </form>
    </div>

    <script>
        const dynamicFields = document.getElementById('dynamicFields');
        const formType = document.getElementById('formType');
        const additionalFieldsContainer = document.getElementById('additionalFieldsContainer');

        formType.addEventListener('change', function() {
            dynamicFields.innerHTML = '';
            additionalFieldsContainer.innerHTML = ''; 

            const selectedType = this.value;
            if (selectedType === 'radio' || selectedType === 'checkbox') {
                addOptionFields();
            }
        });

        function addOptionFields() {
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('form-group');
            optionDiv.innerHTML = `
                <label for="optionLabel">Option Label :</label>
                <input type="text" class="form-control" name="optionLabel[]" placeholder="Enter option label" required>
                <label for="optionValue">Option Value :</label>
                <input type="text" class="form-control" name="optionValue[]" placeholder="Enter option value" required>
            `;
            dynamicFields.appendChild(optionDiv);
        }

        function addMoreFields() {
            const selectedType = formType.value;
            if (selectedType === 'radio' || selectedType === 'checkbox') {
                addOptionFields();
            } else {
                alert('Add More button is only applicable for Radio and Checkbox types.');
            }
        }
    </script>
</body>
</html>
