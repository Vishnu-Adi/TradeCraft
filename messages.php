<?php
// Enable error reporting for debugging



session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
include 'header.php';

// Display success message if exists
if(isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['success'] . 
         '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['success']);
}

// Display error message if exists
if(isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $_SESSION['error'] . 
         '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['error']);
}

$userId = $_SESSION['user_id'];
$conversationId = null; // Initialize conversation ID
$otherUserName = "";    // Initialize other user's name
$otherUserId = 0;       // Initialize other user's ID
$messages = [];         // Initialize messages array
$conversations = [];    // Initialize conversations array


// --- 1. Handle Starting a New Conversation via recipient_id ---
$recipientId = isset($_GET['recipient_id']) ? intval($_GET['recipient_id']) : null;

if ($recipientId && $recipientId != $userId) {
    $conn->begin_transaction();
    try {
        // Check if a conversation already exists between these two users
        $stmt_check = $conn->prepare("
            SELECT cp1.conversation_id
            FROM conversation_participants cp1
            JOIN conversation_participants cp2 ON cp1.conversation_id = cp2.conversation_id
            WHERE cp1.user_id = ? AND cp2.user_id = ? AND cp1.user_id != cp2.user_id
            LIMIT 1
        ");
        if (!$stmt_check) throw new Exception("Prepare failed (check): " . $conn->error);
        $stmt_check->bind_param("ii", $userId, $recipientId);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Conversation exists, get its ID
            $existingConversation = $result_check->fetch_assoc();
            $conversationId = $existingConversation['conversation_id'];
            $stmt_check->close();
            $conn->commit(); // Commit (though nothing changed database-wise here)
            header("Location: messages.php?conversation_id=" . $conversationId); // Redirect
            exit();
        } else {
            // No conversation exists, create one
            $stmt_check->close();

            // Create conversation record with timestamp
            $stmt_create_conv = $conn->prepare("INSERT INTO conversations (created_at) VALUES (NOW())");
            if (!$stmt_create_conv) throw new Exception("Prepare failed (create_conv): " . $conn->error);
            $stmt_create_conv->execute();
            $newConversationId = $conn->insert_id;
            $stmt_create_conv->close();

            if ($newConversationId <= 0) {
                 throw new Exception("Failed to create conversation record.");
            }

            // Add participants
            $stmt_add_part = $conn->prepare("INSERT INTO conversation_participants (conversation_id, user_id) VALUES (?, ?)");
             if (!$stmt_add_part) throw new Exception("Prepare failed (add_part): " . $conn->error);
            // Add logged-in user
            $stmt_add_part->bind_param("ii", $newConversationId, $userId);
            $stmt_add_part->execute();
            // Add recipient
            $stmt_add_part->bind_param("ii", $newConversationId, $recipientId);
            $stmt_add_part->execute();
            $stmt_add_part->close();

            $conn->commit(); // Commit transaction

            // Redirect to the newly created conversation
            header("Location: messages.php?conversation_id=" . $newConversationId);
            exit();
        }
    } catch (Exception $e) {
        $conn->rollback(); // Rollback on error
        error_log("Error starting conversation: " . $e->getMessage()); // Log the error
        $_SESSION['error'] = "Could not start the conversation. Please try again later.";
        header("Location: messages.php"); // Redirect to main messages page on error
        exit();
    }
}


// --- 2. Fetch Conversations for Sidebar ---
$stmt_conv = $conn->prepare("
    SELECT
        c.id AS conversation_id,
        other_user.id AS other_user_id,
        other_user.fullName AS other_user_name,
        last_msg.message AS last_message,
        last_msg.created_at AS last_message_time,
        last_msg.sender_id AS last_sender_id,
        0 AS unread_count /* Temporarily use constant 0 instead of a subquery */
    FROM conversation_participants cp_user
    JOIN conversations c ON cp_user.conversation_id = c.id
    JOIN conversation_participants cp_other ON c.id = cp_other.conversation_id AND cp_user.user_id != cp_other.user_id
    JOIN users other_user ON cp_other.user_id = other_user.id
    LEFT JOIN (
         SELECT conversation_id, message, sender_id, created_at
         FROM messages m_inner
         WHERE id = (SELECT MAX(id) FROM messages WHERE conversation_id = m_inner.conversation_id)
    ) last_msg ON c.id = last_msg.conversation_id
    WHERE cp_user.user_id = ?
    ORDER BY last_msg.created_at DESC, c.id DESC
");

if (!$stmt_conv) {
    die("Prepare failed (stmt_conv): " . $conn->error); // Fatal error if prepare fails
}

// Fix the bind_param call to match the number of parameters (only one ? in the query)
$stmt_conv->bind_param("i", $userId);
$stmt_conv->execute();
$result_conv = $stmt_conv->get_result();
$conversations = $result_conv->fetch_all(MYSQLI_ASSOC);
$stmt_conv->close();


// --- 3. Determine Current Conversation ID ---
$currentConversationId = isset($_GET['conversation_id']) ? intval($_GET['conversation_id']) : null;

// If no specific conversation requested, try to default to the first one
if (!$currentConversationId && count($conversations) > 0) {
    $currentConversationId = $conversations[0]['conversation_id'];
}

// --- 4. Security Check & Fetch Details for Current Conversation ---
$isParticipant = false;
if ($currentConversationId) {
    // Verify the current user is part of the selected conversation
    $stmt_check_part = $conn->prepare("SELECT 1 FROM conversation_participants WHERE conversation_id = ? AND user_id = ?");
     if (!$stmt_check_part) die("Prepare failed (stmt_check_part): " . $conn->error);
    $stmt_check_part->bind_param("ii", $currentConversationId, $userId);
    $stmt_check_part->execute();
    $stmt_check_part->store_result();
    if ($stmt_check_part->num_rows > 0) {
        $isParticipant = true;
    }
    $stmt_check_part->close();

    if ($isParticipant) {
        // --- Fetch Messages for Current Conversation ---
        $stmt_msg = $conn->prepare("
            SELECT m.id, m.message, m.sender_id, m.created_at, 
                   m.is_read, m.read_at,
                   u.fullName AS sender_name
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.conversation_id = ?
            ORDER BY m.created_at ASC
        ");
        if (!$stmt_msg) die("Prepare failed (stmt_msg): " . $conn->error);
        $stmt_msg->bind_param("i", $currentConversationId);
        $stmt_msg->execute();
        $result_msg = $stmt_msg->get_result();
        $messages = $result_msg->fetch_all(MYSQLI_ASSOC);
        $stmt_msg->close();

        // Mark messages as read
        $stmt_mark_read = $conn->prepare("UPDATE messages SET is_read = 1, read_at = NOW() WHERE conversation_id = ? AND sender_id != ? AND is_read = 0");
        if($stmt_mark_read) {
            $stmt_mark_read->bind_param("ii", $currentConversationId, $userId);
            $stmt_mark_read->execute();
            $stmt_mark_read->close();
        }

        // --- Get the other user's name and ID from the already fetched $conversations array ---
        foreach ($conversations as $convo) {
            if ($convo['conversation_id'] == $currentConversationId) {
                $otherUserName = $convo['other_user_name'];
                $otherUserId = $convo['other_user_id'];
                break;
            }
        }
    } else {
        // User is not part of this conversation
        $_SESSION['error'] = "Access denied to this conversation.";
        $currentConversationId = null; // Reset ID
    }
}

?>

<section class="messages-section">
    <div class="container-fluid">
        <div class="messages-container">
            <!-- Sidebar with conversations list -->
            <div class="conversations-sidebar" id="conversationsSidebar">
                <div class="conversations-header">
                    <h2>Messages</h2>
                    <div class="conversations-actions">
                        <button class="new-message-btn" title="New Message (Feature coming soon)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>

                <div class="conversations-search">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search conversations..." class="search-input" id="conversationSearch">
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
                            <a href="messages.php?conversation_id=<?php echo $convo['conversation_id']; ?>" class="conversation-item <?php echo ($convo['conversation_id'] == $currentConversationId) ? 'active' : ''; ?>">
                                <div class="conversation-avatar">
                                    <?php echo isset($convo['other_user_name']) ? strtoupper(substr($convo['other_user_name'], 0, 1)) : '?'; ?>
                                </div>
                                <div class="conversation-content">
                                    <div class="conversation-header">
                                        <h3 class="conversation-name"><?php echo htmlspecialchars($convo['other_user_name'] ?? 'Unknown User'); ?></h3>
                                        <?php if (isset($convo['last_message_time'])):
                                            $time = strtotime($convo['last_message_time']);
                                            if (date('Ymd') == date('Ymd', $time)) {
                                                echo '<span class="conversation-time">' . date('g:i A', $time) . '</span>'; // Time if today
                                            } else {
                                                 echo '<span class="conversation-time">' . date('M d', $time) . '</span>'; // Date if older
                                            }
                                        ?>
                                        <?php endif; ?>
                                    </div>
                                    <p class="conversation-preview">
                                         <?php
                                            $preview = "";
                                            if (isset($convo['last_message'])) {
                                                if (isset($convo['last_sender_id']) && $convo['last_sender_id'] == $userId) {
                                                     $preview .= '<i class="fas fa-reply me-1 text-muted"></i> '; // Indicate you sent last message
                                                }
                                                $preview .= htmlspecialchars((strlen($convo['last_message']) > 25) ? substr($convo['last_message'], 0, 25) . '...' : $convo['last_message']);
                                            } else {
                                                $preview = "<em class='text-muted'>No messages yet</em>";
                                            }
                                            echo $preview;
                                        ?>
                                    </p>
                                    <?php
                                        if (isset($convo['unread_count']) && $convo['unread_count'] > 0) {
                                            echo '<span class="unread-badge">' . $convo['unread_count'] . '</span>';
                                        }
                                    ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Main chat area -->
            <div class="chat-area">
                <?php if ($currentConversationId && $isParticipant): ?>
                    <div class="chat-header">
                        <div class="chat-user-info">
                             <button class="btn btn-sm btn-light d-lg-none me-3" id="showConversationsBtn" title="Show Conversations">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <div class="chat-avatar">
                                <?php echo isset($otherUserName) ? strtoupper(substr($otherUserName, 0, 1)) : '?'; ?>
                            </div>
                            <div class="chat-user-details">
                                <h3><?php echo htmlspecialchars($otherUserName); ?></h3>
                                <span class="user-status online"><i class="fas fa-circle text-success me-1"></i>Online</span>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <a href="profile.php?id=<?php echo $otherUserId; ?>" class="chat-action-btn" title="View Profile">
                                <i class="fas fa-user"></i>
                            </a>
                             <button class="chat-action-btn" title="More options" id="chatOptionsBtn">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </div>

                    <div class="chat-messages" id="chatMessages">
                        <?php if (empty($messages)): ?>
                            <div class="empty-messages">
                                <div class="empty-icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <p>No messages yet</p>
                                <p class="empty-subtitle">Send a message to start the conversation with <?php echo htmlspecialchars(explode(' ', $otherUserName)[0]); ?></p>
                            </div>
                        <?php else: ?>
                            <?php
                            $currentDate = '';
                            foreach ($messages as $msg):
                                $messageDate = date('Y-m-d', strtotime($msg['created_at']));
                                // Display date divider if the date changes
                                if ($messageDate != $currentDate) {
                                    $currentDate = $messageDate;
                                    $dateDisplay = (date('Y-m-d') == $messageDate) ? 'Today' : date('F j, Y', strtotime($messageDate));
                                    echo '<div class="message-date-divider"><span>' . $dateDisplay . '</span></div>';
                                }
                            ?>
                                <div class="message-wrapper <?php echo ($msg['sender_id'] == $userId) ? 'outgoing' : 'incoming'; ?>">
                                    <?php if ($msg['sender_id'] != $userId): // Show avatar for incoming messages ?>
                                        <div class="message-avatar">
                                             <?php echo isset($msg['sender_name']) ? strtoupper(substr($msg['sender_name'], 0, 1)) : '?'; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="message">
                                        <div class="message-content">
                                            <?php echo nl2br(htmlspecialchars($msg['message'])); // Use nl2br to respect newlines ?>
                                        </div>
                                        <div class="message-meta">
                                            <span class="message-time"><?php echo date('g:i A', strtotime($msg['created_at'])); ?></span>
                                            <?php if ($msg['sender_id'] == $userId): ?>
                                                <span class="message-status <?php echo ($msg['is_read'] == 1) ? 'read' : ''; ?>" title="<?php echo ($msg['is_read'] == 1) ? 'Read' : 'Sent'; ?>">
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
                        <form action="send_message.php" method="post" id="messageForm" class="needs-validation" novalidate>
                            <input type="hidden" name="conversation_id" value="<?php echo $currentConversationId; ?>">
                            <div class="chat-input-wrapper">
                                <div class="chat-input-actions">
                                    <button type="button" class="chat-input-action-btn" title="Attach File (Not implemented)">
                                        <i class="fas fa-paperclip"></i>
                                    </button>
                                     <button type="button" class="chat-input-action-btn" title="Emoji (Not implemented)" id="emojiButton">
                                        <i class="far fa-smile"></i>
                                    </button>
                                </div>
                                <textarea name="message" id="messageInput" class="chat-input" placeholder="Type your message..." required rows="1"></textarea>
                                <button type="submit" class="chat-send-btn" title="Send Message">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="empty-chat">
                        <div class="empty-chat-content">
                             <img src="images/message-illustration.svg" alt="Select a conversation" style="max-width: 250px; margin-bottom: 2rem;">
                            <h3>Select a Conversation</h3>
                            <p class="text-muted">Choose a conversation from the list on the left to start chatting.</p>
                             <button class="btn btn-outline-primary mt-3 d-lg-none" id="showConversationsBtnMobile">
                                <i class="fas fa-comments me-2"></i>Show Conversations
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
/* Messages Page Styles */
:root {
    --message-outgoing-bg: var(--primary);
    --message-outgoing-text: white;
    --message-incoming-bg: #f1f3f5; /* Lighter gray */
    --message-incoming-text: var(--dark);
    --sidebar-width: 320px;
    --sidebar-width-md: 280px;
    --chat-header-height: 70px;
    --chat-input-area-height: auto; /* Let it grow */
    --chat-input-min-height: 60px;
}

.messages-section {
    padding: 0; /* Remove padding for full height */
    height: calc(100vh - 70px); /* Full viewport height minus header */
    overflow: hidden; /* Prevent body scroll */
}

.messages-container {
    display: grid;
    grid-template-columns: var(--sidebar-width) 1fr;
    background-color: white;
    /* Removed border-radius and shadow for full height */
    height: 100%; /* Full height of section */
    overflow: hidden;
}

/* Conversations Sidebar */
.conversations-sidebar {
    border-right: 1px solid var(--gray-light);
    display: flex;
    flex-direction: column;
    height: 100%;
    background-color: #fcfdff; /* Slightly off-white */
    transition: transform 0.3s ease-in-out;
}

.conversations-header {
    padding: 1rem 1.25rem; /* Consistent padding */
    border-bottom: 1px solid var(--gray-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0; /* Prevent shrinking */
    background-color: white;
}

.conversations-header h2 {
    font-size: 1.15rem; /* Slightly smaller */
    font-weight: 600;
    margin: 0;
}

.conversations-actions .new-message-btn {
    width: 32px; /* Smaller button */
    height: 32px;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: none;
    background-color: #f0f2f5;
    color: var(--primary);
    cursor: pointer;
    transition: all 0.2s;
}

.conversations-actions .new-message-btn:hover {
    background-color: var(--primary);
    color: white;
}

.conversations-search {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--gray-light);
    flex-shrink: 0;
    background-color: white;
}

.search-input-wrapper {
    position: relative;
}

.search-input-wrapper .search-icon {
    position: absolute;
    left: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    color: #adb5bd;
    font-size: 0.9rem;
    pointer-events: none;
}

.search-input {
    width: 100%;
    padding: 0.5rem 1rem 0.5rem 2.2rem; /* Adjusted padding */
    font-size: 0.875rem;
    border-radius: var(--radius-md); /* Less rounded */
    border: 1px solid var(--gray-light);
    background-color: #f8f9fa;
    transition: all 0.2s;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary);
    background-color: white;
    box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
}

.conversations-list {
    flex: 1; /* Take remaining space */
    overflow-y: auto; /* Enable scrolling */
    padding: 0.5rem 0; /* Reduced padding */
}

/* Custom Scrollbar for Sidebar */
.conversations-list::-webkit-scrollbar {
    width: 6px;
}
.conversations-list::-webkit-scrollbar-track {
    background: #f1f1f1;
}
.conversations-list::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
}
.conversations-list::-webkit-scrollbar-thumb:hover {
    background: #aaa;
}

.conversation-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.25rem; /* Consistent padding */
    text-decoration: none;
    color: var(--dark);
    transition: background-color var(--transition-fast);
    border-left: 4px solid transparent; /* Wider active indicator */
    cursor: pointer;
    position: relative; /* For unread badge */
}

.conversation-item:hover {
    background-color: #eef2f7;
}

.conversation-item.active {
    background-color: #e2eafc; /* Lighter blue active state */
    border-left-color: var(--primary);
}

.conversation-item.active .conversation-name {
    font-weight: 700; /* Bold name when active */
    color: var(--primary);
}

.conversation-avatar {
    width: 40px; /* Slightly smaller */
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 500; /* Normal weight */
    font-size: 1.1rem;
    margin-right: 0.75rem; /* Reduced margin */
    flex-shrink: 0;
    text-transform: uppercase;
}

.conversation-content {
    flex: 1;
    min-width: 0; /* Prevent overflow issues */
}

.conversation-header {
    display: flex;
    justify-content: space-between;
    align-items: baseline; /* Align baseline */
    margin-bottom: 2px; /* Reduced space */
}

.conversation-name {
    font-size: 0.95rem; /* Slightly smaller */
    font-weight: 500;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #333; /* Darker text */
}

.conversation-time {
    font-size: 0.7rem; /* Smaller time */
    color: var(--gray);
    flex-shrink: 0; /* Prevent time from wrapping */
    margin-left: 0.5rem;
}

.conversation-preview {
    font-size: 0.8rem; /* Smaller preview */
    color: var(--gray);
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: flex; /* Align icon */
    align-items: center;
}

.conversation-preview .fa-reply {
    font-size: 0.75rem; /* Smaller icon */
}

.unread-badge {
    position: absolute;
    right: 1rem;
    top: 1rem;
    background-color: var(--primary);
    color: white;
    font-size: 0.65rem;
    font-weight: 600;
    min-width: 18px;
    height: 18px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 5px;
}

.empty-conversations {
    padding: 2rem 1rem; /* More padding */
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center vertically */
    align-items: center;
    text-align: center;
}

.empty-conversations .empty-icon {
    font-size: 2.5rem; /* Smaller icon */
    color: #e0e0e0; /* Lighter icon color */
    margin-bottom: 1rem;
}

.empty-conversations p {
    color: #777; /* Lighter text */
    font-size: 0.9rem;
    margin: 0;
}

.empty-conversations .empty-subtitle {
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

/* Chat Area */
.chat-area {
    display: flex;
    flex-direction: column;
    height: 100%; /* Full height */
    background-color: #ffffff; /* White chat background */
}

.chat-header {
    padding: 0 1.5rem; /* More padding */
    height: var(--chat-header-height);
    border-bottom: 1px solid var(--gray-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0; /* Prevent shrinking */
}

.chat-user-info {
    display: flex;
    align-items: center;
}

.chat-avatar {
    width: 38px; /* Consistent size */
    height: 38px;
    border-radius: 50%;
    background-color: var(--secondary); /* Different color for chat header */
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 500;
    margin-right: 0.75rem;
}

.chat-user-details h3 {
    font-size: 1.05rem; /* Slightly larger */
    font-weight: 600;
    margin: 0 0 2px; /* Adjust spacing */
}

.user-status {
    font-size: 0.75rem;
    color: #6c757d;
    display: flex;
    align-items: center;
}

.user-status .fa-circle {
    font-size: 0.5rem; /* Smaller dot */
    margin-right: 0.25rem;
}

.chat-actions {
    display: flex;
    gap: 0.5rem;
}

.chat-action-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    color: var(--gray);
    background-color: transparent;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.chat-action-btn:hover {
    background-color: var(--gray-light);
    color: var(--primary);
}

.chat-messages {
    flex: 1; /* Take available space */
    overflow-y: auto; /* Scroll */
    padding: 1rem 1.5rem; /* Consistent padding */
    display: flex;
    flex-direction: column;
    gap: 0.75rem; /* Space between messages */
}

/* Custom Scrollbar for Chat */
.chat-messages::-webkit-scrollbar {
    width: 8px;
}
.chat-messages::-webkit-scrollbar-track {
    background: #f8f9fa;
}
.chat-messages::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 4px;
}
.chat-messages::-webkit-scrollbar-thumb:hover {
    background: #adb5bd;
}

.message-date-divider {
    text-align: center;
    margin: 1rem 0 0.5rem; /* Adjusted margin */
    position: relative;
}

.message-date-divider::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: #e9ecef;
    z-index: 0;
}

.message-date-divider span {
    background-color: white; /* Match chat background */
    padding: 0 0.8rem;
    position: relative;
    z-index: 1;
    font-size: 0.7rem; /* Smaller date */
    color: #888;
    font-weight: 500;
    text-transform: uppercase;
}

.message-wrapper {
    display: flex;
    gap: 0.5rem; /* Space between avatar and message */
    max-width: 80%; /* Max width */
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.message-wrapper.incoming {
    align-self: flex-start;
}

.message-wrapper.outgoing {
    align-self: flex-end;
    flex-direction: row-reverse; /* Put message first */
}

.message-avatar {
    width: 30px; /* Smaller avatar */
    height: 30px;
    border-radius: 50%;
    background-color: #6c757d; /* Generic color */
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 500;
    flex-shrink: 0;
    align-self: flex-end; /* Align avatar to bottom */
    text-transform: uppercase;
}

.message {
    display: flex; /* Use flex for meta */
    flex-direction: column;
}

.message-content {
    padding: 0.6rem 1rem; /* Adjusted padding */
    border-radius: var(--radius-lg);
    font-size: 0.9rem; /* Standard text size */
    line-height: 1.5;
    word-wrap: break-word; /* Prevent long words from overflowing */
}

.incoming .message-content {
    background-color: var(--message-incoming-bg);
    color: var(--message-incoming-text);
    border-bottom-left-radius: 4px; /* Slightly less rounded corner */
}

.outgoing .message-content {
    background-color: var(--message-outgoing-bg);
    color: var(--message-outgoing-text);
    border-bottom-right-radius: 4px;
}

.message-meta {
    display: flex;
    align-items: center;
    gap: 0.3rem; /* Smaller gap */
    margin-top: 4px; /* Smaller margin */
    font-size: 0.7rem; /* Smaller meta text */
    color: #aaa; /* Lighter meta text */
}

.incoming .message-meta {
    justify-content: flex-start;
    padding-left: 2px;
}

.outgoing .message-meta {
    justify-content: flex-end;
    padding-right: 2px;
}

.message-status {
    color: #a7c4ff; /* Lighter blue for sent */
    font-size: 0.75rem; /* Match time */
}

.message-status.read {
    color: var(--primary);
}

.empty-messages {
    margin: auto; /* Center vertically and horizontally */
    text-align: center;
}

.empty-messages .empty-icon {
    font-size: 2.5rem;
    color: #e0e0e0;
    margin-bottom: 1rem;
}

.empty-messages p {
    color: #888;
    font-size: 0.9rem;
    margin: 0;
}

.empty-messages .empty-subtitle {
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

.chat-input-area {
    padding: 0.75rem 1.5rem;
    border-top: 1px solid var(--gray-light);
    background-color: #f8f9fa; /* Light background for input area */
    flex-shrink: 0;
    min-height: var(--chat-input-min-height);
    display: flex;
}

#messageForm {
    width: 100%; /* Ensure form takes full width */
}

.chat-input-wrapper {
    display: flex;
    align-items: center; /* Align items vertically */
    gap: 0.5rem; /* Reduced gap */
    background-color: white; /* White background for input itself */
    border: 1px solid var(--gray-light);
    border-radius: var(--radius-md);
    padding: 0.3rem 0.5rem; /* Reduced padding */
    width: 100%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.chat-input-actions {
    display: flex;
    gap: 0.25rem;
}

.chat-input-actions .chat-input-action-btn {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    font-size: 0.9rem;
    color: var(--gray);
    background-color: transparent;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.chat-input-actions .chat-input-action-btn:hover {
    background-color: var(--gray-light);
    color: var(--primary);
}

.chat-input {
    flex: 1;
    border: none;
    background: none;
    padding: 0.4rem 0.5rem; /* Adjusted padding */
    resize: none;
    max-height: 100px; /* Limit growth */
    font-size: 0.9rem;
    line-height: 1.4;
    overflow-y: auto; /* Add scroll if needed */
}

.chat-input:focus {
    outline: none;
}

/* Custom Scrollbar for Textarea */
.chat-input::-webkit-scrollbar {
    width: 5px;
}
.chat-input::-webkit-scrollbar-track {
    background: transparent;
}
.chat-input::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
}

.chat-send-btn {
    width: 36px; /* Slightly larger send button */
    height: 36px;
    border-radius: 50%;
    font-size: 1rem;
    color: white;
    background-color: var(--primary);
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    align-self: flex-end; /* Align to bottom if textarea grows */
    margin-bottom: 2px; /* Align with input line */
}

.chat-send-btn:hover {
    background-color: var(--primary-darker, #0056b3);
}

.empty-chat {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 2rem;
    background-color: #f8f9fa; /* Light background for empty state */
}

.empty-chat-content {
    text-align: center;
    max-width: 400px;
}

.empty-chat h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #555;
}

.empty-chat p {
    font-size: 0.95rem;
    color: #777;
}

/* Responsive Styles */
@media (max-width: 991px) {
    :root {
        --sidebar-width: 100%; /* Sidebar takes full width */
    }
    .messages-container {
        grid-template-columns: 1fr; /* Single column */
        position: relative; /* Needed for absolute positioning */
    }

    .conversations-sidebar {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1050; /* High z-index */
        background-color: #fcfdff;
        transform: translateX(-100%); /* Initially hidden */
        transition: transform 0.3s ease-in-out;
        border-right: none; /* No border needed */
    }
    .conversations-sidebar.active {
        transform: translateX(0); /* Slide in */
    }

    .chat-header {
        padding-left: 4rem; /* Make space for back button */
        position: relative;
    }
    /* Replaced pseudo-element with actual button */
    #showConversationsBtn {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        display: inline-flex !important; /* Ensure it's shown */
    }
    #showConversationsBtnMobile { /* Show button in empty state on mobile */
        display: inline-block !important;
    }

    .chat-area {
        /* Chat area is always visible on mobile */
    }

    .empty-chat #showConversationsBtnMobile {
        display: inline-block; /* Show button in empty state */
    }
    
    /* Add overlay when sidebar is active */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 1049;
    }
    
    .sidebar-overlay.active {
        display: block;
    }
}

@media (min-width: 992px) {
    #showConversationsBtn, #showConversationsBtnMobile {
        display: none !important; /* Hide mobile back buttons on desktop */
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('messageInput');
    const messageForm = document.getElementById('messageForm');
    const conversationsSidebar = document.querySelector('.conversations-sidebar');
    const showConversationsBtn = document.getElementById('showConversationsBtn'); // Button in chat header
    const showConversationsBtnMobile = document.getElementById('showConversationsBtnMobile'); // Button in empty chat state
    const conversationSearch = document.getElementById('conversationSearch');
    const conversationItems = document.querySelectorAll('.conversation-item');
    
    // Create overlay for mobile
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    document.body.appendChild(overlay);
    
    overlay.addEventListener('click', function() {
        hideSidebar();
    });

    // --- 1. Scroll to bottom of chat messages ---
    function scrollToBottom() {
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }
    scrollToBottom(); // Initial scroll

    // --- 2. Auto-resize textarea ---
    if (chatInput) {
        const initialHeight = chatInput.scrollHeight + 'px'; // Store initial height if needed
        chatInput.style.height = initialHeight; // Set initial height

        chatInput.addEventListener('input', function() {
            this.style.height = 'auto'; // Reset height to calculate new scrollHeight
            let newHeight = this.scrollHeight;
            const maxHeight = 100; // Max height in pixels

            if (newHeight > maxHeight) {
                this.style.height = maxHeight + 'px';
                this.style.overflowY = 'scroll'; // Enable scroll if max height reached
            } else {
                this.style.height = newHeight + 'px';
                this.style.overflowY = 'hidden'; // Hide scroll if below max height
            }
        });

        // Allow Shift+Enter for newline, Enter to send
        chatInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault(); // Prevent default newline behavior
                if (messageForm && this.value.trim() !== '') {
                    messageForm.requestSubmit(); // Programmatically submit the form
                }
            }
        });
        
        // Focus the input field when the chat area is shown
        chatInput.focus();
    }

    // --- 3. Mobile navigation between conversations and chat ---
    function showSidebar() {
        if (conversationsSidebar) {
            conversationsSidebar.classList.add('active');
            overlay.classList.add('active');
        }
    }

    function hideSidebar() {
        if (conversationsSidebar) {
            conversationsSidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    }

    // Event listener for the button inside the chat header
    if (showConversationsBtn) {
        showConversationsBtn.addEventListener('click', showSidebar);
    }
    // Event listener for the button inside the empty chat state
    if (showConversationsBtnMobile) {
        showConversationsBtnMobile.addEventListener('click', showSidebar);
    }

    // Hide sidebar when a conversation item is clicked on mobile
    document.querySelectorAll('.conversation-item').forEach(item => {
        item.addEventListener('click', function(e) {
            // Check if screen width indicates mobile view
            if (window.innerWidth <= 991) {
                hideSidebar();
            }
        });
    });
    
    // --- 4. Conversation search functionality ---
    if (conversationSearch) {
        conversationSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            conversationItems.forEach(item => {
                const userName = item.querySelector('.conversation-name').textContent.toLowerCase();
                const lastMessage = item.querySelector('.conversation-preview').textContent.toLowerCase();
                
                if (userName.includes(searchTerm) || lastMessage.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // --- 5. Form submission validation ---
    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            const messageText = chatInput ? chatInput.value.trim() : '';
            if (messageText === '') {
                e.preventDefault(); // Prevent submitting empty messages
                if(chatInput) {
                    chatInput.focus();
                    chatInput.classList.add('shake');
                    setTimeout(() => {
                        chatInput.classList.remove('shake');
                    }, 500);
                }
            } else {
                // Add temporary message to UI before reload
                if (chatMessages && messageText) {
                    const now = new Date();
                    const timeString = now.toLocaleTimeString([], {hour: 'numeric', minute:'2-digit'});
                    
                    const dateToday = document.querySelectorAll('.message-date-divider');
                    let hasToday = false;
                    
                    dateToday.forEach(date => {
                        if (date.textContent.includes('Today')) {
                            hasToday = true;
                        }
                    });
                    
                    if (!hasToday) {
                        const dateDiv = document.createElement('div');
                        dateDiv.className = 'message-date-divider';
                        dateDiv.innerHTML = '<span>Today</span>';
                        chatMessages.appendChild(dateDiv);
                    }
                    
                    const messageWrapper = document.createElement('div');
                    messageWrapper.className = 'message-wrapper outgoing';
                    messageWrapper.innerHTML = `
                        <div class="message">
                            <div class="message-content">
                                ${messageText.replace(/\n/g, '<br>')}
                            </div>
                            <div class="message-meta">
                                <span class="message-time">${timeString}</span>
                                <span class="message-status" title="Sending...">
                                    <i class="fas fa-check"></i>
                                </span>
                            </div>
                        </div>
                    `;
                    chatMessages.appendChild(messageWrapper);
                    scrollToBottom();
                }
            }
        });
    }

    // --- 6. Initialize Bootstrap tooltips if available ---
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>

<?php
include 'footer.php';
$conn->close();
?>