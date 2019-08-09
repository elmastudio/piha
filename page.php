<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage Piha
 */

get_header(); ?>

	<div id="content" class="clearfix">

		<?php the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php comments_template( '', true ); ?>

	</div><!--end #content-->
</div><!-- end #page -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>