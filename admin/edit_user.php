<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include 'admin_header.php';
include '../db_connect.php';

// Get the user ID from the query parameter and validate
$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch user data
$stmt = $conn->prepare("SELECT id, fullName, email, bio, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "User not found.";
    header("Location: manage_users.php");
    exit();
}
$stmt->close();
?>

<div class="container my-5">
    <h1>Edit User</h1>
    <form action="update_user.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo htmlspecialchars($user['fullName']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="3"><?php echo htmlspecialchars($user['bio']); ?></textarea>
        </div>

        <?php if ($user['profile_image']): ?>
            <div class="form-group">
                <label>Current Profile Image</label><br>
                <img src="<?php echo '../'.htmlspecialchars($user['profile_image']); ?>" alt="Current Profile Image" style="max-width: 200px; max-height: 200px;">
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="profileImage">Upload New Profile Image (optional)</label>
            <input type="file" class="form-control-file" id="profileImage" name="profileImage">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
include 'admin_footer.php';
$conn->close();
?>