<?php
/**
 * piha Theme Options
 *
 * @package WordPress
 * @subpackage Piha
 */

/*-----------------------------------------------------------------------------------*/
/* Properly enqueue styles and scripts for our theme options page.
/*
/* This function is attached to the admin_enqueue_scripts action hook.
/*
/* @param string $hook_suffix The action passes the current page to the function.
/* We don't do anything if we're not on our theme options page.
/*-----------------------------------------------------------------------------------*/

function piha_admin_enqueue_scripts( $hook_suffix ) {
	if ( $hook_suffix != 'appearance_page_theme_options' )
		return;

	wp_enqueue_style( 'piha-theme-options', get_template_directory_uri() . '/includes/theme-options.css', false, '2011-04-28' );
	wp_enqueue_script( 'piha-theme-options', get_template_directory_uri() . '/includes/theme-options.js', array( 'farbtastic' ), '2011-04-28' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_enqueue_scripts', 'piha_admin_enqueue_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Register the form setting for our piha_options array.
/*
/* This function is attached to the admin_init action hook.
/*
/* This call to register_setting() registers a validation callback, piha_theme_options_validate(),
/* which is used when the option is saved, to ensure that our option values are complete, properly
/* formatted, and safe.
/*
/* We also use this function to add our theme option if it doesn't already exist.
/*-----------------------------------------------------------------------------------*/

function piha_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === piha_get_theme_options() )
		add_option( 'piha_theme_options', piha_get_default_theme_options() );

	register_setting(
		'piha_options',       // Options group, see settings_fields() call in theme_options_render_page()
		'piha_theme_options', // Database option, see piha_get_theme_options()
		'piha_theme_options_validate' // The sanitization callback, see piha_theme_options_validate()
	);
}
add_action( 'admin_init', 'piha_theme_options_init' );

/*-----------------------------------------------------------------------------------*/
/* Add our theme options page to the admin menu.
/*
/* This function is attached to the admin_menu action hook.
/*-----------------------------------------------------------------------------------*/

function piha_theme_options_add_page() {
	add_theme_page(
		__( 'Theme Options', 'piha' ), // Name of page
		__( 'Theme Options', 'piha' ), // Label in menu
		'edit_theme_options',                  // Capability required
		'theme_options',                       // Menu slug, used to uniquely identify the page
		'theme_options_render_page'            // Function that renders the options page
	);
}
add_action( 'admin_menu', 'piha_theme_options_add_page' );

/*-----------------------------------------------------------------------------------*/
/* Returns an array of font options registered for Piha
/*-----------------------------------------------------------------------------------*/

function piha_fonts() {
	$fonts_options = array(
		'font-sansserif' => array(
			'value' => 'font-sansserif',
			'label' => __( 'sans-serif', 'piha' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/sansserif.png',
		),
		'font-serif' => array (
			'value' => 'font-serif',
			'label' => __( 'serif', 'piha' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/serif.png',
		),
	);

	return apply_filters( 'piha_fonts', $fonts_options );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the default options for Piha
/*-----------------------------------------------------------------------------------*/

function piha_get_default_theme_options() {
	$default_theme_options = array(
		'link_color'   => '#8958B5',
		'theme_fonts' => 'font-sansserif',
		'custom_logo' => '',
		'header_search' => '',
		'custom_headerslogan' => '',
		'custom_footertext' => '',
		'custom_favicon' => '',
		'share-posts' => '',
		'share-single-posts' => '',
		'nav_mobile' => '1',
	);

	return apply_filters( 'piha_default_theme_options', $default_theme_options );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Piha
/*-----------------------------------------------------------------------------------*/

function piha_get_theme_options() {
	return get_option( 'piha_theme_options' );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Piha
/*-----------------------------------------------------------------------------------*/

function theme_options_render_page() {
	?>
	<div class="wrap">
		<h2><?php printf( __( '%s Theme Options', 'piha' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'piha_options' );
				$options = piha_get_theme_options();
				$default_options = piha_get_default_theme_options();
			?>

			<table class="form-table">

				<tr valign="top"><th scope="row"><?php _e( 'Customize Link Color', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Link Color', 'piha' ); ?></span></legend>
							<input type="text" name="piha_theme_options[link_color]" id="link-color" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
							<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
							<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color', 'piha' ); ?>">
							<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
							<br />
							<small class="description"><?php printf( __( 'Default color: %s', 'piha' ), $default_options['link_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top" class="image-radio-option"><th scope="row"><?php _e( 'Font Option', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Font Option', 'piha' ); ?></span></legend>
						<?php
							foreach ( piha_fonts() as $fonts ) {
								?>

								<label class="description">
									<input type="radio" name="piha_theme_options[theme_fonts]" value="<?php echo esc_attr( $fonts['value'] ); ?>" <?php checked( $options['theme_fonts'], $fonts['value'] ); ?> />
									<span>
										<img src="<?php echo esc_url( $fonts['thumbnail'] ); ?>"/>
										<?php echo $fonts['label']; ?>
									</span>
								</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Logo Image', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Logo image', 'piha' ); ?></span></legend>
							<input class="regular-text" type="text" name="piha_theme_options[custom_logo]" value="<?php esc_attr_e( $options['custom_logo'] ); ?>" />
						<br/><label class="description" for="piha_theme_options[custom_logo]"><a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('Upload your own logo image', 'piha'); ?></a> <?php _e(' using the WordPress Media Library and then insert the URL here', 'piha'); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Show search form in header', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Show search form in header', 'piha' ); ?></span></legend>
							<input id="piha_theme_options[header_search]" name="piha_theme_options[header_search]" type="checkbox" value="1" <?php checked( '1', $options['header_search'] ); ?> />
							<label class="description" for="piha_theme_options[header_search]"><?php _e( 'Check this box to show a search form in the headers top bar.', 'piha' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Header Slogan', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Header Slogan', 'piha' ); ?></span></legend>
							<textarea id="piha_theme_options[custom_headerslogan]" class="small-text" cols="100" rows="4" name="piha_theme_options[custom_headerslogan]"><?php echo esc_textarea( $options['custom_headerslogan'] ); ?></textarea>
						<br/><label class="description" for="piha_theme_options[custom_headerslogan]"><?php _e( 'If you want to show a header slogan text, insert your slogan text here.', 'piha' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Footer text', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Footer text', 'piha' ); ?></span></legend>
							<textarea id="piha_theme_options[custom_footertext]" class="small-text" cols="100" rows="4" name="piha_theme_options[custom_footertext]"><?php echo esc_textarea( $options['custom_footertext'] ); ?></textarea>
						<br/><label class="description" for="piha_theme_options[custom_footertext]"><?php _e( 'Customize the footer credit text. Standard HTML is allowed.', 'piha' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Favicon', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Favicon', 'piha' ); ?></span></legend>
							<input class="regular-text" type="text" name="piha_theme_options[custom_favicon]" value="<?php esc_attr_e( $options['custom_favicon'] ); ?>" />
						<br/><label class="description" for="piha_theme_options[custom_favicon]"><?php _e( 'Create a favicon image, upload your .ico Favicon image (via FTP) to your server and enter the Favicon URL here.', 'piha' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Share post buttons', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share post buttons', 'piha' ); ?></span></legend>
							<input id="piha_theme_options[share-posts]" name="piha_theme_options[share-posts]" type="checkbox" value="1" <?php checked( '1', $options['share-posts'] ); ?> />
							<label class="description" for="piha_theme_options[share-posts]"><?php _e( 'Check this box to include a post short URL, Twitter, Facebook and Google+ button on the blogs front page and on single post pages.', 'piha' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Share post buttons on single posts only', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share post buttons on single posts only', 'piha' ); ?></span></legend>
							<input id="piha_theme_options[share-single-posts]" name="piha_theme_options[share-single-posts]" type="checkbox" value="1" <?php checked( '1', $options['share-single-posts'] ); ?> />
							<label class="description" for="piha_theme_options[share-single-posts]"><?php _e( 'Check this box to include the share post buttons <strong>only</strong> on single post pages.', 'piha' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Mobile optimized Main Navigation', 'piha' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Mobile optimized Main Navigation', 'piha' ); ?></span></legend>
							<input id="piha_theme_options[nav_mobile]" name="piha_theme_options[nav_mobile]" type="checkbox" value="1" <?php checked( '1', $options['nav_mobile'] ); ?> />
							<label class="description" for="piha_theme_options[nav_mobile]"><?php _e( 'Check this box to deactivate the mobile optimized main navigation.<br/>(This option will hide the menu button for small screens like tablet pcs and smartphones. The mobile main navigation will always be extended instead.)', 'piha' ); ?></label>
						</fieldset>
					</td>
				</tr>

			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Sanitize and validate form input. Accepts an array, return a sanitized array.
/*-----------------------------------------------------------------------------------*/

function piha_theme_options_validate( $input ) {
	global $layout_options, $font_options;

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
			$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	// Theme font must be in our array of theme fonts options
	if ( isset( $input['theme_fonts'] ) && array_key_exists( $input['theme_fonts'], piha_fonts() ) )
		$output['theme_fonts'] = $input['theme_fonts'];

	// Text options must be safe text with no HTML tags
	$input['custom_logo'] = wp_filter_nohtml_kses( $input['custom_logo'] );
	$input['custom_favicon'] = wp_filter_nohtml_kses( $input['custom_favicon'] );

	// checkbox value is either 0 or 1
	if ( ! isset( $input['share-posts'] ) )
		$input['share-posts'] = null;
	$input['share-posts'] = ( $input['share-posts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['share-single-posts'] ) )
		$input['share-single-posts'] = null;
	$input['share-single-posts'] = ( $input['share-single-posts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['nav_mobile'] ) )
		$input['nav_mobile'] = null;
	$input['nav_mobile'] = ( $input['nav_mobile'] == 1 ? 1 : 0 );

	if ( ! isset( $input['header_search'] ) )
		$input['header_search'] = null;
	$input['header_search'] = ( $input['header_search'] == 1 ? 1 : 0 );

	return $input;
}

/*-----------------------------------------------------------------------------------*/
/* Add the custom JavaScript for the mobile optimized show/hide main navigation button
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function piha_print_nav_mobile_script() {
	$options = piha_get_theme_options();
	$nav_mobile = $options['nav_mobile'];

	$default_options = piha_get_default_theme_options();

	// Don't do anything if the current nav mobile is the default option.
	if ( $default_options['nav_mobile'] == $nav_mobile )
		return;

?>
<script type="text/javascript">
jQuery(document).ready(function(){
			jQuery("#main-nav-mobile .menu").hide();

		jQuery("a.nav-mobile-btn").click(function () {
			 jQuery('#main-nav-mobile .menu').slideToggle("400");
		});
});
</script>
<?php
}
add_action( 'wp_head', 'piha_print_nav_mobile_script' );

/*-----------------------------------------------------------------------------------*/
/* Add the style block to the theme for the not mobile optimized navigation
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function piha_print_nav_mobile_style() {
	$options = piha_get_theme_options();
	$nav_mobile = $options['nav_mobile'];

$default_options = piha_get_default_theme_options();

	// Don't do anything if the current nav_mobile is the default.
	if ( $default_options['nav_mobile'] != $nav_mobile )
		return;
?>
<style type="text/css">
@media screen and (max-width: 1110px) {
#main-nav-mobile span.nav-mobile-menu {display:none;}
#main-nav-mobile .menu {display:block !important;}
}
</style>
<?php
}
add_action( 'wp_head', 'piha_print_nav_mobile_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current link color.
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function piha_print_link_color_style() {
	$options = piha_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = piha_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
<style type="text/css">
/* Custom link color */
a, #content .entry-header h2.entry-title a:hover,ul.share li.post-shortlink input,#content .comment-header p a:hover,#smart-archives-list a:hover,#content .related-posts ul li a:hover, #main-nav-mobile ul li a, #main-nav-mobile ul li ul li a:hover, #main-nav-mobile li:hover > a, #main-nav-mobile li li:hover > a {color:<?php echo $link_color; ?>;}
#content a.post-format,#content .post-format-single{background:<?php echo $link_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/postformat-icons.png) 0 0 no-repeat;}
#content .format-link .entry-content a.link-format-btn{background:<?php echo $link_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/icon-sprites.png) right -245px  no-repeat;}
input#submit,input.wpcf7-submit, .jetpack_subscription_widget form#subscribe-blog input[type="submit"] {background-color:<?php echo $link_color; ?>;}
.widget_search .searchsubmit{background:<?php echo $link_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/icon-sprites.png) 67% -43px no-repeat;}
#top-nav .search-mobile a.search-mobile-btn {background:<?php echo $link_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/icon-sprites.png) 11px -43px no-repeat;}
#main-nav-mobile a.nav-mobile-btn {background:<?php echo $link_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/icon-sprites.png) 10px -202px no-repeat;
</style>
<?php
}
add_action( 'wp_head', 'piha_print_link_color_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current font option.
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function piha_print_font_style() {
	$options = piha_get_theme_options();
	$theme_fonts = $options['theme_fonts'];

	$default_options = piha_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['theme_fonts'] == $theme_fonts )
		return;
?>
<style type="text/css">
/* Serif Font */
#site-title,#header-slogan p,#content .entry-wrap{font-family:Georgia, 'Times New Roman', serif;}
#content .entry-header h1.entry-title,#content h2.entry-title{font-size:1.8em;}
#site-title h1{font-size:2.8em;}
#site-title h2#site-description{font-size:1em;font-style:italic;}
#header-slogan p{font-size:1.2em;font-style:italic;}
#content p{font-size:1.1em;}
</style>
<?php
}
add_action( 'wp_head', 'piha_print_font_style' );
