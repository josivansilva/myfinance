<?php 
	$pageNumber = 1;
	$last       = 1;
	if (isset($_REQUEST['pagination'])) {
		$pageNumber = $_REQUEST['pagination']->getPAGE_NUM();
		$last       = $_REQUEST['pagination']->getLAST();		
	}	
?>
<div id="container-table-navigation">
	<div id="container-button-first" title="Primeiro Registro">
		<a href="javascript:renderTable(1);">
			<img id="img-button-first" src="resources/images/bg_button_first.png" border="0" />
		</a>
	</div>
	<div id="container-button-previous" title="Registro Anterior">		
		<?php if ($pageNumber > 1) {?>	
			<a href="javascript:renderTable(<?php echo $pageNumber - 1?>);">
		<?php } else {?>
			<a href="javascript:void(0);">
		<?php } ?>
				<img id="img-button-previous" src="resources/images/bg_button_previous.png" border="0" />
			</a>
	</div>
	<div id="container-button-next" title="Próximo Registro">
		<?php if ($pageNumber == $last) {?>
			<a href="javascript:void(0);">
		<?php } else {?>
			<a href="javascript:renderTable(<?php echo $pageNumber + 1?>);">
		<?php } ?>
				<img id="img-button-next" src="resources/images/bg_button_next.png" border="0" />
			</a>
	</div>
	<div id="container-button-last" title="Último Registro">
		<a href="javascript:renderTable(<?php echo $last ?>);">
			<img id="img-button-last" src="resources/images/bg_button_last.png" border="0" />
		</a>
	</div>
</div>