<?php
session_start();
// Check if the admin user is logged in.
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php"); // Redirect to the main login page
    exit();
}
include 'admin_header.php';
?>
<div class="container my-5">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_users.php') ? 'active' : ''; ?>"><a href="manage_users.php">Manage Users</a></li>
                <li class="list-group-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_skills.php') ? 'active' : ''; ?>"><a href="manage_skills.php">Manage Skill Posts</a></li>
                <li class="list-group-item <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_messages.php') ? 'active' : ''; ?>"><a href="manage_messages.php">Manage Messages</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2>Overview</h2>
            <p>Statistics and recent activity can be displayed here.</p>
            <!-- Admin analytics, reports, etc. would go here -->
        </div>
    </div>
</div>
<?php include 'admin_footer.php'; ?>