<?php
/* Template Name: Youth Phase */
get_header();
?>
<div class="page-content">

    <div class="post-header">
        <div class="container container-narrow">
            <h1 class="post-title"><?php the_title(); ?></h1>
        </div>


    </div>


    <div id="block-8929-1" class="block block-8929-1 block-standard-content first-block before-accordions">
        <div class="container container-narrow">
            <div class="prose">
                <h5><?php the_content(); ?></h5>
            </div>
        </div>
    </div>
    <div id="block-8929-3" class="block block-8929-3 block-accordions after-accordions before-accordions">
        <div class="container container-narrow">
            <ul class="accordions">
                <?php
                // Get the repeater field
                $faqs = get_field('hwc_youth_phase_faq_repeater_cards');

                // Check if the repeater field has rows
                if ($faqs) :
                    foreach ($faqs as $index => $faq) :
                        // Variables for title and content
                        $title = $faq['hwc_our_youth_phase_faq_title'];
                        $content = $faq['hwc_our_youth_phase_faq_text'];

                        // Check if title and content are not empty
                        if (!empty($title) && !empty($content)) :
                ?>
                            <li class="accordion-item">
                                <a href="#" class="accordion-title" data-expand="accordion">
                                    <span><?php echo esc_html($title); ?></span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                                <div class="accordion-content" data-accordion-content="">
                                    <div class="prose">
                                        <?php echo wp_kses_post($content); ?>
                                    </div>
                                </div>
                            </li>
                    <?php
                        endif; // End if for content check
                    endforeach; // End foreach loop
                else :
                    ?>
                    <li>No FAQs available at this time.</li>
                <?php endif; // End if for repeater check 
                ?>
            </ul>
        </div>
    </div>


    <div id="block-8929-7" class="block block-8929-7 block-cards block-cards-page after-accordions before-band">

        <div class="container">
            <div class="section-header">
                <?php
                // Get the section title
                $section_title = get_field('hwc_youth_phase_voap_section_title');

                // Check if section title is not empty
                if (!empty($section_title)) :
                ?>
                    <h2 class="section-heading section-heading-display"><?php echo esc_html($section_title); ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="container">
            <div class="grid-container grid-columns-sm-2-lg-3">
                <?php
                // Get the repeater field
                $cards = get_field('hwc_repeater_youth_phase_cards');

                // Check if the repeater field has rows
                if ($cards) :
                    foreach ($cards as $card) :
                        // Variables for card details
                        $title = !empty($card['hwc_youth_phase_card_title']) ? esc_html($card['hwc_youth_phase_card_title']) : '';
                        $image = !empty($card['hwc_youth_phase_card_image']) ? esc_url($card['hwc_youth_phase_card_image']['url']) : '';
                        $button_link = !empty($card['hwc_youth_phase_card_button_link']) ? esc_url($card['hwc_youth_phase_card_button_link']['url']) : '#';

                        // Check if title, image, and button link are not empty
                        if (!empty($title) && !empty($image)) :
                ?>
                            <div class="card card-page card-centered card-w-link">
                                <div class="card-image">
                                    <a href="<?php echo esc_url($button_link); ?>" aria-label="<?php echo esc_attr($title); ?>">
                                        <div class="image-container ratio-16x9">
                                            <img width="480" height="270" src="<?php echo $image; ?>" class="fill" alt="Read the full article - <?php echo esc_attr($title); ?>" decoding="async" srcset="<?php echo $image; ?> 480w, <?php echo $image; ?> 900w, <?php echo $image; ?> 1200w" sizes="(max-width: 480px) 100vw, 480px">
                                        </div>
                                    </a>
                                </div>

                                <div class="card-content">
                                    <span class="card-title"><?php echo $title; ?></span>
                                    <span class="btn btn-secondary">Read more</span>
                                </div>
                            </div>
                    <?php
                        endif; // End if for title/image check
                    endforeach; // End foreach loop
                else :
                    ?>
                    <div class="card card-page card-centered">
                        <div class="card-content">
                            <span class="card-title">No Academy Phases Available</span>
                        </div>
                    </div>
                <?php endif; // End if for repeater check 
                ?>
            </div>
        </div>
    </div>


    <div id="block-8929-8" class="block block-8929-8 block-band after-cards last-block">

        <div class="band">
            <div class="band-image align-right">
                <?php
                // Get the image URL from ACF
                $aos_image = get_field('hwc_youth_phase_aos_image');
                if ($aos_image) : // Check if the image field is not empty 
                ?>
                    <span>
                        <img
                            width="1920"
                            height="1080"
                            src="<?php echo esc_url($aos_image['url']); ?>"
                            class="attachment-3x2-lg size-3x2-lg"
                            alt="<?php echo esc_attr($aos_image['alt']); ?>"
                            decoding="async"
                            srcset="<?php echo esc_url($aos_image['url']); ?> 1920w, 
                                <?php echo esc_url($aos_image['url']); ?>?class=mediumlarge 900w, 
                                <?php echo esc_url($aos_image['url']); ?>?class=large 1200w"
                            sizes="(max-width: 1920px) 100vw, 1920px">
                    </span>
                <?php endif; ?>
            </div>

            <div class="band-content">
                <div>
                    <?php
                    // Get the section title from ACF
                    $aos_title = get_field('hwc_youth_phase_section_title');
                    if ($aos_title) : // Check if the title field is not empty 
                    ?>
                        <h2 class="band-title"><?php echo esc_html($aos_title); ?></h2>
                    <?php endif; ?>

                    <div class="button-group">
                        <?php
                        // Get the button link from ACF
                        $aos_button_link = get_field('hwc_youth_phase_aos_button_link');
                        if ($aos_button_link) : // Check if the button link field is not empty 
                        ?>
                            <a target="_blank" href="<?php echo esc_url($aos_button_link['url']); ?>" class="btn btn-lg">
                                <?php echo esc_html($aos_button_link['title']); // Display the button title 
                                ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

<?php get_footer(); ?>