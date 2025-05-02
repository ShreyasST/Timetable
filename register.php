<?php
include('pages/connect.php'); // Ensure this connects to your DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $school_name = trim($_POST['school_name']);
    $admin_name = trim($_POST['admin_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user = trim($_POST['user']);

    // Validation
    if (empty($school_name) || empty($admin_name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.');</script>";
        exit;  // Stop the script execution after the alert
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
        exit;
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
        exit;
    }
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('An account with this email already exists!');</script>";
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO admins (school_name, admin_name, email, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $school_name, $admin_name, $email, $user, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>
        alert('Registration successful!');
        window.location.href = 'login.html';
    </script>";
    
    } else {
        echo "<script>
    alert('Registration failed!');
    window.history.back()';
</script>";

    }

    $stmt->close();
    $check->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
