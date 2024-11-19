$(window).on('load', function() {
  $(".preload").delay(250).fadeOut(750);
  /* $(".preload-dev").delay(250).fadeOut(750); */
  $(".preload-dev").delay(0).fadeOut(100);
  $(".preload-manage").delay(200).fadeOut(200);

  /* all internal analytics below */
  /* get page name without extension or query string */
  var page = window.location.href.split('?')[0].split('/').pop().split('.').shift();
  if (page === '') { page = 'index'; }
  if (page === 'manage') { page = 'dashboard'; }

  var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

  if (isMobile) {
    var device = 'mobile';
  } else {
    var device = 'desktop';
  }

  $.ajax({
    url: 'process-analytics.php',
    type: 'POST',
    data: {
      page: page,
      device: device
    } /* no success or fail actions necessary */
  });

});


