<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-badge">Community Skill Exchange</span>
                <h1 class="hero-title">Exchange Skills, <span class="gradient-text">Grow Together</span></h1>
                <p class="hero-subtitle">Join our community platform where people share their expertise, learn new skills, and connect with talented individuals in their neighborhood.</p>
                <div class="hero-actions">
                    <a href="signup.php" class="btn btn-primary btn-lg">Get Started <i class="fas fa-arrow-right ml-2"></i></a>
                    <a href="#how-it-works" class="btn btn-outline-primary btn-lg">How It Works</a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">5,000+</span>
                        <span class="hero-stat-label">Active Members</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">2,500+</span>
                        <span class="hero-stat-label">Skills Shared</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">10,000+</span>
                        <span class="hero-stat-label">Connections</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="images/hero-illustration.svg" alt="SkillSwap Community" class="animate-on-scroll">
                <div class="hero-shape-1"></div>
                <div class="hero-shape-2"></div>
            </div>
        </div>
    </div>
    <div class="hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,213.3C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Categories Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Explore Skill Categories</h2>
            <p class="section-subtitle">Discover skills across various categories and find what interests you the most</p>
        </div>
        <div class="category-grid">
            <div class="category-card animate-on-scroll" style="--delay: 0.1s">
                <div class="category-card-content">
                    <div class="category-icon-wrapper" style="--color: var(--primary)">
                        <i class="fas fa-palette category-icon"></i>
                    </div>
                    <h3 class="category-title">Creative Arts</h3>
                    <p class="category-description">Photography, Design, Music, Painting, and more creative skills</p>
                    <a href="skills.php?category=creative" class="category-link">
                        Explore <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <div class="category-card-shape"></div>
            </div>
            
            <div class="category-card animate-on-scroll" style="--delay: 0.2s">
                <div class="category-card-content">
                    <div class="category-icon-wrapper" style="--color: var(--secondary)">
                        <i class="fas fa-laptop-code category-icon"></i>
                    </div>
                    <h3 class="category-title">Technology</h3>
                    <p class="category-description">Programming, Web Development, Data Science, and digital skills</p>
                    <a href="skills.php?category=technology" class="category-link">
                        Explore <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <div class="category-card-shape"></div>
            </div>
            
            <div class="category-card animate-on-scroll" style="--delay: 0.3s">
                <div class="category-card-content">
                    <div class="category-icon-wrapper" style="--color: var(--accent-1)">
                        <i class="fas fa-heart category-icon"></i>
                    </div>
                    <h3 class="category-title">Lifestyle</h3>
                    <p class="category-description">Cooking, Fitness, Languages, Personal Development, and more</p>
                    <a href="skills.php?category=lifestyle" class="category-link">
                        Explore <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                <div class="category-card-shape"></div>
            </div>
        </div>
        <div class="section-footer">
            <a href="categories.php" class="btn btn-outline-primary">
                View All Categories <i class="fas fa-th-large ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section bg-light" id="how-it-works">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">How SkillSwap Works</h2>
            <p class="section-subtitle">Our simple process to connect, learn, and share skills with others</p>
        </div>
        <div class="steps-container">
            <div class="step-line"></div>
            <div class="steps">
                <div class="step animate-on-scroll" style="--delay: 0.1s">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <div class="step-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="step-title">Create Your Profile</h3>
                        <p class="step-description">Sign up and create your profile highlighting the skills you can teach and the ones you want to learn.</p>
                        <ul class="step-list">
                            <li>List your expertise and experience</li>
                            <li>Specify your availability</li>
                            <li>Set your preferred teaching methods</li>
                        </ul>
                    </div>
                </div>
                
                <div class="step animate-on-scroll" style="--delay: 0.2s">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <div class="step-icon" style="background-color: rgba(255, 0, 110, 0.1); color: var(--secondary);">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="step-title">Find Skill Matches</h3>
                        <p class="step-description">Browse through available skills or search for specific ones you're interested in learning.</p>
                        <ul class="step-list">
                            <li>Filter by category, location, or rating</li>
                            <li>Read reviews from other learners</li>
                            <li>Discover trending skills in your area</li>
                        </ul>
                    </div>
                </div>
                
                <div class="step animate-on-scroll" style="--delay: 0.3s">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <div class="step-icon" style="background-color: rgba(0, 180, 216, 0.1); color: var(--accent-1);">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="step-title">Connect & Exchange</h3>
                        <p class="step-description">Reach out to potential skill partners, schedule sessions, and start learning from each other.</p>
                        <ul class="step-list">
                            <li>Message directly through the platform</li>
                            <li>Arrange virtual or in-person meetings</li>
                            <li>Rate and review your experience</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Skills Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Featured Skills</h2>
            <p class="section-subtitle">Discover popular skills being shared in our community</p>
        </div>
        <div class="skills-grid">
            <?php
            // This would typically come from your database
            $featuredSkills = [
                [
                    'id' => 1,
                    'title' => 'Digital Photography Masterclass',
                    'image' => 'images/photography.jpg',
                    'category' => 'Creative Arts',
                    'category_color' => 'var(--secondary)',
                    'description' => 'Learn professional photography techniques from composition to advanced editing.',
                    'user_name' => 'Emma Wilson',
                    'user_avatar' => 'https://randomuser.me/api/portraits/women/44.jpg'
                ],
                [
                    'id' => 2,
                    'title' => 'Modern Web Development',
                    'image' => 'images/webdev.jpg',
                    'category' => 'Technology',
                    'category_color' => 'var(--primary)',
                    'description' => 'Build responsive websites using the latest frameworks and best practices.',
                    'user_name' => 'Alex Chen',
                    'user_avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
                ],
                [
                    'id' => 3,
                    'title' => 'Plant-Based Cooking',
                    'image' => 'images/cooking.jpg',
                    'category' => 'Lifestyle',
                    'category_color' => 'var(--accent-1)',
                    'description' => 'Create delicious and nutritious plant-based meals that everyone will love.',
                    'user_name' => 'Maria Rodriguez',
                    'user_avatar' => 'https://randomuser.me/api/portraits/women/68.jpg'
                ]
            ];
            
            foreach ($featuredSkills as $index => $skill): 
            ?>
            <div class="skill-card animate-on-scroll" style="--delay: <?php echo 0.1 * ($index + 1); ?>s">
                <div class="skill-card-image">
                    <img src="<?php echo $skill['image']; ?>" alt="<?php echo $skill['title']; ?>">
                    <div class="skill-card-badge" style="background-color: <?php echo $skill['category_color']; ?>">
                        <?php echo $skill['category']; ?>
                    </div>
                </div>
                <div class="skill-card-body">
                    <h3 class="skill-card-title"><?php echo $skill['title']; ?></h3>
                    <p class="skill-card-description"><?php echo $skill['description']; ?></p>
                    <div class="skill-card-user">
                        <img src="<?php echo $skill['user_avatar']; ?>" alt="<?php echo $skill['user_name']; ?>" class="skill-card-avatar">
                        <span class="skill-card-username"><?php echo $skill['user_name']; ?></span>
                    </div>
                </div>
                <div class="skill-card-footer">
                    <a href="skill_detail.php?id=<?php echo $skill['id']; ?>" class="btn btn-primary btn-block">View Details</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="section-footer">
            <a href="skills.php" class="btn btn-outline-primary">
                Browse All Skills <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">What Our Community Says</h2>
            <p class="section-subtitle">Hear from members who have experienced the power of skill exchange</p>
        </div>
        <div class="testimonials-slider">
            <div class="testimonials-track">
                <div class="testimonial-card animate-on-scroll" style="--delay: 0.1s">
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"I've always wanted to learn guitar but couldn't afford lessons. Through SkillSwap, I found someone who taught me guitar in exchange for my Spanish lessons. It's been an amazing experience!"</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Michael Turner" class="testimonial-author-avatar">
                        <div class="testimonial-author-info">
                            <h4 class="testimonial-author-name">Michael Turner</h4>
                            <p class="testimonial-author-title">Member since 2022</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card animate-on-scroll" style="--delay: 0.2s">
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"As a professional photographer, I wanted to learn coding. I connected with a developer who needed photography for his portfolio. We both gained valuable skills and became good friends!"</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Emily Watson" class="testimonial-author-avatar">
                        <div class="testimonial-author-info">
                            <h4 class="testimonial-author-name">Emily Watson</h4>
                            <p class="testimonial-author-title">Member since 2021</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card animate-on-scroll" style="--delay: 0.3s">
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="testimonial-text">"SkillSwap helped me discover hidden talents in my own neighborhood. I've learned cooking, basic car maintenance, and even meditation - all while teaching others about digital marketing."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/86.jpg" alt="David Patel" class="testimonial-author-avatar">
                        <div class="testimonial-author-info">
                            <h4 class="testimonial-author-name">David Patel</h4>
                            <p class="testimonial-author-title">Member since 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card animate-on-scroll" style="--delay: 0.1s">
                <div class="stat-number" style="color: var(--primary);">5K+</div>
                <div class="stat-label">Active Members</div>
            </div>
            <div class="stat-card animate-on-scroll" style="--delay: 0.2s">
                <div class="stat-number" style="color: var(--secondary);">2.5K+</div>
                <div class="stat-label">Skills Shared</div>
            </div>
            <div class="stat-card animate-on-scroll" style="--delay: 0.3s">
                <div class="stat-number" style="color: var(--accent-1);">10K+</div>
                <div class="stat-label">Connections Made</div>
            </div>
            <div class="stat-card animate-on-scroll" style="--delay: 0.4s">
                <div class="stat-number" style="color: var(--accent-2);">50+</div>
                <div class="stat-label">Communities</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content animate-on-scroll">
            <h2 class="cta-title">Ready to Share Your Skills?</h2>
            <p class="cta-text">Join our growing community of skill exchangers and start learning something new today while helping others grow.</p>
            <div class="cta-actions">
                <a href="signup.php" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus mr-2"></i>Join Now - It's Free!
                </a>
                <a href="about.php" class="btn btn-outline-light btn-lg">
                    Learn More About Us
                </a>
            </div>
        </div>
    </div>
    <div class="cta-shape-1"></div>
    <div class="cta-shape-2"></div>
</section>

<!-- Newsletter Section -->
<section class="section bg-light">
    <div class="container">
        <div class="newsletter-container animate-on-scroll">
            <div class="newsletter-content">
                <h2 class="newsletter-title">Stay Updated with SkillSwap</h2>
                <p class="newsletter-text">Subscribe to our newsletter to receive the latest updates, skill-sharing tips, and community stories.</p>
            </div>
            <form class="newsletter-form-large">
                <div class="newsletter-form-group">
                    <input type="email" class="newsletter-input-large" placeholder="Your email address" required>
                    <button type="submit" class="newsletter-button-large">
                        Subscribe <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
                <p class="newsletter-disclaimer">We respect your privacy. Unsubscribe at any time.</p>
            </form>
        </div>
    </div>
</section>

<style>
/* Hero Section */
.hero {
    position: relative;
    padding: var(--space-3xl) 0 var(--space-xl);
    background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
    overflow: hidden;
}

.hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-xl);
    align-items: center;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    background-color: rgba(58, 134, 255, 0.1);
    color: var(--primary);
    border-radius: var(--radius-full);
    font-weight: 500;
    font-size: 0.875rem;
    margin-bottom: var(--space-md);
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    line-height: 1.2;
    margin-bottom: var(--space-md);
}

.gradient-text {
    background: linear-gradient(90deg, var(--primary) 0%, var(--accent-3) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
}

.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: var(--gray);
    margin-bottom: var(--space-lg);
    max-width: 540px;
}

.hero-actions {
    display: flex;
    gap: var(--space-md);
    margin-bottom: var(--space-xl);
    flex-wrap: wrap;
}

.hero-stats {
    display: flex;
    gap: var(--space-xl);
}

.hero-stat {
    display: flex;
    flex-direction: column;
}

.hero-stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark);
}

.hero-stat-label {
    font-size: 0.875rem;
    color: var(--gray);
}

.hero-image {
    position: relative;
    z-index: 2;
}

.hero-image img {
    max-width: 100%;
    height: auto;
    position: relative;
    z-index: 2;
}

.hero-shape-1 {
    position: absolute;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.2) 0%, rgba(67, 97, 238, 0.2) 100%);
    top: -100px;
    right: -100px;
    z-index: 1;
}

.hero-shape-2 {
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 0, 110, 0.15) 0%, rgba(217, 4, 41, 0.15) 100%);
    bottom: -50px;
    left: 50px;
    z-index: 1;
}

.hero-wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
    z-index: 1;
}

/* Section Styling */
.section {
    padding: var(--space-3xl) 0;
}

.section-header {
    text-align: center;
    max-width: 800px;
    margin: 0 auto var(--space-2xl);
}

.section-title {
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    margin-bottom: var(--space-md);
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: var(--radius-full);
}

.section-subtitle {
    color: var(--gray);
    font-size: 1.125rem;
    max-width: 600px;
    margin: var(--space-lg) auto 0;
}

.section-footer {
    text-align: center;
    margin-top: var(--space-xl);
}

/* Category Cards */
.category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-lg);
}

.category-card {
    position: relative;
    background-color: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
    height: 100%;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.category-card-content {
    padding: var(--space-xl);
    position: relative;
    z-index: 2;
}

.category-icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: rgba(var(--color), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: var(--space-md);
}

.category-icon {
    font-size: 1.5rem;
    color: var(--color);
}

.category-title {
    font-size: 1.25rem;
    margin-bottom: var(--space-sm);
}

.category-description {
    color: var(--gray);
    margin-bottom: var(--space-lg);
}

.category-link {
    display: inline-flex;
    align-items: center;
    color: var(--primary);
    font-weight: 500;
}

.category-link i {
    margin-left: var(--space-xs);
    transition: transform var(--transition-fast);
}

.category-link:hover i {
    transform: translateX(5px);
}

.category-card-shape {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.05) 0%, rgba(67, 97, 238, 0.05) 100%);
    border-radius: 50% 0 0 0;
    z-index: 1;
}

/* Steps */
.steps-container {
    position: relative;
    padding: var(--space-md) 0;
}

.step-line {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 2px;
    background-color: rgba(var(--primary), 0.2);
    transform: translateX(-50%);
}

.steps {
    position: relative;
    z-index: 2;
}

.step {
    display: flex;
    margin-bottom: var(--space-2xl);
    position: relative;
}

.step:last-child {
    margin-bottom: 0;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-right: var(--space-lg);
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}

.step-content {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-lg);
    box-shadow: var(--shadow-md);
    flex: 1;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: rgba(58, 134, 255, 0.1);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    margin-bottom: var(--space-md);
}

.step-title {
    font-size: 1.25rem;
    margin-bottom: var(--space-sm);
}

.step-description {
    color: var(--gray);
    margin-bottom: var(--space-md);
}

.step-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.step-list li {
    position: relative;
    padding-left: var(--space-lg);
    margin-bottom: var(--space-xs);
}

.step-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: var(--primary);
}

/* Skills Grid */
.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-lg);
}

.skill-card {
    background-color: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.skill-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.skill-card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.skill-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-normal);
}

.skill-card:hover .skill-card-image img {
    transform: scale(1.05);
}

.skill-card-badge {
    position: absolute;
    top: var(--space-md);
    right: var(--space-md);
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-full);
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
}

.skill-card-body {
    padding: var(--space-lg);
    flex: 1;
}

.skill-card-title {
    font-size: 1.25rem;
    margin-bottom: var(--space-sm);
}

.skill-card-description {
    color: var(--gray);
    margin-bottom: var(--space-md);
}

.skill-card-user {
    display: flex;
    align-items: center;
}

.skill-card-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    margin-right: var(--space-sm);
}

.skill-card-username {
    font-weight: 500;
}

.skill-card-footer {
    padding: var(--space-md);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.btn-block {
    width: 100%;
}

/* Testimonials */
.testimonials-slider {
    overflow: hidden;
    padding: var(--space-md) 0;
}

.testimonials-track {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-lg);
}

.testimonial-card {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-lg);
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
    height: 100%;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.testimonial-content {
    margin-bottom: var(--space-lg);
}

.testimonial-rating {
    color: var(--warning);
    margin-bottom: var(--space-md);
}

.testimonial-text {
    font-style: italic;
    color: var(--gray-dark);
}

.testimonial-author {
    display: flex;
    align-items: center;
}

.testimonial-author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: var(--space-md);
}

.testimonial-author-name {
    font-size: 1rem;
    margin: 0 0 var(--space-xs);
}

.testimonial-author-title {
    font-size: 0.875rem;
    color: var(--gray);
    margin: 0;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--space-lg);
    text-align: center;
}

.stat-card {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-xl);
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: var(--space-sm);
}

.stat-label {
    color: var(--gray);
    font-size: 1rem;
}

/* CTA Section */
.cta-section {
    position: relative;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent-3) 100%);
    color: white;
    padding: var(--space-3xl) 0;
    margin: var(--space-3xl) 0;
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.cta-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.cta-title {
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    margin-bottom: var(--space-md);
}

.cta-text {
    font-size: 1.125rem;
    max-width: 600px;
    margin: 0 auto var(--space-xl);
}

.cta-actions {
    display: flex;
    justify-content: center;
    gap: var(--space-md);
    flex-wrap: wrap;
}

.cta-shape-1 {
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.cta-shape-2 {
    position: absolute;
    bottom: -100px;
    left: -50px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
}

/* App Download Section */
.app-download-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-2xl);
    align-items: center;
}

.app-download-image {
    position: relative;
}

.app-mockup {
    position: relative;
    z-index: 2;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
}

.app-image-shape-1 {
    position: absolute;
    top: -30px;
    left: -30px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.1) 0%, rgba(67, 97, 238, 0.1) 100%);
    z-index: 1;
}

.app-image-shape-2 {
    position: absolute;
    bottom: -20px;
    right: -20px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 0, 110, 0.1) 0%, rgba(217, 4, 41, 0.1) 100%);
    z-index: 1;
}

.app-download-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    margin-bottom: var(--space-md);
}

.app-download-text {
    color: var(--gray);
    margin-bottom: var(--space-lg);
}

.app-download-buttons {
    display: flex;
    gap: var(--space-md);
    margin-bottom: var(--space-lg);
    flex-wrap: wrap;
}

.app-download-rating {
    display: flex;
    align-items: center;
    gap: var(--space-xl);
}

.app-rating-stars {
    color: var(--warning);
    display: flex;
    align-items: center;
}

.app-rating-stars span {
    margin-left: var(--space-xs);
    color: var(--dark);
    font-weight: 500;
}

.app-downloads {
    color: var(--gray);
}

.app-downloads span {
    font-weight: 700;
    color: var(--dark);
}

/* Newsletter Section */
.newsletter-container {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-2xl);
    box-shadow: var(--shadow-md);
    text-align: center;
}

.newsletter-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    margin-bottom: var(--space-md);
}

.newsletter-text {
    color: var(--gray);
    max-width: 600px;
    margin: 0 auto var(--space-lg);
}

.newsletter-form-large {
    max-width: 600px;
    margin: 0 auto;
}

.newsletter-form-group {
    display: flex;
    margin-bottom: var(--space-sm);
}

.newsletter-input-large {
    flex: 1;
    padding: 0.75rem 1.25rem;
    border: 1px solid var(--gray-light);
    border-radius: var(--radius-md) 0 0 var(--radius-md);
    font-size: 1rem;
}

.newsletter-input-large:focus {
    outline: none;
    border-color: var(--primary);
}

.newsletter-button-large {
    padding: 0.75rem 1.5rem;
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-weight: 500;
    cursor: pointer;
    transition: background-color var(--transition-fast);
}

.newsletter-button-large:hover {
    background-color: var(--primary-dark);
}

.newsletter-disclaimer {
    font-size: 0.875rem;
    color: var(--gray);
}

/* Responsive Styles */
@media (max-width: 991px) {
    .hero-grid {
        grid-template-columns: 1fr;
    }
    
    .hero-image {
        order: -1;
        margin-bottom: var(--space-xl);
    }
    
    .hero-content {
        text-align: center;
    }
    
    .hero-subtitle {
        margin-left: auto;
        margin-right: auto;
    }
    
    .hero-actions {
        justify-content: center;
    }
    
    .hero-stats {
        justify-content: center;
    }
    
    .step {
        flex-direction: column;
    }
    
    .step-number {
        margin-right: 0;
        margin-bottom: var(--space-md);
    }
    
    .step-line {
        left: 20px;
    }
}

@media (max-width: 767px) {
    .cta-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .app-download-buttons {
        flex-direction: column;
    }
    
    .app-download-rating {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-sm);
    }
    
    .newsletter-form-group {
        flex-direction: column;
    }
    
    .newsletter-input-large {
        border-radius: var(--radius-md);
        margin-bottom: var(--space-sm);
    }
    
    .newsletter-button-large {
        border-radius: var(--radius-md);
        width: 100%;
    }
}
</style>

<?php include 'footer.php'; ?>
