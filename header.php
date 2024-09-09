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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'hwc' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$hwc_description = get_bloginfo( 'description', 'display' );
			if ( $hwc_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $hwc_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hwc' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->


	<div id="menu-off-screen" class="menu-off-screen" aria-hidden="true" role="navigation" data-theme="dark">

	<button class="back" data-menu-back="" aria-hidden="true">
		<svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"><path d="M12.53 5.47a.749.749 0 0 1 0 1.06l-4.719 4.72H18.5a.75.75 0 0 1 0 1.5H7.811l4.719 4.72a.749.749 0 1 1-1.06 1.06l-6-6a.749.749 0 0 1 0-1.06l6-6a.749.749 0 0 1 1.06 0Z" fill="currentColor"></path></svg>		<span class="label">Back</span>
	</button>

	<button class="close menu-toggle" data-menu-toggle="" aria-controls="menu-off-screen">
		<span class="label">Close</span>
		<span class="icon">
			<svg aria-hidden="true" width="12" height="12" viewBox="0 0 12 12"><path d="M.22.22a.75.75 0 0 1 1.062 0L6 4.938 10.718.22a.751.751 0 0 1 1.062 1.062L7.062 6l4.718 4.718a.751.751 0 0 1-1.062 1.062L6 7.062 1.282 11.78A.751.751 0 0 1 .22 10.718L4.938 6 .22 1.282A.75.75 0 0 1 .22.22Z" fill="currentColor"></path></svg>		</span>
	</button>

	<span class="menu-heading" data-menu-heading="">Menu</span>

	<div class="menu-items">

		<div class="inner">

			<ul class="menu-primary"><li class="menu-item menu-item-has-children"><a href="https://haverfordwestcountyafc.com/news/"><span>News</span><svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"><path d="M11.72 18.53a.749.749 0 0 1 0-1.06l4.719-4.72H5.75a.75.75 0 0 1 0-1.5h10.689L11.72 6.53a.749.749 0 1 1 1.06-1.06l6 6a.749.749 0 0 1 0 1.06l-6 6a.749.749 0 0 1-1.06 0Z" fill="currentColor"></path></svg></a>
<ul class="sub-menu">
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/club-news/">Latest Club News</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/match-report/">Match Reports</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/match-preview/">Match Previews</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/transfer-news/">Transfer News</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/ticket-news/">Ticket News</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/interview/">Interviews</a></li>
</ul>
</li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/teams/first-team/">Team</a></li>
<li class="menu-item menu-item-has-children"><a href="/fixtures/first-team"><span>Matches</span><svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"><path d="M11.72 18.53a.749.749 0 0 1 0-1.06l4.719-4.72H5.75a.75.75 0 0 1 0-1.5h10.689L11.72 6.53a.749.749 0 1 1 1.06-1.06l6 6a.749.749 0 0 1 0 1.06l-6 6a.749.749 0 0 1-1.06 0Z" fill="currentColor"></path></svg></a>
<ul class="sub-menu">
	<li class="menu-item"><a href="/fixtures/first-team">Fixtures</a></li>
	<li class="menu-item"><a href="/results/first-team">Results</a></li>
	<li class="menu-item"><a href="/tables/first-team">League Table</a></li>
</ul>
</li>
<li class="menu-item menu-item-has-children"><a href="https://haverfordwestcountyafc.com/club/"><span>Club</span><svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24"><path d="M11.72 18.53a.749.749 0 0 1 0-1.06l4.719-4.72H5.75a.75.75 0 0 1 0-1.5h10.689L11.72 6.53a.749.749 0 1 1 1.06-1.06l6 6a.749.749 0 0 1 0 1.06l-6 6a.749.749 0 0 1-1.06 0Z" fill="currentColor"></path></svg></a>
<ul class="sub-menu">
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/history/">History</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/contact/">Contact</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/stadium/">Stadium</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/season-tickets/">Season Tickets</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/you-can-have-it-all/">#YouCanHaveItAll</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/the-bluebirds-nest/">#TheBluebirdsNest</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/social-media/">Social Media</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/bluebirds-tote/">Bluebirds Tote</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/documents/">Documents</a></li>
</ul>
</li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/community/">Community</a></li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/academy/">Academy</a></li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/video/">Video</a></li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/accessibility-for-disabled-supporters/">Accessibility</a></li>
</ul>
		</div>

	</div>

</div>

<nav class="top-menu" data-theme="blue">
		<div class="top-menu-container"><ul class="menu"><li class="menu-item"><a href="https://haverfordwestcountyafc.com/commercial/">Commercial</a></li>
<li class="menu-item"><a target="_blank" rel="noopener" href="https://www.tor-sports.co.uk/club-shops/haverfordwest-county-afc">Shop</a></li>
<li class="menu-item"><a href="https://tktp.as/EONQBM">Tickets</a></li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/you-can-have-it-all/">Watch #YouCanHaveItAll!</a></li>
</ul></div>	</nav>

<header class="header" data-theme="blue">
			<div class="header-inner">
				<div class="touchline-branding">
					<svg aria-hidden="true" role="presentation" width="640" height="441" viewBox="0 0 640 441"><path d="M0 388.022L19.2155 440.802H13.9396L0 400.354V388.022ZM0 302.85L53.0371 440.802H58.6463L0 295.835V302.85ZM0 185.78L113.627 440.802H119.792L0 184.081V185.78ZM0 349.328L33.3218 440.802H38.7643L0 339.846V349.328ZM0 152.731L134.453 440.857H140.84L0 152.237V152.731ZM0 221.624L93.1343 440.802H99.0767L0 218.446V221.624ZM0 260.538L72.9191 440.857H78.6949L0 255.551V260.538ZM155.557 440.802H162.166L6.99757 136.288L155.557 440.802ZM592.683 440.802H606.789L192.433 10.1198L592.683 440.802ZM201.819 0.857178L625.116 440.802H640L201.819 0.857178ZM561.25 440.802H574.634L182.326 18.6698L561.25 440.802ZM177.05 440.802H183.936L18.5491 129.821L177.05 440.802ZM530.816 440.802H543.533L172.218 27.1651L530.816 440.802ZM501.215 440.802H513.266L162.777 36.4277L501.215 440.802ZM267.129 440.802H275.182L65.144 104.609L267.129 440.802ZM290.732 440.802H299.118L76.4179 97.6484L290.732 440.802ZM314.891 440.802H323.61L87.9139 91.0714L314.891 440.802ZM243.915 440.802H251.635L53.8702 111.57L243.915 440.802ZM198.931 440.802H206.095L30.1007 123.353L198.931 440.802ZM221.201 440.802H228.643L41.9854 117.434L221.201 440.802ZM339.604 440.802H348.712L98.799 83.4531L339.604 440.802ZM444.512 440.802H455.453L141.84 52.6509L444.512 440.802ZM472.503 440.802H483.999L152.669 45.0326L472.503 440.802ZM417.3 440.802H427.74L131.01 60.2692L417.3 440.802ZM390.753 440.802H400.694L120.902 68.8741L390.753 440.802ZM364.873 440.802H374.37L110.073 76.5473L364.873 440.802Z" fill="currentColor"></path></svg>				</div>

				
<div class="header-brand">

	<a href="https://haverfordwestcountyafc.com">
		<img width="200" height="282" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2022/08/haverfordwest-county.png" class="logo club-logo" alt="Haverfordwest County" decoding="async" fetchpriority="high">	</a>

	
		<h1 class="screen-reader-text">Haverfordwest County AFC Official Website</h1>

	
</div>
				<nav class="primary-menu"><ul class="menu"><li class="menu-item menu-item-has-children"><a href="https://haverfordwestcountyafc.com/news/"><span class="label">News</span><span class="icon"><svg aria-hidden="true" width="16" height="16" viewBox="0 0 16 16"><path d="M3.292 5.305a1 1 0 0 1 1.413 0L7.994 8.59l3.289-3.286a.998.998 0 1 1 1.412 1.41L8.7 10.709a1 1 0 0 1-1.412 0L3.292 6.716a.998.998 0 0 1 0-1.411Z" fill="currentColor"></path></svg></span></a>
<ul class="sub-menu">
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/club-news/">Latest Club News</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/match-report/">Match Reports</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/match-preview/">Match Previews</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/transfer-news/">Transfer News</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/ticket-news/">Ticket News</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/interview/">Interviews</a></li>
</ul>
</li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/teams/first-team/">Team</a></li>
<li class="menu-item menu-item-has-children"><a href="/fixtures/first-team"><span class="label">Matches</span><span class="icon"><svg aria-hidden="true" width="16" height="16" viewBox="0 0 16 16"><path d="M3.292 5.305a1 1 0 0 1 1.413 0L7.994 8.59l3.289-3.286a.998.998 0 1 1 1.412 1.41L8.7 10.709a1 1 0 0 1-1.412 0L3.292 6.716a.998.998 0 0 1 0-1.411Z" fill="currentColor"></path></svg></span></a>
<ul class="sub-menu">
	<li class="menu-item"><a href="/fixtures/first-team">Fixtures</a></li>
	<li class="menu-item"><a href="/results/first-team">Results</a></li>
	<li class="menu-item"><a href="/tables/first-team">League Table</a></li>
</ul>
</li>
<li class="menu-item menu-item-has-children"><a href="https://haverfordwestcountyafc.com/club/"><span class="label">Club</span><span class="icon"><svg aria-hidden="true" width="16" height="16" viewBox="0 0 16 16"><path d="M3.292 5.305a1 1 0 0 1 1.413 0L7.994 8.59l3.289-3.286a.998.998 0 1 1 1.412 1.41L8.7 10.709a1 1 0 0 1-1.412 0L3.292 6.716a.998.998 0 0 1 0-1.411Z" fill="currentColor"></path></svg></span></a>
<ul class="sub-menu">
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/history/">History</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/contact/">Contact</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/stadium/">Stadium</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/season-tickets/">Season Tickets</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/you-can-have-it-all/">#YouCanHaveItAll</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/the-bluebirds-nest/">#TheBluebirdsNest</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/club/social-media/">Social Media</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/bluebirds-tote/">Bluebirds Tote</a></li>
	<li class="menu-item"><a href="https://haverfordwestcountyafc.com/documents/">Documents</a></li>
</ul>
</li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/community/">Community</a></li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/academy/">Academy</a></li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/category/video/">Video</a></li>
<li class="menu-item"><a href="https://haverfordwestcountyafc.com/accessibility-for-disabled-supporters/">Accessibility</a></li>
</ul></nav>			</div>
			
			
<div class="header-extras">

	
		<div class="header-affiliation">
			<a target="_blank" href="https://www.cymrufootball.wales/cymru-premier/" aria-label="Visit the Cymru Premier website"><img width="300" height="98" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/07/30213057/JD-Cymru-Premier.png?class=thumbnail" class="logo" alt="Cymru Premier" decoding="async" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/07/30213057/JD-Cymru-Premier.png?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/07/30213057/JD-Cymru-Premier.png?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/07/30213057/JD-Cymru-Premier.png?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/07/30213057/JD-Cymru-Premier.png?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/07/30213057/JD-Cymru-Premier.png?class=2048x2048 2048w" sizes="(max-width: 300px) 100vw, 300px"></a>		</div>

	
	
		<div class="header-logo">
			<figure>
									<figcaption>
						Principal Partner					</figcaption>
								<a target="_blank" href="https://www.facebook.com/gellimor/"><img width="300" height="72" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/08/05133916/GELLI-MOR-PRINT_WHT.png?class=thumbnail" class="logo" alt="" decoding="async" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/08/05133916/GELLI-MOR-PRINT_WHT.png?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/08/05133916/GELLI-MOR-PRINT_WHT.png?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/08/05133916/GELLI-MOR-PRINT_WHT.png?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/08/05133916/GELLI-MOR-PRINT_WHT.png?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/08/05133916/GELLI-MOR-PRINT_WHT.png?class=2048x2048 2048w" sizes="(max-width: 300px) 100vw, 300px"></a>			</figure>
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
