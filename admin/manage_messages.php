<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}
include 'admin_header.php';
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
      <?php 
      // Dummy data for demonstration. Replace with a DB query.
      $conversations = [
          ['id' => 1, 'participants' => 'John Doe, Jane Smith', 'lastMessage' => 'See you soon!'],
          ['id' => 2, 'participants' => 'Alice Brown, Bob White', 'lastMessage' => 'Thanks for your help.'],
      ];
      foreach ($conversations as $conv):
      ?>
      <tr>
        <td><?php echo htmlspecialchars($conv['id']); ?></td>
        <td><?php echo htmlspecialchars($conv['participants']); ?></td>
        <td><?php echo htmlspecialchars($conv['lastMessage']); ?></td>
        <td>
          <a href="view_conversation.php?id=<?php echo $conv['id']; ?>" class="btn btn-sm btn-primary">View</a>
          <a href="delete_conversation.php?id=<?php echo $conv['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this conversation?');">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include 'admin_footer.php'; ?>
