<?php

function enqueue_google_fonts() {
    // Enqueue the Google Fonts stylesheet
    wp_enqueue_style(
        'google-fonts-manrope', // Handle for the font
        'https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap', // Font URL
        array(), // Dependencies (none for this case)
        null // Version (use null for Google Fonts to prevent caching issues)
    );
   
}
add_action('wp_enqueue_scripts', 'enqueue_google_fonts');


include_once('cpts.php');
include_once('rules.php');
include_once('ajax.php');
//include_once('sitemap.php');

function check_header() {
    // Define the zip code you want to search for
	$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	// Parse the URL to get the path component
	$parsed_url = parse_url($current_url);
	// Break down the path into segments
	$path = trim($parsed_url['path'], '/');
	$segments = explode('/', $path);
	// Extract the required parts
	
	if (in_array($_SERVER['SERVER_NAME'], ['127.0.0.1', 'localhost', '::1'])) {
		$type = isset($segments[1]) ? $segments[1] : 'internet';     
		$state = isset($segments[2]) ? $segments[2] : null;     
		$city = isset($segments[3]) ? $segments[3] : null;     
		$zipcode = isset($segments[4]) ? $segments[4] : null;
	} else {
		$type = isset($segments[0]) ? $segments[0] : 'internet'; 
		$state = isset($segments[1]) ? $segments[1] : null;     
		$city = isset($segments[2]) ? $segments[2] : null;   
		$zipcode = isset($segments[3]) ? $segments[3] : null;
	}
	
	set_query_var('state', $state);
	set_query_var('city', $city);
	set_query_var('zipcode', $zipcode);
	set_query_var('type', $type);
}



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


function cbl_theme_setup() {
	
	load_theme_textdomain( 'cbl_theme', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'main' => esc_html__( 'Main', 'cbl_theme' ),
			'company' => esc_html__( 'Company', 'cbl_theme' ),
            'footer' => esc_html__( 'Footer', 'cbl_theme' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
    add_theme_support( 'title-tag' );


}
add_action( 'after_setup_theme', 'cbl_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cbl_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cbl_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'cbl_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cbl_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cbl_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cbl_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cbl_theme_widgets_init' );

function handle_search_providers_ajax() {
    // Check if the necessary parameters are provided
    if (isset($_POST['zip_code']) && isset($_POST['type'])) {
        $zip_code = sanitize_text_field($_POST['zip_code']);
        $type = sanitize_text_field($_POST['type']);

        // Your custom query to get providers based on zip code and selected option
        // Create a new query to search 'area_zone' posts by title
		$args = array(
			'post_type' => 'area_zone',
			'posts_per_page' => -1, // Get all posts
			'post_status' => 'publish', // Only published posts
			's' => $zip_code, // Search term
		);

        $query = new WP_Query($args);

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				// Get the terms for 'zone_city' and 'zone_state' taxonomies
				$zone_city_terms = wp_get_post_terms(get_the_ID(), 'zone_city', array('fields' => 'slugs'));
				$zone_state_terms = wp_get_post_terms(get_the_ID(), 'zone_state', array('fields' => 'slugs'));
			
				$zone_city = !empty($zone_city_terms) ? $zone_city_terms[0] : 'no-city';
				$zone_state = !empty($zone_state_terms) ? $zone_state_terms[0] : 'no-state';

				$custom_slug = $type .'/'.$zone_state . '/' . $zone_city. '/' . $zip_code;
				
				$response[] = array(
					'slug' => home_url($custom_slug),
				);
			}
		}  else {
			$response['message'] = 'No area zones found matching your search criteria.';
		}
		wp_send_json($response);
		// Reset the post data to the main query
		wp_reset_postdata();
    }

    // End the function
    wp_die();
}

// Register the AJAX actions for both logged-in and non-logged-in users
add_action('wp_ajax_search_providers', 'handle_search_providers_ajax');
add_action('wp_ajax_nopriv_search_providers', 'handle_search_providers_ajax');




function enqueue_custom_ajax_search_script() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/script.js', null, null, true);
    wp_enqueue_script('ajax-search', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
    wp_localize_script('ajax-search', 'ajaxurl', admin_url('admin-ajax.php'));
   
}
add_action('wp_enqueue_scripts', 'enqueue_custom_ajax_search_script');



function get_zipcodes_by_city($city) {
    $post_zipcodes = array(); 
	$posts = get_posts(array(
        'post_type' => 'area_zone',
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_city',
                'field'    => 'slug',
                'terms'    => $city, 
            ),
        ),
        'posts_per_page' => -1, 
    ));
    foreach ($posts as $post) {
        $post_zipcodes[] = $post->post_title; 
    }
    return $post_zipcodes;
}


function get_zipcodes_by_state($state) {
    $post_zipcodes = array(); 
	$posts = get_posts(array(
        'post_type' => 'area_zone',
        'tax_query' => array(
            array(
                'taxonomy' => 'zone_state',
                'field'    => 'slug',
                'terms'    => $state, 
            ),
        ),
        'posts_per_page' => -1, 
    ));
    foreach ($posts as $post) {
        $post_zipcodes[] = $post->post_title; 
    }
    return $post_zipcodes;
}



function create_meta_query_for_zipcodes($zip_codes_to_search, $type) {
    $meta_queries = array('relation' => 'OR');
    // Build the meta queries based on zip codes
    foreach ($zip_codes_to_search as $zip_code) {
        $meta_queries[] = array(
            'key'     => 'internet_services',
            'value'   => serialize($zip_code),
            'compare' => 'LIKE',
        );
    }

    // Build the arguments for the query
    $args = array(
        'post_type'      => 'providers', 
        'posts_per_page' => -1,
        'fields'         => 'ids', 
        'meta_query'     => $meta_queries,
        'tax_query' => array(
            array(
                'taxonomy' => 'providers_types',
                'field'    => 'slug',
                'terms'    => $type,
            ),
        ),
    );
    // Execute the query
    $query = new WP_Query($args);

    // Get the provider IDs
    $provider_ids = $query->posts;

    // Return the IDs
    return $provider_ids;
}

function short_providers_with_price($zip_codes_to_search, $type) {
    $meta_queries = array('relation' => 'OR');

    // Build the meta queries based on zip codes
    foreach ($zip_codes_to_search as $zip_code)
     {
        $meta_queries[] = array(

            'key'     => 'internet_services',
            
            'value'   => serialize($zip_code),
            'compare' => 'LIKE',
        );
    }

    // Build the arguments for the query
    $args = array(
        'post_type'      => 'providers',
        'posts_per_page' => -1,
        'meta_query'     => $meta_queries,
        'tax_query' => array(
            array(
                'taxonomy' => 'providers_types',
                'field'    => 'slug',
                'terms'    => $type,
            ),
        ),
        'meta_key' => 'pro_price', // Specify the meta key for sorting
        'orderby'  => 'ID', // Sort by numeric value
        'order'    => 'ASC', // Order from lowest to highest
    );

    return $args;
}



function register_custom_zipcode_endpoints() {
    // Endpoint for getting zip codes by city
    register_rest_route('zipcode/v1', '/city/(?P<city>[a-zA-Z0-9-]+)', array(
        'methods'  => 'GET',
        'callback' => 'get_zipcodes_by_city_callback',
        'permission_callback' => '__return_true', // Set this as needed for security
    ));

    // Endpoint for getting zip codes by state
    register_rest_route('zipcode/v1', '/state/(?P<state>[a-zA-Z0-9-]+)', array(
        'methods'  => 'GET',
        'callback' => 'get_zipcodes_by_state_callback',
        'permission_callback' => '__return_true', // Set this as needed for security
    ));
}
add_action('rest_api_init', 'register_custom_zipcode_endpoints');


// Callback for getting zip codes by city
function get_zipcodes_by_city_callback($request) {
    $city = $request['city']; // Get the city parameter from the request
    $zipcodes = get_zipcodes_by_city($city); // Use your existing function

    if (empty($zipcodes)) {
        return new WP_Error('no_zipcodes', 'No zip codes found for this city', array('status' => 404));
    }

    return rest_ensure_response($zipcodes);
}

// Callback for getting zip codes by state
function get_zipcodes_by_state_callback($request) {
    $state = $request['state']; // Get the state parameter from the request
    $zipcodes = get_zipcodes_by_state($state); // Use your existing function

    if (empty($zipcodes)) {
        return new WP_Error('no_zipcodes', 'No zip codes found for this state', array('status' => 404));
    }

    return rest_ensure_response($zipcodes);
}


//
//http://localhost/cablemovers/wp-json/custom/v1/area-zones?state=ca



function display_unique_service_types($provider_ids) {
    // Initialize an array to store the unique service types
    $all_service_types = array();

    // Check if there are any provider IDs
    if (!empty($provider_ids)) {
        foreach ($provider_ids as $provider_id) {
            // Get the terms associated with each provider
            $terms = wp_get_object_terms($provider_id, 'providers_service_types');

            // If terms are found, add them to the array
            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $term) {
                    $all_service_types[$term->term_id] = $term;
                }
            }
        }

        // If you want to output the unique terms
        if (!empty($all_service_types)) {
            $service_type_names = array_map(function($service_type) {
                return $service_type->name;
            }, $all_service_types);

            echo implode(', ', $service_type_names);
        } else {
            echo 'No service types found for the selected providers.';
        }
    } else {
        echo 'No providers match the criteria.';
    }
}


function display_service_types_details($provider_ids) {
    // Initialize an array to store the unique service types
    $all_service_types = array();

    // Check if there are any provider IDs
    if (!empty($provider_ids)) {
        foreach ($provider_ids as $provider_id) {
            // Get the terms associated with each provider
            $terms = wp_get_object_terms($provider_id, 'providers_service_types');

            // If terms are found, add them to the array
            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $term) {
                    $all_service_types[$term->term_id] = $term;
                }
            }
        }

        // If you want to output the title and description of the unique terms
        if (!empty($all_service_types)) {
            foreach ($all_service_types as $service_type) {
                ?>
                <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                    <span class="text-4xl !text-[#215690] block w-fit">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 1.5A1.5 1.5 0 0 1 7 0h2a1.5 1.5 0 0 1 1.5 1.5v11a1.5 1.5 0 0 1-1.404 1.497c.35.305.872.678 1.628 1.056A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.224-.947c.756-.378 1.277-.75 1.628-1.056A1.5 1.5 0 0 1 5.5 12.5v-11ZM7 1a.5.5 0 0 0-.5.5v11a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-11A.5.5 0 0 0 9 1H7Z"
                            ></path>
                            <path d="M8.5 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm0 2a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"></path>
                        </svg>
                    </span>
                    <h2 class="mt-4 text-xl font-bold"><span><?php echo esc_html($service_type->name); ?></span></h2>
                    <p class="mt-1 text-base">
                        <?php echo esc_html($service_type->description); ?>
                    </p>
                </div>
                <?php
            }
        } else {
            echo 'No service types found for the selected providers.';
        }
    } else {
        echo 'No providers match the criteria.';
    }
}

function count_service_types($provider_ids) {  
    $all_service_types = array();
    if (!empty($provider_ids)) {
        foreach ($provider_ids as $provider_id) {
            $terms = wp_get_object_terms($provider_id, 'providers_service_types');
            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $term) {
                    $all_service_types[$term->term_id] = $term;
                }
            }
        }
        $service_type_count = count($all_service_types);
        return $service_type_count;       
    } else {
        echo '<p>No providers match the criteria.</p>';
    }
}

function Fast_Provider_Details($provider_ids, $type) {
    $provider_details = array(); 
    
    if (!empty($provider_ids)) {      
        $query_args = array(
            'post_type'      => 'providers',
            'posts_per_page' => 2, 
            'post__in'       => $provider_ids, 
            'orderby'        => 'post__in',  
            'orderby'        => 'meta_value_num', 
            'meta_key'       => 'services_info_'.$type.'_services_summary_speed',
            'order'          => 'DESC',               
        );
        
        $query = new WP_Query($query_args);
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title(); 
                $speed = get_post_meta(get_the_ID(), 'services_info_'.$type.'_services_summary_speed', true); //services_info_internet_services_summary_speed
                $price = get_post_meta(get_the_ID(), 'services_info_'.$type.'_services_fast_price', true); // Replace with actual meta key for price
                
                // Append each provider's details as an associative array to the $provider_details array
                $provider_details[] = array(
                    'title' => $title,
                    'speed' => $speed ? $speed . ' Mbps' : 'N/A',
                    'price' => $price ? '$' . $price : 'N/A'
                );
            }
            wp_reset_postdata(); 
        } else {
            // If no posts are found, return a default array with a single "No providers found" message
            $provider_details[] = array(
                'title' => 'No providers found.',
                'speed' => 'N/A',
                'price' => 'N/A'
            );
        }
    } else {
        // If provider IDs are empty, return a default array with a single "No providers match the criteria" message
        $provider_details[] = array(
            'title' => 'No providers match the criteria.',
            'speed' => 'N/A',
            'price' => 'N/A'
        );
    }

    return $provider_details; // Return the array of provider details
}

function Best_Provider_Details($provider_ids) {
    $provider_details = array(); // Initialize an empty array to hold each provider's details

    if (!empty($provider_ids)) {      
        $query_args = array(
            'post_type'      => 'providers',
            'posts_per_page' => 2, 
            'post__in'       => $provider_ids, 
            'orderby'        => 'post__in',             
        );
        $query = new WP_Query($query_args);
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title(); 
                $speed = get_post_meta(get_the_ID(), 'services_info_internet_services_summary_speed', true); 
                $price = get_post_meta(get_the_ID(), 'services_info_landline_services_price', true); 
                $tvprice = get_post_meta(get_the_ID(), 'services_info_tv_services_price', true); 
                $high_channels = get_post_meta(get_the_ID(), 'services_info_tv_services_speed', true); 
                $low_channels = get_post_meta(get_the_ID(), 'services_info_tv_services_low_channels', true);                 
                $high_package_price = get_post_meta(get_the_ID(), 'services_info_tv_services_high_package_price', true); 

                
                $provider_details[] = array(
                    'title' => $title,
                    'speed' => $speed ? $speed . ' ' : 'N/A',
                    'price' => $price ? '$' . $price : 'N/A',
                    'tvprice' => $tvprice ? '$' . $tvprice : 'N/A',
                    'high_channels' => $high_channels ? $high_channels : 'N/A',
                    'low_channels' => $low_channels ?  $low_channels : 'N/A',
                    'high_package_price' => $high_package_price ? '$' . $high_package_price : 'N/A',
                    
                );
            }
            wp_reset_postdata(); 
        } else {
            // If no posts are found, return a default array with a single "No providers found" message
            $provider_details[] = array(
                'title' => 'No providers found.',
                'speed' => 'N/A',
                'price' => 'N/A'
            );
        }
    } else {
        // If provider IDs are empty, return a default array with a single "No providers match the criteria" message
        $provider_details[] = array(
            'title' => 'No providers match the criteria.',
            'speed' => 'N/A',
            'price' => 'N/A'
        );
    }

    return $provider_details; // Return the array of provider details
}

function Top_Provider_Details($provider_ids) {
    $provider_details = array(); // Initialize an empty array to hold each provider's details

    if (!empty($provider_ids)) {      
        $query_args = array(
            'post_type'      => 'providers',
            'posts_per_page' => 7, 
            'post__in'       => $provider_ids, 
            'orderby'        => 'post__in',             
        );
      
        
        $query = new WP_Query($query_args);
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title();
                $provider_details[] = array(
                    'title' => $title
                );
            }
            wp_reset_postdata(); 
        } else {
            $provider_details[] = array(
                'title' => 'No providers found.',
            );
        }
    } else {
        $provider_details[] = array(
            'title' => 'No providers match the criteria.',
            'speed' => 'N/A',
            'price' => 'N/A'
        );
    }

    return $provider_details; // Return the array of provider details
}



function Cheap_provider_details($provider_ids, $type) {
    $provider_details = array();  
    if (!empty($provider_ids)) {      
        $query_args = array(
            'post_type'      => 'providers',
            'posts_per_page' => 3, 
            'post__in'       => $provider_ids, 
            'orderby'        => 'post__in', 
            'orderby'        => 'meta_value_num', 
            'meta_key'       => 'services_info_'.$type.'_services_price',
            'order'          => 'ASC',       
        );
        
        $query = new WP_Query($query_args);
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title(); 
                $speed = get_post_meta(get_the_ID(), 'services_info_'.$type.'_services_speed', true); // Replace with actual meta key for speed
                $price = get_post_meta(get_the_ID(), 'services_info_'.$type.'_services_price', true); 
                $channels = get_post_meta(get_the_ID(), 'services_info_tv_services_summary_speed', true);//services_info_internet_tv_bundles_channels
                $connection = get_post_meta(get_the_ID(), 'services_info_tv_services_connection_type', true);//services_info_internet_tv_bundles_channels
                
                // Append each provider's details as an associative array to the $provider_details array
                $provider_details[] = array(
                    'title' => $title,
                    'speed' => $speed ? $speed . ' Mbps' : 'N/A',
                    'price' => $price ? '$' . $price : 'N/A',
                    'channels' => $channels ?  $channels : 'N/A',
                    'connection' => $connection ?  $connection : 'N/A',

                );
            }
            wp_reset_postdata(); 
        } else {
            // If no posts are found, return a default array with a single "No providers found" message
            $provider_details[] = array(
                'title' => 'No providers found.',
                'speed' => 'N/A',
                'price' => 'N/A'
            );
        }
    } else {
        // If provider IDs are empty, return a default array with a single "No providers match the criteria" message
        $provider_details[] = array(
            'title' => 'No providers match the criteria.',
            'speed' => 'N/A',
            'price' => 'N/A'
        );
    }

    return $provider_details; // Return the array of provider details
}


function FormatData($string) {    
    $string = str_replace('-', ' ', $string);
    $formatted_string = ucwords($string);
    return $formatted_string;
}

function render_provider_buttons($phone, $permalink) {
    if (empty($phone) && empty($permalink)) {
       
    }
    ?>
    <div class="grid gap-3 items-center justify-center p-5">
        <?php if (!empty($phone)) : ?>
            <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#215690] hover:bg-[#ef9831]" 
               href="tel:<?php echo esc_attr($phone); ?>">
                <?php echo esc_html($phone); ?>
            </a>
        <?php endif; ?>
        <?php if (!empty($permalink)) : ?>
            <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#ef9831] hover:bg-[#215690]" 
               href="<?php echo esc_url($permalink); ?>">
                View Plans
            </a>
        <?php endif; ?>
    </div>
    <?php
}

function render_provider_phone($permalink) {
    if (empty($permalink)) {
        return; 
    }
    ?>  
        <?php if (!empty($permalink)) : ?>
            <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#ef9831] hover:bg-[#215690]" 
               href="<?php echo esc_url($permalink); ?>">
                View Plans
            </a>
        <?php endif; ?>
   
    <?php
}


class Tailwind_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"ml-4 border-l pl-4 space-y-2\">\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item';
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        $output .= '<li class="' . esc_attr($class_names) . '">';
        $output .= '<a href="' . esc_url($item->url) . '" class="text-blue-600 hover:text-blue-800">';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
}




function display_features_list($features_items) {
    echo '<ul class="grid items-center justify-center">';    
    foreach ($features_items as $feature_item) {
        echo '<li class="flex gap-2 items-center">';
        echo '<svg class="min-w-[1rem] h-4 text-[#ef9831] font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
              </svg>';
        echo '<span class="text-sm">' . trim($feature_item) . '</span>';
        echo '</li>';
    }    
    echo '</ul>';
}




add_filter('manage_edit-comments_columns', function($columns) {   
    $new_columns = [];
    $position = 2; 
    $counter = 1;
    foreach ($columns as $key => $value) {   
        $new_columns[$key] = $value;      
        if ($counter === $position) {
            $new_columns['state'] = __('State', 'text-domain');
        }
        $counter++;
    }
    return $new_columns;
});

add_action('manage_comments_custom_column', function($column, $comment_ID) {
    if ($column === 'state') {      
        $meta_key = 'state'; 
        $meta_value = get_comment_meta($comment_ID, $meta_key, true);
        echo $meta_value ? esc_html($meta_value) : __('No meta value', 'text-domain');
    }
}, 10, 2);


function get_display_text_by_type($type) {
    return $type === 'home-security' ? 'Systems' : 'Providers';
}

