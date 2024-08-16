<?php
require("configure.php");
require("check_data.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $staff_name = $_POST['first_name'];
    $email = $_POST['email'];
    $contact = $_POST['Contact'];
    $department = $_POST['course']; 
    $position = $_POST['position'];
    $hire_date = $_POST['dob'];

    $query = "UPDATE staff SET Staff_name ='$staff_name', Email = '$email', phone_number ='$contact', department =' $department', Staff_Position = '$position', hire_date = '$hire_date' WHERE id = '$id'";
    $stmt =$conn-> prepare( $query);
    $stmt->execute();

    if ($stmt->rowCount()) {
        echo "Staff information updated successfully.";
        header("Location:manage_staff.php");
    } else {
        echo "Error updating staff information.";
    }
} else {
    echo "Invalid request.";
}
?>