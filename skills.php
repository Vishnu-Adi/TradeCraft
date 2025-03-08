<?php
include 'db_connect.php';
include 'header.php';

// Initialize variables
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$skills = [];

// Prepare the SQL query based on whether a search term is provided
if (!empty($searchTerm)) {
    $stmt = $conn->prepare("SELECT id, title, description, image, user_id FROM skills WHERE LOWER(title) LIKE ? OR LOWER(description) LIKE ?");
    $likeTerm = "%" . strtolower($searchTerm) . "%";
    $stmt->bind_param("ss", $likeTerm, $likeTerm);
} else {
    $stmt = $conn->prepare("SELECT id, title, description, image, user_id FROM skills");
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch the skills
while ($row = $result->fetch_assoc()) {
    $skills[] = $row;
}

$stmt->close();
?>

<div class="container my-5">
    <h1>Skill Listings</h1>
    <!-- Search Form -->
    <form class="form-inline mb-4" method="get" action="skills.php">
        <input type="text" class="form-control mr-2" name="search" placeholder="Search skills..."
               value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="row">
        <?php if (count($skills) > 0): ?>
            <?php foreach ($skills as $skill): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if ($skill['image']): ?>
                            <img src="<?php echo htmlspecialchars($skill['image']); ?>" class="card-img-top"
                                 alt="<?php echo htmlspecialchars($skill['title']); ?>">
                        <?php else: ?>
                            <img src="images/default_skill.jpg" class="card-img-top" alt="Default Skill Image">

                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($skill['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($skill['description']); ?></p>
                            <a href="skill_detail.php?id=<?php echo $skill['id']; ?>" class="btn btn-primary">View
                                Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No skills found matching your search criteria.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
include 'footer.php';
$conn->close();
?>