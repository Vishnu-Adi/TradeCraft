<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - Community Skill Exchange</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS for Admin Panel -->
  <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
  <!-- Admin Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar" 
            aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="manage_users.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_skills.php">Skill Posts</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_messages.php">Messages</a></li>
        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
