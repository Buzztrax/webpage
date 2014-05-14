<?php
/*
Template Name: Dump template
*/
 ?>
<?php // Do not delete these lines ?>
------
<?php 	/* get all options: */
include (TEMPLATEPATH . '/functions/bfa_get_options.php');
get_header();

#global $bfa_ata;
// You can start editing below:
?>
<h1>the following is a dump of the BFA arrays</h1>
<br><h2>the following is a dump of the array bfa_ata_extra_widget_areas</h2>
<?php
 		print_r($bfa_ata_extra_widget_areas);
	echo '<br>count of bfa_ata_extra_widget_areas='.count($bfa_ata_extra_widget_areas).'<br>';
?>
<br><h2>the following is a dump of the array bfa_ata_widget_areas</h2>
<?php
 		print_r($bfa_ata_widget_areas);
	echo '<br>count of bfa_ata_widget_areas='.count($bfa_ata_widget_areas).'<br>';
?><br><h2>the following is a dump of the array bfa_ata</h2>
<?php
print_r($bfa_ata);
 ?>
 <h1>end of dump</h1>

<?php /* This outputs the "Not Found" content, if neither posts, pages nor attachments are available for the requested page.
This can be edited at Atahualpa Theme Options -> Style & edit the Center column */
bfa_center_content($bfa_ata['content_not_found']); ?>


<?php bfa_center_content($bfa_ata['center_content_bottom']); ?>

<?php get_footer(); ?>
------

