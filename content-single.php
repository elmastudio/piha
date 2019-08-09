<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Piha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( get_post_format() ) : ?>
		<div class="post-format-single <?php echo get_post_format(); ?>"><?php _e('Post Format', 'piha') ?></div>
	<?php else: ?>
		<div class="post-format-single standard"><?php _e('Post Format', 'piha') ?></div>
	<?php endif; ?>

	<div class="entry-wrap">
		<header class="entry-header">
			<a class="post-date" href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!--end .entry-header -->
		
		<div class="entry-content">
			<?php if ( has_post_thumbnail() ): ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			<?php endif; ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'piha' ), 'after' => '</div>' ) ); ?>
		</div><!-- end .entry-content -->
			
		<?php if ( get_post_format() ) : // Show author bio only for standard post format posts ?>
	
		<?php else: ?>
			
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>	
				<div class="author-info">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'piha_author_bio_avatar_size', 50 ) ); ?>
					<div class="author-description">
						<h3><?php printf( __( 'Author: %s', 'piha' ), "<a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h3>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div><!-- end .author-description -->			
				</div><!-- end .author-info -->
			<?php endif; ?>
			
		<?php endif; ?>
	
	</div><!--end .entry-wrap-->
	
		<footer class="entry-meta singlepost">
			<p><span><?php _e('Posted by:', 'piha') ?></span> <?php the_author_posts_link(); ?>
			<span><?php _e('| Conversation:', 'piha') ?></span> <?php comments_popup_link( __( '0 comments', 'piha' ), __( '1 comment', 'piha' ), __( '% comments', 'piha' ), 'comments-link', __( 'comments off', 'piha' ) ); ?>
			<span><?php _e('| Category:', 'piha') ?></span> <?php the_category( ', ' ); ?>
			<?php $tags_list = get_the_tag_list( '', ', ' ); 
			if ( $tags_list ): ?>	
			<span><?php _e('| Tags:', 'piha') ?></span> <?php the_tags( '', ', ', '' ); ?>
			<?php endif; ?>
			<?php edit_post_link(__( 'Edit post &raquo;', 'piha'), '<span>| </span>'); ?></p>
			
			<?php // Share post buttons (short URL, Twitter, Facebook Like, Google+). Activated on theme options page.
			$options = get_option('piha_theme_options');
			if($options['share-single-posts'] or $options['share-posts']) : ?>
				<?php get_template_part( 'share-posts'); ?>
			<?php endif; ?>
		</footer><!-- end .entry-meta -->

</article><!-- end .post-<?php the_ID(); ?> -->