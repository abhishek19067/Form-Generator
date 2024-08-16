<?php
require('configure.php');
require("check_data.php");

$formId = isset($_GET['form_id']) ? intval($_GET['form_id']) : 0;

if ($formId > 0) {
    try {
        
        $stmt = $conn->prepare("SELECT * FROM forms WHERE id = :form_id");
        $stmt->bindParam(':form_id', $formId);
        $stmt->execute();
        $form = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($form) {
            echo "<h1>" . htmlspecialchars($form['label']) . "</h1>";
            echo '<form method="post" action="submit_form_data.php">';
              if ($form['type'] === 'text' || $form['type'] === 'textarea') {
                echo '<div class="form-group">';
                echo '<label for="input_' . $form['id'] . '">' . htmlspecialchars($form['label']) . ':</label>';
                if ($form['type'] === 'text') {
                    echo '<input type="text" class="form-control" id="input_' . $form['id'] . '" name="input_' . $form['id'] . '" placeholder="' . htmlspecialchars($form['placeholder']) . '">';
                } else {
                    echo '<textarea class="form-control" id="input_' . $form['id'] . '" name="input_' . $form['id'] . '" placeholder="' . htmlspecialchars($form['placeholder']) . '"></textarea>';
                }
                echo '</div>';
            } elseif ($form['type'] === 'radio' || $form['type'] === 'checkbox') {
                $stmtOptions = $conn->prepare("SELECT * FROM form_options WHERE form_id = :form_id");
                 $stmtOptions->bindParam(':form_id', $formId);
                $stmtOptions->execute();
                $options = $stmtOptions->fetchAll(PDO::FETCH_ASSOC);

                if ($options) {
                    echo '<div class="form-group">';
                    echo '<label>' . htmlspecialchars($form['label']) . ':</label><br>';

                    foreach ($options as $option) {
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="' . htmlspecialchars($form['type']) . '" name="input_' . $form['id'] . '" id="option_' . htmlspecialchars($option['id']) . '" value="' . htmlspecialchars($option['value']) . '">';
                        echo '<label class="form-check-label" for="option_' . htmlspecialchars($option['id']) . '">';
                        echo htmlspecialchars($option['label']);
                        echo '</label>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
echo '<button type="submit" class="btn btn-primary">Submit</button>';
            echo '</form>';
        } else {
            echo "Form not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid form ID.";
}

$conn = null;
?>
