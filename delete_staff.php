<?php
require("configure.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM staff WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Record deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting record: " . $stmt->errorInfo()[2];
    }
    header("Location: manage_staff.php");
    exit();
} else {
    echo "Invalid request";
}
?>
