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
		<?php the_author(); ?>	</span>
	
</span>
		</div>

					<div class="post-summary">
				<p class="lead"><?php the_excerpt(); ?></p>
			</div>
		
	</div>

	<div class="container container-slim">
					<figure class="post-main-image">
				<div class="image-container ratio-16x9">
					<?php if (has_post_thumbnail()) {
						the_post_thumbnail('large');
					} ?>				
			</div>
							</figure>
			</div>

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
			<div class="tag-list button-group">
									<a href="https://haverfordwestcountyafc.com/teams/first-team/" class="btn btn-primary btn-outline tax tax-tag">First Team</a>
									<a href="https://haverfordwestcountyafc.com/player/zac-jones/" class="btn btn-primary btn-outline tax tax-tag">Zac Jones</a>
							</div>
		</div>
	
</div>

				</div>

				<aside class="sidebar post-sidebar">

	
<div class="card card-promo card-centered card-w-link">

	
			<div class="card-image">
			<a target="_blank" href="https://www.youtube.com/playlist?list=PL0hgLwiLgTW3BfrWwI8hYydy8RZzprmjX" aria-label="Watch our club documentary series!">
							<div class="image-container ratio-16x9">
					<img width="480" height="270" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2023/10/12133858/maxresdefault.jpg?class=16x9sm" class="attachment-16x9-sm size-16x9-sm" alt="" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2023/10/12133858/maxresdefault.jpg?class=16x9sm 480w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/10/12133858/maxresdefault.jpg?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/10/12133858/maxresdefault.jpg?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/10/12133858/maxresdefault.jpg?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/10/12133858/maxresdefault.jpg?class=16x9md 960w, https://media.touchlinefc.co.uk/haverfordwestcounty/2023/10/12133858/maxresdefault.jpg 1280w" sizes="(max-width: 480px) 100vw, 480px">				</div>
			
			</a>		</div>
	
	
		<div class="card-content">

								
							<span class="card-title">Watch our club documentary series!</span>
			
			
			
							<span class="btn btn-secondary">
										Click here for full playlist!				</span>
			
		</div>

	
</div>
<div><h2 class="section-heading section-heading-display">Related</h2><div class="post-list">
<div class="card card-post card-lg card-w-link">

	
			<div class="card-image">
			<a href="https://haverfordwestcountyafc.com/2024/09/bluebirds-make-swift-return-to-essity-for-meeting-with-silkmen/" aria-label="Bluebirds make swift return to Essity for meeting with Silkmen">
							<div class="image-container ratio-16x9">
					<img width="480" height="270" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=16x9sm" class="fill" alt="Read the full article - Bluebirds make swift return to Essity for meeting with Silkmen" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=16x9sm 480w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=16x9md 960w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png?class=16x9lg 1280w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/13121952/MatchPreview.png 1920w" sizes="(max-width: 480px) 100vw, 480px">				</div>
			
			</a>		</div>
	
	
		<div class="card-content">

								
							<span class="card-title">Bluebirds make swift return to Essity for meeting with Silkmen</span>
			
			
							<div class="card-meta">
					<span class="cat">Match Previews</span><span class="timestamp">18 hours ago</span>				</div>
			
			
		</div>

	
</div>

<div class="card card-post card-lg card-w-link">

	
			<div class="card-image">
			<a href="https://haverfordwestcountyafc.com/2024/09/tns-our-disappointment-shows-how-far-weve-come-as-a-team/" aria-label="Pennock: Our disappointment shows how far we’ve come as a team">
							<div class="image-container ratio-16x9">
					<img width="480" height="270" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=16x9sm" class="fill" alt="Read the full article - Pennock: Our disappointment shows how far we’ve come as a team" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=16x9sm 480w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=16x9md 960w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png?class=16x9lg 1280w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08170609/tonyTNSFI.png 1920w" sizes="(max-width: 480px) 100vw, 480px">				</div>
			
			</a>		</div>
	
	
		<div class="card-content">

								
							<span class="card-title">Pennock: Our disappointment shows how far we’ve come as a team</span>
			
			
							<div class="card-meta">
					<span class="cat">Interviews</span><span class="timestamp">6 days ago</span>				</div>
			
			
		</div>

	
</div>

<div class="card card-post card-lg card-w-link">

	
			<div class="card-image">
			<a href="https://haverfordwestcountyafc.com/2024/09/bluebirds-defeated-for-first-time-in-2024-25-as-champions-saints-claim-narrow-win/" aria-label="Bluebirds defeated for first time in 2024-25 as champions Saints claim narrow win">
							<div class="image-container ratio-16x9">
					<img width="480" height="270" src="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=16x9sm" class="fill" alt="Read the full article - Bluebirds defeated for first time in 2024-25 as champions Saints claim narrow win" decoding="async" loading="lazy" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=16x9sm 480w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=16x9md 960w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png?class=16x9lg 1280w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/09/08150527/MatchReport.png 1920w" sizes="(max-width: 480px) 100vw, 480px">				</div>
			
			</a>		</div>
	
	
		<div class="card-content">

								
							<span class="card-title">Bluebirds defeated for first time in 2024-25 as champions Saints claim narrow win</span>
			
			
							<div class="card-meta">
					<span class="cat">Match Reports</span><span class="timestamp">6 days ago</span>				</div>
			
			
		</div>

	
</div>
</div></div>
</aside>

			</div>

		</div>

<?php
get_sidebar();
get_footer();
