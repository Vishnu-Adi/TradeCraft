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