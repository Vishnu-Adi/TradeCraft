<?php include 'header.php'; ?>
<div class="container my-5">
  <h1>Password Recovery</h1>
  <p>Enter your registered email address and we'll send you instructions to reset your password.</p>
  <form action="forgot_password_process.php" method="post">
    <div class="form-group">
      <label for="email">Registered Email Address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your registered email" required>
    </div>
    <button type="submit" class="btn btn-primary">Reset Password</button>
  </form>
</div>
<?php include 'footer.php'; ?>
