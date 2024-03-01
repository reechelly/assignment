document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        if (validateInputs()) {

            console.log('Form submission successful!');
        } else {
            console.log('Form submission failed. Please check your inputs.');
        }
    });

    const setError = (element, message) => {
        const inputBox = element.parentElement;
        const errorDisplay = inputBox.querySelector('.error');

        errorDisplay.innerText = message;
    };


    const isValidEmail = email => {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    };

    const validateInputs = () => {
        let isValid = true;

        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();

        if (emailValue === '') {
            setError(email, 'Email is required');
            isValid = false;
        } else if (!isValidEmail(emailValue)) {
            setError(email, 'Provide a valid email address');
            isValid = false;
        } else {
            setSuccess(email);
        }

        if (passwordValue === '') {
            setError(password, 'Password is required');
            isValid = false;
        } else {
            setSuccess(password);
        }

        return isValid;
    };
});