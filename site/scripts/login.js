document.getElementById('inputPassword').addEventListener('input', checkPassword);

function checkPassword() {
    let input = document.getElementById('inputPassword').value;
    let all = document.getElementById('cluesPassword');

    let pwd_eightCar = document.getElementById("pwd_eightCar");
    let pwd_special = document.getElementById("pwd_special");
    let pwd_maj = document.getElementById("pwd_maj");
    let pwd_min = document.getElementById("pwd_min");
    let pwd_number = document.getElementById("pwd_number");

    if (input === '') {
        all.classList.add('displayNone');
        all.classList.remove('displayBlock');
    }
    else {
        all.classList.remove('displayNone');
        all.classList.add('displayBlock');

        if (hasEightCharacters(input)) {
            colorGreen(pwd_eightCar);
        }
        else {
            colorRed(pwd_eightCar);
        }

        if (hasSpecialChar(input)) {
            colorGreen(pwd_special);
        }
        else {
            colorRed(pwd_special);
        }

        if (hasUpperCase(input)) {
            colorGreen(pwd_maj);
        }
        else {
            colorRed(pwd_maj);
        }

        if (hasLowerCase(input)) {
            colorGreen(pwd_min);
        }
        else {
            colorRed(pwd_min);
        }


        if (hasNumber(input)) {
            colorGreen(pwd_number);
        }
        else {
            colorRed(pwd_number);
        }
    }

    console.log(!(hasEightCharacters(input) && hasSpecialChar(input) && hasUpperCase(input) && hasLowerCase(input) && hasNumber(input)));
    let submitBtn = document.getElementById("submitBtn");
    if(!(hasEightCharacters(input) && hasSpecialChar(input) && hasUpperCase(input) && hasLowerCase(input) && hasNumber(input)))
    {
        submitBtn.classList.add("displayNone");
        submitBtn.classList.remove("displayBlock");
    }
    else{
        all.classList.add('displayNone');
        all.classList.remove('displayBlock');

        submitBtn.classList.add("displayBlock");
        submitBtn.classList.remove("displayNone");
    }
}


function hasEightCharacters(str) {
    return str.length >= 8;
}

function hasSpecialChar(str) {
    var specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

function hasUpperCase(str) {
    return /[A-Z]/.test(str);
}

function hasLowerCase(str) {
    return /[a-z]/.test(str);
}

function hasNumber(str) {
    return /[0-9]/.test(str);
}

function colorRed(element) {
    element.classList.remove("green");
    element.classList.add("red");
}

function colorGreen(element) {
    element.classList.remove("red");
    element.classList.add("green");
}