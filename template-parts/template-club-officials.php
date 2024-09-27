<?php
/* Template Name: Club Officials */
get_header();
?>

<?php if (have_rows('hwc_repeater_club_officials_cards')) : ?>
    <div class="page-content">
        <div class="post-header">
            <div class="container container-narrow">
                <h1 class="post-title"><?php the_title(); ?></h1>
            </div>
        </div>

        <div id="block-7142-1" class="block block-7142-1 block-cards block-cards-people first-block last-block">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-heading section-heading-display">
                        <?php the_field('hwc_club_officials_section_title'); // Section title
                        ?>
                    </h2>
                </div>
            </div>

            <div class="container">
                <div class="grid-container grid-columns-2-lg-3-xl-4">
                    <?php while (have_rows('hwc_repeater_club_officials_cards')) : the_row(); ?>
                        <div class="card card-person card-centered">
                            <div class="card-image">
                                <?php
                                $image = get_sub_field('hwc_club_officials_card_image');
                                if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="image-placeholder image-placeholder-person ratio-1x1">
                                <?php else : ?>
                                    <div class="image-placeholder image-placeholder-person ratio-1x1"></div>
                                <?php endif; ?>
                            </div>

                            <div class="card-content">
                                <span class="card-title"><?php the_sub_field('hwc_club_officials_card_title_1'); ?></span>
                                <p class="card-summary"><?php the_sub_field('hwc_club_officials_card_title_2'); ?></p>

                                <?php $button_link = get_sub_field('hwc_club_officials_button_link'); ?>
                                <?php if ($button_link) : ?>
                                    <a class="btn btn-primary" target="_blank" href="<?php echo esc_url($button_link['url']); ?>">
                                        <?php echo esc_html($button_link['title']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php get_footer(); ?>