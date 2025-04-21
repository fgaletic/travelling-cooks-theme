<?php

/**
 * Theme setup.
 */
function tailpress_setup()
{
    add_theme_support('title-tag');

    register_nav_menus([
        'primary' => __('Primary Menu'),
        'footer' => __('Footer Menu'),
    ]);

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');

    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');

    add_theme_support('responsive-embeds');

    add_theme_support('editor-styles');
    add_editor_style('css/editor-style.css');
}

add_action('after_setup_theme', 'tailpress_setup');

/**
 * Enqueue theme assets.
 */
function tailpress_enqueue_scripts()
{
    $theme = wp_get_theme();

    wp_enqueue_style(
        'tailpress',
        get_stylesheet_directory_uri() . '/css/app.css',
        [],
        $theme->get('Version')
    );

    // Add cache-busting versioning to avoid loading old files
    $script_version = filemtime(get_template_directory() . '/js/app.js');
    wp_enqueue_script(
        'tailpress-js',
        get_stylesheet_directory_uri() . '/js/app.js',
        ['jquery'],
        $script_version,
        true
    );
}

add_action('wp_enqueue_scripts', 'tailpress_enqueue_scripts');

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function tailpress_asset($path)
{
    if (wp_get_environment_type() === 'production') {
        return get_stylesheet_directory_uri() . '/' . $path;
    }

    return add_query_arg(
        'time',
        time(),
        get_stylesheet_directory_uri() . '/' . $path
    );
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
function tailpress_nav_menu_add_li_class($classes, $item, $args, $depth)
{
    if (isset($args->li_class)) {
        $classes[] = $args->li_class;
    }

    if (isset($args->{"li_class_$depth"})) {
        $classes[] = $args->{"li_class_$depth"};
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4);

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class($classes, $args, $depth)
{
    if (isset($args->submenu_class)) {
        $classes[] = $args->submenu_class;
    }

    if (isset($args->{"submenu_class_$depth"})) {
        $classes[] = $args->{"submenu_class_$depth"};
    }

    return $classes;
}

add_filter(
    'nav_menu_submenu_css_class',
    'tailpress_nav_menu_add_submenu_class',
    10,
    3
);

function enqueue_jquery()
{
    // Ensure jQuery is loaded
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

add_action('get_header', function () {
    if (is_user_logged_in()) {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }
});

function disable_avada_assets()
{
    // Disable Avada styles and scripts
    wp_dequeue_style('fusion-dynamic-css');
    wp_dequeue_script('avada-scripts');
    wp_dequeue_script('fusion-scripts');
}
add_action('wp_enqueue_scripts', 'disable_avada_assets', 20);

// Add custom image sizes with specific crop positions
add_action('after_setup_theme', function () {
    // Card thumbnails (3:2 ratio) - crop from center
    add_image_size('card-thumbnail', 600, 400, ['center', 'center']);

    // Square thumbnails for round images - crop from center
    add_image_size('square-thumbnail', 400, 400, ['center', 'center']);

    // Hero image (16:9 ratio) - crop from center top
    add_image_size('hero-image', 1920, 1080, ['center', 'top']);
});

// Make custom image sizes available in WordPress admin
add_filter('image_size_names_choose', function ($sizes) {
    return array_merge($sizes, [
        'card-thumbnail' => __('Card Thumbnail'),
        'square-thumbnail' => __('Square Thumbnail'),
        'hero-image' => __('Hero Image'),
    ]);
});

function travelling_cooks_scripts()
{
    // Add Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'
    );

    // Add mobile menu script
    wp_enqueue_script(
        'travelling-cooks-mobile-menu',
        get_template_directory_uri() . '/assets/js/app.js',
        [],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'travelling_cooks_scripts');

function travelling_cooks_enqueue_scripts() {
    // ...existing enqueued scripts...

    wp_enqueue_script(
        'header-scroll',
        get_template_directory_uri() . '/js/header-scroll.js',
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'travelling_cooks_enqueue_scripts');

// Add ACF Options Page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
    ]);
}

function travelling_cooks_customize_register($wp_customize)
{
    // Add Hero Section Title
    $wp_customize->add_section('hero_section', [
        'title' => __('Hero Section', 'travelling-cooks'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('hero_title', [
        'default' => __(
            'Welcome to my world of travel and food',
            'travelling-cooks'
        ),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('hero_title', [
        'label' => __('Hero Title', 'travelling-cooks'),
        'section' => 'hero_section',
        'settings' => 'hero_title',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('hero_subtitle', [
        'default' => __(
            '..where I navigate this exciting chapter of my life in my fabulous 50ish ++',
            'travelling-cooks'
        ),
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('hero_subtitle', [
        'label' => __('Hero Subtitle', 'travelling-cooks'),
        'section' => 'hero_section',
        'settings' => 'hero_subtitle',
        'type' => 'text',
    ]);

    // Footer Social Media Links Section
    $wp_customize->add_section('footer_social_links', [
        'title' => __('Footer Social Links', 'travelling-cooks'),
        'priority' => 40,
    ]);

    $social_links = ['facebook', 'twitter', 'instagram'];
    foreach ($social_links as $social) {
        $wp_customize->add_setting("footer_{$social}_link", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control("footer_{$social}_link", [
            'label' => ucfirst($social) . ' URL',
            'section' => 'footer_social_links',
            'type' => 'url',
        ]);
    }

    // Blog Layout Section
    $wp_customize->add_section('blog_layout', [
        'title' => __('Blog Layout', 'travelling-cooks'),
        'priority' => 50,
    ]);

    $wp_customize->add_setting('blog_layout_style', [
        'default' => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('blog_layout_style', [
        'label' => __('Blog Layout Style', 'travelling-cooks'),
        'section' => 'blog_layout',
        'type' => 'radio',
        'choices' => [
            'grid' => __('Grid', 'travelling-cooks'),
            'list' => __('List', 'travelling-cooks'),
        ],
    ]);

    // Homepage Sections
    $wp_customize->add_section('homepage_sections', [
        'title' => __('Homepage Sections', 'travelling-cooks'),
        'priority' => 60,
    ]);

    $wp_customize->add_setting('homepage_sections_order', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('homepage_sections_order', [
        'label' => __(
            'Homepage Sections Order (comma-separated)',
            'travelling-cooks'
        ),
        'section' => 'homepage_sections',
        'type' => 'text',
        'description' => __(
            'Example: hero,about,services,contact',
            'travelling-cooks'
        ),
    ]);

    // Blog Post Custom Fields Section
    $wp_customize->add_section('blog_post_custom_fields', [
        'title' => __('Blog Post Custom Fields', 'travelling-cooks'),
        'priority' => 70,
    ]);

    // Add a custom field for "Author Bio"
    $wp_customize->add_setting('blog_author_bio', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('blog_author_bio', [
        'label' => __('Author Bio', 'travelling-cooks'),
        'section' => 'blog_post_custom_fields',
        'type' => 'textarea',
    ]);

    // Add a custom field for "Featured Quote"
    $wp_customize->add_setting('blog_featured_quote', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('blog_featured_quote', [
        'label' => __('Featured Quote', 'travelling-cooks'),
        'section' => 'blog_post_custom_fields',
        'type' => 'text',
    ]);
}

add_action('customize_register', 'travelling_cooks_customize_register');

// Include post meta functionality
require get_template_directory() . '/inc/meta-styles.php';
require get_template_directory() . '/inc/recipe-meta.php';
require get_template_directory() . '/inc/travel-meta.php';
require get_template_directory() . '/inc/review-meta.php';

function tc_add_destinations_menu()
{
    add_menu_page(
        'Destinations',
        'Destinations',
        'manage_options',
        'destinations-settings',
        'tc_destinations_page',
        'dashicons-location',
        30
    );
}
add_action('admin_menu', 'tc_add_destinations_menu');

function tc_destinations_page()
{
    // Load icons from JSON file
    $icons_json = file_get_contents(
        get_template_directory() . '/assets/icons/fa-free-icons.json'
    );
    $available_icons = json_decode($icons_json, true);

    if (!$available_icons) {
        // Fallback if JSON fails to load
        $available_icons = [
            'fas fa-plane' => 'Plane',
            'fas fa-utensils' => 'Restaurant',
            'fas fa-coffee' => 'Coffee',
            'fas fa-mountain' => 'Mountain',
        ];
    }

    // Save settings logic
    if (
        isset($_POST['tc_save_destinations']) &&
        check_admin_referer('tc_destinations_nonce')
    ) {
        $destinations = [];
        $countries = $_POST['country'] ?? [];
        $icons = $_POST['icon'] ?? [];

        foreach ($countries as $index => $country) {
            if (!empty($country) && !empty($icons[$index])) {
                $destinations[] = [
                    'country' => sanitize_text_field($country),
                    'icon' => sanitize_text_field($icons[$index]),
                ];
            }
        }

        update_option('destination_meta', $destinations);
        echo '<div class="notice notice-success"><p>Destinations updated successfully!</p></div>';
    }

    // Get current destinations
    $destinations = get_option('destination_meta', []);
    ?>
    <div class="wrap">
        <h1>Manage Destinations</h1>
        <p>Add or edit destinations that appear in the "Where to next?" section.</p>
        
        <form method="post">
            <?php wp_nonce_field('tc_destinations_nonce'); ?>
            <div id="destination-fields">
                <?php foreach ($destinations as $index => $destination): ?>
                    <div class="destination-row" style="margin-bottom: 15px;">
                        <input type="text" 
                               name="country[]" 
                               value="<?php echo esc_attr(
                                   $destination['country']
                               ); ?>" 
                               placeholder="Country name"
                               style="width: 200px; margin-right: 10px;">
                        
                        <select name="icon[]" style="width: 250px;">
                            <?php foreach (
                                $available_icons
                                as $icon_class => $icon_name
                            ): ?>
                                <option value="<?php echo esc_attr(
                                    $icon_class
                                ); ?>" 
                                        <?php selected(
                                            $destination['icon'],
                                            $icon_class
                                        ); ?>>
                                    <i class="<?php echo esc_attr(
                                        $icon_class
                                    ); ?>"></i> <?php echo esc_html(
    $icon_name
); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        
                        <button type="button" class="button remove-destination" style="margin-left: 10px;">Remove</button>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button type="button" class="button" id="add-destination">Add New Destination</button>
            <p class="submit">
                <input type="submit" name="tc_save_destinations" class="button-primary" value="Save Changes">
            </p>
        </form>

        <!-- Preview section -->
        <div style="margin-top: 30px;">
            <h2>Icon Preview</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px; margin-top: 15px;">
                <?php foreach (
                    $available_icons
                    as $icon_class => $icon_name
                ): ?>
                    <div style="display: flex; align-items: center; padding: 10px; background: #f0f0f0; border-radius: 4px;">
                        <i class="<?php echo esc_attr(
                            $icon_class
                        ); ?>" style="margin-right: 10px;"></i>
                        <?php echo esc_html($icon_name); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#add-destination').on('click', function() {
            var iconOptions = <?php echo json_encode($available_icons); ?>;
            var selectHtml = '<select name="icon[]" style="width: 250px;">';
            
            for (var value in iconOptions) {
                selectHtml += '<option value="' + value + '">' + iconOptions[value] + '</option>';
            }
            selectHtml += '</select>';

            var row = $('<div class="destination-row" style="margin-bottom: 15px;">' +
                '<input type="text" name="country[]" placeholder="Country name" style="width: 200px; margin-right: 10px;">' +
                selectHtml +
                '<button type="button" class="button remove-destination" style="margin-left: 10px;">Remove</button>' +
                '</div>');
            
            $('#destination-fields').append(row);
        });

        $(document).on('click', '.remove-destination', function() {
            $(this).closest('.destination-row').remove();
        });
    });
    </script>
    <?php
}

function tc_admin_scripts($hook)
{
    // Only load on our destinations page
    if ($hook != 'toplevel_page_destinations-settings') {
        return;
    }

    // Add Font Awesome to admin
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'
    );
}
add_action('admin_enqueue_scripts', 'tc_admin_scripts');
