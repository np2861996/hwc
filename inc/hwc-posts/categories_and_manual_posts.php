<?php

/*--------------------------------------------------------------
	>>> Functions Action/Filter Calls
	----------------------------------------------------------------*/
add_action('after_switch_theme', 'hwc_create_categories_and_manual_posts');
add_action('acf/init', 'hwc_register_acf_fields');

/*--------------------------------------------------------------
	>>> Function for add acf custom fields to posts
	----------------------------------------------------------------*/
function hwc_register_acf_fields()
{

    if (!is_acf_pro_installed()) {
        // Return back if ACF Pro is not available
        return;
    }

    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_sidebar_card',
            'title' => 'Sidebar Card',
            'fields' => array(
                array(
                    'key' => 'field_sidebar_image',
                    'label' => 'Sidebar Card Image',
                    'name' => 'sidebar_card_image',
                    'type' => 'image',
                    'return_format' => 'url', // or 'array' if you need more details
                    'preview_size' => 'medium',
                ),
                array(
                    'key' => 'field_sidebar_title',
                    'label' => 'Title',
                    'name' => 'sidebar_card_title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_sidebar_button',
                    'label' => 'Button',
                    'name' => 'sidebar_card_button',
                    'type' => 'link',
                    'instructions' => 'Enter URL for the button',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post', // Adjust this for your custom post type
                    ),
                ),
            ),
        ));
    }
}

/*--------------------------------------------------------------
>>> Function for create dummy posts
----------------------------------------------------------------*/
function hwc_create_categories_and_manual_posts()
{
    if (!is_acf_pro_installed()) {
        // Return back if ACF Pro is not available
        return;
    }

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

    // Define post details
    $posts = array(
        // Example Post 1
        array(
            'title' => 'Zac Jones agrees new one-year deal with the Bluebirds',
            'content' => '<p><strong>Haverfordwest County AFC are delighted to confirm that Zac Jones has signed a new one-year contract with the club.</strong></p>
<p>The goalkeeper arrived at the Ogi Bridge Meadow in January 2022, and has gone on to establish himself as one of the most important players in recent times.</p>
<p>After making his first team debut in the 3-0 victory over Airbus UK Broughton in August 2022, Zac has gone on to make a total of 53 appearances in all competitions for the Town, and has been involved in plenty of big moments during that time.</p>
<p>The New Zealander played a vital role in helping to end our 19-year wait to return to Europe, as his penalty save in normal time of the play-off semi-final victory at Cardiff Metropolitan, followed by two more saves in the shoot-out, were backed up by yet another spot-kick save in the final at Newtown – a day never to be forgotten by those who were in attendance.</p>
<blockquote><p>“I’ve really enjoyed my time here, I feel I’ve gained a lot of experience.”</p></blockquote>
<figure class="post-content-image post-content-image-has-caption alignnone">
    <img decoding="async" class="wp-image-9561" src="' . $image_base_url . '/2023-07-20-Haverfordwest-County-v-KF-Shkendija-67-1.jpg?class=large" alt="" width="600" height="400">
    <figcaption class="caption">Zac celebrates saving a penalty against KF Shkëndija in the UEFA Europa Conference League qualifier at the Cardiff City Stadium. (Pic by John Smith/FAW)</figcaption>
</figure>
<p>A new deal was penned shortly after our European qualification, taking him up until the end of the current campaign.</p>
<p>His heroics didn’t end there, though, as he came up trumps once more in the UEFA Europa Conference League first qualifying round victory over European regulars KF Shkëndija, as he pulled off two more penalty saves – including the match-winner – on what was undoubtedly the greatest night in the club’s 125-year history.</p>
<div class="nwVKo">
<div class="loJjTe">His strong displays between the posts continued into the 2023-24 campaign, where he has been one of our most consistent performers across the season to date, and Bluebirds fans can now look forward to having him at the Ogi Bridge Meadow for another year to come.</div>
<div>
<figure class="post-content-image post-content-image-has-caption alignnone">
    <img decoding="async" class="wp-image-9562" src="' . $image_base_url . '/2023-07-20-Haverfordwest-County-v-KF-Shkendija-11.jpg?class=large" alt="" width="600" height="400">
    <figcaption class="caption">Zac walks out of the Cardiff City Stadium tunnel alongside fellow goalkeeper, Ifan Knott. (Pic by John Smith/FAW)</figcaption>
</figure>
</div>
</div>
<p><strong>Upon signing his new contract, Zac said: </strong>“I’m pleased to have signed on for another year here at the club.</p>
<p>“I’ve really enjoyed my time here, I feel I’ve gained a lot of experience. The European qualifiers were definitely a highlight, but speaking on behalf of all the boys, we want to experience that again.</p>
<p>“The next few months are really important. I think it’s clear we are not in the position we want to be as a club, but we need to make sure we secure this play-off spot.</p>
<p>“I’m excited for next season, I’m sure we’ll be competing right at the top of the table.”</p>
<p><strong>Commenting on the news, manager Tony Pennock said:&nbsp;</strong>“We’re delighted that Zac has agreed a new deal with the club.</p>
<p>“He’s been fantastic for us since joining, particularly his performances last season and this season in Europe, he’s been exceptional for us.</p>
<p>“He’s a great goalkeeper who has a fantastic future ahead of him, so it’s great that we can continue to build on what we’ve achieved so far with him.”</p>
<p><strong>The club would like to wish Zac all the best for the new season, and we look forward to seeing him in action again soon!</strong></p>',
            'excerpt' => 'Super Zac extends his stay at the Ogi Bridge Meadow!',
            'category' => 'club-news',
            'tags' => array('First Team', 'Zac Jones'),
            'image' => 'zaccontractFI.jpg',
            'acf' => array(
                'sidebar_card_image' => 'maxresdefault.jpg',
                'sidebar_card_title' => 'Watch our club documentary series!',
                'sidebar_card_button' => array(
                    'url' => 'https://www.youtube.com/playlist?list=PL0hgLwiLgTW3BfrWwI8hYydy8RZzprmjX',
                    'title' => 'Click here for full playlist! '
                )
            )
        ),
        // Add more posts here with similar structure
        array(
            'title' => 'Zac Jones agrees new one-year deal with Haverfordwest County',
            'content' => '<p><strong>Haverfordwest County AFC are delighted to confirm that goalkeeper Zac Jones has agreed a new one-year deal with the club, which takes him through to the end of the 2023-24 season!</strong></p>
<p>Hailing from Wellington, Jones arrived at the Ogi Bridge Meadow in January 2022 and has since made 25 appearances for the Bluebirds, keeping eight clean sheets along the way.</p>
<p>The New Zealander’s performances in 2022-23, and in particular during the European play-offs – where he played a major role in the club qualifying for continental football for the first time since 2004 – have seen him become a hugely popular figure amongst the club’s supporters.</p>
<p>The 22-year-old’s penalty save from Eliot Evans in normal time in the semi-final, which was followed by two more in a dramatic 4-3 shoot-out victory over Cardiff Metropolitan, were the defining moments of a remarkable goalkeeping display in the capital.</p>
<p>On the crest of a wave, he was able to carry this momentum into the final against Newtown at Latham Park, where he made a couple of important stops inside the 90 minutes, before saving the opening spot-kick from Aaron Williams and winning the psychological battle with Henry Cowans, who dragged his effort wide of Jones’ right post.</p>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img decoding="async" class="wp-image-8362" src="' . $image_base_url . '/2023-05-13-Newtown-AFC-vs-Haverfordwest-County-AFC-253.jpg" alt="" >
	<figcaption class="caption">NEWTOWN, POWYS, WALES – 13th MAY 2023 – Haverfordwest celebrate winning the penalty shoot-out during Newtown AFC vs Haverfordwest County AFC in the JD Cymru Premier European Play-Off final at Latham Park, Newtown (Pic by Sam Eaden/FAW)</figcaption>
</figure>

<p>Having admitted that he needed time to adapt to the physicality of the JD Cymru Premier, Jones visibly grew in confidence as the season progressed to become a commanding presence in between the sticks – and he can now look forward to competing on the European stage for the first time, and continuing to help Haverfordwest County in their push for a top six finish next term.</p>
<p><strong>Speaking after putting pen to paper, Jones said</strong>: “I’m delighted to stay on for another year with the club. After last week it was made a very easy decision for me.</p>
<p>“[On the European challenge ahead] It’s really exciting, I’m still on a bit of a high now and I don’t think that will wear off any time soon. I’m looking forward to next season where we will certainly be pushing towards the top end of the table. I think we’ve done enough to prove that to everyone over the last five months or so.</p>
<p>“The fans have been brilliant all of last season, and I can’t wait to get back out there in front of them soon.”</p>',
            'excerpt' => 'Super Zac signs on for another year with the Bluebirds!',
            'category' => 'club-news',
            'tags' => array('First Team', 'Zac Jones'),
            'image' => '2023-05-13-Newtown-AFC-vs-Haverfordwest-County-AFC-247.jpg',
            'acf' => array(
                'sidebar_card_image' => '',
                'sidebar_card_title' => '',
                'sidebar_card_button' => array(
                    'url' => '',
                    'title' => ''
                )
            )
        ),
        // Example for additional posts...
        array(
            'title' => 'Keeper Jones the hero as Bluebirds reach maiden European play-off final',
            'content' => '<p><strong>Zac Jones produced a remarkable goalkeeping display as Haverfordwest County defeated Cardiff Metropolitan 4-3 on penalties at Cyncoed Campus to reach the JD Cymru Premier European play-off final.</strong></p>
<p>The inspired New Zealand stopper saved Eliot Evans’ penalty in normal time and thwarted Sam Jones late in extra time before denying the Students twice more in the shoot-out to help the Bluebirds to a dramatic victory in the capital.</p>
<p>There was nothing to separate the teams in normal time, as they largely cancelled one another out. There were a couple of opportunities for both sides to take the initiative in normal time, but the game always seemed destined to be decided by penalties.</p>
<p>With the tense shoot-out tied at 3-3, substitute Elliott Dugan converted what was ultimately the decisive spot-kick to send the travelling supporters – who arrived in Cardiff in great numbers – into delirium, and giving them one more away day in what was been a rollercoaster season.</p>
<p>Following their maiden play-off victory, County will now face Newtown – who saw off Bala Town 4-2 on Friday night – for a place in the first qualifying round of the UEFA Europa Conference League. The game will take place at Latham Park on Saturday May 13 (Kick-off: 5.15pm), <a href="https://haverfordwestcountyafc.com/2023/05/free-entry-to-european-play-off-final-at-latham-park/">with entry free for all spectators</a>.</p>
<p>Manager Tony Pennock made five changes to the team that ended the regular season with a 4-1 victory at Airbus UK Broughton, with Rhys Abbruzzese, Corey Shephard, Jamie Veale and Dan Hawkins coming into the side, while Dylan Rees returned to skipper the Town.</p>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img loading="lazy" decoding="async" class="wp-image-8311" src="' . $image_base_url . '/060522_Cardiff-Met-v-Haverfordwest-County_44.jpg" alt="" >
	<figcaption class="caption">Cardiff, Wales – 6th May 2023:<br>Jordan Davies of Haverfordwest County in action against Emlyn Lewis of Cardiff Met.<br>Cardiff Metropolitan University v Haverfordwest County in the JD Cymru Premier Playoff Semi Final at Cyncoed Campus on the 6th May 2023. (Pic by Lewis Mitchell/FAW)</figcaption>
</figure>

<p>Although County had started the game well, the first opportunity fell to the hosts as Tom Price’s effort from 25 yards was palmed away by Jones, with Dylan Rees seeing his shot from the same distance also pushed to safety by Alex Lang four minutes later.</p>
<p>The Bluebirds came agonisingly close to taking the lead just a minute later when a pinpoint ball into the area from Jack Wilson picked out Jordan Davies, who saw his looping header go just over the crossbar with Lang stranded well off his line.</p>
<p>Pennock’s men were in control for large periods of the first half, and they came close to going ahead with half-time approaching when Davies’ attempted cross was blocked, before the ball returned to his path and he sent a curling effort agonisingly over the bar from the right side of the area.</p>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img loading="lazy" decoding="async" class="wp-image-8312" src="' . $image_base_url . '/060522_Cardiff-Met-v-Haverfordwest-County_164.jpg" alt="" >
	<figcaption class="caption">Cardiff, Wales – 6th May 2023:<br>Haverfordwest County supporters during the first half.<br>Cardiff Metropolitan University v Haverfordwest County in the JD Cymru Premier Playoff Semi Final at Cyncoed Campus on the 6th May 2023. (Pic by Lewis Mitchell/FAW)</figcaption>
</figure>

<p>Keen to continue where they left off as the second-half began, Veale had a free-kick from just outside the area saved by the diving Lang six minutes after the restart.</p>
<p>Christian Edwards’ side were certainly much-improved after the restart, as they began to get more of a foothold in the game, however the Bluebirds defence was standing tall against their physical threat from set-pieces.</p>
<p>With goalmouth action few and far between, the Archers were given the chance to go ahead with 20 minutes left on the clock when Henry Jones was penalised for a foul on Price inside the area, however Jones produced an outstanding save to deny Evans and keep the score at 0-0.</p>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img loading="lazy" decoding="async" class="wp-image-8313" src="' . $image_base_url . '/060522_Cardiff-Met-v-Haverfordwest-County_166.jpg" alt="" >
	<figcaption class="caption">Cardiff, Wales – 6th May 2023:<br>Dylan Rees of Haverfordwest County in action.<br>Cardiff Metropolitan University v Haverfordwest County in the JD Cymru Premier Playoff Semi Final at Cyncoed Campus on the 6th May 2023. (Pic by Lewis Mitchell/FAW)</figcaption>
</figure>

<p>The remainder of normal time was rather cagey, with neither side wanting to make a costly error, and, Wilson’s first-time effort which crept through a wall of bodies before being gathered by Lang aside, there were no further opportunities as the match moved into extra time.</p>
<p>The hosts had the first chance of the additional 30 minutes when, in the 98th minute, Sam Jones headed just wide from a cross. Then, in the final minute of the first-half, Price’s effort from way out hit the bar and went over, much to the relief of the Town.</p>
<p>There was only one moment of note in the second half of extra time, and it proved to be a decisive one as Sam Jones was played through one-on-one with namesake Jones, but the Kiwi made another brilliant save to deny the striker’s effort from inside the area and ensure the game would be decided by penalty kicks.</p>
<p>The tension inside the ground was palpable, and the pressure was cranked up another notch as the shoot-out began. Kyle McCarthy was first up, but his spot-kick was saved by the legs of Jones to give Haverfordwest County the ideal start, before Dylan Rees made no mistake by firing into the left-hand corner to give the Bluebirds a 1-0 lead.</p>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img loading="lazy" decoding="async" class="wp-image-8314" src="' . $image_base_url . '/060522_Cardiff-Met-v-Haverfordwest-County_62.jpg" alt="" >
	<figcaption class="caption">Cardiff, Wales – 6th May 2023:<br>Haverfordwest goalkeeper Zac Jones saves a penalty.<br>Cardiff Metropolitan University v Haverfordwest County in the JD Cymru Premier Playoff Semi Final at Cyncoed Campus on the 6th May 2023. (Pic by Lewis Mitchell/FAW)</figcaption>
</figure>

<p>Things got even better when Lewis Rees was denied by the seemingly-unbeatable Jones, who dived low to his left to make the save. Jack Leahy, who had earlier come on as a substitute, sent his penalty in off the crossbar to make it 2-0 and strengthen the Town’s advantage.</p>
<p>CJ Craven got the Students off the mark at the third time of asking, but the margin of County’s lead was maintained when Davies slotted home from 12 yards.</p>
<p>Sam Jones found the left corner to keep the Archers’ hopes alive, and the drama continued as Henry Jones missed the chance to end the shoot-out when Lang denied the midfielder.</p>
<p>Jack Veale then found the net to send the shoot-out to a 10th spot-kick, and Dugan cooly sent Lang the wrong way to spark jubilant scenes from the ecstatic Haverfordwest County fans behind the goal and around the ground, as the Town celebrated reaching the play-off final for the first time in the club’s history.</p>

<figure class="post-content-image post-content-image-has-caption alignnone">
	<img loading="lazy" decoding="async" class="wp-image-8315" src="' . $image_base_url . '/060522_Cardiff-Met-v-Haverfordwest-County_70-1.jpg" alt="" >
	<figcaption class="caption">Cardiff, Wales – 6th May 2023:<br>Haverfordwest County celebrate at full time.<br>Cardiff Metropolitan University v Haverfordwest County in the JD Cymru Premier Playoff Semi Final at Cyncoed Campus on the 6th May 2023. (Pic by Lewis Mitchell/FAW)</figcaption>
</figure>

<p><strong>Cardiff Metropolitan: </strong>Lang, Chubb (Veale 119′), McCarthy, Lewis, Price, Evans (Rees 73′), Baker (C), Corsby (Kabongo 89′), Owen, Craven, Jones</p>
<p><strong>Substitutes not used: </strong>Manson, Davies, Roberts, Humphries</p>
<p><strong>Yellow cards: </strong>Price 110′, Craven 118′</p>
<p><strong>Haverfordwest County: </strong>Z. Jones, Wilson (Leahy 91′), Rees (C), Jenkins, Borg (Dugan 105′), Abbruzzese, Shephard (Watts 100′), Veale (Evans 91′), H. Jones, J. Davies, Hawkins (Humphreys 115′)</p>
<p><strong>Substitutes not used: </strong>Idzi, H. John</p>
<p><strong>Yellow card: </strong>Veale 52′</p>
<p><strong>Attendance: </strong>561</p>
<p><span style="text-decoration: underline;"><strong>Penalty shoot-out</strong></span></p>
<p>Kyle McCarthy misses (<strong>0-0</strong>); Dylan Rees scores (<strong>0-1</strong>); Lewis Rees misses (<strong>0-1</strong>); Jack Leahy scores (<strong>0-2</strong>); CJ Craven scores (<strong>1-2</strong>); Jordan Davies scores (<strong>1-3</strong>); Sam Jones scores (<strong>2-3</strong>); Henry Jones misses (<strong>2-3</strong>); Jack Veale scores (<strong>3-3</strong>); Elliott Dugan scores (<strong>3-4</strong>)</p>',
            'excerpt' => 'Our report of Haverfordwest County\'s 4-3 penalty shoot-out victory over Cardiff Metropolitan in the JD Cymru Premier European play-off semi-finals.',
            'category' => 'match-report',
            'tags' => array('First Team', 'Zac Jones', 'Cardiff Met Uni vs Haverfordwest County'),
            'image' => 'MetAwayReportFI.jpg',
            'acf' => array(
                'sidebar_card_image' => '',
                'sidebar_card_title' => '',
                'sidebar_card_button' => array(
                    'url' => '',
                    'title' => ''
                )
            )
        ),
        // Add more posts up to 10+...
    );

    foreach ($posts as $post_data) {
        // Check if the post with the title already exists
        $existing_post = get_page_by_title($post_data['title'], OBJECT, 'post');

        if (!$existing_post) {
            // Post does not exist, create it
            $category = get_term_by('slug', $post_data['category'], 'category');
            $post_id = wp_insert_post(array(
                'post_title'   => $post_data['title'],
                'post_content' => $post_data['content'],
                'post_excerpt' => $post_data['excerpt'],
                'post_status'  => 'publish',
                'post_author'  => 1, // Replace with the desired author ID
                'post_category' => array($category->term_id),
            ));

            if ($post_id && !is_wp_error($post_id)) {
                // Set post tags
                wp_set_post_tags($post_id, $post_data['tags'], true);

                // Set featured image
                $image_url = $image_base_url . $post_data['image'];
                $image_id = hwc_create_image($image_url, $post_id);
                set_post_thumbnail($post_id, $image_id);

                // Update tags and ACF fields
                wp_set_post_tags($post_id, $post_data['tags'], true);

                if ($post_data['acf']['sidebar_card_image']) {
                    $hwc_right_card_image_id = hwc_upload_image_from_theme($post_data['acf']['sidebar_card_image']);

                    if (!is_wp_error($hwc_right_card_image_id)) {
                        // Update the ACF field with the attachment ID
                        update_field('sidebar_card_image', $hwc_right_card_image_id, $post_id);
                    } else {
                        // Log the error message
                        error_log('Failed to upload background image: ' . $hwc_right_card_image_id->get_error_message());
                    }
                }

                if ($post_data['acf']['sidebar_card_title']) {
                    //update_field('sidebar_card_image', hwc_upload_image_from_theme($post_data['acf']['sidebar_card_image']), $post_id);
                    update_field('sidebar_card_title', $post_data['acf']['sidebar_card_title'], $post_id);
                }

                if ($post_data['acf']['sidebar_card_button']['url']) {
                    update_field('sidebar_card_button', array(
                        'url' => $post_data['acf']['sidebar_card_button']['url'],
                        'title' => $post_data['acf']['sidebar_card_button']['title'],
                    ), $post_id);
                }
            }
        }
    }
}
