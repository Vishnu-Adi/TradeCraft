<?php
include 'db_connect.php';
include 'header.php';

// Get the skill ID from the query parameter
$skillId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the skill data from the database (using prepared statements)
$stmt = $conn->prepare("SELECT s.*, u.fullName, u.email FROM skills s JOIN users u ON s.user_id = u.id WHERE s.id = ?");
$stmt->bind_param("i", $skillId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $skill = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "Skill not found.";
     header("Location: skills.php"); // redirect with error
    exit();
}

$stmt->close();
?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-6">
        <?php if($skill['image']): ?>
      <img src="<?php echo htmlspecialchars($skill['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($skill['title']); ?>">
        <?php else: ?>
            <img src="images/default_skill.jpg" class="img-fluid" alt="Default Skill Image">
        <?php endif; ?>
    </div>
    <div class="col-md-6">
      <h1><?php echo htmlspecialchars($skill['title']); ?></h1>
      <p><strong>Category:</strong> <?php echo htmlspecialchars($skill['category']); ?></p>
      <p><strong>Description:</strong> <?php echo htmlspecialchars($skill['description']); ?></p>
      <p><strong>Details:</strong> <?php echo htmlspecialchars($skill['details']); ?></p>
      <p><strong>Availability:</strong> <?php echo htmlspecialchars($skill['availability']); ?></p>
      <p><strong>Posted by:</strong> <?php echo htmlspecialchars($skill['fullName']); ?></p>

      <!-- Contact/Interest Button (with check for own skill) -->
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $skill['user_id']): ?>
            <a href="messages.php?recipient_id=<?php echo $skill['user_id']; ?>" class="btn btn-primary">Contact <?php echo htmlspecialchars($skill['fullName']); ?></a>
        <?php elseif (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn btn-primary">Login to Contact</a>
        <?php endif; ?>
    </div>
  </div>
</div>

<?php
include 'footer.php';
$conn->close();
?>