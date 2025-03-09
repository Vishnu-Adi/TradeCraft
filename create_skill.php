<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'header.php';
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Create a New Skill Post</h2>
            <p class="section-subtitle">Share your expertise with the community</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="create_skill_process.php" method="post" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="title" class="form-label fw-medium">Skill Title</label>
                                <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="What skill are you offering?" required>
                                <small class="text-muted">Choose a clear, descriptive title for your skill</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="category" class="form-label fw-medium">Category</label>
                                <select class="form-select form-select-lg" id="category" name="category">
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="cooking">Cooking</option>
                                    <option value="webdev">Web Development</option>
                                    <option value="photography">Photography</option>
                                    <option value="writing">Writing</option>
                                    <option value="music">Music</option>
                                    <option value="art">Art</option>
                                    <option value="fitness">Fitness</option>
                                    <option value="languages">Languages</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="description" class="form-label fw-medium">Short Description</label>
                                <textarea class="form-control" id="description" name="description" rows="2" placeholder="Summarize your skill in a few sentences" required></textarea>
                                <small class="text-muted">This will appear in skill listings (150 characters max)</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="details" class="form-label fw-medium">Detailed Description</label>
                                <textarea class="form-control" id="details" name="details" rows="5" placeholder="Provide more information about your skill, experience level, and what participants can expect to learn"></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="availability" class="form-label fw-medium">Availability</label>
                                <input type="text" class="form-control" id="availability" name="availability" placeholder="e.g., Weekends, Evenings, Flexible">
                                <small class="text-muted">Let others know when you're available to share this skill</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="image" class="form-label fw-medium">Upload Image (optional)</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <small class="text-muted">An image can help showcase your skill (Max size: 2MB, Formats: JPG, PNG)</small>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="my_skills.php" class="btn btn-outline-secondary me-md-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Post Skill
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card bg-light border-0 mt-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-lightbulb text-warning me-2"></i>Tips for a Great Skill Post</h5>
                        <ul class="card-text mb-0">
                            <li>Be specific about what you can teach</li>
                            <li>Mention your experience level with this skill</li>
                            <li>Include any materials participants might need</li>
                            <li>Consider what makes your teaching approach unique</li>
                        </ul>
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
</style>

<?php include 'footer.php'; ?>