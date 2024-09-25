<?php

/**
 * Code For Display Match Result Table.
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
            <h1 class="section-heading section-heading-display" id="selected-league-table">
                First Team
            </h1>


            <div class="filter filter-select">
                <a class="filter-select-trigger" href="#filter-options" aria-label="Select Team" data-js-filter-select="" aria-controls="filter-options" aria-expanded="false">
                    <span>
                        <span class="filter-select-label">
                            League
                        </span>
                        <span class="filter-select-value" id="selecte-league-table">
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
                        $leagues = get_posts(array(
                            'post_type' => 'league_table',
                            'numberposts' => -1,  // Fetch all teams
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ));

                        foreach ($leagues as $league) {
                            // Dynamically output each team option
                            echo '<li class="filter-options-item">';
                            echo '<a role="option" aria-selected="false" href="#" data-league_table-id="' . esc_attr($league->ID) . '" onclick="change_league_table(this)">' . esc_html($league->post_title) . '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="section-sub-navigation">
            <ul class="tablist">
                <li><a class="tabslist-item" href="<?php echo site_url(); ?>/fixtures">Fixtures</a></li>
                <li><a class="tabslist-item" href="<?php echo site_url(); ?>/result">Results</a></li>
                <li><a class="tabslist-item is-active" href="<?php echo site_url(); ?>/league_table">Table</a></li>
            </ul>
        </div>
    </div>

    <span id="league-table-results"></span>

</div>

<?php get_footer(); ?>