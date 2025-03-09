<?php
include 'db_connect.php';
include 'header.php';

// Initialize variables
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$skills = [];

// Get all categories for the filter (efficiently)
$categories = [];
$categoriesQuery = $conn->query("SELECT DISTINCT category FROM skills WHERE category IS NOT NULL AND category != '' ORDER BY category");
if ($categoriesQuery) { // Check if the query was successful
    while ($cat = $categoriesQuery->fetch_assoc()) {
        $categories[] = $cat['category'];
    }
}


// Prepare the SQL query based on search and category filters
$sql = "SELECT s.id, s.title, s.description, s.user_id, s.category, u.fullName
        FROM skills s
        LEFT JOIN users u ON s.user_id = u.id
        WHERE 1=1";  // This simplifies adding AND clauses later
$params = [];
$types = "";

if (!empty($searchTerm)) {
    $sql .= " AND (LOWER(s.title) LIKE ? OR LOWER(s.description) LIKE ?)";
    $likeTerm = "%" . strtolower($searchTerm) . "%";
    $params[] = $likeTerm;
    $params[] = $likeTerm;
    $types .= "ss";
}

if (!empty($category)) {
    $sql .= " AND s.category = ?";
    $params[] = $category;
    $types .= "s";
}

$sql .= " ORDER BY s.created_at DESC"; // Order by creation date

$stmt = $conn->prepare($sql);

// Bind parameters only if there are any
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch the skills
while ($row = $result->fetch_assoc()) {
    $skills[] = $row;
}

$stmt->close();
?>
<section class="skills-page-header py-5 bg-light">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4">Discover Skills</h1>
            <p class="lead">Browse through our community's diverse range of skills and find what you're looking to learn.</p>
        </div>
    </div>
</section>


<section class="skills-section py-5">
    <div class="container">
        <!-- Filters -->
        <div class="skills-filters mb-4">
             <!-- Search Filter -->
            <div class="search-filter mb-3">
                <form method="get" action="skills.php" class="search-form">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" name="search" placeholder="Search skills..." value="<?php echo htmlspecialchars($searchTerm); ?>" class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Category Filter -->
           <div class="category-filter">
                <div class="mb-2" style="font-weight: bold;">Filter by Category:</div>
                <div class="d-flex flex-wrap">
                    <a href="skills.php<?php echo !empty($searchTerm) ? '?search=' . urlencode($searchTerm) : ''; ?>" class="btn btn-outline-secondary m-1 <?php echo empty($category) ? 'active' : ''; ?>">All</a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="skills.php?<?php echo !empty($searchTerm) ? 'search=' . urlencode($searchTerm) . '&' : ''; ?>category=<?php echo urlencode($cat); ?>" class="btn btn-outline-secondary m-1 <?php echo $category === $cat ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($cat); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Skill Cards -->
        <?php if (count($skills) > 0): ?>
            <div class="row">
                <?php foreach ($skills as $skill): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                 <?php if (!empty($skill['category'])): ?>
                                    <span class="badge badge-primary mb-2"><?php echo htmlspecialchars($skill['category']); ?></span>
                                <?php endif; ?>
                                <h5 class="card-title"><?php echo htmlspecialchars($skill['title']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars(substr($skill['description'], 0, 150)); ?>...</p>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar mr-2" style="width: 30px; height: 30px; border-radius: 50%; background-color: #007bff; color: white; text-align: center; line-height: 30px; font-weight: bold;">
                                        <?php echo  htmlspecialchars(strtoupper(substr( $skill['fullName'] ?? 'U', 0, 1))); ?><!--  Get the first letter -->
                                    </div>
                                    <span><?php echo htmlspecialchars($skill['fullName']  ?? 'Unknown User' ); ?></span>
                                </div>
                                <a href="skill_detail.php?id=<?php echo $skill['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h3>No skills found</h3>
                <p class="text-muted">We couldn't find any skills matching your search criteria.</p>
                <a href="skills.php" class="btn btn-primary">View All Skills</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>