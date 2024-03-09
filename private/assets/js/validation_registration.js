const name = document.getElementById("name");
const surname = document.getElementById("surname");
const email = document.getElementById("email");
const address = document.getElementById("address");
const password = document.getElementById("password");
const termsCheckbox = document.getElementById('termsCheckbox');
const passwordConfirm = document.getElementById("confirmPassword");

const form = document.querySelector("form");
const errorMessage = document.getElementById("errorMessage");
form.addEventListener("submit", (e) => {
    checkRegistrationInputs();
    if (!allValidationsPass()) {
        e.preventDefault();
    }
})
function checkRegistrationInputs() {
    const nameValue = name.value.trim();
    const surnameValue = surname.value.trim();
    const addressValue = address.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const passwordValueConfirm = passwordConfirm.value.trim();
    const isConfirmTermsChecked = termsCheckbox.checked;
    if (!isConfirmTermsChecked) {
        const formControl = termsCheckbox.parentElement;
        const sm = formControl.querySelector('small');
        sm.innerText = "Confirm the terms";

    }
    if (nameValue === '') {
        setError(name, 'Username cannot be blank');
    } else {
        setSuccess(name);
    }
    if (addressValue === '') {
        setError(address, 'Address cannot be blank');
    } else {
        setSuccess(address);
    }
    if (surnameValue === '') {
        setError(surname, 'Surname cannot be blank');
    } else {
        setSuccess(surname);
    }

    if (passwordValue === '') {
        setError(password, 'Password cannot be blank');
    } else {
        setSuccess(surname);
    }
    if (passwordConfirm === '') {
        setError(passwordConfirm, 'Confirm password cannot be blank');
    } else if (passwordValue != passwordValueConfirm) {
        setError(passwordConfirm, 'Passwords does not match');
    } else {
        setSuccess(passwordConfirm);
    }
    if (emailValue === '') {
        setError(email, 'Email cannot be blank');
    } else if (!checkEmail(emailValue)) {
        setError(email, 'Invalid email!');
    } else {
        setSuccess(email);
    }

}
function allValidationsPass() {
    if (form.querySelectorAll('.form-control.error').length > 0) {
        return false;
    }
    return true;
}
function setError(input, message) {
    const formControl = input.parentElement;
    const sm = formControl.querySelector('small');
    sm.innerText = message;
    formControl.className = 'form-control error';

}
function setSuccess(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}
function checkEmail(email) {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
}
