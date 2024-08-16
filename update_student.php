<?php
require("configure.php");
require("check_data.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact = $_POST['Contact'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $course = $_POST['course'];

    $query = "UPDATE student_info 
              SET first_name = :first_name, 
                  last_name = :last_name, 
                  phone = :contact, 
                  email = :email, 
                  dob = :dob, 
                  gender = :gender, 
                  address = :address, 
                  course = :course 
              WHERE id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':course', $course);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        if ($stmt->rowCount()) {
            echo "Record updated successfully.";
            header("Location: manage.php");
            exit;
        } else {
            echo "Failed to update record.";
        }
    } else {
        echo "Error executing query.";
    }
} else {
    echo "Invalid request.";
}
?>