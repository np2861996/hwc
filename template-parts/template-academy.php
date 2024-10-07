<?php
/* Template Name: Academy */
get_header();
?>

<div class="page-content">
    <h1 class="sr-only"><?php the_title(); ?></h1>
    <div id="block-8747-1" class="block block-8747-1 block-banner block-banner-full-width first-block before-quote">
        <div class="banner banner-centered banner-full-width">
            <div class="image-container overlay-duotone">
                <?php
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(null, 'large', ['class' => 'attachment-16x-lg size-16x-lg', 'alt' => get_the_title()]);
                } else {
                    // Fallback image if no featured image is set
                    echo '';
                }
                ?>
            </div>
            <div class="banner-content">
                <h2 class="banner-title"><?php the_title(); ?></h2>
            </div>
        </div>
    </div>

    <div id="block-8747-2" class="block block-8747-2 block-quote after-banner before-cards">
        <div class="container container-narrow">
            <div class="prose">
                <blockquote>
                    <p><?php the_content() ?></p>
                    <cite></cite>
                </blockquote>
            </div>
        </div>
    </div>

    <div id="block-8747-3" class="block block-8747-3 block-cards block-cards-page after-quote before-cards">
        <div class="container">
            <div class="grid-container grid-columns-sm-2-lg-3">
                <?php
                // Check if the repeater field has rows of data
                if (have_rows('hwc_repeater_academy_cards')):

                    // Loop through the rows of data
                    while (have_rows('hwc_repeater_academy_cards')): the_row();

                        // Get sub-field values
                        $card_title = get_sub_field('hwc_academy_card_title');
                        $card_image = get_sub_field('hwc_academy_card_image');
                        $button_link = get_sub_field('hwc_academy_card_button_link');
                        $image_url = $card_image ? $card_image['url'] : ''; // Get image URL
                ?>
                        <div class="card card-page card-centered card-w-link">
                            <div class="card-image">
                                <?php if (!empty($image_url)): ?>
                                    <?php if (!empty($button_link['url'])): ?>
                                        <a href="<?php echo esc_url($button_link['url']); ?>" aria-label="<?php echo esc_attr($card_title); ?>">
                                        <?php endif; ?>

                                        <div class="image-container ratio-16x9">
                                            <img width="480" height="270" src="<?php echo esc_url($image_url); ?>" class="fill"
                                                alt="<?php echo esc_attr($card_title); ?>" decoding="async" loading="lazy"
                                                srcset="<?php echo esc_url($image_url); ?> 480w, 
                                                        <?php echo esc_url($image_url); ?>?class=mediumlarge 900w, 
                                                        <?php echo esc_url($image_url); ?>?class=large 1200w, 
                                                        <?php echo esc_url($image_url); ?>?class=thumbnail 300w"
                                                sizes="(max-width: 480px) 100vw, 480px">
                                        </div>

                                        <?php if (!empty($button_link['url'])): ?>
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="image-container ratio-16x9">
                                        <img width="480" height="270" src="path/to/default-image.jpg" class="fill" alt="Default image" decoding="async">
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="card-content">
                                <span class="card-title"><?php echo esc_html($card_title); ?></span>
                                <span class="btn btn-secondary">Read more</span>
                            </div>
                        </div>
                <?php
                    endwhile; // End of the loop
                else:
                    // Optional: Display a message if no cards are found
                    echo '';
                endif;
                ?>
            </div>
        </div>
    </div>

    <div id="block-8747-4" class="block block-8747-4 block-cards block-cards-page after-cards before-cards">

        <div class="container">
            <div class="section-header">
                <h2 class="section-heading section-heading-display">
                    <?php
                    // Get the section title from ACF
                    $section_title = get_field('hwc_academy_section_title_1');
                    echo esc_html($section_title);
                    ?>
                </h2>
            </div>
        </div>

        <div class="container">
            <div class="grid-container grid-columns-sm-2-lg-3">
                <?php
                // Get the repeater field
                if (have_rows('hwc_repeater_our_academy_phases_cards')):
                    while (have_rows('hwc_repeater_our_academy_phases_cards')): the_row();
                        // Get sub-fields
                        $card_title = get_sub_field('hwc_our_academy_phases_card_title');
                        $card_image = get_sub_field('hwc_our_academy_phases_card_image');
                        $button_link = get_sub_field('hwc_our_academy_phases_card_button_link');
                ?>
                        <div class="card card-page card-centered card-w-link">
                            <div class="card-image">
                                <?php if (!empty($card_image['url'])): ?>
                                    <?php if (!empty($button_link['url'])): ?>
                                        <a href="<?php echo esc_url($button_link['url']); ?>" aria-label="<?php echo esc_attr($card_title); ?>">
                                        <?php endif; ?>

                                        <div class="image-container ratio-16x9">
                                            <img
                                                src="<?php echo esc_url($card_image['url']); ?>"
                                                class="fill"
                                                alt="<?php echo esc_attr($card_title); ?>"
                                                decoding="async"
                                                loading="lazy"
                                                srcset="<?php echo esc_url($card_image['url']); ?> 480w, <?php echo esc_url($card_image['url']); ?> 900w, <?php echo esc_url($card_image['url']); ?> 1200w"
                                                sizes="(max-width: 480px) 100vw, 480px">
                                        </div>

                                        <?php if (!empty($button_link['url'])): ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="card-content">
                                <span class="card-title"><?php echo esc_html($card_title); ?></span>
                                <span class="btn btn-secondary">Read more</span>
                            </div>
                        </div>
                <?php endwhile;
                endif; ?>
            </div>
        </div>
    </div>

    <?php
    // Get the YouTube URL from the ACF field
    $youtube_url = get_field('hwc_academy_section_youtube_url');

    // Check if the URL is not empty
    if (!empty($youtube_url)) : ?>
        <div id="block-8747-6" class="block block-8747-6 block-video after-cards before-row-team">
            <div class="container container-narrow">
                <div class="video-container">
                    <iframe title="Haverfordwest County AFC | Academy In 60 Seconds" width="640" height="360" src="<?php echo esc_url($youtube_url); ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="block-8747-7" class="block block-8747-7 block-row-team after-video before-accordions">

        <div class="container">
            <div class="section-header">
                <h2 class="section-heading section-heading-display"><?php echo get_the_title(get_field('hwc_academy_select_team')); ?></h2>
            </div>
        </div>

        <div class="md:container">

            <div class="grid-container">

                <!--------------------------------------------------------------
			>>> Sec6 - Team Posts
			---------------------------------------------------------------->
                <?php
                $dis_hwc_home_select_team = get_the_title(get_field('hwc_academy_select_team'));
                // display the Team Posts
                echo do_shortcode('[hwc_team_post_shortcode team="' . $dis_hwc_home_select_team . '"]');
                ?>

                <div class="team-row-match">
                    <?php
                    $dis_hwc_home_select_team_id = get_field('hwc_academy_select_team');
                    // display the Team result
                    echo do_shortcode('[hwc_home_result_by_team_result team="' . $dis_hwc_home_select_team_id . '"]');
                    ?>
                    <a class="btn btn-lg btn-primary" href="<?php echo site_url('fixtures'); ?>">All Development Matches</a>
                </div>
            </div>

        </div>

    </div>

    <?php if (have_rows('hwc_academy_faq_repeater_cards')): ?>
        <div id="block-8747-8" class="block block-8747-8 block-accordions after-row-team before-banner">
            <div class="container container-narrow">
                <ul class="accordions">
                    <?php while (have_rows('hwc_academy_faq_repeater_cards')): the_row();
                        // Get the sub-field values
                        $faq_title = get_sub_field('hwc_our_academy_faq_title');
                        $faq_text = get_sub_field('hwc_our_academy_faq_text');
                    ?>
                        <li class="accordion-item">
                            <a href="#" class="accordion-title" data-expand="accordion">
                                <span><?php echo esc_html($faq_title); ?></span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            <div class="accordion-content" data-accordion-content="">
                                <div class="prose">
                                    <?php echo wp_kses_post($faq_text); // Allowing basic HTML tags in WYSIWYG content 
                                    ?>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>


    <?php
    // Arguments for WP_Query to get the latest post in the 'Academy news' category
    $args = array(
        'category_name' => 'academy-news', // Ensure to use the correct slug for the category
        'posts_per_page' => 1, // Limit to 1 post
    );

    // Custom query to fetch the post
    $latest_academy_news = new WP_Query($args);

    // Check if the query returns any posts
    if ($latest_academy_news->have_posts()) :
        while ($latest_academy_news->have_posts()) : $latest_academy_news->the_post(); ?>
            <div id="block-8747-9" class="block block-8747-9 block-banner block-banner-contained after-accordions last-block">
                <div class="banner banner-post banner-contained">
                    <a href="<?php the_permalink(); ?>">
                        <div class="image-container overlay-dimmed">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'fill', 'alt' => get_the_title()]); ?>
                            <?php else : ?>
                                <img src="default-image.jpg" class="fill" alt="Default image" />
                            <?php endif; ?>
                        </div>
                        <div class="banner-content">
                            <h2 class="banner-title"><?php the_title(); ?></h2>
                            <p class="summary"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <div class="post-meta">
                                <span class="cat"><?php echo get_the_category_list(', '); ?></span>
                                |<span class="timestamp"><?php echo get_the_date('d F, Y'); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    <?php endwhile;
        wp_reset_postdata(); // Reset post data after custom query
    endif;
    ?>

</div>

<?php get_footer(); ?>