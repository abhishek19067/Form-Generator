<?php 
session_start()
function loginRedirect($conn, $stmt) {
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        $stmtCompany = $conn->prepare("SELECT * FROM company WHERE user_id = ?");
        $stmtCompany->bind_param('i', $id);
        $stmtCompany->execute();
        $stmtCompany->store_result();

        if ($stmtCompany->num_rows > 0) {
            header("location: admin.php");
            exit();
        } else {
            header("location: form.php");
            exit();
        }
    }
}
?>