<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Piha
 */

get_header(); ?>

	<div id="content" class="clearfix">
	
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>
				
		<?php /* Display navigation to next/previous pages when applicable, also check if WP pagenavi plugin is activated */ ?>
		<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else: ?>
				
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				
				<nav id="nav-below">
					<div class="nav-previous"><?php next_posts_link( __( '&laquo; Older posts', 'piha' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &raquo;', 'piha' ) ); ?></div>
				</nav><!-- end #nav-below -->
				
			<?php endif; ?>

		<?php endif; ?>

	</div><!-- end #content -->
</div><!-- end #page -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>