<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillSwap - Exchange Skills, Grow Together</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>     .nav-link {
            color: var(--gray-dark);
            text-decoration: none;
            padding: var(--space-sm) var(--space-md);
            font-weight: 500;
            position: relative;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link.active {
            color: var(--primary);
        } </style>
  
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="navbar-brand">
                    <i class="fas fa-sync-alt brand-icon"></i>
                    <span>SkillSwap</span>
                </a>


                <ul class="navbar-nav flex-row" id="navbarContent">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'skills.php') ? 'active' : ''; ?>" href="skills.php">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'faq.php') ? 'active' : ''; ?>" href="faq.php">FAQ</a>
                    </li>
                </ul>

                <div class="navbar-right">
                    <div class="search-box">
                        <form action="search.php" method="GET">
                            <input type="search" name="q" class="search-input" placeholder="Search skills..." aria-label="Search">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="user-dropdown" id="userDropdown">
                            <button class="user-dropdown-toggle" id="userDropdownToggle">
                                <div class="avatar">
                                    <?php echo substr($_SESSION['username'] ?? 'U', 0, 1); ?>
                                </div>
                                <span>My Account</span>
                            </button>
                            <div class="user-dropdown-menu">
                                <a href="dashboard.php" class="user-dropdown-item">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                                <a href="profile.php" class="user-dropdown-item">
                                    <i class="fas fa-user"></i>
                                    <span>My Profile</span>
                                </a>
                                <a href="messages.php" class="user-dropdown-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>Messages</span>
                                </a>
                                <div class="user-dropdown-divider"></div>
                                <a href="logout.php" class="user-dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="auth-buttons">
                            <a href="login.php" class="btn btn-outline">Login</a>
                            <a href="signup.php" class="btn btn-primary">Sign Up</a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <div class="container" style="margin-top: var(--space-md);">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
    </div>

   
</body>
</html>

