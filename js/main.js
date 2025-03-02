// JavaScript for Community Skill Exchange Platform

// Function to handle navigation
function navigateTo(page) {
    window.location.href = page;
}

// Function to load dynamic content
function loadContent(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error loading content:', error));
}

// Example function to initialize tooltips
function initializeTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}


// Call initializeTooltips on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeTooltips();
});
// JavaScript for Community Skill Exchange Platform

// Wait for DOM content to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    initializeTooltips();
    
    // Initialize any login forms
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateLoginForm()) {
                // For demo purposes, check if using the dummy credentials
                const email = document.getElementById('login-email').value;
                const password = document.getElementById('login-password').value;
                
                if (email === 'demo@example.com' && password === 'password123') {
                    // Redirect to dashboard on successful login
                    window.location.href = 'dashboard.html';
                } else {
                    document.getElementById('login-error').innerText = 'Invalid credentials. Try demo@example.com / password123';
                }
            }
        });
    }
    
    // Initialize any registration forms
    const registrationForm = document.getElementById('registrationForm');
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateRegistrationForm()) {
                // Show success message and redirect
                const successMsg = document.createElement('div');
                successMsg.className = 'alert alert-success';
                successMsg.innerText = 'Registration successful! Redirecting to login...';
                registrationForm.prepend(successMsg);
                
                // Redirect after a short delay
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 2000);
            }
        });
    }
    
    // Handle search functionality
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const skillCards = document.querySelectorAll('.skill-card');
            
            skillCards.forEach(card => {
                const skillName = card.querySelector('.card-title').innerText.toLowerCase();
                const skillDesc = card.querySelector('.card-text').innerText.toLowerCase();
                
                if (skillName.includes(searchTerm) || skillDesc.includes(searchTerm)) {
                    card.parentElement.style.display = 'block';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    }
    
    // Add animation to elements when they come into view
    animateOnScroll();
});

// Function to initialize Bootstrap tooltips
function initializeTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    if (tooltipTriggerList.length > 0) {
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    }
}

// Function to animate elements when they scroll into view
function animateOnScroll() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, {
        threshold: 0.1
    });
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// Function for mobile navigation
function toggleMobileMenu() {
    const navbarCollapse = document.getElementById('navbarNav');
    if (navbarCollapse.classList.contains('show')) {
        navbarCollapse.classList.remove('show');
    } else {
        navbarCollapse.classList.add('show');
    }
}

// Function to show custom toast notifications
function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(container);
    }
    
    const toastId = 'toast-' + Date.now();
    const toastHtml = `
        <div id="${toastId}" class="toast align-items-center text-white bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    
    document.getElementById('toast-container').innerHTML += toastHtml;
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
    
    // Auto-remove the toast element after it's hidden
    toastElement.addEventListener('hidden.bs.toast', function () {
        toastElement.remove();
    });
}