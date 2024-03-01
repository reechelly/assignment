document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    const firstname = document.getElementById('firstname');
    const lastname = document.getElementById('lastname');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const positionPlayed = document.getElementsByName('position_played')[0];

    form.addEventListener('submit', function (e) {
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

        const firstnameValue = firstname.value.trim();
        const lastnameValue = lastname.value.trim();
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();
        const positionPlayedValue = positionPlayed.value;

        if (firstnameValue === '') {
            setError(firstname, 'First Name is required');
            isValid = false;
        } else if (!/^[A-Za-z]+$/.test(firstnameValue)) {
            setError(firstname, 'Please enter only alphabet characters');
            isValid = false;
        } else {
            setError(firstname, '');
        }

        if (lastnameValue === '') {
            setError(lastname, 'Last Name is required');
            isValid = false;
        } else if (!/^[A-Za-z]+$/.test(lastnameValue)) {
            setError(lastname, 'Please enter only alphabet characters');
            isValid = false;
        } else {
            setError(lastname, '');
        }

        if (emailValue === '') {
            setError(email, 'Email is required');
            isValid = false;
        } else if (!isValidEmail(emailValue)) {
            setError(email, 'Provide a valid email address');
            isValid = false;
        } else {
            setError(email, '');
        }

        if (passwordValue === '') {
            setError(password, 'Password is required');
            isValid = false;
        } else if (passwordValue.length < 8) {
            setError(password, 'Password must be at least 8 characters.');
            isValid = false;
        } else {
            setError(password, '');
        }

        if (positionPlayedValue === '-- Select Position --') {
            setError(positionPlayed, 'Please select a position');
            isValid = false;
        } else {
            setError(positionPlayed, '');
        }

        return isValid;
    };
});
