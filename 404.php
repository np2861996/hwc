<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hwc
 */

get_header();
?>
<div class="page-content">
	<main id="primary" class="site-main">
		<div class="post-header">
			<div class="container container-narrow">
				<h1 class="post-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'hwc'); ?></h1>
			</div>
		</div>
	</main><!-- #main -->
</div>

<?php
get_footer();
