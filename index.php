<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-particles"></div>
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-badge">Community Skill Exchange</span>
                <h1 class="hero-title">Exchange Skills,<br> <span class="gradient-text">Grow Together</span></h1>
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
            <a href="skills.php" class="btn btn-outline-primary btn-glow">
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

<!-- Testimonials Section
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
</section> -->

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
<?php include 'css/style.css'; ?>
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

