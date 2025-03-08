<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include '../db_connect.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Delete the user (using prepared statements)
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "User deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete user: " . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['error'] = 'User id not provided';
}

header("Location: manage_users.php"); // Redirect back to the user list
exit();
$conn->close();
?>