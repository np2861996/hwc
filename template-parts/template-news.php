<?php
/* Template Name: News */
get_header();
?>

<div class="news-page-content">
    <h1><?php the_field('news_title'); ?></h1>
    <img src="<?php the_field('news_image'); ?>" alt="">
    <a href="<?php the_field('news_link'); ?>">Read more</a>
    <p><?php the_field('news_summary'); ?></p>
    <p><?php the_field('news_date'); ?></p>
</div>

<?php get_footer(); ?>
