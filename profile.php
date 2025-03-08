<?php
session_start();
// Ensure user is logged in; if not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Dummy user details for demonstration; replace with actual data from your database.
$userDetails = [
    'fullName' => isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'John Doe',
    'email'    => 'johndoe@example.com',
    'bio'      => 'A brief bio about yourself.',
];
?>

<?php include 'header.php'; ?>

<div class="container my-5">
  <h1>My Profile</h1>
  <form action="profile_update.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="fullName">Full Name</label>
      <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo htmlspecialchars($userDetails['fullName']); ?>" required>
    </div>
    <div class="form-group">
      <label for="email">Email Address</label>
      <!-- Typically, email is not editable after registration -->
      <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>" readonly>
    </div>
    <div class="form-group">
      <label for="bio">Bio</label>
      <textarea class="form-control" id="bio" name="bio" rows="4"><?php echo htmlspecialchars($userDetails['bio']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="profileImage">Profile Image</label>
      <input type="file" class="form-control-file" id="profileImage" name="profileImage">
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>
</div>

<?php include 'footer.php'; ?>
