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


/* open and close weekday content */

$(document).ready(function(){

$(".day-content").hide();
$(".weekday-wrap").hide();
$("#msg-one").hide();
$("#email-bob").hide();

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


$("#toggle-msg-one").click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    var open  = 'Close';
    var close = 'Readme';

  if ($('#msg-one').is(':hidden')) {
      $("#msg-one").fadeIn(500);
      $("#toggle-msg-one").html(open); 
  } else {
      $("#msg-one").fadeOut(500);
      $("#toggle-msg-one").html(close); 
  }

});


$(document).click(function() {
  var close    = 'Close';
  var open     = 'Readme';
  var open_two = 'Readme';

  $('#msg-one').fadeOut(500);
  $("#toggle-msg-one").html(open);

  $('#msg-one').fadeOut(500);
  $("#toggle-msg-one").html(open_two); 

});​



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