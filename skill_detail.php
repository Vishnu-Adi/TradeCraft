<?php
include 'db_connect.php';
include 'header.php';

// Get the skill ID from the query parameter
$skillId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the skill data from the database (using prepared statements)
$stmt = $conn->prepare("SELECT s.*, u.fullName, u.email FROM skills s JOIN users u ON s.user_id = u.id WHERE s.id = ?");
$stmt->bind_param("i", $skillId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $skill = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "Skill not found.";
    header("Location: skills.php"); // redirect with error
    exit();
}

$stmt->close();
?>

<section class="section skill-detail-section">
    <div class="container">
        <!-- Breadcrumb navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="skills.php">Skills</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($skill['title']); ?></li>
            </ol>
        </nav>
        
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge rounded-pill" style="background-color: var(--primary);">
                        <?= htmlspecialchars($skill['category']) ?>
                    </span>
                    <small class="text-muted">
                        Posted <?= date("F j, Y", strtotime($skill['created_at'])) ?>
                    </small>
                </div>
            </div>
            
            <div class="card-body p-4">
                <h1 class="card-title mb-4"><?php echo htmlspecialchars($skill['title']); ?></h1>
                
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h5>Description</h5>
                            <p class="text-muted"><?php echo htmlspecialchars($skill['description']); ?></p>
                        </div>

                        <div class="mb-4">
                            <h5>Detailed Information</h5>
                            <p class="text-muted"><?php echo nl2br(htmlspecialchars($skill['details'] ?? 'No detailed information provided.')); ?></p>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-calendar-alt fa-fw text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Availability</h6>
                                    <p class="mb-0"><?php echo htmlspecialchars($skill['availability'] ?? 'Not specified'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h5 class="card-title">Instructor</h5>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-lg me-3">
                                        <?= substr($skill['fullName'], 0, 1) ?>
                                    </div>
                                    <div>
                                        <h6 class="mb-1"><?php echo htmlspecialchars($skill['fullName']); ?></h6>
                                        <p class="text-muted small mb-0">Member since <?= date("F Y", strtotime($skill['created_at'])) ?></p>
                                    </div>
                                </div>
                                
                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $skill['user_id']): ?>
                                    <a href="messages.php?recipient_id=<?php echo $skill['user_id']; ?>" class="btn btn-primary w-100">
                                        <i class="fas fa-envelope me-2"></i>Contact <?php echo htmlspecialchars(explode(' ', $skill['fullName'])[0]); ?>
                                    </a>
                                <?php elseif (!isset($_SESSION['user_id'])): ?>
                                    <a href="login.php" class="btn btn-primary w-100">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login to Contact
                                    </a>
                                <?php elseif ($_SESSION['user_id'] == $skill['user_id']): ?>
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-2"></i>This is your own skill post
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="skills.php" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Skills
                        </a>
                    </div>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $skill['user_id']): ?>
                        <div>
                            <a href="edit_skill.php?id=<?php echo $skill['id']; ?>" class="btn btn-outline-primary me-2">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="delete_skill.php?id=<?php echo $skill['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this skill?');">
                                <i class="fas fa-trash me-1"></i>Delete
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Similar Skills Section -->
        <div class="similar-skills mt-5">
            <h3 class="mb-4">Similar Skills You Might Like</h3>
            <div class="row">
                <?php
                // Fetch similar skills (same category, different user, limit 3)
                $stmt = $conn->prepare("
                    SELECT s.id, s.title, s.description, s.category, u.fullName 
                    FROM skills s
                    JOIN users u ON s.user_id = u.id
                    WHERE s.category = ? AND s.id != ? AND s.user_id != ?
                    ORDER BY s.created_at DESC
                    LIMIT 3
                ");
                $stmt->bind_param("sii", $skill['category'], $skillId, $skill['user_id']);
                $stmt->execute();
                $similarResult = $stmt->get_result();
                $hasRelated = false;
                
                while ($similarSkill = $similarResult->fetch_assoc()): 
                    $hasRelated = true;
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($similarSkill['title']); ?></h5>
                                <span class="badge rounded-pill mb-2" style="background-color: var(--primary);">
                                    <?= htmlspecialchars($similarSkill['category']) ?>
                                </span>
                                <p class="card-text"><?php echo htmlspecialchars(substr($similarSkill['description'], 0, 100)) . '...'; ?></p>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">By <?php echo htmlspecialchars($similarSkill['fullName']); ?></small>
                                    <a href="skill_detail.php?id=<?php echo $similarSkill['id']; ?>" class="btn btn-sm btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; 
                $stmt->close();
                
                if (!$hasRelated): ?>
                    <div class="col-12">
                        <div class="alert alert-light text-center">
                            No similar skills found in this category.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .skill-detail-section {
        padding-top: 2rem;
        padding-bottom: 4rem;
    }
    
    .avatar-lg {
        width: 60px;
        height: 60px;
        background-color: var(--primary);
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .card-title {
        color: var(--gray-dark);
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
    }
    
    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }
</style>

<?php
include 'footer.php';
$conn->close();
?>