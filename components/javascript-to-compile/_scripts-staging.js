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

/* start file upload */
  /* set positions open or closed based on whether they have a fixerror class or content in the hidden file field */
  var position1 = document.getElementById('hid-f1');
  var position2 = document.getElementById('hid-f2');
  var position3 = document.getElementById('hid-f3');
  var position4 = document.getElementById('hid-f4');

  if (($('.pdf1').hasClass('fixerror')) || (position1 && position1.value)) {
    $(".pdf1").show();
  } else {
    $(".pdf1").hide();
  }
  if (($('.pdf2').hasClass('fixerror')) || (position2 && position2.value)) {
    $(".pdf2").show();
  } else {
    $(".pdf2").hide();
  }
  if (($('.pdf3').hasClass('fixerror')) || (position3 && position3.value)) {
    $(".pdf3").show();
  } else {
    $(".pdf3").hide();
  }
  if (($('.pdf4').hasClass('fixerror')) || (position4 && position4.value)) {
    $(".pdf4").show();
  } else {
    $(".pdf4").hide();
  }

  /* open the first available position when visitor wants to open another and reset message with appropriate positions available */
  $('#file-upload').click(function() {
    var open_files = $('.pdf-wrap:visible').length +1;
    var file_upload_txt = $(this).html();

      if ($('.pdf1').is(':hidden')) {
        $('.pdf1').slideDown();
        open_file_positions(open_files);
        return;
      }
      if ($('.pdf2').is(':hidden')) {
        $('.pdf2').slideDown();
        open_file_positions(open_files);
        return;
      }
      if ($('.pdf3').is(':hidden')) {
        $('.pdf3').slideDown();
        open_file_positions(open_files);
        return;
      }
      if ($('.pdf4').is(':hidden')) {
        $('.pdf4').slideDown();
        open_file_positions(open_files);
        return;
      }
  });

  /* unset values for hidden file name and label, remove position and reset message */
  $('.pdf-remove').click(function() {
    var open_files = $('.pdf-wrap:visible').length -1;
    var close_upload = $(this).closest('.pdf-wrap');

    if ((close_upload).hasClass('pdf1')) {
      $('#hid-f1').val('');
      $('.pdf1_name').val('');
      $('#pdf1').removeClass('fixerror');
      $('.pdf1').slideUp();
      open_file_positions(open_files);
    }
    if ((close_upload).hasClass('pdf2')) {
      $('#hid-f2').val('');
      $('.pdf2_name').val('');
      $('#pdf2').removeClass('fixerror');
      $('.pdf2').slideUp();
      open_file_positions(open_files);
    }
    if ((close_upload).hasClass('pdf3')) {
      $('#hid-f3').val('');
      $('.pdf3_name').val('');
      $('#pdf3').removeClass('fixerror');
      $('.pdf3').slideUp();
      open_file_positions(open_files);
    }
    if ((close_upload).hasClass('pdf4')) {
      $('#hid-f4').val('');
      $('.pdf4_name').val('');
      $('#pdf4').removeClass('fixerror');
      $('.pdf4').slideUp();
      open_file_positions(open_files);
    }
  });

  /* submit query, check for files > 2 MB. throw alert() error if failed and addClass fixerror. */
  $('#review-mtg, #update-mtg').click(function(e) {
    var file1 = document.getElementById('file1').files[0];
    var p1    = "1";
    var file2 = document.getElementById('file2').files[0];
    var p2    = "2";
    var file3 = document.getElementById('file3').files[0];
    var p3    = "3";
    var file4 = document.getElementById('file4').files[0];
    var p4    = "4";

    var pdf_err1 = document.getElementById('pdf1');
    var pdf_err2 = document.getElementById('pdf2');
    var pdf_err3 = document.getElementById('pdf3');
    var pdf_err4 = document.getElementById('pdf4');

    if (typeof file4 !== 'undefined') {
      if(file4 && file4.size <= 2097152) {
        // submit form
      } else {
        alert('Your file "' + file4.name + '" in position ' + p4 + ' is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.');
        pdf_err4.classList.add('fixerror');
        e.preventDefault();
      }
    }
    if (typeof file3 !== 'undefined') {
      if(file3 && file3.size <= 2097152) {
        // submit form
      } else {
        alert('Your file "' + file3.name + '" in position ' + p3 + ' is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.');
        pdf_err3.classList.add('fixerror');
        e.preventDefault();
      }
    }
    if (typeof file2 !== 'undefined') {
      if(file2 && file2.size <= 2097152) {
        // submit form
      } else {
        alert('Your file "' + file2.name + '" in position ' + p2 + ' is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.');
        pdf_err2.classList.add('fixerror');
        e.preventDefault();
      }
    }
    if (typeof file1 !== 'undefined') {
      if(file1 && file1.size <= 2097152) {
        // submit form
      } else {
        alert('Your file "' + file1.name + '" in position ' + p1 + ' is too large. The file size limit is 2 MB (2,048 KB). Please remove or replace in order to proceed.');
        pdf_err1.classList.add('fixerror');
        e.preventDefault();
      }
    }
  });


  /* defined below all other interaction with #file-upload or .pdf-remove in order to provide appropriate first page load content. everything else is dependent on a re-rendering after a click event. variable has to be defined here for the first run of the function so that it reads everything as is set when the page loads the first time. */
  var open_files = $('.pdf-wrap:visible').length;
  function open_file_positions(open_files) { 
    if (open_files == '0') {
      $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add a PDF | 4 total');
    }
    if (open_files == '1') {
      $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 3 remaining');
    }
    if (open_files == '2') {
      $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 2 remaining');
    }
    if (open_files == '3') {
      $('#file-upload').html('<i class="far fa-plus-square fa-fw"></i> Add another PDF | 1 remaining');
    }
    if (open_files == '4') {
      $('#file-upload').html('That\'s all');
    }
  }
  /* first pass to set message for appropriate number of positions available */ 
  open_file_positions(open_files);

    /* end file upload */




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
