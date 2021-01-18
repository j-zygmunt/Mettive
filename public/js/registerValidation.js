const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="repeat-password"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function arePasswordSafe(password) {
    return /^(?=.*\d)(?=.*[A-Z])(?=.{6,100})/.test(password);
}

function markValidation(element, condition) {
    if(!condition){
        element.classList.add('no-valid');
    }else {
        element.classList.remove('no-valid');
    }
}

function validateEmail () {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validatePasswordMatching () {
    setTimeout( function () {
            const condition = arePasswordsSame(
                passwordInput.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, condition);
        },
        1000
    );
}

function validatePasswordSafety () {
    setTimeout( function () {
            const condition = arePasswordSafe(
                passwordInput.value
            );
            markValidation(passwordInput, condition);
        },
        1000
    );
}


emailInput.addEventListener('keyup', validateEmail);

passwordInput.addEventListener('keyup', validatePasswordSafety);

confirmedPasswordInput.addEventListener('keyup', validatePasswordMatching);