<?php
/*
Adjust output of new WP3 menu system for Ruthsarian RMenu CSS.
This adds the CSS class 'rMenu-expand' to parent LI's
*/  
function bfa_new_wp3_menus($theme_location = "menu1", $alignment = "left") { 

	if ( $theme_location == "menu1" ) $menu_id = "rmenu2";
	if ( $theme_location == "menu2" ) $menu_id = "rmenu";
	$menu_class = "clearfix rMenu-hor rMenu";
	if ( $alignment == "right" ) $menu_class .= " rMenu-hRight";
	if ( $alignment == "center" ) { 
		$before_menu = '<table cellpadding="0" cellspacing="0" style="margin: 0 auto"><tr><td align="center">';
		$after_menu = '</td></tr></table>';
	} 
	
	ob_start();
	
	wp_nav_menu( array( 
		'theme_location' => $theme_location, 
		'container' => 'div', 
		'container_id' => $theme_location,
		'menu_class' => $menu_class,
		'menu_id' => $menu_id
		) );
		
	$newmenu = ob_get_contents(); 
	
	ob_end_clean();
	
	$newmenu = preg_replace("/<li id=\"(.*?)\n<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t\t\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t\t\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t\t\t\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t\t\t\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t\t\t\t\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t\t\t\t\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t\t\t\t\t\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t\t\t\t\t\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
	$newmenu = preg_replace("/<li id=\"(.*?)\n\t\t\t\t\t\t\t\t\t<ul class=\"sub-menu\">/i","<li class=\"rMenu-expand \\1\n\t\t\t\t\t\t\t\t\t <ul class=\"rMenu-ver sub-menu\">",$newmenu);
		
	return $before_menu . $newmenu . $after_menu;
		
}
?>