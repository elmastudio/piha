<?php
/**
 * The template for displaying 404 error pages.
 *
 * @package WordPress
 * @subpackage Piha
 */

get_header(); ?>

	<div id="content" class="clearfix">

		<article id="post-0" class="post error404 not-found">

			<div class="entry-wrap">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Not Found', 'piha' ); ?></h1>
				</header><!--end .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'piha' ); ?></p>
						<?php get_search_form(); ?>
				</div><!-- end .entry-content -->

			<script type="text/javascript">
			// focus on search field after it has loaded
			document.getElementById('s') && document.getElementById('s').focus();
			</script>

			</div><!-- end .entry-wrap -->
		</article><!-- end #post-0 -->

	</div><!--end #content-->
</div><!-- end #page -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>