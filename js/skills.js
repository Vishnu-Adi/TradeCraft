// js/skills.js
(function() {
    if(!document.getElementById('skills-page')) return;
    // Function to load and display skills
    function loadSkills() {
        const skillsList = document.getElementById('skills-list');
        if (!skillsList) return;

        let skills = localStorage.getItem('skills');
        skills = skills ? JSON.parse(skills) : [];
        //add default skills
        if(skills.length === 0){
            skills = addDefaultSkills()
        }

        skillsList.innerHTML = ''; // Clear existing content

        skills.forEach(skill => {
            const skillCard = createSkillCardElement(skill);
            skillsList.appendChild(skillCard);
        });

    }

    // Function to add default skills
    function addDefaultSkills(){
        const defaultSkills = [
            {
                id: 1,
                category: "technology",
                level: "Expert",
                rating: 4.8,
                title: "Web Development",
                description: "Full-stack web development with modern technologies like React, Node.js, and MongoDB.",
                user: "Michael Chen",
                userInitial: "MC",
                role: "Software Engineer",
                tags: ["JavaScript", "React"]
            },
            {
                id: 2,
                category: "technology",
                level: "Intermediate",
                rating: 4.0,
                title: "Digital Marketing",
                description: "SEO, content marketing, social media strategies, and Google Analytics expertise.",
                user: "Sarah Rodriguez",
                userInitial: "SR",
                role: "Marketing Consultant",
                tags: ["SEO", "Social Media"]
            },
            {
                id: 3,
                category: "arts",
                level: "Expert",
                rating: 5.0,
                title: "Photography",
                description: "Portrait and landscape photography with advanced editing techniques.",
                user: "Alex Johnson",
                userInitial: "AJ",
                role: "Professional Photographer",
                tags: ["Photoshop", "Lightroom"]
            },
            {
                id: 4,
                category: "language",
                level: "Native",
                rating: 4.7,
                title: "Spanish Language",
                description: "Native Spanish speaker offering conversational practice and grammar lessons.",
                user: "Isabella Garcia",
                userInitial: "IG",
                role: "Language Teacher",
                tags: ["Conversation", "Grammar"]
            },
            {
                id: 5,
                category: "music",
                level: "Advanced",
                rating: 4.2,
                title: "Piano Lessons",
                description: "Classical piano instruction for beginners to intermediate players.",
                user: "David Wilson",
                userInitial: "DW",
                role: "Music Instructor",
                tags: ["Classical", "Theory"]
            },
            {
                id: 6,
                category: "cooking",
                level: "Advanced",
                rating: 4.9,
                title: "Baking & Pastry",
                description: "French pastry techniques, bread making, and decorative cake design.",
                user: "Emma Lewis",
                userInitial: "EL",
                role: "Pastry Chef",
                tags: ["Pastry", "Bread"]
            }

        ];
        localStorage.setItem('skills', JSON.stringify(defaultSkills));
        return defaultSkills;
    }

    // Function to create a skill card element
    function createSkillCardElement(skill) {
        const cardCol = document.createElement('div');
        cardCol.className = 'col-md-4 col-sm-6 mb-4';
        cardCol.setAttribute('data-category', skill.category);

        const card = document.createElement('div');
        card.className = 'card skill-card h-100';

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        cardBody.innerHTML = `
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="skill-level level-${getLevelClass(skill.level)}">${skill.level}</span>
                <div class="text-warning">
                ${Array(Math.floor(skill.rating)).fill('<i class="fas fa-star"></i>').join('')}
                    ${skill.rating - Math.floor(skill.rating) >= 0.5 ? '<i class="fas fa-star-half-alt"></i>' : ''}
                    ${Array(5 - Math.ceil(skill.rating)).fill('<i class="far fa-star"></i>').join('')}
                    <span class="ms-1 text-muted small">${skill.rating.toFixed(1)}</span>
                </div>
            </div>
            <h5 class="card-title">${skill.title}</h5>
            <p class="card-text">${skill.description}</p>
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">${skill.userInitial}</div>
                <div>
                    <p class="mb-0 fw-medium">${skill.user}</p>
                    <small class="text-muted">${skill.role}</small>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    ${skill.tags.map(tag => `<span class="badge bg-light text-dark me-1">${tag}</span>`).join('')}
                </div>
                <a href="exchange.html" class="btn btn-sm btn-primary">Request Exchange</a>
            </div>
        `;

        card.appendChild(cardBody);
        cardCol.appendChild(card);
        return cardCol;
    }

    function getLevelClass(level) {
        switch (level.toLowerCase()) {
            case 'expert': return 'expert';
            case 'advanced': return 'intermediate';  // Assuming 'advanced' maps to your CSS
            case 'intermediate': return 'intermediate';
            case 'beginner': return 'beginner';
            case 'native': return 'expert';
            default: return 'beginner'; // Default class
        }
    }

     // Function to filter skills based on category
     function filterSkills() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const skillItems = document.querySelectorAll('#skills-list > div');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove 'active' class from all buttons, then add to clicked
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                skillItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }

        // Function to set up search functionality
    function setupSearch() {
        const searchInput = document.getElementById('search');
        const skillItems = document.querySelectorAll('#skills-list > div'); // Select direct children

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                skillItems.forEach(item => {
                    const title = item.querySelector('.card-title') ? item.querySelector('.card-title').textContent.toLowerCase() : '';
                    const description = item.querySelector('.card-text') ? item.querySelector('.card-text').textContent.toLowerCase() : '';

                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        item.style.display = 'block'; // or 'flex', depending on layout
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    }


    // Load skills and set up event listeners when the DOM is ready
    loadSkills();
    filterSkills();
    setupSearch();
})();