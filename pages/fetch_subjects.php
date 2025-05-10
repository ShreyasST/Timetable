<?php
require 'connect.php';

if (isset($_POST['standard'])) {
    $standard = intval($_POST['standard']);
    $sql = "SELECT subject_id, subject_name FROM subjects WHERE standards = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $standard);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <label class="checkbox-container">
                <input type="checkbox" name="subjects[]" value="' . $row['subject_id'] . '">
                <span class="checkmark"></span>
                ' . htmlspecialchars($row['subject_name']) . '
            </label>';
        }
    } else {
        echo "<p>No subjects found for Standard $standard.</p>";
    }
}
?>
