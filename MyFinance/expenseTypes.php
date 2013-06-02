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
			$("#expenseTypeTable td").live('click', function() {
				var id = $(this).attr('id');
				if (id != null && parseInt(id) > 0) {
					load (id);
				}
		    });
			$("#update-expense-type-button").click(function(event) {
		    	update ();
	      	});
	  });

	  /**
	   * Renders the pagination.
	  */
	  function renderPagination (pageNum) {
	   		var controllerValue = "ExpenseTypeController";
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
	   		var controllerValue = "ExpenseTypeController";
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
		* Updates an expense type.
	    */
	   function update () {		  
		  var controllerValue = $("#controller").val();
		  var actionValue     = $("#action").val();
		  var idExpenseType   = $("#idExpenseType").val();
		  var nmExpenseType   = $("#nmExpenseType").val();
		  if (isValidForm ()) {
			$.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller:    controllerValue,
	        	  		action:        actionValue,
						id:            idExpenseType,
						nmExpenseType: nmExpenseType
			        }, function (data) {
						 var idExpenseType = parseInt (data);
						 if (idExpenseType != null && idExpenseType > 0) {
			        		 showMessage (1, "Tipo de Despesa Salvo com Sucesso.");
							 renderPagination (1);
			        		 renderTable (1);
			        		 resetForm ();
					     }
					}
	         );
		  }
	   }

	   /**
		* Loads an expense type.
	    */
	   function load (idExpenseType) {
	   		var controllerValue = "ExpenseTypeController";
			var actionValue     = "loadExpenseType";
			$.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		id:         idExpenseType
			        }, function (data) {
						var result = data;
						var valueArr = result.split(",");
						if (valueArr != null && valueArr.length > 0) {
							var idExpenseType = valueArr [0];
							var nmExpenseType = valueArr [1];
							$("#idExpenseType").val (idExpenseType);
							$("#nmExpenseType").val (nmExpenseType);
						}
					}
	        );
	   }

	   /**
		* Removes an expense type.
	    */
	   function remove (idExpenseType) {
	   		var controllerValue = "ExpenseTypeController";
			var actionValue     = "deleteExpenseType";
			var result          = confirm ("Confirma Exclusão?"); 
			if (result) {
				$.post ("classes/controller/FrontController.php",
				        { 
		        	  		controller: controllerValue,
		        	  		action:     actionValue,
		        	  		id:         idExpenseType
				        }, function (data) {
							var countRows = parseInt (data);
							if (countRows == 1) {
								showMessage (1, "Tipo de Despesa Excluído com Sucesso.");
								renderPagination (1);
				        		renderTable (1);
				        		resetForm ();
							}
						}
		         );
			}
	   }

	   /**
	    * Resets the expense type form.
	    */
	   function resetForm () {
		   $("#idExpenseType").val("");
		   $("#nmExpenseType").val("nome do tipo de despesa");
	   }
	   
		/**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidForm () {
			var isValid  = true;
			var nmExpenseType = $("#nmExpenseType").val();
			if (isEmpty (nmExpenseType)) {
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
						<div id="container-form-title">cadastrar tipo de despesa</div>
						<!-- container-form -->
						<div id="container-form">
							<form id="expenseTypeForm" name="expenseTypeForm">
								<input type="hidden" name="controller" id="controller" value="ExpenseTypeController" />
								<input type="hidden" name="action" id="action" value="updateExpenseType" />
								<input type="hidden" name="idExpenseType" id="idExpenseType" value="" />
								<!-- message container -->
								<div id="message-container" class="message-container" style="display: none;">
									<p id="message-paragraph" class="error-message"></p>
								</div>
								<div class="field-container">
									<input type="text" name="nmExpenseType" id="nmExpenseType" placeholder="nome do tipo de despesa" />
								</div>
								<div class="button-container">
									<input type="button" name="update-expense-type-button" id="update-expense-type-button" value="salvar" />
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
