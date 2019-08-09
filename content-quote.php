<?php
/**
 * The template for displaying posts in the Quote Post Format
 *
 * @package WordPress
 * @subpackage Piha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( 'post' == $post->post_type ) : // Hide post-type and comments info for pages on search results ?>
		<a href="<?php the_permalink(); ?>" class="post-format quote" title="Permalink"><?php _e('Permalink', 'piha') ?></a>
	<?php endif; ?>

	<div class="entry-wrap">
		<header class="entry-header">
		<?php if ( is_sticky() ) : ?>
			<a class="sticky-label" href="<?php the_permalink(); ?>"><?php _e('Featured', 'piha') ?></a>
		<?php else : ?>
			<a class="post-date" href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
		<?php endif; ?>		
		</header><!--end .entry-header -->
		
		<div class="entry-content">
			<?php the_content( __( 'Continue Reading &rarr;', 'piha' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'piha' ), 'after' => '</div>' ) ); ?>
		</div><!-- end .entry-content -->
	</div><!-- end .entry-wrap -->

		<footer class="entry-meta">
			<p><span><?php _e('Quote:', 'piha') ?></span> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'piha' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			<span><?php _e('| Posted by:', 'piha') ?></span> 
				<?php
					printf( __( '<a href="%1$s" title="%2$s">%3$s</a>', 'piha' ),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						sprintf( esc_attr__( 'View all posts by %s', 'piha' ), get_the_author() ),
						get_the_author()
					);
				?>
			<span><?php _e('| Conversation:', 'piha') ?></span> <?php comments_popup_link( __( '0 comments', 'piha' ), __( '1 comment', 'piha' ), __( '% comments', 'piha' ), 'comments-link', __( 'comments off', 'piha' ) ); ?>
			<span><?php _e('| Category:', 'piha') ?></span> <?php the_category( ', ' ); ?>
			<?php $tags_list = get_the_tag_list( '', ', ' ); 
			if ( $tags_list ): ?>	
			<span><?php _e('| Tags:', 'piha') ?></span> <?php the_tags( '', ', ', '' ); ?>
			<?php endif; ?>
			<?php edit_post_link(__( 'Edit post &raquo;', 'piha'), '<span>| </span>'); ?></p>
			
			<?php // Share post buttons (short URL, Twitter, Facebook Like, Google+). Activated on theme options page.
			$options = get_option('piha_theme_options');
			if( $options['share-posts'] ) : ?>
				<?php get_template_part( 'share-posts'); ?>
			<?php endif; ?>
		</footer><!-- end .entry-meta -->

</article><!-- end post -<?php the_ID(); ?> -->