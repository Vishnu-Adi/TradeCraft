function validateLoginForm() {
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;
    let valid = true;

    // Clear previous error messages
    document.getElementById('login-error').innerText = '';

    if (!email) {
        valid = false;
        document.getElementById('login-error').innerText += 'Email is required.\n';
    } else if (!validateEmail(email)) {
        valid = false;
        document.getElementById('login-error').innerText += 'Invalid email format.\n';
    }

    if (!password) {
        valid = false;
        document.getElementById('login-error').innerText += 'Password is required.\n';
    }

    return valid;
}

function validateRegistrationForm() {
    const username = document.getElementById('register-username').value;
    const email = document.getElementById('register-email').value;
    const password = document.getElementById('register-password').value;
    const confirmPassword = document.getElementById('register-confirm-password').value;
    let valid = true;

    // Clear previous error messages
    document.getElementById('register-error').innerText = '';

    if (!username) {
        valid = false;
        document.getElementById('register-error').innerText += 'Username is required.\n';
    }

    if (!email) {
        valid = false;
        document.getElementById('register-error').innerText += 'Email is required.\n';
    } else if (!validateEmail(email)) {
        valid = false;
        document.getElementById('register-error').innerText += 'Invalid email format.\n';
    }

    if (!password) {
        valid = false;
        document.getElementById('register-error').innerText += 'Password is required.\n';
    }

    if (password !== confirmPassword) {
        valid = false;
        document.getElementById('register-error').innerText += 'Passwords do not match.\n';
    }

    return valid;
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}