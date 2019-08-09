 <?php
/**
 * The template for displaying the footer.
 *
 * @subpackage Piha
 */
?>

<div class="clear"></div>
</div><!-- end #container -->

	<footer id="footer-wrap" class="row">
		<div id="colophon">
			<div id="site-generator"><p>
			<?php
				$options = get_option('piha_theme_options');
				if($options['custom_footertext'] != '' ){
					echo stripslashes($options['custom_footertext']);
				} else { ?>
				<span class="footertext">&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?></span><span class="sep"> | </span><span class="footertext"><?php _e('Proudly powered by', 'piha') ?> <a href="https://wordpress.org/" >WordPress</a></span><span class="sep"> | </span><span class="footertext"><?php printf( __( 'Theme: %1$s by %2$s', 'piha' ), 'Piha', '<a href="https://www.elmastudio.de/">Elmastudio</a>' ); ?></span>
				<?php } ?></p>

				<ul class="footer-rss">
					<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('RSS Feed of all posts', 'piha'); ?>"><?php _e('RSS Feed', 'piha'); ?></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments of all posts in RSS', 'piha'); ?>"><?php _e('RSS Comments', 'piha'); ?></a></li>
				</ul><!-- end .footer-rss -->

				<?php if (has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array('theme_location' => 'footer', 'container' => 'nav' ,'depth' => 1 ));}
				?>

				<a href="#container" class="top"><?php _e('Back to Top &uArr;', 'piha') ?></a>
			</div><!-- end #site-generator -->
		</div><!-- end #colophon -->
	</footer><!-- end #footer-wrap -->

<?php // Include Google+ Code if Share post buttons are activated.
	$options = get_option('piha_theme_options');
	if($options['share-single-posts'] or $options['share-posts']) : ?>
	<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
	</script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
