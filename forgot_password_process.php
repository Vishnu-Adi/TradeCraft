<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId);
        $stmt->fetch();
        
        // Generate a reset token and expiration date (1 hour)
        $token = bin2hex(random_bytes(16));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $token, $expires);
        if ($stmt->execute()) {
            // In production, send an email with a reset link like: reset_password.php?token=xxx
            $_SESSION['message'] = "Password reset instructions have been sent to your email.";
            header("Location: forgot_password.php");
            exit();
        } else {
            $_SESSION['error'] = "Could not initiate password reset. Please try again.";
            header("Location: forgot_password.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found.";
        header("Location: forgot_password.php");
        exit();
    }
    $stmt->close();
}
?>
