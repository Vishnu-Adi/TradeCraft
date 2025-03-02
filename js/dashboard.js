// js/dashboard.js
(function() {
    if(!document.getElementById('dashboard-page')) return; //only for dashbaord page

    const userModule = window.userModule; // Access the userModule.

    // Function to load and display dashboard data
    function loadDashboardData() {
        const user = userModule.getLoggedInUserData(); // Use the userModule
        if (!user) {
            window.location.href = 'login.html'; // Redirect if not logged in
            return; // Important: Stop execution if not logged in
        }
		//update navbar with user info
        const navProfileImage = document.getElementById('nav-profile-image');
        const navUsername = document.getElementById('nav-username');
        if(navProfileImage){
            navProfileImage.src = user.profileImage;
        }

        if (navUsername) {
            navUsername.textContent = user.username; // Update navbar with username
        }

        // Simulate some data for the dashboard (replace with real data loading later)
        const activeExchangesCount = user.exchanges;
        const offeredSkillsCount = user.skills.filter(skill => skill.type ==='share').length;
        const averageRating = calculateAverageRating(user.reviews);
        const messagesCount = 5; // Replace with actual message count

        // Update the stats cards
        document.getElementById('active-exchanges-count').textContent = activeExchangesCount;
        document.getElementById('offered-skills-count').textContent = offeredSkillsCount;
        document.getElementById('average-rating-count').textContent = averageRating.toFixed(1);
        document.getElementById('messages-count').textContent = messagesCount;

        // Simulate recent exchanges
        const recentExchanges = simulateRecentExchanges();
        populateRecentExchangesTable(recentExchanges);

        // Simulate notifications
        const notifications = simulateNotifications();
        populateNotificationsList(notifications);

        // Calculate and display profile completion percentage (example)
        const profileCompletion = calculateProfileCompletion(user);
        document.getElementById('profile-completion-percent').textContent = `${profileCompletion}%`;
        document.getElementById('profile-completion-bar').style.width = `${profileCompletion}%`;
		document.getElementById('profile-completion-bar').setAttribute('aria-valuenow', profileCompletion);

        //calculate and display skills documented
        const skillsCompletion = calculateSkillsCompletion(user);
        document.getElementById('skills-documented-percent').textContent = `${skillsCompletion}%`;
        document.getElementById('skills-documented-bar').style.width = `${skillsCompletion}%`;
		document.getElementById('skills-documented-bar').setAttribute('aria-valuenow', skillsCompletion);

        //calculate and display skills documented
        const exchangeCompletion = calculateExchangeCompletion(user);
        document.getElementById('exchange-feedback-percent').textContent = `${exchangeCompletion}%`;
        document.getElementById('exchange-feedback-bar').style.width = `${exchangeCompletion}%`;
		document.getElementById('exchange-feedback-bar').setAttribute('aria-valuenow', exchangeCompletion);

    }


    function simulateRecentExchanges() {
        // In a real app, you would fetch this data from localStorage or a backend
        return [
            { user: 'Sarah Rodriguez', userImage: 'https://ui-avatars.com/api/?name=Sarah+Rodriguez&background=6b7280&color=fff', skill: 'Digital Marketing', status: 'Active', date: 'Mar 1, 2025' },
            { user: 'Michael Chen', userImage: 'https://ui-avatars.com/api/?name=Michael+Chen&background=10b981&color=fff', skill: 'Web Development', status: 'Scheduled', date: 'Mar 5, 2025' },
            { user: 'Emma Lewis', userImage: 'https://ui-avatars.com/api/?name=Emma+Lewis&background=fbbf24&color=fff', skill: 'Baking & Pastry', status: 'Active', date: 'Feb 28, 2025' },
            { user: 'David Wilson', userImage: 'https://ui-avatars.com/api/?name=David+Wilson&background=ef4444&color=fff', skill: 'Piano Lessons', status: 'Completed', date: 'Feb 24, 2025' }
        ];
    }
    function simulateNotifications() {
        return [
            { type: 'message', user: 'Michael Chen', userImage: 'https://ui-avatars.com/api/?name=Michael+Chen&background=10b981&color=fff', message: 'sent you a new message.', time: '10 minutes ago' },
            { type: 'accept', user: 'Emma Lewis',userImage: 'https://ui-avatars.com/api/?name=Emma+Lewis&background=fbbf24&color=fff', message: 'accepted your exchange request.', time: '1 hour ago' },
            { type: 'review', user: 'Sarah Rodriguez', userImage: 'https://ui-avatars.com/api/?name=Sarah+Rodriguez&background=6b7280&color=fff', message: 'left you a 5-star review.', time: '3 hours ago' },
            { type: 'reminder', user: 'David Wilson', userImage: 'https://ui-avatars.com/api/?name=David+Wilson&background=ef4444&color=fff', message: 'Reminder: Piano lesson with David Wilson tomorrow at 3PM.', time: '5 hours ago' }
        ]
    }

     function getStatusBadgeClass(status) {
        switch (status) {
            case 'Active': return 'success';
            case 'Scheduled': return 'warning';
            case 'Completed': return 'secondary';
            default: return 'info'; // Or any other default class
        }
    }
     function getNotificationIconClass(type) {
        switch (type) {
            case 'message': return { icon: 'fa-comment', bg: 'primary' };
            case 'accept': return { icon: 'fa-check-circle', bg: 'success' };
            case 'review': return { icon: 'fa-star', bg: 'warning' };
            case 'reminder': return { icon: 'fa-calendar-alt', bg: 'info' };
            default: return { icon: 'fa-info-circle', bg: 'secondary' };
        }
    }

    // Function to populate the recent exchanges table
    function populateRecentExchangesTable(exchanges) {
        const tableBody = document.getElementById('recent-exchanges-table');
        if (!tableBody) return;

        tableBody.innerHTML = ''; // Clear existing rows

        exchanges.forEach(exchange => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <div class="d-flex align-items-center">
                        <img src="${exchange.userImage}"
                                class="rounded-circle me-2" width="36" height="36" alt="${exchange.user}">
                        <div>
                            <h6 class="mb-0">${exchange.user}</h6>
                            <small class="text-muted">${exchange.skill}</small>
                        </div>
                    </div>
                </td>
                <td>${exchange.skill}</td>
                <td><span class="badge bg-${getStatusBadgeClass(exchange.status)}">${exchange.status}</span></td>
                <td>${exchange.date}</td>
                <td class="text-end">
                    <button class="btn btn-sm btn-light">Details</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Function to populate the notifications list
    function populateNotificationsList(notifications) {
        const notificationsList = document.getElementById('notifications-list');
        if (!notificationsList) return;
        notificationsList.innerHTML = ''; // Clear existing notifications
        notifications.forEach(notification => {
            const listItem = document.createElement('div');
            listItem.className = 'list-group-item border-0 py-3 px-4';
            listItem.innerHTML = `
             <div class="d-flex">
                    <div class="me-3">
                        <div class="bg-${getNotificationIconClass(notification.type).bg} bg-opacity-10 p-2 rounded-circle text-${getNotificationIconClass(notification.type).bg}">
                            <i class="fas ${getNotificationIconClass(notification.type).icon}"></i>
                        </div>
                    </div>
                    <div>
                        <p class="mb-0"><strong>${notification.user}</strong> ${notification.message}</p>
                        <small class="text-muted">${notification.time}</small>
                    </div>
                </div>
            `;
            notificationsList.appendChild(listItem);

        })
    }

     // Example function to calculate profile completion percentage
    function calculateProfileCompletion(user) {
        let completed = 0;
        const totalFields = 8; // Example: name, role, about, location, email, website, skills, profileImage

        if (user.firstname && user.lastname) completed++;
        if (user.role) completed++;
        if (user.about) completed++;
        if (user.location) completed++;
        if (user.email) completed++;
        if (user.website) completed++;
        if (user.skills && user.skills.length > 0) completed++;
        if (user.profileImage) completed++;

        return Math.round((completed / totalFields) * 100);
    }

     // Example function to calculate skills completion percentage
    function calculateSkillsCompletion(user) {
        let completed = 0;
        const totalFields = 2; //skills to share and skills to learn

        if (user.skills && user.skills.filter(skill => skill.type === 'share').length > 0) completed++;
        if (user.skills && user.skills.filter(skill => skill.type === 'learn').length > 0) completed++;


        return Math.round((completed / totalFields) * 100);
    }
    // Example function to calculate exchange completion percentage
    function calculateExchangeCompletion(user) {
        let completed = 0;
        const totalFields = 2; //review and exchanges
        if(user.reviews && user.reviews.length > 0) completed++;
        if (user.exchanges && user.exchanges > 0) completed++;

        return Math.round((completed / totalFields) * 100);
    }

    //helper function to calculate average rating
    function calculateAverageRating(reviews) {
        if (!reviews || reviews.length === 0) {
            return 0;
        }
        const totalRating = reviews.reduce((sum, review) => sum + review.rating, 0);
        return totalRating / reviews.length;
    }

    // Call loadDashboardData() on page load, *inside* the IIFE
    loadDashboardData();

})();