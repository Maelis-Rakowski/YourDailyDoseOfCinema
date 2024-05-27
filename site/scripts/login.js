let all = $('#helpPassword');
all.hide();
$('#emailToolTip').hide();
$('#pwdMatchTooltip').hide();
$('#pseudoToolTip').hide();

// On value changed de : input du password
$('.passwordInput').on('input', checkPassword);
$('.emailInput').on('input', checkEmail);
$('.confirmPassword').on('input', checkIfPasswordMatch);

function checkPassword() {
    let input = $('.passwordInput').val();

    //on test chacune des lignes et change leurs couleurs en fonction
    if (input === '') {
        all.hide();
    }
    else {
        var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

        all.show();
        input.length > 8 ? $('#pwd_eightCar').css('color', 'green') : $('#pwd_eightCar').css('color', 'red');
        special.test(input) ? $('#pwd_special').css('color', 'green') : $('#pwd_special').css('color', 'red');
        /[A-Z]/.test(input) ? $('#pwd_maj').css('color', 'green') : $('#pwd_maj').css('color', 'red');
        /[a-z]/.test(input) ? $('#pwd_min').css('color', 'green') : $('#pwd_min').css('color', 'red');
        /[0-9]/.test(input) ? $('#pwd_number').css('color', 'green') : $('#pwd_number').css('color', 'red');
    }

    // si tout est rouge, on empeche le user de submit
    if (!(
        (input.length > 8)
        && (/[A-Z]/.test(input))
        && (/[a-z]/.test(input))
        && (/[0-9]/.test(input))
        && (special.test(input))
    )) {
        $('#submitBtn').prop('disabled', true);
    }
    else {
        all.hide();
        $('#submitBtn').prop('disabled', false);
    }
}

function checkEmail() {
    var mail_ER = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (mail_ER.test($('.emailInput').val())) {
        $('#emailToolTip').hide();
        $('#submitBtn').prop('disabled', false);

    }
    else {
        $('#emailToolTip').show().css('color', 'red');
        $('#submitBtn').prop('disabled', true);
    }
}

function checkIfPasswordMatch() {
    let tooltip = $('#pwdMatchTooltip');
    tooltip.css('color', 'red');
    $('.passwordInput').val() != $('.confirmPassword').val() ? tooltip.show() : tooltip.hide();
}


$(document).ready(function () {
    $('.pseudo').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'login/isUserInDB',
                type: 'POST',
                dataType: 'json',
                data: { 
                    query: request.term,
                    param1: getInputFieldPseudo()
                },
                success: function(data) {
                    if(data) {
                        // Le nom d'utilisateur est disponible
                        $('#pseudoToolTip').hide();
                        $('#submitBtn').prop('disabled', false);
                    }
                    else {
                        // Le nom d'utilisateur est déjà pris
                        $('#pseudoToolTip').show().css('color', 'red');
                        $('#submitBtn').prop('disabled', true);
                    }
                }
            });
        },
        minLength: 2,
    })
})

function getInputFieldPseudo(){
    var input = document.getElementById('pseudo-sign-up');
    return input.value;
}

