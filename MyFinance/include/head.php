		<head>
			<title>MyFinance | Gerenciador de Finanças Pessoais</title>
			<script src="resources/javascript/jquery-1.9.1.js"></script>
			<script src="resources/javascript/jquery-migrate-1.1.0.js"></script>
			<script src="resources/javascript/functions.js"></script>
			<script src='resources/javascript/popbox.js' type='text/javascript' charset='utf-8'></script>
			<script src='resources/javascript/popbox.min' type='text/javascript' charset='utf-8'></script>
			<script src="resources/javascript/jquery.maskMoney.js" type="text/javascript"></script>
			<style type="text/css">
				@import url("resources/css/style.css");
			</style>
			<script type="text/javascript">
			 
				$(document).ready(function() {
		
					$('.popbox').popbox();

					// início - efeito onmouseover nos botões da barra de navegação
					$('#img-button-launch').hover(function() {
						$(this).attr('src', 'resources/images/bg_button_launch_over.png');
					}, function() {
						$(this).attr('src', 'resources/images/bg_button_launch.png');
					});
		
					$('#img-button-revenue-type').hover(function() {
						$(this).attr('src', 'resources/images/bg_button_revenue_type_over.png');
					}, function() {
						$(this).attr('src', 'resources/images/bg_button_revenue_type.png');
					});
		
					$('#img-button-expense-type').hover(function() {
						$(this).attr('src', 'resources/images/bg_button_expense_type_over.png');
					}, function() {
						$(this).attr('src', 'resources/images/bg_button_expense_type.png');
					});
		
					$('#img-button-user').hover(function() {
						$(this).attr('src', 'resources/images/bg_button_user_over.png');
					}, function() {
						$(this).attr('src', 'resources/images/bg_button_user.png');
					});
					// fim - efeito onmouseover nos botões da barra de navegação
					
			   });
 
			</script>
		</head>
	