<nav>
	<ul>
		<!-- 1st link -->
		<li><?php
		switch ($layout_context) {
			case 'signup' 			:	 																			break;
			case 'reset-password' 	:	 																			break;
			case 'password-message' :	 																			break;
			case 'login-page' 		:	 																			break;
			case 'index' 			:	 																			break;
			case 'home-private' 	:	echo "<a id=\"toggle-private-msg-one\" class=\"cc-x\">Readme</a>"; 			break;
			case 'home-public' 		:	echo "<a id=\"toggle-public-msg-one\" class=\"cc-x why-join\">Readme</a>"; 	break;
			case 'forgot-password' 	:	 																			break;
			default 				:	 																			break;
		}
		?>
		</li>
		
		<!-- 2nd link... -->
		<li><?php
		switch ($layout_context) {
			case 'signup' 			:	echo "<a class=\"logout\" href=\"home.php\">Home</a>"; 					break;
			case 'reset-password' 	:	echo "<a class=\"logout\" href=\"home.php\">Home</a>"; 					break;
			case 'password-message' :	echo "<a class=\"logout\" href=\"home.php\">Home</a>"; 					break;
			case 'login-page' 		:	echo "<a class=\"logout\" href=\"home.php\">Home</a>"; 					break;
			case 'index' 			:	echo "<a class=\"logout\" href=\"home.php\">Home</a>"; 					break;
			case 'home-private' 	:	echo "<a class=\"logout\" href=\"logout.php\">Logout</a>"; 				break;
			case 'home-public' 		:	echo "<a class=\"logout\" href=\"login.php\">Login</a>"; 				break;
			case 'forgot-password' 	:	echo "<a class=\"logout\" href=\"home.php\">Home</a>"; 					break;
			default 				:	echo "<a class=\"logout\" href=\"home.php\">Home</a>"; 					break;
		}
		?>
		</li>
	</ul>
</nav>