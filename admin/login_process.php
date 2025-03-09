<?php
session_start();
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic Input Validation
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Both email and password are required.";
        header("Location: login.php"); // Redirect back to admin login
        exit();
    }

    // Retrieve user and check admin status
    $stmt = $conn->prepare("SELECT id, password, is_admin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $hashedPassword, $isAdmin);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword) && $isAdmin) {
            // Password is correct, and user is an admin!
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $userId; //  Store admin's user ID (optional, but useful)
            header("Location: index.php"); // Redirect to admin dashboard
            exit();
        } else {
            // Invalid password or not an admin
            $_SESSION['error'] = "Invalid credentials or insufficient privileges.";
             header("Location: login.php"); // Redirect back to admin login
             exit();
        }
    } else {
        // Email not found
        $_SESSION['error'] = "Invalid credentials.";
          header("Location: login.php"); // Redirect back to admin login
          exit();
    }
    $stmt->close();
} else {
     header("Location: login.php"); // prevent direct access
     exit();
}
$conn->close();
?>