<?php
/* Template Name: Matches */
get_header();
?>

<div class="home-page-content">
    <h1><?php the_field('home_title1'); ?></h1>
    <h2><?php the_field('home_title2'); ?></h2>
    <img src="<?php the_field('home_image1'); ?>" alt="">
    <img src="<?php the_field('home_image2'); ?>" alt="">
    <a href="<?php the_field('home_link'); ?>"><?php the_field('home_button'); ?></a>
    <p><?php the_field('home_description'); ?></p>
</div>

<?php get_footer(); ?>
