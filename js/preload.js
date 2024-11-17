$(window).on('load', function() {
  $(".preload").delay(250).fadeOut(750);
  /* $(".preload-dev").delay(250).fadeOut(750); */
  $(".preload-dev").delay(0).fadeOut(100);
  $(".preload-manage").delay(200).fadeOut(200);

  /* all internal analytics below */
  // var page = window.location.href.split('/').pop().slice(0, -4);
  var page = window.location.href.split('?')[0].split('/').pop().split('.').shift();
  if (page === '') { page = 'index'; }
  if (page === 'manage') { page = 'dashboard'; }

  $.ajax({
    url: 'process-analytics.php',
    type: 'POST',
    data: {
      page: page
    } /* no success or fail actions necessary */
  });

});


