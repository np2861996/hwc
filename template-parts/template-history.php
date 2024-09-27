<?php
/* Template Name: History */
get_header();

// Get ACF fields for the history section
$history_section_title_1 = get_field('hwc_history_section_title_1');
$history_section_title_2 = get_field('hwc_history_section_title_2');
$history_bg_image = get_field('hwc_history_bg_image');
$history_content = get_the_content(); // Get the content of the post/page

// Check if background image is available
if ($history_bg_image) {
    $bg_image_url = esc_url($history_bg_image['url']);  // Background image URL
    $bg_image_alt = esc_attr($history_bg_image['alt']);  // Background image alt text
}
?>
<div class="page-content">
    <h1 class="sr-only"><?php the_title(); ?></h1>

    <div id="block-7143-1" class="block block-7143-1 block-banner block-banner-full-width first-block before-standard-content">
        <div class="banner banner-centered banner-full-width">
            <div class="image-container overlay-duotone">
                <?php if (!empty($history_bg_image)): ?>
                    <img width="1920" height="1080" src="<?php echo $bg_image_url; ?>" class="attachment-16x-lg size-16x-lg" alt="<?php echo $bg_image_alt; ?>" decoding="async">
                <?php endif; ?>
            </div>

            <div class="banner-content">
                <?php if (!empty($history_section_title_1)): ?>
                    <h2 class="banner-title"><?php echo esc_html($history_section_title_1); ?></h2>
                <?php endif; ?>

                <?php if (!empty($history_section_title_2)): ?>
                    <p class="summary"><?php echo esc_html($history_section_title_2); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="block-7143-2" class="block block-7143-2 block-standard-content after-banner last-block">
        <div class="container container-narrow">
            <div class="prose">
                <?php if (!empty($history_content)): ?>
                    <?php echo $history_content; ?>
                <?php else: ?>
                    <p>No content available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>