<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $conversationId = isset($_POST['conversation_id']) ? intval($_POST['conversation_id']) : null;
    $message = trim($_POST['message']);

    // Basic input validation
    if (empty($message)) {
        $_SESSION['error'] = "Message cannot be empty.";
        header("Location: messages.php?conversation_id=" . $conversationId);
        exit();
    }

    // Verify that the user is part of the conversation
    $stmt = $conn->prepare("SELECT id FROM conversation_participants WHERE conversation_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $conversationId, $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        $_SESSION['error'] = "You are not part of this conversation.";
        $stmt->close();
        header("Location: messages.php");
        exit();
    }
     $stmt->close();

    // Insert the message into the database
    $stmt = $conn->prepare("INSERT INTO messages (conversation_id, sender_id, message, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $conversationId, $userId, $message);

    if ($stmt->execute()) {
        //Success
    } else {
        $_SESSION['error'] = "Failed to send message: " . $stmt->error;
    }
    $stmt->close();
    header("Location: messages.php?conversation_id=" . $conversationId); // redirect back to conversation
    exit();

} else {
   header("Location: messages.php"); // prevent direct access
    exit();
}
$conn->close();
?>