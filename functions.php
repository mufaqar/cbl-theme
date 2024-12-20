<?php
/**
 * CBL_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CBL_Theme
 */

 

 function enqueue_font_awesome() {
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
include_once('inc/extra_functions.php');
include_once('inc/sitemap_functions.php');

function enqueue_slick_slider_assets() {
    // Slick CSS
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', [], '1.8.1');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', [], '1.8.1');

    // Slick JS
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], '1.8.1', true);

    // Custom Slick initialization
    wp_enqueue_script('slick-init', get_template_directory_uri() . '/js/slick-init.js', ['slick-js'], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider_assets');


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


function my_theme_enqueue_styles() {
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/dist/style.css', array(), null);
    wp_enqueue_style('custom_css', get_template_directory_uri() . '/custom.css', array(), null);
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




// Hook into WordPress initialization
add_action('init', function() {
    // Check for the save_xml query parameter
    if (isset($_GET['save_xml']) && $_GET['save_xml'] == '1') {
        $file_path = save_xml_file();
        if ($file_path) {
            echo "XML file saved to: " . esc_url($file_path);
        } else {
            echo "Failed to save XML file.";
        }
        exit; // Ensure no further output is sent
    }
});

/**
 * Function to save XML file to the sitemaps directory
 */
function save_xml_file() {
    // Define the path to the sitemaps directory
    $upload_dir = wp_upload_dir(); // Get the upload directory
    $sitemap_dir = $upload_dir['basedir'] . '/sitemaps/';
    $file_path = $sitemap_dir . 'data.xml'; 

    if (!file_exists($sitemap_dir)) {
        wp_mkdir_p($sitemap_dir);
    }

    // Start the XML output
    $xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

    // Add sample data (customize this with your actual data)
    $items = $xml->addChild('items');
    
    for ($i = 1; $i <= 10; $i++) {
        $item = $items->addChild('item');
        $item->addChild('id', $i);
        $item->addChild('name', "Item $i");
        $item->addChild('description', "Description for Item $i");
    }

    // Save the XML to the specified file path
    if ($xml->asXML($file_path)) {
        return $file_path; // Return the file path on success
    } else {
        error_log('Failed to save XML file.');
        return false; // Return false on failure
    }
}


include_once('inc/import.php');


