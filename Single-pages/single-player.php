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
$player_role = get_field('player_role', $player_id);
$player_biography_title = get_field('player_biography_title', $player_id);
$player_stats_title = get_field('player_stats_title', $player_id);
$player_stats = get_field('player_stats', $player_id);
$player_background_image = get_field('player_background_image', $player_id);
$player_big_image_1 = get_field('player_big_image_1', $player_id);
$player_big_image_2 = get_field('player_big_image_2', $player_id);
$player_right_card_image = get_field('player_right_card_image', $player_id);
$player_right_card_title = get_field('player_right_card_title', $player_id);
$player_right_card_title_2 = get_field('player_right_card_title_2', $player_id);
$player_right_card_button = get_field('player_right_card_button', $player_id);
$player_description = get_the_content($player_id);

/*--------------------------------------------------------------
	>>> Header Section Code : START
	----------------------------------------------------------------*/
$Dis_player_background_image = !empty($player_background_image) ?
	'<div class="player-cover cover-photo">
		<div class="image-container overlay-duotone">
				<img width="1280" height="720" src="' . $player_background_image . '?class=16x9lg" class="attachment-16x9-lg size-16x9-lg" alt="" decoding="async" srcset="' . $player_background_image . '?class=16x9md 960w" sizes="(max-width: 1280px) 100vw, 1280px">
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

$Dis_player_right_card_image = !empty($player_right_card_image) ?
	'<div class="card-image">
		<a target="_blank" href="' . $player_right_card_button['url'] . '" aria-label="' . $player_right_card_button['title'] . '">
			<div class="image-container ratio-16x9">
				<img width="300" height="300" src="' . $player_right_card_image . '?class=thumbnail" class="logo wp-post-image" alt="" decoding="async" srcset="' . $player_right_card_image . '?class=thumbnail 300w, ' . $player_right_card_image . '?class=1x1xs 150w, ' . $player_right_card_image . ' 400w" sizes="(max-width: 300px) 100vw, 300px">
			</div>
		</a>
	</div>' : '';

$Dis_player_right_card = !empty($player_right_card_image) || !empty($player_right_card_button['url']) || !empty($player_right_card_button['title'])
	|| !empty($player_right_card_title) || !empty($player_right_card_title_2) || !empty($Dis_player_right_card_image) ?
	'<div class="card card-partner card-w-link">
		' . $Dis_player_right_card_image . '
		<div class="card-content">
			<span class="card-title">' . $player_right_card_title . '</span>
			<p class="card-summary">' . $player_right_card_title_2 . '</p>
			<span class="btn btn-secondary">
				<a href="' . $player_right_card_button['url'] . '" title="' . $player_right_card_button['title'] . '">
					' . $player_right_card_button['title'] . '
				</a>
			</span>
		</div>
	</div>' : '';

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
		$Dis_state_data .= '<span class="stat-value">' . the_sub_field('stat_title_1') . '</span>
							<span class="stat-label">' . the_sub_field('stat_title_2') . '</span>';
	}
}

$Dis_Stats_sec = !empty($Dis_state_data) ?
	'<div class="container">
		<h2 class="legend"><span>' . $player_stats_title . '</span></h2>
		<div class="block-stats">
			' . $Dis_state_data . '
		</div> 
	</div>' : '';
/*--------------------------------------------------------------
	>>> Stats Section Code : END
	----------------------------------------------------------------*/

?>
<div class="post-7189 player type-player status-publish has-post-thumbnail hentry team-first-team">
	<!--*--------------------------------------------------------------
	>>> Header Section Code : END
	----------------------------------------------------------------*!-->
	<?php echo $Dis_Player_Header; ?>


	<div class="block">
		<?php echo $Dis_Stats_sec; ?>
		<div class="row">
			<div class="max-width-content">
				<div class="prose">
					<?php if (!empty($player_biography_title)): ?>
						<h2 class="section-heading"><?php echo esc_html($player_biography_title); ?></h2>
					<?php endif; ?>

					<?php if (!empty($player_description)): ?>
						<p><?php echo esc_html($player_description); ?></p>
					<?php endif; ?>

					<div class="nwVKo">
						<div class="loJjTe"></div>
					</div>
				</div>
			</div>
		</div>


		<div class="player-gallery">
			<div class="post-gallery">

				<?php if ($player_big_image_1) : ?>
					<div class="post-gallery-item">
						<figure class="image-container lazy-load-container ratio-3x2">
							<a href="<?php echo esc_url($player_big_image_1); ?>" data-fslightbox="post-gallery" data-type="image">
								<img src="<?php echo esc_url($player_big_image_1); ?>" class="attachment-3x2-md size-3x2-md" alt="Player Big Image 1" loading="lazy">
							</a>
						</figure>
					</div>
				<?php endif; ?>

				<?php if ($player_big_image_2) : ?>
					<div class="post-gallery-item">
						<figure class="image-container lazy-load-container ratio-3x2">
							<a href="<?php echo esc_url($player_big_image_2); ?>" data-fslightbox="post-gallery" data-type="image">
								<img src="<?php echo esc_url($player_big_image_2); ?>" class="attachment-3x2-md size-3x2-md" alt="Player Big Image 2" loading="lazy">
							</a>
						</figure>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="container">
			<div class="section-header">
				<h2 class="section-heading section-heading-display">Player News</h2>
			</div>
		</div>

		<div class="grid-container grid-columns-sm-2-lg-4 grid-columns-auto-scroll">

			<div class="card card-post card-w-link">


				<div class="card-image">
					<a href="https://haverfordwestcountyafc.com/2024/02/zac-jones-agrees-new-one-year-deal-with-the-bluebirds/" aria-label="Zac Jones agrees new one-year deal with the Bluebirds">
						<div class="image-container ratio-16x9">
							<img width="480" height="270" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=16x9sm" class="fill" alt="Read the full article - Zac Jones agrees new one-year deal with the Bluebirds" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=16x9sm 480w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=16x9md 960w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png?class=16x9lg 1280w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182505/zaccontractFI.png 1920w" sizes="(max-width: 480px) 100vw, 480px">
						</div>

					</a>
				</div>


				<div class="card-content">


					<span class="card-title">Zac Jones agrees new one-year deal with the Bluebirds</span>

					<p class="card-summary">Super Zac extends his stay at the Ogi Bridge Meadow!</p>
					<div class="card-meta">
						<span class="cat">Latest Club News</span><span class="timestamp">7 months ago</span>
					</div>


				</div>


			</div>

			<div class="card card-post card-w-link">


				<div class="card-image">
					<a href="https://haverfordwestcountyafc.com/2023/05/zac-jones-agrees-new-one-year-deal-with-haverfordwest-county/" aria-label="Zac Jones agrees new one-year deal with Haverfordwest County">
						<div class="image-container ratio-16x9">
							<img width="480" height="270" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/2023-05-13-Newtown-AFC-vs-Haverfordwest-County-AFC-247.jpg?class=16x9sm" class="fill" alt="Read the full article - Zac Jones agrees new one-year deal with Haverfordwest County" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/2023-05-13-Newtown-AFC-vs-Haverfordwest-County-AFC-247.jpg?class=16x9sm 480w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/2023-05-13-Newtown-AFC-vs-Haverfordwest-County-AFC-247.jpg?class=16x9md 960w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/2023-05-13-Newtown-AFC-vs-Haverfordwest-County-AFC-247.jpg?class=16x9lg 1280w" sizes="(max-width: 480px) 100vw, 480px">
						</div>

					</a>
				</div>


				<div class="card-content">


					<span class="card-title">Zac Jones agrees new one-year deal with Haverfordwest County</span>

					<p class="card-summary">Super Zac signs on for another year with the Bluebirds!</p>
					<div class="card-meta">
						<span class="cat">Latest Club News</span><span class="timestamp">1 year ago</span>
					</div>


				</div>


			</div>

			<div class="card card-post card-w-link">


				<div class="card-image">
					<a href="https://haverfordwestcountyafc.com/2023/05/jones-the-hero-as-bluebirds-reach-maiden-european-play-off-final/" aria-label="Keeper Jones the hero as Bluebirds reach maiden European play-off final">
						<div class="image-container ratio-16x9">
							<img width="480" height="270" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=16x9sm" class="fill" alt="Read the full article - Keeper Jones the hero as Bluebirds reach maiden European play-off final" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=16x9sm 480w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=16x9md 960w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png?class=16x9lg 1280w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/05/MetAwayReportFI.png 1920w" sizes="(max-width: 480px) 100vw, 480px">
						</div>

					</a>
				</div>


				<div class="card-content">


					<span class="card-title">Keeper Jones the hero as Bluebirds reach maiden European play-off final</span>

					<p class="card-summary">Our report of Haverfordwest County's 4-3 penalty shoot-out victory over Cardiff Metropolitan in the JD Cymru Premier European play-off semi-finals.</p>
					<div class="card-meta">
						<span class="cat">Match Reports</span><span class="timestamp">1 year ago</span>
					</div>


				</div>


			</div>

			<div class="card card-post card-w-link">


				<div class="card-image">
					<a href="https://haverfordwestcountyafc.com/2022/09/thebluebirdsnest-episode-6-zac-jones/" aria-label="#TheBluebirdsNest Episode 6 – Zac Jones">
						<div class="image-container ratio-16x9">
							<img src="https://i.ytimg.com/vi/IiMkZbA5tgk/maxresdefault.jpg" alt="Read the full article - #TheBluebirdsNest Episode 6 – Zac Jones" width="1280" height="720" class="fill">
						</div>

					</a>
				</div>


				<div class="card-content">


					<span class="card-title">#TheBluebirdsNest Episode 6 – Zac Jones</span>

					<p class="card-summary">Watch Episode 6 of #TheBluebirdsNest, our vodcast and podcast series, with goalkeeper Zac Jones.

					</p>
					<div class="card-meta">
						<span class="cat">#TheBluebirdsNest</span><span class="timestamp">2 years ago</span>
					</div>


				</div>


			</div>

		</div>
	</div>

</div>

<?php get_footer(); ?>