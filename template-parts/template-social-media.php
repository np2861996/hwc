<?php
/* Template Name: Social Media   */
get_header();

// Fetch the ACF fields with the updated variable names
$social_media_linktree_url = get_field('hwc_social_media_button_link'); // The URL for the Linktree
$social_media_bg_image = get_field('hwc_social_media_bg_image'); // The background image
$social_media_section_title = get_field('hwc_social_media_section_title_1'); // Section title with prefix
$social_media_summary_text = get_field('hwc_social_media_section_title_2'); // Summary text

?>
<div class="page-content">
    <h1 class="sr-only">Social Media</h1>

    <div id="block-9208-1" class="block block-banner block-banner-full-width first-block before-standard-content">
        <div class="banner banner-centered banner-full-width">
            <?php if (!empty($social_media_linktree_url['url'])): ?>
                <a target="_blank" href="<?php echo esc_url($social_media_linktree_url['url']); ?>">
                <?php endif; ?>

                <div class="image-container overlay-duotone">
                    <img width="2560" height="1707" src="<?php echo esc_url($social_media_bg_image['url']); ?>"
                        alt="<?php echo esc_attr($social_media_section_title); ?>" decoding="async"
                        sizes="(max-width: 2560px) 100vw, 2560px">
                </div>

                <div class="banner-content">
                    <h2 class="banner-title"><?php echo esc_html($social_media_section_title); ?></h2>
                    <p class="summary"><?php echo esc_html($social_media_summary_text); ?></p>
                    <?php if (!empty($social_media_linktree_url['url'])): ?>
                        <span class="btn btn-lg btn-primary"><?php echo esc_html($social_media_linktree_url['title']); ?></span>
                    <?php endif; ?>
                </div>

                <?php if (!empty($social_media_linktree_url['url'])): ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div id="block-9208-2" class="block block-9208-2 block-standard-content after-banner before-cards">
        <div class="container container-narrow">
            <div class="prose">
                <?php
                // Fetch the content of the current post or page
                $content = get_the_content();

                // Check if the content is not empty
                if (!empty($content)) : ?>
                    <?php echo $content; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="block-9208-3" class="block block-9208-3 block-cards block-cards-promo after-standard-content last-block">
        <div class="container">
            <div class="grid-container grid-columns-sm-2-lg-3">
                <?php
                // Check if the repeater field has rows of data
                if (have_rows('hwc_repeater_social_media_cards')):
                    // Loop through the rows of data
                    while (have_rows('hwc_repeater_social_media_cards')) : the_row();
                        // Get sub field values
                        $hwc_social_media_card_title = get_sub_field('hwc_social_media_card_title');
                        $hwc_social_media_card_image = get_sub_field('hwc_social_media_card_image');
                        $hwc_social_media_card_link = get_sub_field('hwc_social_media_card_button_link');
                ?>
                        <div class="card card-promo card-centered card-w-link">
                            <div class="card-image">
                                <?php if (!empty($hwc_social_media_card_image['url'])): ?>
                                    <?php if (!empty($hwc_social_media_card_link['url'])): ?>
                                        <a target="_blank" href="<?php echo esc_url($hwc_social_media_card_link['url']); ?>" aria-label="<?php echo esc_attr($hwc_social_media_card_title); ?>">
                                        <?php endif; ?>

                                        <div class="image-container ratio-16x9">
                                            <img width="960" height="540" src="<?php echo esc_url($hwc_social_media_card_image['url']); ?>"
                                                class="attachment-16x9-md size-16x9-md"
                                                alt="<?php echo esc_attr($hwc_social_media_card_title); ?>"
                                                decoding="async">
                                        </div>

                                        <?php if (!empty($hwc_social_media_card_link['url'])): ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>
                            <div class="card-content">
                                <span class="card-title"><?php echo esc_html($hwc_social_media_card_title); ?></span>
                                <?php if (!empty($hwc_social_media_card_link['url'])): ?>
                                    <span class="btn btn-secondary"><?php echo esc_html($hwc_social_media_card_link['title']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php
                    endwhile;
                else:
                    // No rows found
                    echo '';
                endif;
                ?>
            </div>
        </div>
    </div>


</div>



<?php get_footer(); ?>