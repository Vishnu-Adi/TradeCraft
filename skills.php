<?php include 'header.php'; ?>
<div class="container my-5">
  <h1>Skill Listings</h1>
  <!-- Search Form -->
  <form class="form-inline mb-4" method="get" action="skills.php">
    <input type="text" class="form-control mr-2" name="search" placeholder="Search skills..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
  
  <div class="row">
    <?php
    // Dummy array of skills (replace with a DB query in production)
    $skills = [
      ['id' => 1, 'title' => 'Cooking Lessons', 'description' => 'Learn how to cook delicious meals.', 'image' => 'images/cooking.jpg'],
      ['id' => 2, 'title' => 'Web Development', 'description' => 'Introduction to web development basics.', 'image' => 'images/webdev.jpg'],
      ['id' => 3, 'title' => 'Photography Basics', 'description' => 'Get started with photography fundamentals.', 'image' => 'images/photography.jpg'],
    ];
    
    // Filter skills if a search term is provided
    if (isset($_GET['search']) && $_GET['search'] !== '') {
        $searchTerm = strtolower($_GET['search']);
        $skills = array_filter($skills, function($skill) use ($searchTerm) {
            return strpos(strtolower($skill['title']), $searchTerm) !== false;
        });
    }
    
    // Loop through and display each skill as a card
    foreach ($skills as $skill): ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="<?php echo $skill['image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($skill['title']); ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($skill['title']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($skill['description']); ?></p>
            <a href="skill_detail.php?id=<?php echo $skill['id']; ?>" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
