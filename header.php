<?php
/**
 * The themes header file.
 *
 * @subpackage Piha
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	$options = get_option('piha_theme_options');
	if( $options['custom_favicon'] != '' ) : ?>
<link rel="shortcut icon" type="image/ico" href="<?php echo $options['custom_favicon']; ?>" />
<?php endif  ?>

<!-- HTML5 enabling script for IE7+8 -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
	wp_enqueue_script('jquery');
	if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>

<body <?php body_class('frame'); ?>>
	<div id="container" class="row expand">
		<div id="page">
			<header id="header">

				<?php // Only display top bar if the header search form or the additional top navigation menu is active.
				$options = get_option('piha_theme_options');
				if( $options['header_search'] == 1  or has_nav_menu( 'top' ) ): ?>
				<div id="top-nav" class="clearfix">

					<?php // Display the search form in top bar
					$options = get_option('piha_theme_options');
					if( $options['header_search'] == 1 ) : ?>

						<div class="search">
							<?php get_search_form(); ?>
						</div><!-- end .search -->

						<div class="search-mobile">
							<a href="#" class="search-mobile-btn"><?php _e('Search', 'piha') ?></a>
							<div class="pulldown">
								<span class="mobile-search-tip"></span>
								<?php get_search_form(); ?>
							</div><!-- end .pulldown -->
						</div><!-- end .search-mobile -->

					<?php endif; ?>

					<?php if (has_nav_menu( 'top' ) ) {
						wp_nav_menu( array('theme_location' => 'top', 'container' => 'nav' ,'depth' => 1 ));}
					?>
				</div><!-- end #top-nav -->

				<?php endif; ?>

				<div id="branding">
					<hgroup id="site-title">
					<?php $options = get_option('piha_theme_options');
					if( $options['custom_logo'] != '' ) : ?>
						<a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo $options['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>

					<?php else: ?>

						<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
							<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>

					<?php endif  ?>

					</hgroup><!-- end #site-title -->

					<?php
					$options = get_option('piha_theme_options');
					if( $options['custom_headerslogan'] != '' ) : ?>
						<div id="header-slogan"><p><?php echo $options['custom_headerslogan']; ?></p></div><!-- end header-slogan -->

					<?php endif  ?>

					<?php if ( get_header_image() ) : ?>

					<?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() &&
						has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
						// if there is a featured image, show it
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>

						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" class="header-image" /><!-- end .header-image -->

						<?php endif; // end check for featured image ?>

					<?php endif; // end check for header image ?>

					<nav id="main-nav" class="clearfix">
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav><!-- end #main-nav -->

					<nav id="main-nav-mobile" class="clearfix">
						<span class="nav-mobile-menu"><a href="#" class="nav-mobile-btn"><?php _e('Menu', 'piha') ?></a></span>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'false', 'menu_class' => 'menu' ) ); ?>
					</nav><!-- end #main-nav-mobile -->

				</div><!-- end #branding -->
			</header><!-- end #header -->
