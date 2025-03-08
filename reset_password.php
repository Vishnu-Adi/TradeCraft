<?php
include 'db_connect.php';
include 'header.php';

$token = isset($_GET['token']) ? $_GET['token'] : null;
$isValidToken = false;

if ($token) {
    // Verify the token
    $stmt = $conn->prepare("SELECT user_id, expires_at FROM password_resets WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $expiresAt);
        $stmt->fetch();

        // Check if the token has expired
        if (strtotime($expiresAt) > time()) {
            $isValidToken = true;
        } else {
            $_SESSION['error'] = "Password reset link has expired.";
        }
    } else {
        $_SESSION['error'] = "Invalid password reset link.";
    }
    $stmt->close();
} else {
     $_SESSION['error'] = "No password reset token provided";
}

?>

<div class="container my-5">
    <h1>Reset Password</h1>

    <?php if ($isValidToken): ?>
        <form action="reset_password_process.php" method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>

     <script>
        // Simple client-side validation to check password match
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
          var password = document.getElementById('password').value;
          var confirmPassword = document.getElementById('confirm_password').value;
          if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match!');
          }
        });
     </script>
    <?php else: ?>
        <p>Please try resetting your password again.</p>
        <a href="forgot_password.php" class="btn btn-primary">Forgot Password</a>
    <?php endif; ?>
</div>

<?php
include 'footer.php';
$conn->close();
?>