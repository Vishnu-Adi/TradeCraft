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
        <nav aria-label="breadcrumb" class="mb-4 breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="skills.php">Skills</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($skill['title']); ?></li>
            </ol>
        </nav>
        
        <div class="card main-skill-card shadow border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge category-badge rounded-pill" style="background-color: var(--primary);">
                        <?= htmlspecialchars($skill['category']) ?>
                    </span>
                    <small class="text-muted date-posted">
                        <i class="far fa-calendar-alt me-1"></i> Posted <?= date("F j, Y", strtotime($skill['created_at'])) ?>
                    </small>
                </div>
            </div>
            
            <div class="card-body p-4">
                <h1 class="card-title display-6 fw-bold mb-4"><?php echo htmlspecialchars($skill['title']); ?></h1>
                
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="skill-section mb-4">
                            <h5 class="section-title"><i class="fas fa-info-circle me-2 text-primary"></i>Description</h5>
                            <p class="text-muted skill-description"><?php echo htmlspecialchars($skill['description']); ?></p>
                        </div>

                        <div class="skill-section mb-4">
                            <h5 class="section-title"><i class="fas fa-list-alt me-2 text-primary"></i>Detailed Information</h5>
                            <p class="text-muted skill-details"><?php echo nl2br(htmlspecialchars($skill['details'] ?? 'No detailed information provided.')); ?></p>
                        </div>
                        
                        <div class="skill-section availability-section">
                            <div class="d-flex align-items-center">
                                <div class="icon-container me-3">
                                    <i class="fas fa-calendar-alt fa-fw text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold">Availability</h6>
                                    <p class="mb-0"><?php echo htmlspecialchars($skill['availability'] ?? 'Not specified'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="instructor-card card border-0"> 
                            <div class="card-body">
                                <h5 class="instructor-title fw-bold mb-3">
                                    <i class="fas fa-user-graduate me-2 text-primary"></i>Instructor
                                </h5>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-lg instructor-avatar me-3">
                                        <?= isset($skill['fullName']) ? substr($skill['fullName'], 0, 1) : '?' ?>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold"><?php echo isset($skill['fullName']) ? htmlspecialchars($skill['fullName']) : 'Unknown User'; ?></h6>
                                        <p class="text-muted small mb-0">Member since <?= isset($skill['created_at']) ? date("F Y", strtotime($skill['created_at'])) : 'N/A' ?></p>
                                    </div>
                                </div>

                                <?php if (isset($_SESSION['user_id']) && isset($skill['user_id']) && $_SESSION['user_id'] != $skill['user_id']): ?>
                                    <a href="messages.php?recipient_id=<?php echo $skill['user_id']; ?>" class="btn btn-primary w-100 contact-btn">
                                        <i class="fas fa-envelope me-2"></i>Contact <?php echo isset($skill['fullName']) ? htmlspecialchars(explode(' ', $skill['fullName'])[0]) : 'User'; ?>
                                    </a>
                                <?php elseif (!isset($_SESSION['user_id'])): ?>
                                     <?php // Construct the redirect URL safely
                                        $redirectUrl = 'skill_detail.php?id=' . $skillId;
                                     ?>
                                    <a href="login.php?redirect=<?php echo urlencode($redirectUrl); ?>" class="btn btn-primary w-100 contact-btn">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login to Contact
                                    </a>
                                <?php elseif (isset($_SESSION['user_id']) && isset($skill['user_id']) && $_SESSION['user_id'] == $skill['user_id']): ?>
                                    <div class="alert alert-info mb-0 small p-2 text-center">
                                        <i class="fas fa-info-circle me-1"></i>This is your skill post.
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
                        <a href="skills.php" class="btn btn-outline-secondary back-btn">
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
            <h3 class="section-heading mb-4"><i class="fas fa-lightbulb me-2 text-warning"></i>Similar Skills You Might Like</h3>
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
                        <div class="card similar-skill-card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($similarSkill['title']); ?></h5>
                                <span class="badge category-badge rounded-pill mb-2" style="background-color: var(--primary);">
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
                        <div class="alert alert-light text-center no-skills-alert">
                            <i class="far fa-lightbulb me-2"></i>No similar skills found in this category.
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
    
    .main-skill-card {
        border-radius: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08) !important;
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-weight: 600;
        color: var(--gray-dark);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .section-heading {
        font-weight: 700;
        color: var(--gray-dark);
        position: relative;
        padding-left: 0.5rem;
    }
    
    .avatar-lg {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);
    }
    
    .instructor-card {
        background-color: rgba(248, 250, 252, 0.8);
        border-radius: 16px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.06) !important;
        transition: all 0.3s ease;
        transform: translateY(0);
    }
    
    .instructor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .instructor-title {
        color: var(--gray-dark);
    }
    
    .card-title {
        color: var(--gray-dark);
        line-height: 1.4;
    }
    
    .breadcrumb-nav {
        background-color: rgba(248, 250, 252, 0.7);
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        font-size: 1.2rem;
        line-height: 1;
        color: var(--gray);
    }
    
    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .breadcrumb-item a:hover {
        color: var(--primary-dark);
    }
    
    .category-badge {
        font-weight: 500;
        padding: 0.5em 1em;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.75rem;
    }
    
    .date-posted {
        font-size: 0.85rem;
    }
    
    .contact-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .contact-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(99, 102, 241, 0.25);
    }
    
    .back-btn {
        transition: all 0.2s ease;
    }
    
    .back-btn:hover {
        background-color: var(--gray-light);
    }
    
    .skill-description, .skill-details {
        line-height: 1.7;
        font-size: 1.05rem;
    }
    
    .availability-section {
        background-color: rgba(248, 250, 252, 0.7);
        padding: 1rem;
        border-radius: 12px;
    }
    
    .icon-container {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        color: white;
        border-radius: 50%;
        font-size: 1rem;
    }
    
    .similar-skill-card {
        border-radius: 12px;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .similar-skill-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .no-skills-alert {
        border-radius: 12px;
        padding: 1.5rem;
    }
    
    @media (max-width: 767.98px) {
        .main-skill-card {
            margin-bottom: 1rem;
        }
        
        .instructor-card {
            margin-top: 2rem;
        }
        
        .skill-section {
            margin-bottom: 2rem;
        }
        
        .skill-description, .skill-details {
            font-size: 1rem;
        }
    }
</style>

<?php
include 'footer.php';
$conn->close();
?>