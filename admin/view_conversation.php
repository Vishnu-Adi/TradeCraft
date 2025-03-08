<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include 'admin_header.php';
include '../db_connect.php';

$conversationId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch messages within the conversation
$stmt = $conn->prepare("
    SELECT m.message, m.created_at, u.fullName AS sender_name
    FROM messages m
    JOIN users u ON m.sender_id = u.id
    WHERE m.conversation_id = ?
    ORDER BY m.created_at ASC
");
$stmt->bind_param("i", $conversationId);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

 // Get participants
$stmt = $conn->prepare("
    SELECT GROUP_CONCAT(DISTINCT u.fullName ORDER BY u.id SEPARATOR ', ') AS participants
    FROM conversations c
    JOIN conversation_participants cp ON c.id = cp.conversation_id
    JOIN users u ON cp.user_id = u.id
    WHERE c.id = ?
");
$stmt->bind_param("i", $conversationId);
$stmt -> execute();
$stmt->bind_result($participants);
$stmt -> fetch();
$stmt->close();


?>

<div class="container my-5">
    <h1>View Conversation (ID: <?php echo htmlspecialchars($conversationId); ?>)</h1>
    <h4>Participants: <?php echo htmlspecialchars($participants); ?></h4>
    <div class="card">
        <div class="card-body" style="height: 400px; overflow-y: auto;">
            <?php if (count($messages) > 0): ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="mb-2">
                        <strong><?php echo htmlspecialchars($msg['sender_name']); ?>:</strong>
                        <span><?php echo htmlspecialchars($msg['message']); ?></span>
                        <small class="text-muted"><?php echo htmlspecialchars($msg['created_at']); ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No messages in this conversation.</p>
            <?php endif; ?>
        </div>
    </div>
    <a href="manage_messages.php" class="btn btn-secondary mt-3">Back to Manage Messages</a>
</div>
<?php
include 'admin_footer.php';
$conn->close();
?>