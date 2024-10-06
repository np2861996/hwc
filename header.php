<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hwc
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js" data-touchline-club="haverfordwest-county" data-touchline-theme="blue">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<?php
	// Array of color settings with default values
	$blue_colors = [
		'Primary-Color'   => '#112982', // Default color for Primary-Color
		'Secondary-Color' => '#f8f9fe', // Default color for Secondary-Color
	];

	// Start dynamic CSS
	echo '<style type="text/css">';

	foreach ($blue_colors as $color_key => $default_color) {
		$color_value = get_theme_mod($color_key, $default_color); // Use specific default color for each key
		echo ":root { --$color_key: " . esc_attr($color_value) . "; }";
	}

	echo '</style>';
	?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'hwc'); ?></a>

		<div id="menu-off-screen" class="menu-off-screen" aria-hidden="true" role="navigation" data-theme="dark">

			<button class="back" data-menu-back="" aria-hidden="true">
				<svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
					<path d="M12.53 5.47a.749.749 0 0 1 0 1.06l-4.719 4.72H18.5a.75.75 0 0 1 0 1.5H7.811l4.719 4.72a.749.749 0 1 1-1.06 1.06l-6-6a.749.749 0 0 1 0-1.06l6-6a.749.749 0 0 1 1.06 0Z" fill="currentColor"></path>
				</svg> <span class="label">Back</span>
			</button>

			<button class="close menu-toggle" data-menu-toggle="" aria-controls="menu-off-screen">
				<span class="label">Close</span>
				<span class="icon">
					<svg aria-hidden="true" width="12" height="12" viewBox="0 0 12 12">
						<path d="M.22.22a.75.75 0 0 1 1.062 0L6 4.938 10.718.22a.751.751 0 0 1 1.062 1.062L7.062 6l4.718 4.718a.751.751 0 0 1-1.062 1.062L6 7.062 1.282 11.78A.751.751 0 0 1 .22 10.718L4.938 6 .22 1.282A.75.75 0 0 1 .22.22Z" fill="currentColor"></path>
					</svg> </span>
			</button>

			<span class="menu-heading" data-menu-heading="">Menu</span>

			<div class="menu-items">

				<div class="inner">
					<?php
					wp_nav_menu(array(
						'theme_location'  => 'primary',
						'container'       => false,  // No extra container
						'menu_class'      => 'menu-primary', // Add the class 'menu' to the ul element
						'depth'           => 2,      // Allows for submenus (drop-downs)
						'walker'          => new Custom_Walker_Nav_Menu() // Custom Walker for structure and icons
					));
					?>
				</div>
			</div>
		</div>

		<nav class="top-menu" data-theme="blue">
			<div class="top-menu-container">
				<ul class="menu">
					<?php
					// Check if there are any header links in the repeater field
					if (have_rows('header_link_repeater', 'option')): // Using 'option' to fetch from the options page
						while (have_rows('header_link_repeater', 'option')) : the_row();
							$link = get_sub_field('header_link'); // Get the link field

							// Ensure that $link is an array and contains the necessary keys
							if (is_array($link) && isset($link['url'], $link['target'], $link['title'])):
					?>
								<li class="menu-item">
									<a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>" rel="noopener">
										<?php echo esc_html($link['title']); ?>
									</a>
								</li>
					<?php
							endif;
						endwhile;
					endif;
					?>

				</ul>
			</div>
		</nav>


		<header class="header" data-theme="blue">
			<div class="header-inner">
				<div class="touchline-branding">
					<svg aria-hidden="true" role="presentation" width="640" height="441" viewBox="0 0 640 441">
						<path d="M0 388.022L19.2155 440.802H13.9396L0 400.354V388.022ZM0 302.85L53.0371 440.802H58.6463L0 295.835V302.85ZM0 185.78L113.627 440.802H119.792L0 184.081V185.78ZM0 349.328L33.3218 440.802H38.7643L0 339.846V349.328ZM0 152.731L134.453 440.857H140.84L0 152.237V152.731ZM0 221.624L93.1343 440.802H99.0767L0 218.446V221.624ZM0 260.538L72.9191 440.857H78.6949L0 255.551V260.538ZM155.557 440.802H162.166L6.99757 136.288L155.557 440.802ZM592.683 440.802H606.789L192.433 10.1198L592.683 440.802ZM201.819 0.857178L625.116 440.802H640L201.819 0.857178ZM561.25 440.802H574.634L182.326 18.6698L561.25 440.802ZM177.05 440.802H183.936L18.5491 129.821L177.05 440.802ZM530.816 440.802H543.533L172.218 27.1651L530.816 440.802ZM501.215 440.802H513.266L162.777 36.4277L501.215 440.802ZM267.129 440.802H275.182L65.144 104.609L267.129 440.802ZM290.732 440.802H299.118L76.4179 97.6484L290.732 440.802ZM314.891 440.802H323.61L87.9139 91.0714L314.891 440.802ZM243.915 440.802H251.635L53.8702 111.57L243.915 440.802ZM198.931 440.802H206.095L30.1007 123.353L198.931 440.802ZM221.201 440.802H228.643L41.9854 117.434L221.201 440.802ZM339.604 440.802H348.712L98.799 83.4531L339.604 440.802ZM444.512 440.802H455.453L141.84 52.6509L444.512 440.802ZM472.503 440.802H483.999L152.669 45.0326L472.503 440.802ZM417.3 440.802H427.74L131.01 60.2692L417.3 440.802ZM390.753 440.802H400.694L120.902 68.8741L390.753 440.802ZM364.873 440.802H374.37L110.073 76.5473L364.873 440.802Z" fill="currentColor"></path>
					</svg>
				</div>
				<div class="header-brand">
					<?php the_custom_logo(); ?>
				</div>
				<nav class="primary-menu">
					<?php
					wp_nav_menu(array(
						'theme_location'  => 'primary',
						'container'       => false,  // No extra container
						'menu_class'      => 'menu', // Add the class 'menu' to the ul element
						'depth'           => 2,      // Allows for submenus (drop-downs)
						'walker'          => new Custom_Walker_Nav_Menu() // Custom Walker for structure and icons
					));
					?>
				</nav>
			</div>
			<div class="header-extras">
				<div class="header-affiliation">
					<?php
					// Fetch Header Image 1 and its link
					$header_image_1 = get_field('header_image_1', 'option'); // Use 'option' if the field is in the options page
					$header_image_1_link = get_field('header_image_1_link', 'option');
					?>
					<?php
					// Assign variables
					$image_1_url = $header_image_1 ? esc_url($header_image_1) : '';
					$image_1_link = $header_image_1_link ? esc_url($header_image_1_link['url']) : '';

					// Check if both image and link are available
					if ($image_1_url && $image_1_link): ?>
						<a target="_blank" href="<?php echo $image_1_link; ?>" aria-label="Visit the Cymru Premier website">
							<img width="300" height="98" src="<?php echo $image_1_url; ?>" class="logo" alt="Cymru Premier" decoding="async">
						</a>
					<?php elseif ($image_1_url): // If only the image is available 
					?>
						<img width="300" height="98" src="<?php echo $image_1_url; ?>" class="logo" alt="Cymru Premier" decoding="async">
					<?php endif; ?>

				</div>

				<div class="header-logo">
					<?php
					// Fetch Header Image 2 and its link
					$header_image_2 = get_field('header_image_2', 'option'); // Use 'option' if the field is in the options page
					$header_image_2_link = get_field('header_image_2_link', 'option');

					// Assign variables
					$image_2_url = $header_image_2 ? esc_url($header_image_2) : '';
					$image_2_link = $header_image_2_link ? esc_url($header_image_2_link['url']) : '';

					// Check if the image is available
					if ($image_2_url): ?>
						<figure>
							<figcaption>Principal Partner</figcaption>

							<?php if ($image_2_link): // If both image and link are available 
							?>
								<a target="_blank" href="<?php echo $image_2_link; ?>">
									<img width="300" height="72" src="<?php echo $image_2_url; ?>" class="logo" alt="Principal Partner Logo" decoding="async">
								</a>
							<?php else: // If only the image is available 
							?>
								<img width="300" height="72" src="<?php echo $image_2_url; ?>" class="logo" alt="Principal Partner Logo" decoding="async">
							<?php endif; ?>
						</figure>
					<?php endif; ?>
				</div>
			</div>
			<div class="header-toggle lg:hidden">
				<button class="hamburger menu-toggle" data-menu-toggle="" aria-label="Toggle menu visibility" aria-controls="menu-off-screen">
					<span class="toggle-label">More</span>
					<span class="bars">
						<span class="bar"></span>
						<span class="bar"></span>
						<span class="bar"></span>
					</span>
				</button>
			</div>
		</header>