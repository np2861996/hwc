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
	>>> All Action and Filter Functions
	----------------------------------------------------------------*/
add_action('after_switch_theme', 'hwc_check_acf_pro_before_activation');
add_action('after_switch_theme', 'hwc_theme_activation_setup');
add_action('acf/init', 'hwc_setup_acf_fields_for_pages');
add_action('acf/init', 'hwc_set_default_acf_field_values');
add_action('after_switch_theme', 'hwc_activate_theme_setup');
add_action('init', 'hwc_register_custom_post_types');
add_action('acf/init', 'hwc_add_acf_fields');
add_action('acf/init', 'hwc_populate_default_data');



/*--------------------------------------------------------------
	>>> Hook into 'after_switch_theme' to run the check when the theme is activated
	----------------------------------------------------------------*/
function hwc_check_acf_pro_before_activation() {

    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

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

/*--------------------------------------------------------------
	>>> Hook into 'after_switch_theme' to run the check when the theme is activated
	----------------------------------------------------------------*/
function hwc_theme_activation_setup() {

    if (!is_acf_pro_installed()) {
        // Return back if ACF Pro is not available
        return;
    }

    // Define an array of pages to create with their templates and slugs
    $pages = array(
        array(
            'title'     => 'Home',
            'template'  => 'template-parts/template-home.php',
            'slug'      => 'home'
        ),
        array(
            'title'     => 'News',
            'template'  => 'template-parts/template-news.php',
            'slug'      => 'news'
        ),
        array(
            'title'     => 'Team',
            'template'  => 'template-parts/template-team.php',
            'slug'      => 'team'
        ),
        array(
            'title'     => 'Matches',
            'template'  => 'template-parts/template-matches.php',
            'slug'      => 'matches'
        ),
        array(
            'title'     => 'Club',
            'template'  => 'template-parts/template-club.php',
            'slug'      => 'club'
        ),
        array(
            'title'     => 'Community',
            'template'  => 'template-parts/template-community.php',
            'slug'      => 'community'
        ),
        array(
            'title'     => 'Academy',
            'template'  => 'template-parts/template-academy.php',
            'slug'      => 'academy'
        ),
        array(
            'title'     => 'Video',
            'template'  => 'template-parts/template-video.php',
            'slug'      => 'video'
        ),
        array(
            'title'     => 'Accessibility',
            'template'  => 'template-parts/template-accessibility.php',
            'slug'      => 'accessibility'
        ),
        array(
            'title'     => 'Commercial',
            'template'  => 'template-parts/template-commercial.php',
            'slug'      => 'commercial'
        )
    );

    // Create pages and set their templates
    $home_page_id = 0; // Initialize variable to store Home page ID

    foreach ($pages as $page) {
        $page_id = hwc_create_page_with_template($page['title'], $page['template'], $page['slug']);
        
        // Store Home page ID
        if ($page['slug'] === 'home') {
            $home_page_id = $page_id;
        }
    }

    // Set Home page as the front page
    if ($home_page_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page_id);
    }
}

/*--------------------------------------------------------------
	>>> Hook into 'after_switch_theme' to run the check when the theme is activated
	----------------------------------------------------------------*/
function hwc_create_page_with_template($title, $template_path, $slug) {
    // Check if the page already exists
    $page = get_page_by_path($slug);

    if (!$page) {
        // Create the page
        $page_id = wp_insert_post(array(
            'post_title'    => $title,
            'post_name'     => $slug,
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
        ));

        // Set the page template if the page was created successfully
        if ($page_id) {
            update_post_meta($page_id, '_wp_page_template', $template_path);
            return $page_id; // Return the ID of the newly created page
        }
    } else {
        // Optionally update the page template if it doesn't match the current template
        $current_template = get_post_meta($page->ID, '_wp_page_template', true);
        if ($current_template !== $template_path) {
            update_post_meta($page->ID, '_wp_page_template', $template_path);
        }
        return $page->ID; // Return the ID of the existing page
    }
    
    return 0; // Return 0 if the page wasn't created or found
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

/*--------------------------------------------------------------
	>>> Function to set up ACF fields for each page
	----------------------------------------------------------------*/
function hwc_setup_acf_fields_for_pages() {
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

function hwc_upload_image_from_theme($filename) {
    $theme_directory = get_template_directory(); // Get the theme directory path
    $full_path = $theme_directory . '/hwc-images/' . $filename; // Build the full path to the image

    // Check if the file exists in the theme folder
    if (!file_exists($full_path)) {
        return new WP_Error('file_not_found', 'The specified image file does not exist.');
    }

    // Get the upload directory path
    $wp_upload_dir = wp_upload_dir();
    $upload_path = $wp_upload_dir['path'] . '/' . $filename;

    // Copy the file from the theme directory to the uploads directory
    copy($full_path, $upload_path);

    // Check the file type
    $wp_filetype = wp_check_filetype($filename, null);

    // Prepare the attachment array
    $attachment = array(
        'guid'           => $wp_upload_dir['url'] . '/' . basename($upload_path),
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit',
    );

    // Insert the attachment
    $attach_id = wp_insert_attachment($attachment, $upload_path);

    // Include image.php to make sure image metadata is generated
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Generate metadata and update the attachment
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload_path);
    wp_update_attachment_metadata($attach_id, $attach_data);

    return $attach_id;
}

/*--------------------------------------------------------------
	>>> Function to set default values in ACF fields for each page
	----------------------------------------------------------------*/
function hwc_set_default_acf_field_values() {
    // Check if default values have already been set
   /* if (get_option('acf_defaults_set')) {
        return; // Exit if defaults have already been set
    }*/

    $page_fields = array(
        'Home' => array(
            'home_title1' => 'Welcome to Our Website',
            'home_image1' => 'wp-img.png', // Store image filename
            'home_description' => 'Welcome to the home page of our website. We provide the best services in the industry.',
        ),

        'News' => array(
            'news_title' => 'Latest News',
            'news_image' => 'wp-img.png', // Store image filename
        ),
        // Add other pages and fields here as needed...
    );

    foreach ($page_fields as $page_title => $fields) {
        // Use WP_Query to get the page by title
        $query = new WP_Query(array(
            'post_type' => 'page',
            'title'     => $page_title,
            'posts_per_page' => 1,
        ));

        if ($query->have_posts()) {
            $page_id = $query->post->ID;

            foreach ($fields as $field_key => $default_value) {
                if (strpos($field_key, 'image') !== false) {
                    $attachment_id = hwc_upload_image_from_theme($default_value);

                    if (is_wp_error($attachment_id)) {
                        error_log("Error with image field '$field_key': " . $attachment_id->get_error_message());
                    } else {
                        // Update image field with attachment ID
                        update_field($field_key, $attachment_id, $page_id);
                    }
                } else {
                    $current_value = get_field($field_key, $page_id);

                    // Update the field only if it's empty or unset
                    if (empty($current_value)) {
                        update_field($field_key, $default_value, $page_id);
                    }
                }
            }
        } else {
            error_log("Page '$page_title' not found.");
        }
    }

    // Set an option to indicate that defaults have been set
   /* update_option('acf_defaults_set', true);*/
}

/*--------------------------------------------------------------
	>>> Function to set blog categories
	----------------------------------------------------------------*/
function hwc_create_blog_categories() {
    $categories = array(
        'club-news' => 'Club News',
        'match-report' => 'Match Report',
        'match-preview' => 'Match Preview',
        'transfer-news' => 'Transfer News',
        'ticket-news' => 'Ticket News',
        'interview' => 'Interview',
        'you-can-have-it-all' => 'You Can Have It All',
        'the-bluebirds-nest' => 'The Bluebirds Nest',
        'community-news' => 'Community News',
        'video' => 'Video'
    );

    foreach ($categories as $slug => $title) {
        if (!term_exists($slug, 'category')) {
            wp_insert_term($title, 'category', array('slug' => $slug));
        }
    }
}

/*--------------------------------------------------------------
	>>> Function to add dummy Content
	----------------------------------------------------------------*/
function hwc_create_image($image_url, $post_id) {
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    
    if (wp_mkdir_p($upload_dir['path'])) {
        $file = $upload_dir['path'] . '/' . $filename;
    } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }

    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    wp_update_attachment_metadata($attach_id, $attach_data);

    return $attach_id;
}

function hwc_create_dummy_posts() {
    $categories = array(
        'club-news' => 'Club News Title',
        'match-report' => 'Match Report Title',
        'match-preview' => 'Match Preview Title',
        'transfer-news' => 'Transfer News Title',
        'ticket-news' => 'Ticket News Title',
        'interview' => 'Interview Title',
        'you-can-have-it-all' => 'You Can Have It All Title',
        'the-bluebirds-nest' => 'The Bluebirds Nest Title',
        'community-news' => 'Community News Title',
        'video' => 'Video Title'
    );

    $excerpts = array(
        'club-news' => 'Excerpt for Club News.',
        'match-report' => 'Excerpt for Match Report.',
        'match-preview' => 'Excerpt for Match Preview.',
        'transfer-news' => 'Excerpt for Transfer News.',
        'ticket-news' => 'Excerpt for Ticket News.',
        'interview' => 'Excerpt for Interview.',
        'you-can-have-it-all' => 'Excerpt for You Can Have It All.',
        'the-bluebirds-nest' => 'Excerpt for The Bluebirds Nest.',
        'community-news' => 'Excerpt for Community News.',
        'video' => 'Excerpt for Video.'
    );

    $image_url = get_template_directory_uri() . '/hwc-images/wp-img.png';
    $youtube_url = 'https://www.youtube.com/embed/dQw4w9WgXcQ'; // Example YouTube URL

    foreach ($categories as $slug => $post_title) {
        $category = get_term_by('slug', $slug, 'category');
        if (!$category) {
            continue; // Skip if category does not exist
        }

        $category_id = $category->term_id;

        // Create post
        $post_id = wp_insert_post(array(
            'post_title'   => $post_title,
            'post_content' => '<p>This is a dummy post for ' . $post_title . '.</p>'
                . '<p>Description for ' . $post_title . '.</p>'
                . '<ul><li>Item 1</li><li>Item 2</li></ul>'
                . '<ol><li>First</li><li>Second</li></ol>'
                . '<table><tr><td>Dummy Table Cell</td></tr></table>'
                . '<iframe width="560" height="315" src="' . $youtube_url . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            'post_excerpt' => $excerpts[$slug], // Add excerpt
            'post_status'  => 'publish',
            'post_category'=> array($category_id)
        ));

        if ($post_id && !is_wp_error($post_id)) {
            // Set featured image
            $image_id = hwc_create_image($image_url, $post_id);
            set_post_thumbnail($post_id, $image_id);

            // Add tags
            wp_set_post_tags($post_id, 'dummy, sample', true);
        }
    }
}

/*--------------------------------------------------------------
	>>> Function to add funstions of blog categories and dummy_posts
	----------------------------------------------------------------*/
function hwc_activate_theme_setup() {

    if (!is_acf_pro_installed()) {
        // Return back if ACF Pro is not available
        return;
    }

    // Create Blog Categories
    hwc_create_blog_categories();
    
    // Create Dummy Posts
    hwc_create_dummy_posts();
}


/*--------------------------------------------------------------
	>>> Hook into theme activation Register Custom Post Types
	----------------------------------------------------------------*/ 

// Register Custom Post Types
function hwc_register_custom_post_types() {
    // Team
    register_post_type('team', array(
        'labels' => array(
            'name' => 'Teams',
            'singular_name' => 'Team',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));

    // Player
    register_post_type('player', array(
        'labels' => array(
            'name' => 'Players',
            'singular_name' => 'Player',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));

    // Match
    register_post_type('match', array(
        'labels' => array(
            'name' => 'Matches',
            'singular_name' => 'Match',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));

    // Result
    register_post_type('result', array(
        'labels' => array(
            'name' => 'Results',
            'singular_name' => 'Result',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));

    // League Table
    register_post_type('league_table', array(
        'labels' => array(
            'name' => 'League Tables',
            'singular_name' => 'League Table',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor'),
    ));
    
    // Staff
    register_post_type('staff', array(
        'labels' => array(
            'name' => 'Staff',
            'singular_name' => 'Staff Member',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
}

// Add ACF Fields
function hwc_add_acf_fields() {
    if (class_exists('ACF')) {
        // Teams ACF Fields
        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array(
                'key' => 'group_teams',
                'title' => 'Teams Details',
                'fields' => array(
                    array(
                        'key' => 'field_squad',
                        'label' => 'Squad',
                        'name' => 'squad',
                        'type' => 'text',
                        'instructions' => 'Enter the squad details.',
                        'default_value' => 'Default Squad',
                    ),
                    array(
                        'key' => 'field_staff',
                        'label' => 'Staff',
                        'name' => 'staff',
                        'type' => 'text',
                        'instructions' => 'Enter staff details.',
                        'default_value' => 'Default Staff',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'team',
                        ),
                    ),
                ),
            ));
        endif;

        // Players ACF Fields
        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array(
                'key' => 'group_players',
                'title' => 'Players Details',
                'fields' => array(
                    array(
                        'key' => 'field_team_selection',
                        'label' => 'Team Selection',
                        'name' => 'team_selection',
                        'type' => 'post_object',
                        'post_type' => array('team'),
                        'return_format' => 'id',
                        'multiple' => 0,
                        'default_value' => array(
                            array(1) // Default to first team, replace with the appropriate team ID if needed
                        ),
                    ),
                    array(
                        'key' => 'field_position_role',
                        'label' => 'Position/Role',
                        'name' => 'position_role',
                        'type' => 'text',
                        'default_value' => 'Default Position',
                    ),
                    array(
                        'key' => 'field_states',
                        'label' => 'States',
                        'name' => 'states',
                        'type' => 'repeater',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_state_name',
                                'label' => 'State Name',
                                'name' => 'state_name',
                                'type' => 'text',
                                'default_value' => 'Default State Name',
                            ),
                            array(
                                'key' => 'field_state_value',
                                'label' => 'State Value',
                                'name' => 'state_value',
                                'type' => 'number',
                                'default_value' => 0,
                            ),
                        ),
                        'button_label' => 'Add State',
                    ),
                    array(
                        'key' => 'field_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'default_value' => 'Default Description',
                    ),
                    array(
                        'key' => 'field_images',
                        'label' => 'Images',
                        'name' => 'images',
                        'type' => 'gallery',
                        'default_value' => array(), // Default empty gallery
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'player',
                        ),
                    ),
                ),
            ));
        endif;

        // Matches ACF Fields
        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array(
                'key' => 'group_matches',
                'title' => 'Match Details',
                'fields' => array(
                    array(
                        'key' => 'field_match_time',
                        'label' => 'Match Time',
                        'name' => 'match_time',
                        'type' => 'time_picker',
                        'default_value' => array(
                            'hour' => '00',
                            'minute' => '00',
                        ),
                    ),
                    array(
                        'key' => 'field_match_date',
                        'label' => 'Match Date',
                        'name' => 'match_date',
                        'type' => 'date_picker',
                        'default_value' => date('Y-m-d'),
                    ),
                    array(
                        'key' => 'field_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'default_value' => '',
                    ),
                    array(
                        'key' => 'field_teams',
                        'label' => 'Teams',
                        'name' => 'teams',
                        'type' => 'relationship',
                        'post_type' => array('team'),
                        'filters' => array('search'),
                        'result_elements' => array('post_title'),
                        'return_format' => 'id',
                        'multiple' => 2,
                    ),
                    array(
                        'key' => 'field_league',
                        'label' => 'League',
                        'name' => 'league',
                        'type' => 'post_object',
                        'post_type' => array('league_table'),
                        'return_format' => 'id',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'match',
                        ),
                    ),
                ),
            ));
        endif;

        // Results ACF Fields
        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array(
                'key' => 'group_results',
                'title' => 'Result Details',
                'fields' => array(
                    array(
                        'key' => 'field_result_image',
                        'label' => 'Result Image',
                        'name' => 'result_image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'default_value' => '',
                    ),
                    array(
                        'key' => 'field_line_up',
                        'label' => 'Line Up',
                        'name' => 'line_up',
                        'type' => 'textarea',
                        'default_value' => 'Default Line Up',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'result',
                        ),
                    ),
                ),
            ));
        endif;

        // League Table ACF Fields
        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array(
                'key' => 'group_league_table',
                'title' => 'League Table Details',
                'fields' => array(
                    array(
                        'key' => 'field_tournament',
                        'label' => 'Tournament',
                        'name' => 'tournament',
                        'type' => 'text',
                        'default_value' => 'Default Tournament',
                    ),
                    array(
                        'key' => 'field_position',
                        'label' => 'Position',
                        'name' => 'position',
                        'type' => 'number',
                        'default_value' => 1,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'league_table',
                        ),
                    ),
                ),
            ));
        endif;
    }
}

// Populate Default Data
function hwc_populate_default_data() {
    // Add default Teams
    if (!get_posts(array('post_type' => 'team', 'posts_per_page' => 1))) {
        for ($i = 1; $i <= 10; $i++) {
            $team_id = wp_insert_post(array(
                'post_type' => 'team',
                'post_title' => 'Default Team ' . $i,
                'post_content' => 'Description for default team ' . $i,
                'post_status' => 'publish',
            ));
            update_field('squad', 'Default Squad', $team_id);
            update_field('staff', 'Default Staff', $team_id);
        }
    }

    // Add default Players
    if (!get_posts(array('post_type' => 'player', 'posts_per_page' => 1))) {
        for ($i = 1; $i <= 30; $i++) {
            $player_id = wp_insert_post(array(
                'post_type' => 'player',
                'post_title' => 'Default Player ' . $i,
                'post_content' => 'Description for default player ' . $i,
                'post_status' => 'publish',
            ));
            update_field('team_selection', array(1), $player_id); // Default to first team
            update_field('position_role', 'Default Position', $player_id);
            update_field('states', array(array('state_name' => 'Default State Name', 'state_value' => 0)), $player_id);
            update_field('description', 'Default Description', $player_id);
        }
    }

    // Add default Matches
    if (!get_posts(array('post_type' => 'match', 'posts_per_page' => 1))) {
        for ($i = 1; $i <= 20; $i++) {
            $match_id = wp_insert_post(array(
                'post_type' => 'match',
                'post_title' => 'Default Match ' . $i,
                'post_content' => 'Description for default match ' . $i,
                'post_status' => 'publish',
            ));
            update_field('match_time', array('hour' => '00', 'minute' => '00'), $match_id);
            update_field('match_date', date('Y-m-d'), $match_id);
            update_field('teams', array(1, 2), $match_id); // Default to first two teams
            update_field('league', 1, $match_id); // Default to first league
        }
    }

    // Add default Results
    if (!get_posts(array('post_type' => 'result', 'posts_per_page' => 1))) {
        for ($i = 1; $i <= 20; $i++) {
            $result_id = wp_insert_post(array(
                'post_type' => 'result',
                'post_title' => 'Default Result ' . $i,
                'post_content' => 'Description for default result ' . $i,
                'post_status' => 'publish',
            ));
            update_field('result_image', '', $result_id);
            update_field('line_up', 'Default Line Up', $result_id);
        }
    }

    // Add default League Tables
    if (!get_posts(array('post_type' => 'league_table', 'posts_per_page' => 1))) {
        for ($i = 1; $i <= 5; $i++) {
            $league_id = wp_insert_post(array(
                'post_type' => 'league_table',
                'post_title' => 'Default League Table ' . $i,
                'post_content' => 'Description for default league table ' . $i,
                'post_status' => 'publish',
            ));
            update_field('tournament', 'Default Tournament', $league_id);
            update_field('position', 1, $league_id);
        }
    }

    // Add default Staff
    if (!get_posts(array('post_type' => 'staff', 'posts_per_page' => 1))) {
        for ($i = 1; $i <= 10; $i++) {
            wp_insert_post(array(
                'post_type' => 'staff',
                'post_title' => 'Default Staff Member ' . $i,
                'post_content' => 'Description for default staff member ' . $i,
                'post_status' => 'publish',
            ));
        }
    }
}
