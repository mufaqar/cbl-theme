<?php
/** Template Name: Testing propose */
 get_header();


 $args = array(
    'post_type' => 'providers', // Adjust the post type as needed
    'posts_per_page' => 1, // Retrieve all posts
);

 $query = new WP_Query($args);

 if ($query->have_posts()) {
     while ($query->have_posts()) {
         $query->the_post();
         $post_id = get_the_ID();
 
         // Get existing meta
         $existingMeta = get_post_meta($post_id, 'internet_services', true);
 
         // Check if the meta exists and process it
         if (!empty($existingMeta) && is_array($existingMeta)) {
             foreach ($existingMeta as $key => $value) {
                 // Generate a unique meta key for the zone
                 $zoneMetaKey = "provider_zone_" . $value;

               //  update_post_meta($post_id, 'provider_zone', $value);

               //  echo $zoneMetaKey . "<br/>";
 
                 
             }
         }
     }
 
     wp_reset_postdata();
 }
 


?>