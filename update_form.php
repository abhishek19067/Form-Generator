<?php
require("configure.php");
require("check_data.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $last_name = $_POST['last_name'];
    $Contact = $_POST['Contact'];
    $format = $_POST['format'];
    $dob = $_POST['dob'];

    $query = "UPDATE form_detail SET  label = '$last_name', placeholder = '$Contact', text_format = '$format', form_condition = '$dob' WHERE id = '$id'";
    $stmt = $conn->prepare( $query);
    $stmt->execute();

    if ($stmt->rowCount()) {
        echo "Record updated successfully.";
        header("location:manage_form.php");
    } else {
        echo "No changes made.";
    }
} else {
    echo "Invalid request.";
}
?>