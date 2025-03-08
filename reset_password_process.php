<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $userId = intval($_POST['user_id']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Input validation
    if (empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "Both password fields are required.";
        header("Location: reset_password.php?token=" . htmlspecialchars($token)); //redirect back with token
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
       header("Location: reset_password.php?token=" . htmlspecialchars($token)); //redirect back with token
        exit();
    }

    // Verify the token (again, for security)
    $stmt = $conn->prepare("SELECT user_id, expires_at FROM password_resets WHERE token = ? AND user_id = ?");
    $stmt->bind_param("si", $token, $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($dbUserId, $expiresAt);
        $stmt->fetch();
        if (strtotime($expiresAt) < time()) {
             $_SESSION['error'] = "Password reset link has expired.";
              header("Location: forgot_password.php"); // Redirect to forgot password
              exit();
        }

         $stmt->close(); // close before preparing next

        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update the user's password
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);

        if ($stmt->execute()) {
            // Delete the used token
            $deleteStmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $deleteStmt->bind_param("s", $token);
            $deleteStmt->execute();
            $deleteStmt->close();

            $_SESSION['message'] = "Your password has been successfully reset.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to reset password. " . $stmt->error;
            header("Location: reset_password.php?token=" . htmlspecialchars($token)); //redirect back with token
            exit();
        }

    }else{
        $_SESSION['error'] = "Invalid or expired reset token.";
        header("Location: forgot_password.php"); // Redirect to forgot password
        exit();
    }
    $stmt->close();

} else {
  header("Location: forgot_password.php"); // prevent direct access
    exit();
}
$conn->close();
?>