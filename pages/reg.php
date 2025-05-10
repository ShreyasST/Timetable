<?php
require 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'] ?? '';
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $standard = $_POST['standard'];
    $category= $_POST['category'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure hashing

    // Handle photo upload
    $photoPath = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $photoName = basename($_FILES['photo']['name']);
        $photoPath = $targetDir . uniqid() . "_" . $photoName;
        move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
    }

    // Insert into teachers table
    $sql = "INSERT INTO teachers(full_name, teacher_id, qualification, specialization, email, phone, experience, photo, dob, password, category)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssissss", $full_name, $teacher_id, $qualification, $specialization, $email, $phone, $experience, $photoPath, $dob, $password,$category);

    if ($stmt->execute()) {
        // Success: show alert and redirect
        echo "<script>
                alert('Teacher registered successfully!');
               window.location.href = '../index.php';  // Redirect to success page

              </script>";
    } else {
        // Failure: show alert and go back
        echo "<script>
                alert('Error registering teacher: " . $stmt->error . "');
                window.history.back();  // Go back to the previous page
              </script>";
    }

    $stmt->close();
}
?>
