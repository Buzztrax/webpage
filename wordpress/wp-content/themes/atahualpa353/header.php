<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<?php /* if index.php or another page template (copied from index.php) was not used
(i.e. by a plugin such as WPG2), the global $bfa_ata would be empty */
global $bfa_ata, $cols, $left_col, $left_col2, $right_col, $right_col2; 
// if ($bfa_ata == "") include_once (TEMPLATEPATH . '/functions/bfa_get_options.php'); ?>
<?php if ( $bfa_ata['css_external'] == "External" ) { ?>
<link rel="stylesheet" href="<?php bloginfo('url'); ?>/?bfa_ata_file=css" type="text/css" media="all" />
<?php } ?>
<?php include (TEMPLATEPATH . '/functions/bfa_meta_tags.php'); ?>
<?php if ($bfa_ata['favicon_file'] != "") { ?><link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon/<?php echo $bfa_ata['favicon_file']; ?>" /><?php } ?>
<?php if ( is_single() OR is_page() ) { ?><link rel="canonical" href="<?php the_permalink(); ?>" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( function_exists('wp_list_comments') AND is_singular() ) { 	wp_enqueue_script( 'comment-reply' ); } ?>
<?php wp_head(); ?>
<?php bfa_html_inserts($bfa_ata['html_inserts_header']); ?>
<?php if ($bfa_ata['pngfix_selectors'] != "") { ?>
<!--[if IE 6]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/DD_roundies.js"></script>
<script type="text/javascript">DD_roundies.addRule('<?php echo $bfa_ata['pngfix_selectors']; ?>');</script>
<![endif]-->
<?php } ?>
<?php if (strpos($bfa_ata['configure_header'],'%image')!== FALSE AND 
$bfa_ata['header_image_javascript'] != "0" AND $bfa_ata['crossslide_fade'] != "0") { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cross-slide.js"></script>
<?php } ?>
<?php if ( ($bfa_ata['animate_page_menu_bar'] == "Yes" AND strpos($bfa_ata['configure_header'],'%page')!== FALSE ) OR 
( $bfa_ata['animate_cat_menu_bar'] == "Yes" AND strpos($bfa_ata['configure_header'],'%cat')!== FALSE ) ) { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mootools-for-dropdown.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/UvumiDropdown-compressed.js"></script>
<script type="text/javascript">
<?php if ( $bfa_ata['animate_cat_menu_bar'] == "Yes" AND strpos($bfa_ata['configure_header'],'%cat')!== FALSE ) { ?>
var myMenu = new UvumiDropdown("rmenu",{ closeDelay:200});
<?php } ?>
<?php if ($bfa_ata['animate_page_menu_bar'] == "Yes" AND strpos($bfa_ata['configure_header'],'%page')!== FALSE) { ?>
var myMenu2 = new UvumiDropdown("rmenu2",{ closeDelay:200});
<?php } ?>
</script>
<?php } ?>
</head>
<body <?php body_class(); ?><?php if ($bfa_ata['html_inserts_body_tag'] != "") { echo ' '; bfa_html_inserts($bfa_ata['html_inserts_body_tag']); } ?>>
<?php bfa_html_inserts($bfa_ata['html_inserts_body_top']); ?>
<div id="wrapper">
<div id="container">
<table id="layout" border="0" cellspacing="0" cellpadding="0">
<colgroup>
<?php if ( $left_col == "on" ) { ?><col class="colone" /><?php } ?>
<?php if ( $left_col2 == "on" ) { ?><col class="colone-inner" /><?php } ?>
<col class="coltwo" />
<?php if ( $right_col2 == "on" ) { ?><col class="colthree-inner" /><?php } ?>
<?php if ( $right_col == "on" ) { ?><col class="colthree" /><?php } ?>
</colgroup> 
	<tr>

		<!-- Header -->
		<td id="header" colspan="<?php echo $cols; ?>">

		<?php bfa_header_config($bfa_ata['configure_header']); ?>

		</td>
		<!-- / Header -->

	</tr>

	<!-- Main Body -->	
	<tr id="bodyrow">

		<?php if ( $left_col == "on" ) { ?>
		<!-- Left Sidebar -->
		<td id="left">

			<?php // Widgetize the Left Sidebar 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?>
		
				<div class="widget widget_categories"><div class="widget-title">
				<h3><?php _e('Categories','atahualpa'); ?></h3>
				</div>
				<ul><?php wp_list_categories('show_count=1&title_li='); ?></ul>
				</div>
				
				<div class="widget widget_archive"><div class="widget-title">
				<h3><?php _e('Archives','atahualpa'); ?></h3>
				</div>
				<ul><?php wp_get_archives('type=monthly'); ?></ul>
				</div>

				<div class="widget widget_text"><div class="widget-title">
				<h3>A sample text widget</h3></div>
				<div class="textwidget">
				<p>Etiam pulvinar consectetur dolor sed malesuada. Ut convallis 
				<a href="http://wordpress.org/">euismod dolor nec</a> pretium. Nunc ut tristique massa. </p>
				<p>Nam sodales mi vitae dolor <em>ullamcorper et vulputate enim accumsan</em>. 
				Morbi orci magna, tincidunt vitae molestie nec, molestie at mi. <strong>Nulla nulla lorem</strong>, 
				suscipit in posuere in, interdum non magna. </p>
				</div>
				
			<?php endif; ?>

		</td>
		<!-- / Left Sidebar -->
		<?php } ?>

		<?php if ( $left_col2 == "on" ) { ?>
		<!-- Left INNER Sidebar -->
		<td id="left-inner">

			<?php // Widgetize the Left Inner Sidebar 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Inner Sidebar') ) : ?>
		
					<!-- no default content for the LEFT INNER sidebar -->
									
			<?php endif; ?>

		</td>
		<!-- / Left INNER Sidebar -->
		<?php } ?>
		

		<!-- Main Column -->
		<td id="middle">