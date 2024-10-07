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
            'primary' => __('Primary Menu', 'textdomain'),
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

/**
 * Load Home Template functions.
 */
require get_template_directory() . '/inc/home-functions.php';

/**
 * Load News Template functions.
 */
require get_template_directory() . '/inc/news-functions.php';

/**
 * Load About The Company Template functions.
 */
require get_template_directory() . '/inc/about-the-academy-functions.php';

/*--------------------------------------------------------------
	>>> All Action and Filter Functions
	----------------------------------------------------------------*/
add_action('after_switch_theme', 'hwc_check_acf_pro_before_activation');
add_action('after_switch_theme', 'hwc_activate_theme_setup');
add_action('after_switch_theme', 'my_setup_default_menu');
add_action('after_switch_theme', 'set_default_site_logo_on_activation');


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
    if (is_singular('fixtures') || is_singular('result')) {
        $classes[] = 'single-match';
    }
    return $classes;
}
add_filter('body_class', 'add_custom_body_class');

/*--------------------------------------------------------------
	>>> Check if the current page is a single post of type 'fixtures'
	----------------------------------------------------------------*/
function add_custom_body_classes($classes)
{
    // Check if it's the fixtures post type archive
    if (is_post_type_archive('fixtures') || is_post_type_archive('result')) {
        $classes[] = 'post-type-archive';
        $classes[] = 'post-type-archive-match';
    }

    if (is_post_type_archive('team')) {
        $classes[] = 'single';
        $classes[] = 'single-club_team';
    }

    // Check if it's the Table post type archive
    if (is_post_type_archive('league_table')) {
        $classes[] = 'single';
        $classes[] = 'single-league_table';
    }
    return $classes;
}
add_filter('body_class', 'add_custom_body_classes');
//end


// 
/*--------------------------------------------------------------
	>>> Enqueue scripts
----------------------------------------------------------------*/
function enqueue_custom_scripts()
{
    // Check if we're on an archive page for the 'fixtures' post type
    if (is_post_type_archive('fixtures') || is_post_type_archive('result') || is_post_type_archive('team') || is_post_type_archive('league_table')) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('ajax-filter', get_template_directory_uri() . '/js/ajax-filter.js', array('jquery'), time(), true);

        wp_localize_script('ajax-filter', 'ajax_filter', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('filter_fixtures_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


/*--------------------------------------------------------------
	>>> AJAX handler for filtering fixtures
----------------------------------------------------------------*/
function filter_fixtures_by_team()
{
    // Security check
    check_ajax_referer('filter_fixtures_nonce', 'nonce');

    // Ensure the team_id is set
    if (isset($_POST['team_id'])) {
        $team_id = intval($_POST['team_id']);

        // Query for upcoming fixtures
        $args =
            array(
                'post_type' => 'fixtures',
                'meta_query' => array(
                    'relation' => 'OR', // Use OR to match either team 1 or team 2
                    array(
                        'key' => 'fixture_team_1',
                        'value' => $team_id,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'fixture_team_2',
                        'value' => $team_id,
                        'compare' => 'LIKE'
                    )
                ),
                'order' => 'ASC',
                'post_status' => 'publish',
                'posts_per_page' => -1
            );

        $fixtures = new WP_Query($args);

        if ($fixtures->have_posts()) {
            $fixtures_by_month = array();

            // Group fixtures by month
            while ($fixtures->have_posts()) {
                $fixtures->the_post();

                $home_team = get_field('fixture_team_1'); // Team 1
                $away_team = get_field('fixture_team_2'); // Team 2
                $fixture_league_id = get_field('fixture_league'); // League logo or information
                $home_team_name = $home_team ? get_the_title($home_team) : '';
                $home_team_logo = get_the_post_thumbnail_url($home_team) ?: '';
                $away_team_name = $away_team ? get_the_title($away_team) : '';
                $away_team_logo = get_the_post_thumbnail_url($away_team) ?: '';
                $fixture_league_logo = get_the_post_thumbnail_url($fixture_league_id) ?: '';

                if ($home_team_logo) {
                    $dis_home_team_logo = $home_team_logo;
                } else {
                    $dis_home_team_logo = get_template_directory_uri() . '/hwc-images/default-team-logo.png';
                }

                if ($away_team_logo) {
                    $dis_away_team_logo = $away_team_logo;
                } else {
                    $dis_away_team_logo = get_template_directory_uri() . '/hwc-images/default-team-logo.png';
                }

                if ($fixture_league_logo) {
                    $dis_fixture_league_logo = $fixture_league_logo;
                } else {
                    $dis_fixture_league_logo = get_template_directory_uri() . '/hwc-images/default-league.png';
                }

                $match_date = get_field('fixture_match_date'); // Match date
                $month_year = date('F Y', strtotime($match_date)); // e.g., "September 2024"

                // Add fixture to the respective month group
                if (!isset($fixtures_by_month[$month_year])) {
                    $fixtures_by_month[$month_year] = array();
                }

                $fixtures_by_month[$month_year][] = array(
                    'match_date' => $match_date,
                    'match_venue' => get_field('fixture_stadium_name'),
                    'home_team_logo' => $dis_home_team_logo,
                    'home_team_name' => $home_team_name,
                    'away_team_logo' => $dis_away_team_logo,
                    'away_team_name' => $away_team_name,
                    'match_time' => get_field('fixture_match_time'),
                    'fixture_league_logo' => $dis_fixture_league_logo,
                    'permalink' => get_permalink()
                );
            }

            // Display fixtures grouped by month
            foreach ($fixtures_by_month as $month => $fixtures) {
                echo '<h2 class="match-list-sub-heading">' . esc_html($month) . '</h2>';

                foreach ($fixtures as $fixture) {
                    echo '<div class="match-card" data-status="scheduled">';
                    echo '<div class="match-details">';
                    echo '<img src="' . esc_url($fixture['fixture_league_logo']) . '" class="logo" alt="Match Logo">';
                    echo '<span class="match-date">' . esc_html(date('D j F', strtotime($fixture['match_date']))) . '</span>';
                    echo '<span class="match-venue-name">' . esc_html($fixture['match_venue']) . '</span>';
                    echo '</div>';

                    echo '<div class="match-clubs">';
                    echo '<div class="match-club match-club-home">';
                    echo '<img src="' . esc_url($fixture['home_team_logo']) . '" class="logo club-logo" alt="' . esc_attr($fixture['home_team_name']) . '">';
                    echo '<div class="match-club-inner">';
                    echo '<span class="match-club-name">' . esc_html($fixture['home_team_name']) . '</span>';
                    echo '</div></div>';

                    echo '<div class="match-club match-club-away">';
                    echo '<img src="' . esc_url($fixture['away_team_logo']) . '" class="logo club-logo" alt="' . esc_attr($fixture['away_team_name']) . '">';
                    echo '<div class="match-club-inner">';
                    echo '<span class="match-club-name">' . esc_html($fixture['away_team_name']) . '</span>';
                    echo '</div></div>';

                    echo '<div class="match-state"><span class="match-ko">' . esc_html($fixture['match_time']) . '</span></div>';
                    echo '</div>';

                    echo '<div class="match-actions">';
                    echo '<a href="' . esc_url($fixture['permalink']) . '" class="btn btn-sm btn-outline">Match Centre</a>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            echo '<p class="match-list-sub-heading">No upcoming matches found for this team.</p>';
        }

        wp_reset_postdata();
    } else {
        echo '<p>No team selected.</p>';
    }

    wp_die();
}
add_action('wp_ajax_filter_fixtures_by_team', 'filter_fixtures_by_team');
add_action('wp_ajax_nopriv_filter_fixtures_by_team', 'filter_fixtures_by_team');


/*--------------------------------------------------------------
	>>> AJAX handler for filtering fixtures
----------------------------------------------------------------*/
function filter_result_by_team_result()
{
    // Security check
    check_ajax_referer('filter_fixtures_nonce', 'nonce');

    // Ensure the team_id is set
    if (isset($_POST['team_result_id'])) {
        $team_result_id = intval($_POST['team_result_id']);

        // Query for upcoming result posts
        $args = array(
            'post_type' => 'result',
            'order' => 'ASC',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );

        $result = new WP_Query($args);

        if ($result->have_posts()) {
            $result_by_month = array();

            // Group result by month
            while ($result->have_posts()) {
                $result->the_post();

                // Access the relevant fields for each match
                $matches = get_field('select_result_match');
                $result_permalink = get_permalink();
                foreach ($matches as $match) {
                    // Get the match ID
                    $match_id = $match->ID;
                    $team1_id = get_field('fixture_team_1', $match_id);
                    $team2_id = get_field('fixture_team_2', $match_id);


                    if ($team1_id == $team_result_id || $team2_id == $team_result_id) {

                        // Get the match ID and competition from the ACF field in the "result" post type
                        $competition = get_field('select_result_match');
                        $team1_score = get_field('field_result_total_goals_team_1');
                        $team2_score = get_field('field_result_total_goals_team_2');

                        $result_report_link = get_field('result_report_link');


                        if ($result_report_link) {
                            $dis_result_report_link = '<a href="' . $result_report_link['url'] . '" class="btn btn-sm btn-secondary">' . $result_report_link['title'] . '</a>';
                        } else {
                            $dis_result_report_link = '';
                        }
                        // Get the fixture post using the match (or competition) ID/title
                        if ($competition) {
                            foreach ($competition as $match) {
                                // Access the relevant fields for each match
                                $match_id = $match->ID;

                                // Fetch the fixture post by match ID (assuming it's stored in "fixtures" post type)
                                $fixture_query = new WP_Query(array(
                                    'post_type' => 'fixtures',
                                    'p' => $match_id, // Match by ID
                                    'posts_per_page' => 1,
                                ));

                                if ($fixture_query->have_posts()) {
                                    $fixture_query->the_post();

                                    // Fixture data
                                    $team1_name = get_field('fixture_team_1');
                                    $team1_name = $team1_name ? get_the_title($team1_name) : '';
                                    $team2_name = get_field('fixture_team_2');
                                    $team2_name = $team2_name ? get_the_title($team2_name) : '';
                                    $venue = get_field('fixture_stadium_name');
                                    $fixture_league_logo = get_the_post_thumbnail_url(get_field('fixture_league'), 'full');

                                    // Get team logos
                                    $team1_logo = get_the_post_thumbnail_url(get_field('fixture_team_1'), 'full') ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';
                                    $team2_logo = get_the_post_thumbnail_url(get_field('fixture_team_2'), 'full') ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';

                                    // Date and time
                                    $match_date = get_field('fixture_match_date');
                                    $match_time = get_field('fixture_match_time');
                                    $month_year = date('F Y', strtotime($match_date));

                                    // Add result grouped by month
                                    if (!isset($result_by_month[$month_year])) {
                                        $result_by_month[$month_year] = array();
                                    }

                                    $result_by_month[$month_year][] = array(
                                        'match_date' => $match_date,
                                        'match_venue' => $venue,
                                        'team1_name' => $team1_name,
                                        'team1_logo' => $team1_logo,
                                        'team1_score' => $team1_score,
                                        'team2_name' => $team2_name,
                                        'team2_logo' => $team2_logo,
                                        'team2_score' => $team2_score,
                                        'match_time' => $match_time,
                                        'fixture_league_logo' => $fixture_league_logo,
                                        'result_permalink' => $result_permalink,
                                        'dis_result_report_link' => $dis_result_report_link,
                                        'permalink' => get_permalink()
                                    );

                                    wp_reset_postdata(); // Reset fixture postdata
                                }
                            }
                        }
                    }
                }
            }

            // Display result grouped by month
            foreach ($result_by_month as $month => $fixtures) {
                echo '<h2 class="match-list-sub-heading">' . esc_html($month) . '</h2>';

                foreach ($fixtures as $fixture) {
                    echo '<div class="match-card" data-status="complete">';
                    echo '<div class="match-details">';
                    echo '<img src="' . esc_url($fixture['fixture_league_logo']) . '" class="logo" alt="League Logo">';
                    echo '<span class="match-date">' . esc_html(date('D j F', strtotime($fixture['match_date']))) . '</span>';
                    echo '<span class="match-venue-name">' . esc_html($fixture['match_venue']) . '</span>';
                    echo '</div>';

                    echo '<div class="match-clubs">';
                    echo '<div class="match-club match-club-home">';
                    echo '<img src="' . esc_url($fixture['team1_logo']) . '" class="logo club-logo" alt="' . esc_attr($fixture['team1_name']) . '">';
                    echo '<div class="match-club-inner">';
                    echo '<span class="match-club-name">' . esc_html($fixture['team1_name']) . '</span>';
                    echo '<span class="match-club-score">' . esc_html($fixture['team1_score']) . '</span>';
                    echo '</div></div>';

                    echo '<div class="match-club match-club-away">';
                    echo '<img src="' . esc_url($fixture['team2_logo']) . '" class="logo club-logo" alt="' . esc_attr($fixture['team2_name']) . '">';
                    echo '<div class="match-club-inner">';
                    echo '<span class="match-club-name">' . esc_html($fixture['team2_name']) . '</span>';
                    echo '<span class="match-club-score">' . esc_html($fixture['team2_score']) . '</span>';
                    echo '</div></div>';

                    echo '<div class="match-state">';
                    echo '<span class="match-score">' . esc_html($fixture['team1_score'] . '-' . $fixture['team2_score']) . '</span>';
                    echo '</div></div>';

                    echo '<div class="match-actions">';
                    echo '<a href="' . esc_url($fixture['result_permalink']) . '" class="btn btn-sm btn-outline">Match Centre</a>';
                    echo $fixture['dis_result_report_link'];
                    echo '</div></div>';
                }
            }
        } else {
            echo '<p class="match-list-sub-heading">No upcoming matches found for this team.</p>';
        }

        wp_reset_postdata();
    } else {
        echo '<p>No team selected.</p>';
    }

    wp_die();
}
add_action('wp_ajax_filter_result_by_team_result', 'filter_result_by_team_result');
add_action('wp_ajax_nopriv_filter_result_by_team_result', 'filter_result_by_team_result');

/*--------------------------------------------------------------
	>>> AJAX handler for filtering fixtures
----------------------------------------------------------------*/
function filter_league_table_by_team()
{
    // Security check
    check_ajax_referer('filter_fixtures_nonce', 'nonce');



    if (isset($_POST['league_table_id'])) {
        $league_table_id = intval($_POST['league_table_id']);

        // Define query arguments
        $args = array(
            'post_type' => 'league_table',
            'p' => $league_table_id,
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );


        // Create a new WP_Query
        $query = new WP_Query($args);


        // Start building the output
        $output = '';

        // Check if any league table was found
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $league_table = get_post();

                // Get teams field
                $teams = get_field('league_table', $league_table->ID);

                // Output league title
                $output .= '<div class="section-header">
                                <div class="container">
                                   
                                </div>
                            </div>';


                $output .= '<div class="md:container">
                                <table class="standings">
                                    <thead>
                                        <tr>
                                            <th class="standings-number standings-pos">Pos</th>
                                            <th colspan="2">&nbsp;</th>
                                            <th class="standings-number standings-pld">Pld</th>
                                            <th class="standings-number standings-w">W</th>
                                            <th class="standings-number standings-d">D</th>
                                            <th class="standings-number standings-l">L</th>
                                            <th class="standings-number standings-f">F</th>
                                            <th class="standings-number standings-a">A</th>
                                            <th class="standings-number standings-gd">+/-</th>
                                            <th class="standings-number standings-pts">Pts</th>
                                            <th class="standings-form text-left">Last 6</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                // Loop through each team in the league table
                if ($teams) {
                    foreach ($teams as $index => $team) {

                        $output .= '<tr class="standings-row zone-promotion">
                                        <td class="standings-number standings-pos">' . ($index + 1) . '</td>
                                        <td class="standings-logo"><img width="300" height="9999" src="' . esc_url(get_the_post_thumbnail_url($team['league_team'])) . '" class="logo club-logo" alt="' . esc_attr($team['league_team']) . '" decoding="async"></td>
                                        <td class="standings-club-name"><span>' . get_the_title($team['league_team']) . '</span></td>
                                        <td class="standings-pld standings-number">' . esc_html($team['played_matches']) . '</td>
                                        <td class="standings-w standings-number">' . esc_html($team['league_wins']) . '</td>
                                        <td class="standings-d standings-number">' . esc_html($team['league_draws']) . '</td>
                                        <td class="standings-l standings-number">' . esc_html($team['league_losses']) . '</td>
                                        <td class="standings-f standings-number">' . esc_html($team['league_goals_for']) . '</td>
                                        <td class="standings-a standings-number">' . esc_html($team['league_goals_against']) . '</td>
                                        <td class="standings-gd standings-number">' . esc_html($team['league_plus_minus']) . '</td>
                                        <td class="standings-pts standings-number">' . esc_html($team['league_points']) . '</td>
                                        <td class="standings-form"><span class="form">';
                        // Output last 6 games
                        foreach ($team['league_last_6_games'] as $game) {
                            $result = $game['league_game_result']; // Access the result
                            $class = '';
                            switch ($result) {
                                case 'W':
                                    $class = 'form-match form-match-won';
                                    break;
                                case 'D':
                                    $class = 'form-match form-match-drew';
                                    break;
                                case 'L':
                                    $class = 'form-match form-match-lost';
                                    break;
                            }
                            $output .= '<span class="' . esc_attr($class) . '" title="' . esc_attr(ucfirst($result)) . '"></span>';
                        }

                        $output .= '</span></td></tr>'; // Close the last 6 games span and the row

                    }
                }

                $output .= '</tbody></table></div>';

                echo $output;

                wp_die();
            }
            wp_reset_postdata(); // Reset the global post object
        } else {
            $output .= '<div class="error-message">No league data found.</div>';
        }
    } else {
        echo '<div class="md:container"><p class="no-found">No League selected.</p></div>';
    }
}

// Helper function to generate last 6 games display
function generate_last_6_games($last_6_games)
{

    return $form_display;
}

// Hook for AJAX
add_action('wp_ajax_filter_league_table_by_team', 'filter_league_table_by_team');
add_action('wp_ajax_nopriv_filter_league_table_by_team', 'filter_league_table_by_team');


// Add default menu items including all pages
// Register a primary menu
function my_register_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'textdomain'),
    ));
}
add_action('init', 'my_register_menus');

function my_setup_default_menu()
{
    // Check if there's a menu already set
    if (!wp_get_nav_menu_object('Primary Menu')) {
        // Create a new menu
        $menu_id = wp_create_nav_menu('Primary Menu');

        // Add 'News' as a parent Page
        $news_page = get_page_by_path('news'); // Assuming 'news' is the page slug
        if ($news_page) {
            $news_item_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => __('News', 'textdomain'),
                'menu-item-url' => get_permalink($news_page->ID),
                'menu-item-object-id' => $news_page->ID,
                'menu-item-object' => 'page',  // Use 'page' since it's a post type
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
            ));

            // Sub-menu pages under 'News'
            $sub_items = array(
                'Latest Club News' => 'club-news',
                'Match Reports' => 'match-report',
                'Match Previews' => 'match-preview',
                'Transfer News' => 'transfer-news',
                'Ticket News' => 'ticket-news',
                'Interviews' => 'interview',
            );

            foreach ($sub_items as $title => $slug) {
                $category = get_category_by_slug($slug);
                if ($category) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' => __($title, 'textdomain'),
                        'menu-item-url' => get_category_link($category->term_id),
                        'menu-item-object-id' => $category->term_id,
                        'menu-item-object' => 'category',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-parent-id' => $news_item_id, // Set as a child of 'News'
                        'menu-item-status' => 'publish',
                    ));
                }
            }
        }

        // Add the first 'Team' post dynamically from custom post type 'team'
        $team_args = array(
            'post_type' => 'team',
            'post_status' => 'publish',
            'numberposts' => 1,  // Only fetch the first team post
        );

        $team_post = get_posts($team_args);
        if (!empty($team_post)) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => __('Team', 'textdomain'),
                'menu-item-url' => get_permalink($team_post[0]->ID),
                'menu-item-object-id' => $team_post[0]->ID,
                'menu-item-object' => 'team',  // Use 'team' since it's a custom post type
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish'
            ));
        }

        // Add 'Matches' as a parent Page
        $fixtures_archive_url = get_post_type_archive_link('fixtures'); // Assuming 'fixtures' is the parent page
        if ($fixtures_archive_url) {
            $matches_item_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => __('Matches', 'textdomain'),
                'menu-item-url' => $fixtures_archive_url,
                'menu-item-object' => 'fixtures',  // Use 'fixtures' since it's a custom post type
                'menu-item-type' => 'post_type_archive',  // Use 'post_type_archive'
                'menu-item-status' => 'publish'
            ));

            // Add sub-menu pages under 'Matches'
            $matches_sub_items = array(
                'Fixtures' => 'fixtures',          // Archive page for fixtures
                'Results' => 'result',            // Archive page for results
                'League Table' => 'league_table',  // Archive page for league table
            );

            foreach ($matches_sub_items as $title => $slug) {
                // Use get_post_type_archive_link() for Results and League Table
                if ($slug === 'fixtures') {
                    // For Fixtures, use the archive page link
                    $url = get_post_type_archive_link('fixtures'); // Archive link for Fixtures
                } elseif ($slug === 'result') {
                    // For result, use the archive page link
                    $url = get_post_type_archive_link('result'); // Archive link for result
                } elseif ($slug === 'league_table') {
                    // For League Table, use the archive page link
                    $url = get_post_type_archive_link('league_table'); // Archive link for League Table
                } else {
                    // If it is a regular page, get the permalink
                    $sub_page = get_page_by_path($slug);
                    $url = $sub_page ? get_permalink($sub_page->ID) : '';
                }

                // Create the menu item
                if ($url) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' => __($title, 'textdomain'),
                        'menu-item-url' => $url,
                        'menu-item-object' => $slug, // Use slug for the object type
                        'menu-item-type' => 'post_type_archive', // Set to post_type_archive
                        'menu-item-parent-id' => $matches_item_id, // Set as child of 'Matches'
                        'menu-item-status' => 'publish'
                    ));
                }
            }
        }

        // Add 'Club' as a parent Page
        $club_page = get_page_by_path('club');
        if ($club_page) {
            $club_item_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => __('Club', 'textdomain'),
                'menu-item-url' => get_permalink($club_page->ID),
                'menu-item-object-id' => $club_page->ID,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish'
            ));

            // Add sub-menu items under 'Club'
            $club_sub_items = array(
                'History' => 'history',
                'Contact' => 'contact',
                'Stadium' => 'stadium',
                'You Can Have It All' => 'you-can-have-it-all', // Category slug
                'The Bluebirds Nest' => 'the-bluebirds-nest', // Category slug
                'Social Media' => 'social-media',
                'Bluebirds Tote' => 'bluebirds-tote',
                'Documents' => 'documents',
            );

            foreach ($club_sub_items as $title => $slug) {
                // Check if the slug is for a category
                if (in_array(
                    $slug,
                    ['you-can-have-it-all', 'the-bluebirds-nest']
                )) {
                    // For categories, use get_category_by_slug() to get the category
                    $category = get_category_by_slug($slug);
                    if ($category) {
                        // Get the category link if it exists
                        $url = get_category_link($category->term_id);
                        wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' => __($title, 'textdomain'),
                            'menu-item-url' => $url,
                            'menu-item-object' => 'category',
                            'menu-item-object-id' => $category->term_id,
                            'menu-item-type' => 'taxonomy',
                            'menu-item-parent-id' => $club_item_id, // Set as child of 'Club'
                            'menu-item-status' => 'publish'
                        ));
                    }
                } else {
                    // For pages, use get_page_by_path to get the URL
                    $page = get_page_by_path($slug);
                    if ($page) {
                        wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' => __($title, 'textdomain'),
                            'menu-item-url' => get_permalink($page->ID),
                            'menu-item-object' => 'page',
                            'menu-item-object-id' => $page->ID,
                            'menu-item-type' => 'post_type',
                            'menu-item-parent-id' => $club_item_id, // Set as child of 'Club'
                            'menu-item-status' => 'publish'
                        ));
                    }
                }
            }
        }

        // Additional Pages
        $additional_pages = array(
            'Community' => 'community',
            'Academy' => 'academy',
            'Video' => 'video', // Updated to use the category slug directly
        );

        // Array of category slugs that should be treated as categories
        $category_slugs = ['video']; // Add other category slugs as needed

        foreach ($additional_pages as $title => $slug) {
            // Check if the slug is for a category
            if (in_array($slug, $category_slugs)) {
                // For categories, use get_category_by_slug() to get the category
                $category = get_category_by_slug($slug);
                if ($category) {
                    // Get the category link if it exists
                    $url = get_category_link($category->term_id);
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' => __($title, 'textdomain'),
                        'menu-item-url' => $url,
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => $category->term_id,
                        'menu-item-type' => 'taxonomy',
                        'menu-item-status' => 'publish'
                    ));
                }
            } else {
                // For pages, use get_page_by_path to get the URL
                $page = get_page_by_path($slug);
                if ($page) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' => __($title, 'textdomain'),
                        'menu-item-url' => get_permalink($page->ID),
                        'menu-item-object' => 'page',
                        'menu-item-object-id' => $page->ID,
                        'menu-item-type' => 'post_type',
                        'menu-item-status' => 'publish'
                    ));
                }
            }
        }

        // Assign the menu to the primary location
        $locations = get_theme_mod('nav_menu_locations');
        $menu_locations = get_registered_nav_menus(); // Get all registered locations

        if (!empty($menu_locations['primary'])) {
            $locations['primary'] = $menu_id; // Assign the menu to the 'primary' location
        }

        set_theme_mod('nav_menu_locations', $locations);
    }
}

/* Menu Layout */
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{

    // Start Level: Adds a wrapper for sub-menus
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    // Start Element: Adds custom classes and the icon structure
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item';

        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'menu-item-has-children'; // Class for dropdowns
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= '<li' . $class_names . '>';

        // Link markup
        $atts = array();
        $atts['href'] = ! empty($item->url) ? $item->url : '';
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $icon = '';
        if (in_array('menu-item-has-children', $classes)) {
            // Add icon for dropdowns
            $icon = '<span class="icon"><svg aria-hidden="true" width="16" height="16" viewBox="0 0 16 16"><path d="M3.292 5.305a1 1 0 0 1 1.413 0L7.994 8.59l3.289-3.286a.998.998 0 1 1 1.412 1.41L8.7 10.709a1 1 0 0 1-1.412 0L3.292 6.716a.998.998 0 0 1 0-1.411Z" fill="currentColor"></path></svg></span>';
        }

        $label = '<span class="label">' . apply_filters('the_title', $item->title, $item->ID) . '</span>';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $label . $icon;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/*--------------------------------------------------------------
	>>> Add custom class to the custom logo output
----------------------------------------------------------------*/
add_filter('get_custom_logo', 'add_custom_logo_class');

function add_custom_logo_class($html)
{
    // Check if the logo HTML is present
    if ($html) {
        // Add classes to the logo image
        $html = str_replace('class="custom-logo"', 'class="logo club-logo custom-logo"', $html);
    }
    return $html;
}

function custom_theme_customizer($wp_customize)
{
    // Assuming you want to add colors to the existing 'colors' section
    // Check if the section exists
    if ($wp_customize->get_section('colors')) {
        // Array of blue color settings
        $blue_colors = [
            'Primary-Color' => '#112982',
            'Secondary-Color' => '#f8f9fe',
        ];

        // Loop through colors to create settings and controls
        foreach ($blue_colors as $color_key => $default_color) {
            $wp_customize->add_setting($color_key, array(
                'default' => $default_color,
                'transport' => 'refresh',
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color_key, array(
                'label' => ucfirst(str_replace('-', ' ', $color_key)),
                'section' => 'colors', // Change to your desired section ID
                'settings' => $color_key,
            )));
        }
    }
}
add_action('customize_register', 'custom_theme_customizer');

function hide_header_text_color_control()
{
?>
    <style type="text/css">
        /* Hide the Header Text Color control in the WordPress Customizer */
        #customize-control-header_textcolor {
            display: none !important;
        }
    </style>
<?php
}
add_action('customize_controls_print_styles', 'hide_header_text_color_control');

function set_default_site_logo_on_activation()
{
    // Define the path to the logo image in the theme directory
    $logo_path = get_template_directory() . '/hwc-images/haverfordwest-county.png';

    // Check if the file exists
    if (file_exists($logo_path)) {
        // Get WordPress upload directory
        $upload_dir = wp_upload_dir();

        // Copy the logo to the uploads directory
        $logo_url = $upload_dir['url'] . '/haverfordwest-county.png';
        $logo_file = $upload_dir['path'] . '/haverfordwest-county.png';

        // Copy the logo file from theme directory to the upload directory
        if (!file_exists($logo_file)) {
            copy($logo_path, $logo_file);
        }

        // Now insert the image into the WordPress media library
        $attachment = array(
            'guid'           => $logo_url,
            'post_mime_type' => 'image/png',
            'post_title'     => sanitize_file_name('haverfordwest-county'),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Insert the attachment and get the attachment ID
        $attachment_id = wp_insert_attachment($attachment, $logo_file);

        // Generate the attachment metadata
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata($attachment_id, $logo_file);
        wp_update_attachment_metadata($attachment_id, $attachment_data);

        // Set the site logo
        set_theme_mod('custom_logo', $attachment_id);
    }
}
