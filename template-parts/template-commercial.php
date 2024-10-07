<?php
/* Template Name: Commercial */
get_header();
?>

<div class="page-content">

    <div class="post-header">
        <div class="container container-narrow">
            <h1 class="post-title"><?php the_title(); ?></h1>
        </div>


    </div>


    <?php if (have_rows('hwc_repeater_commercial_cards')): ?>
        <div id="block-7148-1" class="block block-7148-1 block-cards block-cards-page first-block before-cards">
            <div class="container">
                <div class="grid-container grid-columns-sm-2-lg-3">
                    <?php while (have_rows('hwc_repeater_commercial_cards')): the_row();
                        // Get subfield values
                        $card_title = get_sub_field('hwc_commercial_card_title');
                        $card_image = get_sub_field('hwc_commercial_card_image');
                        $card_button_link = get_sub_field('hwc_commercial_card_button_link');
                    ?>
                        <div class="card card-page card-centered card-w-link">
                            <div class="card-image">
                                <?php if ($card_button_link): ?>
                                    <a href="<?php echo esc_url($card_button_link['url']); ?>" aria-label="<?php echo esc_attr($card_title); ?>">
                                        <div class="image-container ratio-16x9">
                                            <img width="480" height="270" src="<?php echo esc_url($card_image['url']); ?>" class="fill" alt="<?php echo esc_attr($card_image['alt']); ?>" decoding="async" />
                                        </div>
                                    </a>
                                <?php elseif (!empty($card_image['url'])): ?>
                                    <div class="image-container ratio-16x9">
                                        <img width="480" height="270" src="<?php echo esc_url($card_image['url']); ?>" class="fill" alt="<?php echo esc_attr($card_image['alt']); ?>" decoding="async" />
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-content">
                                <span class="card-title"><?php echo esc_html($card_title); ?></span>
                                <?php if ($card_button_link): ?>
                                    <span class="btn btn-secondary">
                                        <?php echo esc_html($card_button_link['title']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php
    // Query the latest 3 posts from the 'Commercial' category
    $args = array(
        'category_name' => 'commercial', // Replace 'commercial' with the slug of your category
        'posts_per_page' => 3,           // Fetch the latest 3 posts
    );

    $commercial_posts = new WP_Query($args);

    if ($commercial_posts->have_posts()) : ?>
        <div id="block-7148-2" class="block block-cards block-cards-post after-cards last-block">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-heading section-heading-display">Commercial News</h2>
                </div>
            </div>

            <div class="container">
                <div class="grid-container grid-columns-sm-2-lg-3">
                    <?php while ($commercial_posts->have_posts()) : $commercial_posts->the_post(); ?>
                        <div class="card card-post card-w-link">
                            <div class="card-image">
                                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                                    <div class="image-container ratio-16x9">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('medium'); ?>" class="fill" alt="<?php the_title(); ?>" />
                                        <?php else: ?>
                                            <img src="path/to/placeholder.jpg" class="fill" alt="Placeholder" />
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                            <div class="card-content">
                                <span class="card-title"><?php the_title(); ?></span>
                                <p class="card-summary"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <div class="card-meta">
                                    <span class="cat"><?php the_category(', '); ?></span><span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php else : ?>
    <?php endif;

    // Reset post data after the custom query
    wp_reset_postdata();
    ?>

</div>

<?php get_footer(); ?>