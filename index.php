<?php include 'header.php'; ?>
<!-- Hero Section -->
<section class="hero-section">
  <div class="jumbotron jumbotron-fluid text-center bg-light">
    <div class="container">
      <h1 class="display-4">Welcome to Community Skill Exchange!</h1>
      <p class="lead">Connect, learn, and share your skills with others in your community.</p>
      <!-- Call-to-Action Buttons -->
      <a class="btn btn-primary btn-lg" href="signup.php" role="button">Join Now</a>
      <a class="btn btn-secondary btn-lg" href="about.php" role="button">Learn More</a>
    </div>
  </div>
</section>

<!-- Featured Posts Section -->
<section class="featured-posts container my-5">
  <h2 class="text-center mb-4">Featured Skill Posts</h2>
  <div class="row">
    <!-- Featured Post 1 -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="images/cooking.jpg" class="card-img-top" alt="Cooking Lessons">
        <div class="card-body">
          <h5 class="card-title">Cooking Lessons</h5>
          <p class="card-text">Learn to cook delicious meals with guidance from expert chefs.</p>
          <a href="skill_detail.php?id=1" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
    <!-- Featured Post 2 -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="images/webdev.jpg" class="card-img-top" alt="Web Development">
        <div class="card-body">
          <h5 class="card-title">Web Development</h5>
          <p class="card-text">Kickstart your journey in web development with our introductory courses.</p>
          <a href="skill_detail.php?id=2" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
    <!-- Featured Post 3 -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="images/photography.jpg" class="card-img-top" alt="Photography Basics">
        <div class="card-body">
          <h5 class="card-title">Photography Basics</h5>
          <p class="card-text">Enhance your photography skills with practical tips and tricks.</p>
          <a href="skill_detail.php?id=3" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
