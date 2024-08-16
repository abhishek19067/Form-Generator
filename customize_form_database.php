<?php
require("configure.php"); 
$user_id = $_POST['user_id'];
$form_id = $_POST['id'];
$label = $_POST['label'];
$placeholder = $_POST['placeholder'];
$formType = $_POST['formType'];
$optionLabels = isset($_POST['optionLabel']) ? $_POST['optionLabel'] : [];
$optionValues = isset($_POST['optionValue']) ? $_POST['optionValue'] : [];
$label = htmlspecialchars($label);
$placeholder = htmlspecialchars($placeholder);
$options = [];
if ($formType === 'radio' || $formType === 'checkbox') {
    for ($i = 0; $i < count($optionLabels); $i++) {
        $optionLabels[$i] = htmlspecialchars($optionLabels[$i]);
        $optionValues[$i] = htmlspecialchars($optionValues[$i]);
        $options[] = $optionLabels[$i] . '=>' . $optionValues[$i];
    }
    $optionsString = implode(';', $options);
} else {
    $optionsString = '';
}

try {
  
    $query = "INSERT INTO forms (user_id, form_id, label, placeholder, type, options) VALUES (:user_id, :form_id, :label, :placeholder, :type, :options)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':form_id', $form_id, PDO::PARAM_INT);
    $stmt->bindParam(':label', $label, PDO::PARAM_STR);
    $stmt->bindParam(':placeholder', $placeholder, PDO::PARAM_STR);
    $stmt->bindParam(':type', $formType, PDO::PARAM_STR);
    $stmt->bindParam(':options', $optionsString, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Form details saved successfully!";
        header("location:manage_form.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null; 
?>
