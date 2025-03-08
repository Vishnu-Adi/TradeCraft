<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include '../db_connect.php';

if (isset($_GET['id'])) {
    $skillId = intval($_GET['id']);

    // Delete
    $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->bind_param("i", $skillId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Skill deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete skill: " . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Skill ID not provided";
}

header("Location: manage_skills.php");
exit();
$conn->close();
?>