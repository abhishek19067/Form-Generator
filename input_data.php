<?php
require('configure.php');

$formId = $_GET['id'];
$csrfToken = $_POST['csrf_token'] ?? '';
if (!isset($_SESSION['csrf_token']) || $csrfToken !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($formId > 0) {
        try {
            // Prepare to fetch label from forms table
            $labelStmt = $conn->prepare("SELECT label FROM forms WHERE id = :field_name");
            
            // Prepare the insert statement
            $stmt = $conn->prepare("INSERT INTO form_responses (form_id, field_name, field_value, label, created_at) VALUES (:form_id, :field_name, :field_value, :label, NOW())");

            foreach ($_POST as $key => $value) {
                if ($key === 'csrf_token') {
                    continue;
                }

                $sanitizedFieldName = preg_replace('/\D/', '', $key);

                // Fetch the label for the current field_name
                $labelStmt->bindParam(':field_name', $sanitizedFieldName);
                $labelStmt->execute();
                $labelRow = $labelStmt->fetch(PDO::FETCH_ASSOC);
                $label = $labelRow ? $labelRow['label'] : null;

                if (is_array($value)) {
                    foreach ($value as $item) {
                        $stmt->bindParam(':form_id', $formId);
                        $stmt->bindParam(':field_name', $sanitizedFieldName);
                        $stmt->bindParam(':field_value', $item);
                        $stmt->bindParam(':label', $label);
                        $stmt->execute();
                    }
                } else {
                    $stmt->bindParam(':form_id', $formId);
                    $stmt->bindParam(':field_name', $sanitizedFieldName);
                    $stmt->bindParam(':field_value', $value);
                    $stmt->bindParam(':label', $label);
                    $stmt->execute();
                }
            }
            unset($_SESSION['csrf_token']);
            echo "<SCRIPT>
            alert('Form Submitted Successfully.');
            window.location.replace('manage_form.php');
        </SCRIPT>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid form ID.";
    }
} else {
    echo "Invalid request method.";
}

$conn = null;
?>
