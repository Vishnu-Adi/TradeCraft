<?php include 'header.php'; ?>

<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content">
            <h1 class="contact-title">Contact Us</h1>
            <p class="contact-subtitle">We'd love to hear from you! Reach out with any questions, suggestions, or feedback.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-form-container">
                <div class="contact-form-header">
                    <h2>Send Us a Message</h2>
                    <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                </div>
                
                <form action="contact_process.php" method="post" class="contact-form">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-tag input-icon"></i>
                            <input type="text" id="subject" name="subject" placeholder="Subject of your message" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <div class="input-icon-wrapper textarea-wrapper">
                            <i class="fas fa-comment input-icon textarea-icon"></i>
                            <textarea id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>
            
            <div class="contact-info">
                <div class="contact-info-header">
                    <h2>Contact Information</h2>
                    <p>Here are the different ways you can reach us</p>
                </div>
                
                <div class="contact-info-items">
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3>Email Us</h3>
                            <p><a href="mailto:support@skillxchange.com">support@skillxchange.com</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3>Call Us</h3>
                            <p><a href="tel:+15551234567">+1 (555) 123-4567</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3>Visit Us</h3>
                            <p>123 Community Lane, Skill City, Country</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3>Office Hours</h3>
                            <p>Monday - Friday: 9AM - 5PM<br>Saturday - Sunday: Closed</p>
                        </div>
                    </div>
                </div>
                
                <div class="social-connect">
                    <h3>Connect With Us</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-light">
    <div class="container">
        <div class="map-container">
            <h2 class="text-center mb-4">Find Us On The Map</h2>
            <div class="map-frame">
                <!-- Replace with actual Google Maps embed code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s123%20Community%20St%2C%20New%20York%2C%20NY%2010001%2C%20USA!5e0!3m2!1sen!2sus!4v1615996579774!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<style>
/* Contact Page Styles */
.contact-hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent-3) 100%);
    color: white;
    text-align: center;
    padding: var(--space-2xl) 0;
    margin-bottom: var(--space-2xl);
}

.contact-title {
    font-size: clamp(2rem, 5vw, 3rem);
    margin-bottom: var(--space-md);
}

.contact-subtitle {
    font-size: 1.125rem;
    max-width: 700px;
    margin: 0 auto;
    opacity: 0.9;
}

.contact-grid {
    display: grid;
    grid-template-columns: 3fr 2fr;
    gap: var(--space-2xl);
}

.contact-form-container {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-xl);
    box-shadow: var(--shadow-md);
}

.contact-form-header {
    margin-bottom: var(--space-xl);
}

.contact-form-header h2 {
    font-size: 1.75rem;
    margin-bottom: var(--space-sm);
}

.contact-form-header p {
    color: var(--gray);
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: var(--space-lg);
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-xs);
}

.form-group label {
    font-weight: 500;
    color: var(--dark);
}

.input-icon-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray);
}

.textarea-icon {
    top: 1.5rem;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--gray-light);
    border-radius: var(--radius-md);
    font-size: 1rem;
    transition: all var(--transition-fast);
}

.contact-form textarea {
    resize: vertical;
    min-height: 120px;
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);
}

.btn-block {
    width: 100%;
}

.contact-info {
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-xl);
    box-shadow: var(--shadow-md);
}

.contact-info-header {
    margin-bottom: var(--space-xl);
}

.contact-info-header h2 {
    font-size: 1.75rem;
    margin-bottom: var(--space-sm);
}

.contact-info-header p {
    color: var(--gray);
}

.contact-info-items {
    display: flex;
    flex-direction: column;
    gap: var(--space-lg);
    margin-bottom: var(--space-xl);
}

.contact-info-item {
    display: flex;
    align-items: flex-start;
    gap: var(--space-md);
}

.contact-info-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: rgba(58, 134, 255, 0.1);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.contact-info-content h3 {
    font-size: 1.125rem;
    margin-bottom: var(--space-xs);
}

.contact-info-content p {
    color: var(--gray);
    line-height: 1.6;
}

.contact-info-content a {
    color: var(--primary);
    text-decoration: none;
}

.contact-info-content a:hover {
    text-decoration: underline;
}

.social-connect {
    margin-top: var(--space-xl);
}

.social-connect h3 {
    font-size: 1.125rem;
    margin-bottom: var(--space-md);
}

.social-icons {
    display: flex;
    gap: var(--space-md);
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(58, 134, 255, 0.1);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-normal);
}

.social-icon:hover {
    background-color: var(--primary);
    color: white;
    transform: translateY(-3px);
}

.map-container {
    max-width: 1000px;
    margin: 0 auto;
}

.map-frame {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

@media (max-width: 991px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
    
    .contact-info {
        order: -1;
    }
}

@media (max-width: 576px) {
    .contact-info-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .social-icons {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            let valid = true;
            const inputs = contactForm.querySelectorAll('input, textarea');
            
            inputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    valid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
                
                if (input.type === 'email' && input.value.trim()) {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(input.value.trim())) {
                        valid = false;
                        input.classList.add('error');
                    }
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Please fill in all required fields correctly.');
            }
        });
    }
});
</script>

<?php include 'footer.php'; ?>

