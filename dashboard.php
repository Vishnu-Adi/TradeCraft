<?php
session_start();
// Ensure user is logged in; if not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user's name from session (or database, ideally)
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';

include 'header.php';
?>

<div class="container my-5">
  <h1>Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
  <p>This is your dashboard where you can manage your skills and interactions.</p>

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
      <div class="col-md-4">
          <div class="card text-center">
              <div class="card-body">
                  <h5 class="card-title">Create Skill</h5>
                  <p class="card-text">Create a new skill to share or request.</p>
                  <a href="create_skill.php" class="btn btn-primary">Create Skill</a>
              </div>
          </div>
      </div>
  </div>

  <!-- Recent Activities Section (Dummy Data - Replace with DB query) -->
  <h2>Recent Activities</h2>
  <ul class="list-group">
    <?php
      // Dummy activities.  In a real application, fetch these from the database.
      $activities = [
        "You posted a new skill exchange: \"Photography Basics\".",
        "Your profile was updated.",
        "You received a message from John Doe.",
      ];
      foreach ($activities as $activity): ?>
          <li class="list-group-item"><?php echo htmlspecialchars($activity); ?></li>
      <?php endforeach; ?>
  </ul>
</div>

<?php include 'footer.php'; ?>