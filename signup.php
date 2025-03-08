<?php include 'header.php'; ?>
<div class="container my-5">
  <h1 class="mb-4">Sign Up</h1>
  <form action="signup_process.php" method="post" id="signupForm">
    <div class="form-group">
      <label for="fullName">Full Name</label>
      <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
    </div>
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
    </div>
    <div class="form-group">
      <label for="confirmPassword">Confirm Password</label>
      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>

<script>
// Simple client-side validation to check password match
document.getElementById('signupForm').addEventListener('submit', function(e) {
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  if (password !== confirmPassword) {
    e.preventDefault();
    alert('Passwords do not match!');
  }
});
</script>
<?php include 'footer.php'; ?>