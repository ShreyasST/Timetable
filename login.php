<?php
session_start();
include ('pages/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['user']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($user) || empty($password) || empty($role)) {
        die("Please fill all fields.");
    }

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['user'];
            $_SESSION['role'] = $user['role'];

            if ($role === "admin") {
                header("Location: index.php");
            } else {
                header("Location: ../dev_proj1/login.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }

    $stmt->close();
}
?>
