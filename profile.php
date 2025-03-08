<?php
session_start();
// Ensure user is logged in; if not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
include 'header.php';

$userId = $_SESSION['user_id'];

// Fetch user details from the database (using prepared statements)
$stmt = $conn->prepare("SELECT fullName, email, bio, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $userDetails = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "User not found."; // Should not happen, but good to have a check
    header("Location: dashboard.php");
    exit();
}

$stmt->close();
?>

<div class="container my-5">
    <h1 class="mb-4">My Profile</h1>
    <form action="profile_update.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName"
                   value="<?php echo htmlspecialchars($userDetails['fullName']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <!-- Typically, email is not editable after registration -->
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php echo htmlspecialchars($userDetails['email']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea class="form-control" id="bio" name="bio"
                      rows="4"><?php echo htmlspecialchars($userDetails['bio']); ?></textarea>
        </div>
        <?php if ($userDetails['profile_image']): ?>
            <div class="form-group">
                <label>Current Profile Image</label><br>
                <img src="<?php echo htmlspecialchars($userDetails['profile_image']); ?>" alt="Current Profile Image"
                     style="max-width: 200px; max-height: 200px;">
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="profileImage">Profile Image</label>
            <input type="file" class="form-control-file" id="profileImage" name="profileImage">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php
include 'footer.php';
$conn->close();
?>