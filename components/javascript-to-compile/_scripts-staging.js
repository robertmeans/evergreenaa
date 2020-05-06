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

// validate footer submission -> change eventually to use native validation
function validateEmail(emailStr) {
var emailPat=/^(.+)@(.+)$/
var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
var validChars="\[^\\s" + specialChars + "\]"
var quotedUser="(\"[^\"]*\")"
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
var atom=validChars + '+'
var word="(" + atom + "|" + quotedUser + ")"
var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
var matchArray=emailStr.match(emailPat)
if (document.forms[0].email.value == "")
      {
      alert("\nThe e-mail field is blank.\n\nPlease enter your e-mail address.")
      document.forms[0].email.focus()
      return false
}
if (matchArray==null) {
  /* Too many/few @'s or something; basically, this address doesn't
     even fit the general mould of a valid e-mail address. */
  alert("_____________________________\n\nYour e-mail address seems incorrect. Please check the following\n\n1. Did you include the \"@\" and the \" . \" (dot)?\n2. Did you include anything other than a \"@\" & \" . \"?\n\nPlease re-enter your e-mail address.\n_____________________________")
  document.forms[0].email.select();
    document.forms[0].email.focus();
  return false
}
var user=matchArray[1]
var domain=matchArray[2]
if (user.match(userPat)==null) {
    // user is not valid
    alert("_____________________________\n\nThe username does not seem to be valid.\n\nPlease check the following:\n\n1. That you entered your e-mail address correctly.\n\nThank you.\n_____________________________")
    document.forms[0].email.select();
    document.forms[0].email.focus();
    return false
}
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
    // this is an IP address
    for (var i=1;i<=4;i++) {
      if (IPArray[i]>255) {
          alert("_____________________________\n\nThe destination IP address you entered is invalid.\n\nPlease check your e-mail address and make the necessary corrections.\n\nThank you.\n_____________________________")
          document.forms[0].email.select();
      document.forms[0].email.focus();
    return false
      }
    }
    return true
}
var domainArray=domain.match(domainPat)
if (domainArray==null) {
  alert("_____________________________\n\nAre you making stuff up now?\n\nThe e-mail address portion of this form is not something to scoff at.\n\nI've been placed here in  your computer to make sure your information is valid. You\nneed to enter your real e-mail address or successfully fake me out to proceed.\n\nThank you.\n_____________________________")
  document.forms[0].email.select();
  document.forms[0].email.focus();
    return false
}
var atomPat=new RegExp(atom,"g")
var domArr=domain.match(atomPat)
var len=domArr.length
if (domArr[domArr.length-1].length<2 ||
    domArr[domArr.length-1].length>3) {
   // the address must end in a two letter or three letter word.
   alert("_____________________________\n\nYour e-mail address must end in a three-letter domain, or two letter country.\n\n_____________________________")
   document.forms[0].email.select();
   document.forms[0].email.focus();
   return false
}
if (len<2) {
   var errStr="_____________________________\n\nYour e-mail address is missing either a username, a hostname or a domain.\nAn e-mail address should include these three basic components:\n\n1. A username - (e.g., YOURNAME@yahoo.com, YOURNAME@mho.net)\n2. A host - (e.g., yourname@YAHOO.com, yourname@MHO.net)\n3. A domain - (e.g., yourname@yahoo.COM, yourname@mho.NET)\n\nPlease make the necessary corrections and press \"Send\".\n-- Thank you, The unforgiving script validating this e-mail field.\n\n_____________________________"
   alert(errStr)
   document.forms[0].email.select();
   document.forms[0].email.focus();
   return false
}
return true;
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
