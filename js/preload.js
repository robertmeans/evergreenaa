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

  var deviceType = detectDeviceType(); /* declared in _scripts-staging.js */
  // console.log("Device Type: " + deviceType); 

  // Use the deviceType variable to customize your website's behavior
  if (deviceType === "mobile") {
    var device = 'mobile';
  } else if (deviceType === "tablet") {
     var device = 'tablet';
  } else {
     var device = 'desktop';
  }

  $.ajax({
    url: 'processing.php',
    method: 'POST', 
    dataType: 'text', 
    data: {
      primary_key: 'set',
      master_analytics_key: 'set',
      page: page,
      device: device
    } /* no success or fail actions necessary */
  });

});


