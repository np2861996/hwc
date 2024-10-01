<?php
/* Template Name: Documents   */
get_header();

?>
<div class="page-content">

    <div class="page-content">
        <div class="post-header">
            <div class="container container-narrow">
                <h1 class="post-title">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
        <div id="block-8203-1" class="block block-8203-1 block-downloads first-block before-callout">
            <div class="container container-narrow">
                <h2 class="section-heading">
                    <?php
                    // Get the section title for the Documents Page
                    $section_title = get_field('hwc_documents_section_title');
                    echo esc_html($section_title ? $section_title : 'Documents');
                    ?>
                </h2>
                <div class="files-list">
                    <?php
                    // Loop through the repeater field
                    if (have_rows('hwc_repeater_documents_cards')):
                        while (have_rows('hwc_repeater_documents_cards')): the_row();
                            $card_title = get_sub_field('hwc_documents_card_title');
                            $card_link = get_sub_field('hwc_button_link');

                            // Only display if the card title and link are not empty
                            if (!empty($card_title) && !empty($card_link)): ?>
                                <div class="file">
                                    <div>
                                        <span class="file-title">
                                            <a href="<?php echo esc_url($card_link['url']); ?>"><?php echo esc_html($card_title); ?></a>
                                        </span>
                                    </div>
                                    <div>
                                        <a href="<?php echo esc_url($card_link['url']); ?>" class="btn btn-primary">Download</a>
                                    </div>
                                </div>
                    <?php endif;
                        endwhile;
                    endif; ?>
                </div>
            </div>
        </div>
        <div id="block-8203-2" class="block block-8203-2 block-callout after-downloads last-block">
            <div class="callout callout-default">
                <span class="callout-title">
                    <?php
                    // Get bottom section title
                    $bottom_section_title = get_field('hwc_documents_bottom_section_title');
                    echo esc_html($bottom_section_title ? $bottom_section_title : 'Final Audited Accounts');
                    ?>
                </span>
                <p>
                    <?php
                    // Get bottom section text
                    $bottom_section_text = get_field('hwc_documents_bottom_section_textarea');
                    echo esc_html($bottom_section_text ? $bottom_section_text : 'Year ended 31 December 2023');
                    ?>
                </p>
                <a href="<?php echo esc_url(get_field('hwc_documents_bottom_section_button')['url']); ?>" class="btn">
                    <?php
                    // Get bottom section button text
                    $bottom_section_button = get_field('hwc_documents_bottom_section_button');
                    echo esc_html($bottom_section_button['title'] ? $bottom_section_button['title'] : 'Click here to view');
                    ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>