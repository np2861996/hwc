<?php

/**
 * Code For Display Teams info.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

get_header();
$team_id = get_the_ID();


// Query to get all team posts
$args = array(
    'post_type'      => 'team',
    'posts_per_page' => -1, // Get all posts
    'post_status'    => 'publish',
);
$team_query = new WP_Query($args);

// Get current team selection, if any
$current_team_id = 0;
$current_team_title = 'Select Team';
$current_team_url = '#'; // Default to a placeholder

// Check if on a single team page
if (is_singular('team')) {
    $current_team_id = get_the_ID(); // Get the current team's ID
    $current_team_title = get_the_title($current_team_id); // Get the current team's title
    $current_team_url = get_permalink($current_team_id); // Get the current team's permalink
} elseif (isset($_GET['team_id'])) {
    // If a team_id is set in the URL, use that
    $current_team_id = intval($_GET['team_id']);
    $current_team_post = get_post($current_team_id);
    if ($current_team_post) {
        $current_team_title = get_the_title($current_team_post);
        $current_team_url = get_permalink($current_team_post);
    }
} else {
    // Set default team if no team is selected
    $default_team = get_posts(array(
        'post_type'      => 'team',
        'posts_per_page' => 1, // Get the first post
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    ));

    if ($default_team) {
        $current_team_id = $default_team[0]->ID;
        $current_team_title = get_the_title($default_team[0]);
        $current_team_url = get_permalink($default_team[0]);
    }
}

/**
 * Display players for all roles on a single team page.
 */
function display_players_for_all_roles()
{
    if (is_singular('team')) {
        $team_id = get_the_ID(); // Get the current team's ID

        // Query to get all unique player roles for the current team
        $roles_query = new WP_Query(array(
            'post_type'      => 'player',
            'meta_query'     => array(
                array(
                    'key'     => 'team_selection',
                    'value'   => $team_id,
                    'compare' => 'LIKE'
                ),
            ),
            'fields'         => 'ids', // Retrieve only post IDs
            'posts_per_page' => -1, // Retrieve all posts
            'post_status'    => 'publish'
        ));

        $roles = array();

        // Collect all unique roles
        if ($roles_query->have_posts()) {
            while ($roles_query->have_posts()) {
                $roles_query->the_post();
                $terms = wp_get_post_terms(get_the_ID(), 'player_role', array('fields' => 'names'));
                foreach ($terms as $term) {
                    if (!in_array($term, $roles)) {
                        $roles[] = $term;
                    }
                }
            }
        }

        // Reset post data
        wp_reset_postdata();

        // Sort roles if needed (optional)
        $roles = array_unique($roles); // Ensure roles are unique
        sort($roles); // Optional: sort roles alphabetically

        // Query players by role
        foreach ($roles as $role) {
            $query_args = array(
                'post_type' => 'player',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'player_role',
                        'field'    => 'name',
                        'terms'    => $role,
                        'operator' => 'IN',
                    ),
                ),
                'meta_query' => array(
                    array(
                        'key'     => 'team_selection',
                        'value'   => $team_id,
                        'compare' => 'LIKE'
                    ),
                ),
                'posts_per_page' => -1,
                'post_status'    => 'publish'
            );

            $player_query = new WP_Query($query_args);

            if ($player_query->have_posts()) {
                echo '<h2 class="legend"><span>' . esc_html($role) . '</span></h2>';
                echo '<div class="container">';
                echo '<div class="player-list player-list-first-team grid-container grid-columns-2-lg-3-xl-4">';

                while ($player_query->have_posts()) {
                    $player_query->the_post();

                    $player_id = get_the_ID();
                    $player_first_name = get_field('player_first_name', $player_id);
                    $player_last_name = get_field('player_last_name', $player_id);
                    $player_number = get_field('player_number', $player_id);
                    $player_sponsor = get_field('player_sponsor', $player_id);
                    $player_image_url = get_the_post_thumbnail_url($player_id, 'full');

?>
                    <div class="player-list-item team-first-team position-<?php echo esc_attr(strtolower($role)); ?>">
                        <div class="card card-player card-cover card-w-link">
                            <span class="card-data card-data-squad-number"><span><?php echo esc_html($player_number); ?></span></span>
                            <div class="card-image">
                                <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr($player_first_name . ' ' . $player_last_name); ?>">
                                    <div class="image-container ratio-3x4">
                                        <img width="768" height="960" src="<?php echo esc_url($player_image_url); ?>" class="fill wp-post-image" alt="<?php echo esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)); ?>" decoding="async">
                                    </div>
                                </a>
                            </div>
                            <div class="card-content">
                                <span class="card-title">
                                    <span class="player-first-name"><?php echo esc_html($player_first_name); ?></span><span class="player-last-name"><?php echo esc_html($player_last_name); ?></span>
                                </span>
                                <div class="card-meta">
                                    <span class="tax tax-position"><?php echo esc_html($role); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if ($player_sponsor) : ?>
                            <div class="player-sponsor">
                                <span class="label">Sponsored by</span>
                                <a href="<?php echo esc_url($player_sponsor['url']); ?>" target="_blank">
                                    <span class="title"><?php echo esc_html($player_sponsor['title']); ?></span>
                                    <svg aria-hidden="true" width="16" height="16" viewBox="0 0 16 16">
                                        <path d="M3.333 2.75a.583.583 0 0 0-.583.583v9.334c0 .322.261.583.583.583h9.334a.583.583 0 0 0 .583-.583v-4a.75.75 0 0 1 1.5 0v4c0 1.15-.933 2.083-2.083 2.083H3.333a2.083 2.083 0 0 1-2.083-2.083V3.333c0-1.15.933-2.083 2.083-2.083h4a.75.75 0 1 1 0 1.5h-4Zm6.667 0a.75.75 0 0 1 0-1.5h4a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V3.81L8.53 8.53a.75.75 0 0 1-1.06-1.06l4.72-4.72H10Z" fill="currentColor"></path>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
<?php
                }

                echo '</div>'; // Close .player-list
                echo '</div>'; // Close .container
            }

            // Reset post data
            wp_reset_postdata();
        }
    }
}



?>

<div class="block post-<?php echo $team_id; ?> club_team type-club_team status-publish hentry">

    <div class="container">

        <div class="section-header">
            <h1 class="section-heading section-heading-display">Teams</h1>

            <div class="filter filter-select">

                <a class="filter-select-trigger" href="#filter-options" aria-label="Select Team" data-js-filter-select="" aria-controls="filter-options" aria-expanded="false">
                    <span>
                        <span class="filter-select-label">
                            Team
                        </span>
                        <span class="filter-select-value">
                            <?php echo esc_html($current_team_title); ?>
                        </span>
                    </span>

                    <svg aria-hidden="true" class="filter-select-icon" width="20" height="20" viewBox="0 0 20 20">
                        <path d="M3.578 6.91a.833.833 0 0 1 1.178 0L10 12.156l5.244-5.244a.833.833 0 0 1 1.179 1.178l-5.834 5.834a.833.833 0 0 1-1.178 0L3.578 8.089a.833.833 0 0 1 0-1.178Z" fill="currentColor"></path>
                    </svg>
                </a>

                <div class="filter-options" id="filter-options" role="listbox" aria-hidden="true">
                    <ul>
                        <?php
                        // Check if there are any team posts
                        if ($team_query->have_posts()) {
                            // Loop through each team post
                            while ($team_query->have_posts()) {
                                $team_query->the_post();
                                $team_title = get_the_title();
                                $team_url = get_permalink();
                                $is_active = ($current_team_id == get_the_ID()) ? 'is-active' : '';
                                $aria_selected = ($current_team_id == get_the_ID()) ? 'true' : 'false';

                                // Output the list item for each team
                                echo '<li class="filter-options-item ' . esc_attr($is_active) . '">
                                <a role="option" aria-selected="' . esc_attr($aria_selected) . '" href="' . esc_url($team_url) . '">' . esc_html($team_title) . '</a>
                              </li>';
                            }
                            wp_reset_postdata(); // Reset the query
                        } else {
                            // Output a message if no teams are found
                            echo '<li class="filter-options-item">No teams found.</li>';
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>


        <ul class="tablist" aria-label="Team Navigation" data-js-tabs="" role="tablist">

            <li>
                <a href="#team-squad" class="tablist-item is-active" id="tab-team-squad" role="tab" aria-selected="true">
                    Squad </a>
            </li>


            <li>
                <a href="#team-staff" class="tablist-item" id="tab-team-staff" role="tab">
                    Staff </a>
            </li>

        </ul>


    </div>

    <div class="tab-panels">

        <div class="tab-panel is-active" id="team-squad" role="tabpanel" aria-labelledby="tab-team-squad">
            <?php
            // Inside the loop or wherever appropriate
            display_players_for_all_roles();
            ?>
        </div>
        <div class="tab-panel" id="team-staff" role="tabpanel" aria-labelledby="tab-team-staff" aria-hidden="true">
            <div class="container">
                <div class="grid-container grid-columns-2-lg-3-xl-4">

                    <div class="player-list-item position-staff">
                        <div class="card card-player card-cover card-w-link">


                            <div class="card-image">
                                <a href="https://haverfordwestcountyafc.com/staff/tony-pennock/" aria-label="Tony Pennock">
                                    <div class="image-container ratio-3x4">
                                        <img width="768" height="960" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp" class="fill wp-post-image" alt="Profile photo of Tony Pennock" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp 768w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
                                    </div>

                                </a>
                            </div>


                            <div class="card-content">


                                <span class="card-title">
                                    <span class="player-first-name">Tony</span><span class="player-last-name">Pennock</span> </span>


                                <div class="card-meta">
                                    <span class="tax tax-position">Manager</span>
                                </div>


                            </div>


                        </div>

                        <div class="player-sponsor">


                            <span class="label">Sponsored by</span>


                            <span class="title">Haverfordwest County AFC Supporters Association</span>



                        </div>
                    </div>
                    <div class="player-list-item position-staff">
                        <div class="card card-player card-cover">


                            <div class="card-image">

                                <div class="image-container ratio-3x4">
                                    <img width="768" height="960" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp" class="fill wp-post-image" alt="Profile photo of Gary Richards" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp 768w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
                                </div>

                            </div>


                            <div class="card-content">


                                <span class="card-title">
                                    <span class="player-first-name">Gary</span><span class="player-last-name">Richards</span> </span>


                                <div class="card-meta">
                                    <span class="tax tax-position">Assistant Manager</span>
                                </div>


                            </div>


                        </div>

                        <div class="player-sponsor">


                            <span class="label">This staff member is available to sponsor</span>

                            <a href="https://haverfordwestcountyafc.com/commercial/sponsorship-opportunities/">
                                <span class="title">Sponsor this staff member</span>
                            </a>


                        </div>
                    </div>
                    <div class="player-list-item position-staff">
                        <div class="card card-player card-cover">


                            <div class="card-image">

                                <div class="image-container ratio-3x4">
                                    <img width="768" height="960" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg" class="fill wp-post-image" alt="Profile photo of Rob  Thomas" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg 768w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
                                </div>

                            </div>


                            <div class="card-content">


                                <span class="card-title">
                                    <span class="player-first-name">Rob </span><span class="player-last-name">Thomas</span> </span>


                                <div class="card-meta">
                                    <span class="tax tax-position">Goalkeeping Coach</span>
                                </div>


                            </div>


                        </div>

                        <div class="player-sponsor">


                            <span class="label">This staff member is available to sponsor</span>

                            <a href="https://haverfordwestcountyafc.com/commercial/sponsorship-opportunities/">
                                <span class="title">Sponsor this staff member</span>
                            </a>


                        </div>
                    </div>
                    <div class="player-list-item position-staff">
                        <div class="card card-player card-cover">


                            <div class="card-image">

                                <div class="image-container ratio-3x4">
                                    <img width="768" height="960" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg" class="fill wp-post-image" alt="Profile photo of Richard Thompson" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg 768w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
                                </div>

                            </div>


                            <div class="card-content">


                                <span class="card-title">
                                    <span class="player-first-name">Richard</span><span class="player-last-name">Thompson</span> </span>


                                <div class="card-meta">
                                    <span class="tax tax-position">Doctor</span>
                                </div>


                            </div>


                        </div>

                        <div class="player-sponsor">


                            <span class="label">This staff member is available to sponsor</span>

                            <a href="https://haverfordwestcountyafc.com/commercial/sponsorship-opportunities/">
                                <span class="title">Sponsor this staff member</span>
                            </a>


                        </div>
                    </div>
                    <div class="player-list-item position-staff">
                        <div class="card card-player card-cover">


                            <div class="card-image">

                                <div class="image-container ratio-3x4">
                                    <img width="768" height="960" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp" class="fill wp-post-image" alt="Profile photo of Henry Fensome" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp 768w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/28122038/32HFC0805_PlayerProfilesBlank.webp?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
                                </div>

                            </div>


                            <div class="card-content">


                                <span class="card-title">
                                    <span class="player-first-name">Henry</span><span class="player-last-name">Fensome</span> </span>


                                <div class="card-meta">
                                    <span class="tax tax-position">Sports Therapist</span>
                                </div>


                            </div>


                        </div>

                        <div class="player-sponsor">


                            <span class="label">This staff member is available to sponsor</span>

                            <a href="https://haverfordwestcountyafc.com/commercial/sponsorship-opportunities/">
                                <span class="title">Sponsor this staff member</span>
                            </a>


                        </div>
                    </div>
                    <div class="player-list-item position-staff">
                        <div class="card card-player card-cover">


                            <div class="card-image">

                                <div class="image-container ratio-3x4">
                                    <img width="768" height="960" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg" class="fill wp-post-image" alt="Profile photo of Mickey Ellis" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg 768w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/32HFC0805_PlayerProfilesBlank.jpg?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
                                </div>

                            </div>


                            <div class="card-content">


                                <span class="card-title">
                                    <span class="player-first-name">Mickey</span><span class="player-last-name">Ellis</span> </span>


                                <div class="card-meta">
                                    <span class="tax tax-position">Kitman</span>
                                </div>


                            </div>


                        </div>

                        <div class="player-sponsor">


                            <span class="label">This staff member is available to sponsor</span>

                            <a href="https://haverfordwestcountyafc.com/commercial/sponsorship-opportunities/">
                                <span class="title">Sponsor this staff member</span>
                            </a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php get_footer(); ?>