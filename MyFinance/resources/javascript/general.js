/*
	File name: general.js
	Author: Josivan Ribeiro
	Author URI: http://www.thesyncme.com
	Description: JavaScript file that defines generic functions used by the TheSyncMe web application.
	Version: 1.0
*/

/**
 * Submits a form given the button id.
 *  
 * @param id the button id.
 */
function submitForm (id){
    document.getElementById(id).click();
}

/**
 * Submits all the forms from a page.
 * 
 */
function submitForms() {
  var FORM_TAG = "form";
  var formArr = document.getElementsByTagName (FORM_TAG);
  if (formArr != null && formArr.length > 0) {
	for (var i=0; i < formArr.length; i++) {
		var form = formArr[i];
		form.submit();
	}
  }  
}

/**
 * Submits a form given its id.
 * 
 * @param id the form id.
 */
function submitFormById (id) {
	var form = document.getElementById (id);
	if (form != "undefined") {
		form.submit();
	}
}
