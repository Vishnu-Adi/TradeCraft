<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include '../db_connect.php';

if (isset($_GET['id'])) {
    $conversationId = intval($_GET['id']);

    // Delete conversation
    $stmt = $conn->prepare("DELETE FROM conversations WHERE id = ?");
    $stmt->bind_param("i", $conversationId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Conversation deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete conversation: " . $stmt->error;
    }
    $stmt->close();
}

header("Location: manage_messages.php");
exit();
$conn->close();
?>