				<!-- header -->
				<div id="header">
					<!-- logo -->
					<h1 id="logo">						
						<img src="resources/images/logo.png" />
					</h1>
					<div id="container-logged-user">
						<img src="resources/images/logged_user.png" hspace="5" />
						<?php
							if (isset($_SESSION['loggedUser'])) {
								echo $_SESSION['loggedUser']->getUSERNAME();
							}
						?> | <a id="link-logout" href="logout.php">logout</a>
					</div>
				</div>
	