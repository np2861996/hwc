<?php

/**
 * Code For Display Match Result info.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

get_header();
?>

<div class="match-list">
    <div class="container">
        <div class="section-header">
            <h1 class="section-heading section-heading-display" id="selected-result-team-big-name">
                First Team <span class="screen-reader-text">Fixtures</span>
            </h1>

            <div class="filter filter-select">
                <a class="filter-select-trigger" href="#filter-options" aria-label="Select Team" data-js-filter-select="" aria-controls="filter-options" aria-expanded="false">
                    <span>
                        <span class="filter-select-label">
                            Team
                        </span>
                        <span class="filter-select-value" id="selected-result-team">
                            First Team
                        </span>
                    </span>

                    <svg aria-hidden="true" class="filter-select-icon" width="20" height="20" viewBox="0 0 20 20">
                        <path d="M3.578 6.91a.833.833 0 0 1 1.178 0L10 12.156l5.244-5.244a.833.833 0 0 1 1.179 1.178l-5.834 5.834a.833.833 0 0 1-1.178 0L3.578 8.089a.833.833 0 0 1 0-1.178Z" fill="currentColor"></path>
                    </svg>
                </a>

                <div class="filter-options" id="filter-options" role="listbox" aria-hidden="true">
                    <ul>

                        <?php
                        // Initialize an array to store the teams that have already been outputted
                        $added_teams = array();

                        // Fetch all 'result' posts dynamically
                        $teams = get_posts(array(
                            'post_type' => 'result',  // Fetching posts from 'result' post type
                            'numberposts' => -1,      // Fetch all posts
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ));

                        foreach ($teams as $team) {
                            // Get the current 'result' post ID
                            $result_id = $team->ID;

                            // Fetch the ACF field 'select_result_match' for this 'result' post
                            $matches = get_field('select_result_match', $result_id);

                            // Check if there are any matches assigned to the 'result' post
                            if ($matches) {
                                foreach ($matches as $match) {
                                    // Get the match ID
                                    $match_id = $match->ID;

                                    // Fetch the related teams (assuming you have ACF fields for first and second teams)
                                    $team1_name_id = get_field('fixture_team_1', $match_id);
                                    $first_team = $team1_name_id ? get_the_title($team1_name_id) : '';
                                    $team2_name_id = get_field('fixture_team_2', $match_id);
                                    $second_team = $team2_name_id ? get_the_title($team2_name_id) : '';

                                    // Output first team if it hasn't been added yet
                                    if ($team1_name_id && !in_array($team1_name_id, $added_teams)) {
                                        echo '<li class="filter-result-options-item"><a role="option" aria-selected="false" href="#" data-team-result-id="' . esc_attr($team1_name_id) . '" onclick="changeTeam(this)">' . esc_html($first_team) . '</a></li>';
                                        // Add the team ID to the added_teams array to prevent duplicates
                                        $added_teams[] = $team1_name_id;
                                    }

                                    // Output second team if it hasn't been added yet
                                    if ($team2_name_id && !in_array($team2_name_id, $added_teams)) {
                                        echo '<li class="filter-result-options-item"><a role="option" aria-selected="false" href="#" data-team-result-id="' . esc_attr($team2_name_id) . '" onclick="changeTeam(this)">' . esc_html($second_team) . '</a></li>';
                                        // Add the team ID to the added_teams array to prevent duplicates
                                        $added_teams[] = $team2_name_id;
                                    }
                                }
                            }
                        }
                        ?>


                    </ul>
                </div>
            </div>
        </div>

        <div class="section-sub-navigation">
            <ul class="tablist">
                <li><a class="tabslist-item" href="<?php echo site_url(); ?>/fixtures">Fixtures</a></li>
                <li><a class="tabslist-item  is-active" href="<?php echo site_url(); ?>/result">Results</a></li>
                <li><a class="tabslist-item" href="<?php echo site_url(); ?>/league_table">Table</a></li>
            </ul>
        </div>
    </div>

    <div class="md:container">
        <div id="fixtures-results-page"></div> <!-- Results will be loaded here -->
    </div>
</div>

<script>
    // JavaScript function to handle team selection and update the displayed team
    function changeTeam(element) {
        var selectedTeam = element.innerText;
        document.getElementById('selected-result-team').innerText = selectedTeam;
        document.getElementById('selected-result-team-big-name').innerText = selectedTeam;

        // Perform your AJAX call or other actions to update fixtures based on selected team
    }
</script>

<?php get_footer(); ?>