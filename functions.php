<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
	function chld_thm_cfg_locale_css( $uri ){
		if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
			$uri = get_template_directory_uri() . '/rtl.css';
		return $uri;
	}
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
	function chld_thm_cfg_parent_css() {
		wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

if ( !function_exists( 'child_theme_configurator_css' ) ):
	function child_theme_configurator_css() {
		wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'chld_thm_cfg_parent' ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

/**
 * WPYTHub Customization
 */

/**
 * Do not allow the plugin to embed videos automatically.
 * Embedding will be made directly into the theme templates.
 */
add_filter( 'ccb_embed_videos', function() {
	if( !is_admin() ){
		return false;
	}
});

/**
 * Video embedding template function
 */
function poseidon_wpythub_post_video(){

	if( function_exists( 'cbc_video_embed_html' ) ) {
		$embed = cbc_video_embed_html();
		if ( ! $embed ) {
			poseidon_post_image_single();
		}
	}
}

/**
 * !!! Override main theme function to introduce condition for video posts !!!
 * @see poseidon/inc/template-tags.php:64
 *
 * Displays the custom header image below the navigation menu
 */
function poseidon_header_image() {
    // No header image for videos
	if( function_exists( 'ccb_is_video' ) && ccb_is_video() ){
		return;
	}

	// Get theme options from database.
	$theme_options = poseidon_theme_options();

	// Display featured image as header image on static pages.
	if ( is_page() && has_post_thumbnail() ) : ?>

		<div id="headimg" class="header-image featured-image-header">
			<?php the_post_thumbnail( 'poseidon-header-image' ); ?>
		</div>

	<?php // Display header image on single posts.
	elseif ( is_single() && has_post_thumbnail() && 'header' == $theme_options['post_layout_single'] ) : ?>

		<div id="headimg" class="header-image featured-image-header">
			<?php the_post_thumbnail( 'poseidon-header-image' ); ?>
		</div>

	<?php // Display default header image set on Appearance > Header.
	elseif ( get_header_image() ) :

		// Hide header image on front page.
		if ( true === $theme_options['custom_header_hide'] and is_front_page() ) {
			return;
		}
		?>

		<div id="headimg" class="header-image">

			<?php // Check if custom header image is linked.
			if ( '' !== $theme_options['custom_header_link'] ) : ?>

				<a href="<?php echo esc_url( $theme_options['custom_header_link'] ); ?>">
					<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>

			<?php else : ?>

				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

			<?php endif; ?>

		</div>

	<?php
	endif;
}

/**
 * End WPYTHub customization
 */