
----------------------------------------------------------------------------------------------------------------------
For the detailed theme documentation (pdf & videos) please visit: http://www.elmastudio.de/wordpress-themes/piha/
----------------------------------------------------------------------------------------------------------------------

Changelog:
----------------------------------------------------------------------------------------------------------------------

Version 1.0.4 - 16/03/2017
----------------------------------
- New: Support for the One Click Demo Import plugin.
- Bugfix: Updated deprecated functions in functions.php and inc/theme-options.php
- Bugfix: Updated theme to support https.


Version 1.0.3 - 09/03/2014
----------------------------------
1. Bugfix: Updated jquery.fitvids.js in folder "js" to fix Chrome font bug
2. Enhancement: Deleted deprecated add_custom_background (see functions.php)


Version 1.0.2 - January 31th 2012
----------------------------------
1. Used WordPress jQuery version (see header.php line 51 and deleted "Register and call jQuery via Google Libraries API"
	 in functions.php)
2. Use jQuery no conflict wrappers (see custom.js and includes/theme-options.php line 314-318)
	 (more info: http://codex.wordpress.org/Function_Reference/wp_enqueue_script)
3. Changed Top button Link from  href="#top-border" to href="#container" so it still works if header
	 search form is not used (see footer.php line 33)
4. Changed sub menu background color in responsive layout from white to a light grey (see style.css line 2498)
5. Added styles for the  Jetpack Subscribe widget (see style.css from line 1957)
6. Added -webkit-appearance: none; to buttons so that theme button styles will always be used in Safari
	 (more info see: http://trentwalton.com/2010/07/14/css-webkit-appearance/)
7. Added html { -ms-text-size-adjust: none; -webkit-text-size-adjust: none;} to style.css line 2701 to control text size
	 adjustment on the iPhone.
8. Changed facebook like button code to width 120 (see share-posts.php line 13)
9. Added WordPress featured image support, so large included featured images will be used as header image on posts and
	 pages if the header image option is activated (see header.php line 118-132 and style.css line 267).
10. Optimized font-size for shortcode info-boxes, italic fonts, address, and lists.
11. Included the respond.js to better support the theme styling in Internet Explorers 7 and 8
		(see functions.php line 49 and folder js).



Version 1.0.1 - October 27th 2011
----------------------------------
1. RTL language bug fixes: Fixed the styles of the main navigation, added the arrow image to the link post format style,
	 optimized the search forms
2. Reduced the size of the blog title on small screens (see style.css line 2673)
3. Bugfix for gallery post formats on search result page (changed code in content-gallery.php)
4. Added some margin for pages in search results (see style.css line 1558 and 2856)
5. Bugfix for displaying categories with post counts in responsive layout (see style.css line 2581)
6. Bugfix for Facebook Like button on small screens (see style.css line 861)
7. Optimized styles for threaded comments on small screens (seestyle.css line 2812)
8. Added a margin-bottom value to all button shortcodes (see style.css line 1432)
9. Added styling for the category description text (see style.css line 1550)
10. Added Styling for WP Pagenavi plugin to fix bug in IE and Firefox (see style.css from line 2083)



Version 1.0 - October 5th 2011
----------------------------------
1. Piha theme release


----------------------------------------------------------------------------------------------------------------------

Social Icons used for Social Links widget: Icons by Gedy Rivera: http://lifetreecreative.com/icons/
