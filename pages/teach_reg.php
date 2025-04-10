<?php
session_start();
require_once '../connect.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = trim($_POST['full_name']);
    $dob = $_POST['dob'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $qualification = $_POST['qualification'];
    $experience = (int)$_POST['experience'];
    $joining_date = $_POST['joining_date'];
    $subjects = isset($_POST['subjects']) ? implode(", ", $_POST['subjects']) : '';

    // Handle file upload
    $photo = NULL;
    if (!empty($_FILES['photo']['name'])) {
        $photo_name = time() . "_" . $_FILES['photo']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($photo_name);
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            $photo = $photo_name;
        }
    }

    // Validate required fields
    if (empty($full_name) || empty($dob) || empty($email) || empty($phone) || empty($gender) || empty($department) || empty($qualification) || empty($experience) || empty($joining_date)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    // Insert into database
    $query = "INSERT INTO teachers (full_name, dob, email, phone, gender, department, qualification, experience, joining_date, subjects, photo) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssssssisss", $full_name, $dob, $email, $phone, $gender, $department, $qualification, $experience, $joining_date, $subjects, $photo);
        
        if ($stmt->execute()) {
            echo "<script>alert('Teacher registered successfully!'); window.location.href = 'teacher-list.php';</script>";
        } else {
            echo "<script>alert('Database error.'); window.history.back();</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('SQL error.'); window.history.back();</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
