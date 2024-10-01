<?php
/* Template Name: Our Sponsors */
get_header();
?>
<div class="page-content">
    <div class="post-header">
        <div class="container container-narrow">
            <h1 class="post-title"><?php the_title(); ?> </h1>
        </div>


    </div>
    <?php if (have_rows('hwc_repeater_main_sponsors')): ?>
        <?php while (have_rows('hwc_repeater_main_sponsors')): the_row();
            // Main Sponsor Title
            $main_sponsor_title = get_sub_field('hwc_main_sponsor_title');
        ?>
            <div id="block-7150-1" class="block block-7150-1 block-cards block-cards-partner first-block before-cards">
                <div class="container">
                    <div class="section-header">
                        <?php if ($main_sponsor_title): // Check if the main sponsor title is not empty 
                        ?>
                            <h2 class="section-heading section-heading-display"><?php echo esc_html($main_sponsor_title); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="container">
                    <div class="grid-container grid-columns-sm-2-lg-3-xl-4">
                        <?php if (have_rows('hwc_repeater_our_sponsors_cards')): ?>
                            <?php while (have_rows('hwc_repeater_our_sponsors_cards')): the_row();
                                // Nested fields
                                $card_title = get_sub_field('hwc_our_sponsors_card_title');
                                $card_title_2 = get_sub_field('hwc_our_sponsors_card_title_2');
                                $card_image = get_sub_field('hwc_our_sponsors_card_image');
                                $button_link = get_sub_field('hwc_our_sponsors_card_button_link');
                            ?>
                                <div class="card card-partner card-centered card-w-link">
                                    <div class="card-image">
                                        <?php if ($button_link && !empty($button_link['url'])): // Check if button link is set 
                                        ?>
                                            <a target="_blank" href="<?php echo esc_url($button_link['url']); ?>" aria-label="<?php echo esc_attr($card_title); ?>">
                                                <div class="image-container ratio-16x9">
                                                    <?php if ($card_image && !empty($card_image['url'])): // Check if card image is set 
                                                    ?>
                                                        <img width="300" height="72" src="<?php echo esc_url($card_image['url']); ?>" class="logo" alt="<?php echo esc_attr($card_title); ?>" decoding="async">
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        <?php else: ?>
                                            <?php if ($card_image && !empty($card_image['url'])): // Check if card image is set 
                                            ?> <div class="image-container ratio-16x9">
                                                    <img width="300" height="72" src="<?php echo esc_url($card_image['url']); ?>" class="logo" alt="<?php echo esc_attr($card_title); ?>" decoding="async">
                                                <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                    </div>

                                    <div class="card-content">
                                        <?php if ($card_title): // Check if card title is not empty 
                                        ?>
                                            <span class="card-title"><?php echo esc_html($card_title); ?></span>
                                        <?php endif; ?>
                                        <?php if ($card_title_2): // Check if card title 2 is not empty 
                                        ?>
                                            <p class="card-summary"><?php echo esc_html($card_title_2); ?></p>
                                        <?php endif; ?>
                                        <?php if ($button_link): // Check if card title 2 is not empty 
                                        ?>
                                            <span class="btn btn-secondary"><?php echo esc_html($button_link['title']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

</div>


<?php get_footer(); ?>