<?php
/*
This file is not included in the download at wordpress.org because base64 encode/decode is being used.
Rename this file to "upload.php" and replace your existing upload.php with it to be able to import
style files that you exported with Atahualpa version 3.5.1. 
*/
if (!empty($_SERVER['SCRIPT_FILENAME']) AND 'upload.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('Please do not load this page directly.');
}
global $user_ID; 
if( $user_ID ) { 
	if( current_user_can('level_10') ) { 
		$import_options = file_get_contents($_FILES['userfile']['tmp_name']);
		// Since 3.5.2, use JSON instead of base64_decode
		if ( json_decode($import_options) != NULL AND strpos($import_options, 'use_bfa_seo') !== FALSE ) {
			update_option('bfa_ata4', json_decode($import_options, TRUE));
			echo "<strong><span style='color:green'>Successfully imported </span><code>" . 
				basename($_FILES['userfile']['name']) . "</code></strong><br />";		
		
		// Since 3.5.0 options are base64_encode(d) for better realiability because some hosting environments choked 
		// when unserializing the serialized (but not encoded) settings strings. 
		} else if ( is_serialized(base64_decode($import_options)) AND strpos(base64_decode($import_options), 'use_bfa_seo') !== FALSE ) {
			update_option('bfa_ata4', unserialize(base64_decode($import_options)));
			echo "<strong><span style='color:green'>Successfully imported </span><code>" . 
				basename($_FILES['userfile']['name']) . "</code></strong><br />";
		// For non-encoded settings files, produced with 3.4.7 - 3.4.9
		} else if ( is_serialized($import_options) AND strpos($import_options, 'use_bfa_seo') !== FALSE ) {
			update_option('bfa_ata4', unserialize($import_options));
			echo "<strong><span style='color:green'>Successfully imported </span><code>" . 
				basename($_FILES['userfile']['name']) . "</code></strong><br />";
		// Probably not a valid settings file:
		} else {
			echo "<strong><span style='color:red'>Sorry, but </span><code>" . 
				basename($_FILES['userfile']['name']) . "</code> <span style='color:red'>doesn't appear 
				to be a valid Atahualpa Settings File.</span></strong>";
		}
	} else {
		die("<span style='color:green'>Only admins can import settings</span>");
	}
}
die();
?>