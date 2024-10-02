<?php

/**
 * hwc Home Functions
 *
 * @package hwc
 */
/*--------------------------------------------------------------
	>>> Shortcodes
----------------------------------------------------------------*/
add_shortcode('display_home_sec1_latest_post', 'display_home_sec1_latest_post');
add_shortcode('home_sec1_latest_fixture', 'home_sec1_latest_fixture');
add_shortcode('home_sec1_latest_result', 'home_sec1_latest_result');
add_shortcode('home_latest_news_posts_shortcode', 'home_latest_news_posts_shortcode');
add_shortcode('home_display_upcoming_fixtures', 'home_display_upcoming_fixtures');
add_shortcode('hwc_home_cards_shortcode', 'hwc_home_cards_shortcode');
add_shortcode('hwc_latest_the_bluebirds_nest_posts_shortcode', 'hwc_latest_the_bluebirds_nest_posts_shortcode');
add_shortcode('shortcode_hwc_home_blue_big_box', 'hwc_home_blue_big_box');
add_shortcode('hwc_team_post_shortcode', 'hwc_team_post_shortcode');
add_shortcode('hwc_home_result_by_team_result', 'hwc_home_result_by_team_result');
add_shortcode('hwc_home_newsletter_shortcode', 'hwc_home_newsletter_shortcode');

/*--------------------------------------------------------------
	>>> Sec1 - Left Post section
----------------------------------------------------------------*/
function display_home_sec1_latest_post()
{
    // Query the latest post
    $args = array(
        'posts_per_page' => 1, // Get only the latest post
        'post_status' => 'publish' // Only show published posts
    );

    $latest_post_query = new WP_Query($args);

    if ($latest_post_query->have_posts()) :
        while ($latest_post_query->have_posts()) : $latest_post_query->the_post();
?>
            <div class="card card-post card-featured card-w-link">
                <div class="card-image">
                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                        <div class="image-container ratio-16x9">
                            <?php if (has_post_thumbnail()) : ?>
                                <img width="1280" height="720" src="<?php the_post_thumbnail_url('large'); ?>" class="fill" alt="<?php the_title(); ?>" />
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title"><?php the_title(); ?></span>
                    <p class="card-summary"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <div class="card-meta">
                        <span class="cat"><?php echo get_the_category_list(', '); ?></span>
                        <span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No posts found.</p>';
    endif;
}

/*--------------------------------------------------------------
	>>> Sec1 - Right Match Card - 1
----------------------------------------------------------------*/

function home_sec1_latest_fixture()
{
    // Query for the latest fixture
    $args = array(
        'post_type' => 'fixtures',
        'meta_key' => 'fixture_match_date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'posts_per_page' => 1, // Get only the latest fixture
        'post_status' => 'publish'
    );

    $latest_fixture = new WP_Query($args);

    if ($latest_fixture->have_posts()) {
        while ($latest_fixture->have_posts()) {
            $latest_fixture->the_post();

            $home_team = get_field('fixture_team_1'); // Team 1
            $away_team = get_field('fixture_team_2'); // Team 2
            $fixture_league_id = get_field('fixture_league'); // League logo or information
            $home_team_name = $home_team ? get_the_title($home_team) : '';
            $home_team_logo = get_the_post_thumbnail_url($home_team) ?: '';
            $away_team_name = $away_team ? get_the_title($away_team) : '';
            $away_team_logo = get_the_post_thumbnail_url($away_team) ?: '';
            $fixture_league_title = get_the_title($fixture_league_id) ?: '';

            // Fallback for logos if not set
            $dis_home_team_logo = $home_team_logo ? $home_team_logo : get_template_directory_uri() . '/hwc-images/default-team-logo.png';
            $dis_away_team_logo = $away_team_logo ? $away_team_logo : get_template_directory_uri() . '/hwc-images/default-team-logo.png';

            $match_date = get_field('fixture_match_date'); // Match date
            $match_time = get_field('fixture_match_time'); // Match time
            $match_venue = get_field('fixture_stadium_name'); // Match venue

            // Output the match card
            echo '<div class="match-card" data-status="scheduled">';
            echo '<div class="match-card-header">';
            echo '<span class="tax tax-team">' . esc_html($fixture_league_title) . '</span>';
            echo '</div>';
            echo '<div class="match-details">';
            echo '<span class="match-date">' . esc_html(date('D j F', strtotime($match_date))) . '</span>';
            echo '<span class="match-venue-name">' . esc_html($match_venue) . '</span>';
            echo '</div>';
            echo '<div class="match-clubs">';
            echo '<div class="match-club match-club-home">';
            echo '<img src="' . esc_url($dis_home_team_logo) . '" class="logo club-logo" alt="' . esc_attr($home_team_name) . '" decoding="async" />';
            echo '<div class="match-club-inner"><span class="match-club-name">' . esc_html($home_team_name) . '</span></div>';
            echo '</div>';
            echo '<div class="match-club match-club-away">';
            echo '<img src="' . esc_url($dis_away_team_logo) . '" class="logo club-logo" alt="' . esc_attr($away_team_name) . '" decoding="async" />';
            echo '<div class="match-club-inner"><span class="match-club-name">' . esc_html($away_team_name) . '</span></div>';
            echo '</div>';
            echo '<div class="match-state"><span class="match-ko">' . esc_html($match_time) . '</span></div>';
            echo '</div>';
            echo '<div class="match-actions">';
            echo '<a href="' . esc_url(get_permalink()) . '" class="btn btn-sm btn-outline">Match Centre</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="match-list-sub-heading">No upcoming matches found.</p>';
    }

    wp_reset_postdata();
}

/*--------------------------------------------------------------
	>>> Sec1 - Right Match Card - 2
----------------------------------------------------------------*/
function home_sec1_latest_result()
{
    // Query for the latest result post
    $args = array(
        'post_type'      => 'result',
        'order'          => 'DESC', // Get the latest result
        'posts_per_page' => 1, // Only need the latest result
        'post_status' => 'publish'
    );

    $result = new WP_Query($args);

    if ($result->have_posts()) {
        $result->the_post();

        // Access the relevant fields for the match
        $matches = get_field('select_result_match'); // Assuming this is a relationship or a repeater field
        $team1_score = get_field('field_result_total_goals_team_1');
        $team2_score = get_field('field_result_total_goals_team_2');
        $result_report_link = get_field('result_report_link');
        $result_permalink = get_permalink(); // Get permalink for Match Centre

        foreach ($matches as $match) {
            // Get the match ID
            $match_id = $match->ID;
            $team1_id = get_field('fixture_team_1', $match_id);
            $team2_id = get_field('fixture_team_2', $match_id);

            // Get the match scores and details

            $competition = get_field('select_result_match', $match_id);
            $venue = get_field('fixture_stadium_name', $match_id);
            $match_date = get_field('fixture_match_date', $match_id);


            // Get team logos
            $team1_name = get_the_title($team1_id);
            $team2_name = get_the_title($team2_id);
            $team1_logo = get_the_post_thumbnail_url($team1_id, 'full') ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';
            $team2_logo = get_the_post_thumbnail_url($team2_id, 'full') ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';
            $fixture_league_id = get_field('fixture_league', $match_id);
            $fixture_league_title = get_the_title($fixture_league_id) ?: '';

            // Prepare links for actions
            $dis_result_report_link = $result_report_link ? '<a href="' . esc_url($result_report_link['url']) . '" class="btn btn-sm btn-secondary">' . esc_html($result_report_link['title']) . '</a>' : '';

            // Output the latest result with the specified structure
            echo '<div class="match-card" data-status="complete">';
            echo '<div class="match-card-header">';
            echo '<span class="tax tax-team">' . esc_html($fixture_league_title) . '</span>';
            echo '<span class="label">Latest Result</span>';
            echo '</div>';

            echo '<div class="match-details">';
            echo '<span class="match-competition">' . esc_html($competition) . '</span>';
            echo '<span class="match-date">' . esc_html(date('D j F', strtotime($match_date))) . '</span>';
            echo '<span class="match-venue-name">' . esc_html($venue) . '</span>';
            echo '</div>';

            echo '<div class="match-clubs">';

            // Home team
            echo '<div class="match-club match-club-home">';
            echo '<img width="200" height="282" src="' . esc_url($team1_logo) . '" class="logo club-logo" alt="' . esc_attr($team1_name) . '" decoding="async" loading="lazy">';
            echo '<div class="match-club-inner">';
            echo '<span class="match-club-name">' . esc_html($team1_name) . '</span>';
            echo '</div>';
            echo '<span class="match-club-score">' . esc_html($team1_score) . '</span>'; // Display team 1 score
            echo '</div>';

            // Away team
            echo '<div class="match-club match-club-away">';
            echo '<img width="234" height="272" src="' . esc_url($team2_logo) . '" class="logo club-logo" alt="' . esc_attr($team2_name) . '" decoding="async" loading="lazy">';
            echo '<div class="match-club-inner">';
            echo '<span class="match-club-name">' . esc_html($team2_name) . '</span>';
            echo '</div>';
            echo '<span class="match-club-score">' . esc_html($team2_score) . '</span>'; // Display team 2 score
            echo '</div>';

            // Match state
            echo '<div class="match-state">';
            echo '<span class="match-score">' . esc_html($team1_score . '-' . $team2_score) . '</span>'; // Total score
            echo '</div>';

            echo '</div>'; // End of match-clubs

            // Match actions
            echo '<div class="match-actions">';
            echo '<a href="' . esc_url($result_permalink) . '" class="btn btn-sm btn-outline">Match Centre</a>';
            echo $dis_result_report_link; // Report link if available
            echo '</div>';

            echo '</div>'; // End of match-card
        }
    } else {
        echo '<p class="match-list-sub-heading">No results found.</p>';
    }

    wp_reset_postdata(); // Reset post data
}

/*--------------------------------------------------------------
	>>> Sec2 - Latest News
----------------------------------------------------------------*/
function home_latest_news_posts_shortcode()
{
    // Query the latest published posts
    $query = new WP_Query(array(
        'posts_per_page' => 4, // Get the latest 4 posts
        'post_status' => 'publish',
    ));

    // Start output buffering
    ob_start();

    // Check if there are any posts
    if ($query->have_posts()) {
        echo '<div id="block-6791-1" class="block block-6791-1 block-cards block-cards-post first-block before-matches">';
        echo '<div class="container">';
        echo '<div class="section-header">';
        echo '<h2 class="section-heading section-heading-display">Latest News</h2>';
        echo '</div>';
        echo '<div class="grid-container grid-columns-sm-2-lg-4">';

        // Loop through the posts
        while ($query->have_posts()) {
            $query->the_post();

            // Post card structure
            echo '<div class="card card-post card-w-link">';
            echo '<div class="card-image">';
            echo '<a href="' . get_permalink() . '" aria-label="' . get_the_title() . '">';
            echo '<div class="image-container ratio-16x9">';
            echo get_the_post_thumbnail(get_the_ID(), 'medium'); // Get the post thumbnail
            echo '</div></a></div>';
            echo '<div class="card-content">';
            echo '<span class="card-title">' . get_the_title() . '</span>';
            echo '<p class="card-summary">' . get_the_excerpt() . '</p>';
            echo '<div class="card-meta">';
            echo '<span class="cat">' . get_the_category_list(', ') . '</span>';
            echo '<span class="timestamp">' . get_the_date() . '</span>';
            echo '</div></div></div>'; // End of card
        }

        echo '</div></div></div>'; // End of grid-container, container, and block-cards
    } else {
        echo '<p>No posts found.</p>';
    }

    // Restore original Post Data
    wp_reset_postdata();

    // Return the output buffer content
    return ob_get_clean();
}

/*--------------------------------------------------------------
	>>> Sec3 - Latest fixtures
----------------------------------------------------------------*/
function home_display_upcoming_fixtures()
{
    // Query for the latest fixture
    $args = array(
        'post_type' => 'fixtures',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 1, // Get only the latest fixture
        'post_status' => 'publish'
    );

    $fixtures = new WP_Query($args);

    if ($fixtures->have_posts()) {
        $output = '<div id="block-6791-2" class="block block-6791-2 block-match after-cards before-cards">';
        while ($fixtures->have_posts()) {
            $fixtures->the_post();

            $home_team = get_field('fixture_team_1'); // Team 1
            $away_team = get_field('fixture_team_2'); // Team 2
            $fixture_league_id = get_field('fixture_league'); // League info
            $match_image = get_field('fixture_background_image');
            $home_team_name = $home_team ? get_the_title($home_team) : '';
            $home_team_logo = get_the_post_thumbnail_url($home_team) ?: '';
            $away_team_name = $away_team ? get_the_title($away_team) : '';
            $away_team_logo = get_the_post_thumbnail_url($away_team) ?: '';
            $fixture_league_logo = get_the_post_thumbnail_url($fixture_league_id) ?: '';

            $dis_home_team_logo = $home_team_logo ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';
            $dis_away_team_logo = $away_team_logo ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';
            $dis_fixture_league_logo = $fixture_league_logo ?: get_template_directory_uri() . '/hwc-images/default-league.png';

            $match_date = get_field('fixture_match_date'); // Match date
            $match_venue = get_field('fixture_stadium_name'); // Venue
            $match_time = get_field('fixture_match_time'); // Match time
            $permalink = get_permalink(); // Fixture permalink

            // Construct the output for the latest fixture
            $output .= '<div class="match-banner pre-match" data-theme="dark">';
            $output .= '<div class="match-image">';
            $output .= '<div class="image-container">';
            $output .= '<img width="1280" height="720" src="' . esc_url($match_image) . '" class="attachment-16x9-lg size-16x9-lg wp-post-image" alt="" decoding="async" loading="lazy">';
            $output .= '</div></div>';

            $output .= '<div class="match-clubs">';
            $output .= '<div class="match-club match-club-home">';
            $output .= '<img width="250" height="293" src="' . esc_url($dis_home_team_logo) . '" class="logo club-logo" alt="' . esc_attr($home_team_name) . '" decoding="async" loading="lazy">';
            $output .= '<div class="match-club-inner">';
            $output .= '<span class="match-club-name">' . esc_html($home_team_name) . '</span>';
            $output .= '</div></div>';

            $output .= '<div class="match-club match-club-away">';
            $output .= '<img width="200" height="282" src="' . esc_url($dis_away_team_logo) . '" class="logo club-logo" alt="' . esc_attr($away_team_name) . '" decoding="async" loading="lazy">';
            $output .= '<div class="match-club-inner">';
            $output .= '<span class="match-club-name">' . esc_html($away_team_name) . '</span>';
            $output .= '</div></div>';

            $output .= '<div class="match-state">';
            $output .= '<span class="match-ko">' . esc_html($match_time) . '</span>';
            $output .= '</div></div>';

            $output .= '<div class="match-countdown countdown show-if-js" data-js-countdown="' . esc_attr(date('c', strtotime($match_date))) . '">';
            // Countdown placeholders, to be replaced by JavaScript countdown logic
            $output .= '<div class="countdown-days"><span class="countdown-value" data-js-countdown-days="">-10</span><span class="countdown-label">Days</span></div>';
            $output .= '<div class="countdown-hours"><span class="countdown-value" data-js-countdown-hours="">-17</span><span class="countdown-label">Hours</span></div>';
            $output .= '<div class="countdown-minutes"><span class="countdown-value" data-js-countdown-minutes="">-20</span><span class="countdown-label">Mins</span></div>';
            $output .= '</div>';

            $output .= '<div class="button-group"><a href="' . esc_url($permalink) . '" class="btn btn-outline">Match Centre</a></div>';
            $output .= '<img width="300" height="98" src="' . esc_url($dis_fixture_league_logo) . '" class="logo competition-logo" alt="" decoding="async" loading="lazy">';
            $output .= '<div class="match-details md:separate-items">';
            $output .= '<span class="match-date">' . esc_html(date('D j F', strtotime($match_date))) . '</span>';
            $output .= '<span class="match-venue-name">' . esc_html($match_venue) . '</span>';
            $output .= '</div>';
            $output .= '</div>'; // Close match-banner
        }

        wp_reset_postdata(); // Reset post data
        $output .= '</div>'; // Close block

        return $output; // Return the output
    } else {
        return '<p class="match-list-sub-heading">No upcoming matches found.</p>';
    }
}

/*--------------------------------------------------------------
	>>> Sec4 - Cards Section
----------------------------------------------------------------*/
function hwc_home_cards_shortcode()
{
    // Get the current page or post ID dynamically
    $page_id = get_the_ID();

    // Check if the ACF repeater field 'hwc_home_repeater_cards' exists on the current page
    if (have_rows('repeater_cards', $page_id)) {
        ob_start(); // Start output buffering to capture HTML

        // Start the HTML structure for the cards block
        echo '<div id="block-6791-3" class="block block-6791-3 block-cards block-cards-mixed after-matches before-cards">';
        echo '<div class="container">';
        echo '<div class="grid-container grid-columns-sm-2-lg-3">';

        // Loop through the repeater rows
        while (have_rows('repeater_cards', $page_id)) {
            the_row();

            // Get subfield values from ACF
            $card_image = get_sub_field('card_image');
            $card_title = get_sub_field('card_title');
            $card_link = get_sub_field('card_link'); // This is a link field

            // Check if card link exists
            $card_link_url = isset($card_link['url']) ? $card_link['url'] : '#';
            $card_link_title = isset($card_link['title']) ? $card_link['title'] : 'Learn More';

            // Output each card's structure with all original classes intact
        ?>
            <div class="card card-promo card-centered card-w-link">
                <div class="card-image">
                    <a href="<?php echo esc_url($card_link_url); ?>" aria-label="<?php echo esc_attr($card_link_title); ?>">
                        <div class="image-container ratio-16x9">
                            <img width="960" height="540" src="<?php echo esc_url($card_image['url']); ?>" alt="<?php echo esc_attr($card_image['alt']); ?>" class="attachment-16x9-md size-16x9-md" decoding="async" loading="lazy" />
                        </div>
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title"><?php echo esc_html($card_title); ?></span>
                    <span class="btn btn-secondary">
                        <?php echo esc_html($card_link_title); ?>
                    </span>
                </div>
            </div>
<?php
        }

        // Close the grid and container divs
        echo '</div>';
        echo '</div>';
        echo '</div>';

        return ob_get_clean(); // Return the captured HTML
    }

    return ''; // Return empty string if no cards found
}

/*--------------------------------------------------------------
	>>> Sec5 - Latest Club News
----------------------------------------------------------------*/
function hwc_latest_the_bluebirds_nest_posts_shortcode()
{
    // Query arguments
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3, // Adjust the number of posts as needed
        'category_name' => 'the-bluebirds-nest', // Change this to your actual category slug
        'order' => 'DESC',
        'orderby' => 'date',
        'post_status' => 'publish'
    );

    // Execute the query
    $query = new WP_Query($args);

    // Start output buffering
    ob_start();

    echo '<div id="block-6791-4" class="block block-6791-4 block-cards block-cards-video after-cards before-banner" data-theme="dark">';
    echo '<div class="container">';
    echo '<div class="section-header">';
    echo '<h2 class="section-heading section-heading-display">Latest Video</h2>';
    echo '</div>';
    echo '</div>'; // Closing container

    echo '<div class="card-carousel-container">';
    echo '<div class="grid-container grid-columns-sm-2-lg-3 grid-columns-auto-scroll">';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_title = get_the_title();
            $post_link = get_permalink();
            $post_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $post_date = get_the_date('F j, Y');
            $categories = get_the_category();
            $category_title = !empty($categories) ? esc_html($categories[0]->name) : '';

            echo '<div class="card card-video card-dark card-w-link">';
            echo '<div class="card-image">';
            echo '<a href="' . esc_url($post_link) . '" aria-label="#' . esc_attr($post_title) . '">';
            echo '<div class="image-container ratio-16x9">';
            echo '<img src="' . esc_url($post_image) . '" alt="Read the full article - #' . esc_attr($post_title) . '" width="1280" height="720" class="fill" title="#' . esc_attr($post_title) . '">';
            echo '</div></a></div>'; // Closing card-image

            echo '<div class="card-content">';
            echo '<span class="card-title">' . esc_html($post_title) . '</span>';
            echo '<div class="card-meta">';
            echo '<span class="cat">' . esc_html($category_title) . '</span><span class="timestamp">' . esc_html($post_date) . '</span>';
            echo '</div></div>'; // Closing card-content
            echo '</div>'; // Closing card
        }
    }

    echo '</div>'; // Closing grid-container
    echo '</div>'; // Closing card-carousel-container
    echo '</div>'; // Closing main block

    // Reset post data
    wp_reset_postdata();

    // Get the output and clean the buffer
    return ob_get_clean();
}


/*--------------------------------------------------------------
	>>> Sec5 - Blue Big Box
----------------------------------------------------------------*/
function hwc_home_blue_big_box()
{
    // Get ACF values with hwc_home_ prefix
    $banner_image = get_field('big_box_image');
    $banner_description = get_field('big_box_description');
    $big_box_title = get_field('big_box_title');
    $banner_button_link = get_field('big_box_button_link');

    // If the button link is an array, use the first value
    $banner_button_link_url = is_array($banner_button_link) ? $banner_button_link['url'] : $banner_button_link;

    // Initialize the HTML variable
    $data = '<div id="block-6791-5" class="block block-6791-5 block-banner block-banner-full-width after-cards before-row-team">';
    $data .= '<div class="banner banner-centered banner-full-width">';
    $data .= '<a target="_blank" href="' . esc_url($banner_button_link_url) . '">';
    $data .= '<div class="image-container overlay-duotone">';

    if (!empty($banner_image)) {
        $data .= '<img width="4000" height="2667" src="' . esc_url($banner_image['url']) . '" class="attachment-16x-lg size-16x-lg" alt="' . esc_attr($banner_image['alt']) . '" decoding="async" loading="lazy" srcset="' . esc_url($banner_image['url']) . ' 4000w" sizes="(max-width: 4000px) 100vw, 4000px">';
    } else {
        $data .= '<p>No image found.</p>';
    }

    $data .= '</div>'; // Close image-container
    $data .= '<div class="banner-content">';

    if (!empty($big_box_title)) {
        $data .= '<h2 class="banner-title">' . esc_html($big_box_title) . '</h2>';
    } else {
        $data .= '';
    }

    if (!empty($banner_description)) {
        $data .= '<p class="summary">' . esc_html($banner_description) . '</p>';
    } else {
        $data .= '';
    }

    if (!empty($banner_button_link['title'])) {
        $data .= '<span class="btn btn-lg btn-primary">' . esc_html($banner_button_link['title']) . '</span>';
    }

    $data .= '</div>'; // Close banner-content
    $data .= '</a>'; // Close anchor
    $data .= '</div>'; // Close banner
    $data .= '</div>'; // Close block

    return $data; // Return the constructed HTML
}

/*--------------------------------------------------------------
	>>> Sec6 - Posts
----------------------------------------------------------------*/
function hwc_team_post_shortcode($atts)
{

    // Extract shortcode attributes and set defaults
    $atts = shortcode_atts(
        array(
            'team' => '', // Default value if no ID is passed
        ),
        $atts
    );
    // Get the value of the custom field 'hwc_home_select_team'
    $team_title = $atts['team'];

    // Check if the custom field has a value
    if (!$team_title) {
        return 'No team selected.';
    }

    // Get the tag details based on the title
    $team_tag = get_term_by('name', $team_title, 'post_tag');

    // Check if the tag exists and is valid
    if (!$team_tag) {
        return 'No tag found with the given title.';
    }

    // Set up a custom WP_Query to get the latest 2 posts with the tag slug
    $args = array(
        'posts_per_page' => 2, // Limit to 2 posts
        'tag' => $team_tag->slug, // Use the tag slug
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);

    // Initialize variable to store the output
    $output = '';

    // Check if the query has posts
    if ($query->have_posts()) {
        $output .= '<div class="post-list">';

        // Loop through the posts
        while ($query->have_posts()) {
            $query->the_post();

            // Get the post thumbnail URL (with fallback if no thumbnail is set)
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium') ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : 'https://via.placeholder.com/480x270';

            // Build the HTML structure for each post
            $output .= '
                <div class="card card-post card-lg card-w-link">
                    <div class="card-image">
                        <a href="' . get_the_permalink() . '" aria-label="' . esc_attr(get_the_title()) . '">
                            <div class="image-container ratio-16x9">
                                <img width="480" height="270" src="' . esc_url($image_url) . '" class="fill" alt="' . esc_attr(get_the_title()) . '" />
                            </div>
                        </a>
                    </div>
                    <div class="card-content">
                        <span class="card-title">' . get_the_title() . '</span>
                        <p class="card-summary">' . wp_trim_words(get_the_excerpt(), 20) . '</p>
                        <div class="card-meta">
                            <span class="cat">' . get_the_category_list(', ') . '</span>
                            <span class="timestamp">' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago</span>
                        </div>
                    </div>
                </div>';
        }

        $output .= '</div>';

        // Restore original post data
        wp_reset_postdata();
    } else {
        // If no posts are found, return a message
        $output = 'No posts found for this team.';
    }

    return $output; // Return the generated HTML or the message
}

/*--------------------------------------------------------------
	>>> Sec6 - Team Results
----------------------------------------------------------------*/
function hwc_home_result_by_team_result($atts)
{

    // Extract shortcode attributes and set defaults
    $atts = shortcode_atts(
        array(
            'team' => '', // Default value if no ID is passed
        ),
        $atts
    );
    // Get the value of the custom field 'hwc_home_select_team'
    $hwc_home_team_id = $atts['team'];

    // Query for result posts
    $args = array(
        'post_type' => 'result',
        'order' => 'ASC',
        'posts_per_page' => -1, // Only fetch one result
        'post_status' => 'publish'
    );

    $result = new WP_Query($args);

    if ($result->have_posts()) {
        // Loop through results
        while ($result->have_posts()) {
            $result->the_post();

            // Access the relevant fields for each match
            $matches = get_field('select_result_match'); // Adjust field name as needed
            $result_permalink = get_permalink();

            foreach ($matches as $match) {
                $match_id = $match->ID; // Get the match ID
                $team1_id = get_field('fixture_team_1', $match_id);
                $team2_id = get_field('fixture_team_2', $match_id);

                // Check if the current match involves the selected team
                if ($team1_id == $hwc_home_team_id || $team2_id == $hwc_home_team_id) {
                    // Fetch match details
                    $team1_score = get_field('field_result_total_goals_team_1');
                    $team2_score = get_field('field_result_total_goals_team_2');

                    // Get fixture post using match ID
                    $fixture_query = new WP_Query(array(
                        'post_type' => 'fixtures',
                        'p' => $match_id, // Match by ID
                        'posts_per_page' => 1,
                        'post_status' => 'publish'
                    ));



                    if ($fixture_query->have_posts()) {
                        $fixture_query->the_post();



                        // Get fixture data
                        //$competition = get_the_title(get_field('fixture_league')); // Change if needed
                        $fixture_league_id = get_field('fixture_league', $match_id);
                        $fixture_league_title = get_the_title($fixture_league_id) ?: '';
                        $venue = get_field('fixture_stadium_name');
                        $team1_name = get_the_title($team1_id);
                        $team2_name = get_the_title($team2_id);
                        $team1_logo = get_the_post_thumbnail_url($team1_id, 'full') ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';
                        $team2_logo = get_the_post_thumbnail_url($team2_id, 'full') ?: get_template_directory_uri() . '/hwc-images/default-team-logo.png';
                        $match_date = get_field('fixture_match_date');

                        // Output the result layout
                        echo '<div class="match-card" data-status="complete">';
                        echo '<div class="match-card-header">';
                        echo '<span class="tax tax-team">' . esc_html($fixture_league_title) . '</span>';
                        echo '<span class="label">Latest Result</span>';
                        echo '</div>';

                        echo '<div class="match-details">';
                        echo '<span class="match-date">' . esc_html(date('D j F', strtotime($match_date))) . '</span>';
                        echo '<span class="match-venue-name">' . esc_html($venue) . '</span>';
                        echo '</div>';

                        echo '<div class="match-clubs">';
                        echo '<div class="match-club match-club-home">';
                        echo '<img width="200" height="282" src="' . esc_url($team1_logo) . '" class="logo club-logo" alt="' . esc_attr($team1_name) . '" decoding="async" loading="lazy">';
                        echo '<div class="match-club-inner">';
                        echo '<span class="match-club-name">' . esc_html($team1_name) . '</span>';
                        echo '</div>';
                        echo '<span class="match-club-score">' . esc_html($team1_score) . '</span>';
                        echo '</div>';

                        echo '<div class="match-club match-club-away">';
                        echo '<img width="300" height="276" src="' . esc_url($team2_logo) . '" class="logo club-logo" alt="' . esc_attr($team2_name) . '" decoding="async" loading="lazy">';
                        echo '<div class="match-club-inner">';
                        echo '<span class="match-club-name">' . esc_html($team2_name) . '</span>';
                        echo '</div>';
                        echo '<span class="match-club-score">' . esc_html($team2_score) . '</span>';
                        echo '</div>';

                        echo '<div class="match-state">';
                        echo '<span class="match-score">' . esc_html($team1_score . '-' . $team2_score) . '</span>';
                        echo '</div>';
                        echo '</div>'; // End match-clubs

                        echo '<div class="match-actions">';
                        echo '<a href="' . esc_url($result_permalink) . '" class="btn btn-sm btn-outline">Match Centre</a>';
                        echo '</div>';
                        echo '</div>'; // End match-card

                        wp_reset_postdata(); // Reset fixture postdata
                        return;  // Exit loop after the first matching result
                    }
                }
            }
        }
    } else {
        echo '';
    }

    wp_reset_postdata();
}

/*--------------------------------------------------------------
	>>> Sec7 - Newslatter
----------------------------------------------------------------*/
// Function to generate the newsletter section
function hwc_home_newsletter_shortcode()
{
    // Get ACF fields with hwc_home prefix
    $background_image = get_field('hwc_home_newsletter_background_image');
    $newsletter_title = get_field('hwc_home_newsletter_title');
    $newsletter_description = get_field('hwc_home_newsletter_description');
    $newsletter_html_box = get_field('hwc_home_newsletter_html_box');

    // Prepare the HTML output
    $output = '<div id="block-6791-7" class="block block-6791-7 block-newsletter after-row-team last-block">';
    $output .= '<div class="lg:container">';
    $output .= '<div class="callout callout-newsletter" data-theme="dark">';

    // Background Image
    if ($background_image) {
        $output .= '<div class="callout-image">';
        $output .= '<img width="960" height="540" src="' . esc_url($background_image['url']) . '" class="attachment-16x9-md size-16x9-md" alt="" decoding="async" loading="lazy" srcset="' . esc_url($background_image['url']) . '" sizes="(max-width: 960px) 100vw, 960px">';
        $output .= '</div>';
    }

    // Callout Content
    $output .= '<div class="callout-content">';
    $output .= '<h2 class="callout-title">' . esc_html($newsletter_title) . '</h2>';
    $output .= '<p>' . esc_html($newsletter_description) . '</p>';
    $output .= '</div>';

    // Output the HTML from ACF field
    if ($newsletter_html_box) {
        $output .= '<div class="newsletter-html-box">' . $newsletter_html_box . '</div>';
    }

    $output .= '</div>'; // End callout
    $output .= '</div>'; // End lg:container
    $output .= '</div>'; // End block

    return $output; // Return the generated HTML
}
