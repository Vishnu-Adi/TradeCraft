<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: ../login.php");
    exit();
}
include 'admin_header.php';
?>
<div class="container my-5">
  <h1>Manage Users</h1>
  <table class="table table-striped">
    <thead>
      <tr>
         <th>ID</th>
         <th>Full Name</th>
         <th>Email</th>
         <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      // Dummy data for demonstration. Replace with a DB query.
      $users = [
          ['id' => 1, 'fullName' => 'John Doe', 'email' => 'johndoe@example.com'],
          ['id' => 2, 'fullName' => 'Jane Smith', 'email' => 'janesmith@example.com'],
      ];
      foreach ($users as $user):
      ?>
      <tr>
        <td><?php echo htmlspecialchars($user['id']); ?></td>
        <td><?php echo htmlspecialchars($user['fullName']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td>
          <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
          <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include 'admin_footer.php'; ?>
