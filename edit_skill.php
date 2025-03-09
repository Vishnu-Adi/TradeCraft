<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
include 'header.php';

// Get the skill ID from the query parameter and validate it
$skillId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userId = $_SESSION['user_id'];

// Fetch the skill data from the database
$stmt = $conn->prepare("SELECT * FROM skills WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $skillId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $skill = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "Skill not found or you don't have permission to edit it.";
    header("Location: my_skills.php");
    exit();
}
$stmt->close();
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Edit Skill Post</h2>
            <p class="section-subtitle">Update your skill details to keep them accurate and engaging</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light py-3">
                        <div class="d-flex align-items-center">
                            <span class="badge rounded-pill me-3" style="background-color: var(--primary);">
                                <?= htmlspecialchars($skill['category']) ?>
                            </span>
                            <h5 class="mb-0"><?= htmlspecialchars($skill['title']) ?></h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="edit_skill_process.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $skillId; ?>">
                            
                            <div class="mb-4">
                                <label for="title" class="form-label fw-medium">Skill Title</label>
                                <input type="text" class="form-control form-control-lg" id="title" name="title" value="<?php echo htmlspecialchars($skill['title']); ?>" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="category" class="form-label fw-medium">Category</label>
                                <select class="form-select form-select-lg" id="category" name="category">
                                    <option value="cooking" <?php if ($skill['category'] == 'cooking') echo 'selected'; ?>>Cooking</option>
                                    <option value="webdev" <?php if ($skill['category'] == 'webdev') echo 'selected'; ?>>Web Development</option>
                                    <option value="photography" <?php if ($skill['category'] == 'photography') echo 'selected'; ?>>Photography</option>
                                    <option value="writing" <?php if ($skill['category'] == 'writing') echo 'selected'; ?>>Writing</option>
                                    <option value="music" <?php if ($skill['category'] == 'music') echo 'selected'; ?>>Music</option>
                                    <option value="art" <?php if ($skill['category'] == 'art') echo 'selected'; ?>>Art</option>
                                    <option value="fitness" <?php if ($skill['category'] == 'fitness') echo 'selected'; ?>>Fitness</option>
                                    <option value="languages" <?php if ($skill['category'] == 'languages') echo 'selected'; ?>>Languages</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="description" class="form-label fw-medium">Short Description</label>
                                <textarea class="form-control" id="description" name="description" rows="2" required><?php echo htmlspecialchars($skill['description']); ?></textarea>
                                <small class="text-muted">This appears in skill listings (150 characters max)</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="details" class="form-label fw-medium">Detailed Description</label>
                                <textarea class="form-control" id="details" name="details" rows="5"><?php echo htmlspecialchars($skill['details']); ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="availability" class="form-label fw-medium">Availability</label>
                                <input type="text" class="form-control" id="availability" name="availability" value="<?php echo htmlspecialchars($skill['availability']); ?>">
                                <small class="text-muted">Let others know when you're available to share this skill</small>
                            </div>
                            
                            <?php if ($skill['image']): ?>
                                <div class="mb-4">
                                    <label class="form-label fw-medium">Current Image</label>
                                    <div class="border rounded p-2 text-center bg-light">
                                        <img src="<?php echo htmlspecialchars($skill['image']); ?>" alt="Current Skill Image" class="img-fluid" style="max-height: 200px;">
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mb-4">
                                <label for="image" class="form-label fw-medium">Upload New Image (optional)</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <small class="text-muted">Leave empty to keep the current image</small>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="delete_skill.php?id=<?php echo $skillId; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this skill post? This action cannot be undone.')">
                                    <i class="fas fa-trash-alt me-2"></i>Delete Skill
                                </a>
                                
                                <div>
                                    <a href="my_skills.php" class="btn btn-outline-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Skill
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.15);
    }
    
    .form-label {
        color: var(--gray-dark);
    }
    
    small.text-muted {
        font-size: 0.8rem;
    }
    
    .card {
        border-radius: var(--radius-md);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
</style>

<?php 
include 'footer.php';
$conn->close();
?>