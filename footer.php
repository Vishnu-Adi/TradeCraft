<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3><i class="fas fa-sync-alt mr-2"></i> SkillSwap</h3>
                <p>Connect with talented individuals in your community to share knowledge, learn new skills, and grow together through mutual exchange.</p>
                <div class="social-links">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            <div class="footer-nav">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="skills.php">Skills</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-nav">
                <h5>Help & Support</h5>
                <ul class="footer-links">
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="terms.php">Terms of Service</a></li>
                    <li><a href="privacy.php">Privacy Policy</a></li>
                    <li><a href="support.php">Support Center</a></li>
                </ul>
            </div>
            
            <div class="footer-newsletter">
                <h5>Subscribe to Our Newsletter</h5>
                <p>Get the latest updates on new skills and community events.</p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Your email address" required>
                    <button type="submit" class="newsletter-btn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-flex">
                <p class="copyright">© <?php echo date('Y'); ?> SkillSwap Community Exchange. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="privacy.php">Privacy</a>
                    <a href="terms.php">Terms</a>
                    <a href="admin/login.php">Admin</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Navigation Toggle
        const navbarToggler = document.getElementById('navbarToggler');
        const navbarClose = document.getElementById('navbarClose');
        const navbarContent = document.getElementById('navbarContent');
        const navbarOverlay = document.getElementById('navbarOverlay');
        
        if (navbarToggler && navbarContent && navbarOverlay && navbarClose) {
            navbarToggler.addEventListener('click', function() {
                navbarContent.classList.add('show');
                navbarOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
            
            navbarClose.addEventListener('click', function() {
                navbarContent.classList.remove('show');
                navbarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            });
            
            navbarOverlay.addEventListener('click', function() {
                navbarContent.classList.remove('show');
                navbarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            });
        }
        
        // User Dropdown Toggle
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        if (userDropdownToggle && userDropdown) {
            userDropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('active');
            });
            
            document.addEventListener('click', function(e) {
                if (!userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('active');
                }
            });
        }
        
        // Header Scroll Effect
        const header = document.querySelector('.header');
        
        if (header) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        }
        
        // Animation on Scroll
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
        
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }, 5000);
            
            const closeBtn = alert.querySelector('.btn-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 300);
                });
            }
        });
    });
</script>
</body>
</html>

