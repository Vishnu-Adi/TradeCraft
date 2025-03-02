// Email validation function
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}
// Password validation function
function validatePassword(password) {
    const minLength = 8;
    const hasNumber = /\d/.test(password);
    const hasLetter = /[a-zA-Z]/.test(password);

    return password.length >= minLength && hasNumber && hasLetter;
}

(function () {


// Handle registration form submission
const registrationForm = document.getElementById('registrationForm');
if (registrationForm) {
    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Reset error messages and styles
        document.getElementById('register-error').classList.add('d-none');
        document.getElementById('register-error').textContent = '';
        document.getElementById('registration-success').style.display = 'none'; // Hide success

         // Get all elements with class 'invalid-feedback' within the registration form
        const invalidFeedbackElements = registrationForm.querySelectorAll('.invalid-feedback');
        invalidFeedbackElements.forEach(element => {
            element.textContent = ''; // Clear the error message
        });

        //remove the is-invalid class from all form-controls
        const formControlElements = registrationForm.querySelectorAll('.form-control');
        formControlElements.forEach(element => {
            element.classList.remove('is-invalid');
        });

        // Get form values
        const firstname = document.getElementById('register-firstname').value.trim();
        const lastname = document.getElementById('register-lastname').value.trim();
        const username = document.getElementById('register-username').value.trim();
        const email = document.getElementById('register-email').value.trim();
        const password = document.getElementById('register-password').value;
        const confirmPassword = document.getElementById('register-confirm-password').value;
        const termsCheckbox = document.getElementById('terms-checkbox');
        let isValid = true;

        // Validation
         if (!firstname) {
            document.getElementById('register-firstname-error').textContent = 'First name is required.';
            document.getElementById('register-firstname-error').classList.add('d-block');
            document.getElementById('register-firstname').classList.add('is-invalid');
            isValid = false;
        }

        if (!lastname) {
            document.getElementById('register-lastname-error').textContent = 'Last name is required.';
            document.getElementById('register-lastname-error').classList.add('d-block');
             document.getElementById('register-lastname').classList.add('is-invalid');
            isValid = false;
        }

        if (!username) {
             document.getElementById('register-username-error').textContent = 'Username is required.';
             document.getElementById('register-username-error').classList.add('d-block');
             document.getElementById('register-username').classList.add('is-invalid');
            isValid = false;
        }

        if (!email) {
             document.getElementById('register-email-error').textContent = 'Email is required.';
             document.getElementById('register-email-error').classList.add('d-block');
             document.getElementById('register-email').classList.add('is-invalid');
            isValid = false;
        } else if (!validateEmail(email)) {
            document.getElementById('register-email-error').textContent = 'Invalid email format.';
            document.getElementById('register-email-error').classList.add('d-block');
            document.getElementById('register-email').classList.add('is-invalid');
            isValid = false;
        }

       if (!password) {
             document.getElementById('register-password-error').textContent = 'Password is required.';
            document.getElementById('register-password-error').classList.add('d-block');
             document.getElementById('register-password').classList.add('is-invalid');
            isValid = false;
        }else if (!validatePassword(password)) {
            document.getElementById('register-password-error').textContent = 'Password must be at least 8 characters with numbers and letters.';
            document.getElementById('register-password-error').classList.add('d-block');
             document.getElementById('register-password').classList.add('is-invalid');
            isValid = false;
        }

        if (password !== confirmPassword) {
           document.getElementById('register-confirm-password-error').textContent = 'Passwords do not match.';
            document.getElementById('register-confirm-password-error').classList.add('d-block');
             document.getElementById('register-confirm-password').classList.add('is-invalid');
            isValid = false;
        }

        if (!termsCheckbox.checked) {
             document.getElementById('register-terms-error').textContent = 'You must agree to the terms.';
            document.getElementById('register-terms-error').classList.add('d-block');
            isValid = false;
        }

        if (!isValid) return; // Stop if validation fails.

        // Create user data object
        const userData = {
            firstname,
            lastname,
            username,
            email,
            password
        };

        // Call registerUser function (from userModule)
        const result = window.userModule.registerUser(userData);

        if (result.success) {
            // Show success message and optionally clear the form.
             document.getElementById('registration-success').style.display = 'block';
            registrationForm.reset();
             //add auto login after succesfull registration
            window.userModule.loginUser(userData.email,userData.password);

        } else {
            // Show error message
            document.getElementById('register-error').classList.remove('d-none');
            document.getElementById('register-error').textContent = result.message;
        }
    });
}


  // Handle login form submission
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Reset errors
        document.getElementById('login-error').classList.add('d-none');
        document.getElementById('login-error').textContent = '';

        // Get all elements with class 'invalid-feedback' within the login form
        const invalidFeedbackElements = loginForm.querySelectorAll('.invalid-feedback');
        invalidFeedbackElements.forEach(element => {
            element.textContent = ''; // Clear the error message
        });

        //remove the is-invalid class from all form-controls
        const formControlElements = loginForm.querySelectorAll('.form-control');
        formControlElements.forEach(element => {
            element.classList.remove('is-invalid');
        });

        const email = document.getElementById('login-email').value.trim();
        const password = document.getElementById('login-password').value;
        let isValid = true;

        // Basic validation with proper error handling
        if (!email) {
            const errorElement = document.getElementById('login-email-error');
            if (errorElement) {
                errorElement.textContent = 'Email is required.';
                document.getElementById('login-email').classList.add('is-invalid');
            }
            isValid = false;
        } else if (!validateEmail(email)) {
            const errorElement = document.getElementById('login-email-error');
            if (errorElement) {
                errorElement.textContent = 'Invalid email format.';
                  document.getElementById('login-email').classList.add('is-invalid');
            }
            isValid = false;
        }

        if (!password) {
            const errorElement = document.getElementById('login-password-error');
            if (errorElement) {
                errorElement.textContent = 'Password is required.';
                 document.getElementById('login-password').classList.add('is-invalid');
            }
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        const result = window.userModule.loginUser(email, password); // USE THE MODULE!

        if (!result.success) { // Only handle the error case. Success is handled by loginUser.
            // Show error message
            document.getElementById('login-error').classList.remove('d-none');
            document.getElementById('login-error').textContent = result.message;
        }
    });
}
 //password show/hide feature for register page
const togglePassword = document.getElementById('togglePassword');
const registerPassword = document.getElementById('register-password');
if(togglePassword){
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = registerPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        registerPassword.setAttribute('type', type);
        // toggle the eye slash icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
}
 //password show/hide feature for login page
const toggleLoginPassword = document.getElementById('toggleLoginPassword');
const loginPassword = document.getElementById('login-password');
if(toggleLoginPassword){
    toggleLoginPassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = loginPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        loginPassword.setAttribute('type', type);
        // toggle the eye slash icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
}

})();