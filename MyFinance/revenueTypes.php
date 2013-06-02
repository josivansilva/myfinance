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
			$("#revenueTypeTable td").live('click', function() {
				var id = $(this).attr('id');
				if (id != null && parseInt (id) > 0) {
					load (id);
				}
		    });
			$("#update-revenue-type-button").click(function(event) {
		    	update ();
	      	});
	  });

	  /**
	   * Renders the pagination.
	  */
	  function renderPagination (pageNum) {
	   		var controllerValue = "RevenueTypeController";
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
		* Renders the revenue types as an HTML table.
		*/
	   function renderTable (pageNum) {
	   		var controllerValue = "RevenueTypeController";
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
		* Updates a revenue type.
	    */
	   function update () {
		  var controllerValue = $("#controller").val();
		  var actionValue     = $("#action").val();
		  var idRevenueType   = $("#idRevenueType").val();
		  var nmRevenueType   = $("#nmRevenueType").val();
		  if (isValidForm ()) {			
	        $.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller:    controllerValue,
	        	  		action:        actionValue,
						id:            idRevenueType,
						nmRevenueType: nmRevenueType
			        }, function (data) {
						 var idRevenueType = parseInt (data);
						 if (idRevenueType != null && idRevenueType > 0) {
			        		 showMessage (1, "Tipo de Receita Salvo com Sucesso.");
							 renderPagination (1);
			        		 renderTable (1);      		
			        		 resetForm ();
					     }
					}
	         );
		  }
	   }

	   /**
		* Loads a revenue type.
	    */
	   function load (idRevenueType) {
	   		var controllerValue = "RevenueTypeController";
			var actionValue     = "loadRevenueType";
			$.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		id:         idRevenueType
			        }, function (data) {
						var result = data;
						var valueArr = result.split(",");
						if (valueArr != null && valueArr.length > 0) {
							var idRevenueType = valueArr [0];
							var nmRevenueType = valueArr [1];
							$("#idRevenueType").val (idRevenueType);
							$("#nmRevenueType").val (nmRevenueType);
						}						
					}
	        );
	   }

	   /**
		* Removes a revenue type.
	    */
	   function remove (idRevenueType) {
	   		var controllerValue = "RevenueTypeController";
			var actionValue     = "deleteRevenueType";
			var result          = confirm ("Confirma Exclusão?"); 
			if (result) {
				$.post ("classes/controller/FrontController.php",
				        { 
		        	  		controller: controllerValue,
		        	  		action:     actionValue,
		        	  		id:         idRevenueType
				        }, function (data) {
							var countRows = parseInt (data);
							if (countRows == 1) {
								showMessage (1, "Tipo de Receita Excluído com Sucesso.");
								// atualiza a tabela de usuários
				        		renderPagination (1);
				        		renderTable (1);
				        		resetForm ();
							}
						}
		         );
			}
	   }

	   /**
	    * Resets the revenue type form.
	    */
	   function resetForm () {
		   $("#idRevenueType").val("");
		   $("#nmRevenueType").val("nome do tipo de receita");
	   }
	   
		/**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidForm () {
			var isValid  = true;
			var nmRevenueType = $("#nmRevenueType").val();
			if (isEmpty (nmRevenueType)) {
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
						<div id="container-form-title">cadastrar tipo de receita</div>
						<!-- container-form -->
						<div id="container-form">
							<form id="revenueTypeForm" name="revenueTypeForm">
								<input type="hidden" name="controller" id="controller" value="RevenueTypeController" />
								<input type="hidden" name="action" id="action" value="updateRevenueType" />
								<input type="hidden" name="idRevenueType" id="idRevenueType" value="" />
								<!-- message container -->
								<div id="message-container" class="message-container" style="display: none;">
									<p id="message-paragraph" class="error-message"></p>
								</div>
								<div class="field-container">
									<input type="text" name="nmRevenueType" id="nmRevenueType" placeholder="nome do tipo de receita" />
								</div>
								<div class="button-container">
									<input type="button" name="update-revenue-type-button" id="update-revenue-type-button" value="salvar" />
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
