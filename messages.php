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
$otherUserId = 0;
if ($conversationId) {
    foreach ($conversations as $convo) {
        if ($convo['conversation_id'] == $conversationId) {
            $otherUserName = $convo['other_user_name'];
            $otherUserId = $convo['other_user_id'];
            break;
        }
    }
}
?>

<section class="messages-section">
    <div class="container">
        <div class="messages-container">
            <!-- Sidebar with conversations list -->
            <div class="conversations-sidebar">
                <div class="conversations-header">
                    <h2>Messages</h2>
                    <div class="conversations-actions">
                        <button class="new-message-btn" title="New Message">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
                
                <div class="conversations-search">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search conversations..." class="search-input">
                    </div>
                </div>
                
                <div class="conversations-list">
                    <?php if (empty($conversations)): ?>
                        <div class="empty-conversations">
                            <div class="empty-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <p>No conversations yet</p>
                            <p class="empty-subtitle">Start exchanging skills to connect with others</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($conversations as $convo): ?>
                            <a href="messages.php?conversation_id=<?php echo $convo['conversation_id']; ?>" class="conversation-item <?php echo ($convo['conversation_id'] == $conversationId) ? 'active' : ''; ?>">
                                <div class="conversation-avatar">
                                    <?php echo substr($convo['other_user_name'], 0, 1); ?>
                                </div>
                                <div class="conversation-content">
                                    <div class="conversation-header">
                                        <h3 class="conversation-name"><?php echo htmlspecialchars($convo['other_user_name']); ?></h3>
                                        <?php if (isset($convo['last_message_time'])): ?>
                                            <span class="conversation-time"><?php echo date('M d', strtotime($convo['last_message_time'])); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="conversation-preview">
                                        <?php
                                        if (isset($convo['last_message'])) {
                                            echo htmlspecialchars((strlen($convo['last_message']) > 30) ? substr($convo['last_message'], 0, 30) . '...' : $convo['last_message']);
                                        } else {
                                            echo "No messages yet";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Main chat area -->
            <div class="chat-area">
                <?php if ($conversationId): ?>
                    <div class="chat-header">
                        <div class="chat-user-info">
                            <div class="chat-avatar">
                                <?php echo substr($otherUserName, 0, 1); ?>
                            </div>
                            <div class="chat-user-details">
                                <h3><?php echo htmlspecialchars($otherUserName); ?></h3>
                                <span class="user-status online">Online</span>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <a href="profile.php?id=<?php echo $otherUserId; ?>" class="chat-action-btn" title="View Profile">
                                <i class="fas fa-user"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="chat-messages" id="chatMessages">
                        <?php if (empty($messages)): ?>
                            <div class="empty-messages">
                                <div class="empty-icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <p>No messages yet</p>
                                <p class="empty-subtitle">Send a message to start the conversation</p>
                            </div>
                        <?php else: ?>
                            <?php 
                            $currentDate = '';
                            foreach ($messages as $msg): 
                                $messageDate = date('Y-m-d', strtotime($msg['created_at']));
                                if ($messageDate != $currentDate) {
                                    $currentDate = $messageDate;
                                    $dateDisplay = (date('Y-m-d') == $messageDate) ? 'Today' : date('F j, Y', strtotime($messageDate));
                                    echo '<div class="message-date-divider"><span>' . $dateDisplay . '</span></div>';
                                }
                            ?>
                                <div class="message-wrapper <?php echo ($msg['sender_id'] == $userId) ? 'outgoing' : 'incoming'; ?>">
                                    <div class="message">
                                        <div class="message-content">
                                            <?php echo htmlspecialchars($msg['message']); ?>
                                        </div>
                                        <div class="message-meta">
                                            <span class="message-time"><?php echo date('g:i A', strtotime($msg['created_at'])); ?></span>
                                            <?php if ($msg['sender_id'] == $userId): ?>
                                                <span class="message-status">
                                                    <i class="fas fa-check-double"></i>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="chat-input-area">
                        <form action="send_message.php" method="post" id="messageForm">
                            <input type="hidden" name="conversation_id" value="<?php echo $conversationId; ?>">
                            <div class="chat-input-wrapper">
                                <div class="chat-input-actions">
                                    <button type="button" class="chat-input-action-btn" title="Attach File">
                                        <i class="fas fa-paperclip"></i>
                                    </button>
                                </div>
                                <textarea name="message" class="chat-input" placeholder="Type your message..." required></textarea>
                                <button type="submit" class="chat-send-btn" title="Send Message">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="empty-chat">
                        <div class="empty-chat-content">
                            <div class="empty-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h3>No conversation selected</h3>
                            <p>Choose a conversation from the list or start a new one</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
/* Messages Page Styles */
.messages-section {
    padding: var(--space-xl) 0;
    min-height: calc(100vh - 200px);
}

.messages-container {
    display: grid;
    grid-template-columns: 320px 1fr;
    background-color: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    height: 700px;
}

/* Conversations Sidebar */
.conversations-sidebar {
    border-right: 1px solid var(--gray-light);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.conversations-header {
    padding: var(--space-md) var(--space-lg);
    border-bottom: 1px solid var(--gray-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.conversations-header h2 {
    font-size: 1.25rem;
    margin: 0;
}

.conversations-actions {
    display: flex;
    gap: var(--space-sm);
}

.new-message-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: var(--primary);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.new-message-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

.conversations-search {
    padding: var(--space-md) var(--space-lg);
    border-bottom: 1px solid var(--gray-light);
}

.search-input-wrapper {
    position: relative;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
}

.search-input {
    width: 100%;
    padding: 0.625rem 1rem 0.625rem 2.5rem;
    border: 1px solid var(--gray-light);
    border-radius: var(--radius-full);
    font-size: 0.875rem;
    transition: all var(--transition-fast);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);
}

.conversations-list {
    flex: 1;
    overflow-y: auto;
    padding: var(--space-md) 0;
}

.conversation-item {
    display: flex;
    align-items: center;
    padding: var(--space-md) var(--space-lg);
    text-decoration: none;
    color: var(--dark);
    transition: background-color var(--transition-fast);
    border-left: 3px solid transparent;
}

.conversation-item:hover {
    background-color: rgba(0, 0, 0, 0.03);
}

.conversation-item.active {
    background-color: rgba(58, 134, 255, 0.05);
    border-left-color: var(--primary);
}

.conversation-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background-color: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.25rem;
    margin-right: var(--space-md);
    flex-shrink: 0;
}

.conversation-content {
    flex: 1;
    min-width: 0;
}

.conversation-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-xs);
}

.conversation-name {
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.conversation-time {
    font-size: 0.75rem;
    color: var(--gray);
}

.conversation-preview {
    font-size: 0.875rem;
    color: var(--gray);
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.empty-conversations {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: var(--space-xl);
    text-align: center;
}

.empty-icon {
    font-size: 3rem;
    color: var(--gray-light);
    margin-bottom: var(--space-md);
}

.empty-conversations p {
    margin: 0;
    color: var(--gray);
}

.empty-subtitle {
    font-size: 0.875rem;
    margin-top: var(--space-xs) !important;
}

/* Chat Area */
.chat-area {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.chat-header {
    padding: var(--space-md) var(--space-xl);
    border-bottom: 1px solid var(--gray-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-user-info {
    display: flex;
    align-items: center;
}

.chat-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.125rem;
    margin-right: var(--space-md);
}

.chat-user-details h3 {
    font-size: 1.125rem;
    margin: 0 0 var(--space-xs);
}

.user-status {
    font-size: 0.75rem;
    display: flex;
    align-items: center;
}

.user-status::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: var(--space-xs);
}

.user-status.online {
    color: var(--success);
}

.user-status.online::before {
    background-color: var(--success);
}

.chat-actions {
    display: flex;
    gap: var(--space-sm);
}

.chat-action-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.05);
    color: var(--gray-dark);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.chat-action-btn:hover {
    background-color: rgba(0, 0, 0, 0.1);
    color: var(--primary);
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: var(--space-lg) var(--space-xl);
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
}

.message-date-divider {
    text-align: center;
    margin: var(--space-md) 0;
    position: relative;
}

.message-date-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--gray-light);
    z-index: 1;
}

.message-date-divider span {
    position: relative;
    background-color: white;
    padding: 0 var(--space-md);
    font-size: 0.75rem;
    color: var(--gray);
    z-index: 2;
}

.message-wrapper {
    display: flex;
    flex-direction: column;
}

.message-wrapper.incoming {
    align-items: flex-start;
}

.message-wrapper.outgoing {
    align-items: flex-end;
}

.message {
    max-width: 70%;
    position: relative;
}

.message-content {
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-lg);
    font-size: 0.9375rem;
    line-height: 1.5;
}

.incoming .message-content {
    background-color: var(--gray-light);
    color: var(--dark);
    border-bottom-left-radius: 0;
}

.outgoing .message-content {
    background-color: var(--primary);
    color: white;
    border-bottom-right-radius: 0;
}

.message-meta {
    display: flex;
    align-items: center;
    gap: var(--space-xs);
    margin-top: var(--space-xs);
    font-size: 0.75rem;
}

.incoming .message-meta {
    padding-left: var(--space-sm);
}

.outgoing .message-meta {
    padding-right: var(--space-sm);
    justify-content: flex-end;
}

.message-time {
    color: var(--gray);
}

.message-status {
    color: var(--primary);
}

.empty-messages {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    text-align: center;
}

.empty-messages .empty-icon {
    font-size: 3rem;
    color: var(--gray-light);
    margin-bottom: var(--space-md);
}

.empty-messages p {
    margin: 0;
    color: var(--gray);
}

.chat-input-area {
    padding: var(--space-md) var(--space-xl);
    border-top: 1px solid var(--gray-light);
}

.chat-input-wrapper {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    background-color: rgba(0, 0, 0, 0.03);
    border-radius: var(--radius-full);
    padding: var(--space-xs) var(--space-sm);
}

.chat-input-actions {
    display: flex;
    gap: var(--space-xs);
}

.chat-input-action-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: none;
    color: var(--gray);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.chat-input-action-btn:hover {
    background-color: rgba(0, 0, 0, 0.05);
    color: var(--primary);
}

.chat-input {
    flex: 1;
    border: none;
    background: none;
    padding: var(--space-sm) 0;
    resize: none;
    max-height: 120px;
    font-size: 0.9375rem;
}

.chat-input:focus {
    outline: none;
}

.chat-send-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.chat-send-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

.empty-chat {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: var(--space-xl);
}

.empty-chat-content {
    text-align: center;
    max-width: 400px;
}

.empty-chat .empty-icon {
    font-size: 4rem;
    color: var(--gray-light);
    margin-bottom: var(--space-lg);
}

.empty-chat h3 {
    font-size: 1.5rem;
    margin-bottom: var(--space-md);
}

.empty-chat p {
    color: var(--gray);
    margin: 0;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .messages-container {
        grid-template-columns: 1fr;
        height: 80vh;
    }
    
    .conversations-sidebar {
        display: none;
    }
    
    .conversations-sidebar.active {
        display: flex;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }
    
    .chat-header {
        position: relative;
    }
    
    .chat-header::before {
        content: '\f053';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: var(--space-md);
        top: 50%;
        transform: translateY(-50%);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    
    .chat-user-info {
        margin-left: var(--space-xl);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to bottom of chat messages
    const chatMessages = document.getElementById('chatMessages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Auto-resize textarea
    const chatInput = document.querySelector('.chat-input');
    if (chatInput) {
        chatInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    }
    
    // Mobile navigation between conversations and chat
    const backButton = document.querySelector('.chat-header::before');
    const conversationsSidebar = document.querySelector('.conversations-sidebar');
    
    if (backButton && conversationsSidebar) {
        backButton.addEventListener('click', function() {
            conversationsSidebar.classList.add('active');
        });
        
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth <= 991) {
                    conversationsSidebar.classList.remove('active');
                }
            });
        });
    }
    
    // Form submission
    const messageForm = document.getElementById('messageForm');
    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            const messageInput = this.querySelector('.chat-input');
            if (!messageInput.value.trim()) {
                e.preventDefault();
            }
        });
    }
});
</script>

<?php
include 'footer.php';
$conn->close();
?>

