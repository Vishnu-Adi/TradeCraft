<?php
session_start();
// 1. Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Return an error or redirect to login
    // For AJAX later, you might return JSON: echo json_encode(['error' => 'Not authenticated']); exit();
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

// 2. Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $conversationId = isset($_POST['conversation_id']) ? intval($_POST['conversation_id']) : null;
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // 3. Basic Input Validation
    if ($conversationId === null || $conversationId <= 0) {
        $_SESSION['error'] = "Invalid conversation specified.";
        // Redirect back, potentially to the main messages page if ID is missing/invalid
        header("Location: messages.php" . ($conversationId ? "?conversation_id=" . $conversationId : ""));
        exit();
    }

    if (empty($message)) {
        $_SESSION['error'] = "Message cannot be empty.";
        header("Location: messages.php?conversation_id=" . $conversationId);
        exit();
    }

    // Limit message length (optional but recommended)
    $maxLength = 2000; // Example limit
    if (strlen($message) > $maxLength) {
        $_SESSION['error'] = "Message is too long (max $maxLength characters).";
        header("Location: messages.php?conversation_id=" . $conversationId);
        exit();
    }

    // 4. Verify User Participation in the Conversation
    $stmt_check = $conn->prepare("SELECT 1 FROM conversation_participants WHERE conversation_id = ? AND user_id = ?");
    if (!$stmt_check) {
        error_log("Prepare failed (check participation): " . $conn->error);
        $_SESSION['error'] = "An error occurred validating the conversation.";
        header("Location: messages.php?conversation_id=" . $conversationId);
        exit();
    }
    $stmt_check->bind_param("ii", $conversationId, $userId);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows == 0) {
        $_SESSION['error'] = "You are not part of this conversation.";
        $stmt_check->close();
        header("Location: messages.php"); // Redirect to main messages page if not a participant
        exit();
    }
    $stmt_check->close();

    // 5. Insert the Message into the Database
    $stmt_insert = $conn->prepare("INSERT INTO messages (conversation_id, sender_id, message, created_at, is_read) VALUES (?, ?, ?, NOW(), 0)");
    if (!$stmt_insert) {
        error_log("Prepare failed (insert message): " . $conn->error);
        $_SESSION['error'] = "Failed to send message due to a server error.";
        header("Location: messages.php?conversation_id=" . $conversationId);
        exit();
    }

    $stmt_insert->bind_param("iis", $conversationId, $userId, $message);

    if ($stmt_insert->execute()) {
        // Success! Message was sent
        // Optional: Set session success message
        $_SESSION['success'] = "Message sent successfully.";
    } else {
        error_log("Failed to execute insert message: " . $stmt_insert->error);
        $_SESSION['error'] = "Failed to send message. Please try again.";
    }
    $stmt_insert->close();

    // 6. Redirect back to the conversation
    header("Location: messages.php?conversation_id=" . $conversationId);
    exit();

} else {
    // Prevent direct access / non-POST requests
    $_SESSION['error'] = "Invalid request method.";
    header("Location: messages.php");
    exit();
}

$conn->close();
?>