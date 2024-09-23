<?php

/**
 * Code For Display fixtures info.
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
            <h1 class="section-heading section-heading-display" id="selected-team-big-name">
                First Team <span class="screen-reader-text">Fixtures</span>
            </h1>

            <div class="filter filter-select">
                <a class="filter-select-trigger" href="#filter-options" aria-label="Select Team" data-js-filter-select="" aria-controls="filter-options" aria-expanded="false">
                    <span>
                        <span class="filter-select-label">
                            Team
                        </span>
                        <span class="filter-select-value" id="selected-team">
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
                        // Fetch teams dynamically from 'team' post type or taxonomy
                        $teams = get_posts(array(
                            'post_type' => 'team',
                            'numberposts' => -1,  // Fetch all teams
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ));

                        foreach ($teams as $team) {
                            // Dynamically output each team option
                            echo '<li class="filter-options-item">';
                            echo '<a role="option" aria-selected="false" href="#" data-team-id="' . esc_attr($team->ID) . '" onclick="changeTeam(this)">' . esc_html($team->post_title) . '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="section-sub-navigation">
            <ul class="tablist">
                <li><a class="tabslist-item is-active" href="<?php echo site_url(); ?>/fixtures">Fixtures</a></li>
                <li><a class="tabslist-item" href="<?php echo site_url(); ?>/result">Results</a></li>
                <li><a class="tabslist-item" href="<?php echo site_url(); ?>/league_table">Table</a></li>
            </ul>
        </div>
    </div>

    <div class="md:container">
        <div id="fixtures-results"></div> <!-- Results will be loaded here -->
    </div>
</div>

<script>
    // JavaScript function to handle team selection and update the displayed team
    function changeTeam(element) {
        var selectedTeam = element.innerText;
        document.getElementById('selected-team').innerText = selectedTeam;
        document.getElementById('selected-team-big-name').innerText = selectedTeam;

        // Perform your AJAX call or other actions to update fixtures based on selected team
    }
</script>

<?php get_footer(); ?>