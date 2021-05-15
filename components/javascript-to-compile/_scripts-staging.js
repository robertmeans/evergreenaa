// fundraiser GoFundMe $115 02.05.21
$(document).ready(function() {
  $('.foot').click(function() {
      if($('.foot').hasClass('slide-up')) {
        $('.foot').addClass('slide-down', 250, 'linear');
        $('.foot').removeClass('slide-up'); 
      } else {
        $('.foot').removeClass('slide-down');
        $('.foot').addClass('slide-up', 250, 'linear'); 
      }
  });
});


// all things backstretch are in jquery.backstretch.min.js

var but = document.getElementsByClassName('btn');
var txt = document.getElementsByClassName('input-copy');
for (var x = 0; x < but.length; x++) {
  (function(x) {
    but[x].addEventListener("click", function() {
      copyToClipboardMsg(txt[x], but[x]);
    }, false);
  })(x);
}

function copyToClipboardMsg(elem, msgElem) {
    var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "Press Ctrl+c to copy"
    } else {
        msg = "Copied!"
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    msgElem.style.background = "#40d046";
    msgElem.style.color = "#fff";
    msgElem.style.border = "1px solid #fff";

    setTimeout(function() {
        msgElem.innerHTML = "<i class=\"far fa-arrow-alt-circle-up\"></i> Copy";
        msgElem.style.background = "#fff";
        msgElem.style.color = "#313131";
        msgElem.style.border = "1px solid #757575";

    }, 750);
}


function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

/* initialize timepicker */
/* https://timepicker.co/options/ */
$(document).ready(function(){
    $('input.timepicker').timepicker({
    timeFormat: 'h:mm p',
    dynamic: false,
    dropdown: false,
    scrollbar: false
    });
});

/* visible divs as radio buttons */
$('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
    var val = $(this).attr('value');
    //alert(val);
    $(this).parent().find('input').val(val);
});

/* sweet rememberme triangle inside circle all css */
$('input[name="remember_me"]').change(function(){
    if($(this).is(":checked")) {
        $('.aa-rm-in').addClass("checkaroo");
        $('.rm-rm').addClass("hot");
    } else {
        $('.aa-rm-in').removeClass("checkaroo");
        $('.rm-rm').removeClass("hot");
    }
});

/* show passwords */
$("button#showLoginPass").click(function(){
  var x = document.getElementById("password");
    $(this).toggleClass("showPassOn");

    if ($.trim($(this).html()) === '<i class="far fa-eye-slash"></i> Hide password') {
        $(this).html('<i class="far fa-eye"></i> Show password');
        x.type = "password";
    } else {
        $(this).html('<i class="far fa-eye-slash"></i> Hide password');
        x.type = "text";
    }
    return false;
  });

$("button#showSignupPass").click(function(){
  var x = document.getElementById("showPassword");
  var y = document.getElementById("showConf");
    $(this).toggleClass("showPassOn");

    if ($.trim($(this).html()) === '<i class="far fa-eye-slash"></i> Hide passwords') {
        $(this).html('<i class="far fa-eye"></i> Show passwords');
        x.type = "password";
        y.type = "password";
    } else {
        $(this).html('<i class="far fa-eye-slash"></i> Hide passwords');
        x.type = "text";
        y.type = "text";
    }
    return false;
  });

/* open and close weekday content */

$(document).ready(function(){

  $(".day-content").hide();
  $(".weekday-wrap").hide();
  $("#msg-one").hide();
  $("#lat-long").hide();
  $("#desc-loc").hide();
  $("#pdf-upload").hide();
  $("#link-label").hide();
  $("#email-bob").hide();



  $(".pdf1").hide();
  $(".pdf2").hide();
  $(".pdf3").hide();
  $(".pdf4").hide();
  $('#file-upload').click(function() {
    var file_upload_txt = $(this).html();
    // var open_upload = $(this).closest('.pdf-wrap');
    //alert(file_upload_txt);

    // if ((file_upload_txt) == ' Add a PDF') {
    //   $('.pdf1').slideDown();
    //   $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
    //   return;
    // } 

    // if ((file_upload_txt) == ' Add another PDF | 3 remaining') {
    //     $('.pdf2').slideDown();
    //     $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
    //     return;
    // }

    // if ((file_upload_txt) == ' Add another PDF | 2 remaining') {
    //     $('.pdf3').slideDown();
    //     $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
    //     return;
    // }


    if ((file_upload_txt) == '<i class="far fa-plus-square fa-fw"></i> Add a PDF') {
      if ($('.pdf1').is(':hidden')) {
        $('.pdf1').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
        return;
      }
      if ($('.pdf2').is(':hidden')) {
        $('.pdf2').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
        return;
      }
      if ($('.pdf3').is(':hidden')) {
        $('.pdf3').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
        return;
      }
      if ($('.pdf4').is(':hidden')) {
        $('.pdf4').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
        return;
      }
    }

    if ((file_upload_txt) == '<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining') {
      if ($('.pdf1').is(':hidden')) {
        $('.pdf1').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      }
      if ($('.pdf2').is(':hidden')) {
        $('.pdf2').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      }
      if ($('.pdf3').is(':hidden')) {
        $('.pdf3').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      }
      if ($('.pdf4').is(':hidden')) {
        $('.pdf4').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      }
    }

    if ((file_upload_txt) == '<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining') {
      if ($('.pdf1').is(':hidden')) {
        $('.pdf1').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      }
      if ($('.pdf2').is(':hidden')) {
        $('.pdf2').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      }
      if ($('.pdf3').is(':hidden')) {
        $('.pdf3').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      }
      if ($('.pdf4').is(':hidden')) {
        $('.pdf4').slideDown();
        $(this).html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      }
    }

    if ((file_upload_txt) == '<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining') {
      if ($('.pdf1').is(':hidden')) {
        $('.pdf1').slideDown();
        $(this).html('');
        return;
      }
      if ($('.pdf2').is(':hidden')) {
        $('.pdf2').slideDown();
        $(this).html('');
        return;
      }
      if ($('.pdf3').is(':hidden')) {
        $('.pdf3').slideDown();
        $(this).html('');
        return;
      }
      if ($('.pdf4').is(':hidden')) {
        $('.pdf4').slideDown();
        $(this).html('');
        return;
      }
    }    



  });













  $('.pdf-remove').click(function() {
    var file_upload_txt = $('#file-upload').html();
    var close_upload = $(this).closest('.pdf-wrap');

    if ((file_upload_txt) == '<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining') {

      if ((close_upload).hasClass('pdf1')) {
        $('.pdf1_name').val('');
        $('.pdf1').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add a PDF');
        return;
      } 
      if ((close_upload).hasClass('pdf2')) {
        $('.pdf2_name').val('');
        $('.pdf2').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add a PDF');
        return;
      } 
      if ((close_upload).hasClass('pdf3')) {
        $('.pdf3_name').val('');
        $('.pdf3').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add a PDF');
        return;
      } 
      if ((close_upload).hasClass('pdf4')) {
        $('.pdf4_name').val('');
        $('.pdf4').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add a PDF');
        return;
      }
        return;
    }


    if ((file_upload_txt) == '<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining') {

      if ((close_upload).hasClass('pdf1')) {
        $('.pdf1_name').val('');
        $('.pdf1').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf2')) {
        $('.pdf2_name').val('');
        $('.pdf2').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf3')) {
        $('.pdf3_name').val('');
        $('.pdf3').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf4')) {
        $('.pdf4_name').val('');
        $('.pdf4').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
      }
        return;
    }


    if ((file_upload_txt) == '<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining') {

      if ((close_upload).hasClass('pdf1')) {
        $('.pdf1_name').val('');
        $('.pdf1').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf2')) {
        $('.pdf2_name').val('');
        $('.pdf2').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf3')) {
        $('.pdf3_name').val('');
        $('.pdf3').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf4')) {
        $('.pdf4_name').val('');
        $('.pdf4').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
        return;
      }
      return;
    } 


    if ((file_upload_txt) == '') {

      if ((close_upload).hasClass('pdf1')) {
        $('.pdf1_name').val('');
        $('.pdf1').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf2')) {
        $('.pdf2_name').val('');
        $('.pdf2').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf3')) {
        $('.pdf3_name').val('');
        $('.pdf3').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      } 
      if ((close_upload).hasClass('pdf4')) {
        $('.pdf4_name').val('');
        $('.pdf4').slideUp();
        $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
        return;
      }
        return;
    } 







    // if ((file_upload_txt) == ' Add another PDF | 2 remaining') {
    //     $(close_upload).slideUp();
    //     $('#file-upload').html(' Add another PDF | 3 remaining');
    //     return;
    // }

    // if ((file_upload_txt) == ' Add another PDF | 1 remaining') {
    //     $(close_upload).slideUp();
    //     $('#file-upload').html(' Add another PDF | 2 remaining');
    //     return;
    // }

    // if ((file_upload_txt) == '') {
    //     $(close_upload).slideUp();
    //     $('#file-upload').html(' Add another PDF | 1 remaining');
    //     return;
    // }

  });
    // $(close_upload).slideUp();






  /* toggle days of week */
  $('.day').click(function() {
    var active = $(this);
    var toggle = $(this).next('.day-content');

    $('.day-content').not(toggle).slideUp();
    $('.day').not(active).removeClass('active');

    $(toggle).slideToggle();
    if ($(active).hasClass('active')) {
      $(active).removeClass('active');
    } else {
      $(active).addClass('active');
    }
  });

  $('.daily-glance-wrap').click(function() {

    var active = $(this);
    var toggle = $(this).next('.weekday-wrap');

    $('.weekday-wrap').not(toggle).slideUp();
    $('.daily-glance-wrap').not(active).removeClass('active');
    $(toggle).slideToggle();

    if ($(active).hasClass('active')) {
      $(active).removeClass('active');
    } else {
      $(active).addClass('active');
    }
  });

  $('.manage-glance-wrap').click(function() {

    var active = $(this);
    var toggle = $(this).next('.weekday-wrap');

    $('.weekday-wrap').not(toggle).slideUp();
    $('.manage-glance-wrap').not(active).removeClass('active');
    $(toggle).slideToggle();

    if ($(active).hasClass('active')) {
      $(active).removeClass('active');
    } else {
      $(active).addClass('active');
    }
  });

  /* collapse day button */
  $('.collapse-day').click(function() {
    var me = $(this);
    $('.day-content').not(me).slideUp();
    $('.day').removeClass('active');
  });

  $("#toggle-contact-form").click(function(){
      $(this).toggleClass("active").next().slideToggle(600);

      if ($.trim($(this).text()) === 'close') {
          $(this).html('<i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i>');
      } else {
          $(this).html('<i class="fa fa-times-circle close-left" aria-hidden="true"></i> close <i class="fa fa-times-circle close-right" aria-hidden="true"></i>');
      }
    return false;
  })
}); /* document.ready end */

setTimeout(function() {
  $("#success-wrap").fadeOut(1500);
}, 2000);

// toggle msg one public
$("#toggle-public-msg").click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    var open  = 'Close';
    var closed = 'Readme';

  if ($('#msg-one').is(':hidden')) {
      $("#msg-one").fadeIn(500);
      $("#toggle-public-msg").html(open); 
  } else {
      $("#msg-one").fadeOut(500);
      $("#toggle-public-msg").html(closed); 
  }

});

// toggle msg one private
$("#toggle-private-msg").click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    var open  = 'Close';
    var closed = 'Extras';

  if ($('#msg-one').is(':hidden')) {
      $("#msg-one").fadeIn(500);
      $("#toggle-private-msg").html(open); 
  } else {
      $("#msg-one").fadeOut(500);
      $("#toggle-private-msg").html(closed); 
  }

});













// toggle lat, long coordinates explanation on 
// _includes/edit-details.php page
$("#toggle-lat-long-msg").click(function(e) {
  $("#lat-long").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});
$(document).click(function() {
  $("#lat-long").fadeOut(500);
});​

$("#toggle-descriptive-location").click(function(e) {
  $("#desc-loc").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});
$(document).click(function() {
  $("#desc-loc").fadeOut(500);
});​

$("#toggle-pdf-info").click(function(e) {
  $("#pdf-upload").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});
$(document).click(function() {
  $("#pdf-upload").fadeOut(500);
});​

$("#toggle-link-label").click(function(e) {
  $("#link-label").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});
$(document).click(function() {
  $("#link-label").fadeOut(500);
});​







// close msg one when clicking anywhere on page
$(document).click(function() {
  // var close    = 'Close';
  var closed_public     = 'Readme';
  var closed_private    = 'Extras';

  $('#msg-one').fadeOut(500);
  $("#toggle-public-msg").html(closed_public);

 // $('#msg-one').fadeOut(500);
  $("#toggle-private-msg").html(closed_private); 

});​

// prevent these links from closing msg
$(".pdf-remove").click(function(e) {
   e.stopPropagation();
});
$("#gmaps").click(function(e) {
    e.stopPropagation();
});
$(".pdf").click(function(e) {
    e.stopPropagation();
});
$("#preamble").click(function(e) {
    e.stopPropagation();
});
$("#twelvesteps").click(function(e) {
    e.stopPropagation();
});
$("#traditions").click(function(e) {
    e.stopPropagation();
});
$("#topics").click(function(e) {
    e.stopPropagation();
});
$("#daccaa").click(function(e) {
    e.stopPropagation();
});
$(".manage-edit").click(function(e) {
    e.stopPropagation();
});
$(".manage-delete").click(function(e) {
    e.stopPropagation();
});
$(".youtube").click(function(e) {
    e.stopPropagation();
});


// checkboxes on update forms - prevent multiple options

// open, men's or womens?
$(".omw").change(function() {
    $(".omw").not(this).prop('checked', false);
});

// open or closed mtg? (so you can have open or closed mens or womens but not open and closed by itself)
$(".oc").change(function() {
    $(".oc").not(this).prop('checked', false);
});


// footer ajax contact
$(document).ready(function() {
  $('#emailBob').click(function() {
    //event.preventDefault();
    $.ajax({
      dataType: "JSON",
      url: "contact-process.php",
      type: "POST",
      data: $('#contactForm').serialize(),
      beforeSend: function(xhr) {
        $('#msg').html('<span>Sending - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#contactForm').html('<span>Your message was sent successfully.</span>');
          } else {
            $('#msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {
        // $('#contact').html('<span>Your message was sent successfully.</span>');
        // $('#send-success').html('<input name="clozer" id="clozer" class="clozer" value="Close">');
      }
    })
  });
});
