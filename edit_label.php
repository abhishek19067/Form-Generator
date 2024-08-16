<?php
require('configure.php');
require("check_data.php");

$user_id = $_SESSION['id'];
$formId = $_GET['id'];
$formDetails = [];

if ($formId > 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM forms WHERE id = :form_id AND user_id = :user_id");
        $stmt->bindParam(':form_id', $formId);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $formDetails = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Edit Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Form Details</h1>
    <?php if ($formDetails): ?>
        <form method="post" action="update_label.php">
            <input type="hidden" name="form_id" value="<?php echo htmlspecialchars($formId); ?>">
            <div class="form-group">
                <label for="label">Label:</label>
                <input type="text" class="form-control" id="label" name="label" value="<?php echo htmlspecialchars($formDetails['label']); ?>" required>
            </div>
            <div class="form-group">
                <label for="placeholder">Placeholder:</label>
                <input type="text" class="form-control" id="placeholder" name="placeholder" value="<?php echo htmlspecialchars($formDetails['placeholder']); ?>">
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" id="type" name="type">
                    <option value="text" <?php echo ($formDetails['type'] === 'text') ? 'selected' : ''; ?>>Text</option>
                    <option value="textarea" <?php echo ($formDetails['type'] === 'textarea') ? 'selected' : ''; ?>>Textarea</option>
                    <option value="radio" <?php echo ($formDetails['type'] === 'radio') ? 'selected' : ''; ?>>Radio</option>
                    <option value="checkbox" <?php echo ($formDetails['type'] === 'checkbox') ? 'selected' : ''; ?>>Checkbox</option>
                </select>
            </div>
            <div class="form-group">
                <label for="options">Options :</label>
                <input type="text" class="form-control" id="options" name="options" value="<?php echo htmlspecialchars($formDetails['options']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    <?php else: ?>
        <p>No form details found.</p>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
