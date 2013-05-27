<?php

include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/bo/UserBOImpl.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/vo/UserVO.php");
include_once ("/home/josivansilva/webapps/ROOT/MyFinance/classes/util/Pagination.php");

/**
 * Abstract Controller class containing useful methods.
 * 
 * @author Josivan Silva
 *
 */
abstract class AbstractController {
	
	/**
	 * Renders the user HTML table navigation.
	 * 
	 * @return void
	 */
	protected function renderTableNavigation ($pagination) {
		echo "	<div id=\"container-button-first\" title=\"Primeiro Registro\">";
		if ($pagination->getPAGE_NUM() > 1) {
			echo "		<a href=\"javascript:renderTable(1);renderPagination(1);\">";
		} else {
			echo "		<a href=\"javascript:void(0);\">";
		}		
		echo "			<img id=\"img-button-first\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_first_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_first.png');\" border=\"0\" src=\"resources/images/bg_button_first.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-previous\" title=\"Registro Anterior\">";
		if ($pagination->getPAGE_NUM() > 1) {
			$previous = intval($pagination->getPAGE_NUM()-1);			
			echo "		<a href=\"javascript:renderTable(" . $previous . ");renderPagination(". $previous .");\">";
		} else {
			echo "		<a href=\"javascript:void(0);\">";		
		}
		echo "			<img id=\"img-button-previous\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_previous_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_previous.png');\" src=\"resources/images/bg_button_previous.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-next\" title=\"Pr&oacute;ximo Registro\">";		
		if ($pagination->getPAGE_NUM() == $pagination->getLAST()) {
			echo "		<a href=\"javascript:void(0);\">";
		} else {
			$next = intval($pagination->getPAGE_NUM()+1);
			echo "		<a href=\"javascript:renderTable(" . $next . ");renderPagination(". $next .");\">";
		}
		echo "			<img id=\"img-button-next\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_next_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_next.png');\" src=\"resources/images/bg_button_next.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-last\" title=\"&Uacute;ltimo Registro\">";
		if ($pagination->getPAGE_NUM() == $pagination->getLAST()) {
			echo "		<a href=\"javascript:void(0);\">";
		} else {
			echo "		<a href=\"javascript:renderTable(" . $pagination->getLAST() . ");renderPagination(". $pagination->getLAST() .");\">";
		}
		echo "			<img id=\"img-button-last\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_last_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_last.png');\" src=\"resources/images/bg_button_last.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";		
	}	
	
}

?>