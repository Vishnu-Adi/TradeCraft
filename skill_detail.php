<?php
include 'header.php';

// Get the skill ID from the query parameter
$skill_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Dummy data for demonstration (replace with a DB query in production)
$dummy_skills = [
  1 => [
    'title'    => 'Cooking Lessons',
    'description' => 'Detailed cooking lessons for beginners.',
    'image'    => 'images/cooking.jpg',
    'details'  => 'This course covers recipes, kitchen safety, and essential cooking techniques.'
  ],
  2 => [
    'title'    => 'Web Development',
    'description' => 'Learn the basics of web development.',
    'image'    => 'images/webdev.jpg',
    'details'  => 'Covers HTML, CSS, JavaScript, and PHP fundamentals.'
  ],
  3 => [
    'title'    => 'Photography Basics',
    'description' => 'An introductory course on photography.',
    'image'    => 'images/photography.jpg',
    'details'  => 'Learn about composition, lighting, and camera settings for better photos.'
  ],
];

if (!array_key_exists($skill_id, $dummy_skills)) {
  echo '<div class="container my-5"><p>Skill not found.</p></div>';
  include 'footer.php';
  exit();
}

$skill = $dummy_skills[$skill_id];
?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-6">
      <img src="<?php echo $skill['image']; ?>" class="img-fluid" alt="<?php echo htmlspecialchars($skill['title']); ?>">
    </div>
    <div class="col-md-6">
      <h1><?php echo htmlspecialchars($skill['title']); ?></h1>
      <p><?php echo htmlspecialchars($skill['description']); ?></p>
      <p><?php echo htmlspecialchars($skill['details']); ?></p>
      <!-- Option to contact or show interest in the skill -->
      <a href="create_skill.php" class="btn btn-primary">Express Interest</a>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
