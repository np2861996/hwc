<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hwc
 */

?>
<div class="block-logos block">
	<div class="container container-narrow">
		<h2 class="legend"><span>Official Partners</span></h2>
	</div>
	<div class="container">
		<div class="logo-group">

			<?php
			// Debugging output
			if (have_rows('footer_official_partners', 'option')) :
				// Loop through the rows of data
				while (have_rows('footer_official_partners', 'option')) : the_row();


					// Get the sub field values
					$partner_image = get_sub_field('partner_image');
					$partner_link = get_sub_field('partner_link');

					// Check if both fields are not empty
					if (!empty($partner_image) && !empty($partner_link)) : ?>
						<div class="logo-group-item">
							<a target="_blank" href="<?php echo esc_url($partner_link); ?>">
								<img width="300" height="72" src="<?php echo esc_url($partner_image); ?>" class="logo" alt="<?php echo esc_attr__('Partner Logo', 'your-text-domain'); ?>" decoding="async" loading="lazy">
							</a>
						</div>
					<?php else: ?>
						<p><?php echo esc_html__('Missing data for a partner.', 'your-text-domain'); ?></p>
				<?php endif;
				endwhile;
			else : ?>
				<!-- Debugging: no rows found -->
				<p><?php echo esc_html__('No partners found.', 'your-text-domain'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

<footer class="footer" data-theme="dark">
	<div class="touchline-branding">
		<svg aria-hidden="true" width="640" height="441" viewBox="0 0 640 441">
			<path d="M0 388.022L19.2155 440.802H13.9396L0 400.354V388.022ZM0 302.85L53.0371 440.802H58.6463L0 295.835V302.85ZM0 185.78L113.627 440.802H119.792L0 184.081V185.78ZM0 349.328L33.3218 440.802H38.7643L0 339.846V349.328ZM0 152.731L134.453 440.857H140.84L0 152.237V152.731ZM0 221.624L93.1343 440.802H99.0767L0 218.446V221.624ZM0 260.538L72.9191 440.857H78.6949L0 255.551V260.538ZM155.557 440.802H162.166L6.99757 136.288L155.557 440.802ZM592.683 440.802H606.789L192.433 10.1198L592.683 440.802ZM201.819 0.857178L625.116 440.802H640L201.819 0.857178ZM561.25 440.802H574.634L182.326 18.6698L561.25 440.802ZM177.05 440.802H183.936L18.5491 129.821L177.05 440.802ZM530.816 440.802H543.533L172.218 27.1651L530.816 440.802ZM501.215 440.802H513.266L162.777 36.4277L501.215 440.802ZM267.129 440.802H275.182L65.144 104.609L267.129 440.802ZM290.732 440.802H299.118L76.4179 97.6484L290.732 440.802ZM314.891 440.802H323.61L87.9139 91.0714L314.891 440.802ZM243.915 440.802H251.635L53.8702 111.57L243.915 440.802ZM198.931 440.802H206.095L30.1007 123.353L198.931 440.802ZM221.201 440.802H228.643L41.9854 117.434L221.201 440.802ZM339.604 440.802H348.712L98.799 83.4531L339.604 440.802ZM444.512 440.802H455.453L141.84 52.6509L444.512 440.802ZM472.503 440.802H483.999L152.669 45.0326L472.503 440.802ZM417.3 440.802H427.74L131.01 60.2692L417.3 440.802ZM390.753 440.802H400.694L120.902 68.8741L390.753 440.802ZM364.873 440.802H374.37L110.073 76.5473L364.873 440.802Z" fill="currentColor"></path>
		</svg>
	</div>

	<div class="container">
		<div class="footer-main">
			<?php the_custom_logo(); ?>
			<div>
				<?php
				// Get the address, link button, and bottom text from ACF
				$address = get_field('footer_address', 'option');
				$link_button = get_field('footer_link_button', 'option');
				$bottom_text = get_field('footer_bottom_text', 'option');

				// Check if the address is not empty
				if (!empty($address)) : ?>
					<div itemscope itemtype="http://schema.org/PostalAddress">
						<p class="address"><?php echo wp_kses_post($address); ?></p>
					</div>
				<?php endif; ?>

				<?php
				// Check if the link button has a URL
				if (!empty($link_button['url'])) : ?>
					<p>
						<a class="btn btn-outline" target="_blank" href="<?php echo esc_url($link_button['url']); ?>">
							<span><?php echo esc_html($link_button['title']); ?></span>
						</a>
					</p>
				<?php endif; ?>

				<div class="footer-text">
					<?php
					// Check if the bottom text is not empty
					if (!empty($bottom_text)) : ?>
						<p><?php echo esc_html($bottom_text); ?></p>
					<?php endif; ?>
				</div>
			</div>

		</div>
		<div>
			<h2 class="section-heading">Follow us</h2>
			<div class="social-icons">
				<span itemscope itemtype="https://schema.org/Organization">
					<link itemprop="url" href="https://haverfordwestcountyafc.com">

					<?php
					// An array of your social media links
					// Fetch the footer social media group field
					$social_links = get_field('footer_social_media', 'option');

					if ($social_links) {
						$social_links = [
							'twitter' => !empty($social_links['footer_twitter']) ? $social_links['footer_twitter'] : '',
							'facebook' => !empty($social_links['footer_facebook']) ? $social_links['footer_facebook'] : '',
							'instagram' => !empty($social_links['footer_instagram']) ? $social_links['footer_instagram'] : '',
							'youtube' => !empty($social_links['footer_youtube']) ? $social_links['footer_youtube'] : '',
							'linkedin' => !empty($social_links['footer_linkedin']) ? $social_links['footer_linkedin'] : '',
							'tiktok' => !empty($social_links['footer_tiktok']) ? $social_links['footer_tiktok'] : '',
						];
					} else {
						$social_links = []; // Initialize as empty array if no links found
					}

					// Iterate through each social media link and display the icon
					foreach ($social_links as $key => $link) {
						if ($link) { // Check if the link exists
							switch ($key) {
								case 'twitter':
									echo '<a itemprop="sameAs" target="_blank" title="Find us on Twitter" href="' . esc_url($link) . '">
                                    <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M23.95 4.57a10 10 0 0 1-2.82.77 4.96 4.96 0 0 0 2.16-2.72c-.95.56-2 .96-3.12 1.19a4.92 4.92 0 0 0-8.38 4.48A13.93 13.93 0 0 1 1.63 3.16a4.92 4.92 0 0 0 1.52 6.57 4.9 4.9 0 0 1-2.23-.61v.06c0 2.38 1.7 4.37 3.95 4.82a5 5 0 0 1-2.21.09 4.94 4.94 0 0 0 4.6 3.42A9.87 9.87 0 0 1 0 19.54a14 14 0 0 0 7.56 2.21c9.05 0 14-7.5 14-13.98 0-.21 0-.42-.02-.63A9.94 9.94 0 0 0 24 4.59l-.05-.02z"></path>
                                    </svg>
                                    <span class="sr-only">twitter</span>
                                  </a>';
									break;
								case 'facebook':
									echo '<a itemprop="sameAs" target="_blank" title="Find us on Facebook" href="' . esc_url($link) . '">
                                    <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0"></path>
                                    </svg>
                                    <span class="sr-only">facebook</span>
                                  </a>';
									break;
								case 'instagram':
									echo '<a itemprop="sameAs" target="_blank" title="Find us on Instagram" href="' . esc_url($link) . '">
                                    <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M12 0C8.74 0 8.33.01 7.05.07a8.85 8.85 0 0 0-2.91.56c-.79.3-1.46.72-2.13 1.38S.94 3.35.63 4.14c-.3.77-.5 1.64-.56 2.91C.01 8.33 0 8.74 0 12s.01 3.67.07 4.95c.06 1.27.26 2.15.56 2.91.3.79.72 1.46 1.38 2.13a5.87 5.87 0 0 0 2.13 1.38c.77.3 1.64.5 2.91.56 1.28.06 1.69.07 4.95.07s3.67-.01 4.95-.07a6.88 6.88 0 0 0 2.91-.56 5.9 5.9 0 0 0 2.13-1.38 5.86 5.86 0 0 0 1.38-2.13c.3-.77.5-1.64.56-2.91.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95a8.87 8.87 0 0 0-.56-2.91 5.89 5.89 0 0 0-1.38-2.13A5.85 5.85 0 0 0 19.86.63c-.77-.3-1.64-.5-2.91-.56A83.63 83.63 0 0 0 12 0zm0 2.16c3.2 0 3.58.02 4.85.07 1.17.06 1.8.25 2.23.42.56.21.96.47 1.38.9.42.41.68.81.9 1.37.16.43.36 1.06.4 2.23.07 1.27.08 1.65.08 4.85s-.02 3.58-.08 4.85a6.75 6.75 0 0 1-.42 2.23c-.22.56-.48.96-.9 1.38-.41.42-.82.68-1.38.9-.42.16-1.06.36-2.23.4-1.27.07-1.65.08-4.86.08-3.21 0-3.59-.02-4.86-.08a6.8 6.8 0 0 1-2.23-.42 3.72 3.72 0 0 1-1.38-.9 3.64 3.64 0 0 1-.9-1.38 6.81 6.81 0 0 1-.42-2.23c-.05-1.26-.06-1.65-.06-4.84 0-3.2.01-3.6.06-4.87A6.8 6.8 0 0 1 2.6 4.9c.2-.57.48-.96.9-1.38.42-.42.8-.69 1.38-.9A6.64 6.64 0 0 1 7.1 2.2c1.27-.04 1.65-.06 4.86-.06l.04.03zm0 3.68a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm7.85-10.4a1.44 1.44 0 1 1-2.89 0 1.44 1.44 0 0 1 2.89 0z"></path>
                                    </svg>
                                    <span class="sr-only">instagram</span>
                                  </a>';
									break;
								case 'youtube':
									echo '<a itemprop="sameAs" target="_blank" title="Find us on YouTube" href="' . esc_url($link) . '">
                                   <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"><path class="a" d="M23.5 6.2a3 3 0 0 0-2.1-2.08c-1.86-.5-9.39-.5-9.39-.5s-7.5-.01-9.4.5A3 3 0 0 0 .53 6.2 31.25 31.25 0 0 0 0 12.02a31.25 31.25 0 0 0 .52 5.78 3 3 0 0 0 2.08 2.1c1.87.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.09-2.1 31.25 31.25 0 0 0 .5-5.78 31.25 31.25 0 0 0-.5-5.8zM9.6 15.6V8.4l6.27 3.61z"></path></svg>
                                    <span class="sr-only">YouTube Channel</span>
                                  </a>';
									break;
								case 'linkedin':
									echo '<a itemprop="sameAs" target="_blank" title="Find us on LinkedIn" href="' . esc_url($link) . '">
                                    <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"><path d="M12.53.02c1.3-.02 2.6-.01 3.9-.02a6.23 6.23 0 0 0 1.76 4.17 7.05 7.05 0 0 0 4.24 1.79v4.03a10.7 10.7 0 0 1-5.82-1.9c-.01 2.92 0 5.84-.02 8.75a7.64 7.64 0 0 1-1.35 3.94 7.45 7.45 0 0 1-5.91 3.21A7.54 7.54 0 0 1 4.17 10.8a7.44 7.44 0 0 1 6.15-1.72c.02 1.48-.04 2.96-.04 4.44a3.5 3.5 0 0 0-3.02.37 3.47 3.47 0 0 0-1.36 1.75c-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87a3.36 3.36 0 0 0 2.77-1.61c.19-.33.4-.67.4-1.06.1-1.79.07-3.57.08-5.36 0-4.03-.01-8.05.02-12.07z"></path></svg>
                                    <span class="sr-only">LinkedIn Profile</span>
                                  </a>';
									break;
								case 'tiktok':
									echo '<a itemprop="sameAs" target="_blank" title="Find us on TikTok" href="' . esc_url($link) . '">
                                    <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"><path d="M20.45 20.45h-3.56v-5.57c0-1.32-.02-3.03-1.85-3.03-1.85 0-2.13 1.44-2.13 2.94v5.66H9.35V9h3.42v1.56h.04a3.75 3.75 0 0 1 3.37-1.85c3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zm1.78 13.02H3.56V9h3.56v11.45zM22.22 0H1.78C.8 0 0 .77 0 1.73v20.54C0 23.23.8 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"></path></svg>
                                    <span class="sr-only">TikTok Profile</span>
                                  </a>';
									break;
							}
						}
					}
					?>
				</span>
			</div>
		</div>

	</div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>