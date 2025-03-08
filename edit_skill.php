<?php
// Get the skill ID from the query parameter (in production, validate and fetch from DB)
$skill_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Dummy data for the skill (replace with a DB query)
$dummy_skill = [
  'title'        => 'Photography Basics',
  'description'  => 'Learn photography basics in a fun and interactive way.',
  'details'      => 'Detailed course content covering composition, lighting, and camera settings.',
  'category'     => 'photography',
  'availability' => 'Weekends'
];

include 'header.php';
?>

<div class="container my-5">
  <h1>Edit Skill Post</h1>
  <form action="edit_skill_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $skill_id; ?>">
    <div class="form-group">
      <label for="title">Skill Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($dummy_skill['title']); ?>" required>
    </div>
    <div class="form-group">
      <label for="description">Short Description</label>
      <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($dummy_skill['description']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="details">Detailed Description</label>
      <textarea class="form-control" id="details" name="details" rows="5"><?php echo htmlspecialchars($dummy_skill['details']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" id="category" name="category">
        <option value="cooking" <?php if ($dummy_skill['category'] == 'cooking') echo 'selected'; ?>>Cooking</option>
        <option value="webdev" <?php if ($dummy_skill['category'] == 'webdev') echo 'selected'; ?>>Web Development</option>
        <option value="photography" <?php if ($dummy_skill['category'] == 'photography') echo 'selected'; ?>>Photography</option>
      </select>
    </div>
    <div class="form-group">
      <label for="availability">Availability</label>
      <input type="text" class="form-control" id="availability" name="availability" value="<?php echo htmlspecialchars($dummy_skill['availability']); ?>">
    </div>
    <div class="form-group">
      <label for="image">Upload New Image (optional)</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Update Skill</button>
  </form>
</div>

<?php include 'footer.php'; ?>
