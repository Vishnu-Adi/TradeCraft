<?php include 'header.php'; ?>

<section class="about-hero">
    <div class="container">
        <div class="about-hero-content">
            <h1 class="about-title">About SkillSwap</h1>
            <p class="about-subtitle">Connecting communities through skill exchange and mutual growth</p>
        </div>
    </div>

</section>

<section class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about-content animate-on-scroll">
                <div class="section-header text-left">
                    <h2 class="section-title">Our Story</h2>
                </div>
                <p class="about-text">Welcome to SkillSwap! Our platform is dedicated to connecting community members to share skills and knowledge, fostering growth and collaboration in a world where learning should be accessible to everyone.</p>
                <p class="about-text">Founded by a group of community enthusiasts in 2020, SkillSwap began as a simple idea to help people connect and learn from each other without financial barriers. What started as a local initiative has grown into a thriving online platform connecting thousands of individuals across the globe.</p>
                <p class="about-text">Our diverse team is passionate about building a platform that makes skill sharing accessible, rewarding, and community-driven. We believe that everyone has something valuable to teach and something new to learn.</p>
            </div>
            <div class="about-image animate-on-scroll" style="--delay: 0.2s">
                <img src="images/about-illustration.svg" alt="About SkillSwap">

            </div>
        </div>
    </div>
</section>

<section class="section bg-light">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Mission & Vision</h2>
        </div>
        
        <div class="mission-vision-grid">
            <div class="mission-card animate-on-scroll">
                <div class="mission-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="mission-title">Our Mission</h3>
                <p class="mission-text">We empower individuals by providing a space where everyone can offer and acquire valuable skills, breaking down barriers to learning and personal development.</p>
                <ul class="mission-list">
                    <li>Connect people with complementary skills</li>
                    <li>Make learning accessible to everyone</li>
                    <li>Foster community growth through knowledge sharing</li>
                    <li>Create meaningful relationships through collaboration</li>
                </ul>
            </div>
            
            <div class="mission-card animate-on-scroll" style="--delay: 0.2s">
                <div class="mission-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="mission-title">Our Vision</h3>
                <p class="mission-text">We envision a community where skills and knowledge flow freely, inspiring continuous growth, innovation, and stronger bonds among members.</p>
                <ul class="mission-list">
                    <li>Create a global network of skill-sharing communities</li>
                    <li>Develop a platform that values all types of skills equally</li>
                    <li>Build a sustainable model for community-driven education</li>
                    <li>Empower individuals to become both teachers and learners</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Values</h2>
            <p class="section-subtitle">The principles that guide everything we do</p>
        </div>
        
        <div class="values-grid">
            <div class="value-card animate-on-scroll" style="--delay: 0.1s">
                <div class="value-icon" style="--color: var(--primary)">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="value-title">Community First</h3>
                <p class="value-text">We believe in the power of community and prioritize creating meaningful connections between people.</p>
            </div>
            
            <div class="value-card animate-on-scroll" style="--delay: 0.2s">
                <div class="value-icon" style="--color: var(--secondary)">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="value-title">Accessible Learning</h3>
                <p class="value-text">We're committed to making learning accessible to everyone, regardless of financial resources.</p>
            </div>
            
            <div class="value-card animate-on-scroll" style="--delay: 0.3s">
                <div class="value-icon" style="--color: var(--accent-1)">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="value-title">Diversity & Inclusion</h3>
                <p class="value-text">We celebrate diverse skills, backgrounds, and perspectives, creating an inclusive environment for all.</p>
            </div>
            
            <div class="value-card animate-on-scroll" style="--delay: 0.4s">
                <div class="value-icon" style="--color: var(--accent-3)">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="value-title">Trust & Safety</h3>
                <p class="value-text">We prioritize creating a safe, trustworthy platform where members can connect with confidence.</p>
            </div>
        </div>
    </div>
</section>



<section class="cta-section">
    <div class="container">
        <div class="cta-content animate-on-scroll">
            <h2 class="cta-title">Join Our Community</h2>
            <p class="cta-text">Become part of our growing community of skill exchangers and start your learning journey today.</p>
            <div class="cta-actions">
                <a href="signup.php" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus mr-2"></i>Sign Up Now
                </a>
                <a href="contact.php" class="btn btn-outline-light btn-lg">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
    <div class="cta-shape-1"></div>
    <div class="cta-shape-2"></div>
</section>

<style>
/* About Page Styles */
.about-hero {
    position: relative;
    padding: var(--space-3xl) 0 var(--space-xl);
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent-3) 100%);
    color: white;
    text-align: center;
    overflow: hidden;
}

.about-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    margin-bottom: var(--space-md);
}

.about-subtitle {
    font-size: clamp(1.125rem, 2vw, 1.5rem);
    max-width: 700px;
    margin: 0 auto;
    opacity: 0.9;
}



.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-2xl);
    align-items: center;
}

.about-content {
    position: relative;
}

.text-left {
    text-align: left;
}

.text-left::after {
    left: 0;
    transform: none;
}

.about-text {
    margin-bottom: var(--space-md);
    color: var(--gray-dark);
    line-height: 1.7;
}

.about-image {
    position: relative;

}

.about-image img {
    position: relative;
    margin-top: 30px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
}


/* Mission & Vision */
.mission-vision-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-xl);
}

.mission-card {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-xl);
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
}

.mission-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.mission-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: rgba(58, 134, 255, 0.1);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: var(--space-md);
}

.mission-title {
    font-size: 1.5rem;
    margin-bottom: var(--space-md);
}

.mission-text {
    color: var(--gray);
    margin-bottom: var(--space-md);
    line-height: 1.6;
}

.mission-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.mission-list li {
    position: relative;
    padding-left: var(--space-lg);
    margin-bottom: var(--space-sm);
    color: var(--gray-dark);
}

.mission-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: var(--primary);
}

/* Values */
.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-lg);
}

.value-card {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-lg);
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
    text-align: center;
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.value-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background-color: rgba(var(--color), 0.1);
    color: var(--color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    margin: 0 auto var(--space-md);
}

.value-title {
    font-size: 1.25rem;
    margin-bottom: var(--space-sm);
}

.value-text {
    color: var(--gray);
    line-height: 1.6;
}

/* Team */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-lg);
}

.team-card {
    background-color: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
}

.team-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.team-image {
    height: 250px;
    overflow: hidden;
}

.team-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-normal);
}

.team-card:hover .team-image img {
    transform: scale(1.05);
}

.team-content {
    padding: var(--space-lg);
    text-align: center;
}

.team-name {
    font-size: 1.25rem;
    margin-bottom: var(--space-xs);
}

.team-role {
    color: var(--primary);
    font-weight: 600;
    margin-bottom: var(--space-sm);
}

.team-bio {
    color: var(--gray);
    margin-bottom: var(--space-md);
    line-height: 1.6;
}

.team-social {
    display: flex;
    justify-content: center;
    gap: var(--space-sm);
}

.team-social-link {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: rgba(58, 134, 255, 0.1);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-normal);
}

.team-social-link:hover {
    background-color: var(--primary);
    color: white;
    transform: translateY(-3px);
}


</style>

<?php include 'footer.php'; ?>




