// all things backstretch are in jquery.backstretch.min.js

// fundraiser GoFundMe $115 02.05.21
// $(document).ready(function() {
//   $('.foot').click(function() {
//       if($('.foot').hasClass('slide-up')) {
//         $('.foot').addClass('slide-down', 250, 'linear');
//         $('.foot').removeClass('slide-up'); 
//       } else {
//         $('.foot').removeClass('slide-down');
//         $('.foot').addClass('slide-up', 250, 'linear'); 
//       }
//   });
// });

// Navigation
$(document).ready(function() {
  var url = window.location.href;
  $('#url').val(url);

  $('.top-nav').on('click', function() {
    this.classList.toggle('acty');
  });
}); 

function openNav() {
  var eotw = document.getElementById("side-nav");
  if (eotw.style.width == '300px') { 
    $('#side-nav-bkg').fadeOut(501);
    eotw.style.width = '0px';
  } else {
    $('#side-nav-bkg').fadeIn(0);
    eotw.style.width = '300px';
  }
}
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("side-nav").style.width = "0";
    $('#side-nav-bkg').fadeOut(501);
    $('.top-nav').removeClass('acty');
}
/* function to close nav to use everywhere */
function close_navigation_first() {
  var eotw = document.getElementById("side-nav");
  if (eotw.style.width == '300px') { 
    $('#side-nav-bkg').fadeOut(501);
    $('.top-nav').removeClass('acty');
    eotw.style.width = '0px';
    stopPropagation();
    }  
}

$(document).ready(function(){
  $("#toggle-msg-one").click(function(e) {
      e.preventDefault();
      e.stopPropagation();

    if ($('#msg-one').is(':hidden')) {
        $("#msg-one").fadeIn(500);
    } else {
        $("#msg-one").fadeOut(500); 
    }
  });
  $("#toggle-why-join").click(function(e) {
      e.preventDefault();
      e.stopPropagation();

    if ($('#why-join').is(':hidden')) {
        $("#why-join").fadeIn(500);
    } else {
        $("#why-join").fadeOut(500); 
    }
  });

  $("#toggle-role-key").click(function(e) {
      e.preventDefault();
      e.stopPropagation();

    if ($('#role-key').is(':hidden')) {
        $("#role-key").fadeIn(500);
    } else {
        $("#role-key").fadeOut(500); 
    }
  });
  $("#toggle-gottajoin").click(function(e) {
      e.preventDefault();
      e.stopPropagation();

    if ($('#gottajoin').is(':hidden')) {
        $("#gottajoin").fadeIn(500);
    } else {
        $("#gottajoin").fadeOut(500); 
    }
  });
  $("#toggle-mb-notes").click(function(e) {
      e.preventDefault();
      e.stopPropagation();

    if ($('#mb-notes').is(':hidden')) {
        $("#mb-notes").fadeIn(500);
    } else {
        $("#mb-notes").fadeOut(500); 
    }
  });  

});

$(document).click(function() {
  var eotw = document.getElementById("side-nav");

  if($('#msg-one').is(':visible')) {
    $("#msg-one").fadeOut(500);

  } else if ($('#role-key').is(':visible')) {
    $("#role-key").fadeOut(500);

  } else if ($('#why-join').is(':visible')) {
    $("#why-join").fadeOut(500);
  } else if ($('#gottajoin').is(':visible')) {
    $("#gottajoin").fadeOut(500);

  } else if ($('#mb-notes').is(':visible')) {
    $("#mb-notes").fadeOut(500); 

  } else if ($('#lat-long').is(':visible')) {
    $("#lat-long").fadeOut(500);
  } else if ($('#desc-loc').is(':visible')) {
    $("#desc-loc").fadeOut(500);
  } else if ($('#pdf-upload').is(':visible')) {
    $("#pdf-upload").fadeOut(500);
  } else if ($('#link-label').is(':visible')) {
    $("#link-label").fadeOut(500);
  } else if (eotw.style.width == '300px') {
    closeNav();
  }
});

$(".top-nav").click(function(e) {
  e.stopPropagation();
});
$(".nav-active").click(function(e) {
  e.preventDefault();
  e.stopPropagation();
});

$(document).ready(function(){
  $('#usr-role-go').click(function() {
    close_navigation_first();
    // var thisval = $('#mng-usr').val().substr(0, $('#mng-usr').val().indexOf(','));
    var thisval = $('#mng-usr').val();

    if (thisval != 'empty') {
      window.location = thisval;
    } 
  })
  $('#usr-role-goz').click(function() {
    close_navigation_first();
    var thisval = $('#mng-usrz').val();
    
    if (thisval != 'empty') {
      window.location = thisval;
    }
  })
    $('#usr-role-gozz').click(function() {
    close_navigation_first();
    var thisval = $('#mng-usrzz').val();
    
    if (thisval != 'empty') {
      window.location = thisval;
    }
  }) 
});

// edit or update sus_notes suspension reason on user_management.php
// pretty nice if I say so myself. :)
$(document).ready(function() {
  $(document).on('click','a[data-role=rnote]',function() { // clicked on edit note
    close_navigation_first();
    var id = $(this).data('id');
    var user_id = $('#uid_'+id).html();

    if ($('#round2_'+id).html().length) {
      /* if this one has already been edited on this screen, the edited version will have been captured and stored in #round2_$id (which treats the breaks differently since js uses \n for a return whereas php uses <br>) so let's use that version. (note: the trim() is redundant here since it's applied before submitting to db in the processing script but wth...) - display on the front end is handled via css -> .sus-notes, .note-reason, #sus-note {white-space: pre-wrap;} in order to preserve spaces *after* the 1st line. */
      var r_note = $('#'+id).html().replaceAll('<br>', '\n').replaceAll('<br><br>', '\n\n').trim();
    } else {
      /* otherwise, this is their first pass at editing this so we're dealing with just the php version of line breaks. */
      var r_note = $('#'+id).html().replaceAll('<br>\n', '\n').replaceAll('<br>\n<br>', '\n').trim();
    }

    $('#'+id).addClass('formhere');
    $('#'+id).html('<form id="revise-sus-note"><textarea id="sus-note" name="reason" maxlength="250">'+r_note+'</textarea><input type="hidden" name="user-id" value="'+user_id+'"></form>');

    $('#a_'+id).html('<a data-id="'+id+'" data-role="unote" class="reason-note rt sicon"><div class="tooltip"><span class="tooltiptext type">Save Edit</span><i class="far fa-save"></i></div></a> <a data-role="cnote" data-id="'+id+'" class="reason-note rt cicon"><div class="tooltip right"><span class="tooltiptext type">Cancel Edit</span><i class="fas fa-ban"></i></div></a>'); // edit icon replaced with cancel & save (update note)
  })

  $(document).on('click','a[data-role=cnote]',function() { // cancel update
    close_navigation_first();
    var id = $(this).data('id');

    if ($('#round2_'+id).html().length) {
      var original_note = $('#round2_'+id).html();
    } else {
      var original_note = $('#on_'+id).html();
    }

    $('#error_'+id).html('');
    $('#'+id).html(original_note);
    $('#a_'+id).html('<a data-id="'+id+'" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right"><span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>');
    $('#'+id).removeClass('formhere');

  })

  $(document).on('click','a[data-role=unote]',function() { // save (or update note)
    close_navigation_first();
    var id = $(this).data('id');
    var new_note = $('#sus-note').val().replaceAll('\n', '<br>').trim();
    
    $.ajax({
      dataType: "JSON",
      url: "process-edit-sus_note.php",
      type: "POST",
      data: $('#revise-sus-note').serialize(),
      beforeSend: function(xhr) {
        // unnecessarily clutters up the (very quick) update process by putting stuff here
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          // console.log(response);
          if(response['signal'] == 'ok') {
          $('#a_'+id).html('<a data-id="'+id+'" data-role="rnote" class="reason-note rt eicon"><div class="tooltip right"><span class="tooltiptext type">Edit Note</span><i class="far fa-edit"></i></div></a>');
          $('#'+id).removeClass('formhere');
          $('#'+id).removeClass('emsg');
          $('#error_'+id).html('');
          $('#'+id).html(new_note);
          $('#round2_'+id).html(new_note);
          } else {
            $('#error_'+id).html('<div class="alert alert-warning ump">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#'+id).html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>');
      }, 
      complete: function() {
      }
    }) // end ajax
  }) // end click unote

});

// copy to clipboard ID: data-role=ci
$(document).ready(function() {

  // clipboard for ID & BCC email addresses
  $(document).on('click','a[data-role=ic]',function() {
    var id   = $(this).data('id');
    var text = document.getElementById(id).value;

    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);

    var originalIcon = "<i class=\"far fa-arrow-alt-circle-up\"></i> Copy ID</a>";
    var changeBack  = $(this);

    $(this).html("<i class=\"fas fa-check fa-fw\"></i> ID Copied!");
    $(this).addClass('copied');

    setTimeout(function() {
      changeBack.removeClass('copied');
      changeBack.html(originalIcon);
    }, 1000);
 
  });

  // clipboard for password
  $(document).on('click','a[data-role=pc]',function() {
    var id   = $(this).data('id');
    var text = document.getElementById(id).value;

    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);

    var originalIcon = "<i class=\"far fa-arrow-alt-circle-up\"></i> Copy Password</a>";
    var changeBack  = $(this);

    $(this).html("<i class=\"fas fa-check fa-fw\"></i> Password Copied!");
    $(this).addClass('copied');

    setTimeout(function() {
      changeBack.removeClass('copied');
      changeBack.html(originalIcon);
    }, 1000);
 
  });

  // clipboard for BCC email addresses
  $(document).on('click','a[data-role=em]',function() {
    var id   = $(this).data('id');
    var text = document.getElementById(id).value;

    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);

    var originalIcon = "<i class=\"far fa-copy\"></i> Copy Addresses</a>";
    var changeBack  = $(this);

    $(this).html("<i class=\"fas fa-check fa-fw\"></i> Addresses Copied!");
    $(this).addClass('copied');

    setTimeout(function() {
      changeBack.removeClass('copied');
      changeBack.html(originalIcon);
    }, 1000);
 
  });


});

/* initialize timepicker */
/* https://timepicker.co/options/ */
$(document).ready(function() {
    $('input.timepicker').timepicker({
    timeFormat: 'h:mm p',
    dynamic: false,
    dropdown: false,
    scrollbar: false
    });
});

/* visible divs as radio buttons */
$('.radio-group .radio').click(function(){
    close_navigation_first();

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
$("#showLoginPass").click(function(){
  close_navigation_first();
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

$("#showSignupPass").click(function(){
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

  $("#side-nav-bkg").hide();
  $(".day-content").hide();
  $(".weekday-wrap").hide();
  $("#msg-one").hide();
  $("#why-join").hide();
  $("#gottajoin").hide();
  $("#mb-notes").hide();
  // $("#reply-spot").hide();
  $("#role-key").hide();
  $("#lat-long").hide();
  $("#desc-loc").hide();
  $("#pdf-upload").hide();
  $("#link-label").hide();
  $("#sus-reason").hide();
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
    close_navigation_first();
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
    close_navigation_first();
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
    close_navigation_first();
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
    close_navigation_first();
    var me = $(this);

    $('.day-content').not(me).slideUp();
    $('.day').removeClass('active');
  });

  $("#toggle-contact-form").click(function(){
    close_navigation_first();

      $(this).toggleClass("active").next().slideToggle(600);

      if ($.trim($(this).text()) === 'close') {
         // $(this).html('<i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i>');
         $(this).html('comments | questions | suggestions');
      } else {
          // $(this).html('<i class="fa fa-times-circle close-left" aria-hidden="true"></i> close <i class="fa fa-times-circle close-right" aria-hidden="true"></i>');
          $(this).html('close');
      }
    return false;
  })
}); /* document.ready end */

// setTimeout(function() {
//   $("#success-wrap").fadeOut(1500);
// }, 2000);


// toggle lat, long coordinates explanation on 
// _includes/edit-details.php page
$("#toggle-lat-long-msg").click(function(e) {
  $("#lat-long").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});

$("#toggle-descriptive-location").click(function(e) {
  $("#desc-loc").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});

$("#toggle-pdf-info").click(function(e) {
  $("#pdf-upload").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});

$("#toggle-link-label").click(function(e) {
  $("#link-label").fadeIn(500);
    e.preventDefault();
    e.stopPropagation();
});

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
        $('#msg').html('<span class="email-me">Sending - one moment...</span>');
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

// email host modal
$(document).ready(function() {
  $(document).on('click','a[data-role=emh]', function() {

    var id         = $(this).data('id');
    var mtgid      = $('#'+id).children('span[data-target=mtgid]').text();
    var mtgtime    = $('#'+id).children('span[data-target=mtgtime]').text();
    var mtgday    = $('#'+id).children('span[data-target=mtgday]').text();
    var mtgname    = $('#'+id).children('span[data-target=mtgname]').text();

    var theModal   = document.getElementById("theModal");

    $('#mtgid').val(mtgid);
    $('#mtgname').html(mtgtime + ', ' + mtgday + ' - ' + mtgname);
    $('#mtgnamez').val(mtgtime + ', ' + mtgday + ' - ' + mtgname);
    $('#your-name').html('Your name<input name="name" id="emh-name" class="edit-input link-name" type="text" maxlength="30">');
    $('#your-email').html('Your email<input name="email" id="emh-email" class="edit-input link-email" type="email" maxlength="250">');
    $('#msg-title').html('Message the host of:');
    $('#msg-label').html('Message');
    $('#submit-links').html('<input type="button" id="emh-btn" class="send" value="Send">');

    $('body').addClass('noscrollz');
    theModal.style.display = "block";
  });

  if ($(".closefp")[0]) {
    var closefp = document.getElementsByClassName("closefp")[0];
    closefp.onclick = function() {

      $('#emh-contact').html('<input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="mtgname" id="mtgnamez"><label id="your-name"></label><label id="your-email"></label><label><span id="msg-label"></span><textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea></label><div id="emh-contact-msg"></div><div id="submit-links" class="submit-links"></div>');

      $('body').removeClass('noscrollz');
      theModal.style.display = "none";
    }
  }

// email host submit
  $(document).on('click','#emh-btn', function() {

    $.ajax({
      dataType: "JSON",
      url: "contact-host-process.php",
      type: "POST",
      data: $('#emh-contact').serialize(),
      beforeSend: function(xhr) {
        $('#emh-contact-msg').html('<span class="sending-msg">Sending - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#emh-contact').html('<span class="success-emh">Your message was sent successfully.</span>');
          } else {
            $('#emh-contact-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#emh-contact-msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {

      }
    })
  });
});

















// log issue modal
$(document).ready(function() {
  $(document).on('click','a[data-role=logissue]', function() {

    var id         = $(this).data('id');
    var mtgid      = $('#'+id).children('span[data-target=mtgid]').text();
    var mtgtime    = $('#'+id).children('span[data-target=mtgtime]').text();
    var mtgday    = $('#'+id).children('span[data-target=mtgday]').text();
    var mtgname    = $('#'+id).children('span[data-target=mtgname]').text();
    var user_id    = $('#'+id).children('span[data-target=tuid]').text();
    var num_issues    = $('#'+id).children('span[data-target=ri]').text();
    // var id_for_submit  = $('#'+id+'_er');
    var id_for_submit = id+'_er';
    var theModal   = document.getElementById("theModal");

    if (user_id != 'ns') { // ns = not set
      $('#tuid').val(user_id);
      $('#mtgid').val(mtgid);
      $('#mtgname').html(mtgtime + ', ' + mtgday + ' - ' + mtgname);
      $('#mtgnamez').val(mtgtime + ', ' + mtgday + ' - ' + mtgname);
      $('#ri').val(num_issues);
      $('#msg-title').html('Abandoned meeting? Broken links?<div class="issue-header">Submitting this form will post an alert on this meeting to notify all visitors of an issue and will email the Host to give them the opportunity to fix it. 3 issues without a response from the Host will remove the meeting from the site.</div>');
      $('#your-name').html('');
      $('#your-email').html('');
      $('#msg-label').html('Describe issue');
      $('#submit-links').html('<input type="button" id="issue-btn" data-id="'+id_for_submit+'" class="send" value="Submit">');
    } else { // user_id is not set
      $('#emh-contact').html('<div class="log-issue-public">Logging issues is an integral part of keeping the information on this site reliable. As it carries a fair amount of responsibility on the part of the one reporting an issue, and to prevent it from being abused, this feature is available only while you are logged in. <div class="login-links"><a class="extras" href="login.php">Login</a><a class="extras" href="signup.php">Join</a></div></div>');
    }



    $('body').addClass('noscrollz');
    theModal.style.display = "block";
  });

  // if this user has already logged an issue about this meeting they can't log another
  $(document).on('click','a[data-role=logissued]', function() {

    var id         = $(this).data('id');
    var theModal   = document.getElementById("theModal");

    $('#emh-contact').html('<div class="log-issue-public">You have already logged an issue about this meeting. The Host has been notified and if 2 more users log unanswered issues about this meeting it will be removed from the site.</div>');

    $('body').addClass('noscrollz');
    theModal.style.display = "block";
  });

  if ($(".closefp")[0]) {
    var closefp = document.getElementsByClassName("closefp")[0];
    closefp.onclick = function() {

      $('#emh-contact').html('<input type="hidden" name="tuid" id="tuid"><input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="mtgname" id="mtgnamez"><input type="hidden" name="ri" id="ri"><label id="your-name"></label><label id="your-email"></label><label><span id="msg-label"></span><textarea name="emhmsg" id="emh-msg" class="edit-input link-msg" maxlength="2000"></textarea></label><div id="emh-contact-msg"></div><div id="submit-links" data-id="" class="submit-links"></div>');

      $('body').removeClass('noscrollz');
      theModal.style.display = "none";
    }
  }

// log issue submit
  $(document).on('click','#issue-btn', function() {
    var id         = $(this).data('id');

    $.ajax({
      dataType: "JSON",
      url: "log-issue-process.php",
      type: "POST",
      data: $('#emh-contact').serialize(),
      beforeSend: function(xhr) {
        $('#emh-contact-msg').html('<span class="sending-msg">Sending - one moment...</span>');
      },
      success: function(response) {
        console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#emh-contact').html('<span class="success-emh">The issue was noted successfully.</span>');
            $('#'+id).addClass('errors-reported');

            if ($('#'+id).html().indexOf("There has been an issue reported") >= 0) {
              $('#'+id).html('Attention: There have been 2 issues reported with this meeting that the Host has not addressed yet. If you find the meeting abandoned or any of the links do not work correctly please use the link above, "Log issue" to help keep the information on this site reliable. If 3 issues go unaddressed the meeting will be removed from the site until the necessary corrections are made.');
            } else if ($('#'+id).html().indexOf("There have been 2 issues reported") >= 0) {
              $('#'+id).html('The issue you logged has tipped the scale. If you refresh your browser this meeting is no longer available for public view and will remain hidden until the Host addresses the issue(s).'); 
            }  else {
              $('#'+id).html('Attention: There has been an issue reported with this meeting that the Host has not addressed yet. If you find the meeting abandoned or any of the links do not work correctly please use the link above, "Log issue" to help keep the information on this site reliable. If 3 issues go unaddressed the meeting will be removed from the site until the necessary corrections are made.'); 
            }

          } else {
            $('#emh-contact-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#emh-contact-msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {

      }
    })
  });

});


// message board modal
// email host modal
$(document).ready(function() { // 0829210847
  // open modal
  $(document).on('click','a[data-role=mb]', function() {
    var id         = $(this).data('id');
    $('body').addClass('noscrollz');
    theModal.style.display = "block";
  });

  // submit post
  $(document).on('click','#mb-new', function() {
    // event.preventDefault();
    var username = $('#user-posting').val();
    var title = $('#mb-title').val();
    var post = $('#emh-msg').val(); 
    var numberOfLineBreaks = (post.match(/\n/g)||[]).length;

    if ((numberOfLineBreaks > 0) || (post.trim().length > 80)) {
      var body = post.split('\n', 1)[0].substring(0,80) + '...';  
    } else if (post.trim().length > 80) {
      var body = post.substring(0,80) + '...';
    } else {
      var body = post;
    }

    if (numberOfLineBreaks > 6) {
      $('#emh-contact-msg').html('<div class="alert alert-warning">Tighten that up please. Too many line breaks (6 tops). Trying to avoid those long posts where people exploit the carriage return.</div>');
      return;
    }
    if (title.trim().length == 0) {
      $('#emh-contact-msg').html('<div class="alert alert-warning">You need a Title for your post.</div>');
      $('#mb-title').addClass('alert');
      return;
    }

    if (post.trim().length == 0) {
      $('#emh-contact-msg').html('<div class="alert alert-warning">You need some content for your post.</div>');
      $('#emh-msg').addClass('alert');
      return;
    }

    $.ajax({
      dataType: "JSON",
      url: "process-mb.php",
      type: "POST",
      data: $('#mb').serialize(),
      beforeSend: function(xhr) {
        $('#emh-contact-msg').html('<span class="sending-msg">Posting - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {

            $('#mb').html('<input type="hidden" name="mtgid" id="mtgid"><input type="hidden" name="mtgname" id="mtgnamez"><input type="hidden" id="user-posting" value="'+username+'"><label>Title | Topic | Headline<input id="mb-title" name="mb-title" class="edit-input link-name" type="text" maxlength="50"></label><label>Body<textarea name="mb-post" id="emh-msg" class="edit-input link-msg" maxlength="250"></textarea></label><div id="emh-contact-msg"></div><div class="submit-links"><input type="button" id="mb-new" class="send" value="Post it"></div>');
            $('#theModal').hide();
            $('body').removeClass('noscrollz');

            $('#empty-posts').html('');
            $('#post-topics').prepend('<li style="border-bottom:1px dashed rgba(255,255,255,0.4);"><p class="mb-date">Just now | '+username.charAt(0)+'... Posted:</p><p class="title">'+title+'</p><p class="mb-body">'+body+'</p></li>');
          } else {
            $('#emh-contact-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#emh-contact-msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {
      }
    })
  });  

  // submit form to go to post
  $(document).on('click', 'a[data-role=go-to-post]', function() {
    var id = $(this).data('id');
    // var pid = $('#pid_'+id).val();
    // alert(pid);
    $('#'+id).submit();
  });

// delete post
  $(document).on('click', 'a[data-role=delete-post]', function() {

    var id = $(this).data('id');
    var li_id = id.substring(id.indexOf('_') + 1);
    var post_pg = $('#ybcwpb');

    $.ajax({
      dataType: "JSON",
      url: "process-delete-mb-post.php",
      type: "POST",
      data: $('#'+id).serialize(),
      beforeSend: function(xhr) {
        // $('#emh-contact-msg').html('<span class="sending-msg">Posting - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            if (post_pg) {
              // deleted post from single post page ->
              // send them back to message-board.php 
              window.location.href = 'message-board.php'; 
            } else {
              // deleted post from message-board.php page
              // remove from list of other posts
              $('#li_'+li_id).remove();                          
            }

          } else {
            //$('#li_'+id).html('<div class="alert alert-warning">' + response['msg'] + '</div>');

          }
        } 
      },
      error: function() {
        $('#emh-contact-msg').html('<div class="alert alert-warning">There was an error between your IP and the server. Please try again later.</div>');
      }, 
      complete: function() {

      }
    })
  });

// located in the pages preceding them
// message-board.php: $('#post-topics').load('load-message-board.php');
// post.php:          $('#replies').load('load-posts.php');
// ^^ those 2 are for background loding
// post.php:          $(document).on('click', 'a[data-role=delete-reply]', function()...
// post.php:          $(document).on('click', '#toggle-post-reply', function() ...
// post.php:          $(document).on('click','#reply', function() ...

}); // 0829210847

// Transfer Meeting and User Management tabs to separate
// username from email dropdown lists in order to keep
// beautiful and work in mobile
// $( function() {
//   $( "#tabs" ).tabs();
// } );
$(document).ready(function() {
  $('.tab').hide();
  $('.tab.focus').show();

  $('.tabs .tab-links a').on('click', function(e)  {
    close_navigation_first();
    var currentAttrValue = $(this).attr('href');

      $('.tabs ' + currentAttrValue).slideDown(400).siblings().slideUp(400);
      $(this).parent('li').addClass('focus').siblings().removeClass('focus');

      e.preventDefault();
  });
});

// Transfer Meeting & User Management stuff
$(document).ready(function() {
  $(document).on('change','#transfer-usr', function() {
    var update = $('#transfer-usr').val().substr($('#transfer-usr').val().indexOf(',') + 1);
    var updateun = $('#transfer-usr').val().substr(0, $('#transfer-usr').val().indexOf(','));
    var updateft = '<p>Email: ' +  $('#transfer-usr').val().substr($('#transfer-usr').val().indexOf(',') + 1) + '</p>';
    if (update != 'empty') {
      $('#flash-email-top').html(updateft);
      $('#new-email-top').val(update);
      $('#new-usrnm-top').val(updateun);
    } else {
      $('#new-email-top').val('empty');
      $('#flash-email-top').html('');
    }
  })

  $(document).on('change','#transfer-usrz', function() {
    var update = $('#transfer-usrz').val().substr($('#transfer-usrz').val().indexOf(',') + 1);
    var updateun = $('#transfer-usrz').val().substr(0, $('#transfer-usrz').val().indexOf(','));
    var updateut = '<p>Username: ' +  $('#transfer-usrz').val().substr(0, $('#transfer-usrz').val().indexOf(',')) + '</p>';
    if (update != 'empty') {
      $('#flash-username-top').html(updateut);
      $('#new-email-topz').val(update);
      $('#new-usrnm-topz').val(updateun);
    } else {
      $('#new-email-topz').val('empty');
      $('#flash-username-top').html('');
    }
  })  

  $(document).on('change','#mng-usr', function() {
    var update = $('#mng-usr').val().substr($('#mng-usr').val().indexOf(',') + 1);
    var updateem = '<p>Email: ' +  $('#mng-usr').val().substr($('#mng-usr').val().indexOf(',') + 1) + '</p>';
    if (update != 'empty') {
      $('#um-email-top').html(updateem);
    } else {
      $('#um-email-top').html('');
    }
  })

  $(document).on('change','#mng-usrz', function() {
    var update = $('#mng-usrz').val().substr($('#mng-usrz').val().indexOf(',') + 1);
    var updateun = '<p>Username: ' +  $('#mng-usrz').val().substr($('#mng-usrz').val().indexOf(',') + 1) + '</p>';
    if (update != 'empty') {
      $('#um-un-btm').html(updateun);
    } else {
      $('#um-un-btm').html('');
    }
  })

    $(document).on('change','#mng-usrzz', function() {
    var update = $('#mng-usrzz').val().substr($('#mng-usrzz').val().indexOf(',') + 1);
    var updateun = '<p>Email: ' +  $('#mng-usrzz').val().split(',')[2].substr($('#mng-usrzz').val()) + '</p>';
    if (update != 'empty') {
      $('#um-un-btmz').html(updateun);
    } else {
      $('#um-un-btmz').html('');
    }
  })  

  $('#whoops').click(function() {
    close_navigation_first();    
    location.reload();
  })
});


// transfer top form for admin use only
// all 3 versions of transfer-meeting contained in this doc.ready
$(document).ready(function() {
  // selected by username
  $(document).on('click','#transfer-this-top', function() {
    close_navigation_first();
    var new_username = $('#new-usrnm-top').val();
    var new_host = $('#new-email-top').val();

    $.ajax({
      dataType: "JSON",
      url: "process-transfer-meeting.php",
      type: "POST",
      data: $('#transfer-form-top').serialize(),
      beforeSend: function(xhr) {
        $('#trans-msg').html('<span class="sending-msg">Transferring - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#trans-h2').html('Meeting Transferred');
            $('#current-host').html('New Host: ' + new_username + ' &bullet; ' + new_host);
            $('#tabs').html('');
            $('#transfer-form').html('');
            $('#hide-on-success').html('');
            $('#transfer-form-top').html('');
            $('#trans-msg').html('<span class="sending-msg">Transfer successful!</span>');
            $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            $('#th-btn').html('');
          } else {
            $('#trans-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#trans-msg').html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>');
      }, 
      complete: function() {

      }
    })
  });

  // selected by email
  $(document).on('click','#transfer-this-topz', function() {
    close_navigation_first();
    var new_username = $('#new-usrnm-topz').val();
    var new_host = $('#new-email-topz').val();

    $.ajax({
      dataType: "JSON",
      url: "process-transfer-meeting.php",
      type: "POST",
      data: $('#transfer-form-topz').serialize(),
      beforeSend: function(xhr) {
        $('#trans-msg').html('<span class="sending-msg">Transferring - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#trans-h2').html('Meeting Transferred');
            $('#current-host').html('New Host: ' + new_username + ' &bullet; ' + new_host);
            $('#tabs').html('');
            $('#transfer-form').html('');
            $('#hide-on-success').html('');
            $('#transfer-form-top').html('');
            $('#trans-msg').html('<span class="sending-msg">Transfer successful!</span>');
            $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            $('#th-btn').html('');
          } else {
            $('#trans-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#trans-msg').html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>');
      }, 
      complete: function() {

      }
    })
  });

  // this is the only one that a Member will see
  // the others are for admin
  $(document).on('click','#transfer-this', function() {
    close_navigation_first();
    var new_host = $('#new-email').val();

    $.ajax({
      dataType: "JSON",
      url: "process-transfer-meeting.php",
      type: "POST",
      data: $('#transfer-form').serialize(),
      beforeSend: function(xhr) {
        $('#trans-msg').html('<span class="sending-msg">Transferring - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == 'ok') {
            $('#trans-h2').html('Meeting Transferred');
            $('#current-host').html('New Host: ' + new_host);
            $('#tabs').html('');
            $('#transfer-form').html('');
            $('#transfer-form-top').html('');
            $('#hide-on-success').html('');
            $('#trans-msg').html('<span class="sending-msg">Transfer successful!</span>');

            // 0823211116
            if ($('#imnadmin').length) { // only shows on page if $_SESSION['admin'] != 0
            // don't show reload link if they're not admin.
              $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            } 

            $('#th-btn').html('');
          } else {
            $('#trans-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#trans-msg').html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>');
      }, 
      complete: function() {

      }
    })
  });
});

/* visible divs as radio buttons for User Management */
$('.radio-groupz .radioz').click(function(){
    close_navigation_first();
    var sus_note = $('#sus-note').val();
  // The Stanton Mandate:
  // See that links toggle on and off 
  if ($(this).hasClass('user-suspended') && $(this).hasClass('selected')) {
    ($(this).toggleClass('user-suspended') && $(this).toggleClass('selected'));
    $('#role-h2').toggleClass('downgrade');
    $('#sus-reason').slideToggle();
    $('#gdtrfb').html('<a id="select-role-first">Select a User Role</a>');
    return;
  }
  if ($(this).hasClass('selected')) {
    $(this).toggleClass('selected');
    $('#gdtrfb').html('<a id="select-role-first">Select a User Role</a>');
    return;
  }

    $(this).parent().find('.radioz').removeClass('selected');
    $(this).addClass('selected');
    var val = $(this).attr('value');
    //alert(val);
    $(this).parent().find('input[name=admin]').val(val);

    if ($(this).parent().find('input').val() == 0 || $(this).parent().find('input').val() == 2 || $(this).parent().find('input').val() == 3) {

        if ($('#sus-reason').is(':hidden')) {
          $('#gdtrfb').html('<a id="change-user-role">Change User Role</a>');
        } else {
            $(this).removeClass('user-suspended');
            $('#role-h2').removeClass('downgrade');
            $('#role-h2').addClass('upgrade');
            $('#gdtrfb').html('<a id="change-user-role">Change User Role</a>');
            $('#sus-reason').slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">' + sus_note + '</textarea>');
          }

        } 
      else if ($(this).parent().find('input').val() == 85) {
        if ($('#sus-reason').is(':hidden')) {
          $('#sus-reason').slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">' + sus_note + '</textarea>');
          $('#gdtrfb').html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>');
          $('#role-h2').removeClass('upgrade');
          $('#role-h2').addClass('downgrade');
          $(this).addClass('user-suspended');
        } else {
          $('#gdtrfb').html('<a id="suspend-user" class="user-suspended">Suspend User + Keep Meetings</a>');
          $(this).addClass('user-suspended');
        }

      } 
      else if ($(this).parent().find('input').val() == 86) {
        if ($('#sus-reason').is(':hidden')) {
          $('#sus-reason').slideToggle().html('<p>Reason</p><textarea name="reason" maxlength="250">' + sus_note + '</textarea>');
          $('#gdtrfb').html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>');
          $('#role-h2').removeClass('upgrade');
          $('#role-h2').addClass('downgrade');
          $(this).addClass('user-suspended');
        } else {
          $('#gdtrfb').html('<a id="suspend-user" class="user-suspended">Suspend User + Suspend Meetings</a>');
          $(this).addClass('user-suspended');
        }

      } else {
        $('#gdtrfb').html('<a id="select-role-first">You gotta pick a somethin</a>');
        $('#sus-reason').slideUp().html('');
      }
});


// Suspend user
$(document).ready(function() {
  //$('#emh-btn').click(function() {
  $(document).on('click','#suspend-user', function() {
    close_navigation_first();

    $.ajax({
      dataType: "JSON",
      url: "process_suspend_user.php",
      type: "POST",
      data: $('#suspend-form').serialize(),
      beforeSend: function(xhr) {
        $('#sus-msg').html('<span class="sending-msg">Working on it - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == '86') {
            $('#role-h2').html('User Demoted');
            $('#current-role').html('Suspended - All meetings set to Draft');
            $('#suspend-form').html('');
            $('#sus-msg').html('<span class="sending-msg downgraded">You done smoked that cat right up outta here!</span>');
            $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            $('#th-btn').html('');
          } else if(response['signal'] == '85') {
            $('#role-h2').html('User Demoted');
            $('#current-role').html('Suspended - Any meetings remain active');
            $('#suspend-form').html('');
            $('#sus-msg').html('<span class="sending-msg downgraded">User is suspended but their meetings remain.</span>');
            $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            $('#th-btn').html('');
          } else {
            $('#sus-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#sus-msg').html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>');
      }, 
      complete: function() {

      }
    }) // end ajax call process_suspend_user.php
  }); // end click function
}); // end document.ready

// change user role
$(document).ready(function() {
  //$('#emh-btn').click(function() {
  $(document).on('click','#change-user-role', function() {
    close_navigation_first();

    $.ajax({
      dataType: "JSON",
      url: "process_change_role.php",
      type: "POST",
      data: $('#suspend-form').serialize(),
      beforeSend: function(xhr) {
        $('#sus-msg').html('<span class="sending-msg">Working on it - one moment...</span>');
      },
      success: function(response) {
        // console.log(response);
        if(response) {
          console.log(response);
          if(response['signal'] == '2') {
            $('#role-h2').html('User Managed');
            $('#current-role').html('Level II Administrator');
            $('#suspend-form').html('');
            $('#sus-msg').html('<span class="sending-msg">User priviliges set to ADMIN Level II</span>');
            $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            $('#th-btn').html('');
          } else if(response['signal'] == '3') {
            $('#role-h2').html('User Managed');
            $('#current-role').html('Top Tier Administrator');
            $('#suspend-form').html('');
            $('#sus-msg').html('<span class="sending-msg">User priviliges set to ADMIN TOP TIER</span>');
            $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            $('#th-btn').html('');
          } else if(response['signal'] == '0') {
            $('#role-h2').html('User Managed');
            $('#current-role').html('Member');
            $('#suspend-form').html('');
            $('#sus-msg').html('<span class="sending-msg">User priviliges set to Member successfully</span>');
            $('#whoops').html('<span class="sending-msg whoops">Whoops! Re-assign that one.</span>');
            $('#th-btn').html('');
          } else {
            $('#sus-msg').html('<div class="alert alert-warning">' + response['msg'] + '</div>');
          }
        } 
      },
      error: function() {
        $('#sus-msg').html('<div class="alert alert-warning">There was an error somehow, somewhere and I don\'t think that worked. Refresh this page and try again.</div>');
      }, 
      complete: function() {

      }
    }) // end ajax call process_change_role.php
  }); // end click function
}); // end document.ready
