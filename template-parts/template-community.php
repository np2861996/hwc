<?php
/* Template Name: Community */
get_header();
?>

<div class="page-content">

    <div class="post-header">
        <div class="container container-narrow">
            <h1 class="post-title"><?php the_title(); ?></h1>
        </div>


    </div>


    <div id="block-7976-1" class="block block-7976-1 block-standard-content first-block before-cards">
        <div class="container container-narrow">
            <div class="prose">
                <p style="text-align: center;"><?php the_content(); ?></p>
            </div>
        </div>
    </div>
    <div id="block-7976-2" class="block block-7976-2 block-cards block-cards-post after-standard-content before-cards">
        <div class="container">
            <div class="section-header">
                <h2 class="section-heading section-heading-display"><?php the_field('hwc_community_section_title_1'); ?></h2>
            </div>
        </div>

        <div class="container">
            <div class="grid-container grid-columns-sm-2-lg-3">
                <?php
                $args = array(
                    'category_name' => 'community-news',
                    'posts_per_page' => 3
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        $post_title = get_the_title();
                        $post_link = get_permalink();
                        $post_excerpt = get_the_excerpt();
                        $post_date = get_the_date('F j, Y');
                        $post_category = get_the_category();
                        $post_category_name = !empty($post_category) ? esc_html($post_category[0]->name) : '';

                        if (!empty($image_url) && !empty($post_title) && !empty($post_link)) { ?>
                            <div class="card card-post card-w-link">
                                <div class="card-image">
                                    <a href="<?php echo esc_url($post_link); ?>" aria-label="<?php echo esc_attr($post_title); ?>">
                                        <div class="image-container ratio-16x9">
                                            <img width="480" height="270" src="<?php echo esc_url($image_url); ?>" class="fill" alt="<?php echo esc_attr($post_title); ?>" decoding="async">
                                        </div>
                                    </a>
                                </div>
                                <div class="card-content">
                                    <span class="card-title"><?php echo esc_html($post_title); ?></span>
                                    <p class="card-summary"><?php echo esc_html($post_excerpt); ?></p>
                                    <div class="card-meta">
                                        <?php if (!empty($post_category_name)) { ?>
                                            <span class="cat"><?php echo esc_html($post_category_name); ?></span>
                                        <?php } ?>
                                        <span class="timestamp"><?php echo esc_html($post_date); ?></span>
                                    </div>
                                </div>
                            </div>
                <?php }
                    }
                    wp_reset_postdata();
                } ?>
            </div>
        </div>
    </div>


    <div id="block-7976-3" class="block block-7976-3 block-cards block-cards-partner after-cards last-block">
        <div class="container">
            <div class="section-header">
                <!-- Dynamically fetching section titles from ACF -->
                <h2 class="section-heading section-heading-display">
                    <?php the_field('hwc_community_section_title_1'); ?>
                </h2>
            </div>
        </div>

        <div class="container">
            <div class="grid-container grid-columns-sm-2-lg-3-xl-4">

                <?php
                // Check if the repeater field has rows
                if (have_rows('hwc_repeater_community_cards')) :
                    // Loop through each row in the repeater field
                    while (have_rows('hwc_repeater_community_cards')) : the_row();
                        // Get the subfields from the repeater field
                        $card_title = get_sub_field('hwc_community_card_title');
                        $card_image = get_sub_field('hwc_community_card_image');
                        $button_link = get_sub_field('hwc_community_card_button_link');
                ?>

                        <div class="card card-partner card-centered card-w-link">
                            <div class="card-image">
                                <?php if (!empty($card_image['url'])): ?>
                                    <?php if (!empty($button_link['url'])): ?>
                                        <a target="_blank" href="<?php echo esc_url($button_link['url']); ?>" aria-label="<?php echo esc_attr($card_title); ?>">
                                        <?php endif; ?>

                                        <div class="image-container ratio-16x9">
                                            <img width="300" height="212" src="<?php echo esc_url($card_image['url']); ?>"
                                                class="logo" alt="<?php echo esc_attr($card_image['alt']); ?>" decoding="async" loading="lazy">
                                        </div>

                                        <?php if (!empty($button_link['url'])): ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>

                            <div class="card-content">
                                <span class="card-title"><?php echo esc_html($card_title); ?></span>

                                <?php if ($button_link): ?>
                                    <a href="<?php echo esc_url($button_link['url']); ?>" class="btn btn-secondary">
                                        <?php echo esc_html($button_link['title']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                <?php
                    endwhile;
                endif;
                ?>

            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>