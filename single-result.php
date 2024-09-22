<?php

/**
 * Code For Display Result info.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

get_header();

// Store ACF fields in variables
$competition = get_field('select_result_match');

// Check if the field has data
if ($competition) {
    foreach ($competition as $match) {
        // Access the relevant fields for each match
        $match_id = $match->ID; // Match ID
        $competition = $match->post_title; // Match title
        // You can add more fields as needed
    }
}

// Get the fixture ID based on the title stored in result_select_result_match
$fixture_query = new WP_Query(array(
    'post_type' => 'fixtures', // Assuming 'fixtures' is the post type
    'title' => $competition,
    'posts_per_page' => 1,
));

$venue = '';
$team1_name = ''; // Get team 1 name
$team2_name = ''; // Get team 2 name
$team1_logo = '';
$team2_logo = '';

if ($fixture_query->have_posts()) {
    $fixture_query->the_post();

    $team1_name = get_field('fixture_team_1'); // Get team 1 name
    $team1_name = $team1_name ? get_the_title($team1_name) : '';
    $team2_name = get_field('fixture_team_2'); // Get team 1 name
    $team2_name = $team2_name ? get_the_title($team2_name) : '';
    $venue = get_field('fixture_stadium_name'); // Get the venue from the fixture
    $fixture_league_id = get_field('fixture_league');
    $fixture_league = $team2_name ? get_the_title($fixture_league_id) : '';

    // Query for team 1 to get the ID and logo
    $team1_query = new WP_Query(array(
        'post_type' => 'team', // Assuming 'team' is the post type
        'title' => $team1_name,
        'posts_per_page' => 1,
    ));
    if ($team1_query->have_posts()) {
        $team1_query->the_post();
        $team1_logo = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Get team 1 logo (featured image)
        wp_reset_postdata();
    }

    // Query for team 2 to get the ID and logo
    $team2_query = new WP_Query(array(
        'post_type' => 'team', // Assuming 'team' is the post type
        'title' => $team2_name,
        'posts_per_page' => 1,
    ));
    if ($team2_query->have_posts()) {
        $team2_query->the_post();
        $team2_logo = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Get team 2 logo (featured image)
        wp_reset_postdata();
    }

    wp_reset_postdata(); // Reset post data after fixture query
}

$team1_players = get_field('select_result_team1_players');
$team1_score = get_field('field_result_total_goals_team_1');
$team2_players = get_field('select_result_team2_players');
$team2_score = get_field('field_result_total_goals_team_2');
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Get featured image URL
$result_goals_info_team_1 = get_field('result_goals_info_team_1');
$result_goals_info_team_2 = get_field('result_goals_info_team_2');


/*--------------------------------------------------------------
	>>> Assuming $fixture_result_id holds the ID of the fixture result
	----------------------------------------------------------------*/
$team1_players = get_field('select_result_team1_players', get_the_ID());
$team1_substitutes = get_field('select_result_team1_substitutes_players', get_the_ID());
$team2_players = get_field('select_result_team2_players', get_the_ID());
$team2_substitutes = get_field('select_result_team2_substitutes_players', get_the_ID());

// Function to display players
function display_players($players, $is_substitute = false)
{
    foreach ($players as $player) {
        $player_id = $player->ID; // Get the player ID
        $player_name = get_the_title($player_id); // Get the player name
        $player_image = get_the_post_thumbnail_url($player_id, 'full'); // Get the player's featured image

        // Display player HTML
        echo '<li class="lineup-item' . ($is_substitute ? ' off-field' : '') . '">';
        echo '<span class="lineup-item-num">' . $player_id . '</span>'; // You might want to change this to a jersey number if you have it
        echo '<span class="lineup-item-image">';
        echo '<a href="' . get_permalink($player_id) . '">';
        echo '<img width="400" height="400" src="' . esc_url($player_image) . '" class="avatar wp-post-image" alt="" decoding="async" loading="lazy">';
        echo '</a>';
        echo '</span>';
        echo '<span class="lineup-item-player">';
        echo '<span class="player-name">' . esc_html($player_name) . '</span>';
        echo '</span>';
        echo '</li>';
    }
}
?>

<div class="post-9814 match type-match status-publish has-post-thumbnail hentry team-first-team">


    <div class="match-banner post-match" data-theme="dark">

        <div class="match-banner-inner">


            <div class="match-card card-dark" data-status="complete">

                <div class="match-card-header">
                    <span class="tax tax-team"></span>
                </div>
                <div class="match-details">
                    <span class="match-competition"><?php echo esc_html($fixture_league); ?></span>
                    <span class="match-date"><?php echo get_the_date(); ?></span>
                    <span class="match-venue-name"><?php echo esc_html($venue); ?></span>
                </div>

                <div class="match-clubs">

                    <div class="match-club match-club-home">
                        <img width="250" height="293" src="<?php echo esc_url($team1_logo); ?>" class="logo club-logo" alt="<?php echo esc_attr($team1_name); ?>" decoding="async">
                        <div class="match-club-inner">
                            <span class="match-club-name"><?php echo esc_html($team1_name); ?></span>
                            <ul class="goals">
                                <li class="goal"><span class="goal-scorer"><?php echo esc_html($result_goals_info_team_1); ?></span></li>
                            </ul>
                        </div>
                        <span class="match-club-score"><?php echo esc_html($team1_score); ?></span>
                    </div>

                    <div class="match-club match-club-away">
                        <img width="200" height="282" src="<?php echo esc_url($team2_logo); ?>" class="logo club-logo" alt="<?php echo esc_attr($team2_name); ?>" decoding="async">
                        <div class="match-club-inner">
                            <span class="match-club-name"><?php echo esc_html($team2_name); ?></span>
                            <ul class="goals">
                                <li class="goal"><span class="goal-scorer"> <?php echo esc_html($result_goals_info_team_2); ?></span></li>
                            </ul>
                        </div>
                        <span class="match-club-score"><?php echo esc_html($team2_score); ?></span>
                    </div>

                    <div class="match-state">
                        <span class="match-score"><?php echo esc_html($team1_score . '-' . $team2_score); ?></span>
                    </div>

                </div>
            </div>

            <div class="match-image">
                <div class="image-container">
                    <?php if ($featured_image): ?>
                        <img src="<?php echo esc_url($featured_image); ?>" alt="Match Image" decoding="async">
                        <figcaption class="caption"><?php echo get_the_content(); ?></figcaption>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>



    <div class="block">
        <div class="container">
            <div class="lg:grid-container">

                <div class="match-feed">

                    <?php
                    // Query for the latest 2 posts in the 'Match Previews' category
                    $args = array(
                        'post_type'      => 'post', // Change to your custom post type if needed
                        'posts_per_page' => 10,
                        //'category_name'  => 'match-preview', // Replace with your category slug
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) : ?>

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
                    <?php
                    endif;

                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>

                </div>
                <div class="match-aside">

                    <div class="lineups">
                        <h2 class="section-heading">Lineups</h2>


                        <ul class="tablist" aria-label="Team Lineups" data-js-tabs="" role="tablist">

                            <li>
                                <a href="#lineup-home" class="tablist-item" id="tab-lineup-home" role="tab">
                                    <img width="250" height="293" src="<?php echo esc_url($team1_logo); ?>" class="logo club-logo" alt="<?php echo esc_attr($team1_name); ?>" decoding="async" loading="lazy"> <span><?php echo esc_attr($team1_name); ?></span>
                                </a>
                            </li>


                            <li>
                                <a href="#lineup-away" class="tablist-item is-active" id="tab-lineup-away" role="tab" aria-selected="true">
                                    <img width="200" height="282" src="<?php echo esc_url($team2_logo); ?>" class="logo club-logo" alt="<?php echo esc_attr($team2_name); ?>" decoding="async" loading="lazy"> <span><?php echo esc_attr($team2_name); ?></span>
                                </a>
                            </li>

                        </ul>

                        <div class="tab-panels" style="">
                            <div id="lineup-home" class="lineup tab-panel is-active" role="tabpanel" aria-labelledby="tab-lineup-home">
                                <ul class="lineup-group lineup-starting">
                                    <?php display_players($team1_players); ?>
                                </ul>
                                <span class="lineup-group-title">Substitutes</span>
                                <ul class="lineup-group lineup-subs">
                                    <?php display_players($team1_substitutes, true); ?>
                                </ul>
                            </div>

                            <div id="lineup-away" class="lineup tab-panel" role="tabpanel" aria-labelledby="tab-lineup-away" aria-hidden="true">
                                <ul class="lineup-group lineup-starting">
                                    <?php display_players($team2_players); ?>
                                </ul>
                                <span class="lineup-group-title">Substitutes</span>
                                <ul class="lineup-group lineup-subs">
                                    <?php display_players($team2_substitutes, true); ?>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php get_footer(); ?>