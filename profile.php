<?php
session_start();
// Ensure user is logged in; if not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
include 'header.php';

$userId = $_SESSION['user_id'];

// Fetch user details from the database (using prepared statements)
$stmt = $conn->prepare("SELECT fullName, email, bio, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $userDetails = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "User not found."; // Should not happen, but good to have a check
    header("Location: dashboard.php");
    exit();
}

$stmt->close();
?>

<div class="profile-container">
    <div class="container">
        <div class="profile-wrapper">
            <!-- Profile Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-image-container">
                    <?php if ($userDetails['profile_image']): ?>
                        <img src="<?php echo htmlspecialchars($userDetails['profile_image']); ?>" alt="Profile Image" class="profile-image">
                    <?php else: ?>
                        <div class="profile-image-placeholder">
                            <?php echo substr($userDetails['fullName'], 0, 1); ?>
                        </div>
                    <?php endif; ?>
                    <div class="profile-image-overlay">
                        <label for="profileImage" class="image-upload-label">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>
                </div>
                
                <h3 class="profile-name"><?php echo htmlspecialchars($userDetails['fullName']); ?></h3>
                <p class="profile-email"><?php echo htmlspecialchars($userDetails['email']); ?></p>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-value">12</span>
                        <span class="stat-label">Skills</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">48</span>
                        <span class="stat-label">Connections</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">156</span>
                        <span class="stat-label">Exchanges</span>
                    </div>
                </div>
                
                <div class="profile-actions">
                    <a href="dashboard.php" class="profile-action-link">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="my_skills.php" class="profile-action-link">
                        <i class="fas fa-list"></i> My Skills
                    </a>
                    <a href="messages.php" class="profile-action-link">
                        <i class="fas fa-envelope"></i> Messages
                    </a>
                    <a href="settings.php" class="profile-action-link">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </div>
            </div>
            
            <!-- Profile Content -->
            <div class="profile-content">
                <div class="profile-header">
                    <h1>My Profile</h1>
                    <p>Update your personal information and profile settings</p>
                </div>
                
                <div class="profile-form-container">
                    <form action="profile_update.php" method="post" enctype="multipart/form-data" class="profile-form">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($userDetails['fullName']); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>" readonly>
                            </div>
                            <small class="form-text">Email address cannot be changed</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself, your skills, and what you're looking to learn..."><?php echo htmlspecialchars($userDetails['bio']); ?></textarea>
                        </div>
                        
                        <div class="form-group file-upload">
                            <label for="profileImage">Profile Image</label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="profileImage" name="profileImage" class="file-upload-input">
                                <div class="file-upload-text">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Choose a file or drag it here</span>
                                </div>
                                <div class="file-upload-preview"></div>
                            </div>
                            <small class="form-text">Recommended size: 300x300 pixels. Max file size: 2MB.</small>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <button type="reset" class="btn-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-container {
        padding: 3rem 0;
        background-color: #f8f9fa;
        min-height: calc(100vh - 70px);
    }
    
    .profile-wrapper {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
        background-color: transparent;
    }
    
    /* Profile Sidebar */
    .profile-sidebar {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        text-align: center;
        height: fit-content;
    }
    
    .profile-image-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-image-placeholder {
        width: 100%;
        height: 100%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 600;
    }
    
    .profile-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 0.5rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .profile-image-container:hover .profile-image-overlay {
        opacity: 1;
    }
    
    .image-upload-label {
        color: white;
        cursor: pointer;
    }
    
    .profile-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .profile-email {
        color: var(--gray);
        margin-bottom: 1.5rem;
    }
    
    .profile-stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding: 1rem 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }
    
    .stat-item {
        display: flex;
        flex-direction: column;
    }
    
    .stat-value {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary);
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: var(--gray);
    }
    
    .profile-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        text-align: left;
    }
    
    .profile-action-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        color: var(--dark);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .profile-action-link:hover {
        background-color: rgba(58, 134, 255, 0.1);
        color: var(--primary);
    }
    
    .profile-action-link i {
        width: 20px;
        color: var(--primary);
    }
    
    /* Profile Content */
    .profile-content {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }
    
    .profile-header {
        margin-bottom: 2rem;
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
    }
    
    .profile-header h1 {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .profile-header p {
        color: var(--gray);
    }
    
    .profile-form-container {
        max-width: 800px;
    }
    
    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .form-group label {
        font-weight: 500;
    }
    
    .input-with-icon {
        position: relative;
    }
    
    .input-with-icon i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }
    
    .input-with-icon input {
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s ease;
    }
    
    .input-with-icon input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);
    }
    
    textarea {
        padding: 0.75rem 1rem;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        resize: vertical;
        min-height: 120px;
        transition: all 0.2s ease;
    }
    
    textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);
    }
    
    .form-text {
        font-size: 0.875rem;
        color: var(--gray);
    }
    
    .file-upload-wrapper {
        position: relative;
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .file-upload-wrapper:hover {
        border-color: var(--primary);
    }
    
    .file-upload-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    .file-upload-text {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        color: var(--gray);
    }
    
    .file-upload-text i {
        font-size: 2rem;
        color: var(--primary);
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .btn-primary, .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #2a75e6;
    }
    
    .btn-secondary {
        background-color: #f1f3f5;
        color: var(--dark);
    }
    
    .btn-secondary:hover {
        background-color: #e9ecef;
    }
    
    @media (max-width: 991px) {
        .profile-wrapper {
            grid-template-columns: 1fr;
        }
        
        .profile-sidebar {
            margin-bottom: 2rem;
        }
    }
</style>

<script>
    // File upload preview
    const fileInput = document.getElementById('profileImage');
    const filePreview = document.querySelector('.file-upload-preview');
    const fileText = document.querySelector('.file-upload-text');
    
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    filePreview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px; margin-top: 1rem;">`;
                    fileText.style.display = 'none';
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
</script>

<?php
include 'footer.php';
$conn->close();
?>

