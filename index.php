<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-particles"></div>
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-badge">Community Skill Exchange</span>
                <h1 class="hero-title">Exchange Skills, <span class="gradient-text">Grow Together</span></h1>
                <p class="hero-subtitle">Join our community platform where people share their expertise, learn new skills, and connect with talented individuals in their neighborhood.</p>
                <div class="hero-actions">
                    <a href="signup.php" class="btn btn-primary btn-lg">
                        Get Started <i class="fas fa-arrow-right ml-2"></i>
                        <span class="btn-glow"></span>
                    </a>
                    <a href="#how-it-works" class="btn btn-outline-primary btn-lg">
                        How It Works
                        <span class="btn-outline-glow"></span>
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">5,000+</span>
                        <span class="hero-stat-label">Active Members</span>
                        <div class="stat-icon-bg">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">2,500+</span>
                        <span class="hero-stat-label">Skills Shared</span>
                        <div class="stat-icon-bg">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">10,000+</span>
                        <span class="hero-stat-label">Connections</span>
                        <div class="stat-icon-bg">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                
                
                <img src="images/hero-illustration.svg" alt="SkillSwap Community" class="animate-on-scroll">
                <div class="hero-shape-1"></div>
                <div class="hero-shape-2"></div>
                <div class="hero-shape-3"></div>
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
            <div class="section-icon-wrapper">
                <i class="fas fa-th-large"></i>
            </div>
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
                <div class="category-card-glow"></div>
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
                <div class="category-card-glow"></div>
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
                <div class="category-card-glow"></div>
            </div>
        </div>
        <div class="section-footer">
            <a href="categories.php" class="btn btn-outline-primary btn-glow">
                View All Categories <i class="fas fa-th-large ml-2"></i>
                <span class="btn-outline-glow"></span>
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section bg-gradient" id="how-it-works">
    <div class="container">
        <div class="section-header light">
            <div class="section-icon-wrapper light">
                <i class="fas fa-question-circle"></i>
            </div>
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
    <div class="section-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,202.7C384,203,480,181,576,165.3C672,149,768,139,864,154.7C960,171,1056,213,1152,218.7C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Featured Skills Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-icon-wrapper">
                <i class="fas fa-star"></i>
            </div>
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
                    <a href="skill_detail.php?id=<?php echo $skill['id']; ?>" class="btn btn-primary btn-block">
                        View Details
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="section-footer">
            <a href="skills.php" class="btn btn-outline-primary btn-glow">
                Browse All Skills <i class="fas fa-arrow-right ml-2"></i>
                <span class="btn-outline-glow"></span>
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section bg-pattern">
    <div class="container">
        <div class="section-header">
            <div class="section-icon-wrapper">
                <i class="fas fa-quote-right"></i>
            </div>
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
                        <div class="testimonial-quote-icon">
                            <i class="fas fa-quote-left"></i>
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
                        <div class="testimonial-quote-icon">
                            <i class="fas fa-quote-left"></i>
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
                        <div class="testimonial-quote-icon">
                            <i class="fas fa-quote-left"></i>
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
<section class="section stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card animate-on-scroll" style="--delay: 0.1s">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" style="color: var(--primary);">5K+</div>
                <div class="stat-label">Active Members</div>
                <svg class="stat-wave" viewBox="0 0 100 20">
                    <path d="M0,10 C30,20 70,0 100,10 L100,20 L0,20 Z" fill="rgba(58, 134, 255, 0.1)"></path>
                </svg>
            </div>
            <div class="stat-card animate-on-scroll" style="--delay: 0.2s">
                <div class="stat-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="stat-number" style="color: var(--secondary);">2.5K+</div>
                <div class="stat-label">Skills Shared</div>
                <svg class="stat-wave" viewBox="0 0 100 20">
                    <path d="M0,10 C30,20 70,0 100,10 L100,20 L0,20 Z" fill="rgba(255, 0, 110, 0.1)"></path>
                </svg>
            </div>
            <div class="stat-card animate-on-scroll" style="--delay: 0.3s">
                <div class="stat-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="stat-number" style="color: var(--accent-1);">10K+</div>
                <div class="stat-label">Connections Made</div>
                <svg class="stat-wave" viewBox="0 0 100 20">
                    <path d="M0,10 C30,20 70,0 100,10 L100,20 L0,20 Z" fill="rgba(0, 180, 216, 0.1)"></path>
                </svg>
            </div>
            <div class="stat-card animate-on-scroll" style="--delay: 0.4s">
                <div class="stat-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="stat-number" style="color: var(--accent-2);">50+</div>
                <div class="stat-label">Communities</div>
                <svg class="stat-wave" viewBox="0 0 100 20">
                    <path d="M0,10 C30,20 70,0 100,10 L100,20 L0,20 Z" fill="rgba(114, 9, 183, 0.1)"></path>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-particles"></div>
    <div class="container">
        <div class="cta-content animate-on-scroll">
            <h2 class="cta-title">Ready to Share Your Skills?</h2>
            <p class="cta-text">Join our growing community of skill exchangers and start learning something new today while helping others grow.</p>
            <div class="cta-actions">
                <a href="signup.php" class="btn btn-light btn-lg btn-glow">
                    <i class="fas fa-user-plus mr-2"></i>Join Now - It's Free!
                    <span class="btn-light-glow"></span>
                </a>
                <a href="about.php" class="btn btn-outline-light btn-lg">
                    Learn More About Us
                    <span class="btn-outline-light-glow"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="cta-shape-1"></div>
    <div class="cta-shape-2"></div>
    <div class="cta-shape-3"></div>
</section>

<!-- Newsletter Section -->
<section class="section bg-light">
    <div class="container">
        <div class="newsletter-container animate-on-scroll">
            <div class="newsletter-content">
                <div class="newsletter-icon">
                    <i class="fas fa-envelope"></i>
                </div>
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
    background: linear-gradient(135deg, #e6f0ff 0%, #f0f4ff 50%, #e6f0ff 100%);
    overflow: hidden;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 30%, rgba(58, 134, 255, 0.1) 0%, transparent 8%),
        radial-gradient(circle at 80% 40%, rgba(255, 0, 110, 0.1) 0%, transparent 8%),
        radial-gradient(circle at 40% 70%, rgba(0, 180, 216, 0.1) 0%, transparent 8%),
        radial-gradient(circle at 70% 90%, rgba(114, 9, 183, 0.1) 0%, transparent 8%);
    animation: pulse 15s infinite alternate;
}

@keyframes pulse {
    0% { opacity: 0.5; }
    100% { opacity: 1; }
}

.hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-xl);
    align-items: center;
    position: relative;
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-badge {
    display: inline-block;
    padding: 0.5rem 1.25rem;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.15) 0%, rgba(67, 97, 238, 0.15) 100%);
    color: var(--primary);
    border-radius: var(--radius-full);
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: var(--space-md);
    box-shadow: 0 4px 15px rgba(58, 134, 255, 0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(58, 134, 255, 0.2);

}

@keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 3.75rem);
    line-height: 1.1;
    margin-bottom: var(--space-md);
    position: relative;
}

.gradient-text {
    background: linear-gradient(90deg, var(--primary) 0%, var(--accent-3) 50%, var(--secondary) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
    background-size: 200% auto;
    animation: textShine 3s linear infinite;
}

@keyframes textShine {
    0% { background-position: 0% center; }
    100% { background-position: 200% center; }
}

.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: var(--gray);
    margin-bottom: var(--space-lg);
    max-width: 540px;
    line-height: 1.6;
}

.hero-actions {
    display: flex;
    gap: var(--space-md);
    margin-bottom: var(--space-xl);
    flex-wrap: wrap;
}

.btn-primary {
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(58, 134, 255, 0.3);
}

.btn-primary:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(58, 134, 255, 0.4);
}

.btn-glow {
    position: relative;
    overflow: hidden;
}

.btn-glow::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: rotate(45deg);
    animation: btnGlow 3s linear infinite;
    z-255,255,0.3), transparent);
    transform: rotate(45deg);
    animation: btnGlow 3s linear infinite;
    z-index: 0;
}

@keyframes btnGlow {
    0% { transform: translate(-50%, -50%) rotate(45deg); }
    100% { transform: translate(150%, 150%) rotate(45deg); }
}

.btn-outline-glow {
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    border-radius: inherit;
    background: linear-gradient(90deg, var(--primary) 0%, var(--accent-3) 50%, var(--primary) 100%);
    content: '';
    z-index: -1;
    animation: borderGlow 3s linear infinite;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.btn-outline-primary:hover .btn-outline-glow {
    opacity: 1;
}

@keyframes borderGlow {
    0% { background-position: 0% center; }
    100% { background-position: 200% center; }
}

.btn-light-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.5), transparent);
    transform: translateX(-100%);
    animation: lightGlow 3s infinite;
    z-index: -1;
}

@keyframes lightGlow {
    0% { transform: translateX(-100%); }
    50%, 100% { transform: translateX(100%); }
}

.btn-outline-light-glow {
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    border-radius: inherit;
    background: linear-gradient(90deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.7) 50%, rgba(255,255,255,0.3) 100%);
    content: '';
    z-index: -1;
    animation: borderGlow 3s linear infinite;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.btn-outline-light:hover .btn-outline-light-glow {
    opacity: 1;
}

.hero-stats {
    display: flex;
    gap: var(--space-xl);
    position: relative;
}

.hero-stat {
    display: flex;
    flex-direction: column;
    position: relative;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-md);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.hero-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.stat-icon-bg {
    position: absolute;
    right: 10px;
    bottom: 10px;
    font-size: 2rem;
    opacity: 0.1;
    color: var(--primary);
}

.hero-stat-number {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark);
    position: relative;
    z-index: 1;
}

.hero-stat-label {
    font-size: 0.875rem;
    color: var(--gray);
    position: relative;
    z-index: 1;
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
    filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
    animation: imageFloat 5s ease-in-out infinite;
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
    animation: shapeFloat 8s ease-in-out infinite alternate;
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
    animation: shapeFloat 6s ease-in-out infinite alternate-reverse;
}

.hero-shape-3 {
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(0, 180, 216, 0.15) 0%, rgba(0, 119, 182, 0.15) 100%);
    top: 50px;
    left: -50px;
    z-index: 1;
    animation: shapeFloat 7s ease-in-out infinite alternate;
}

@keyframes shapeFloat {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(20px, 20px) rotate(10deg); }
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
    position: relative;
    overflow: hidden;
}

.section-header {
    text-align: center;
    max-width: 800px;
    margin: 0 auto var(--space-xl);
    position: relative;
}

.section-icon-wrapper {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.1) 0%, rgba(67, 97, 238, 0.1) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-md);
    font-size: 2rem;
    color: var(--primary);
    box-shadow: 0 10px 20px rgba(58, 134, 255, 0.1);
    position: relative;
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
    line-height: 1.6;
}



.section-footer {
    text-align: center;
    margin-top: var(--space-xl);
}

.bg-gradient {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent-3) 100%);
    color: white;
    position: relative;
}

.section-wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
    z-index: 1;
}

.bg-pattern {
    background-color: #f8f9fa;
    background-image: 
        radial-gradient(circle at 10% 10%, rgba(58, 134, 255, 0.05) 0%, transparent 20%),
        radial-gradient(circle at 90% 30%, rgba(255, 0, 110, 0.05) 0%, transparent 20%),
        radial-gradient(circle at 30% 70%, rgba(0, 180, 216, 0.05) 0%, transparent 20%),
        radial-gradient(circle at 80% 90%, rgba(114, 9, 183, 0.05) 0%, transparent 20%);
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
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    z-index: 1;
}

.category-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.category-card-content {
    padding: var(--space-xl);
    position: relative;
    z-index: 2;
}

.category-icon-wrapper {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    background-color: rgba(var(--color), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: var(--space-md);
    transition: all 0.3s ease;
}

.category-card:hover .category-icon-wrapper {
    transform: scale(1.1) rotate(-5deg);
    box-shadow: 0 10px 20px rgba(var(--color), 0.2);
}

.category-icon {
    font-size: 1.75rem;
    color: var(--color);
}

.category-title {
    font-size: 1.5rem;
    margin-bottom: var(--space-sm);
    transition: all 0.3s ease;
}

.category-card:hover .category-title {
    color: var(--primary);
}

.category-description {
    color: var(--gray);
    margin-bottom: var(--space-lg);
    line-height: 1.6;
}

.category-link {
    display: inline-flex;
    align-items: center;
    color: var(--primary);
    font-weight: 600;
    position: relative;
    padding-bottom: 5px;
}

.category-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--primary);
    transition: width 0.3s ease;
}

.category-link i {
    margin-left: var(--space-xs);
    transition: transform 0.3s ease;
}

.category-card:hover .category-link::after {
    width: 100%;
}

.category-card:hover .category-link i {
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
    transition: all 0.3s ease;
}

.category-card:hover .category-card-shape {
    width: 180px;
    height: 180px;
}

.category-card-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(var(--color), 0.05) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
}

.category-card:hover .category-card-glow {
    opacity: 1;
}

/* Steps */
.steps-container {
    position: relative;
    padding: var(--space-md) 0;
    z-index: 2;
}

.step-line {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 2px;
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.1));
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
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent-3) 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    margin-right: var(--space-lg);
    flex-shrink: 0;
    position: relative;
    z-index: 2;
    box-shadow: 0 10px 20px rgba(58, 134, 255, 0.3);
}

.step-content {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: var(--radius-lg);
    padding: var(--space-lg);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    flex: 1;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.step:hover .step-content {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.step-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    background-color: rgba(58, 134, 255, 0.1);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: var(--space-md);
    transition: all 0.3s ease;
}

.step:hover .step-icon {
    transform: scale(1.1) rotate(-5deg);
}

.step-title {
    font-size: 1.5rem;
    margin-bottom: var(--space-sm);
    color: var(--dark);
}

.step-description {
    color: var(--gray-dark);
    margin-bottom: var(--space-md);
    line-height: 1.6;
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
    color: var(--gray-dark);
}

.step-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent-3) 100%);
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
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
}

.skill-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
    border-radius: var(--radius-lg);
}

.skill-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.skill-card:hover::before {
    opacity: 0.05;
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
    transition: transform 0.5s ease;
}

.skill-card:hover .skill-card-image img {
    transform: scale(1.1);
}

.skill-card-badge {
    position: absolute;
    top: var(--space-md);
    right: var(--space-md);
    padding: 0.35rem 1rem;
    border-radius: var(--radius-full);
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
}

.skill-card-body {
    padding: var(--space-lg);
    flex: 1;
    display: flex;
    flex-direction: column;
}

.skill-card-title {
    font-size: 1.25rem;
    margin-bottom: var(--space-sm);
    transition: color 0.3s ease;
}

.skill-card:hover .skill-card-title {
    color: var(--primary);
}

.skill-card-description {
    color: var(--gray);
    margin-bottom: var(--space-md);
    line-height: 1.6;
    flex: 1;
}

.skill-card-user {
    display: flex;
    align-items: center;
    margin-top: auto;
}

.skill-card-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: var(--space-sm);
    border: 2px solid white;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.skill-card:hover .skill-card-avatar {
    transform: scale(1.1);
}

.skill-card-username {
    font-weight: 600;
    color: var(--gray-dark);
}

.skill-card-footer {
    padding: var(--space-md);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.btn-block {
    width: 100%;
    position: relative;
    overflow: hidden;
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
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    z-index: 1;
}

.testimonial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
    border-radius: var(--radius-lg);
}

.testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.testimonial-card:hover::before {
    opacity: 0.05;
}

.testimonial-content {
    margin-bottom: var(--space-lg);
    position: relative;
}

.testimonial-quote-icon {
    position: absolute;
    top: -10px;
    left: -10px;
    font-size: 2rem;
    color: rgba(58, 134, 255, 0.1);
    z-index: -1;
}

.testimonial-rating {
    color: var(--warning);
    margin-bottom: var(--space-md);
    display: flex;
    gap: 2px;
}

.testimonial-text {
    font-style: italic;
    color: var(--gray-dark);
    line-height: 1.7;
    position: relative;
    z-index: 1;
}

.testimonial-author {
    display: flex;
    align-items: center;
}

.testimonial-author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-right: var(--space-md);
    border: 3px solid white;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.testimonial-card:hover .testimonial-author-avatar {
    transform: scale(1.1);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
}

.testimonial-author-name {
    font-size: 1.125rem;
    margin: 0 0 var(--space-xs);
    font-weight: 600;
}

.testimonial-author-title {
    font-size: 0.875rem;
    color: var(--gray);
    margin: 0;
}

/* Stats Section */
.stats-section {
    background-color: #f8f9fa;
    position: relative;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 200px;
    background: linear-gradient(to bottom, white, transparent);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: var(--space-lg);
    position: relative;
    z-index: 2;
}

.stat-card {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-xl);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.1) 0%, rgba(67, 97, 238, 0.1) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-md);
    font-size: 1.75rem;
    color: var(--primary);
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    transform: scale(1.1) rotate(-5deg);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: var(--space-sm);
    background-size: 200% auto;
    background: linear-gradient(90deg, var(--primary) 0%, var(--accent-3) 50%, var(--primary) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
    animation: textShine 3s linear infinite;
}

.stat-label {
    color: var(--gray);
    font-size: 1.125rem;
    font-weight: 500;
}

.stat-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40px;
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

.cta-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 8%),
        radial-gradient(circle at 80% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 8%),
        radial-gradient(circle at 40% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 8%),
        radial-gradient(circle at 70% 90%, rgba(255, 255, 255, 0.1) 0%, transparent 8%);
}

.cta-content {
    text-align: center;
    position: relative;
    z-index: 2;
}

.cta-title {
    font-size: clamp(1.75rem, 3vw, 2.75rem);
    margin-bottom: var(--space-md);
    position: relative;
}

.cta-text {
    font-size: 1.125rem;
    max-width: 600px;
    margin: 0 auto var(--space-xl);
    line-height: 1.6;
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
    animation: shapeFloat 8s ease-in-out infinite alternate;
}

.cta-shape-2 {
    position: absolute;
    bottom: -100px;
    left: -50px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
    animation: shapeFloat 6s ease-in-out infinite alternate-reverse;
}

.cta-shape-3 {
    position: absolute;
    top: 30%;
    right: 20%;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.07);
    animation: shapeFloat 7s ease-in-out infinite alternate;
}

/* Newsletter Section */
.newsletter-container {
    background: linear-gradient(135deg, white 0%, #f8f9fa 100%);
    border-radius: var(--radius-lg);
    padding: var(--space-2xl);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    text-align: center;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(58, 134, 255, 0.1);
}

.newsletter-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.05) 0%, rgba(255, 0, 110, 0.05) 100%);
    z-index: 0;
}

.newsletter-icon {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    background: linear-gradient(135deg, rgba(58, 134, 255, 0.1) 0%, rgba(67, 97, 238, 0.1) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-md);
    font-size: 1.75rem;
    color: var(--primary);
    position: relative;
    z-index: 1;
}

.newsletter-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    margin-bottom: var(--space-md);
    position: relative;
    z-index: 1;
}

.newsletter-text {
    color: var(--gray);
    max-width: 600px;
    margin: 0 auto var(--space-lg);
    position: relative;
    z-index: 1;
    line-height: 1.6;
}

.newsletter-form-large {
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.newsletter-form-group {
    display: flex;
    margin-bottom: var(--space-sm);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    border-radius: var(--radius-md);
    overflow: hidden;
}

.newsletter-input-large {
    flex: 1;
    padding: 1rem 1.5rem;
    border: 1px solid var(--gray-light);
    border-right: none;
    border-radius: var(--radius-md) 0 0 var(--radius-md);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.newsletter-input-large:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: inset 0 0 0 1px var(--primary);
}

.newsletter-button-large {
    padding: 1rem 1.5rem;
    background: linear-gradient(90deg, var(--primary) 0%, var(--accent-3) 100%);
    color: white;
    border: none;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.newsletter-button-large:hover {
    background: linear-gradient(90deg, var(--primary-dark) 0%, var(--accent-3) 100%);
    transform: translateY(-2px);
}

.newsletter-button-large::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: rotate(45deg);
    animation: btnGlow 3s linear infinite;
    z-index: 0;
}

.newsletter-disclaimer {
    font-size: 0.875rem;
    color: var(--gray);
    position: relative;
    z-index: 1;
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
        align-items: center;
        text-align: center;
    }
    
    .step-number {
        margin-right: 0;
        margin-bottom: var(--space-md);
    }
    
    .step-line {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .step-list li {
        padding-left: 0;
        padding-top: 25px;
    }
    
    .step-list li::before {
        left: 50%;
        transform: translateX(-50%);
    }
}

@media (max-width: 767px) {
    .cta-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .newsletter-form-group {
        flex-direction: column;
    }
    
    .newsletter-input-large {
        border-radius: var(--radius-md);
        border-right: 1px solid var(--gray-light);
        margin-bottom: var(--space-sm);
    }
    
    .newsletter-button-large {
        border-radius: var(--radius-md);
        width: 100%;
    }
    
    .floating-elements {
        display: none;
    }
}
</style>

<script>
// Add particles to hero section
document.addEventListener('DOMContentLoaded', function() {


    // Animate elements on scroll
    const animateElements = document.querySelectorAll('.animate-on-scroll');
    
    if (animateElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(element => {
            observer.observe(element);
        });
    }
});
</script>

<?php include 'footer.php'; ?>

