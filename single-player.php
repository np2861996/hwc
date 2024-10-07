<?php

/**
 * Code For Display Players info.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

get_header();

/*--------------------------------------------------------------
	>>> Players Post Info
----------------------------------------------------------------*/
if (has_post_thumbnail()) {
	// Get the featured image URL
	$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
} else {
	$thumbnail_url = get_template_directory_uri() . '/hwc-images/default-player.jpg';
}

// Fetch player details
$player_id = get_the_ID();

/*--------------------------------------------------------------
	>>> ACF fields
----------------------------------------------------------------*/
$team_selection = get_field('team_selection', $player_id);
$player_number = get_field('player_number', $player_id);
$player_first_name = get_field('player_first_name', $player_id);
$player_last_name = get_field('player_last_name', $player_id);
$player_biography_title = get_field('player_biography_title', $player_id);
$player_stats_title = get_field('player_stats_title', $player_id);
$player_stats = get_field('player_stats', $player_id);
$player_background_image_id = get_field('player_background_image', $player_id);
$player_big_image_1_id = get_field('player_big_image_1', $player_id);
$player_big_image_2_id = get_field('player_big_image_2', $player_id);
$player_right_card_image_id = get_field('player_right_card_image', $player_id);
$player_right_card_title = get_field('player_right_card_title', $player_id);
$player_right_card_title_2 = get_field('player_right_card_title_2', $player_id);
$player_right_card_button = get_field('player_right_card_button', $player_id);
$player_description = get_the_content($player_id);
// Get the terms for the current post for the 'player_role' taxonomy
$terms = get_the_terms(get_the_ID(), 'player_role');

// Check if terms exist and assign the first term to $player_role
if (! empty($terms) && ! is_wp_error($terms)) {
	$player_role = $terms[0]->name; // Get the name of the first term
} else {
	$player_role = ''; // Default if no terms are found
}
/*--------------------------------------------------------------
	>>> Header Section Code : START
----------------------------------------------------------------*/
if ($player_background_image_id) {
	$player_background_image_url = wp_get_attachment_image_url($player_background_image_id, 'full'); // 'medium' can be replaced with any size you need
} else {
	$player_background_image_url = '';
}
$Dis_player_background_image = !empty($player_background_image_url) ?
	'<div class="player-cover cover-photo">
		<div class="image-container overlay-duotone">
				<img width="1280" height="720" src="' . $player_background_image_url . '?class=16x9lg" class="attachment-16x9-lg size-16x9-lg" alt="" decoding="async" srcset="' . $player_background_image_url . '?class=16x9md 960w" sizes="(max-width: 1280px) 100vw, 1280px">
		</div>
	</div>' : '';

$Dis_thumbnail = !empty($thumbnail_url) ?
	'<div class="player-profile-image">
		<div class="image-container ratio-4x5">
				<img width="768" height="960" src="' . $thumbnail_url . '" class="fill wp-post-image" alt="Profile photo of player" decoding="async" srcset="' . $thumbnail_url . '?class=4x5sm 480w" sizes="(max-width: 768px) 100vw, 768px">
		</div>
	</div>' : '';

$Dis_player_details = !empty($player_number) || !empty($player_first_name) || !empty($player_last_name) || !empty($player_role) ?
	'<div class="player-details">
		<span class="player-number" aria-hidden="true">' . $player_number . '</span>
		<h1 class="player-name">
			<span class="player-name-first">' . $player_first_name . '</span>
			<span class="player-name-last">' . $player_last_name . '</span>
		</h1>
		<ul class="player-meta-data separate-items">
			<li>' . $player_role . '</li>
		</ul>
	</div>' : '';

if ($player_right_card_image_id) {
	$player_right_card_image_url = wp_get_attachment_image_url($player_right_card_image_id, 'full'); // 'medium' can be replaced with any size you need
} else {
	$player_right_card_image_url = '';
}

$Dis_player_right_card_image = !empty($player_right_card_image_url) ?
	'<div class="card-image">' .
	// Check if URL is available
	(!empty($player_right_card_button['url']) ?
		'<a target="_blank" href="' . esc_url($player_right_card_button['url']) . '" aria-label="' . esc_attr($player_right_card_button['title']) . '">'
		: ''
	) .
	'<div class="image-container ratio-16x9">
            <img width="300" height="300" src="' . esc_url($player_right_card_image_url) . '?class=thumbnail" class="logo wp-post-image" alt="" decoding="async" srcset="' . esc_url($player_right_card_image_url) . '?class=thumbnail 300w, ' . esc_url($player_right_card_image_url) . '?class=1x1xs 150w, ' . esc_url($player_right_card_image_url) . ' 400w" sizes="(max-width: 300px) 100vw, 300px">
        </div>' .
	// Close anchor tag if URL is available
	(!empty($player_right_card_button['url']) ? '</a>' : '') .
	'</div>'
	: '';

$Dis_player_right_card = (!empty($player_right_card_image) || (is_array($player_right_card_button) && !empty($player_right_card_button['url']) && !empty($player_right_card_button['title'])) ||
	!empty($player_right_card_title) || !empty($player_right_card_title_2) || !empty($Dis_player_right_card_image)) ?
	'<div class="card card-partner card-w-link">
        ' . $Dis_player_right_card_image . '
        <div class="card-content">
            <span class="card-title">' . $player_right_card_title . '</span>
            <p class="card-summary">' . $player_right_card_title_2 . '</p>
            <span class="btn btn-secondary">
                <a href="' . (!empty($player_right_card_button['url']) ? $player_right_card_button['url'] : '#') . '" title="' . (!empty($player_right_card_button['title']) ? $player_right_card_button['title'] : 'Button') . '">
                    ' . (!empty($player_right_card_button['title']) ? $player_right_card_button['title'] : 'Learn More') . '
                </a>
            </span>
        </div>
    </div>'
	: '';

$Dis_Player_Header = !empty($Dis_player_background_image) || !empty($Dis_thumbnail) || !empty($Dis_player_details) || !empty($Dis_player_right_card) ?
	'<header class="player-header player-header-lg">
		' . $Dis_player_background_image . '
		<div class="container">
			<div class="grid-container">
				' . $Dis_thumbnail . $Dis_player_details . $Dis_player_right_card . '
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
if (have_rows('player_stats', $player_id)) {
	while (have_rows('player_stats', $player_id)) {
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
				' . $player_stats_title . '
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
$Dis_Biography_sec = !empty($player_description) ?
	'<div class="row">
		<div class="max-width-content">
			<div class="prose">
					<h2 class="section-heading">
						' . $player_biography_title . '
					</h2>
					' . wp_kses_post($player_description) . '
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

if ($player_big_image_1_id) {
	$player_big_image_1_url = wp_get_attachment_image_url($player_big_image_1_id, 'full'); // 'medium' can be replaced with any size you need
} else {
	$player_big_image_1_url = '';
}

$Dis_player_big_image_1 = !empty($player_big_image_1_url) ?
	'<div class="post-gallery-item">
		<figure class="image-container lazy-load-container ratio-3x2">
			<a href="' . $player_big_image_1_url . '" data-fslightbox="post-gallery" data-type="image">
				<img src="' . $player_big_image_1_url . '" class="attachment-3x2-md size-3x2-md" alt="Player Big Image 1" loading="lazy">
			</a>
		</figure>
	</div>' : '';

if ($player_big_image_2_id) {
	$player_big_image_2_url = wp_get_attachment_image_url($player_big_image_2_id, 'full'); // 'medium' can be replaced with any size you need
} else {
	$player_big_image_2_url = '';
}

$Dis_player_big_image_2 = !empty($player_big_image_2_url) ?
	'<div class="post-gallery-item">
		<figure class="image-container lazy-load-container ratio-3x2">
			<a href="' . $player_big_image_2_url . '" data-fslightbox="post-gallery" data-type="image">
				<img src="' . $player_big_image_2_url . '" class="attachment-3x2-md size-3x2-md" alt="Player Big Image 2" loading="lazy">
			</a>
		</figure>
	</div>' : '';

$Dis_Big_Images_sec = !empty($Dis_player_big_image_1) || !empty($Dis_player_big_image_2) ?
	'<div class="player-gallery">
		<div class="post-gallery">
			' . $Dis_player_big_image_1 . $Dis_player_big_image_2 . '
			
		</div>
	</div>' : '';
/*--------------------------------------------------------------
	>>> Big Images Section Code : END
----------------------------------------------------------------*/

?>
<div class="post-<?php echo $player_id; ?> player type-player status-publish has-post-thumbnail hentry team-first-team">
	<!--*--------------------------------------------------------------
	>>> Header Section Code : END
	----------------------------------------------------------------*!-->
	<?php echo $Dis_Player_Header; ?>

	<div class="block">
		<?php echo $Dis_Stats_sec; ?>
		<?php echo $Dis_Biography_sec; ?>
		<?php echo $Dis_Big_Images_sec; ?>
	</div>
	<?php
	// Get the player's title
	$player_title = get_the_title($player_id);

	// Retrieve the tag by name to get its slug
	$tag = get_term_by('name', $player_title, 'post_tag');
	if ($tag) {
	?>
		<div class="row">
			<div class="container">
				<div class="section-header">
					<h2 class="section-heading section-heading-display">Player News</h2>
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
		// No tag found with the player's title
		echo '';
	}
	?>

</div>



<?php get_footer(); ?>