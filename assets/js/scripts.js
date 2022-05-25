$(document).ready(function () {
    // Navbar Collapse on Scroll (Script)
    $('.navbar-nav>li>a').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });

    //<!--  AOS INIT js -->
    AOS.init();

    // Lightbox2 INIT js
    lightbox.option({
        'alwaysShowNavOnTouchDevices': true,
        'positionFromTop': 150,
        'resizeDuration': 200,
        'disableScrolling': true,
        'wrapAround': true
    });

    // Slick Init js
    $('.slick-slider').slick({
        dots: true, infinite: true, speed: 500, fade: true, cssEase: 'linear'
    });

    $('.isotope-grid').isotope({
        itemSelector: '.grid-item', layoutMode: 'fitRows', filter: '.planta-baja'
    });

    // filter items on button click
    $('.filter-button-group').on('click', 'button', function () {
        let filterValue = $(this).attr('data-filter');
        $('.isotope-grid').isotope({filter: filterValue});
        $('.filter-button-group').removeClass('active');
        $(this).addClass('active');
    });
});

function recaptchaCallback() {
    $('#submitBtn').prop('disabled', false);
}

function recaptchaExpiredCallback() {
    // Resetear recaptcha en caso de que el captcha expire
    $('#submitBtn').attr('disabled', true);
    grecaptcha.prop();
    
}

function recaptchaErrorCallback() {
    // Resetear recaptcha en caso de error por network connectivity
    $('#submitBtn').prop('disabled', true);
    grecaptcha.reset();
}