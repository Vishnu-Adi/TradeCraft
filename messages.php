<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
include 'header.php';

$userId = $_SESSION['user_id'];

// Get the recipient ID if we're starting a new conversation
$recipientId = isset($_GET['recipient_id']) ? intval($_GET['recipient_id']) : null;

// --- 1. Handle New Conversation Start (from skill_detail.php, for example) ---
if ($recipientId) {
    // Check if a conversation already exists between these two users
    $stmt = $conn->prepare("
        SELECT c.id
        FROM conversations c
        JOIN conversation_participants cp1 ON c.id = cp1.conversation_id
        JOIN conversation_participants cp2 ON c.id = cp2.conversation_id
        WHERE cp1.user_id = ? AND cp2.user_id = ? AND cp1.user_id != cp2.user_id
    ");
    $stmt->bind_param("ii", $userId, $recipientId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Conversation exists, get its ID
        $conversationId = $result->fetch_assoc()['id'];
        header("Location: messages.php?conversation_id=" . $conversationId); // Redirect
        exit();

    } else {
        // No conversation exists, create one
        $stmt->close(); // Close the previous statement

        $stmt = $conn->prepare("INSERT INTO conversations () VALUES ()");
        $stmt->execute();
        $conversationId = $conn->insert_id;
        $stmt->close();

        // Add participants
        $stmt = $conn->prepare("INSERT INTO conversation_participants (conversation_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $conversationId, $userId);
        $stmt->execute();
        $stmt->bind_param("ii", $conversationId, $recipientId);
        $stmt->execute();
        $stmt->close();

        // Redirect to the newly created conversation
        header("Location: messages.php?conversation_id=" . $conversationId);
        exit();
    }

}


// --- 2. Fetch Conversations ---
$stmt = $conn->prepare("
    SELECT
        c.id AS conversation_id,
        u.id AS other_user_id,
        u.fullName AS other_user_name,
        (SELECT message FROM messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) AS last_message,
        (SELECT created_at FROM messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) AS last_message_time
    FROM conversations c
    JOIN conversation_participants cp1 ON c.id = cp1.conversation_id
    JOIN conversation_participants cp2 ON c.id = cp2.conversation_id AND cp1.user_id != cp2.user_id
    JOIN users u ON cp2.user_id = u.id
    WHERE cp1.user_id = ?
    ORDER BY last_message_time DESC
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$conversations = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// --- 3. Determine Current Conversation ---
$conversationId = isset($_GET['conversation_id']) ? intval($_GET['conversation_id']) : null;
if (!$conversationId && count($conversations) > 0) {
    $conversationId = $conversations[0]['conversation_id']; // Default to the first conversation
}


// --- 4. Fetch Messages for Current Conversation ---
$messages = [];
if ($conversationId) {
    $stmt = $conn->prepare("
        SELECT m.message, m.sender_id, m.created_at, u.fullName AS sender_name
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
}

// --- 5. Get the other user's name in the current conversation (for display)---
$otherUserName = "";
if ($conversationId) {
    foreach ($conversations as $convo) {
        if ($convo['conversation_id'] == $conversationId) {
            $otherUserName = $convo['other_user_name'];
            break;
        }
    }
}
?>

<div class="container my-5">
    <h1>Messages</h1>
    <div class="row">
        <!-- Conversations List -->
        <div class="col-md-4">
            <h4>Conversations</h4>
            <ul class="list-group">
                <?php foreach ($conversations as $convo): ?>
                    <li class="list-group-item <?php echo ($convo['conversation_id'] == $conversationId) ? 'active' : ''; ?>">
                        <a href="messages.php?conversation_id=<?php echo $convo['conversation_id']; ?>">
                            <?php echo htmlspecialchars($convo['other_user_name']); ?>
                            <br>
                            <small class="text-muted">
                                <?php
                                  if (isset($convo['last_message'])) {
                                       echo  htmlspecialchars( (strlen($convo['last_message']) > 20) ? substr($convo['last_message'],0,20).'...' : $convo['last_message'] );
                                   } else {
                                      echo "No messages yet";
                                   }

                                ?>
                            </small>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- Conversation View -->
        <div class="col-md-8">
            <?php if ($conversationId): ?>
                <h4>Conversation with <?php echo htmlspecialchars($otherUserName); ?></h4>
                <div class="card">
                    <div class="card-body" style="height: 300px; overflow-y: auto;">
                        <?php if (!empty($messages)): ?>
                            <?php foreach ($messages as $msg): ?>
                                <div class="mb-2 <?php echo ($msg['sender_id'] == $userId) ? 'text-right' : ''; ?>">
                                    <strong><?php echo htmlspecialchars($msg['sender_name']); ?>:</strong>
                                    <span><?php echo htmlspecialchars($msg['message']); ?></span>
                                    <small class="text-muted"><?php echo htmlspecialchars($msg['created_at']); ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No messages in this conversation yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Message Form -->
                <form action="send_message.php" method="post" class="mt-3">
                    <input type="hidden" name="conversation_id" value="<?php echo $conversationId; ?>">
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="3" placeholder="Type your message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            <?php else: ?>
                <p>Select a conversation to view messages.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include 'footer.php';
$conn->close();
?>