<?php

/**
 * Code For Players info, add data ehen install and activate the theme.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

/*--------------------------------------------------------------
	>>> All Action and Filter Functions
	----------------------------------------------------------------*/
add_action('init', 'hwc_register_custom_post_type_Players');
add_action('acf/init', 'hwc_add_players_acf_fields');
add_action('after_switch_theme', 'hwc_populate_players_data');

/*--------------------------------------------------------------
	>>> Register Players Post Type
	----------------------------------------------------------------*/
function hwc_register_custom_post_type_Players()
{
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
}

/*--------------------------------------------------------------
	>>> Function for Add Players ACF Fields
	----------------------------------------------------------------*/
function hwc_add_players_acf_fields()
{
    if (class_exists('ACF')) {
        // Players ACF Fields
        if (function_exists('acf_add_local_field_group')):
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
                        'required' => 1, // Set to 1 for required, 0 for not required
                        'default_value' => array(
                            array(1) // Default to first team, replace with the appropriate team ID if needed
                        ),
                    ),
                    array(
                        'key' => 'field_player_number',
                        'label' => 'Player Number',
                        'name' => 'player_number',
                        'type' => 'number',
                        'default_value' => 'Default Position',
                        'required' => 1, // Set to 1 for required, 0 for not required
                    ),
                    // Player Background Image
                    array(
                        'key' => 'field_player_background_image',
                        'label' => 'Player Background Image',
                        'name' => 'player_background_image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'required' => 0,
                    ),
                    // Player First Name
                    array(
                        'key' => 'field_player_first_name',
                        'label' => 'Player First Name',
                        'name' => 'player_first_name',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    // Player Last Name
                    array(
                        'key' => 'field_player_last_name',
                        'label' => 'Player Last Name',
                        'name' => 'player_last_name',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    // Player Role
                    array(
                        'key' => 'field_player_role',
                        'label' => 'Player Role',
                        'name' => 'player_role',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    // Player Right Card Image
                    array(
                        'key' => 'field_player_right_card_image',
                        'label' => 'Player Right Card Image',
                        'name' => 'player_right_card_image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'required' => 0,
                    ),
                    // Player Right Card Title
                    array(
                        'key' => 'field_player_right_card_title',
                        'label' => 'Player Right Card Title',
                        'name' => 'player_right_card_title',
                        'type' => 'text',
                        'required' => 0,
                    ),
                    // Player Right Card Title 2
                    array(
                        'key' => 'field_player_right_card_title_2',
                        'label' => 'Player Right Card Title 2',
                        'name' => 'player_right_card_title_2',
                        'type' => 'text',
                        'required' => 0,
                    ),
                    // Player Right Card Button
                    array(
                        'key' => 'field_player_right_card_button',
                        'label' => 'Player Right Card Button',
                        'name' => 'player_right_card_button',
                        'type' => 'link',
                        'required' => 0,
                        'return_format' => 'array', // You can use 'url', 'array', or 'both' depending on your needs
                    ),
                    // Player Right Card Title 2
                    array(
                        'key' => 'field_stats_title',
                        'label' => 'Player Stats Title',
                        'name' => 'player_stats_title',
                        'type' => 'text',
                        'required' => 0,
                    ),
                    // Player States Repeater
                    array(
                        'key' => 'field_player_stats_repeater',
                        'label' => 'Player Stats Repeater',
                        'name' => 'player_stats',
                        'type' => 'repeater',
                        'required' => 0,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_player_stat_title_1',
                                'label' => 'Stat Title 1',
                                'name' => 'stat_title_1',
                                'type' => 'text',
                                'required' => 0,
                            ),
                            array(
                                'key' => 'field_player_stat_title_2',
                                'label' => 'Stat Title 2',
                                'name' => 'stat_title_2',
                                'type' => 'text',
                                'required' => 0,
                            ),
                        ),
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'block',
                    ),
                    // Player Biography Title
                    array(
                        'key' => 'field_player_biography_title',
                        'label' => 'Player Biography Title',
                        'name' => 'player_biography_title',
                        'type' => 'text',
                        'required' => 0,
                    ),
                    // Player Biography Description
                    array(
                        'key' => 'field_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'default_value' => 'Default Description',
                    ),
                    // Player Big Image 1
                    array(
                        'key' => 'field_player_big_image_1',
                        'label' => 'Player Big Image 1',
                        'name' => 'player_big_image_1',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'required' => 0,
                    ),
                    // Player Big Image 2
                    array(
                        'key' => 'field_player_big_image_2',
                        'label' => 'Player Big Image 2',
                        'name' => 'player_big_image_2',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'required' => 0,
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
    }
}

/*--------------------------------------------------------------
	>>> Function for add players data
	----------------------------------------------------------------*/
// Populate Default Data only once
function hwc_populate_players_data()
{
    // Define player data array within the function
    $players_data = array(
        array(
            'background_image' => 'playerbg.jpg',
            'featured_image' => 'player-1.jpg',
            'title' => 'Zac Jones',
            'number' => 1,
            'first_name' => 'Zac',
            'last_name' => 'Jones',
            'role' => 'Goalkeeper',
            'right_card_image' => 'right_card_image.jpg',
            'right_card_title' => 'Player 1 Card Title',
            'right_card_title_2' => 'Player 1 Card Title 2',
            'button' => array('url' => 'https://example.com/', 'title' => 'View More'),
            'player_stats_title' => '2024/25 Stats',
            'stats' => array(
                array('stat_title_1' => '5', 'stat_title_2' => 'Appearances'),
                array('stat_title_1' => '5', 'stat_title_2' => 'Starts'),
                array('stat_title_1' => '450\'', 'stat_title_2' => 'Mins'),
                array('stat_title_1' => '60%', 'stat_title_2' => 'Win %'),
                array('stat_title_1' => '2', 'stat_title_2' => 'Goals'),
                array('stat_title_1' => '1', 'stat_title_2' => 'Bookings'),
                array('stat_title_1' => '0', 'stat_title_2' => 'Sent Off')
            ),
            'biography_title' => 'Biography',
            'description' => 'Zac, who hails from Wellington in New Zealand, arrived at the club in January 2022 after playing for the likes of Team Wellington, Wellington Olympic, Wellington Phoenix and Miramar Rangers. The 23-year-old goalkeeper, who has represented his country at under-17 and under-20 level, achieved success in his native country, winning the New Zealand Football Championship in March 2021 and first instalment of the newly-created New Zealand National League in December 2021. The highlight of his time with the Bluebirds to date came in July 2023, when his penalty shoot-out save clinched victory over KF Shkëndija in the UEFA Europa Conference first qualifying round at the Cardiff City Stadium.',
            'big_image_1' => 'player1_image1.jpg',
            'big_image_2' => 'player1_image2.jpg',
        )
        // Add more players as needed
    );

    // Fetch all team IDs dynamically
    $hwc_teams_query = new WP_Query(array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'fields' => 'ids' // Only fetch IDs
    ));

    $hwc_teams = $hwc_teams_query->posts;

    // Loop through each player in the players_data array
    foreach ($players_data as $player_data) {

        // Check if the player already exists by title or any unique identifier
        $existing_player = get_posts(array(
            'post_type' => 'player',
            'title' => $player_data['title'],
            'posts_per_page' => 1,
            'fields' => 'ids' // Only fetch IDs
        ));

        // If a player with the same title already exists, skip this iteration
        if (!empty($existing_player)) {
            error_log('Player with title ' . $player_data['title'] . ' already exists, skipping...');
            continue;
        }

        // Insert the player post
        $player_id = wp_insert_post(array(
            'post_type' => 'player',
            'post_title' => $player_data['title'],
            'post_content' => $player_data['description'],
            'post_status' => 'publish',
        ));

        if (is_wp_error($player_id)) {
            error_log('Failed to insert player post: ' . $player_id->get_error_message());
            continue; // Skip to the next player if this one fails
        }

        // Assign a random team to the player
        if (!empty($hwc_teams)) {
            $random_team_id = $hwc_teams[array_rand($hwc_teams)];
            update_field('team_selection', array($random_team_id), $player_id);
        }

        // Set ACF fields
        update_field(
            'player_number',
            $player_data['number'],
            $player_id
        );
        update_field('player_first_name', $player_data['first_name'], $player_id);
        update_field('player_last_name', $player_data['last_name'], $player_id);
        update_field('player_role', $player_data['role'], $player_id);
        update_field('player_biography_title', $player_data['biography_title'], $player_id);

        // Set player stats
        update_field(
            'player_stats',
            $player_data['stats'],
            $player_id
        );

        // Set player background image
        $bg_image_id = hwc_upload_image_from_theme($player_data['background_image']);
        if (!is_wp_error($bg_image_id)) {
            update_field('player_background_image', $bg_image_id, $player_id);
        } else {
            error_log('Failed to upload background image: ' . $bg_image_id->get_error_message());
        }

        // Set big images
        $big_image_1_id = hwc_upload_image_from_theme($player_data['big_image_1']);
        $big_image_2_id = hwc_upload_image_from_theme($player_data['big_image_2']);

        if (!is_wp_error($big_image_1_id)) {
            update_field('player_big_image_1', $big_image_1_id, $player_id);
        } else {
            error_log('Failed to upload big image 1: ' . $big_image_1_id->get_error_message());
        }

        if (!is_wp_error($big_image_2_id)) {
            update_field('player_big_image_2', $big_image_2_id, $player_id);
        } else {
            error_log('Failed to upload big image 2: ' . $big_image_2_id->get_error_message());
        }

        // Set right card content
        $right_card_image_id = hwc_upload_image_from_theme($player_data['right_card_image']);
        if (!is_wp_error($right_card_image_id)) {
            update_field('player_right_card_image', $right_card_image_id, $player_id);
        } else {
            error_log('Failed to upload right card image: ' . $right_card_image_id->get_error_message());
        }

        update_field('player_right_card_title', $player_data['right_card_title'], $player_id);
        update_field('player_right_card_title_2', $player_data['right_card_title_2'], $player_id);
        update_field('player_right_card_button', array(
            'url' => $player_data['button']['url'],
            'title' => $player_data['button']['title'],
        ), $player_id);

        // Set featured image
        $image_path = get_template_directory() . '/hwc-images/' . $player_data['featured_image'];
        $image_id = hwc_set_featured_image($image_path, $player_id);
        if ($image_id) {
            set_post_thumbnail($player_id, $image_id);
        } else {
            error_log('Failed to set featured image for player ' . $player_data['title']);
        }
    }
}
