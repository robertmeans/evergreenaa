<!DOCTYPE html>
<html lang="en">
<!--

	♥ Hand coded with love by EvergreenBob.com

-->
<head>
	<meta charset="UTF-8">	
	
	<title>Evergreen AA | Local AA Meetings</title>
	<link rel="icon" type="image/ico" href="_images/favicon.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="A convenient utility to consolidate and organize all of your AA meeting information in one location.">
	<meta name="format-detection" content="telephone=no">

	<meta property="og:url" content="https://evergreenaa.com/" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Evergreen AA | Local AA Meetings" />
	<meta property="og:image" content="https://evergreenaa.com/_images/aa-logo.jpg" />
	<meta property="og:image:alt" content="AA Logo" />
	<meta property="og:description" content="A convenient utility to consolidate and organize all of your AA meeting information in one location." />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css">
	<link href='https://fonts.googleapis.com/css?family=Architects+Daughter|Cinzel|Courier+Prime|Special+Elite|Caveat&display=block' rel='stylesheet' type='text/css'>

  <?php $theme = configure_theme(); ?>
  <?php if ($theme == '0') { ?>
	 <link rel="stylesheet" href="style-dark.css?<?php echo time(); ?>" type="text/css">
  <?php } else { ?>
    <link rel="stylesheet" href="style-light.css?<?php echo time(); ?>" type="text/css">
  <?php } ?>

	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/jquery_1-12-1_ui_min.js"></script>

  <?php
  if (WWW_ROOT != 'http://localhost/evergreenaa') { ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LW85QCP3GZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-LW85QCP3GZ');
    </script>
  <?php } ?>

	<script src="js/preload.js?<?php echo time(); ?>"></script>
</head>
