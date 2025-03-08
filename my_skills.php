<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
include 'header.php';

$userId = $_SESSION['user_id'];

// Fetch user's skills from the database
$stmt = $conn->prepare("SELECT id, title, description, category, image FROM skills WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$skills = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<div class="container my-5">
    <h1>My Skill Posts</h1>
    <a href="create_skill.php" class="btn btn-success mb-3">Create New Skill Post</a>
    <div class="row">
        <?php if (count($skills) > 0): ?>
            <?php foreach ($skills as $skill): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if ($skill['image']): ?>
                            <img src="<?php echo htmlspecialchars($skill['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($skill['title']); ?>">
                        <?php else: ?>
                            <img src="images/default_skill.jpg" class="card-img-top" alt="Default Skill Image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($skill['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($skill['description']); ?></p>
                            <p class="card-text"><small class="text-muted">Category: <?php echo htmlspecialchars($skill['category']); ?></small></p>
                            <a href="edit_skill.php?id=<?php echo $skill['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_skill.php?id=<?php echo $skill['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>You haven't posted any skills yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
include 'footer.php';
$conn->close();
?>