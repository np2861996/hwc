<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hwc
 */

get_header();

$formatted_date = get_the_date('j F, Y');
$post_url = get_permalink();
$post_title = get_the_title();
$tags = get_the_tags();
$post_banner_video = get_field('post_banner_video');
?>
<div class="post-header">
	<div class="container container-narrow">

		<h1 class="post-title"><?php the_title(); ?></h1>

		<div class="post-meta">
			<span class="cat"><?php the_category(', '); ?></span>
			<span class="timestamp"><?php echo esc_html($formatted_date) ?></span>

			<span class="post-author">

				<span class="avatar-placeholder"></span>

				<span class="author-name">
					<?php // Check if the author function or author information is available
					if (function_exists('the_author') && !empty(get_the_author())) {
						// Display the author information
						echo get_the_author();
					} else {
						// Display the fallback message
						echo 'HWC Theme';
					} ?>
				</span>

			</span>
		</div>

		<div class="post-summary">
			<p class="lead"><?php echo get_the_excerpt(); ?></p>
		</div>

	</div>
	<?php if (has_post_thumbnail() && empty($post_banner_video )) { ?>
		<div class="container container-slim">
			<figure class="post-main-image">
				<div class="image-container ratio-16x9">
					<?php the_post_thumbnail('large'); ?>
				</div>
			</figure>
		</div>
	<?php } else {  ?>

		<?php if(!empty($post_banner_video )){ ?>
<div class="container container-slim">
		
<figure class="post-main-video video-placeholder">
	<img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" width="1280" height="720">
	<button class="play" data-js-embed="<div class=&quot;video-container&quot;><iframe width=&quot;1280&quot; height=&quot;720&quot; src=&quot;<?php echo $post_banner_video; ?>&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen title=&quot;#TheBluebirdsNest | Episode 6 - Zac Jones&quot;></iframe></div>" aria-label="Play Video">
		<svg aria-hidden="true" height="40" width="40" viewBox="0 0 40 40"><path d="M37 20L2 40V0L37 20Z" fill="currentColor"></path></svg>	</button>
</figure>
	</div>
	<?php } ?>
		<?php } ?>

</div>

<div class="container container-slim">

	<div class="grid-container">

		<div class="post-content">

			<div class="post-body prose">
				<?php the_content(); ?>
			</div>

			<div class="post-footer">

				<div class="post-share">
					<h2 class="section-heading">Share</h2>
					<div class="social-share-buttons button-group">
						<!-- Twitter Share Button -->
						<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post_title); ?>&amp;url=<?php echo urlencode($post_url); ?>"
							class="btn btn-outline btn-twitter"
							target="_blank"
							rel="noreferrer">
							<svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
								<path d="M23.95 4.57a10 10 0 0 1-2.82.77 4.96 4.96 0 0 0 2.16-2.72c-.95.56-2 .96-3.12 1.19a4.92 4.92 0 0 0-8.38 4.48A13.93 13.93 0 0 1 1.63 3.16a4.92 4.92 0 0 0 1.52 6.57 4.9 4.9 0 0 1-2.23-.61v.06c0 2.38 1.7 4.37 3.95 4.82a5 5 0 0 1-2.21.09 4.94 4.94 0 0 0 4.6 3.42A9.87 9.87 0 0 1 0 19.54a14 14 0 0 0 7.56 2.21c9.05 0 14-7.5 14-13.98 0-.21 0-.42-.02-.63A9.94 9.94 0 0 0 24 4.59l-.05-.02z"></path>
							</svg>
							<span>Twitter</span>
						</a>

						<!-- Facebook Share Button -->
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($post_url); ?>"
							class="btn btn-outline btn-facebook"
							target="_blank"
							rel="noreferrer">
							<svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
								<path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0"></path>
							</svg>
							<span>Facebook</span>
						</a>

						<!-- WhatsApp Share Button -->
						<a href="whatsapp://send?text=<?php echo urlencode($post_title . ' ' . $post_url); ?>"
							class="btn btn-outline btn-whatsapp"
							target="_blank"
							rel="noreferrer">
							<svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
								<path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.14-.67.15-.2.3-.76.97-.94 1.17-.17.2-.34.22-.64.07s-1.26-.46-2.4-1.47a8.95 8.95 0 0 1-1.64-2.06c-.18-.3-.02-.46.13-.6.13-.14.3-.35.44-.53.15-.17.2-.3.3-.5.1-.2.05-.36-.03-.51l-.91-2.21c-.24-.58-.49-.5-.67-.51l-.57-.01c-.2 0-.52.07-.8.37-.26.3-1.03 1.02-1.03 2.48s1.06 2.88 1.21 3.08c.15.2 2.1 3.2 5.08 4.48.7.3 1.26.5 1.7.63.7.22 1.35.2 1.86.11.57-.08 1.76-.71 2-1.4.26-.7.26-1.3.18-1.42-.07-.13-.27-.2-.57-.35m-5.42 7.4A9.87 9.87 0 0 1 7 20.41l-.36-.22-3.74.99 1-3.65-.23-.38a9.86 9.86 0 0 1-1.51-5.26 9.9 9.9 0 0 1 16.87-6.98 9.82 9.82 0 0 1 2.9 7 9.9 9.9 0 0 1-9.89 9.88m8.41-18.3A11.81 11.81 0 0 0 12.05 0a11.91 11.91 0 0 0-10.3 17.84L.05 24l6.31-1.65a11.88 11.88 0 0 0 5.68 1.44h.01c6.55 0 11.89-5.33 11.9-11.89a11.82 11.82 0 0 0-3.49-8.41Z"></path>
							</svg>
							<span>WhatsApp</span>
						</a>
					</div>

				</div>

				<div class="post-tags">
					<h2 class="section-heading">Related Keywords</h2>
					<?php
					if ($tags) {
						echo '<div class="tag-list button-group">';

						foreach ($tags as $tag) {
							// Create a URL for each tag
							$tag_link = get_tag_link($tag->term_id);
							$tag_name = esc_html($tag->name);

							// Output the tag link
							echo '<a href="' . esc_url($tag_link) . '" class="btn btn-primary btn-outline tax tax-tag">' . $tag_name . '</a>';
						}

						echo '</div>';
					}
					?>
				</div>

			</div>

		</div>

		<aside class="sidebar post-sidebar">

			<?php
			$sidebar_card_image = '';
			$sidebar_card_title = '';
			$sidebar_card_button = '';
			if (have_posts()) :
				while (have_posts()) : the_post();

					// Get the ACF fields
					$sidebar_card_image = get_field('sidebar_card_image'); // Assuming this is an image URL or ID
					$sidebar_card_title = get_field('sidebar_card_title');
					$sidebar_card_button = get_field('sidebar_card_button'); // Assuming this is an array with 'url' and 'title'

					// Check if the ACF fields are available and display them
					if ($sidebar_card_image || $sidebar_card_title || $sidebar_card_button) {
						echo '<div class="card card-promo card-centered card-w-link">';

						// Display the image
						if ($sidebar_card_image) {
							echo '<div class="card-image">';
							echo '<a target="_blank" href="' . esc_url($sidebar_card_button['url']) . '" aria-label="' . esc_attr($sidebar_card_title) . '">';
							echo '<div class="image-container ratio-16x9">';
							echo '<img width="480" height="270" src="' . esc_url($sidebar_card_image) . '" alt="' . esc_attr($sidebar_card_title) . '" class="attachment-16x9-sm size-16x9-sm" decoding="async" loading="lazy">';
							echo '</div>';
							echo '</a>';
							echo '</div>';
						}

						// Display the card content (title and button)
						echo '<div class="card-content">';

						// Display the title
						if ($sidebar_card_title) {
							echo '<span class="card-title">' . esc_html($sidebar_card_title) . '</span>';
						}

						// Display the button
						if ($sidebar_card_button) {
							echo '<span class="btn btn-secondary">';
							echo '<a href="' . esc_url($sidebar_card_button['url']) . '" target="_blank">';
							echo esc_html($sidebar_card_button['title']);
							echo '</a>';
							echo '</span>';
						}

						echo '</div>'; // Close card-content
						echo '</div>'; // Close card
					}

				endwhile;
			else :
				echo '<p>No posts found.</p>';
			endif;
			?>
			<div>
				<h2 class="section-heading section-heading-display">Related</h2>
				<div class="post-list">
					<?php
					// Get current post ID and categories
					$post_id = get_the_ID();
					$categories = wp_get_post_categories($post_id);

					if ($categories) {
						$args = array(
							'category__in'   => $categories, // Related posts from the same category
							'post__not_in'   => array($post_id), // Exclude current post
							'posts_per_page' => 3, // Number of related posts to display
							'ignore_sticky_posts' => 1,
						);

						$related_posts = new WP_Query($args);

						if ($related_posts->have_posts()) {
							while ($related_posts->have_posts()) {
								$related_posts->the_post(); ?>

								<div class="card card-post card-lg card-w-link">
									<div class="card-image">
										<a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
											<div class="image-container ratio-16x9">
												<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" class="fill" alt="<?php the_title(); ?>">
											</div>
										</a>
									</div>
									<div class="card-content">
										<span class="card-title"><?php the_title(); ?></span>
										<div class="card-meta">
											<span class="cat"><?php the_category(', '); ?></span>
											<span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
										</div>
									</div>
								</div>

					<?php }
						} else {
							echo '<p>No related posts found.</p>';
						}
						wp_reset_postdata();
					}
					?>
				</div>

			</div>
			<?php get_sidebar(); ?>
		</aside>

	</div>

</div>

<?php

get_footer();
