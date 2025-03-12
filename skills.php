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

<!-- Hero Section with Search Bar -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 fw-bold mb-3">Discover Skills</h1>
                <p class="lead mb-4">Browse through our community's diverse range of skills and find what you're looking to learn.</p>
                
                <!-- Search Bar (Centered with rounded corners) -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form method="get" action="skills.php" class="mb-4">
                            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden">
                                <input type="text" name="search" placeholder="Search for skills..." 
                                   value="<?php echo htmlspecialchars($searchTerm); ?>" 
                                   class="form-control border-0 px-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="py-5">
    <div class="container">
        <!-- Category Pills -->
        <div class="mb-4">
            <h5 class="mb-3">Filter by Category:</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="skills.php<?php echo !empty($searchTerm) ? '?search=' . urlencode($searchTerm) : ''; ?>" 
                   class="btn <?php echo empty($category) ? 'btn-primary' : 'btn-outline-secondary'; ?> rounded-pill px-3">
                    All Categories
                </a>
                <?php foreach ($categories as $cat): ?>
                    <a href="skills.php?<?php echo !empty($searchTerm) ? 'search=' . urlencode($searchTerm) . '&' : ''; ?>category=<?php echo urlencode($cat); ?>" 
                       class="btn <?php echo $category === $cat ? 'btn-primary' : 'btn-outline-secondary'; ?> rounded-pill px-3">
                        <?php echo htmlspecialchars($cat); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Active Filters Display -->
        <?php if (!empty($searchTerm) || !empty($category)): ?>
            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                <div class="me-2">
                    <i class="fas fa-filter text-primary"></i>
                </div>
                <div>
                    <strong>Active filters:</strong>
                    <?php if (!empty($searchTerm)): ?>
                        <span class="badge bg-primary rounded-pill ms-2">
                            Search: <?php echo htmlspecialchars($searchTerm); ?>
                            <a href="skills.php<?php echo !empty($category) ? '?category=' . urlencode($category) : ''; ?>" 
                               class="text-white text-decoration-none ms-1" title="Remove filter">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($category)): ?>
                        <span class="badge bg-primary rounded-pill ms-2">
                            Category: <?php echo htmlspecialchars($category); ?>
                            <a href="skills.php<?php echo !empty($searchTerm) ? '?search=' . urlencode($searchTerm) : ''; ?>" 
                               class="text-white text-decoration-none ms-1" title="Remove filter">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="ms-auto">
                    <a href="skills.php" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-redo me-1"></i>Clear All
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Skills Display -->
        <?php if (count($skills) > 0): ?>
            <div class="row g-4">
                <?php foreach ($skills as $skill): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-3 hover-shadow">
                            <div class="card-body p-4">
                                <?php if (!empty($skill['category'])): ?>
                                    <span class="badge bg-primary rounded-pill mb-2 px-3 py-2">
                                        <?php echo htmlspecialchars($skill['category']); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <h5 class="card-title fw-bold mb-3"><?php echo htmlspecialchars($skill['title']); ?></h5>
                                
                                <p class="card-text text-muted mb-4">
                                    <?php echo htmlspecialchars(substr($skill['description'], 0, 120)); ?>...
                                </p>
                                
                                <div class="border-top pt-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                                                <?php echo htmlspecialchars(strtoupper(substr($skill['fullName'] ?? 'U', 0, 1))); ?>
                                            </div>
                                            <span class="text-truncate" style="max-width: 100px;">
                                                <?php echo htmlspecialchars($skill['fullName'] ?? 'Unknown User'); ?>
                                            </span>
                                        </div>
                                        
                                        <a href="skill_detail.php?id=<?php echo $skill['id']; ?>" class="btn btn-sm btn-primary rounded-pill">
                                            <i class="fas fa-arrow-right me-1"></i> View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="py-5">
                    <div class="d-inline-block p-4 bg-light rounded-circle mb-3">
                        <i class="fas fa-search fa-3x text-muted"></i>
                    </div>
                    <h3 class="mb-3">No skills found</h3>
                    <p class="text-muted mb-4">We couldn't find any skills matching your search criteria.</p>
                    <a href="skills.php" class="btn btn-primary btn-lg rounded-pill px-4">View All Skills</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Small Enhancement: Add a CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3">Have a Skill to Share?</h2>
                <p class="lead mb-4">Join our community of skill-sharers and help others learn something new.</p>
                <a href="add_skill.php" class="btn btn-primary btn-lg rounded-pill px-4">
                    <i class="fas fa-plus-circle me-2"></i>Share Your Skill
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    /* Minimal additional CSS that can't be easily done with Bootstrap */
    .hover-shadow:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    /* Make sure inputs look consistent */
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
        border-color: var(--primary);
    }
</style>

<?php include 'footer.php'; ?>