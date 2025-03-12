<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if this is step 1 (email verification) or step 2 (password update)
    if (isset($_POST['action']) && $_POST['action'] == 'update_password') {
        // Step 2: Update the password
        
        $email = trim($_POST['email']);
        $new_password = trim($_POST['new_password']);
        $confirm_password = trim($_POST['confirm_password']);
        
        // Validation
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email address.";
            header("Location: forgot_password.php?step=2");
            exit();
        }
        
        if (empty($new_password) || strlen($new_password) < 8) {
            $_SESSION['error'] = "Password must be at least 8 characters long.";
            header("Location: forgot_password.php?step=2");
            exit();
        }
        
        if ($new_password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: forgot_password.php?step=2");
            exit();
        }
        
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update the user's password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $result = $stmt->execute();
        
        if ($result) {
            // Get user details for auto-login
            $stmt = $conn->prepare("SELECT id, fullName, email, is_admin FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            
            if ($user) {
                // Set session variables for auto-login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['fullName'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;
                
                // Set admin flag if applicable
                if ($user['is_admin']) {
                    $_SESSION['is_admin'] = true;
                }
                
                // Clear the reset email session
                unset($_SESSION['reset_email']);
                
                // Set success message
                $_SESSION['message'] = "Your password has been updated successfully!";
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Failed to update password. Please try again.";
            header("Location: forgot_password.php?step=2");
            exit();
        }
    } else {
        // Step 1: Verify email existence
        
        $email = trim($_POST['email']);
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Please enter a valid email address.";
            header("Location: forgot_password.php");
            exit();
        }
        
        // Check if email exists
        $stmt = $conn->prepare("SELECT id, fullName FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            // Email exists, proceed to step 2
            $_SESSION['reset_email'] = $email;
            
            // Get user's name
            $stmt->bind_result($userId, $fullName);
            $stmt->fetch();
            
            // Store in session for personalized messages
            $_SESSION['reset_name'] = $fullName;
            
            // Redirect to step 2
            header("Location: forgot_password.php?step=2");
            exit();
        } else {
            $_SESSION['error'] = "No account found with that email address.";
            header("Location: forgot_password.php");
            exit();
        }
        
        $stmt->close();
    }
} else {
    // Direct access not allowed
    header("Location: forgot_password.php");
    exit();
}

$conn->close();
?>