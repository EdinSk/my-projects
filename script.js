document.getElementById('userForm').addEventListener('submit', function (event) {
    // Prevent the form from submitting for now
    



    // Simple validation example (you can customize this based on your requirements)
    const nameLastname = document.getElementById('nameLastname').value.trim();
    const companyName = document.getElementById('companyName').value.trim();
    const contactMail = document.getElementById('contactMail').value.trim();
    const contactPhone = document.getElementById('contactPhone').value.trim();
    const studentType = document.getElementById('studentType').value;
    
    document.getElementById('fillFieldsMessage').textContent = 'Please fill in all the required fields.';
    document.getElementById('fillFieldsMessage').style.display = 'block';


    let hasError = false;

    if (!nameLastname) {
        showError('nameLastname', 'Please enter your name and last name.');
        hasError = true;
    } else {
        hideError('nameLastname'); // Hide error if valid input
    }

    if (!companyName) {
        showError('companyName', 'Please enter the company name.');
        hasError = true;
    } else {
        hideError('companyName'); // Hide error if valid input
    }

    if (!isValidEmail(contactMail)) {
        showError('contactMail', 'Please enter a valid email address. Email adress can only end with: @gmail.com, @hotmail.com, @yahoo.com, @outlook.com.');
        hasError = true;
    } else {
        hideError('contactMail'); // Hide error if valid input
    }

    if (!isValidPhoneNumber(contactPhone)) {
        showError('contactPhone', 'Please enter a valid phone number. Example: +389 7x xxx xxx or 07x xxx xxx');
        hasError = true;
    } else {
        hideError('contactPhone'); // Hide error if valid input
    }

    if (!studentType) {
        showError('studentType', 'Please select a student type.');
        hasError = true;
    } else {
        hideError('studentType'); // Hide error if valid input
    }

    // If there are validation errors, stop here
    if (hasError) {
        event.preventDefault(); // Prevents the form from submitting
    }

    // If validation passes, you can submit the form or perform other actions
});

function showError(fieldId, errorMessage) {
    const errorElement = document.getElementById(`${fieldId}Error`);
    if (errorElement) {
        errorElement.textContent = errorMessage;
        errorElement.style.display = 'block'; // Show the error message
    }
}

function hideError(fieldId) {
    const errorElement = document.getElementById(`${fieldId}Error`);
    if (errorElement) {
        errorElement.textContent = ''; // Clear the error message
        errorElement.style.display = 'none'; // Hide the error message
    }
}

function resetCustomValidity() {
    const errorElements = document.getElementsByClassName('error-message');
    for (const element of errorElements) {
        element.textContent = '';
        element.style.display = 'none'; // Hide the error message
    }
}

function isValidEmail(email) {
    // Basic email validation using a regular expression
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Check if the email address ends with the specified domains
    const validDomains = ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com'];
    const domain = email.split('@')[1];
    const isValidDomain = validDomains.includes(domain);

    return emailRegex.test(email) && isValidDomain;
}


function isValidPhoneNumber(phoneNumber) {
    // Remove spaces and check for a valid format
    const strippedNumber = phoneNumber.replace(/\s/g, '');
    
    // Phone number validation
    const phoneRegex = /^(?:\+389\d{8}|07\d{7})$/;
    return phoneRegex.test(strippedNumber);
}


// Attach the showError function to input events without resetting

document.getElementById('nameLastname').addEventListener('input', function () {
    const nameLastname = document.getElementById('nameLastname').value.trim();
    if (nameLastname) {
        hideError('nameLastname'); // Hide error if valid input
    } else {
        showError('nameLastname', 'Please enter your name and lastname.');
    }
});

document.getElementById('companyName').addEventListener('input', function () {
    const companyName = document.getElementById('companyName').value.trim();
    if (companyName) {
        hideError('companyName'); // Hide error if valid input
    } else {
        showError('companyName', 'Please enter the company name.');
    }
});

document.getElementById('contactMail').addEventListener('input', function () {
    const contactMail = document.getElementById('contactMail').value.trim();
    if (isValidEmail(contactMail)) {
        hideError('contactMail'); // Hide error if valid input
    } else {
        showError('contactMail', 'Email adress can only end with: @gmail.com, @hotmail.com, @yahoo.com, @outlook.com.');
    }
});

document.getElementById('contactPhone').addEventListener('input', function () {
    const contactPhone = document.getElementById('contactPhone').value.trim();
    if (isValidPhoneNumber(contactPhone)) {
        hideError('contactPhone'); // Hide error if valid input
    } else {
        showError('contactPhone', 'Phone number needs to be: +389 7x xxx xxx or 07x xxx xxx');
    }
});

document.getElementById('studentType').addEventListener('input', function () {
    const studentType = document.getElementById('studentType').value;
    if (studentType) {
        hideError('studentType'); // Hide error if valid input
    } else {
        showError('studentType', 'Please select a student type.');
    }
});





