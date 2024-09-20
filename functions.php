<?php

/**
 * hwc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hwc
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hwc_setup()
{
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on hwc, use a find and replace
		* to change 'hwc' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('hwc', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'hwc'),
        )
    );

    /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'hwc_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'hwc_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hwc_content_width()
{
    $GLOBALS['content_width'] = apply_filters('hwc_content_width', 640);
}
add_action('after_setup_theme', 'hwc_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function hwc_scripts()
{
    wp_enqueue_style('hwc-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('hwc-style', 'rtl', 'replace');

    /*--------------------------------------------------------------
	>>> Enqueue JS:
	----------------------------------------------------------------*/
    wp_enqueue_script('hwc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('hwc-main-js', get_template_directory_uri() . '/js/hwc-main.js', array(), _S_VERSION, true);

    /*--------------------------------------------------------------
	>>> Enqueue CSS:
	----------------------------------------------------------------*/
    wp_enqueue_style('hwc-main-css', get_template_directory_uri() . '/css/hwc-main.css');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'hwc_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/*--------------------------------------------------------------
	>>> All Action and Filter Functions
	----------------------------------------------------------------*/
add_action('after_switch_theme', 'hwc_check_acf_pro_before_activation');
add_action('after_switch_theme', 'hwc_activate_theme_setup');

/*--------------------------------------------------------------
	>>> Hook into 'after_switch_theme' to run the check when the theme is activated
	----------------------------------------------------------------*/
function hwc_check_acf_pro_before_activation()
{

    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    // Check if ACF Pro is installed
    if (!is_acf_pro_installed()) {
        // Show error if ACF Pro is not available
        add_action('admin_notices', 'acf_pro_missing_error');
        switch_theme(WP_DEFAULT_THEME); // Revert to the default theme if ACF Pro is not installed
        return;
    }

    // Check if ACF Pro is installed
    if (!is_hwc_plugin_installed()) {
        // Show error if ACF Pro is not available
        add_action('admin_notices', 'hwc_plugin_missing_error');
        switch_theme(WP_DEFAULT_THEME); // Revert to the default theme if ACF Pro is not installed
        return;
    }

    // Check if ACF Pro is installed but inactive
    if (!is_plugin_active('advanced-custom-fields-pro/acf.php')) {
        // Show error if ACF Pro is not available
        add_action('admin_notices', 'acf_pro_missing_error');
        switch_theme(WP_DEFAULT_THEME); // Revert to the default theme if ACF Pro is not installed
        return;
    }

    // Check if HWC Plugin is installed but inactive
    if (!is_plugin_active('hwc/hwc.php')) {
        // Show error if ACF Pro is not available
        add_action('admin_notices', 'hwc_plugin_missing_error');
        switch_theme(WP_DEFAULT_THEME); // Revert to the default theme if ACF Pro is not installed
        return;
    }

    // Ensure ACF content remains unchanged (ACF data is saved in the database, so this happens automatically)
}

function is_acf_pro_installed()
{
    // Check if ACF Pro is installed by looking at the plugin directory
    $acf_pro_plugin_path = WP_PLUGIN_DIR . '/advanced-custom-fields-pro/acf.php';
    return file_exists($acf_pro_plugin_path);
}

function is_hwc_plugin_installed()
{
    // Check if ACF Pro is installed by looking at the plugin directory
    $acf_pro_plugin_path = WP_PLUGIN_DIR . '/hwc/hwc.php';
    return file_exists($acf_pro_plugin_path);
}

// Admin notice to show when ACF Pro is missing
function acf_pro_missing_error()
{
?>
    <div class="error notice">
        <p><?php _e('Error: ACF Pro is required to use this theme. Please install and activate ACF Pro.', 'hwc'); ?></p>
    </div>
<?php
}

// Admin notice to show when HWC Plugin is missing
function hwc_plugin_missing_error()
{
?>
    <div class="error notice">
        <p><?php _e('Error: HWC Plugin is required to use this theme. Please install and activate HWC Plugin.', 'hwc'); ?></p>
    </div>
<?php
}

/*--------------------------------------------------------------
	>>> Function to add funstions of blog categories and dummy_posts
	----------------------------------------------------------------*/
function hwc_activate_theme_setup()
{
    if (!is_acf_pro_installed()) {
        // Return back if ACF Pro is not available
        return;
    }

    if (!is_hwc_plugin_installed()) {
        // Return back if ACF Pro is not available
        return;
    }
}

/*--------------------------------------------------------------
	>>> Check if the current page is a single post of type 'team'
	----------------------------------------------------------------*/
function add_custom_body_class($classes)
{
    if (is_singular('team')) {
        $classes[] = 'single-club_team';
    }
    return $classes;
}
add_filter('body_class', 'add_custom_body_class');
//end