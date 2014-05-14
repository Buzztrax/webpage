<?php
function bfa_ata_add_admin() {
	global $options, $bfa_ata;

#    if ( $_GET['page'] == basename(__FILE__) ) {

   if ( $_GET['page'] == "functions.php" ) {
	
        if ( 'save' == $_REQUEST['action'] ) {
 /*
			foreach ($options as $value) {
				if ( $value['category'] == $_REQUEST['category'] ) {
					if ( $value['escape'] == "yes" )  
						$bfa_ata[ $value['id'] ] = stripslashes(bfa_escape($_REQUEST[ $value['id'] ] )); 
					elseif ( $value['stripslashes'] == "no" )    
						$bfa_ata[ $value['id'] ] = $_REQUEST[ $value['id'] ] ; 
					else 
						$bfa_ata[ $value['id'] ] = stripslashes($_REQUEST[ $value['id'] ] ); 
				}
			}
*/				
            foreach ($options as $value) {
				if ( $value['category'] == $_REQUEST['category'] ) {
					if ( $value['escape'] == "yes" ) {
						if( isset( $_REQUEST[ $value['id'] ] ) ) 
							$bfa_ata[ $value['id'] ] = stripslashes(bfa_escape($_REQUEST[ $value['id'] ]  )); 
						else 
							unset ($bfa_ata[ $value['id'] ]); 
					} elseif ($value['stripslashes'] == "no") { 
						if( isset( $_REQUEST[ $value['id'] ] ) ) 
							$bfa_ata[ $value['id'] ] = $_REQUEST[ $value['id'] ]  ; 
						else 
							unset ($bfa_ata[ $value['id'] ]);  
					} else { 
						if( isset( $_REQUEST[ $value['id'] ] ) ) 
							$bfa_ata[ $value['id'] ] = stripslashes($_REQUEST[ $value['id'] ]  ); 
						else 
							unset ($bfa_ata[ $value['id'] ]); 
					} 
				}
			} 
			update_option('bfa_ata4', $bfa_ata);	
            header("Location: themes.php?page=functions.php&saved=true");
            die;

		} else if( 'reset' == $_REQUEST['action'] ) {
		
			if ("reset-all" == $_REQUEST['category']) {
				delete_option('bfa_ata4');
			} else {
				foreach ($options as $value) {
					if ( $value['category'] == $_REQUEST['category'] ) 
						$bfa_ata[ $value['id'] ] = $value['std'];
				}
				update_option('bfa_ata4', $bfa_ata);
			}
			
            header("Location: themes.php?page=functions.php&reset=true");
            die;
        }
		
    }

#    add_theme_page($themename. " Options", "Atahualpa Theme Options", 'edit_themes', basename(__FILE__), 'bfa_ata_admin');
    add_theme_page("Atahualpa Options", "Atahualpa Theme Options", 'edit_themes', 'functions.php', 'bfa_ata_admin');	
}
?>