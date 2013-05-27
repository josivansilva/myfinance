<!DOCTYPE html>
<html>
	<?php include ("include/head.php");?>
	<script type="text/javascript">
 
		$(document).ready(function() {			  
		      $("#login-button").click(function(event) {
				  var controllerValue = $("#controller").val();
				  var actionValue     = $("#action").val();
				  var usernameValue   = $("#username").val();
				  var pwdValue        = $("#pwd").val();
				  if (isValidForm ()) {
					$.post ("classes/controller/FrontController.php",
					        { 
			        	  		controller: controllerValue,
			        	  		action:     actionValue,
				         		username:   usernameValue,
				         		pwd:        pwdValue
					        }, function (data) {								 
					        	 var isLogged = parseInt (data);
								 if (isLogged == 1) {
									 redirectTo ("launches.php");
						         } else {
						        	 showMessage (3, "Usuário ou Senha Inválidos.");
							     }
			             	}
			         );		
				  }				  
	      	  });
	   });

	   /**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidForm () {
			var isValid  = true;
			var username = $("#username").val();
			var pwd 	 = $("#pwd").val();
			if (isEmpty (username) || isEmpty (pwd)) {
				isValid = false;
				showMessage (2, "Por favor, preencha todos os campos.");
			}
			return isValid;
	   }		
 
	</script>	
	<body>		
		<!-- page -->
		<div id="page">				
			<!-- content -->
			<div id="main">			
				<!-- col 1 -->
				<div id="container-col-1">
					<div id="container-col-1-img">
						<img src="resources/images/login_img.png" />
					</div>
				</div>				
				<!-- col 2 -->
				<div id="container-col-2">
					<!-- container logo -->
					<div id="container-logo">
						<img src="resources/images/logo.png" />
					</div>
					<!-- container login -->
					<div id="container-login">
						<form id="loginForm" name="loginForm">
							<input type="hidden" name="controller" id="controller" value="UserController" />
							<input type="hidden" name="action" id="action" value="doLogin" />
							<!-- message container -->
							<div id="message-container" class="message-container" style="display: none;">
								<p id="message-paragraph" class="error-message"></p>
							</div>
							<div class="field-container">
								<input type="text" name="username" id="username" placeholder="nome do usuário" />
							</div>
							<div class="password-field-container">
								<input type="password" name="pwd" id="pwd" placeholder="senha" />
							</div>
							<div class="button-container">
								<input type="button" name="login-button" id="login-button" value="login" />
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php include ("include/footer.php");?>
		</div>
	</body>
</html>