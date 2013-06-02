<?php 
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");
include_once ("include/lock.php");
include_once ("include/lock_admin.php");
?>
<!DOCTYPE html>
<html>	
	<?php include ("include/head.php");?>
	<script type="text/javascript">

	  $(document).ready(function() {
		  	renderPagination (1);
	  		renderTable (1);
			$("#userTable td").live('click', function() {
				var id = $(this).attr('id');
				load (id);
		    });
			$("#update-user-button").click(function(event) {
		    	update ();
	      	});
	  });

	  /**
	   * Renders the pagination.
	  */
	  function renderPagination (pageNum) {
	   		var controllerValue = "UserController";
			var actionValue     = "renderPagination";
	        $.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		pageNumber: pageNum
			        }, function (data) {
						$('#container-table-navigation').html (data);						
					}
	         );
	   }

	   /**
		* Renders the user's as an HTML table.
		*/
	   function renderTable (pageNum) {
	   		var controllerValue = "UserController";
			var actionValue     = "renderTable";
			$.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		pageNumber: pageNum
			        }, function (data) {
						$('#container-table').html (data);
					}
	         );			
	   }

	   /**
		* Updates an user.
	    */
	   function update () {
		  var controllerValue = $("#controller").val();
		  var actionValue     = $("#action").val();
		  var idUserValue     = $("#idUser").val();
		  var usernameValue   = $("#username").val();
		  var pwdValue        = $("#pwd").val();
		  var emailValue      = $("#email").val();
		  var roleAdminValue  = $('input[name="role-admin"]:checked').length > 0;
		  if (isValidForm ()) {
			$.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
						id:         idUserValue,
		         		username:   usernameValue,
		         		pwd:        pwdValue,
		         		email:      emailValue,
		         		roleAdmin:  roleAdminValue
			        }, function (data) {						 
			        	 var idUser = parseInt (data);
						 if (idUser != null && idUser > 0) {
			        		 showMessage (1, "Usuário Salvo com Sucesso.");
							 renderPagination (1);
			        		 renderTable (1);	        		
			        		 resetForm ();
					     }
					}
	         );
		  }
	   }

	   /**
		* Loads an user.
	    */
	   function load (idUser) {
	   		var controllerValue = "UserController";
			var actionValue     = "loadUser";
			$.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		id:         idUser
			        }, function (data) {
			        	var result = data; 
						var valueArr = result.split(",");
						if (valueArr != null && valueArr.length > 0) {
							var idUser    = valueArr [0];
							var username  = valueArr [1];
							var email     = valueArr [2];
							var roleAdmin = valueArr [3];
							$("#idUser").val   (idUser);
							$("#username").val (username);
							$("#email").val    (email);
							if (roleAdmin == 1) {
								document.getElementById ("role-admin").checked = true;
							} else {
								document.getElementById ("role-admin").checked = false;
							}								
						}						
					}
	        );
	   }

	   /**
		* Removes an user.
	    */
	   function remove (idUser) {
	   		var controllerValue = "UserController";
			var actionValue     = "deleteUser";
			var result          = confirm ("Confirma Exclusão?"); 
			if (result) {
				$.post ("classes/controller/FrontController.php",
				        { 
		        	  		controller: controllerValue,
		        	  		action:     actionValue,
		        	  		id:         idUser
				        }, function (data) {
							var countRows = parseInt (data);
							if (countRows == 1) {
								showMessage (1, "Usuário Excluído com Sucesso.");
								renderPagination (1);
				        		renderTable (1);
				        		resetForm ();
							}
						}
		         );
			}
	   }

	   /**
	    * Resets the user form.
	    */
	   function resetForm () {
		   $("#idUser").val("");
		   $("#username").val("nome do usuário");
		   $("#pwd").val("12345");
		   $("#email").val("email");
		   document.getElementById ("role-admin").checked = false;
	   }
	   
		/**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidForm () {
			var isValid  = true;
			var username = $("#username").val();
			var pwd 	 = $("#pwd").val();
			var email 	 = $("#email").val();			
			if (isEmpty (username) 
					|| isEmpty (pwd)
					|| isEmpty (email)
					|| !isValidEmail (email)) {
				isValid = false;
				showMessage (2, "Preencha todos os campos corretamente.");
			}
			return isValid;
	   }
	
	</script>
	<body>
		<!-- page -->
		<div id="page">
			<!-- content -->
			<div id="main-internal">
				<?php include_once ("include/header.php");?>
				<!-- container-content -->
				<div id="container-content">
					<!-- container-col-form -->
					<div id="container-col-form">
						<div id="container-form-title">cadastrar usuário</div>
						<!-- container-form -->
						<div id="container-form">
							<form id="userForm" name="userForm">
								<input type="hidden" name="controller" id="controller" value="UserController" />
								<input type="hidden" name="action" id="action" value="updateUser" />
								<input type="hidden" name="idUser" id="idUser" value="" />
								<!-- message container -->
								<div id="message-container" class="message-container" style="display: none;">
									<p id="message-paragraph" class="error-message"></p>
								</div>
								<div class="field-container">
									<input type="text" name="username" id="username" placeholder="nome do usuário" />
								</div>
								<div class="password-field-container">
									<input type="password" name="pwd" id="pwd" placeholder="senha"/>
								</div>
								<div class="field-container">
									<input type="text" name="email" id="email" placeholder="email" />
								</div>
								<div class="field-container">
									<div id="checkbox-administrator">
										<input type="checkbox" name="role-admin" id="role-admin" value="1" />
									</div>									 
									<div id="label-administrator">administrador</div>
								</div>
								<div class="button-container">
									<input type="button" name="update-user-button" id="update-user-button" value="salvar" />
								</div>
							</form>
						</div>						
					</div>					
					<!-- container-col-table -->
					<div id="container-col-table">						
						<div id="container-table-navigation">													
						</div>
						<div id="container-table">
						</div>
					</div>					
				</div>
				<?php include ("include/navigation_bar.php");?>
			</div>
			<?php include ("include/footer.php");?>
		</div>
	</body>
</html>
