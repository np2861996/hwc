<?php

/**
 * Code For Display fixtures info.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

get_header();

/*--------------------------------------------------------------
	>>> ACF fields
----------------------------------------------------------------*/
// Get ACF field values
$match_image = get_field('fixture_background_image'); // Background image field
$home_team = get_field('fixture_team_1'); // Team 1
$away_team = get_field('fixture_team_2'); // Team 2
$match_time = get_field('fixture_match_time'); // Match time
$match_date = get_field('fixture_match_date'); // Match date
$match_venue = get_field('fixture_stadium_name'); // Stadium name
$fixture_league_id = get_field('fixture_league'); // League logo or information
$home_team_name = $home_team ? get_the_title($home_team) : '';
$home_team_logo = get_the_post_thumbnail_url($home_team) ?: '';
$away_team_name = $away_team ? get_the_title($away_team) : '';
$away_team_logo = get_the_post_thumbnail_url($away_team) ?: '';
$fixture_league_logo = get_the_post_thumbnail_url($fixture_league_id) ?: '';

/*--------------------------------------------------------------
	>>> Images
----------------------------------------------------------------*/
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


/*--------------------------------------------------------------
	>>> Time
----------------------------------------------------------------*/
// Split the date into day, month, and year
list($day, $month, $year) = explode('/', $match_date);
$formatted_date = sprintf('%04d-%02d-%02d', $year, $month, $day); // Format: 'Y-m-d'

// Convert the match time to 24-hour format
$time_parts = explode(' ', $match_time);
$time = $time_parts[0];
$ampm = isset($time_parts[1]) ? strtoupper($time_parts[1]) : '';
list($hour, $minute) = explode(':', $time);

if ($ampm === 'PM' && $hour != 12) {
    $hour += 12; // Convert PM hour to 24-hour format
} elseif ($ampm === 'AM' && $hour == 12) {
    $hour = 0; // Convert 12 AM to 0 hours
}

$formatted_time = sprintf('%02d:%02d', $hour, $minute); // Format: 'H:i'

// Combine date and time
$match_date_time = $formatted_date . 'T' . $formatted_time . '+01:00';

/*--------------------------------------------------------------
	>>> news
----------------------------------------------------------------*/
function get_latest_match_preview()
{
    // Initialize the output variable
    $output = '';

    // Query for the latest 1 post in the 'Match Previews' category
    $args = array(
        'post_type'      => 'post', // Change to your custom post type if needed
        'posts_per_page' => 1, // Set to 1 if you only want the latest post
        //'category_name'  => 'match-preview', // Replace with your category slug
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<div class="card card-post card-lg card-w-link">';
            $output .= '<div class="card-image">';
            $output .= '<a href="' . get_permalink() . '" aria-label="' . esc_attr(get_the_title()) . '">';
            $output .= '<div class="image-container ratio-16x9">';
            if (has_post_thumbnail()) {
                $output .= get_the_post_thumbnail(null, '16x9', ['class' => 'fill', 'loading' => 'lazy']);
            } else {
                $output .= '<img src="default-image-url.jpg" alt="Default Image" class="fill" loading="lazy" />'; // Default image if no thumbnail
            }
            $output .= '</div>';
            $output .= '</a>';
            $output .= '</div>';
            $output .= '<div class="card-content">';
            $output .= '<span class="card-title">' . get_the_title() . '</span>';
            $output .= '<p class="card-summary">' . wp_trim_words(get_the_excerpt(), 20) . '</p>';
            $output .= '<div class="card-meta">';
            $output .= '<span class="cat">' . get_the_category_list(', ') . '</span>';
            $output .= '<span class="timestamp">' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago</span>';
            $output .= '</div>';
            $output .= '</div>'; // End of card-content
            $output .= '</div>'; // End of card
        }
    } else {
        $output .= '<p>No match previews available.</p>'; // Message if no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();

    return $output; // Return the generated HTML
}

?>

<div class="post-<?php echo get_the_ID(); ?> match type-match status-publish has-post-thumbnail hentry team-first-team">
    <div class="match-banner pre-match" data-theme="dark">
        <div class="match-image">
            <div class="image-container">
                <img width="1280" height="720" src="<?php echo esc_url($match_image); ?>" class="attachment-16x9-lg size-16x9-lg wp-post-image" alt="" decoding="async">
            </div>
        </div>

        <div class="match-clubs">
            <div class="match-club match-club-home">
                <img width="199" height="199" src="<?php echo esc_url($dis_home_team_logo); ?>" class="logo club-logo" alt="<?php echo esc_attr($home_team_name); ?>" decoding="async">
                <div class="match-club-inner">
                    <span class="match-club-name"><?php echo esc_html($home_team_name); ?></span>
                </div>
            </div>
            <div class="match-club match-club-away">
                <img width="200" height="282" src="<?php echo esc_url($dis_away_team_logo); ?>" class="logo club-logo" alt="<?php echo esc_attr($away_team_name); ?>" decoding="async">
                <div class="match-club-inner">
                    <span class="match-club-name"><?php echo esc_html($away_team_name); ?></span>
                </div>
            </div>
            <div class="match-state">
                <span class="match-ko"><?php echo esc_html($match_time); ?></span>
            </div>
        </div>

        <div class="match-countdown countdown show-if-js" data-js-countdown="<?php echo $match_date_time; ?>">
            <div class="countdown-days">
                <span class="countdown-value" data-js-countdown-days="">0</span>
                <span class="countdown-label">Days</span>
            </div>
            <div class="countdown-hours">
                <span class="countdown-value" data-js-countdown-hours="">7</span>
                <span class="countdown-label">Hours</span>
            </div>
            <div class="countdown-minutes">
                <span class="countdown-value" data-js-countdown-minutes="">18</span>
                <span class="countdown-label">Mins</span>
            </div>
        </div>

        <img width="300" height="98" src="<?php echo esc_url($dis_fixture_league_logo); ?>" class="logo competition-logo" alt="" decoding="async" loading="lazy">
        <div class="match-details md:separate-items">
            <span class="match-date"><?php echo esc_html($match_date); ?></span>
            <span class="match-venue-name"><?php echo esc_html($match_venue); ?></span>
        </div>
    </div>

    <?php
    // Query for the latest 2 posts in the 'Match Previews' category
    $args = array(
        'post_type'      => 'post', // Change to your custom post type if needed
        'posts_per_page' => 10,
        'category_name'  => 'match-preview', // Replace with your category slug
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
        <div class="block">
            <div class="container">
                <div class="lg:grid-container">
                    <div class="match-feed">
                        <div class="post-list">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="card card-post card-lg card-w-link">
                                    <div class="card-image">
                                        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                                            <div class="image-container ratio-16x9">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('16x9', ['class' => 'fill', 'loading' => 'lazy']); ?>
                                                <?php else : ?>
                                                    <img src="default-image-url.jpg" alt="Default Image" class="fill" loading="lazy" /> <!-- Default image if no thumbnail -->
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
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="match-aside">
                    </div>
                </div>
            </div>
        </div>
    <?php
    endif;

    // Restore original Post Data
    wp_reset_postdata();
    ?>

</div>


<?php get_footer(); ?>