<?php
/* Template Name: About The Academy */
get_header();


?>
<div class="page-content">

    <div class="post-header">
        <div class="container container-narrow">
            <h1 class="post-title"><?php the_title(); ?></h1>
        </div>


    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if (!empty(get_the_content())) : ?>
                <div id="block-8927-1" class="block block-8927-1 block-standard-content first-block before-cards">
                    <div class="container container-narrow">
                        <div class="prose">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
    <?php endwhile;
    endif; ?>


    <!--------------------------------------------------------------
		>>> Sec2 - Posts
		---------------------------------------------------------------->
    <?php
    //display the latest post
    echo do_shortcode('[hwc_about_the_academy_posts]');
    ?>

    <?php
    // Get ACF fields directly without using a prefix
    $about_the_academy_section_title = get_field('hwc_about_the_academy_section_title');
    $about_the_academy_button_link = get_field('hwc_about_the_academy_card_button_link');
    $about_the_academy_card_image = get_field('hwc_about_the_academy_card_image');

    if ($about_the_academy_card_image) {
        $image_url = $about_the_academy_card_image['url'];  // Image URL
        $image_alt = $about_the_academy_card_image['alt'];  // Image alt text
    }
    ?>

    <div id="block-8927-3" class="block block-8927-3 block-band after-cards last-block">
        <div class="band">
            <div class="band-image align-right">
                <?php if (!empty($about_the_academy_card_image)): ?>
                    <span>
                        <img width="1920" height="1080" src="<?php echo esc_url($image_url); ?>"
                            class="attachment-3x2-lg size-3x2-lg" alt="<?php echo esc_attr($image_alt); ?>"
                            decoding="async" loading="lazy"
                            sizes="(max-width: 1920px) 100vw, 1920px">
                    </span>
                <?php endif; ?>
            </div>

            <div class="band-content">
                <div>
                    <?php if (!empty($about_the_academy_section_title)): ?>
                        <h2 class="band-title"><?php echo esc_html($about_the_academy_section_title); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($about_the_academy_button_link) && !empty($about_the_academy_button_link['url'])): ?>
                        <div class="button-group">
                            <a target="_blank" href="<?php echo esc_url($about_the_academy_button_link['url']); ?>"
                                class="btn btn-lg">
                                <?php echo esc_html($about_the_academy_button_link['title']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php get_footer(); ?>