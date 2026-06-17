$(document).ready(function () {
    $('.form_container').css('display', 'none');
})

function showFormUpdate(event) {
    event.preventDefault();
    const formContainer = $('.form_container');

    if (formContainer.css('display') === 'block') {
        formContainer.slideUp('slow', function () {
            $("html, body").animate({scrollTop: 0}, "slow");
        });
    } else {
        formContainer.slideDown('slow', function () {
            $("html, body").animate({scrollTop: formContainer.offset().top}, "slow");
        });
    }
}

