<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Community Skill Exchange</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom CSS for Admin Panel -->
  <link rel="stylesheet" href="../css/admin_style.css">  <!-- Corrected path -->
</head>
<body>
  <!-- Admin Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_users.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="manage_users.php">Users</a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_skills.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="manage_skills.php">Skill Posts</a>
            </li>
            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_messages.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="manage_messages.php">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
          </ul>
        </div>
    </div>
  </nav>
    <!-- Centralized Message Display -->
    <div class="container mt-3">
        <?php session_start();  /*start session*/ ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
    </div>