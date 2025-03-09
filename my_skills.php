<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
include 'header.php';

$userId = $_SESSION['user_id'];

// Fetch user's skills from the database
$stmt = $conn->prepare("SELECT id, title, description, category, image FROM skills WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$skills = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">My Skill Posts</h2>
            <p class="section-subtitle">Manage your skills and see who's interested in learning from you</p>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <p>You have <span class="text-primary fw-bold"><?= count($skills) ?></span> skills listed</p>
            </div>
            <a href="create_skill.php" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i> Add New Skill
            </a>
        </div>
        
        <?php if (count($skills) > 0): ?>
            <div class="skills-grid">
                <?php foreach ($skills as $index => $skill): ?>
                    <div class="skill-card animate-on-scroll" style="--delay: <?= 0.1 * ($index + 1) ?>s">
                        <div class="skill-card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge rounded-pill" style="background-color: var(--primary);">
                                    <?= htmlspecialchars($skill['category']) ?>
                                </span>
                                <div class="dropdown">
                                    <button class="btn-link" type="button" id="dropdownMenu<?= $skill['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu<?= $skill['id'] ?>">
                                        <li><a class="dropdown-item" href="edit_skill.php?id=<?= $skill['id'] ?>"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="delete_skill.php?id=<?= $skill['id'] ?>" onclick="return confirm('Are you sure you want to delete this skill?')"><i class="fas fa-trash-alt me-2"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <h3 class="skill-card-title"><?= htmlspecialchars($skill['title']) ?></h3>
                            <p class="skill-card-description"><?= htmlspecialchars($skill['description']) ?></p>
                            
                            <div class="skill-card-user">
                                <div class="avatar">
                                    <?= substr($_SESSION['user_name'] ?? 'U', 0, 1) ?>
                                </div>
                                <span><?= $_SESSION['user_name'] ?? 'You' ?></span>
                            </div>
                        </div>
                        <div class="skill-card-footer">
                            <a href="skill_detail.php?id=<?= $skill['id'] ?>" class="btn btn-outline-primary">View Details</a>
                            <a href="edit_skill.php?id=<?= $skill['id'] ?>" class="btn btn-link"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3>Share Your Expertise</h3>
                <p>You haven't posted any skills yet. Start sharing what you're good at and connect with others who want to learn!</p>
                <a href="create_skill.php" class="btn btn-primary mt-3">
                    <i class="fas fa-plus-circle me-2"></i> Add Your First Skill
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); /* Increased minmax value */
        gap: var(--space-lg);
    }

    .skill-card {
        background-color: #fff;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md); /* Increased shadow intensity */
        overflow: hidden;
        transition: transform var(--transition-fast);
        opacity: 0;
        transform: translateY(20px);
    }

    .skill-card:hover {
        transform: translateY(-5px); /* Slight lift on hover */
        box-shadow: var(--shadow-lg); /* Even more shadow on hover */
    }

    .skill-card.animated {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .skill-card-body {
        padding: var(--space-md);
    }

    .skill-card-title {
        font-size: 1.25rem;
        margin-bottom: var(--space-sm);
        font-weight: 600; /* Slightly bolder title */
    }

    .skill-card-description {
        color: var(--gray);
        margin-bottom: var(--space-md);
        line-height: 1.6; /* Improved readability */
    }

    .skill-card-user {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        margin-top: var(--space-md);
        padding-top: var(--space-md);
        border-top: 1px solid var(--gray-light); /* Added a subtle border */
    }

    .skill-card-footer {
        padding: var(--space-sm) var(--space-md);
        background-color: rgba(0, 0, 0, 0.03);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .empty-state {
        text-align: center;
        padding: var(--space-3xl) 0;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .empty-state-icon {
        font-size: 3rem;
        color: var(--gray-light);
        background-color: rgba(0, 0, 0, 0.03);
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto var(--space-lg);
    }
    
    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: var(--space-md);
    }
    
    .empty-state p {
        color: var(--gray);
        margin-bottom: var(--space-lg);
    }
    
    .dropdown-menu {
        min-width: auto;
        padding: var(--space-xs) 0;
        border: none;
        box-shadow: var(--shadow-md);
        border-radius: var(--radius-md);
    }
    
    .dropdown-item {
        padding: var(--space-sm) var(--space-md);
        font-size: 0.875rem;
    }
    
    .btn-link {
        background: none;
        border: none;
        color: var(--gray);
        padding: var(--space-xs);
        cursor: pointer;
        transition: color var(--transition-fast);
    }
    
    .btn-link:hover {
        color: var(--primary);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation for cards
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    });
    
    animatedElements.forEach(el => {
        observer.observe(el);
    });
});
</script>

<?php
include 'footer.php';
$conn->close();
?>