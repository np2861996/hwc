<?php
/* Template Name: News */
get_header();
?>

<!--------------------------------------------------------------
	>>> News
---------------------------------------------------------------->
<?php
//display the latest post
echo do_shortcode('[news_page_latest_posts]');
?>

<?php get_footer(); ?>