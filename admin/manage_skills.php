<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}
include 'admin_header.php';
include '../db_connect.php'; // Include database connection

// Fetch skills
$stmt = $conn->prepare("SELECT id, title, category, created_at FROM skills"); // Removed status
$stmt->execute();
$result = $stmt->get_result();
$skills = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="container my-5">
    <h1>Manage Skill Posts</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($skills as $skill): ?>
            <tr>
                <td><?php echo htmlspecialchars($skill['id']); ?></td>
                <td><?php echo htmlspecialchars($skill['title']); ?></td>
                <td><?php echo htmlspecialchars($skill['category']); ?></td>
                <td><?php echo htmlspecialchars($skill['created_at']); ?></td>
                <td>
                   <!-- <a href="approve_skill.php?id=<?php //echo $skill['id']; ?>" class="btn btn-sm btn-success">Approve</a> -->
                    <a href="edit_skill.php?id=<?php echo $skill['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="delete_skill.php?id=<?php echo $skill['id']; ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this skill post?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
include 'admin_footer.php';
$conn->close();
?>