function toggle_star(issue_id) {
	star = jQuery('#star_'+issue_id);
	new_src = PLUGIN_URI + (star.attr('src') === PLUGIN_URI + 'star_on.gif' ? 'star_off.gif' : 'star_on.gif');
	star.attr('src', PLUGIN_URI + 'loading16.gif')				
	jQuery.post(POST_GUID+'?&do=qdo&qdo=toggle_star&issue_id=' + issue_id, function() {
		star.attr('src', new_src)
	});
}

jQuery(document).ready( function() {
	jQuery('.show_completed').toggle();
	jQuery('.show_completed, .hide_completed').live('click', function(event) {
		jQuery('.show_completed, .hide_completed').toggle();
		jQuery('.tr_strike').toggle(500);
		return false;
	});
});