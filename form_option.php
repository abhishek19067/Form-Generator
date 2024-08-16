<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form Generator</title>
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
    </style>
</head>
<body>
    <div class="container form-container">
        <h2 class="text-center">Form Generator</h2>
        <form id="dynamicForm" method="post" action="customize_form_database.php">
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
            dynamicFields.innerHTML = ''; // Clear any existing fields
            additionalFieldsContainer.innerHTML = ''; // Clear additional fields

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
