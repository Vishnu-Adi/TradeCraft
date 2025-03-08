<?php
session_start();
// Check if the admin user is logged in. For example, set a session variable "admin_logged_in" when the admin logs in.
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}
?>
<?php include 'admin_header.php'; ?>
<div class="container my-5">
  <h1>Admin Dashboard</h1>
  <div class="row">
    <div class="col-md-3">
      <ul class="list-group">
        <li class="list-group-item"><a href="manage_users.php">Manage Users</a></li>
        <li class="list-group-item"><a href="manage_skills.php">Manage Skill Posts</a></li>
        <li class="list-group-item"><a href="manage_messages.php">Manage Messages</a></li>
        <!-- Add additional admin links as needed -->
      </ul>
    </div>
    <div class="col-md-9">
      <h2>Overview</h2>
      <p>Statistics and recent activity can be displayed here.</p>
      <!-- You can add admin analytics, recent reports, etc. -->
    </div>
  </div>
</div>
<?php include 'admin_footer.php'; ?>
