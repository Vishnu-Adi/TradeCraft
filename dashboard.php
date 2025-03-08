<?php
session_start();
// Ensure user is logged in; if not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Dummy user name for demonstration; replace with actual data from your DB.
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
?>

<?php include 'header.php'; ?>

<div class="container my-5">
  <h1>Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
  <p>This is your dashboard where you can view your recent activities and access quick links to manage your account.</p>
  
  <!-- Quick Links Section -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Edit Profile</h5>
          <p class="card-text">Update your personal information.</p>
          <a href="profile.php" class="btn btn-primary">Edit Profile</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">My Skill Posts</h5>
          <p class="card-text">View and manage your skill exchange posts.</p>
          <a href="my_skills.php" class="btn btn-primary">My Skills</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Messages</h5>
          <p class="card-text">Check your inbox and send messages.</p>
          <a href="messages.php" class="btn btn-primary">View Messages</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Activities Section -->
  <h2>Recent Activities</h2>
  <ul class="list-group">
    <!-- Replace these dummy items with dynamic content from your database -->
    <li class="list-group-item">You posted a new skill exchange: "Photography Basics".</li>
    <li class="list-group-item">Your profile was updated.</li>
    <li class="list-group-item">You received a message from John Doe.</li>
  </ul>
</div>

<?php include 'footer.php'; ?>
