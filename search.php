<?php
/**
 * The template for displaying search results.
 *
 * @package WordPress
 * @subpackage Piha
 */

get_header(); ?>

	<div id="content" class="clearfix">

		<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title"><?php echo $wp_query->found_posts; ?> <?php printf( __( 'Search Results for: %s', 'piha' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!--end .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php	get_template_part( 'content', get_post_format() ); ?>
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
				
			<?php else : ?>
			
			<article id="post-0" class="page no-results not-found">
				<div class="entry-wrap">

					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'piha' ); ?></h1>
					</header><!--end .entry-header -->
					
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'piha' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- end .entry-content -->				
				</div><!-- end .entry-wrap -->
			</article>

			<?php endif; ?>

	</div><!--end #content-->
</div><!-- end #page -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>