<?php
/**
 * CBL_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CBL_Theme
 */



include_once('inc/extra_functions.php');
	// API 



	function custom_rest_endpoint_init() {
		register_rest_route('custom/v1', '/providers', array(
			'methods' => 'POST',
			'callback' => 'custom_rest_endpoint_callback',
		));
	}
	add_action('rest_api_init', 'custom_rest_endpoint_init');

		function custom_rest_endpoint_callback($request) {
		$params = $request->get_params();
		$response = array();
		if (!empty($params['internet_services'])) {
			$values = explode(',', $params['internet_services']);
			$values = array_map('trim', $values);
			$meta_query = array(
				'relation' => 'OR',
			);
			foreach ($values as $value) {
				$meta_query[] = array(
					'key'     => 'internet_services',
					'value'   => $value,
					'compare' => 'LIKE',
				);
			}
			$query_args = array(
				'post_type' => 'providers',
				'meta_query' => $meta_query,
				'posts_per_page' => -1
			);
			$providers = get_posts($query_args);
		
			
			$response['providers'] = array();
			foreach ($providers as $provider) {
				$provider_data = array(
					'id' => $provider->ID,
					'title' => $provider->post_title,			
					'pro_price' => get_post_meta($provider->ID, 'pro_price', true),
					'pro_speed' => get_post_meta($provider->ID, 'pro_speed', true),
					'pro_phone' => get_post_meta($provider->ID, 'pro_phone', true),
					'features' => get_post_meta($provider->ID, 'features', true),
					'slug' => basename(get_permalink($provider->ID)),				
					'services_info' => get_post_meta($provider->ID, 'services_info', true),
					'featured_image' => get_the_post_thumbnail_url($provider->ID),
					'providers_service_types' => get_the_terms($provider->ID, 'providers_service_types'),	
					'providers_types' => wp_get_post_terms($provider->ID, 'providers_types', array('fields' => 'slugs')),	
					'pro_offer' => get_post_meta($provider->ID, 'pro_offer', true),	
					
					'services_info_internet_services_phone' =>  get_post_meta($provider->ID, 'services_info_internet_services_phone', true),
					'services_info_internet_services_view_more' =>  get_post_meta($provider->ID, 'services_info_internet_services_view_more', true),
					
					'services_info_landline_services_phone' =>  get_post_meta($provider->ID, 'services_info_landline_services_phone', true),
					'services_info_landline_services_view_more' =>  get_post_meta($provider->ID, 'services_info_landline_services_view_more', true),
					
					'services_info_tv_services_phone' =>  get_post_meta($provider->ID, 'services_info_tv_services_phone', true),
					'services_info_tv_services_view_more' =>  get_post_meta($provider->ID, 'services_info_tv_services_view_more', true),
					
					'services_info_internet_tv_bundles_phone' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_phone', true),
					'services_info_internet_tv_bundles_view_more' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_view_more', true),
					
					'services_info_internet_services_features' =>  get_post_meta($provider->ID, 'services_info_internet_services_features', true),
					'services_info_internet_services_speed' =>  get_post_meta($provider->ID, 'services_info_internet_services_speed', true),
					'services_info_internet_services_price' =>  get_post_meta($provider->ID, 'services_info_internet_services_price', true),
					'services_info_internet_services_summary_features' =>  get_post_meta($provider->ID, 'services_info_internet_services_summary_features', true),
					'services_info_internet_services_summary_speed' =>  get_post_meta($provider->ID, 'services_info_internet_services_summary_speed', true),
					
					'services_info_landline_services_features' =>  get_post_meta($provider->ID, 'services_info_landline_services_features', true),
					'services_info_landline_services_speed' =>  get_post_meta($provider->ID, 'services_info_landline_services_speed', true),
					'services_info_landline_services_price' =>  get_post_meta($provider->ID, 'services_info_landline_services_price', true),
					'services_info_landline_services_summary_features' =>  get_post_meta($provider->ID, 'services_info_landline_services_summary_features', true),
					'services_info_landline_services_summary_speed' =>  get_post_meta($provider->ID, 'services_info_landline_services_summary_speed', true),

					'services_info_tv_services_features' =>  get_post_meta($provider->ID, 'services_info_tv_services_features', true),
					'services_info_tv_services_speed' =>  get_post_meta($provider->ID, 'services_info_tv_services_speed', true),
					'services_info_tv_services_price' =>  get_post_meta($provider->ID, 'services_info_tv_services_price', true),				
					'services_info_tv_services_summary_features' =>  get_post_meta($provider->ID, 'services_info_tv_services_summary_features', true),
					'services_info_tv_services_summary_speed' =>  get_post_meta($provider->ID, 'services_info_tv_services_summary_speed', true),

					'services_info_internet_tv_bundles_channels' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_channels', true),
					'services_info_internet_tv_bundles_features' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_features', true),
					'services_info_internet_tv_bundles_speed' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_speed', true),
					'services_info_internet_tv_bundles_price' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_price', true),
					'services_info_internet_tv_bundles_summary_channel' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_summary_channel', true),
					'services_info_internet_tv_bundles_summary_features' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_summary_features', true),
					'services_info_internet_tv_bundles_summary_speed' =>  get_post_meta($provider->ID, 'services_info_internet_tv_bundles_summary_speed', true),
					'home_security_services_installation_type' =>  get_post_meta($provider->ID, 'services_info_home_security_services_installation_type', true),
					'home_security_services_home_automation' =>  get_post_meta($provider->ID, 'services_info_home_security_services_home_automation', true),
					'home_security_services_mobile_app' =>  get_post_meta($provider->ID, 'services_info_home_security_services_mobile_app', true),
					'home_security_services_contract_term' =>  get_post_meta($provider->ID, 'services_info_home_security_services_contract_term', true),
					'home_security_services_setup_fee' =>  get_post_meta($provider->ID, 'services_info_home_security_services_setup_fee', true),
					'home_security_services_early_termination_fee' =>  get_post_meta($provider->ID, 'services_info_home_security_services_early_termination_fee', true),
					'home_security_services_type_of_monitoring' =>  get_post_meta($provider->ID, 'services_info_home_security_services_type_of_monitoring', true),
					'home_security_services_cheap_packaging' =>  get_post_meta($provider->ID, 'services_info_home_security_services_cheap_packaging', true),
					 
				
				);
				$response['providers'][] = $provider_data;
			}	
			
			
		}
		return rest_ensure_response($response);
	}




function theme_register_nav_menu() {
    register_nav_menu('primary', __('Primary Menu', 'theme-textdomain'));
}

add_action('after_setup_theme', 'theme_register_nav_menu');


function my_theme_enqueue_styles() {
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/dist/style.css', array(), null);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');





// http://localhost/clients/cbl/wp-json/custom/v1/providers?internet_services=20001,20005

// https://cblproject.cablemovers.net/wp-json/custom/v1/providers?internet_services=20001,20005


function custom_area_zone_endpoint( $request ) {
	$params = $request->get_params();
	$state = isset( $params['state'] ) ? $params['state'] : 'ae';
    $args = array(
        'post_type' => 'area_zone',
        'posts_per_page' => -1, // Retrieve all posts
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_state',
                'field' => 'slug',
                'terms' => $state, // California
            ),
        ),
    );

    $area_zones = new WP_Query( $args );

    if ( $area_zones->have_posts() ) {
        $data = array();

        while ( $area_zones->have_posts() ) {
            $area_zones->the_post();
            $data[] = array(
              
                'title' => get_the_title()
             
            );
        }

        return rest_ensure_response( $data );
    } else {
        return new WP_Error( 'no_area_zones', 'No area zones found in California.', array( 'status' => 404 ) );
    }
}

function register_custom_area_zone_endpoint() {
    register_rest_route( 'custom/v1', '/area-zones', array(
        'methods'  => 'GET',
        'callback' => 'custom_area_zone_endpoint',
    ) );
}

add_action( 'rest_api_init', 'register_custom_area_zone_endpoint' );




function city_area_zone_endpoint( $request ) {
	$params = $request->get_params();
	$state = isset( $params['state'] ) ? $params['state'] : 'ae';
    $args = array(
        'post_type' => 'area_zone',
        'posts_per_page' => -1, // Retrieve all posts
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_city',
                'field' => 'slug',
                'terms' => $state, // California
            ),
        ),
    );

    $area_zones = new WP_Query( $args );

    if ( $area_zones->have_posts() ) {
        $data = array();

        while ( $area_zones->have_posts() ) {
            $area_zones->the_post();
            $data[] = array(
              
                'title' => get_the_title()
             
            );
        }

        return rest_ensure_response( $data );
    } else {
        return new WP_Error( 'no_area_zones', 'No area zones found in California.', array( 'status' => 404 ) );
    }
}

function register_city_area_zone_endpoint() {
    register_rest_route( 'custom/v1', '/area-zones-city', array(
        'methods'  => 'GET',
        'callback' => 'city_area_zone_endpoint',
    ) );
}

add_action( 'rest_api_init', 'register_city_area_zone_endpoint' );


//custom/v1/area-zones

// http://localhost/clients/cbl/wp-json/custom/v1/area-zones
// https://cblproject.cablemovers.net/wp-json/custom/v1/area-zones?state=ca


function get_states_and_cities_data($request) {
  $args = array(
      'post_type' => 'area_zone',
      'posts_per_page' => $request['posts_per_page'],
  'offset' => $request['offset'],
  );

  $query = new WP_Query($args);
  $states_and_cities = array();

  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
          $state_terms = get_the_terms(get_the_ID(), 'zone_state');
          $city_terms = get_the_terms(get_the_ID(), 'zone_city');

          if ($state_terms && $city_terms) {
              foreach ($state_terms as $state_term) {
                  $state_name = $state_term->slug;

                  if (!isset($states_and_cities[$state_name])) {
                      $states_and_cities[$state_name] = array();
                  }
        foreach ($city_terms as $city_term) {
                      $city_name = $city_term->slug;

                      // Check if the city is not already in the array for the current state
                      if (!in_array($city_name, $states_and_cities[$state_name])) {
                          $states_and_cities[$state_name][] = $city_name;
                      }
                  }
              }
          }
      }

      wp_reset_postdata();
  }

  return $states_and_cities;
}


// Register the custom REST API endpoint
// function register_states_and_cities_endpoint() {
//   register_rest_route('custom/v1', '/states-cities', array(
//       'methods' => 'GET',
//       'callback' => 'get_states_and_cities_data',
//   ));
// }

// add_action('rest_api_init', 'register_states_and_cities_endpoint');

// add_filter( 'rest_allow_anonymous_comments', '__return_true' );

// add_action('rest_api_init', function () {
//     register_rest_route('custom/v1', '/insert-comment', array(
//         'methods' => 'POST',
//         'callback' => 'insert_comment_with_meta',
//         'permission_callback' => '__return_true', // Adjust permissions as needed
//     ));
// });

// function insert_comment_with_meta(WP_REST_Request $request) {
//     // Get parameters from the request
//     $post_id = $request->get_param('post_id');
// 	$providertype = $request->get_param('providertype');
//     $author = $request->get_param('author');
//     $author_email = $request->get_param('author_email');
//     $content = $request->get_param('content');
//     $city = $request->get_param('city');
// 	$comment_city = $request->get_param('comment_city');	
// 	$star = $request->get_param('star');
//     $state = $request->get_param('state');
//     $zipcode = $request->get_param('zipcode');
//     $streetAddress = $request->get_param('street_address');
    
//     // Validate required parameters
//     if (!$post_id || !$author || !$streetAddress || !$author_email || !$content || !$city || !$state || !$zipcode) {
//         return new WP_Error('missing_parameter', 'Missing required parameter', array('status' => 400));
//     }
    
//     // Data for the new comment
//     $commentdata = array(
//         'comment_post_ID' => $post_id,
//         'comment_author' => $author,
//         'comment_author_email' => $author_email,
//         'comment_content' => $content,
//         'comment_approved' => 1,
//     );
    
//     // Insert the comment and get the comment ID
//     $comment_id = wp_insert_comment($commentdata);
    
//     if ($comment_id) {
//         // Add meta values to the comment
//         add_comment_meta($comment_id, 'provider_type', $providertype, true);
// 		add_comment_meta($comment_id, 'city', $city, true);
//         add_comment_meta($comment_id, 'star', $star, true);
// 		add_comment_meta($comment_id, 'comment_city', $comment_city, true);
//         add_comment_meta($comment_id, 'state', $state, true);
//         add_comment_meta($comment_id, 'zipcode', $zipcode, true);
//         add_comment_meta($comment_id, 'commnt_street_address', $streetAddress, true);
//         return new WP_REST_Response(array('comment_id' => $comment_id, 'message' => 'Comment added successfully with meta values'), 200);
//     } else {
//         return new WP_Error('comment_insert_failed', 'Failed to insert comment', array('status' => 500));
//     }
// }




function handle_review_submission() {
    parse_str($_POST['formData'], $form_data); // Parse serialized form data
    
    // Validate required fields
    if (isset($form_data['provider']) && isset($form_data['firstName']) && isset($form_data['lastName']) && isset($form_data['comment'])) {
        
        // Sanitize data
        $provider = sanitize_text_field($form_data['provider']);
        $first_name = sanitize_text_field($form_data['firstName']);
        $last_name = sanitize_text_field($form_data['lastName']);
        $street = sanitize_text_field($form_data['street']);
        $city = sanitize_text_field($form_data['city']);
        $state = sanitize_text_field($form_data['state']);
        $zipcode = sanitize_text_field($form_data['zipcode']);
        $comment_content = sanitize_textarea_field($form_data['comment']);
        
        // Insert comment data
        $comment_data = array(
            'comment_post_ID' => $provider, // Provider as the post ID
            'comment_author' => $first_name . ' ' . $last_name,
            'comment_content' => $comment_content,
            'comment_type' => 'review',
            'comment_approved' => 1, // Automatically approve the comment
        );

        $comment_id = wp_insert_comment($comment_data);

        if ($comment_id) {
            // Add custom meta fields
            add_comment_meta($comment_id, 'commnt_street_address', $street);
            add_comment_meta($comment_id, 'city', $city);
            add_comment_meta($comment_id, 'state', $state);
            add_comment_meta($comment_id, 'zipcode', $zipcode);

            wp_send_json_success('Review submitted successfully!');
        } else {
            wp_send_json_error('There was an error submitting the review.');
        }
    } else {
        wp_send_json_error('Missing required fields.');
    }
}

// Add AJAX actions for logged-in and non-logged-in users
add_action('wp_ajax_submit_review', 'handle_review_submission');
add_action('wp_ajax_nopriv_submit_review', 'handle_review_submission');