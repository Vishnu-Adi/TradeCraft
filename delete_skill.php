<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

if (isset($_GET['id'])) {
    $skillId = intval($_GET['id']);
    $userId = $_SESSION['user_id'];

    // Verify that the skill belongs to the logged-in user
    $stmt = $conn->prepare("SELECT id FROM skills WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $skillId, $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->close();

        // Delete the skill
        $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
        $stmt->bind_param("i", $skillId);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Skill post deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete skill post.";
        }
    } else {
        $_SESSION['error'] = "You do not have permission to delete this skill post.";
        $stmt->close();
    }
} else {
    $_SESSION['error'] = "Skill ID not provided.";
}
header("Location: my_skills.php");
exit();
$conn->close();

?>