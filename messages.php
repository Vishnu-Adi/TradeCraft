<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include 'header.php'; ?>
<div class="container my-5">
  <h1>Messages</h1>
  <div class="row">
    <!-- Conversations List -->
    <div class="col-md-4">
      <h4>Conversations</h4>
      <ul class="list-group">
        <li class="list-group-item">
          <a href="messages.php?conversation_id=1">Conversation with John Doe</a>
        </li>
        <li class="list-group-item">
          <a href="messages.php?conversation_id=2">Conversation with Jane Smith</a>
        </li>
        <!-- Add more conversation threads as needed -->
      </ul>
    </div>
    <!-- Conversation View -->
    <div class="col-md-8">
      <?php
      // Get conversation ID from URL (default to 1 if not provided)
      $conversation_id = isset($_GET['conversation_id']) ? intval($_GET['conversation_id']) : 1;
      
      // Dummy messages for demonstration purposes
      $messages = [
        1 => [
          ['sender' => 'John Doe', 'message' => 'Hello, how can I help you?', 'time' => '10:00 AM'],
          ['sender' => 'You', 'message' => 'I need advice on cooking techniques.', 'time' => '10:05 AM'],
        ],
        2 => [
          ['sender' => 'Jane Smith', 'message' => 'Can you help me with web development?', 'time' => '11:00 AM'],
          ['sender' => 'You', 'message' => 'Sure, what do you need?', 'time' => '11:05 AM'],
        ],
      ];
      
      $current_messages = isset($messages[$conversation_id]) ? $messages[$conversation_id] : [];
      ?>
      <h4>Conversation Details</h4>
      <div class="card">
        <div class="card-body" style="height: 300px; overflow-y: auto;">
          <?php foreach ($current_messages as $msg): ?>
            <div class="mb-2">
              <strong><?php echo htmlspecialchars($msg['sender']); ?>:</strong>
              <span><?php echo htmlspecialchars($msg['message']); ?></span>
              <small class="text-muted"><?php echo htmlspecialchars($msg['time']); ?></small>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <!-- Message Form -->
      <form action="send_message.php" method="post" class="mt-3">
        <input type="hidden" name="conversation_id" value="<?php echo $conversation_id; ?>">
        <div class="form-group">
          <textarea name="message" class="form-control" rows="3" placeholder="Type your message..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
