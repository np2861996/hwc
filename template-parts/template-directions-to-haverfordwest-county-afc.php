<?php
/* Template Name: Directions to Haverfordwest County AFC */
get_header();
?>

<div class="page-content">
    <!-- Fetch and display the dynamic title -->
    <h1 class="sr-only"><?php echo esc_html(get_the_title()); ?></h1>

    <div id="block-7496-1" class="block block-7496-1 block-banner block-banner-full-width first-block before-standard-content">
        <div class="banner banner-centered banner-full-width">
            <div class="image-container overlay-duotone">
                <!-- Dynamically add a featured image if available -->
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', ['class' => 'attachment-16x-lg size-16x-lg', 'alt' => esc_attr(get_the_title()), 'decoding' => 'async']); ?>
                <?php else: ?>
                <?php endif; ?>
            </div>

            <div class="banner-content">
                <h2 class="banner-title"><?php echo esc_html(get_the_title()); ?></h2>
            </div>
        </div>
    </div>

    <div id="block-7496-2" class="block block-7496-2 block-standard-content after-banner last-block">
        <div class="container container-narrow">
            <div class="prose">
                <!-- Fetch and display the dynamic content -->
                <?php
                $content = apply_filters('the_content', get_the_content());
                if (!empty($content)) {
                    echo $content;
                } else {
                    echo "<p>No content available.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>