<?php
session_start();
// Ensure user is logged in; if not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user's name from session (or database, ideally)
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';

include 'header.php';
?>

<div class="dashboard-container">
    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="welcome-section">
                <h1>Welcome back, <?php echo htmlspecialchars($userName); ?>!</h1>
                <p>Here's what's happening with your skill exchanges today.</p>
            </div>
            <div class="dashboard-actions">
                <a href="create_skill.php" class="btn-primary">
                    <i class="fas fa-plus"></i> Create New Skill
                </a>
            </div>
        </div>
        
        <!-- Dashboard Stats -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(58, 134, 255, 0.1);">
                    <i class="fas fa-lightbulb" style="color: var(--primary);"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Skills Shared</p>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: 75%; background-color: var(--primary);"></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(255, 0, 110, 0.1);">
                    <i class="fas fa-handshake" style="color: var(--secondary);"></i>
                </div>
                <div class="stat-content">
                    <h3>48</h3>
                    <p>Connections</p>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: 60%; background-color: var(--secondary);"></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(56, 176, 0, 0.1);">
                    <i class="fas fa-exchange-alt" style="color: var(--success);"></i>
                </div>
                <div class="stat-content">
                    <h3>156</h3>
                    <p>Exchanges</p>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: 85%; background-color: var(--success);"></div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(255, 190, 11, 0.1);">
                    <i class="fas fa-star" style="color: var(--warning);"></i>
                </div>
                <div class="stat-content">
                    <h3>4.8</h3>
                    <p>Rating</p>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: 90%; background-color: var(--warning);"></div>
                </div>
            </div>
        </div>
        
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Quick Links Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Quick Actions</h2>
                    <p>Manage your account and interactions</p>
                </div>
                
                <div class="quick-links">
                    <a href="profile.php" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="quick-link-content">
                            <h3>Edit Profile</h3>
                            <p>Update your personal information and preferences</p>
                        </div>
                        <div class="quick-link-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>
                    
                    <a href="my_skills.php" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div class="quick-link-content">
                            <h3>My Skill Posts</h3>
                            <p>View and manage your skill exchange listings</p>
                        </div>
                        <div class="quick-link-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>
                    
                    <a href="messages.php" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="quick-link-content">
                            <h3>Messages</h3>
                            <p>Check your inbox and communicate with others</p>
                        </div>
                        <div class="quick-link-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>
                    
                    <a href="create_skill.php" class="quick-link-card">
                        <div class="quick-link-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="quick-link-content">
                            <h3>Create Skill</h3>
                            <p>Share a new skill or request to learn something</p>
                        </div>
                        <div class="quick-link-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Recent Activities Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Recent Activities</h2>
                    <a href="#" class="view-all-link">View All</a>
                </div>
                
                <div class="activities-list">
                    <?php
                    // Dummy activities. In a real application, fetch these from the database.
                    $activities = [
                        [
                            "icon" => "fas fa-plus-circle",
                            "color" => "var(--primary)",
                            "text" => "You posted a new skill exchange: \"Photography Basics\".",
                            "time" => "2 hours ago"
                        ],
                        [
                            "icon" => "fas fa-user-edit",
                            "color" => "var(--info)",
                            "text" => "Your profile was updated.",
                            "time" => "Yesterday"
                        ],
                        [
                            "icon" => "fas fa-envelope",
                            "color" => "var(--secondary)",
                            "text" => "You received a message from John Doe.",
                            "time" => "2 days ago"
                        ],
                        [
                            "icon" => "fas fa-handshake",
                            "color" => "var(--success)",
                            "text" => "You completed a skill exchange with Sarah Johnson.",
                            "time" => "1 week ago"
                        ],
                        [
                            "icon" => "fas fa-star",
                            "color" => "var(--warning)",
                            "text" => "You received a 5-star rating from Michael Chen.",
                            "time" => "1 week ago"
                        ]
                    ];
                    
                    foreach ($activities as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon" style="background-color: <?php echo $activity['color']; ?>20; color: <?php echo $activity['color']; ?>">
                                <i class="<?php echo $activity['icon']; ?>"></i>
                            </div>
                            <div class="activity-content">
                                <p><?php echo htmlspecialchars($activity['text']); ?></p>
                                <span class="activity-time"><?php echo htmlspecialchars($activity['time']); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Recommended Skills Section -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2>Recommended For You</h2>
                <a href="skills.php" class="view-all-link">View All Skills</a>
            </div>
            
            <div class="recommended-skills">
                <div class="skill-card">


                        <div class="skill-card-badge">Technology</div>

                    <div class="skill-card-content">
                        <h3>Web Development Basics</h3>
                        <p>Learn HTML, CSS, and JavaScript fundamentals from an experienced developer.</p>
                        <div class="skill-card-user">
                            <div class="user-avatar">M</div>
                            <span>Michael Chen</span>
                        </div>
                    </div>
                    <div class="skill-card-footer">
                        <a href="#" class="btn-outline">View Details</a>
                    </div>
                </div>
                
                <div class="skill-card">


                        <div class="skill-card-badge">Lifestyle</div>

                    <div class="skill-card-content">
                        <h3>Italian Cooking</h3>
                        <p>Master the art of Italian cuisine with authentic recipes and techniques.</p>
                        <div class="skill-card-user">
                            <div class="user-avatar">S</div>
                            <span>Sarah Johnson</span>
                        </div>
                    </div>
                    <div class="skill-card-footer">
                        <a href="#" class="btn-outline">View Details</a>
                    </div>
                </div>
                
                <div class="skill-card">


                        <div class="skill-card-badge">Creative</div>

                    <div class="skill-card-content">
                        <h3>Photography Fundamentals</h3>
                        <p>Learn composition, lighting, and editing techniques for stunning photos.</p>
                        <div class="skill-card-user">
                            <div class="user-avatar">J</div>
                            <span>James Wilson</span>
                        </div>
                    </div>
                    <div class="skill-card-footer">
                        <a href="#" class="btn-outline">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-container {
        padding: 3rem 0;
        background-color: #f8f9fa;
        min-height: calc(100vh - 70px);
    }
    
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .welcome-section h1 {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .welcome-section p {
        color: var(--gray);
    }
    
    .dashboard-actions {
        display: flex;
        gap: 1rem;
    }
    
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background-color: var(--primary);
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-primary:hover {
        background-color: #2a75e6;
        transform: translateY(-2px);
    }
    
    .btn-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background-color: transparent;
        color: var(--primary);
        border: 1px solid var(--primary);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-outline:hover {
        background-color: var(--primary);
        color: white;
    }
    
    /* Stats Cards */
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background-color: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        gap: 1rem;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .stat-content h3 {
        font-size: 1.75rem;
        margin-bottom: 0.25rem;
    }
    
    .stat-content p {
        color: var(--gray);
        font-size: 0.875rem;
    }
    
    .stat-progress {
        height: 4px;
        background-color: #f1f3f5;
        border-radius: 2px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        border-radius: 2px;
    }
    
    /* Dashboard Content */
    .dashboard-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .dashboard-section {
        background-color: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .section-header h2 {
        font-size: 1.25rem;
        margin: 0;
    }
    
    .section-header p {
        color: var(--gray);
        margin-top: 0.25rem;
    }
    
    .view-all-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
    }
    
    .view-all-link:hover {
        text-decoration: underline;
    }
    
    /* Quick Links */
    .quick-links {
      margin-top:70px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1rem;
    }
    
    .quick-link-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        text-decoration: none;
        color: var(--dark);
        transition: all 0.2s ease;
    }
    
    .quick-link-card:hover {
        background-color: rgba(58, 134, 255, 0.1);
        transform: translateY(-2px);
    }
    
    .quick-link-icon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--primary);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .quick-link-content {
        flex: 1;
    }
    
    .quick-link-content h3 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }
    
    .quick-link-content p {
        font-size: 0.75rem;
        color: var(--gray);
        margin: 0;
    }
    
    .quick-link-arrow {
        color: var(--gray);
        transition: transform 0.2s ease;
    }
    
    .quick-link-card:hover .quick-link-arrow {
        transform: translateX(3px);
        color: var(--primary);
    }
    
    /* Activities List */
    .activities-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
    }
    
    .activity-item:hover {
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-content p {
        margin: 0 0 0.25rem;
    }
    
    .activity-time {
        font-size: 0.75rem;
        color: var(--gray);
    }
    
    /* Recommended Skills */
    .recommended-skills {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    
    .skill-card {
        position:relative;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    
    .skill-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    

  

    .skill-card-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.25rem 0.75rem;
        background-color: var(--primary);
        color: white;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .skill-card-content {
        padding: 1.5rem;
        flex: 1;
    }
    
    .skill-card-content h3 {
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }
    
    .skill-card-content p {
        color: var(--gray);
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
    
    .skill-card-user {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .skill-card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #f1f3f5;
        text-align: center;
    }
    

</style>

<?php include 'footer.php'; ?>

