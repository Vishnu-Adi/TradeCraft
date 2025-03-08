<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}

include 'admin_header.php';
include '../db_connect.php';

// Fetch conversations (similar to messages.php, but without filtering by user)
$stmt = $conn->prepare("
    SELECT
        c.id AS conversation_id,
        GROUP_CONCAT(DISTINCT u.fullName ORDER BY u.id SEPARATOR ', ') AS participants,
         (SELECT message FROM messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) AS last_message
    FROM conversations c
    JOIN conversation_participants cp ON c.id = cp.conversation_id
    JOIN users u ON cp.user_id = u.id
    GROUP BY c.id
    ORDER BY c.id DESC
");

$stmt->execute();
$result = $stmt->get_result();
$conversations = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<div class="container my-5">
    <h1>Manage Messages</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Conversation ID</th>
            <th>Participants</th>
            <th>Last Message</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($conversations as $conv): ?>
            <tr>
                <td><?php echo htmlspecialchars($conv['conversation_id']); ?></td>
                <td><?php echo htmlspecialchars($conv['participants']); ?></td>
                <td>
                  <?php
                      if (isset($conv['last_message'])) {
                           echo  htmlspecialchars( (strlen($conv['last_message']) > 20) ? substr($conv['last_message'],0,20).'...' : $conv['last_message'] );
                       } else {
                          echo "No messages yet";
                       }

                    ?>
                </td>
                <td>
                    <a href="view_conversation.php?id=<?php echo $conv['conversation_id']; ?>"
                       class="btn btn-sm btn-primary">View</a>
                    <a href="delete_conversation.php?id=<?php echo $conv['conversation_id']; ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this conversation?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include 'admin_footer.php';
$conn->close();
?>