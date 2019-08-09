<?php
/**
 * The Sidebar containing the widget areas.
 
 * @package WordPress
 * @subpackage Piha
 */
?>

	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		
			<aside id="archives" class="widget">
				<h3 class="widget-title"><?php _e( 'Archives', 'piha' ); ?></h3>
				<ul class="widget_archives">
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h3 class="widget-title"><?php _e( 'Meta', 'piha' ); ?></h3>
				<ul class="widget_meta">
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary -->