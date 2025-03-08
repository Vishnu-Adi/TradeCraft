<?php include 'header.php'; ?>
<div class="container my-5">
  <h1 class="mb-4">Login</h1>
  <form action="login_process.php" method="post">
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
  </form>
</div>
<?php include 'footer.php'; ?>