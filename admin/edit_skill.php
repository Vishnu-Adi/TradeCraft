<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include 'admin_header.php';
include '../db_connect.php';

// Get the skill ID
$skillId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch skill data
$stmt = $conn->prepare("SELECT * FROM skills WHERE id = ?");
$stmt->bind_param("i", $skillId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $skill = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "Skill not found.";
    header("Location: manage_skills.php");
    exit();
}
$stmt->close();
?>
<div class="container my-5">
    <h1>Edit Skill Post (Admin)</h1>
    <form action="update_skill.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($skillId); ?>">

        <div class="form-group">
            <label for="title">Skill Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($skill['title']); ?>"
                   required>
        </div>
        <div class="form-group">
            <label for="description">Short Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                      required><?php echo htmlspecialchars($skill['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="details">Detailed Description</label>
            <textarea class="form-control" id="details" name="details"
                      rows="5"><?php echo htmlspecialchars($skill['details']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <option value="cooking" <?php if ($skill['category'] == 'cooking') echo 'selected'; ?>>Cooking</option>
                <option value="webdev" <?php if ($skill['category'] == 'webdev') echo 'selected'; ?>>Web Development
                </option>
                <option value="photography" <?php if ($skill['category'] == 'photography') echo 'selected'; ?>>
                    Photography
                </option>
                <option value="writing" <?php if ($skill['category'] == 'writing') echo 'selected'; ?>>Writing</option>
                <option value="music" <?php if ($skill['category'] == 'music') echo 'selected'; ?>>Music</option>
                <option value="art" <?php if ($skill['category'] == 'art') echo 'selected'; ?>>Art</option>
                <option value="fitness" <?php if ($skill['category'] == 'fitness') echo 'selected'; ?>>Fitness</option>
                <option value="languages" <?php if ($skill['category'] == 'languages') echo 'selected'; ?>>Languages
                </option>

            </select>
        </div>
        <div class="form-group">
            <label for="availability">Availability</label>
            <input type="text" class="form-control" id="availability" name="availability"
                   value="<?php echo htmlspecialchars($skill['availability']); ?>">
        </div>

          <?php if ($skill['image']): ?>
              <div class="form-group">
                  <label>Current Image</label><br>
                  <img src="<?php echo '../'.htmlspecialchars($skill['image']); ?>" alt="Current Skill Image" style="max-width: 200px; max-height: 200px;">
              </div>
          <?php endif; ?>

        <div class="form-group">
            <label for="image">Upload New Image (optional)</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Update Skill</button>
        <a href="manage_skills.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
include 'admin_footer.php';
$conn->close();
?>