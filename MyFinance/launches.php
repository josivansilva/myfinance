<?php 
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");
include_once ("include/lock.php");
?>
<!DOCTYPE html>
<html>	
	<?php include ("include/head.php");?>
	<script type="text/javascript">

	  $(document).ready(function() {
		  	// on the event onclick of the td from the launch table
			$("#launchTable td").live('click', function() {
				var id = $(this).attr('id');
				if (id != null && parseInt (id) > 0) {
					load (id);
					$(".open").click();
				}
		    });
			// on the event onclick from the button search
		    $("#search-launch-button").click(function(event) {
		    	search ();
	      	});
			// on the event onchange from the type of launch select
		    $("#typeLaunch").change(function() {
		    	populateSelectRevenueOrExpense (0);
		    });
		 	// on the event onclick from the update launch button
		    $("#update-launch-button").click(function(event) {
		    	updateLaunch ();
		    });

		    $("#vlrLaunch").maskMoney({thousands:'', decimal:'.'});			
		    
	  });

	   /**
		* Searches for launches.
	    */
	   function search () {
		  var controllerValue = $("#controller").val();
		  var actionValue     = $("#action").val();
		  var monthValue      = $("#month").val();
		  var yearValue       = $("#year").val();
		  if (isValidSearchForm ()) {
	        $.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action: actionValue,
	        	  		month: monthValue,
	        	  		year:  yearValue
			        }, function (data) {
						$('#container-table').html (data);
					}
	         );
		  }
	   }

	   /**
		* Updates a launch.
	    */
	   function updateLaunch () {
		  var controllerValue         = "LaunchController";
		  var actionValue             = "updateLaunch";
		  var idLaunchValue           = $("#idLaunch").val ();
		  var typeLaunchValue 		  = $("#typeLaunch").val();
		  var idRevenueOrExpenseValue = $("#revenueOrExpense").val();
		  var nmLaunchValue           = $("#nmLaunch").val();
		  var vlrLaunchValue      	  = $("#vlrLaunch").val();
		  var statusValue             = $('input[name="chkStatus"]:checked').length > 0;
		  if (isValidLaunch ()) {			
	        $.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller:         controllerValue,
	        	  		action:             actionValue,
	        	  		idLaunch:           idLaunchValue,
						typeLaunch:         typeLaunchValue,
						idRevenueOrExpense: idRevenueOrExpenseValue,
						nmLaunch:      		nmLaunchValue,
						vlrLaunch:  		vlrLaunchValue,
						status:  			statusValue
			        }, function (data) { 
						 var result = parseInt (data);
						 if (result != null && result > 0) {
			        		 showMessageByContainer (1,"message-container-2","message-paragraph-2", "Lançamento Salvo com Sucesso.");
			        		 resetLaunch ();
			        		 search ();
					     }
					}
	         );
		  }
	   }

	   /**
		* Loads a launch.
	    */
	   function load (idLaunch) {
	   		var controllerValue = "LaunchController";
			var actionValue     = "loadLaunch";
			$.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		id:         idLaunch
			        }, function (data) {
						var idRevenueTypeOrExpenseType = 0;
						var result                     = data;
						var valueArr = result.split(",");
						if (valueArr != null && valueArr.length > 0) {
							var idLaunch      = valueArr [0];
							var idRevenueType = valueArr [1];
							var idExpenseType = valueArr [2];
							var nmLaunch      = valueArr [3];
							var vlrLaunch     = valueArr [4];
							var status        = valueArr [5];
							$("#idLaunch").val (idLaunch);
							if (idRevenueType != null 
									&& parseInt (idRevenueType) > 0) {
								document.getElementById ("typeLaunch").value = "revenueType";
								idRevenueTypeOrExpenseType = idRevenueType; 
																
							}  else if (idExpenseType != null 
											&& parseInt (idExpenseType) > 0) {
								document.getElementById ("typeLaunch").value = "expenseType";
								idRevenueTypeOrExpenseType = idExpenseType;
								
							}
							populateSelectRevenueOrExpense (idRevenueTypeOrExpenseType);
							$("#nmLaunch").val (nmLaunch);
							$("#vlrLaunch").val (vlrLaunch);
							if (status == "PAGO") {
								document.getElementById ("chkStatus").checked = true;
							} else {
								document.getElementById ("chkStatus").checked = false;
							}
						}
					}
	        );
	   }


	   /**
		* Removes a launch.
	    */
	   function remove (idLaunch) {
	   		var controllerValue = "LaunchController";
			var actionValue     = "deleteLaunch";
			var result          = confirm ("Confirma Exclusão?"); 
			if (result) {
				$.post ("classes/controller/FrontController.php",
				        { 
		        	  		controller: controllerValue,
		        	  		action:     actionValue,
		        	  		id:         idLaunch
				        }, function (data) {
							var countRows = parseInt (data);
							if (countRows == 1) {
								search ();
								// closes the popbox
								$(".close").click();
								showMessageByContainer (1,"message-container-1","message-paragraph-1", "Lançamento Excluído com Sucesso.");								
							}
						}
		         );
			}
	   }

	   /**
		* Populates the select revenue or expense.
	    */
	   function populateSelectRevenueOrExpense (idRevenueTypeOrExpenseType) {
		  var controllerValue = "LaunchController";
		  var actionValue     = "renderSelectRevenueOrExpense";
		  var typeLaunchValue = $("#typeLaunch").val();
		  if (isValidTypeLaunch ()) {
	        $.post ("classes/controller/FrontController.php",
			        { 
	        	  		controller: controllerValue,
	        	  		action: actionValue,
	        	  		typeLaunch: typeLaunchValue,
	        	  		idSelected: idRevenueTypeOrExpenseType
			        }, function (data) {
						$('#container-revenue-or-expense').html (data);
					}
	         );
		  } else {
			  resetSelectRevenueOrExpense ();
		  }
	   }

	    /**
	    * Resets the launch.
	    */
	   function resetLaunch () {
		   $("#idLaunch").val("");
		   $("#typeLaunch").val("");
		   $("#revenueOrExpense").val("");
		   document.getElementById ("revenueOrExpense").disabled = "disabled";
		   $("#nmLaunch").val("");
	   	   $("#vlrLaunch").val("");
	   	   document.getElementById ("chkStatus").checked = false;
	   }

	    /**
	    * Resets the select revenue or expense.
	    */
	   function resetSelectRevenueOrExpense () {
		   var htmlContent = "";
		   htmlContent += "<select id=\"revenueOrExpense\" name=\"revenueOrExpense\" disabled=\"disabled\">";
		   htmlContent += "		<option value=\"\">tipos de receita ou tipos de despesa</option>";
		   htmlContent += "</select>";
		   $('#container-revenue-or-expense').html (htmlContent);
	   }
	   
		/**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidSearchForm () {
			var isValid = true;
			var month   = $("#month").val();
			var year    = $("#year").val();
			if (isEmpty (month) 
					|| isEmpty (year)) {
				isValid = false;
				showMessageByContainer (2,"message-container-1","message-paragraph-1", "Preencha todos os filtros corretamente.");
			}
			return isValid;
	   }

	   /**
		 * Checks if the launch form is fulfilled or not.
		 * 
		 * @returns {boolean} boolean containing the operation result.
		*/
		function isValidLaunch () {			  
			var isValid  = true;
			var typeLaunchValue 		= $("#typeLaunch").val();
			var idRevenueOrExpenseValue = $("#revenueOrExpense").val();
			var nmLaunchValue           = $("#nmLaunch").val();
			var vlrLaunchValue      	= $("#vlrLaunch").val();
			if (isEmpty (typeLaunchValue) 
					|| isEmpty (idRevenueOrExpenseValue)
					|| isEmpty (nmLaunchValue)
					|| isEmpty (vlrLaunchValue)) {
				isValid = false;
				showMessageByContainer (2,"message-container-2","message-paragraph-2", "Preencha todos os filtros corretamente.");				
			}
			return isValid;
		}

		/**
		  * Checks if the select type launch is correctly fulfilled.
		  * 
		  * @returns {boolean} boolean containing the operation result.
		 */
	   function isValidTypeLaunch () {
			var isValid  = true;
			var typeLaunch = $("#typeLaunch").val();
			if (isEmpty (typeLaunch)) {
				isValid = false;
				showMessageByContainer (2,"message-container-2","message-paragraph-2", "Preencha todos os filtros corretamente.");
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
						<div id="container-form-title">lançamentos</div>
						<!-- container-form -->
						<div id="container-form">
							<form id="launchFilterForm" name="launchFilterForm">
								<input type="hidden" name="controller" id="controller" value="LaunchController" />
								<input type="hidden" name="action" id="action" value="findLaunchByFilter" />
								<!-- message container -->
								<div id="message-container-1" class="message-container" style="display: none;">
									<p id="message-paragraph-1" class="error-message"></p>
								</div>
								<div class="field-container">									
									<select id="month" name="month">
										<option value="">mês</option>
										<option value="1">janeiro</option>
										<option value="2">fevereiro</option>
										<option value="3">março</option>
										<option value="4">abril</option>
										<option value="5">maio</option>
										<option value="6">junho</option>
										<option value="7">julho</option>
										<option value="8">agosto</option>
										<option value="9">setembro</option>
										<option value="10">outubro</option>
										<option value="11">novembro</option>
										<option value="12">dezembro</option>
									</select>
								</div>
								<div class="field-container">
									<select id="year" name="year">
										<option value="">ano</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
									</select>
								</div>						
								<div class="button-container">
									<input type="button" name="search-launch-button" id="search-launch-button" value="pesquisar" />
								</div>
							</form>
						</div>						
					</div>					
					<!-- container-col-table -->
					<div id="container-col-table">
						<!-- popbox -->
						<div class='popbox'>
						    <a class='open' href='#' title="fazer lançamento">
								<img src="resources/images/bg_button_add.png" onmouseover="javascript:changeImageSrc(this, 'bg_button_add_over.png');" onmouseout="javascript:changeImageSrc(this, 'bg_button_add.png');" border="0" />
							</a>						    
						    <div class='collapse'>
						      <form id="launchForm" name="launchForm">
								<input type="hidden" name="idLaunch" id="idLaunch" value="" />
							      <div class='box'>
							      	<div id="message-container-2" class="message-container" style="display: none;">
										<p id="message-paragraph-2" class="error-message"></p>
									</div>
									<div class="field-container">
										<select id="typeLaunch" name="typeLaunch">
											<option value="">tipo do lançamento</option>
											<option value="revenueType">receita</option>
											<option value="expenseType">despesa</option>										
										</select>
									</div>
									<div class="field-container">
										<div id="container-revenue-or-expense">
											<select id="revenueOrExpense" name="revenueOrExpense" disabled="disabled">
												<option value="">tipos de receita ou tipos de despesa</option>
											</select>
										</div>							
									</div>
									<div class="field-container">
										<input type="text" name="nmLaunch" id="nmLaunch" placeholder="nome do lançamento" />
									</div>
									<div class="field-container">
										<input type="text" name="vlrLaunch" id="vlrLaunch" placeholder="valor" />
									</div>
									<div class="field-container" style="margin-bottom: 5px;">
										<div id="checkbox-status">
											<input type="checkbox" name="chkStatus" id="chkStatus"> pago
										</div>
									</div>
									<div class="button-container">
										<a href="#" class="close">
											<img src="resources/images/button_close.png" onmouseover="javascript:changeImageSrc(this, 'button_close_over.png');" onmouseout="javascript:changeImageSrc(this, 'button_close.png');" border="0" />
										</a>
										<input type="button" name="update-launch-button" id="update-launch-button" value="salvar" />									
									</div>
							      </div>
							  </form>
						    </div>
  						</div>
  						<!-- popbox -->
  						<!-- container-table -->
  						<div id="container-table">
							<table cellspacing="0" cellpadding="0" border="0" id="launchTable">
								<thead>
									<tr>
										<td width="210px">receitas</td>
										<td width="95px">previstas</td>
										<td width="65px">status</td>	
									</tr>
								</thead>
								<tbody>
									<tr class="tr-total">
										<td width="210px">Total receitas</td>	
										<td width="95px">0	</td>
										<td width="65px">   </td>
									</tr>
								</tbody>
							</table>
							<table cellspacing="0" cellpadding="0" border="0" id="launchTable">
								<thead>	
									<tr>
										<td width="210px">despesas</td>
										<td width="95px">previstas</td>
										<td width="65px">status</td>
									</tr>
								</thead>
								<tbody>
									<tr class="tr-total">
										<td width="210px">Total despesas</td>	
										<td width="95px">0</td>	
										<td width="65px"></td>
									</tr>
									<tr class="tr-total">
										<td width="210px">Saldo</td>	
										<td width="95px">0     </td>	
										<td width="65px">      </td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- container-table -->
					</div>			
				</div>
				<?php include ("include/navigation_bar.php");?>
			</div>
			<?php include ("include/footer.php");?>
		</div>
	</body>
</html>
