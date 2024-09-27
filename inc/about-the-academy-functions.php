<?php

/**
 * hwc About The Academy Functions
 *
 * @package hwc
 */
/*--------------------------------------------------------------
	>>> Shortcodes
----------------------------------------------------------------*/
add_shortcode('hwc_about_the_academy_posts', 'hwc_about_the_academy_posts');

/*--------------------------------------------------------------
	>>> Shortcode function for the "About the Academy" page with full HTML structure
----------------------------------------------------------------*/
function hwc_about_the_academy_posts()
{
    // Query arguments to get the posts from the 'Academy news' category
    $args = array(
        'category_name' => 'academy-news', // The slug of your "Academy news" category
        'post_status'   => 'publish',      // Only fetch published posts
        'posts_per_page' => 3              // Limit to 3 posts, change if necessary
    );

    // The WP_Query for fetching posts
    $query = new WP_Query($args);

    // Output buffering to capture HTML output
    $output = '<div id="block-8927-2" class="block block-8927-2 block-cards block-cards-post after-standard-content before-band">';
    $output .= '<div class="container">';
    $output .= '<div class="grid-container grid-columns-sm-2-lg-3">';

    if ($query->have_posts()) {
        // Loop through each post
        while ($query->have_posts()) {
            $query->the_post();

            // Save post data into variables
            $post_title = get_the_title();
            $post_excerpt = get_the_excerpt();
            $post_url = get_permalink();
            $post_category = get_the_category();
            $post_image = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Get post featured image URL
            $post_date = get_the_date();

            // Constructing the HTML structure for each post
            $output .= '<div class="card card-post card-w-link">';
            $output .= '<div class="card-image">';
            $output .= '<a href="' . esc_url($post_url) . '" aria-label="' . esc_attr($post_title) . '">';
            $output .= '<div class="image-container ratio-16x9">';
            $output .= '<img src="' . esc_url($post_image) . '" alt="' . esc_attr($post_title) . '" />';
            $output .= '</div></a></div>';
            $output .= '<div class="card-content">';
            $output .= '<span class="card-title">' . esc_html($post_title) . '</span>';
            $output .= '<p class="card-summary">' . esc_html($post_excerpt) . '</p>';
            $output .= '<div class="card-meta">';
            $output .= '<span class="cat">' . esc_html($post_category[0]->name) . '</span>';
            $output .= '<span class="timestamp">' . esc_html($post_date) . '</span>';
            $output .= '</div></div></div>';
        }
        // Reset post data after the query
        wp_reset_postdata();
    } else {
        $output .= '<p>No posts found.</p>';
    }

    // Close the container divs
    $output .= '</div></div></div>';

    return $output;
}
