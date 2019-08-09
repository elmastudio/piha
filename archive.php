<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage Piha
 */

get_header(); ?>

	<div id="content" class="clearfix">

		<?php the_post(); ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: <span>%s</span>', 'piha' ), get_the_date() ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: <span>%s</span>', 'piha' ), get_the_date( 'F Y' ) ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: <span>%s</span>', 'piha' ), get_the_date( 'Y' ) ); ?>
					<?php else : ?>
						<?php _e( 'Blog Archives', 'piha' ); ?>
					<?php endif; ?>
				</h1>
			</header><!-- end .page-header -->

			<?php rewind_posts(); ?>
				
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