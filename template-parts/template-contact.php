<?php
/* Template Name: Video */
get_header();
?>

<div class="page-content">
    <div class="post-header">
        <div class="container container-narrow">
            <h1 class="post-title"><?php the_title(); ?></h1>
        </div>

        <div class="container container-slim">
            <figure class="post-main-image">
                <?php
                // Display the post thumbnail
                if (has_post_thumbnail()) {
                ?>
                    <img width="1280" height="720" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" class="attachment-16x9-lg size-16x9-lg wp-post-image" alt=""
                        sizes="(max-width: 1280px) 100vw, 1280px">
                <?php
                }
                ?>
            </figure>
        </div>

    </div>

    <div class="container container-slim">
        <div class="grid-container">

            <div class="post-content">
                <div class="post-body prose">
                    <?php the_content(); ?>
                </div>
            </div>


        </div>
    </div>
</div>

<?php get_footer(); ?>