<?php
require("check_data.php");
require('configure.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_id = $_POST['form_id'];
    $label = $_POST['label'];
    $placeholder = $_POST['placeholder'];
    $type = $_POST['type'];
    $options = isset($_POST['options']) ? $_POST['options'] : '';
    $label = htmlspecialchars($label);
    $placeholder = htmlspecialchars($placeholder);
    $type = htmlspecialchars($type);
    $options = htmlspecialchars($options);

    if ($type === 'radio' || $type === 'checkbox') {
        $query = "UPDATE forms SET label = :label, placeholder = :placeholder, type = :type, options = :options WHERE id = :form_id AND user_id = :user_id";
        $params = [
            ':label' => $label,
            ':placeholder' => $placeholder,
            ':type' => $type,
            ':options' => $options,
            ':form_id' => $form_id,
            ':user_id' => $_SESSION['id']
        ];
    } else {
        $query = "UPDATE forms SET label = :label, placeholder = :placeholder, type = :type WHERE id = :form_id AND user_id = :user_id";
        $params = [
            ':label' => $label,
            ':placeholder' => $placeholder,
            ':type' => $type,
            ':form_id' => $form_id,
            ':user_id' => $_SESSION['id']
        ];
    }

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        echo "Form updated successfully!";
        header("location:manage_form.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
