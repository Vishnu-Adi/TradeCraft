(function() {  // IIFE for private scope

    // Simple password hashing function (for demonstration only!)
    function simpleHash(password) {
        let hash = 0;
        for (let i = 0; i < password.length; i++) {
            const char = password.charCodeAt(i);
            hash = (hash << 5) - hash + char;
            hash |= 0; // Convert to 32bit integer
        }
        return hash.toString();
    }

    function registerUser(userData) {
        let users = localStorage.getItem('users');
        users = users ? JSON.parse(users) : [];

        if (users.some(user => user.username === userData.username)) {
            return { success: false, message: 'Username already exists.' };
        }
        if (users.some(user => user.email === userData.email)) {
            return { success: false, message: 'Email already registered.' };
        }

        userData.password = simpleHash(userData.password);
        //add default profile data on registration
        userData = addDefaultProfileData(userData);
        users.push(userData);
        localStorage.setItem('users', JSON.stringify(users));
        return { success: true, message: 'Registration successful!' };
    }

    function loginUser(email, password) {
        let users = localStorage.getItem('users');
        users = users ? JSON.parse(users) : [];
        const user = users.find(user => user.email === email);

        if (!user) {
            return { success: false, message: 'Invalid email or password.' };
        }

        const hashedPassword = simpleHash(password);
        if (hashedPassword !== user.password) {
            return { success: false, message: 'Invalid email or password.' };
        }

        localStorage.setItem('loggedInUser', user.username);
        // *** CHANGE HERE: Redirect to dashboard.html ***
        window.location.href = 'dashboard.html'; // Changed from ../index.html
        return { success: true, message: 'Login successful!' }; // Note: This return is now AFTER the redirect
    }

    function logout() {
        localStorage.removeItem('loggedInUser');
        window.location.href = '../index.html'; //go back to index page on logout
    }
    //get Logged in user data
    function getLoggedInUserData() {
      const loggedInUsername = localStorage.getItem('loggedInUser');
      if (!loggedInUsername) {
          return null; // No user logged in
      }

      let users = localStorage.getItem('users');
      users = users ? JSON.parse(users) : [];
      const user = users.find(user => user.username === loggedInUsername);

      // Return user with default profile data if necessary.
      return user ? addDefaultProfileData(user): null;
    }

    // Adds default profile data, *if and only if* it's missing.
    function addDefaultProfileData(user) {
        const defaultData = {
            role: 'Your Role',
            about: 'Write something about yourself.',
            location: 'Your Location',
            website: '#',
            memberSince: new Date().toLocaleDateString(),
            profileImage: `https://ui-avatars.com/api/?name=${user.firstname}+${user.lastname}&background=4f46e5&color=fff`,
            skills: [],
            portfolio: [],
            reviews: [],
            exchanges: 0,
        };

        // This is a concise way to merge the objects.
        return { ...defaultData, ...user };
    }

    // Export functions for use in other modules
    window.userModule = {  // Attach to the window object to make it globally accessible
        registerUser,
        loginUser,
        logout,
        getLoggedInUserData
    };

})();