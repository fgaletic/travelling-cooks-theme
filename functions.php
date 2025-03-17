<?php

/**
 * Theme setup.
 */
function tailpress_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(array(
		'primary' => __('Primary Menu'),
		'footer' => __('Footer Menu')
	));

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

    add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'tailpress_setup' );

/**
 * Enqueue theme assets.
 */
function tailpress_enqueue_scripts() {
    $theme = wp_get_theme();

    wp_enqueue_style('tailpress', get_stylesheet_directory_uri() . '/css/app.css', array(), $theme->get('Version'));

    // Add cache-busting versioning to avoid loading old files
    $script_version = filemtime(get_template_directory() . '/js/app.js'); 
    wp_enqueue_script('tailpress-js', get_stylesheet_directory_uri() . '/js/app.js', array('jquery'), $script_version, true);
}

add_action('wp_enqueue_scripts', 'tailpress_enqueue_scripts');

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function tailpress_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3 );

function enqueue_jquery() {
    // Ensure jQuery is loaded
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

add_action('get_header', function() {
    if (is_user_logged_in()) {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }
});

function disable_avada_assets() {
    // Disable Avada styles and scripts
    wp_dequeue_style('fusion-dynamic-css');
    wp_dequeue_script('avada-scripts');
    wp_dequeue_script('fusion-scripts');
}
add_action('wp_enqueue_scripts', 'disable_avada_assets', 20);

// Add custom image sizes with specific crop positions
add_action('after_setup_theme', function() {
    // Card thumbnails (3:2 ratio) - crop from center
    add_image_size('card-thumbnail', 600, 400, array('center', 'center'));
    
    // Square thumbnails for round images - crop from center
    add_image_size('square-thumbnail', 400, 400, array('center', 'center'));
    
    // Hero image (16:9 ratio) - crop from center top
    add_image_size('hero-image', 1920, 1080, array('center', 'top'));
});

// Make custom image sizes available in WordPress admin
add_filter('image_size_names_choose', function($sizes) {
    return array_merge($sizes, array(
        'card-thumbnail' => __('Card Thumbnail'),
        'square-thumbnail' => __('Square Thumbnail'),
        'hero-image' => __('Hero Image')
    ));
});

function travelling_cooks_scripts() {
    // Add Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'
    );

    // Add mobile menu script
    wp_enqueue_script(
        'travelling-cooks-mobile-menu',
        get_template_directory_uri() . '/assets/js/app.js',
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'travelling_cooks_scripts');

