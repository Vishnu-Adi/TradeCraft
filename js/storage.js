// js/storage.js

document.addEventListener('DOMContentLoaded', function() {

    // Function to load and display popular skills
    function loadPopularSkills() {
        const skillsContainer = document.getElementById('popular-skills-container');
        if (!skillsContainer) return; // Exit if container doesn't exist

        let skills = localStorage.getItem('popularSkills');
        if (skills) {
            skills = JSON.parse(skills);
            skillsContainer.innerHTML = ''; // Clear existing content
            skills.forEach(skill => {
                const skillBadge = document.createElement('span');
                skillBadge.className = 'badge bg-primary p-2';
                skillBadge.textContent = skill;
                skillsContainer.appendChild(skillBadge);
            });
        } else {
            // Default skills if none in localStorage
            const defaultSkills = ['Web Development', 'Graphic Design', 'Language Learning', 'Music', 'Photography', 'Cooking', 'Fitness', 'Digital Marketing'];
            localStorage.setItem('popularSkills', JSON.stringify(defaultSkills));
            loadPopularSkills(); // Call again to load from localStorage
        }
    }


    // Function to load and display testimonials
       function loadTestimonials() {
        const testimonialsContainer = document.getElementById('testimonials-container');
        if (!testimonialsContainer) return;

        let testimonials = localStorage.getItem('testimonials');
        if (testimonials) {
            testimonials = JSON.parse(testimonials);
            testimonialsContainer.innerHTML = ''; // Clear existing content
            testimonials.forEach(testimonial => {
                const testimonialCard = document.createElement('div');
                testimonialCard.className = 'col-md-4 mb-4';
                testimonialCard.innerHTML = `
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                ${Array(testimonial.rating).fill('<i class="fas fa-star text-warning"></i>').join('')}
                                ${testimonial.rating < 5 ? Array(5 - Math.floor(testimonial.rating)).fill('<i class="far fa-star text-warning"></i>').join('') : ''}

                            </div>
                            <p class="card-text">"${testimonial.text}"</p>
                            <div class="d-flex align-items-center mt-3">
                                <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">${testimonial.initials}</div>
                                <div class="ms-3">
                                    <h5 class="mb-0">${testimonial.name}</h5>
                                    <small class="text-muted">${testimonial.role}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                testimonialsContainer.appendChild(testimonialCard);
            });
        } else {
             // Default testimonials if none in localStorage
            const defaultTestimonials = [
                { name: 'John Doe', role: 'Graphic Designer', text: 'I learned web development by exchanging my graphic design skills. This platform has been a game-changer for my career.', rating: 5, initials: 'JD' },
                { name: 'Maria Santiago', role: 'Language Teacher', text: "I've been teaching Spanish and learning piano through this platform. The community is so supportive and talented!", rating: 5, initials: 'MS' },
                { name: 'Alex Johnson', role: 'Photographer', text: "As a photographer, I've exchanged photography sessions for cooking lessons. Now I can take great photos AND cook amazing meals!", rating: 4.5, initials: 'AJ' }
            ];
            localStorage.setItem('testimonials', JSON.stringify(defaultTestimonials));
            loadTestimonials();
        }
    }


    // Check for logged-in user
    function checkLoginStatus() {
        const loggedInUsername = localStorage.getItem('loggedInUser');
        const joinFreeNavItem = document.getElementById('join-free-nav-item');
        const loggedInUserNav = document.getElementById('logged-in-user-nav');
        const loggedInUsernameSpan = document.getElementById('logged-in-username');


        if (loggedInUsername) {
            // User is logged in
            joinFreeNavItem.style.display = 'none';
            loggedInUserNav.style.display = 'block';
            loggedInUsernameSpan.textContent = loggedInUsername;
        } else {
            // User is not logged in
            joinFreeNavItem.style.display = 'block';
            loggedInUserNav.style.display = 'none';
        }
    }

    // Initial load
    loadPopularSkills();
    loadTestimonials();
    checkLoginStatus();
});