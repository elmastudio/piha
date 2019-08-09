<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Piha
 */

get_header(); ?>

	<div id="content" class="clearfix">
	
		<?php while ( have_posts() ) : the_post(); ?>
	
			<?php get_template_part( 'content', 'single' ); ?>
		
			<?php comments_template( '', true ); ?>
		
		<?php endwhile; // end of the loop. ?>
	
		<nav id="nav-single">
			<div class="nav-next"><?php next_post_link( '%link', __( 'Next Post &raquo;', 'piha' ) ); ?></div>
			<div class="nav-previous"><?php previous_post_link( '%link', __( '&laquo; Previous Post', 'piha' ) ); ?></div>
		</nav><!-- #nav-below -->

	</div><!--end #content-->
</div><!-- end #page -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>