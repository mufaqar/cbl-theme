<?php



// Step 1: Define dynamic rewrite rules for all service types
function custom_dynamic_rewrite_rules() {
    // Define the static service types
    $services = ['internet', 'tv', 'home-security', 'landline'];
    
    foreach ($services as $service) {
        // Pattern for full URL: /service/zone_state/zone_city/post_slug
        add_rewrite_rule(
            '^' . $service . '/([^/]+)/([^/]+)/([^/]+)/?$',
            'index.php?post_type=area_zone&service=' . $service . '&zone_state=$matches[1]&zone_city=$matches[2]&post_slug=$matches[3]',
            'top'
        );

        // Pattern for: /service/zone_state/zone_city
        add_rewrite_rule(
            '^' . $service . '/([^/]+)/([^/]+)/?$',
            'index.php?post_type=area_zone&service=' . $service . '&zone_state=$matches[1]&zone_city=$matches[2]',
            'top'
        );

        // Pattern for: /service/zone_state
        add_rewrite_rule(
            '^' . $service . '/([^/]+)/?$',
            'index.php?post_type=area_zone&service=' . $service . '&zone_state=$matches[1]',
            'top'
        );

        // Pattern for: /service
        add_rewrite_rule(
            '^' . $service . '/?$',
            'index.php?post_type=area_zone&service=' . $service,
            'top'
        );
    }
}
add_action('init', 'custom_dynamic_rewrite_rules');


add_action('template_redirect', function () {
    // Get the current URL path
    $current_url = $_SERVER['REQUEST_URI'];

    // Check if the URL contains 'zip-' 
    if (preg_match('/zip-\d+/', $current_url)) {
        // Trigger a 404 error
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        // Optionally load the 404 template
        include(get_query_template('404'));
        exit;
    }
});


// Step 2: Register custom query variables to ensure WordPress recognizes them
function add_custom_query_vars($vars) {
    $vars[] = 'service';
    $vars[] = 'zone_state';
    $vars[] = 'zone_city';
    $vars[] = 'post_slug';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars');

// Step 3: Modify the permalink structure to include service, zone_state, and zone_city in the URL
function add_custom_prefix_to_area_zone_slug($post_link, $post) {
    if ($post->post_type == 'area_zone') {
        // Get the zone_city and zone_state terms associated with the post
        $zone_state_terms = wp_get_post_terms($post->ID, 'zone_state');
        $zone_city_terms = wp_get_post_terms($post->ID, 'zone_city');

        $zone_state_slug = !empty($zone_state_terms) ? $zone_state_terms[0]->slug : 'no-state';
        $zone_city_slug = !empty($zone_city_terms) ? $zone_city_terms[0]->slug : 'no-city';

        // Get the service type (static) from a meta field or assign it based on the URL
        $service_type = get_post_meta($post->ID, '_service_type', true);

        // Ensure the service type is valid
        $valid_service_types = ['internet', 'tv', 'tv-internet', 'landline'];
        if (!in_array($service_type, $valid_service_types)) {
            $service_type = 'internet'; // Default to internet if none is found
        }

        // Construct the custom URL: /service/zone_state/zone_city/post_slug
        return home_url('/' . $service_type . '/' . $zone_state_slug . '/' . $zone_city_slug . '/' . $post->post_name);
    }
    return $post_link;
}
add_filter('post_type_link', 'add_custom_prefix_to_area_zone_slug', 10, 2);

// Step 4: Modify the query to fetch the correct post based on the custom URL
function custom_query_vars($query) {
    if (!is_admin() && $query->is_main_query() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] === 'area_zone') {
        if (isset($query->query_vars['service'])) {
            $query->set('post_type', 'area_zone');

            if (isset($query->query_vars['zone_state'])) {
                // Handle query based on zone_state and further levels
                if (isset($query->query_vars['zone_city'])) {
                    if (isset($query->query_vars['post_slug'])) {
                        // Full URL: /service/zone_state/zone_city/post_slug
                        $query->set('name', $query->query_vars['post_slug']);
                        $query->set('post_type', 'area_zone'); // Set post type to area_zone
                    }
                }
            }
        }
    }
}
add_action('pre_get_posts', 'custom_query_vars');

// Step 5: Dynamic template routing based on the URL structure
function custom_template_include($template) {
    // Get the query variables
    $service = get_query_var('service');
    $zone_state = get_query_var('zone_state');
    $zone_city = get_query_var('zone_city');
    $post_slug = get_query_var('post_slug');

    // Define a dynamic template directory path
    $dynamic_template_dir = 'area-zone-templates/';

    // Determine the appropriate template based on the query variables
    if ($service && $zone_state && $zone_city && $post_slug) {
        // Full URL: /service/zone_state/zone_city/post_slug
        $new_template = locate_template(array($dynamic_template_dir . 'single-service-zone-state-zone-city-post.php'));
    } elseif ($service && $zone_state && $zone_city) {
        // URL: /service/zone_state/zone_city
        $new_template = locate_template(array($dynamic_template_dir . 'single-service-zone-state-zone-city.php'));
    } elseif ($service && $zone_state) {
        // URL: /service/zone_state
        $new_template = locate_template(array($dynamic_template_dir . 'single-service-zone-state.php'));
    } elseif ($service) {
        // URL: /service
        $new_template = locate_template(array($dynamic_template_dir . 'single-service.php'));
    }

    // Return the new template if found, or default template
    return $new_template ? $new_template : $template;
}
add_filter('template_include', 'custom_template_include');

// Step 6: Flush rewrite rules (for development use only)
function custom_flush_rewrite_rules() {
    custom_dynamic_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'custom_flush_rewrite_rules');


add_action('init', function() {
    custom_dynamic_rewrite_rules();
    flush_rewrite_rules(); // Only for development purposes. Remove after testing.
});


function cbl_breadcrumb() {
    // Get the query variables from the custom rewrite rules
    $service = get_query_var('service');
    $zone_state = get_query_var('zone_state');
    $zone_city = get_query_var('zone_city');
    $post_slug = get_query_var('post_slug');
    
    // Get the current post type
    $post_type = get_post_type();

    // Start breadcrumb container with appropriate class
    echo '<div class="container mx-auto  breadcrumb">';

    // Home link
    echo '<a href="' . home_url() . '">Home</a>';

    // Check post type for custom structure
    if ($post_type === 'area_zone') {
        // Breadcrumb for 'area_zone' post type
        if ($service) {
            echo ' <a href="' . home_url('/' . $service) . '">  ' . ucwords(str_replace('-', ' ', $service)) . '</a>';
        }
        if ($zone_state) {
            echo ' <a href="' . home_url('/' . $service . '/' . $zone_state) . '"> ' . strtoupper(str_replace('-', ' ', $zone_state)) . '</a>';
        }
        if ($zone_city) {
            echo ' <a href="' . home_url('/' . $service . '/' . $zone_state . '/' . $zone_city) . '"> ' . ucwords(str_replace('-', ' ', $zone_city)) . '</a>';
        }
        if ($post_slug) {
            echo ' <span> ' . get_the_title() . '</span>';
        }
    } elseif ($post_type === 'providers') {
        // Breadcrumb for 'providers' post type
        echo ' <a href="' . home_url('/providers') . '"> Providers</a>';
        echo ' <span> ' . get_the_title() . '</span>';
    }
    elseif ($post_type === 'post') {
        // Breadcrumb for 'providers' post type
        echo ' <a href="' . home_url('/resources') . '"> Resources</a>';
        echo ' <span> ' . get_the_title() . '</span>';
    } else {
        // Default breadcrumb structure for other post types
        if (is_single()) {
            the_category(' » ');
            echo ' <span>» ' . get_the_title() . '</span>';
        } elseif (is_page()) {
            echo ' <span> ' . get_the_title() . '</span>';
        } elseif (is_search()) {
            echo ' <span> Search Results for "' . get_search_query() . '"</span>';
        }
    }
    
    // End breadcrumb container
    echo '</div>';
}



function Generate_Title_Cat() {
    global $wp_query;
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];

    return "Local $type Service Providers| CableMovers.net";
}

function Generate_Description_For_Cat() {
    global $Top_Provider_Details;
    $state = get_query_var('zone_state', '');
    $city = get_query_var('zone_city', '');
    $zipcode = get_query_var('post_slug', '');
    $type = get_query_var('service', '');
    $city = FormatData($city);
    $state = strtoupper($state);

    return "Local $type Service Providers| CableMovers.net";
}


function Generate_Canonical_Cat($canonical) {
    global $wp_query;
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];



    if($zipcode){
        return home_url("/$type/$state/$city/$zipcode/");
    }
    elseif($city){
        return home_url("/$type/$state/$city/");
    }
    elseif($state){
        return home_url("/$type/$state/");
    }
    else {
        return home_url("/$type/");
    }

}




function Generate_Title_For_Zipcode() {
    global $wp_query;
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];
    $city = FormatData($city);
    $state = strtoupper($state);

    if($type === "internet"){
        return "High Speed Internet Providers in $zipcode, $state | CableMovers.net";
    } elseif ($type === "tv") {
        return "Cable TV Providers in $zipcode, $state | CableMovers.net";
    }elseif ($type === "landline") {
        return "Landline Home Phone Service Providers in $zipcode, $state | CableMovers.net";
    }elseif ($type === "home-security") {
        return "Home Security Systems in $zipcode, $state | CableMovers.net";
    }
}

function Generate_Description_For_Zipcode() {
    $state = get_query_var('zone_state', '');
    $city = get_query_var('zone_city', '');
    $zipcode = get_query_var('post_slug', '');
    $type = get_query_var('service', '');
    $city = FormatData($city);
    $state = strtoupper($state);

    if($type === "internet"){
        return  "View all Internet service providers in $zipcode, $state. Compare Internet plans, prices and new promotions and pick the best provider that fits within your budget.";
    } elseif ($type === "tv") {
        return "Compare Cable TV providers in $zipcode, $state. View Cable TV plans and deals and choose the best provider that fits within your budget";
    }elseif ($type === "landline") {
        return "Find the best home phone service providers in $zipcode, $state. Compare providers, plans, prices and amenities to set your landline up.";
    }elseif ($type === "home-security") {
        return "Find reliable, trustworthy, and affordable home security systems in $zipcode, $state and protect your property like never before.";
    }
}

function Generate_Title_For_City() {
    global $wp_query;
    global $total_provider; 
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];
    $city = FormatData($city);
    $state = strtoupper($state);

    if($type === "internet"){
        return "Best $total_provider Internet Providers in $city, $state";
    } elseif ($type === "tv") {
        return "Best $total_provider Cable TV Providers in $city, $state";
    }elseif ($type === "landline") {
        return "Best $total_provider Landline Home Phone Providers in $city, $state";
    }elseif ($type === "home-security") {
        return "Best $total_provider Home Security System Providers in $city, $state";
    }
}

function Generate_Description_For_City() {
    global $Top_Provider_Details;
    $state = get_query_var('zone_state', '');
    $city = get_query_var('zone_city', '');
    $zipcode = get_query_var('post_slug', '');
    $type = get_query_var('service', '');
    $city = FormatData($city);
    $state = strtoupper($state);

    $top_providers = implode(', ', array_map(function ($provider, $index) {
        return ($index + 1) . ". " . $provider['title']; // Add index number
    }, $Top_Provider_Details, array_keys($Top_Provider_Details)));

    if($type === "internet"){
        return  "Home Internet Service Providers in $city, $state. $top_providers";
    } elseif ($type === "tv") {
        return "Cable TV Service Providers in  $city, $state. $top_providers";
    }elseif ($type === "landline") {
        return "Landline Home Phone Service Providers in $city, $state. $top_providers";
    }elseif ($type === "home-security") {
        return "Home Security System Providers in  $city, $state. $top_providers";
    }
}

function Generate_Title_For_State() {
    global $wp_query;
    global $total_provider; 
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];
    $state = strtoupper($state);


    if($type === "internet"){
        return "Best $total_provider Internet Providers in $state";
    } elseif ($type === "tv") {
        return "Best $total_provider Cable TV Providers in $state";
    }elseif ($type === "landline") {
        return "Best $total_provider Landline Home Phone Providers Providers in $state";
    }elseif ($type === "home-security") {
        return "Best $total_provider Home Security System Providers in $state";
    }
}

function Generate_Description_For_State() {
    global $Top_Provider_Details;
    $state = get_query_var('zone_state', '');
    $city = get_query_var('zone_city', '');
    $zipcode = get_query_var('post_slug', '');
    $type = get_query_var('service', '');

    
    $top_providers = implode(', ', array_map(function ($provider, $index) {
        return ($index + 1) . ". " . $provider['title']; // Add index number
    }, $Top_Provider_Details, array_keys($Top_Provider_Details)));


    if($type === "internet"){
        return  "Home Internet Service Providers in $state. $top_providers";
    } elseif ($type === "tv") {
        return "Cable TV Service Providers in  $state. $top_providers";
    }elseif ($type === "landline") {
        return "Landline Home Phone Service Providers in $state. $top_providers";
    }elseif ($type === "home-security") {
        return "Home Security System Providers in  $state. $top_providers";
    }
}


function Generate_Canonical_Tag($canonical) {
    global $wp_query;
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];



    if($zipcode){
        return home_url("/$type/$state/$city/$zipcode/");
    }
    elseif($city){
        return home_url("/$type/$state/$city/");
    }
    elseif($state){
        return home_url("/$type/$state/");
    }
    else {
        return home_url("/$type/");
    }

}

function generate_og_url($canonical) {
    global $wp_query;
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];

    if($zipcode){
        return home_url("/$type/$state/$city/$zipcode/");
    }
    elseif($city){
        return home_url("/$type/$state/$city/");
    }
    elseif($state){
        return home_url("/$type/$state/");
    }
    else {
        return home_url("/$type/");
    }
}




function custom_blog_permalink_structure($rules) {
    $new_rules = array(
        'resources/([^/]+)/?$' => 'index.php?name=$matches[1]', // Match blog/post_slug
    );
    return $new_rules + $rules;
}
add_filter('rewrite_rules_array', 'custom_blog_permalink_structure');

function custom_blog_post_permalink($permalink, $post) {
    if ($post->post_type === 'post') {
        $permalink = home_url('/resources/' . $post->post_name . '/');
    }
    return $permalink;
}
add_filter('post_link', 'custom_blog_post_permalink', 10, 2);

add_action('template_redirect', function () {
    if (is_singular('post')) {
        global $post;

        // Define the correct URL structure
        $correct_url = home_url('/resources/' . $post->post_name . '/');

        // Get the current URL path
        $current_url_path = untrailingslashit(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        // Get the correct URL path
        $correct_url_path = untrailingslashit(parse_url($correct_url, PHP_URL_PATH));

        // Redirect only if the paths do not match
        if ($current_url_path !== $correct_url_path) {
            wp_redirect($correct_url, 301); // Permanent redirect
            exit;
        }
    }
});




add_filter('wpseo_robots', 'yoast_no_home_noindex', 999);

function yoast_no_home_noindex($string) {
    $string = "index,follow";
    if (is_singular('area_zone')) {
        $string= "index,follow";
    }
    return $string;
}