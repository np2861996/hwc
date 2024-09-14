<?php
/*--------------------------------------------------------------
	>>> Function for create dummy posts
	----------------------------------------------------------------*/
    function hwc_create_categories_and_manual_posts() {

        // Define the categories
        $categories = array(
            'club-news' => 'Latest Club News',
            'match-report' => 'Match Report',
            'match-preview' => 'Match Preview',
            'transfer-news' => 'Transfer News',
            'ticket-news' => 'Ticket News',
            'interview' => 'Interview',
            'you-can-have-it-all' => 'You Can Have It All',
            'the-bluebirds-nest' => 'The Bluebirds Nest',
            'community-news' => 'Community News',
            'video' => 'Video'
        );
    
        // Loop through each category and create if it doesn't exist
        foreach ($categories as $slug => $name) {
            if (!term_exists($slug, 'category')) {
                wp_insert_term($name, 'category', array('slug' => $slug));
            }
        }
    
        // Base URL for the images in the 'hwc-images' folder
        $image_base_url = get_template_directory_uri() . '/hwc-images/';
    
        // Manually create posts
    
        // Post 1
        $category = get_term_by('slug', 'club-news', 'category');
        $post_id1 = wp_insert_post(array(
            'post_title'   => 'Zac Jones agrees new one-year deal with the Bluebirds',
            'post_content' => '<p><strong>Haverfordwest County AFC are delighted to confirm that Zac Jones has signed a new one-year contract with the club.</strong></p>
<p>The goalkeeper arrived at the Ogi Bridge Meadow in January 2022, and has gone on to establish himself as one of the most important players in recent times.</p>
<p>After making his first team debut in the 3-0 victory over Airbus UK Broughton in August 2022, Zac has gone on to make a total of 53 appearances in all competitions for the Town, and has been involved in plenty of big moments during that time.</p>
<p>The New Zealander played a vital role in helping to end our 19-year wait to return to Europe, as his penalty save in normal time of the play-off semi-final victory at Cardiff Metropolitan, followed by two more saves in the shoot-out, were backed up by yet another spot-kick save in the final at Newtown – a day never to be forgotten by those who were in attendance.</p>
<blockquote><p>“I’ve really enjoyed my time here, I feel I’ve gained a lot of experience.”</p></blockquote>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img decoding="async" class="wp-image-9561" src="'.$image_base_url.'/2023-07-20-Haverfordwest-County-v-KF-Shkendija-67-1.jpg?class=large" alt="" width="600" height="400">
	<figcaption class="caption">Zac celebrates saving a penalty against KF Shkëndija in the UEFA Europa Conference League qualifier at the Cardiff City Stadium. (Pic by John Smith/FAW)</figcaption>
</figure>

<p>A new deal was penned shortly after our European qualification, taking him up until the end of the current campaign.</p>
<p>His heroics didn’t end there, though, as he came up trumps once more in the UEFA Europa Conference League first qualifying round victory over European regulars KF Shkëndija, as he pulled off two more penalty saves – including the match-winner – on what was undoubtedly the greatest night in the club’s 125-year history.</p>
<div class="nwVKo">
<div class="loJjTe">His strong displays between the posts continued into the 2023-24 campaign, where he has been one of our most consistent performers across the season to date, and Bluebirds fans can now look forward to having him at the Ogi Bridge Meadow for another year to come.</div>
<div>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img decoding="async" class="wp-image-9562" src="'.$image_base_url.'/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg?class=large" alt="" width="600" height="400" srcset="https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182716/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg 2400w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182716/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg?class=thumbnail 300w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182716/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg?class=mediumlarge 900w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182716/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg?class=large 1200w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182716/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg?class=1536x1536 1536w, https://media.touchlinefc.co.uk/haverfordwestcounty/2024/02/29182716/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg?class=2048x2048 2048w" sizes="(max-width: 600px) 100vw, 600px">
	<figcaption class="caption">Zac walks out of the Cardiff City Stadium tunnel alongside fellow goalkeeper, Ifan Knott. (Pic by John Smith/FAW)</figcaption>
</figure>

</div>
</div>
<p><strong>Upon signing his new contract, Zac said: </strong>“I’m pleased to have signed on for another year here at the club.</p>
<p>“I’ve really enjoyed my time here, I feel I’ve gained a lot of experience. The European qualifiers were definitely a highlight, but speaking on behalf of all the boys, we want to experience that again.</p>
<p>“The next few months are really important. I think it’s clear we are not in the position we want to be as a club, but we need to make sure we secure this play-off spot.</p>
<p>“I’m excited for next season, I’m sure we’ll be competing right at the top of the table.”</p>
<p><strong>Commenting on the news, manager Tony Pennock said:&nbsp;</strong>“Zac has shown again this season what a good goalkeeper he is.</p>
<p>“He will continue to develop with every game and, along with Ifan, we are extremely lucky to have two excellent goalkeepers at our club.</p>
<p>“Zac has almost 50 Cymru Premier games under his belt now, and we look forward to many more at Haverfordwest County.”</p>
<p><em>Zac is kindly sponsored by Cleddau Casuals</em></p>',
            'post_excerpt' => 'Super Zac extends his stay at the Ogi Bridge Meadow!',
            'post_status'  => 'publish',
            'post_category'=> array($category->term_id) // Set the category by term_id
        ));
        if ($post_id1 && !is_wp_error($post_id1)) {
            $image_name1 = 'zaccontractFI.jpg'; // Name of the image in the 'hwc-images' folder
            $image_url1 = $image_base_url . $image_name1;
            $image_id1 = hwc_create_image($image_url1, $post_id1);
            set_post_thumbnail($post_id1, $image_id1);

            // Set the post's tags
            $tags = array('First Team', 'Zac Jones'); // Tags for the post
            wp_set_post_tags($post_id1, $tags, true); // true for appending tags
        }
    
        // Post 2
       /* $post_id2 = wp_insert_post(array(
            'post_title'   => 'Title for Post 2',
            'post_content' => '<p>Description for Post 2.</p>',
            'post_excerpt' => 'Excerpt for Post 2.',
            'post_status'  => 'publish',
            'post_category'=> array(get_cat_ID('match-report')) // 'match-report' category
        ));
        if ($post_id2 && !is_wp_error($post_id2)) {
            $image_name2 = 'image2.jpg'; // Name of the image in the 'hwc-images' folder
            $image_url2 = $image_base_url . $image_name2;
            $image_id2 = hwc_create_image($image_url2, $post_id2);
            set_post_thumbnail($post_id2, $image_id2);
        }*/
    
        // Repeat for other posts (Post 3, Post 4, Post 5, etc.)
    }
    