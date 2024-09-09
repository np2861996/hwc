<?php
/**
 * hwc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hwc
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hwc_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on hwc, use a find and replace
		* to change 'hwc' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'hwc', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'hwc' ),
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
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'hwc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hwc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hwc_content_width', 640 );
}
add_action( 'after_setup_theme', 'hwc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hwc_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'hwc' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hwc' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hwc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hwc_scripts() {
	wp_enqueue_style( 'hwc-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'hwc-style', 'rtl', 'replace' );

	/*--------------------------------------------------------------
	>>> Enqueue JS:
	----------------------------------------------------------------*/
	wp_enqueue_script( 'hwc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'hwc-main-js', get_template_directory_uri() . '/js/hwc-main.js', array(), _S_VERSION, true );
	
	/*--------------------------------------------------------------
	>>> Enqueue CSS:
	----------------------------------------------------------------*/
	wp_enqueue_style('hwc-main-css', get_template_directory_uri() . '/css/hwc-main.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hwc_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*--------------------------------------------------------------
	>>> Hook into 'after_switch_theme' to run the check when the theme is activated
	----------------------------------------------------------------*/
add_action('after_switch_theme', 'check_acf_pro_before_activation');

function check_acf_pro_before_activation() {
    // Check if ACF Pro is installed
    if (!is_acf_pro_installed()) {
        // Show error if ACF Pro is not available
        add_action('admin_notices', 'acf_pro_missing_error');
        switch_theme(WP_DEFAULT_THEME); // Revert to the default theme if ACF Pro is not installed
        return;
    }

    // Check if ACF Pro is installed but inactive
    if (!is_plugin_active('advanced-custom-fields-pro/acf.php')) {
        // Activate ACF Pro if installed but not active
        activate_plugin('advanced-custom-fields-pro/acf.php');
    }

    // Ensure ACF content remains unchanged (ACF data is saved in the database, so this happens automatically)
}

function is_acf_pro_installed() {
    // Check if ACF Pro is installed by looking at the plugin directory
    $acf_pro_plugin_path = WP_PLUGIN_DIR . '/advanced-custom-fields-pro/acf.php';
    return file_exists($acf_pro_plugin_path);
}

// Admin notice to show when ACF Pro is missing
function acf_pro_missing_error() {
    ?>
    <div class="error notice">
        <p><?php _e('Error: ACF Pro is required to use this theme. Please install and activate ACF Pro.', 'hwc'); ?></p>
    </div>
    <?php
}


add_action('after_switch_theme', 'theme_activation_setup');

function theme_activation_setup() {
    if (!class_exists('ACF')) {
        add_action('admin_notices', function() {
            echo '<div class="error"><p>ACF Pro plugin is required for this theme to function correctly.</p></div>';
        });
        return;
    }


    // Create pages with specific templates and slugs
    create_page_with_template('Home', 'template-parts/template-home.php', 'home');
    create_page_with_template('News', 'template-parts/template-news.php', 'news');
    create_page_with_template('Team', 'template-parts/template-team.php', 'team'); // Custom slug 'team'
    create_page_with_template('Matches', 'template-parts/template-matches.php', 'matches');
    create_page_with_template('Club', 'template-parts/template-club.php', 'club');
    create_page_with_template('Community', 'template-parts/template-community.php', 'community');
    create_page_with_template('Academy', 'template-parts/template-academy.php', 'academy');
    create_page_with_template('Video', 'template-parts/template-video.php', 'video');
    create_page_with_template('Accessibility', 'template-parts/template-accessibility.php', 'accessibility');
    create_page_with_template('Commercial', 'template-parts/template-commercial.php', 'commercial');

    
set_default_acf_field_values();

	
  
}

add_action('acf/init', 'setup_acf_fields_for_pages');



// Function to create a page with a specific template and slug
function create_page_with_template($title, $template, $slug) {
    $page_id = get_page_id_by_title($title);
    if (!$page_id) {
        $page_id = wp_insert_post(array(
            'post_title' => $title,
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => $template,
            'post_name' => $slug, // Set custom slug
        ));
    }

    // Update the post slug if needed
    if ($page_id && get_post($page_id)->post_name !== $slug) {
        wp_update_post(array(
            'ID' => $page_id,
            'post_name' => $slug
        ));
    }
}

// Helper function to get page ID by title
function get_page_id_by_title($title) {
    $query = new WP_Query(array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'title' => $title,
        'fields' => 'ids',
    ));
    return $query->posts ? $query->posts[0] : null;
}

// Function to set up ACF fields for each page
function setup_acf_fields_for_pages() {
    if (function_exists('acf_add_local_field_group')) {

        // Define field groups for each page
        $field_groups = array(
            'Home' => array(
                'key' => 'group_home',
                'title' => 'Home Page Fields',
                'fields' => array(
                    array(
                        'key' => 'home_title1',
                        'label' => 'Title 1',
                        'name' => 'home_title1',
                        'type' => 'text',
                        'instructions' => 'Enter the main title for the Home page.',
                    ),
                    array(
                        'key' => 'home_image1',
                        'label' => 'Image 1',
                        'name' => 'home_image1',
                        'type' => 'image',
                        'instructions' => 'Upload an image for the Home page.',
                    ),
                    array(
                        'key' => 'home_description',
                        'label' => 'Description',
                        'name' => 'home_description',
                        'type' => 'textarea',
                        'instructions' => 'Enter the description for the Home page.',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post',
                            'operator' => '==',
                            'value' => get_page_id_by_title('Home'),
                        ),
                    ),
                ),
            ),
            'News' => array(
                'key' => 'group_news',
                'title' => 'News Page Fields',
                'fields' => array(
                    array(
                        'key' => 'news_title',
                        'label' => 'News Title',
                        'name' => 'news_title',
                        'type' => 'text',
                        'instructions' => 'Enter the title for the News page.',
                    ),
                    array(
                        'key' => 'news_image',
                        'label' => 'News Image',
                        'name' => 'news_image',
                        'type' => 'image',
                        'instructions' => 'Upload an image for the News page.',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post',
                            'operator' => '==',
                            'value' => get_page_id_by_title('News'),
                        ),
                    ),
                ),
            ),
            // Define more field groups for other pages similarly...
        );

        foreach ($field_groups as $page_title => $field_group) {
            $page_id = get_page_id_by_title($page_title);
            if ($page_id) {
                acf_add_local_field_group($field_group);
            }
        }
    }
}

// Function to set default values for ACF fields if not already set
function set_default_acf_field_values() {
    $pages = array(
        'Home' => array(
            'home_title1' => 'Welcome to Our Website',
            'home_image1' => 'https://example.com/default-image1.jpg',
            'home_description' => 'Welcome to the home page of our website. We provide the best services in the industry.',
        ),
        'News' => array(
            'news_title' => 'Latest News',
            'news_image' => 'https://example.com/default-news.jpg',
        ),
       /* 'Team' => array(
            'team_title1' => 'Meet Our Team',
            'team_image1' => 'https://example.com/team-image1.jpg',
            'team_link' => 'https://example.com/team',
        ),
        'Commercial' => array(
            'commercial_title' => 'Commercial Page Title',
            'commercial_description' => 'Description for the Commercial page.',
            'commercial_link' => 'https://example.com/commercial',
        ),*/
        // Add default values for additional pages
    );

    foreach ($pages as $page_title => $fields) {
        $page_id = get_page_id_by_title($page_title);
        if ($page_id) {
            foreach ($fields as $field_name => $default_value) {
                if (get_field($field_name, $page_id) === false) {
                    update_field($field_name, $default_value, $page_id);
                }
            }
        }
    }
}
