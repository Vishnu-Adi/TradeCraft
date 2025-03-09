<?php include 'header.php'; ?>

<section class="auth-section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-image">
                <div class="auth-image-content">
                    <h2>Join Our Community</h2>
                    <p>Create an account to start sharing your skills and learning from others.</p>
                    <div class="auth-features">
                        <div class="auth-feature">
                            <i class="fas fa-users"></i>
                            <span>Join a community of 5,000+ members</span>
                        </div>
                        <div class="auth-feature">
                            <i class="fas fa-lightbulb"></i>
                            <span>Discover new skills and talents</span>
                        </div>
                        <div class="auth-feature">
                            <i class="fas fa-handshake"></i>
                            <span>Make meaningful connections</span>
                        </div>
                    </div>
                </div>
                <div class="auth-image-shape-1"></div>
                <div class="auth-image-shape-2"></div>
            </div>
            
            <div class="auth-form-container">
                <div class="auth-form-header">
                    <h1>Sign Up</h1>
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
                
                <form action="signup_process.php" method="post" id="signupForm" class="auth-form">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" placeholder="Enter a password" required>
                            <button type="button" class="password-toggle" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-meter">
                                <div class="strength-meter-fill" data-strength="0"></div>
                            </div>
                            <div class="strength-text">Password strength: <span>Weak</span></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="terms-checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the <a href="terms.php">Terms of Service</a> and <a href="privacy.php">Privacy Policy</a></label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                    
                    <div class="social-login">
                        <p>Or sign up with</p>
                        <div class="social-login-buttons">
                            <button type="button" class="social-login-btn google">
                                <i class="fab fa-google"></i>
                                <span>Google</span>
                            </button>
                            <button type="button" class="social-login-btn facebook">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
/* Auth Section Styles */
.auth-section {
    padding: var(--space-3xl) 0;
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
}

.auth-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    background-color: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    max-width: 1000px;
    margin: 0 auto;
}

.auth-image {
    background: linear-gradient(135deg, var(--secondary) 0%, var(--accent-2) 100%);
    color: white;
    padding: var(--space-2xl);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.auth-image-content {
    position: relative;
    z-index: 2;
}

.auth-image h2 {
    font-size: 2rem;
    margin-bottom: var(--space-md);
    color: white;
}

.auth-image p {
    font-size: 1rem;
    margin-bottom: var(--space-xl);
    opacity: 0.9;
}

.auth-features {
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
}

.auth-feature {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.auth-feature i {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-image-shape-1 {
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.auth-image-shape-2 {
    position: absolute;
    bottom: -80px;
    left: -50px;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
}

.auth-form-container {
    padding: var(--space-2xl);
}

.auth-form-header {
    margin-bottom: var(--space-xl);
}

.auth-form-header h1 {
    font-size: 2rem;
    margin-bottom: var(--space-xs);
}

.auth-form-header p {
    color: var(--gray);
}

.auth-form-header a {
    color: var(--primary);
    font-weight: 500;
}

.auth-form {
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

.auth-form input[type="email"],
.auth-form input[type="password"],
.auth-form input[type="text"] {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--gray-light);
    border-radius: var(--radius-md);
    font-size: 1rem;
    transition: all var(--transition-fast);
}

.auth-form input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.15);
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray);
    cursor: pointer;
    padding: 0;
}

.password-strength {
    margin-top: var(--space-xs);
}

.strength-meter {
    height: 4px;
    background-color: var(--gray-light);
    border-radius: var(--radius-full);
    overflow: hidden;
}

.strength-meter-fill {
    height: 100%;
    border-radius: var(--radius-full);
    transition: all var(--transition-fast);
}

.strength-meter-fill[data-strength="0"] {
    width: 25%;
    background-color: var(--danger);
}

.strength-meter-fill[data-strength="1"] {
    width: 50%;
    background-color: var(--warning);
}

.strength-meter-fill[data-strength="2"] {
    width: 75%;
    background-color: var(--info);
}

.strength-meter-fill[data-strength="3"] {
    width: 100%;
    background-color: var(--success);
}

.strength-text {
    font-size: 0.75rem;
    color: var(--gray);
    margin-top: var(--space-xs);
}

.terms-checkbox {
    display: flex;
    align-items: flex-start;
    gap: var(--space-xs);
}

.terms-checkbox input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin-top: 3px;
    accent-color: var(--primary);
}

.terms-checkbox label {
    font-size: 0.875rem;
    color: var(--gray);
}

.terms-checkbox a {
    color: var(--primary);
    font-weight: 500;
}

.social-login {
    text-align: center;
    margin-top: var(--space-lg);
}

.social-login p {
    color: var(--gray);
    margin-bottom: var(--space-md);
    position: relative;
}

.social-login p::before,
.social-login p::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 30%;
    height: 1px;
    background-color: var(--gray-light);
}

.social-login p::before {
    left: 0;
}

.social-login p::after {
    right: 0;
}

.social-login-buttons {
    display: flex;
    gap: var(--space-md);
}

.social-login-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-sm);
    padding: 0.75rem;
    border-radius: var(--radius-md);
    border: 1px solid var(--gray-light);
    background-color: white;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.social-login-btn:hover {
    background-color: var(--gray-light);
}

.social-login-btn.google i {
    color: #DB4437;
}

.social-login-btn.facebook i {
    color: #4267B2;
}

@media (max-width: 991px) {
    .auth-container {
        grid-template-columns: 1fr;
    }
    
    .auth-image {
        display: none;
    }
}

@media (max-width: 576px) {
    .auth-form-container {
        padding: var(--space-lg);
    }
    
    .social-login-buttons {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const passwordInput = this.closest('.input-icon-wrapper').querySelector('input');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
    
    // Password strength meter
    const passwordInput = document.getElementById('password');
    const strengthMeter = document.querySelector('.strength-meter-fill');
    const strengthText = document.querySelector('.strength-text span');
    
    if (passwordInput && strengthMeter && strengthText) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Check password length
            if (password.length >= 8) {
                strength += 1;
            }
            
            // Check for mixed case
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
                strength += 1;
            }
            
            // Check for numbers
            if (password.match(/\d/)) {
                strength += 1;
            }
            
            // Check for special characters
            if (password.match(/[^a-zA-Z\d]/)) {
                strength += 1;
            }
            
            // Update strength meter
            strengthMeter.setAttribute('data-strength', Math.min(3, strength));
            
            // Update text
            const strengthLabels = ['Weak', 'Fair', 'Good', 'Strong'];
            strengthText.textContent = strengthLabels[Math.min(3, strength)];
        });
    }
    
    // Form validation
    const signupForm = document.getElementById('signupForm');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    
    if (signupForm && passwordInput && confirmPasswordInput) {
        signupForm.addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                confirmPasswordInput.focus();
            }
        });
    }
});
</script>

<?php include 'footer.php'; ?>

