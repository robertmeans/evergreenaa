function recaptchaCallback() {
    $('#confirm').addClass('display');
    $('#send').removeAttr('disabled');
    $('#send').removeClass('display');
	};

$(window).on('load', function() {
    $(".preload").delay(500).fadeOut(1000);
    });
