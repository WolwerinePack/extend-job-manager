<?php
	header("Content-type: text/javascript");


?>



	//form validation
	function validateName(fld) {
		"use strict";
		var error = "";
				
		if (fld.value === '' || fld.value === 'Nickname' || fld.value === 'Enter Your Name..' || fld.value === 'Your Name..') {
			error = "<?php esc_html_e( "You did not enter your first name." , THEME_NAME );?>";
		} else if ((fld.value.length < 2) || (fld.value.length > 200)) {
			error = "<?php printf ( esc_html( 'First name is the wrong length.' , THEME_NAME ));?>";
		}
		return error;
	}
			
	function validateEmail(fld) {
		"use strict";
		var error="";
		var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
				
		if (fld.value === "") {
			error = "<?php printf ( esc_html( "You did not enter an email address." , THEME_NAME ));?>";
		} else if ( fld.value.match(illegalChars) === null) {
			error = "<?php printf ( esc_html( 'The email address contains illegal characters.' , THEME_NAME ));?>";
		}

		return error;

	}
			
	function valName(text) {
		"use strict";
		var error = "";
				
		if (text === '' || text === 'Nickname' || text === 'Enter Your Name..' || text === 'Your Name..') {
			error = "<?php printf ( esc_html( "You did not enter Your First Name." , THEME_NAME ));?>";
		} else if ((text.length < 2) || (text.length > 50)) {
			error = "<?php printf ( esc_html( 'First Name is the wrong length.' , THEME_NAME ));?>";
		}
		return error;
	}
			
	function valEmail(text) {
		"use strict";
		var error="";
		var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
				
		if (text === "") {
			error = "<?php printf ( esc_html( "You did not enter an email address." , THEME_NAME ));?>";
		} else if ( text.match(illegalChars) === null) {
			error = "<?php printf ( esc_html( 'The email address contains illegal characters.' , THEME_NAME ));?>";
		}

		return error;

	}
			
	function validateMessage(fld) {
		"use strict";
		var error = "";
				
		if (fld.value === '') {
			error = "<?php printf ( esc_html( "You did not enter Your message." , THEME_NAME ));?>";
		} else if (fld.value.length < 3) {
			error = "<?php printf ( esc_html( 'The message is to short.' , THEME_NAME ));?>";
		}

		return error;
	}		

	function validatecheckbox() {
		"use strict";
		var error = "<?php esc_html_e( 'Please select at least one checkbox!' , THEME_NAME );?>";
		return error;
	}

