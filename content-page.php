<?php
/**
 * The template used for displaying page content.
 *
 * @package WordPress
 * @subpackage Piha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- end .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'piha' ), 'after' => '</div>' ) ); ?>
		</div><!-- end .entry-content -->
	</div><!--end .entry-wrap -->

	<?php edit_post_link( __( 'Edit this page &raquo;', 'piha'), '<div class="edit-link">', '</div>'); ?>
</article><!-- end post-<?php the_ID(); ?> -->