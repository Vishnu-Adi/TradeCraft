<?php include 'header.php'; ?>

<section class="faq-hero">
    <div class="container">
        <div class="faq-hero-content">
            <h1 class="faq-title">Frequently Asked Questions</h1>
            <p class="faq-subtitle">Find answers to common questions about SkillSwap</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-container">
            <div class="accordion" id="faqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How do I sign up for the platform?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Simply click the "Sign Up" button in the navigation bar and fill in the registration form. You'll need to provide your name, email address, and create a password. Once you've completed the form, you'll receive a verification email to confirm your account.
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Is the platform free to use?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, our platform is completely free to use for all community members. We believe in making skill sharing accessible to everyone without financial barriers. While we may introduce premium features in the future, the core functionality of connecting with others and exchanging skills will always remain free.
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How can I contact support?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            You can contact support by emailing <a href="mailto:support@skillxchange.com">support@skillxchange.com</a> or using our <a href="contact.php">Contact page</a>. Our support team is available Monday through Friday, 9 AM to 5 PM EST, and typically responds within 24 hours.
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            How does the skill exchange process work?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>The skill exchange process is simple:</p>
                            <ol>
                                <li>Browse skills that interest you or respond to requests for skills you can teach</li>
                                <li>Contact the member through our messaging system to discuss details</li>
                                <li>Agree on the terms of the exchange (time, location, duration, etc.)</li>
                                <li>Meet up (virtually or in-person) to exchange skills</li>
                                <li>After the exchange, leave feedback for each other</li>
                            </ol>
                            <p>You can exchange skills directly (I teach you cooking, you teach me photography) or use our credit system where you earn credits by teaching and spend them on learning.</p>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Item 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Is my personal information secure?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Yes, we take data privacy seriously and protect your information in several ways:</p>
                            <ul>
                                <li>We use encryption to secure your personal data</li>
                                <li>We never share your contact information without your permission</li>
                                <li>You control what information is visible on your public profile</li>
                                <li>We have strict data retention policies</li>
                                <li>We comply with all relevant data protection regulations</li>
                            </ul>
                            <p>For more details, please review our <a href="privacy.php">Privacy Policy</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-light">
    <div class="container">
        <div class="contact-help">
            <div class="contact-help-content">
                <h2>Still have questions?</h2>
                <p>If you couldn't find the answer to your question, our support team is here to help.</p>
                <a href="contact.php" class="btn btn-primary">Contact Support</a>
            </div>
            <div class="contact-help-image">
                <img src="images/support-illustration.svg" alt="Contact Support">
            </div>
        </div>
    </div>
</section>

<style>
/* FAQ Page Styles */
.faq-hero {
    background: linear-gradient(135deg, var(--accent-1) 0%, var(--primary) 100%);
    color: white;
    text-align: center;
    padding: var(--space-2xl) 0;
    margin-bottom: var(--space-2xl);
}

.faq-title {
    font-size: clamp(2rem, 5vw, 3rem);
    margin-bottom: var(--space-md);
}

.faq-subtitle {
    font-size: 1.125rem;
    max-width: 700px;
    margin: 0 auto;
    opacity: 0.9;
}

.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.accordion-item {
    margin-bottom: var(--space-md);
    border: none;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    background-color: white;
}

.accordion-button {
    padding: var(--space-lg);
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--dark);
    background-color: white;
    box-shadow: none;
    border: none;
}

.accordion-button:not(.collapsed) {
    color: var(--primary);
    background-color: rgba(58, 134, 255, 0.05);
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
}

.accordion-button::after {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%233a86ff' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
    transition: transform 0.2s ease-in-out;
}

.accordion-button:not(.collapsed)::after {
    transform: rotate(-180deg);
}

.accordion-body {
    padding: 0 var(--space-lg) var(--space-lg);
    color: var(--gray);
    line-height: 1.7;
}

.accordion-body p {
    margin-bottom: var(--space-md);
}

.accordion-body ul,
.accordion-body ol {
    margin-bottom: var(--space-md);
    padding-left: var(--space-xl);
}

.accordion-body li {
    margin-bottom: var(--space-xs);
}

.accordion-body a {
    color: var(--primary);
    font-weight: 500;
}

.contact-help {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-xl);
    align-items: center;
    background-color: white;
    border-radius: var(--radius-lg);
    padding: var(--space-xl);
    box-shadow: var(--shadow-md);
}

.contact-help-content h2 {
    font-size: 1.75rem;
    margin-bottom: var(--space-md);
}

.contact-help-content p {
    color: var(--gray);
    margin-bottom: var(--space-lg);
}

.contact-help-image img {
    max-width: 100%;
    height: auto;
}

@media (max-width: 768px) {
    .contact-help {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .contact-help-image {
        order: -1;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Accordion functionality
    const accordionButtons = document.querySelectorAll('.accordion-button');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            
            if (this.classList.contains('collapsed')) {
                // Close all other accordion items
                document.querySelectorAll('.accordion-collapse.show').forEach(item => {
                    if (item !== target) {
                        item.classList.remove('show');
                        document.querySelector(`[data-bs-target="#${item.id}"]`).classList.add('collapsed');
                    }
                });
                
                // Open this accordion item
                this.classList.remove('collapsed');
                target.classList.add('show');
            } else {
                // Close this accordion item
                this.classList.add('collapsed');
                target.classList.remove('show');
            }
        });
    });
});
</script>

<?php include 'footer.php'; ?>

