<?php
// Always put session_start() as the very first line (before any HTML output)
session_start();
?>
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
    <style>
    :root {
        --primary: #3a86ff;
        --secondary: #ff006e;
        --success: #38b000;
        --info: #3f37c9;
        --warning: #ffbe0b;
        --danger: #ff006e;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --gray-dark: #343a40;
        --gray-light: #ced4da;
        
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        
        --space-xs: 0.25rem;
        --space-sm: 0.5rem;
        --space-md: 1rem;
        --space-lg: 1.5rem;
        --space-xl: 2rem;
        
        --radius-sm: 0.25rem;
        --radius-md: 0.5rem;
        --radius-lg: 1rem;
        --radius-full: 9999px;
        
        --transition-fast: 0.15s ease;
        --transition-normal: 0.3s ease;
    }
    
    /* Basic Resets */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    /* Navbar and Header Styles */
    .header {
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        position: relative;
        z-index: 1000;
    }
    
    .navbar {
        padding: 0.5rem 0;
    }
    
    .navbar-brand {
        display: flex;
        align-items: center;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--primary);
        text-decoration: none;
        margin-right: 2rem;
    }
    
    .brand-icon {
        margin-right: 0.5rem;
    }
    
    .navbar-nav {
        display: flex;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    
    .nav-item {
        margin: 0 0.5rem;
    }
    
    .nav-link {
        color: var(--gray-dark);
        padding: 0.5rem 1rem;
        text-decoration: none;
        font-weight: 500;
        position: relative;
        transition: color 0.2s ease;
    }
    
    .nav-link:hover, .nav-link.active {
        color: var(--primary);
    }
    
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        width: 20px;
        height: 2px;
        background-color: var(--primary);
        transform: translateX(-50%);
    }
    
    .navbar-toggler {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        color: var(--dark);
    }
    
    .navbar-right {
        display: flex;
        align-items: center;
        margin-left: auto;
    }
    
    .search-box {
        position: relative;
        margin-right: 1rem;
    }
    
    .search-input {
        padding: 0.5rem 1rem;
        border: 1px solid var(--gray-light);
        border-radius: 20px;
        width: 200px;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);
    }
    
    .search-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--gray);
        cursor: pointer;
    }
    
    /* User Dropdown */
    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--primary);
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .user-dropdown {
        position: relative;
    }
    
    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.25rem;
    }
    
    .user-dropdown-toggle span {
        margin-left: 0.5rem;
        font-weight: 500;
    }
    
    .user-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        width: 220px;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 100;
    }
    
    .user-dropdown.active .user-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .user-dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        color: var(--dark);
        text-decoration: none;
        transition: background-color 0.15s ease;
    }
    
    .user-dropdown-item:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    .user-dropdown-item i {
        width: 20px;
        margin-right: 0.5rem;
        color: var(--gray);
    }
    
    .user-dropdown-divider {
        height: 1px;
        background-color: var(--gray-light);
        margin: 0.25rem 0;
    }
    
    /* Auth Buttons */
    .auth-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    .btn {
        display: inline-block;
        font-weight: 500;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: all 0.15s ease;
    }
    
    .btn-primary {
        color: white;
        background-color: var(--primary);
        border: 1px solid var(--primary);
    }
    
    .btn-primary:hover {
        background-color: #2a75e6;
        border-color: #2a75e6;
    }
    
    .btn-outline-primary {
        color: var(--primary);
        background-color: transparent;
        border: 1px solid var(--primary);
    }
    
    .btn-outline-primary:hover {
        color: white;
        background-color: var(--primary);
    }
    
    /* Alert styles */
    .alert {
        position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
    
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    .alert-dismissible {
        padding-right: 4rem;
    }
    
    .btn-close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0.75rem 1.25rem;
        background: transparent;
        border: 0;
        cursor: pointer;
        font-size: 1.25rem;
        font-weight: 700;
    }
    
    /* Mobile-responsive Design */
    @media (max-width: 991px) {
        .navbar-toggler {
            display: block;
        }
        
        .navbar-collapse {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background-color: white;
            box-shadow: var(--shadow-lg);
            padding: var(--space-xl);
            transform: translateX(-100%);
            transition: transform var(--transition-normal);
            z-index: 1001;
            overflow-y: auto;
            display: block;
        }
        
        .navbar-collapse.show {
            transform: translateX(0);
        }
        
        .navbar-nav {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .nav-item {
            width: 100%;
            margin: 0.25rem 0;
        }
        
        .nav-link {
            width: 100%;
            padding: 0.5rem 0;
        }
        
        .navbar-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .navbar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-normal);
        }
        
        .navbar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
    }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar d-flex flex-row align-items-center">
                <a href="index.php" class="navbar-brand">
                    <i class="fas fa-sync-alt brand-icon"></i>
                    <span>SkillSwap</span>
                </a>
                
                <button class="navbar-toggler d-lg-none" id="navbarToggler" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="navbar-collapse d-lg-flex" id="navbarContent">
                    <button class="navbar-close d-lg-none" id="navbarClose" aria-label="Close navigation">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <ul class="navbar-nav d-flex flex-row">
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
                </div>
                
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
                                <?php echo substr($_SESSION['user_name'] ?? 'U', 0, 1); ?>
                            </div>
                            <span class="d-none d-md-inline">My Account</span>
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
                        <a href="login.php" class="btn btn-outline-primary">Login</a>
                        <a href="signup.php" class="btn btn-primary">Sign Up</a>
                    </div>
                <?php endif; ?>





                </div>
                
                <div class="navbar-overlay" id="navbarOverlay"></div>
            </nav>
        </div>
    </header>
    
    <!-- Alert Messages -->
    <div class="container mt-3">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        <?php endif; ?>
    </div>