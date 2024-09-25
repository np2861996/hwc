<?php

/**
 * hwc News Functions
 *
 * @package hwc
 */
/*--------------------------------------------------------------
	>>> Shortcodes
----------------------------------------------------------------*/
// Register shortcode
add_shortcode('news_page_latest_posts', 'news_page_latest_posts');


/*--------------------------------------------------------------
	>>> Shortcodes
----------------------------------------------------------------*/
function news_page_latest_posts()
{
    // Get the current page number
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Set up the custom query for the latest published posts
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 10, // Limit to 10 posts per page
        'paged'          => $paged, // For pagination
        'post_status'    => 'publish', // Ensure only published posts are displayed
    );

    // The Query
    $query = new WP_Query($args);

    // Check if we have posts
    if ($query->have_posts()) {
        // Start main container div
        echo '<div class="block">';
        echo '<div class="container container-slim">';
        echo '<div class="post-list">';

        // Loop through the posts
        while ($query->have_posts()) {
            $query->the_post();

            // Display each post
?>
            <div class="card card-post card-xl card-w-link">
                <div class="card-image">
                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                        <div class="image-container ratio-16x9">
                            <?php the_post_thumbnail('medium'); // Display featured image 
                            ?>
                        </div>
                    </a>
                </div>
                <div class="card-content">
                    <span class="card-title"><?php the_title(); ?></span>
                    <p class="card-summary"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                    <div class="card-meta">
                        <span class="cat"><?php the_category(', '); ?></span>
                        <span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                    </div>
                </div>
            </div>
<?php
        }

        echo '</div>'; // End post-list div

        // Pagination
        $pagination_args = array(
            'total'   => $query->max_num_pages,
            'current' => $paged,
            'format'  => '?paged=%#%',
            'show_all' => false,
            'prev_text' => __('« Previous'),
            'next_text' => __('Next »'),
        );
        echo '<div class="pagination pagination-numbers">';
        echo '<span class="pagination-title">Jump to Page</span>'; // Added pagination title
        echo paginate_links($pagination_args);
        echo '</div>'; // End pagination div

        echo '</div>'; // End container div
        echo '</div>'; // End block div

    } else {
        // If no posts found
        echo '<p>No posts found.</p>';
    }

    // Reset post data
    wp_reset_postdata();
}
