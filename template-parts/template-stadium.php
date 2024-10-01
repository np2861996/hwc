<?php
/* Template Name: Stadium   */
get_header();

?>

<div class="page-content">
    <div class="post-header">
        <div class="container container-narrow">
            <?php
            // Get and store the title and content in variables
            $post_title = get_the_title();
            $post_content = get_the_content();
            // Check if the title is not empty
            if (!empty($post_title)) {
                echo '<h1 class="post-title">' . $post_title . '</h1>';
            }
            // Check if the content is not empty
            if (!empty($post_content)) {
                echo '<div class="post-summary">';
                echo '<p class="lead">' . $post_content . '</p>';
                echo '</div>';
            }
            // Optional: Add a comment for debugging or note purposes
            // This comment won't be visible in the frontend but will appear in the page source
            echo '<!-- Post data has been retrieved and displayed -->';
            ?>
        </div>
    </div>
    <?php if (have_rows('hwc_repeater_stadium_cards')): ?>
        <div id="block-7146-1" class="block block-7146-1 block-cards block-cards-page first-block last-block">
            <div class="container">
                <div class="grid-container grid-columns-sm-2-lg-3">
                    <?php while (have_rows('hwc_repeater_stadium_cards')): the_row();
                        // Get values from the repeater fields
                        $card_title = get_sub_field('hwc_stadium_card_title');
                        $card_image = get_sub_field('hwc_stadium_card_image');
                        $card_button_link = get_sub_field('hwc_stadium_card_button_link');
                        // Check if fields are non-empty
                        if (!empty($card_title) && !empty($card_image)): ?>
                            <div class="card card-page card-centered card-w-link">
                                <div class="card-image">
                                    <a href="<?php echo esc_url($card_button_link['url']); ?>" aria-label="<?php echo esc_attr($card_title); ?>">
                                        <div class="image-container ratio-16x9">
                                            <img width="480" height="270" src="<?php echo esc_url($card_image['url']); ?>" class="fill" alt="<?php echo esc_attr($card_image['alt']); ?>" decoding="async">
                                        </div>
                                    </a>
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
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>