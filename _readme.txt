

When launching:
* Change email templates in controllers/emailControllers and remove /testing from path
* Uncomment preload in home & home-private
* Uncomment msg-two (home.php) and msg-one (home_private.php)
* Comment footer & footer-static: localhost:35729/livereload
* Turn off error_reporting.php

-------------------------------

When performing sweeping updates (FTP everything to overwrite)
* Leave OUT:
	1. /config
	2. /vendor
	3. /_includes -> manually do this folder and leave out footers (?)

-------------------------------

PHP Version, Selector & Extensions:
_images/PHP_version-selector-extensions.jpg

Version: 7.1
Turned off mysqli and turned on nd_mysqli

-------------------------------

SwiftMailer connection string
$transport = (new Swift_SmtpTransport('smtpout.secureserver.net', 80))
// ^^ works with exchange email account and Email Routing set to Remote Mail Exchanger

-------------------------------

 