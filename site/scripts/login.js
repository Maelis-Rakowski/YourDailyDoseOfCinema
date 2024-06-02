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
        input.length > 8    ? $('#pwd_eightCar').removeClass('text-danger').addClass('text-success') : $('#pwd_eightCar').removeClass('text-success').addClass('text-danger');
        special.test(input) ? $('#pwd_special').removeClass('text-danger').addClass('text-success') : $('#pwd_special').removeClass('text-success').addClass('text-danger');
        /[A-Z]/.test(input) ? $('#pwd_maj').removeClass('text-danger').addClass('text-success') : $('#pwd_maj').removeClass('text-success').addClass('text-danger');
        /[a-z]/.test(input) ? $('#pwd_min').removeClass('text-danger').addClass('text-success') : $('#pwd_min').removeClass('text-success').addClass('text-danger');
        /[0-9]/.test(input) ? $('#pwd_number').removeClass('text-danger').addClass('text-success') : $('#pwd_number').removeClass('text-success').addClass('text-danger');

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

    $("#emailForm").on('submit', function(e) {
        e.preventDefault(); // On empêche le navigateur d'envoyer le formulaire, on fait le post nous même
        var email = $("#emailInput").val();
        checkEmailExists(email);
    })

    $('.pseudo').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'login/doesUserExists',
                type: 'POST',
                dataType: 'json',
                data: { 
                    query: request.term,
                    pseudo: getInputFieldPseudo()
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
    var input = document.getElementById('pseudo');
    return input.value;
}

function checkEmailExists(email) {
    $.post('checkEmailExists', {
        emailInput: email,
    }).done(function(reponse_html) {
        reponse = JSON.parse(reponse_html);
        if (reponse["answer"]) {
            $('#answerEmail').html("email envoyé avec succès");
            $('#answerEmail').removeClass("text-danger");
            $('#answerEmail').addClass("text-success");
            document.getElementById("emailForm").submit();
        }
        else{   $('#answerEmail').html("ce mail n'est pas associé à un compte");
                $('#answerEmail').removeClass("text-success");
                $('#answerEmail').addClass("text-danger");
        }
    });
}