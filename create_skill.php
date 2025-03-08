<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'header.php'; ?>
<div class="container my-5">
  <h1 class="mb-4">Create a New Skill Post</h1>
  <form action="create_skill_process.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Skill Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter skill title" required>
    </div>
    <div class="form-group">
      <label for="description">Short Description</label>
      <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter a short description" required></textarea>
    </div>
    <div class="form-group">
      <label for="details">Detailed Description</label>
      <textarea class="form-control" id="details" name="details" rows="5" placeholder="Enter a detailed description"></textarea>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" id="category" name="category">
        <option value="cooking">Cooking</option>
        <option value="webdev">Web Development</option>
        <option value="photography">Photography</option>
        <option value="writing">Writing</option>
        <option value="music">Music</option>
        <option value="art">Art</option>
        <option value="fitness">Fitness</option>
        <option value="languages">Languages</option>
      </select>
    </div>
    <div class="form-group">
      <label for="availability">Availability</label>
      <input type="text" class="form-control" id="availability" name="availability" placeholder="e.g., Weekends, Evenings">
    </div>
    <div class="form-group">
      <label for="image">Upload Image (optional)</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Post Skill</button>
  </form>
</div>
<?php include 'footer.php'; ?>