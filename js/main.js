// js/main.js

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

// Wait for DOM content to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    initializeTooltips();
    animateOnScroll();
});