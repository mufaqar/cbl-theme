<?php
    $query = get_query_var('review_query');
    $city = get_query_var('city');
    $type = get_query_var('type');
    $state = get_query_var('state');
    $city = FormatData($city);
    $state = strtoupper($state);

    function fetch_comments_by_state($state, $type) {                
        $args = [
            'meta_query' => [
                [
                    'key'   => 'state', // The meta key to filter by
                    'value' => $state,  // The meta value to match
                    'compare' => '=',   // Comparison operator
                ],
                [
                    'key'     => 'provider_type', // The second meta key
                    'value'   => $type, // The value to match
                    'compare' => '=',            // Comparison operator
                ],
            ],
        ];
        $comment_query = new WP_Comment_Query($args);
        $comments = $comment_query->get_comments();
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $star = get_comment_meta( $comment->comment_ID, 'star', true );
                $provider_type = get_comment_meta( $comment->comment_ID, 'provider_type', true );
                $comment_date = get_comment_date('F j, Y', $comment->comment_ID); // Format: June 23, 2024
                $content = esc_html($comment->comment_content);
                $content_length = strlen($content);
                $short_content = substr($content, 0, 460);

                ?>
                <div class="border-b border-gray-700 py-5 pb-7 mb-2">
                    <div>
                        <div class="">
                            <h6><?php echo $comment->comment_author ?></h6>
                        </div>
                        <div class="flex gap-1 text-sm py-4 capitalize items-center">
                            <?php echo esc_html($comment->post_title) ?> - <?php echo $provider_type ?>
                        </div>
                        <div class="flex items-center gap-1">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $fill_color = ($i <= $star) ? "#FFAC33" : "#969696"; // Set color based on the rating
                                ?>
                                <svg width="20px" height="20px" viewBox="0 0 36 36" aria-hidden="true" role="img" class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet">
                                    <path fill="<?php echo $fill_color; ?>" d="M27.287 34.627c-.404 0-.806-.124-1.152-.371L18 28.422l-8.135 5.834a1.97 1.97 0 0 1-2.312-.008a1.971 1.971 0 0 1-.721-2.194l3.034-9.792l-8.062-5.681a1.98 1.98 0 0 1-.708-2.203a1.978 1.978 0 0 1 1.866-1.363L12.947 13l3.179-9.549a1.976 1.976 0 0 1 3.749 0L23 13l10.036.015a1.975 1.975 0 0 1 1.159 3.566l-8.062 5.681l3.034 9.792a1.97 1.97 0 0 1-.72 2.194a1.957 1.957 0 0 1-1.16.379z"></path>
                                </svg>
                                <?php
                            }
                            ?>
                            <p><?php echo $comment_date ?> </p>
                        </div>
                    </div>
                    <p class="mt-4" id="comment-content-<?php echo $comment->comment_ID; ?>">
                        <?php 
                            if ($content_length > 100) {
                                echo $short_content . '... <button class="show-more text-blue-600" data-full-content="' . esc_attr($content) . '" data-comment-id="' . $comment->comment_ID . '">More</button>';
                            } else {
                                echo $content;
                            }
                        ?>
                    </p>
                </div>
                <?php
            }
        } else {
            echo 'No comments found for the specified state.';
        }
    }

?>





<section class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-2 mt-5">
        Reviews for <?php echo $type ?> providers in <span class="text-[#ef9831]"> <span class="capitalize"><?php echo $city ?>, <?php echo $state ?></span></span>
    </h2>
    <div class="mt-5">
        <?php
            fetch_comments_by_state($state, $type);
        ?>
    </div>
</section>
<!-- Review Sections -->
<section class="px-4 my-16 container mx-auto">
    <a href="/review">
    <button id="openModalBtn"
        class="border-[#EF9831] border-[2px] text-[#EF9831] p-3 px-5 rounded-lg hover:bg-[#EF9831] hover:text-white font-medium">
        Leave a Review
    </button>
    </a>
    <div class="grid gap-10"></div>
</section>

