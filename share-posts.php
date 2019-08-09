<?php
/**
 * The Share option for posts

 * @package WordPress
 * @subpackage Piha
 */
?>

<ul class="share">
	<li class="post-shortlink"><?php _e( 'Short URL', 'piha' ); ?> <input type='text' value='<?php echo wp_get_shortlink(get_the_ID()); ?>' onclick='this.focus(); this.select();' /></li>
	<li class="post-twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>">Tweet</a><script type="text/javascript" src="https://platform.twitter.com/widgets.js"></script></li>
	<li class="post-fb"><iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=120&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true"></iframe></li>
	<li class="post-googleplus"><g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone></li>
</ul><!-- end .share -->
