<?php
session_start();

// If already logged in as admin, redirect to admin dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

// Don't include regular header for admin login - use a minimal header instead
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SkillSwap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">  <!-- Correct path -->
    <style>
        :root {
            --admin-primary: #4e73df;
            --admin-secondary: #858796;
        }
        
        /* Special login page styling */
        body.admin-login-page {
            background-color: #f8f9fc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 0;
        }
    </style>
</head>
<body class="admin-login-page">
    <div class="admin-login-container">
        <!-- Error message display -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="admin-login-card">
            <div class="admin-login-header">
                <div class="admin-brand">
                    <i class="fas fa-cogs admin-brand-icon"></i> SkillSwap Admin
                </div>
                <p class="admin-login-subtitle">Administrator Authentication Portal</p>
            </div>
            
            <div class="admin-login-body">
                <form action="login_process.php" method="post" class="admin-login">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fas fa-sign-in-alt me-2"></i> Login to Dashboard
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="admin-login-footer">
                <a href="../index.php"><i class="fas fa-arrow-left me-1"></i> Return to Main Site</a>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>