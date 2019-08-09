<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Piha
 */

get_header(); ?>

	<div id="content" class="clearfix">
		<header class="page-header">
			<h1 class="page-title"><?php printf( __( 'Category Archives: %s', 'piha' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
			<?php
				$category_description = category_description();
				if ( ! empty( $category_description ) )
					echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
			?>
		</header><!-- end .page-header -->
				
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