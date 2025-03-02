/Users/vishnuadithya/Documents/Projects/php/community-skill-exchange/js/profile.js
// js/profile.js
(function() {
    if(!document.getElementById('profile-page')) return; //only run in profile page
    const userModule = window.userModule; // Access the userModule

    // Function to populate the profile page with user data.
    function populateProfilePage() {
        const user = userModule.getLoggedInUserData(); // Use the imported function
        if (!user) {
            window.location.href = 'login.html'; // Redirect to login
            return;
        }

        // Update navbar (moved here for consistency)
        const navProfileImage = document.getElementById('nav-profile-image');
        const navUsername = document.getElementById('nav-username');
        if (navProfileImage) navProfileImage.src = user.profileImage;
        if (navUsername) navUsername.textContent = user.username;


        //profile page
        const profileImageContainer = document.getElementById('profile-image-container');
        profileImageContainer.innerHTML = '';

        const profileImage = document.createElement('img');
        profileImage.src = user.profileImage;
        profileImage.className = 'rounded-circle border border-3 border-white';
        profileImage.width = 100;
        profileImage.height = 100;
        profileImage.alt = `${user.firstname} ${user.lastname}`;
        profileImageContainer.appendChild(profileImage);

        const changePhotoButton = document.createElement('button');
        changePhotoButton.className = 'btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle p-1';
        changePhotoButton.title = 'Change photo';
        changePhotoButton.innerHTML = '<i class="fas fa-camera"></i>';
        profileImageContainer.appendChild(changePhotoButton);

        document.getElementById('profile-name').textContent = `${user.firstname} ${user.lastname}`;
        document.getElementById('profile-role').textContent = user.role;
        document.getElementById('profile-about').textContent = user.about;
        document.getElementById('profile-location').textContent = user.location;
        document.getElementById('profile-email').textContent = user.email;
        const websiteLink = document.getElementById('profile-website');

        if (user.website) {
            websiteLink.href = user.website.startsWith('http') ? user.website : `http://${user.website}`;
            websiteLink.textContent = user.website;
        } else {
            websiteLink.href = '#';
            websiteLink.textContent = 'Your Website';
        }

        document.getElementById('profile-member-since').textContent = `Member since ${user.memberSince}`;

        document.getElementById('profile-skills-count').textContent = user.skills.length;
        document.getElementById('profile-exchanges-count').textContent = user.exchanges;
        document.getElementById('profile-rating').textContent = calculateAverageRating(user.reviews).toFixed(1);
        updateRatingStars('profile-rating-stars', calculateAverageRating(user.reviews));
        populateSkillsTab(user.skills);
        populatePortfolioTab(user.portfolio);
        populateReviewsTab(user.reviews);

    }


    function calculateAverageRating(reviews) {
        if (!reviews || reviews.length === 0)  return 0;
        const totalRating = reviews.reduce((sum, review) => sum + review.rating, 0);
        return totalRating / reviews.length;
    }

  function updateRatingStars(containerId, averageRating) {
        const container = document.getElementById(containerId);
        if (!container) return;

        container.innerHTML = ''; // Clear existing stars

        const fullStars = Math.floor(averageRating);
        const halfStar = averageRating - fullStars >= 0.5;

        // Add full stars
        for (let i = 0; i < fullStars; i++) {
            container.innerHTML += '<i class="fas fa-star fa-xs text-warning"></i>';
        }

        // Add half star if needed
        if (halfStar) {
            container.innerHTML += '<i class="fas fa-star-half-alt fa-xs text-warning"></i>';
        }

        // Fill remaining with empty stars
        const remainingStars = 5 - fullStars - (halfStar ? 1 : 0);
        for (let i = 0; i < remainingStars; i++) {
            container.innerHTML += '<i class="far fa-star fa-xs text-warning"></i>'; // Use far (regular) for empty stars
        }
    }
    function showEditProfileForm() {
        const user = userModule.getLoggedInUserData(); // Use imported function
        if (!user) return;

        document.getElementById('edit-name').value = `${user.firstname} ${user.lastname}`;
        document.getElementById('edit-role').value = user.role;
        document.getElementById('edit-about').value = user.about;
        document.getElementById('edit-location').value = user.location;
        document.getElementById('edit-email').value = user.email;
        document.getElementById('edit-website').value = user.website;
         document.getElementById('edit-profile-image').value = user.profileImage || '';

        document.getElementById('profile-details').style.display = 'none';
        document.getElementById('profile-action-buttons').style.display = 'none';
        document.getElementById('edit-profile-form').style.display = 'block';
    }

    function hideEditProfileForm() {
        document.getElementById('edit-profile-form').style.display = 'none';
        document.getElementById('profile-details').style.display = 'block';
        document.getElementById('profile-action-buttons').style.display = 'flex';
    }
    function saveProfileChanges() {
        const user = userModule.getLoggedInUserData(); // Use imported function
        if (!user) return;

        const [firstname, lastname] = document.getElementById('edit-name').value.trim().split(' ', 2);
        user.firstname = firstname;
        user.lastname = lastname || '';
        user.role = document.getElementById('edit-role').value.trim();
        user.about = document.getElementById('edit-about').value.trim();
        user.location = document.getElementById('edit-location').value.trim();
        user.email = document.getElementById('edit-email').value.trim();
        user.website = document.getElementById('edit-website').value.trim();
         user.profileImage = document.getElementById('edit-profile-image').value.trim();

        let users = localStorage.getItem('users');
        users = users ? JSON.parse(users) : [];

        const userIndex = users.findIndex(u => u.username === user.username);
        if (userIndex !== -1) {
            users[userIndex] = userModule.addDefaultProfileData(user); // Use imported function.
            localStorage.setItem('users', JSON.stringify(users));
            localStorage.setItem('loggedInUser', users[userIndex].username); // Update loggedInUser
        }

        populateProfilePage();
        hideEditProfileForm();
    }
//----------Skills Tab-------------------------------
     function populateSkillsTab(skills) {
        const skillsContainer = document.getElementById('skills-container');
        const learningSkillsContainer = document.getElementById('learning-skills-container');
        if (!skillsContainer || !learningSkillsContainer) return;

        skillsContainer.innerHTML = ''; // Clear existing content
        learningSkillsContainer.innerHTML = '';

        if (skills && skills.length > 0) {
            skills.filter(skill => skill.type === 'share').forEach(skill => {
                const skillCard = createSkillCard(skill);
                skillsContainer.appendChild(skillCard);
            });

            skills.filter(skill => skill.type === 'learn').forEach(skill => {
                const skillBadge = document.createElement('span');
                skillBadge.className = 'badge bg-light text-dark p-2';
                skillBadge.innerHTML = `<i class="fas fa-plus-circle text-primary me-1"></i> ${skill.name}`;
                learningSkillsContainer.appendChild(skillBadge);
            });
        } else {
            skillsContainer.innerHTML = '<p>No skills to share yet.</p>';
            learningSkillsContainer.innerHTML = '<p>No skills to learn selected.</p>';
        }
    }
    // Function to create a skill card element
    function createSkillCard(skill) {
        const cardCol = document.createElement('div');
        cardCol.className = 'col-md-6 mb-3';

        const card = document.createElement('div');
        card.className = 'card h-100';

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        cardBody.innerHTML = `
            <div class="d-flex justify-content-between">
                <h6 class="card-title">${skill.name}</h6>
                <span class="badge bg-primary">${skill.level}</span>
            </div>
            <p class="card-text small">${skill.description}</p>
            <div class="mt-2">
                ${skill.tags ? skill.tags.map(tag => `<span class="badge bg-light text-dark me-1">${tag}</span>`).join('') : ''}
            </div>
        `;

        card.appendChild(cardBody);
        cardCol.appendChild(card);
        return cardCol;
    }

    // Function to add a new skill
    function addSkill(skillData) {
        const user = userModule.getLoggedInUserData();
        if (!user) return;

        // Basic validation (you might want more robust validation)
        if (!skillData.name || !skillData.level || !skillData.type) {
            alert("Please fill in all skill fields."); // Use a better UI than alert
            return;
        }

        // Add the skill to the user's skills array
        user.skills.push(skillData);

        // Update localStorage
        let users = localStorage.getItem('users');
        users = users ? JSON.parse(users) : [];

        const userIndex = users.findIndex(u => u.username === user.username);
        if (userIndex !== -1) {
            users[userIndex] = user;  // No need to call addDefaultProfileData here
            localStorage.setItem('users', JSON.stringify(users));
        }

        // Re-populate the skills tab to show the new skill
        populateSkillsTab(user.skills);

        // Reset the add skill form
        document.getElementById('new-skill-form').reset();
         // Show the skills tab after adding
        document.getElementById('skills-tab').click();
    }

      //----------Portfolio Tab-------------------------------
      // Function to populate the portfolio tab content
        function populatePortfolioTab(portfolioItems) {
            const portfolioContainer = document.getElementById('portfolio-container');
            if (!portfolioContainer) return;

            portfolioContainer.innerHTML = ''; // Clear existing content

            if (portfolioItems && portfolioItems.length > 0) {
                portfolioItems.forEach(item => {
                    const portfolioItemElement = createPortfolioItemElement(item);
                    portfolioContainer.appendChild(portfolioItemElement);
                });
            } else {
                portfolioContainer.innerHTML = '<p>No portfolio items yet.</p>';
            }
        }

     // Function to create a portfolio item element
    function createPortfolioItemElement(item) {
        const itemCol = document.createElement('div');
        itemCol.className = 'col-md-6 mb-4';

        const card = document.createElement('div');
        card.className = 'card';

        if (item.image) {
            const img = document.createElement('img');
            img.src = item.image;
            img.className = 'card-img-top';
            img.alt = item.title;
            card.appendChild(img);
        }

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';
        cardBody.innerHTML = `
            <h6>${item.title}</h6>
            <p class="small text-muted">${item.description}</p>
        `;

        card.appendChild(cardBody);
        itemCol.appendChild(card);
        return itemCol;
    }
     //----------Reviews Tab---------------------------------
      // Function to populate the reviews tab
    function populateReviewsTab(reviews) {
        const reviewsContainer = document.getElementById('reviews-container');
         const reviewsCount = document.getElementById('reviews-count');
        if (!reviewsContainer || !reviewsCount) return;

        reviewsContainer.innerHTML = ''; // Clear existing content
         // Update reviews count
        reviewsCount.textContent = reviews && reviews.length > 0 ? `${calculateAverageRating(reviews).toFixed(1)} (${reviews.length} reviews)` : 'No reviews yet';
         //update review stars
        updateRatingStars('reviews-average-stars', calculateAverageRating(reviews));
        if (reviews && reviews.length > 0) {
            reviews.forEach(review => {
                const reviewCard = createReviewCard(review);
                reviewsContainer.appendChild(reviewCard);
            });
        } else {
            reviewsContainer.innerHTML = '<p>No reviews yet.</p>';
        }
    }

    // Function to create a review card
    function createReviewCard(review) {
        const card = document.createElement('div');
        card.className = 'card mb-3';

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        cardBody.innerHTML = `
            <div class="d-flex align-items-center mb-3">
                <img src="${review.reviewerImage || 'https://ui-avatars.com/api/?name='+review.reviewerName+'&background=6b7280&color=fff'}" class="rounded-circle me-3" width="40" height="40" alt="${review.reviewerName}">
                <div>
                    <h6 class="mb-0">${review.reviewerName}</h6>
                    <div class="d-flex align-items-center">
                         <div class="text-warning me-2">
                            ${Array(Math.floor(review.rating)).fill('<i class="fas fa-star fa-sm"></i>').join('')}
                            ${review.rating - Math.floor(review.rating) >= 0.5 ? '<i class="fas fa-star-half-alt fa-sm"></i>' : ''}
                            ${Array(5 - Math.ceil(review.rating)).fill('<i class="far fa-star fa-sm"></i>').join('')}
                        </div>
                        <small class="text-muted">${review.date}</small>
                    </div>
                </div>
            </div>
            <p class="mb-0">${review.comment}</p>
        `;

        card.appendChild(cardBody);
        return card;
    }


    // Event listeners
    const editProfileBtn = document.getElementById('edit-profile-btn');
    const cancelEditBtn = document.getElementById('cancel-edit-btn');
    const editProfileForm = document.getElementById('edit-profile-form');
    const addSkillBtn = document.getElementById('add-skill-btn');
    const newSkillForm = document.getElementById('new-skill-form');


    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', showEditProfileForm);
    }
    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', hideEditProfileForm);
    }
    if (editProfileForm) {
        editProfileForm.addEventListener('submit', function(event) {
            event.preventDefault();
            saveProfileChanges();
        });
    }
     if (addSkillBtn) {
        addSkillBtn.addEventListener('click', function() {
             // Show the add skill modal
            const addSkillModal = new bootstrap.Modal(document.getElementById('addSkillModal'));
            addSkillModal.show();
        });
    }

     // Handle form submission for adding a new skill
    if (newSkillForm) {
        newSkillForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const skillName = document.getElementById('new-skill-name').value.trim();
            const skillLevel = document.getElementById('new-skill-level').value;
            const skillDescription = document.getElementById('new-skill-description').value.trim();
            const skillType = document.getElementById('new-skill-type').value; // Get skill type
             // Extract tags (assuming comma-separated)
            const skillTags = document.getElementById('new-skill-tags').value.trim().split(',').map(tag => tag.trim()).filter(tag => tag !== '');

            const skillData = {
                name: skillName,
                level: skillLevel,
                description: skillDescription,
                tags: skillTags,
                type: skillType
            };
            addSkill(skillData);
             // Close the modal
            const addSkillModal = new bootstrap.Modal(document.getElementById('addSkillModal'));
            addSkillModal.hide();

        });
    }

     // Call populateProfilePage() on page load
    populateProfilePage();


})();