<?php

/**
 * Code For Display Staff info.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

get_header();

/*--------------------------------------------------------------
	>>> Staff Post Info
----------------------------------------------------------------*/
if (has_post_thumbnail()) {
    // Get the featured image URL
    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
// Fetch staff details
$staff_id = get_the_ID();

/*--------------------------------------------------------------
	>>> ACF fields
----------------------------------------------------------------*/
$team_selection = get_field('team_selection', $staff_id);
$staff_number = get_field('staff_number', $staff_id);
$staff_first_name = get_field('staff_first_name', $staff_id);
$staff_last_name = get_field('staff_last_name', $staff_id);
$staff_role = get_field('staff_role', $staff_id);
$staff_biography_title = get_field('staff_biography_title', $staff_id);
$staff_stats_title = get_field('staff_stats_title', $staff_id);
$staff_stats = get_field('staff_stats', $staff_id);
$staff_background_image_id = get_field('staff_background_image', $staff_id);
$staff_big_image_1_id = get_field('staff_big_image_1', $staff_id);
$staff_big_image_2_id = get_field('staff_big_image_2', $staff_id);
$staff_right_card_image_id = get_field('staff_right_card_image', $staff_id);
$staff_right_card_title = get_field('staff_right_card_title', $staff_id);
$staff_right_card_title_2 = get_field('staff_right_card_title_2', $staff_id);
$staff_right_card_button = get_field('staff_right_card_button', $staff_id);
$staff_description = get_the_content($staff_id);

/*--------------------------------------------------------------
	>>> Header Section Code : START
----------------------------------------------------------------*/
if ($staff_background_image_id) {
    $staff_background_image_url = wp_get_attachment_image_url($staff_background_image_id, 'full'); // 'medium' can be replaced with any size you need
} else {
    $staff_background_image_url = '';
}
$Dis_staff_background_image = !empty($staff_background_image_url) ?
    '<div class="player-cover cover-photo">
		<div class="image-container overlay-duotone">
				<img width="1280" height="720" src="' . $staff_background_image_url . '?class=16x9lg" class="attachment-16x9-lg size-16x9-lg" alt="" decoding="async" srcset="' . $staff_background_image_url . '?class=16x9md 960w" sizes="(max-width: 1280px) 100vw, 1280px">
		</div>
	</div>' : '';

$Dis_thumbnail = !empty($thumbnail_url) ?
    '<div class="player-profile-image">
		<div class="image-container ratio-4x5">
				<img width="768" height="960" src="' . $thumbnail_url . '" class="fill wp-post-image" alt="Profile photo of staff" decoding="async" srcset="' . $thumbnail_url . '?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
		</div>
	</div>' : '';

$Dis_staff_details = !empty($staff_number) || !empty($staff_first_name) || !empty($staff_last_name) || !empty($staff_role) ?
    '<div class="player-details">
		<span class="player-number" aria-hidden="true">' . $staff_number . '</span>
		<h1 class="player-name">
			<span class="player-name-first">' . $staff_first_name . '</span>
			<span class="player-name-last">' . $staff_last_name . '</span>
		</h1>
		<ul class="player-meta-data separate-items">
			<li>' . $staff_role . '</li>
		</ul>
	</div>' : '';

if ($staff_right_card_image_id) {
    $staff_right_card_image_url = wp_get_attachment_image_url($staff_right_card_image_id, 'full'); // 'medium' can be replaced with any size you need
} else {
    $staff_right_card_image_url = '';
}

$Dis_staff_right_card_image = !empty($staff_right_card_image_url) ?
    '<div class="card-image">
		<a target="_blank" href="' . $staff_right_card_button['url'] . '" aria-label="' . $staff_right_card_button['title'] . '">
			<div class="image-container ratio-16x9">
				<img width="300" height="300" src="' . $staff_right_card_image_url . '?class=thumbnail" class="logo wp-post-image" alt="" decoding="async" srcset="' . $staff_right_card_image_url . '?class=thumbnail 300w, ' . $staff_right_card_image_url . '?class=1x1xs 150w, ' . $staff_right_card_image_url . ' 400w" sizes="(max-width: 300px) 100vw, 300px">
			</div>
		</a>
	</div>' : '';

$Dis_staff_right_card = (!empty($staff_right_card_image) || (is_array($staff_right_card_button) && !empty($staff_right_card_button['url']) && !empty($staff_right_card_button['title'])) ||
    !empty($staff_right_card_title) || !empty($staff_right_card_title_2) || !empty($Dis_staff_right_card_image)) ?
    '<div class="card card-partner card-w-link">
        ' . $Dis_staff_right_card_image . '
        <div class="card-content">
            <span class="card-title">' . $staff_right_card_title . '</span>
            <p class="card-summary">' . $staff_right_card_title_2 . '</p>
            <span class="btn btn-secondary">
                <a href="' . (!empty($staff_right_card_button['url']) ? $staff_right_card_button['url'] : '#') . '" title="' . (!empty($staff_right_card_button['title']) ? $staff_right_card_button['title'] : 'Button') . '">
                    ' . (!empty($staff_right_card_button['title']) ? $staff_right_card_button['title'] : 'Learn More') . '
                </a>
            </span>
        </div>
    </div>'
    : '';

$Dis_Staff_Header = !empty($Dis_staff_background_image) || !empty($Dis_thumbnail) || !empty($Dis_staff_details) || !empty($Dis_staff_right_card) ?
    '<header class="player-header player-header-lg">
		' . $Dis_staff_background_image . '
		<div class="container">
			<div class="grid-container">
				' . $Dis_thumbnail . $Dis_staff_details . $Dis_staff_right_card . '
			</div>
		</div>
	</header>' : '';
/*--------------------------------------------------------------
	>>> Header Section Code : END
----------------------------------------------------------------*/

/*--------------------------------------------------------------
	>>> Stats Section Code : START
----------------------------------------------------------------*/
$Dis_state_data = '';
if (have_rows('staff_stats', $staff_id)) {
    while (have_rows('staff_stats', $staff_id)) {
        the_row();
        $stat_title_1 = get_sub_field('stat_title_1');
        $stat_title_2 = get_sub_field('stat_title_2');

        if (!empty($stat_title_1) && !empty($stat_title_1)) {
            $Dis_state_data .= '<div class="stat"><span class="stat-value">' . $stat_title_1 . '</span>
                            <span class="stat-label">' . $stat_title_2 . '</span></div>';
        } else {
            $Dis_state_data .= '';
        }
    }
}

$Dis_Stats_sec = !empty($Dis_state_data) ?
    '<div class="container">
        <h2 class="legend">
			<span>
				' . $staff_stats_title . '
			</span>
		</h2>
        <div class="block-stats">
            ' . $Dis_state_data . '
        </div> 
    </div>' : '';
/*--------------------------------------------------------------
	>>> Stats Section Code : END
----------------------------------------------------------------*/

/*--------------------------------------------------------------
	>>> Biography Section Code : START
----------------------------------------------------------------*/
$Dis_Biography_sec = !empty($staff_description) ?
    '<div class="row">
		<div class="max-width-content">
			<div class="prose">
					<h2 class="section-heading">
						' . $staff_biography_title . '
					</h2>
					' . wp_kses_post($staff_description) . '
				<div class="nwVKo">
					<div class="loJjTe"></div>
				</div>
			</div>
		</div>
	</div>' : '';
/*--------------------------------------------------------------
	>>> Biography Section Code : END
----------------------------------------------------------------*/

/*--------------------------------------------------------------
	>>> Big Images Section Code : START
----------------------------------------------------------------*/

if ($staff_big_image_1_id) {
    $staff_big_image_1_url = wp_get_attachment_image_url($staff_big_image_1_id, 'full'); // 'medium' can be replaced with any size you need
} else {
    $staff_big_image_1_url = '';
}

$Dis_staff_big_image_1 = !empty($staff_big_image_1_url) ?
    '<div class="post-gallery-item">
		<figure class="image-container lazy-load-container ratio-3x2">
			<a href="' . $staff_big_image_1_url . '" data-fslightbox="post-gallery" data-type="image">
				<img src="' . $staff_big_image_1_url . '" class="attachment-3x2-md size-3x2-md" alt="Staff Big Image 1" loading="lazy">
			</a>
		</figure>
	</div>' : '';

if ($staff_big_image_2_id) {
    $staff_big_image_2_url = wp_get_attachment_image_url($staff_big_image_2_id, 'full'); // 'medium' can be replaced with any size you need
} else {
    $staff_big_image_2_url = '';
}

$Dis_staff_big_image_2 = !empty($staff_big_image_2_url) ?
    '<div class="post-gallery-item">
		<figure class="image-container lazy-load-container ratio-3x2">
			<a href="' . $staff_big_image_2_url . '" data-fslightbox="post-gallery" data-type="image">
				<img src="' . $staff_big_image_2_url . '" class="attachment-3x2-md size-3x2-md" alt="Staff Big Image 2" loading="lazy">
			</a>
		</figure>
	</div>' : '';

$Dis_Big_Images_sec = !empty($Dis_staff_big_image_1) || !empty($Dis_staff_big_image_2) ?
    '<div class="player-gallery">
		<div class="post-gallery">
			' . $Dis_staff_big_image_1 . $Dis_staff_big_image_2 . '
			
		</div>
	</div>' : '';
/*--------------------------------------------------------------
	>>> Big Images Section Code : END
----------------------------------------------------------------*/

?>
<div class="post-<?php echo $staff_id; ?> staff type-staff status-publish has-post-thumbnail hentry team-first-team">
    <!--*--------------------------------------------------------------
	>>> Header Section Code : END
	----------------------------------------------------------------*!-->
    <?php echo $Dis_Staff_Header; ?>

    <div class="block">
        <?php echo $Dis_Stats_sec; ?>
        <?php echo $Dis_Biography_sec; ?>
        <?php echo $Dis_Big_Images_sec; ?>
    </div>
    <?php
    // Get the staff's title
    $staff_title = get_the_title($staff_id);

    // Retrieve the tag by name to get its slug
    $tag = get_term_by('name', $staff_title, 'post_tag');
    if ($tag) {
    ?>
        <div class="row">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-heading section-heading-display">Staff News</h2>
                </div>
            </div>



            <?php
            // Arguments for WP_Query to get posts with the tag slug
            $args = array(
                'post_type' => 'post', // Change this if you're querying a custom post type
                'posts_per_page' => 3, // Adjust the number of posts as needed
                'tag_slug__in' => array($tag->slug), // Use the slug of the tag
            );

            $query = new WP_Query($args);

            // Check if we have posts
            if ($query->have_posts()) : ?>

                <div class="grid-container grid-columns-sm-2-lg-4 grid-columns-auto-scroll">

                    <?php while ($query->have_posts()) : $query->the_post(); ?>

                        <div class="card card-post card-w-link">

                            <div class="card-image">
                                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                    <div class="image-container ratio-16x9">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'fill', 'loading' => 'lazy', 'decoding' => 'async']); ?>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>

                            <div class="card-content">
                                <span class="card-title"><?php the_title(); ?></span>
                                <p class="card-summary"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <div class="card-meta">
                                    <span class="cat"><?php the_category(', '); ?></span>
                                    <span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                </div>
                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php
            else :
                // No posts found
                echo '<div class="grid-container grid-columns-sm-2-lg-4 grid-columns-auto-scroll"><p>No posts found.</p></div>';
            endif;

            // Reset Post Data
            wp_reset_postdata();

            ?>

        </div>
    <?php
    } else {
        // No tag found with the staff's title
        echo '';
    }
    ?>

</div>



<?php get_footer(); ?>