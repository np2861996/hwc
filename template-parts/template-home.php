<?php
/* Template Name: Home */
get_header();
?>

<div class="feature-block-wrapper">
	<div class="feature-block">
		<!--------------------------------------------------------------
		>>> Sec1 - Left Post section
		---------------------------------------------------------------->
		<?php
		//display the latest post
		echo do_shortcode('[display_home_sec1_latest_post]');
		?>
		<aside>
			<!--------------------------------------------------------------
			>>> Sec1 - Right Match Fixtures section
			---------------------------------------------------------------->
			<?php
			//display the latest Fixture
			echo do_shortcode('[home_sec1_latest_fixture]');
			?>

			<?php
			//display the latest result
			echo do_shortcode('[home_sec1_latest_result]');
			?>
		</aside>
	</div>
</div>

<!--------------------------------------------------------------
>>> Sec2 - Latest News section
---------------------------------------------------------------->
<?php
// display the latest post News
echo do_shortcode('[home_latest_news_posts_shortcode]');
?>

<!--------------------------------------------------------------
>>> Sec3 - Upcoming Fixtures
---------------------------------------------------------------->
<?php
// display the latest post News
echo do_shortcode('[home_display_upcoming_fixtures]');
?>

<!--------------------------------------------------------------
>>> Sec4 - Home Cards
---------------------------------------------------------------->
<?php
// display the latest post News
echo do_shortcode('[hwc_home_cards_shortcode]');
?>

<!--------------------------------------------------------------
>>> Sec5 - Club News
---------------------------------------------------------------->
<?php
// display the latest post News
echo do_shortcode('[hwc_latest_the_bluebirds_nest_posts_shortcode]');
?>

<!--------------------------------------------------------------
>>> Sec6 - Blue Big Box
---------------------------------------------------------------->
<?php
// display the Blue Big Box
echo do_shortcode('[shortcode_hwc_home_blue_big_box]');
?>
<div id="block-6791-6" class="block block-6791-6 block-row-team after-banner before-newsletter">

	<div class="container">
		<div class="section-header">
			<h2 class="section-heading section-heading-display"><?php echo get_the_title(get_field('hwc_home_select_team')); ?></h2>
		</div>
	</div>

	<div class="md:container">

		<div class="grid-container">

			<!--------------------------------------------------------------
			>>> Sec6 - Team Posts
			---------------------------------------------------------------->
			<?php
			$dis_hwc_home_select_team = get_the_title(get_field('hwc_home_select_team'));
			// display the Team Posts
			echo do_shortcode('[hwc_team_post_shortcode team="' . $dis_hwc_home_select_team . '"]');
			?>
			<div class="team-row-match">
				<?php
				$dis_hwc_home_select_team_id = get_field('hwc_home_select_team');
				// display the Team result
				echo do_shortcode('[hwc_home_result_by_team_result team="' . $dis_hwc_home_select_team_id . '"]');
				?>
				<a class="btn btn-lg btn-primary" href="<?php echo site_url('fixtures'); ?>">All Fixtures</a>
			</div>
		</div>

	</div>
</div>

<!--------------------------------------------------------------
	>>> Sec7 - NewsLatter
---------------------------------------------------------------->
<?php
// display the Team Posts
echo do_shortcode('[hwc_home_newsletter_shortcode]');
?>

<!--------------------------------------------------------------
	>>> Footer
---------------------------------------------------------------->
<?php get_footer(); ?>