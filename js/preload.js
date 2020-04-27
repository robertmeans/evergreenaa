function recaptchaCallback() {
    $('#confirm').addClass('display');
    $('#send').removeAttr('disabled');
    $('#send').removeClass('display');
	};

$(window).on('load', function() {
    $(".preload").delay(250).fadeOut(750);
    });

$(window).on('load', function() {
    $(".preload-manage").delay(200).fadeOut(500);
    });

