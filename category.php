<?php

/**
 * The template for displaying Category
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hwc
 */
get_header(); ?>

<div class="block">
    <div class="container container-slim">
        <div class="post-list">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="card card-post card-xl card-w-link">
                        <div class="card-image">
                            <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                                <div class="image-container ratio-16x9">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('medium', ['class' => 'fill']);
                                    }
                                    ?>
                                </div>
                            </a>
                        </div>
                        <div class="card-content">
                            <span class="card-title"><?php the_title(); ?></span>
                            <p class="card-summary"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <div class="card-meta">
                                <span class="cat"><?php the_category(', '); ?></span>
                                <span class="timestamp"><?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="pagination pagination-numbers">
                    <?php
                    global $wp_query;

                    // Check if there is more than one page of posts
                    if ($wp_query->max_num_pages > 1): ?>
                        <span class="pagination-title">Jump to Page</span>
                        <?php
                        // Pagination
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => __('&laquo; Previous', 'hwc'),
                            'next_text' => __('Next &raquo;', 'hwc'),
                        ));
                        ?>
                    <?php endif; ?>
                </div>

            <?php else : ?>
                <p class="no-found"><?php esc_html_e('No posts found in this category.', 'hwc'); ?></p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>