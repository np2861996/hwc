<?php
/* Template Name: Club */
get_header();
?>

<?php
// Start the loop
if (have_posts()) :
    while (have_posts()) : the_post();

        // Retrieve the section title
        $section_title = get_field('hwc_club_section_title');

        // Retrieve the repeater field
        $club_cards = get_field('hwc_repeater_club_cards');

?>
        <div class="page-content">
            <div class="post-header">
                <div class="container container-narrow">
                    <h1 class="post-title"><?php echo esc_html($section_title); ?></h1>
                </div>
            </div>
            <div class="block">
                <div class="container">
                    <div class="grid-container grid-columns-sm-2-lg-3">

                        <?php if ($club_cards) : ?>
                            <?php foreach ($club_cards as $card) : ?>
                                <div class="card card-page card-centered card-w-link">
                                    <div class="card-image">
                                        <?php if (!empty($card['hwc_club_card_image'])) : ?>
                                            <?php if (!empty($card['hwc_button_link']['url'])) : ?>
                                                <a href="<?php echo esc_url($card['hwc_button_link']['url']); ?>" aria-label="<?php echo esc_attr($card['hwc_club_card_title']); ?>">
                                                <?php endif; ?>

                                                <img src="<?php echo esc_url($card['hwc_club_card_image']['url']); ?>"
                                                    alt="<?php echo esc_attr($card['hwc_club_card_image']['alt']); ?>"
                                                    width="<?php echo esc_attr($card['hwc_club_card_image']['width']); ?>"
                                                    height="<?php echo esc_attr($card['hwc_club_card_image']['height']); ?>">

                                                <?php if (!empty($card['hwc_button_link']['url'])) : ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title"><?php echo esc_html($card['hwc_club_card_title']); ?></span>
                                        <?php if ($card['hwc_button_link']) : ?>
                                            <a href="<?php echo esc_url($card['hwc_button_link']['url']); ?>" class="btn btn-secondary"><?php echo esc_html($card['hwc_button_link']['title']); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="no-found">No club cards found.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
<?php
    endwhile;
else :
    echo '<p class="no-found">No content found.</p>';
endif;
?>


<?php get_footer(); ?>