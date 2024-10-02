<?php
/* Template Name: Development Phase */
get_header();
?>
<div class="page-content">

    <div class="post-header">
        <div class="container container-narrow">
            <h1 class="post-title"><?php the_title(); ?></h1>
        </div>


    </div>


    <div id="block-8930-1" class="block block-8930-1 block-standard-content first-block before-cards">
        <div class="container container-narrow">
            <div class="prose">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <div id="block-8930-2" class="block block-8930-2 block-cards block-cards-people after-standard-content before-cards">
        <div class="container">
            <div class="grid-container grid-columns-2-lg-3-xl-4">
                <?php
                // Get the player repeater field
                if (have_rows('hwc_development_phase_player_repeater_cards')): // Check if there are rows of data
                    while (have_rows('hwc_development_phase_player_repeater_cards')) : the_row(); // Loop through the rows
                        // Get sub fields
                        $player_title = get_sub_field('hwc_our_development_phase_player_title'); // Player title
                        $player_image = get_sub_field('hwc_our_development_phase_player_image'); // Player image
                ?>
                        <div class="card card-person card-centered">
                            <div class="card-image">
                                <div class="image-container ratio-1x1">
                                    <?php if ($player_image) : // Check if the image field is not empty 
                                    ?>
                                        <img
                                            width="768"
                                            height="900"
                                            src="<?php echo esc_url($player_image['url']); ?>"
                                            class="attachment-1x1-md size-1x1-md"
                                            alt="<?php echo esc_attr($player_image['alt']); ?>"
                                            decoding="async">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="card-content">
                                <?php if ($player_title) : // Check if the title field is not empty 
                                ?>
                                    <span class="card-title"><?php echo esc_html($player_title); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile; // End of the loop
                else : // Fallback in case there are no players
                    ?>
                    <p>No players found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="block-8930-3" class="block block-8930-3 block-cards block-cards-page after-cards last-block">
        <div class="container">
            <div class="section-header">
                <?php
                // Get the section title
                $section_title = get_field('hwc_development_phase_voap_section_title');
                if ($section_title) : // Check if the title is not empty
                ?>
                    <h2 class="section-heading section-heading-display"><?php echo esc_html($section_title); ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="container">
            <div class="grid-container grid-columns-sm-2-lg-3">
                <?php
                // Get the repeater field for development phase cards
                if (have_rows('hwc_repeater_development_phase_cards')): // Check if there are rows of data
                    while (have_rows('hwc_repeater_development_phase_cards')) : the_row(); // Loop through the rows
                        // Get sub fields
                        $card_title = get_sub_field('hwc_development_phase_card_title'); // Card title
                        $card_image = get_sub_field('hwc_development_phase_card_image'); // Card image
                        $button_link = get_sub_field('hwc_development_phase_card_button_link'); // Button link
                ?>
                        <div class="card card-page card-centered card-w-link">
                            <div class="card-image">
                                <?php if ($button_link && $button_link['url']) : // Check if the button link is not empty 
                                ?>
                                    <a href="<?php echo esc_url($button_link['url']); ?>" aria-label="<?php echo esc_attr($card_title); ?>">
                                    <?php endif; ?>
                                    <div class="image-container ratio-16x9">
                                        <?php if ($card_image) : // Check if the image field is not empty 
                                        ?>
                                            <img
                                                width="480"
                                                height="270"
                                                src="<?php echo esc_url($card_image['url']); ?>"
                                                class="fill"
                                                alt="<?php echo esc_attr($card_image['alt']); ?>"
                                                decoding="async"
                                                loading="lazy"
                                                srcset="<?php echo esc_url($card_image['url']); ?> 480w, <?php echo esc_url($card_image['url']); ?> 900w, <?php echo esc_url($card_image['url']); ?> 1200w"
                                                sizes="(max-width: 480px) 100vw, 480px">
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($button_link) : // Close the link if it was opened 
                                    ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="card-content">
                                <?php if ($card_title) : // Check if the title field is not empty 
                                ?>
                                    <span class="card-title"><?php echo esc_html($card_title); ?></span>
                                <?php endif; ?>

                                <?php if ($button_link && $button_link['url']) : // Check if the button link is not empty 
                                ?>
                                    <span class="btn btn-secondary">Read more</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile; // End of the loop
                else : // Fallback in case there are no cards
                    ?>
                    <p>No academy phases found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<?php get_footer(); ?>