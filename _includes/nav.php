<nav>
	<ul>
		<!-- 1st link -->
		<?php
		switch ($layout_context) {
			case 'signup' 			:	 																						break;
			case 'reset-password' 	:	 																						break;
			case 'password-message' :	 																						break;
			case 'login-page' 		:	 																						break;
			case 'index' 			:	 																						break;
			case 'home-private' 	:	echo "<li><a id=\"toggle-msg-one\" class=\"cc-x\">Readme</a></li>"; 			break;
			case 'home-public' 		:	echo "<li><a id=\"toggle-msg-one\" class=\"cc-x why-join\">Readme</a></li>"; 	break;
			case 'forgot-password' 	:	 																						break;
			case 'edit-meeting' 	:	 																						break;
			default 				:	 																						break;
		}
		?>
		
		
		<!-- 2nd link... -->
		<?php
		switch ($layout_context) {
			case 'signup' 			:	echo "<li><a class=\"logout\" href=\"home.php\">Home</a></li>"; 					break;
			case 'reset-password' 	:	echo "<li><a class=\"logout\" href=\"home.php\">Home</a></li>"; 					break;
			case 'password-message' :	echo "<li><a class=\"logout\" href=\"home.php\">Home</a></li>"; 					break;
			case 'login-page' 		:	echo "<li><a class=\"logout\" href=\"home.php\">Home</a></li>"; 					break;
			case 'index' 			:	echo "<li><a class=\"logout\" href=\"home.php\">Home</a></li>"; 					break;
			case 'home-private' 	:	echo "<li><a class=\"logout\" href=\"logout.php\">Logout</a></li>"; 				break;
			case 'home-public' 		:	echo "<li><a class=\"logout\" href=\"login.php\">Login</a></li>"; 					break;
			case 'forgot-password' 	:	echo "<li><a class=\"logout\" href=\"home.php\">Home</a></li>"; 					break;
			case 'edit-meeting' 	:	echo "<li><a class=\"logout\" href=\"home_private.php\">Home</a></li>"; 			break;
			default 				:	echo "<li><a class=\"logout\" href=\"home.php\">Home</a></li>"; 					break;
		}
		?>
		
	</ul>
</nav>