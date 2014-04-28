=== Check Last Login ===
Contributors: JohnnyPea
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FUT8H7SGMYE5E
Tags: registration,login,user
Requires at least: 2.8
Tested up to: 3.0.4
Stable tag: 0.6

Simple plugin which checks user's login status and displays registration date and last login date columns on the "Users" page.

== Description ==

This plugin adds registration date and last login date columns on the "Users" page.
It also checks whether user logs in within 30 days after the registration if he does not his account is deleted - this option is disabled by default, you can change this settings on Check Last Login Settings page in Settings menu.
 
WARNING! The plugin is not updating the login time when logging through stored login cookies.

**I am open to suggestions to improve the plugin !**

== Installation ==
Activate the plugin.

You can enable/disable the automatic user deletion and set the inactivity time after the registration on Check Last Login Settings page in Settings menu.

== Frequently Asked Questions ==

= Can I email you with the support questions ? =

No. Please use integrated forum support system.

= Do you provide some extra "premium" customization ? =

Yes. You can email me in this case.

== Screenshots ==

Checks user's login status

== Changelog ==

= 0.1 =
initial release

= 0.2 =
tiny fix to display "No login" if user has no log in from the time of plugin activation

= 0.3 =
added settings page - now you can enable/disable the automatic user deletion and set the inactivity time after the registration

= 0.4 =
fix for wrong function included in wp_login action hook

= 0.5 =
another little enhancement - not using deprecated 'update_usermeta' but 'update_user_meta'

= 0.6 =
cron could not run the function because some of the functions was not declared

== Upgrade Notice ==

= 0.1 =
initial release

= 0.2 =
just update

= 0.3 =
just update

= 0.4 =
just update

= 0.5 =
just update

= 0.6 =
just update