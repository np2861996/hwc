<?php
/* Template Name: News Stories */
get_header();
?>
<div class="page-content">
    <h1 class="sr-only"><?php the_title(); ?></h1>

    <?php
    // Set up the query arguments
    $args = array(
        'category_name' => 'academy-news', // Change this to your category slug
    );

    // Create a new query
    $academy_news_query = new WP_Query($args);

    // Check if there are posts to display
    if ($academy_news_query->have_posts()) : ?>
        <div id="block-8931-1" class="block block-8931-1 block-cards block-cards-post first-block last-block">
            <div class="container">
                <div class="grid-container grid-columns-sm-2-lg-3">
                    <?php while ($academy_news_query->have_posts()) : $academy_news_query->the_post(); ?>
                        <div class="card card-post card-w-link">
                            <div class="card-image">
                                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                                    <div class="image-container ratio-16x9">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'fill', 'alt' => get_the_title()]); ?>
                                        <?php else : ?>
                                            <img src="default-image-url.jpg" alt="Default image" class="fill" /> <!-- Optional default image -->
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                            <div class="card-content">
                                <span class="card-title"><?php the_title(); ?></span>
                                <p class="card-summary"><?php the_excerpt(); ?></p>
                                <div class="card-meta">
                                    <span class="cat"><?php echo get_the_category_list(', '); ?></span>
                                    <span class="timestamp"><?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php
        // Reset post data
        wp_reset_postdata();
    else : ?>
        <p>No posts found in the Academy news category.</p>
    <?php endif; ?>

</div>

<?php get_footer(); ?>