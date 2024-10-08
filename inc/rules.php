<?php



// Step 1: Define dynamic rewrite rules for all service types
function custom_dynamic_rewrite_rules() {
    // Define the static service types
    $services = ['internet', 'tv', 'tv-internet', 'landline'];
    
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
