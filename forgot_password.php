<?php 
include 'header.php'; 

// Check if we're in step 2 (after email verification)
$step = isset($_GET['step']) && $_GET['step'] == '2' && isset($_SESSION['reset_email']) ? 2 : 1;
?>

<section class="section auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card auth-card shadow-sm border-0">
                    <div class="card-header bg-white text-center py-4">
                        <h2 class="card-title mb-0">Password Recovery</h2>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($step === 1): ?>
                            <!-- Step 1: Email verification -->
                            <div class="text-center mb-4">
                                <div class="icon-box mb-4">
                                    <i class="fas fa-lock text-primary fa-3x"></i>
                                </div>
                                <p class="text-muted">Enter your registered email address to reset your password.</p>
                            </div>
                            
                            <form action="forgot_password_process.php" method="post">
                                <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email" 
                                            placeholder="Enter your registered email" required>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-arrow-right me-2"></i> Continue
                                    </button>
                                </div>
                                
                                <div class="text-center mt-4">
                                    <a href="login.php" class="link-secondary">
                                        <i class="fas fa-arrow-left me-1"></i> Back to Login
                                    </a>
                                </div>
                            </form>
                            
                        <?php else: ?>
                            <!-- Step 2: New password creation -->
                            <div class="text-center mb-4">
                                <div class="icon-box mb-4">
                                    <i class="fas fa-key text-primary fa-3x"></i>
                                </div>
                                <p class="text-muted">Enter your new password for <strong><?= htmlspecialchars($_SESSION['reset_email']) ?></strong></p>
                            </div>
                            
                            <form action="forgot_password_process.php" method="post">
                                <input type="hidden" name="action" value="update_password">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['reset_email']) ?>">
                                
                                <div class="form-group mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" class="form-control" id="new_password" name="new_password" 
                                            placeholder="Enter your new password" required minlength="8">
                                    </div>
                                    <div class="form-text">Password must be at least 8 characters</div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                            placeholder="Confirm your new password" required>
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Update Password
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.auth-section {
    padding: 4rem 0;
    background-color: #f8f9fa;
    min-height: 80vh;
    display: flex;
    align-items: center;
}

.auth-card {
    border-radius: 10px;
    overflow: hidden;
}

.icon-box {
    height: 80px;
    width: 80px;
    margin: 0 auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(var(--primary-rgb), 0.1);
}

.btn-lg {
    padding: 0.75rem 1.5rem;
}

.input-group-text {
    border: none;
}

.form-control {
    padding: 0.75rem 1rem;
}

.form-control:focus {
    box-shadow: none;
    border-color: var(--primary);
}
</style>

<?php include 'footer.php'; ?>