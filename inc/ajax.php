<?php




function load_provider_data() {
    if (!isset($_POST['provider_id']) || empty($_POST['provider_id'])) {
        wp_send_json_error(['message' => 'Invalid provider selected.']);
    }

    $provider_id = intval($_POST['provider_id']);
    $services_info = get_field('services_info', $provider_id);

    if (!$services_info) {
        wp_send_json_error(['message' => 'No services data found for the selected provider.']);
    }

    // Extract relevant details
    $speed = $services_info['internet_services']['summary_speed'] ?? 'N/A';
    $connection_type = $services_info['internet_services']['connection_type'] ?? 'N/A';
    $data_caps = $services_info['internet_services']['data_caps'] ?? 'N/A';
    $contract = $services_info['internet_services']['contract'] ?? 'N/A';
    $setup_fee = $services_info['internet_services']['setup_fee'] ?? 'N/A';
    $early_termination_fee = $services_info['internet_services']['early_termination_fee'] ?? 'N/A';
    $equipment_rental_fee = $services_info['internet_services']['equipment_rental_fee'] ?? 'N/A';
    $price = $services_info['internet_services']['price'] ?? 'N/A';
    $plan_url = get_permalink($provider_id);

    // Generate HTML with classes
    $html = '
        <div class="provider-details">
            <div class="provider-item">
                <p class="provider-label">Satellite</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">' . esc_html($speed) . ' Mbps</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">' . esc_html($connection_type) . '</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">' . esc_html($data_caps) . '</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">' . esc_html($contract) . '</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">' . esc_html($setup_fee) . '</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">' . esc_html($early_termination_fee) . '</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">' . esc_html($equipment_rental_fee) . '</p>
            </div>
            <div class="provider-item">
                <p class="provider-data">$' . esc_html($price) . '</p>
            </div>
            <div class="provider-item">
                <p class="provider-action"><a href="' . esc_url($plan_url) . '">View Plans</a></p>
            </div>
        </div>
    ';

    wp_send_json_success(['html' => $html]);
}
add_action('wp_ajax_load_provider_data', 'load_provider_data');
add_action('wp_ajax_nopriv_load_provider_data', 'load_provider_data');




add_action('wp_ajax_get_provider_services', 'get_provider_services');
add_action('wp_ajax_nopriv_get_provider_services', 'get_provider_services');

function get_provider_services() {
    // Validate provider ID from POST request
    $provider_id = isset($_POST['provider_id']) ? intval($_POST['provider_id']) : 0;

    if ($provider_id) {
        // Fetch associated taxonomy terms for the given provider
        $terms = wp_get_post_terms($provider_id, 'providers_service_types');

        if (!is_wp_error($terms) && !empty($terms)) {
            // Generate HTML for the dropdown options
            $html = '<option value="">Choose Service</option>';
            foreach ($terms as $term) {
                $html .= sprintf(
                    '<option value="%s">%s</option>',
                    esc_attr($term->slug),
                    esc_html($term->name)
                );
            }
            wp_send_json_success(['html' => $html]); // Send response with the HTML
        } else {
            wp_send_json_error(['message' => 'No services found for the selected provider.']);
        }
    } else {
        wp_send_json_error(['message' => 'Invalid provider ID.']);
    }

    wp_die(); // Always terminate after handling an AJAX request
}




function handle_review_submission() {
    parse_str($_POST['formData'], $form_data); // Parse serialized form data

    // Validate required fields
    if (isset($form_data['provider'], $form_data['fname'], $form_data['lname'], $form_data['comment'])) {

        
        
        // Validate CAPTCHA
        // $captcha_response = sanitize_text_field($form_data['g-recaptcha-response']);
        // $captcha_secret = '6LcFlZ8qAAAAAI-0qbWTYJRk7vctVWIDFsV-1t93'; // Replace with your reCAPTCHA secret key
        // $captcha_verify_response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
        //     'body' => [
        //         'secret' => $captcha_secret,
        //         'response' => $captcha_response,
        //     ],
        // ]);

        // if (is_wp_error($captcha_verify_response)) {
        //     wp_send_json_error('CAPTCHA verification failed.');
        //     return;
        // }

        // $captcha_result = json_decode(wp_remote_retrieve_body($captcha_verify_response), true);
        // if (!$captcha_result['success']) {
        //     wp_send_json_error('CAPTCHA validation failed. Please try again.');
        //     return;
        // }

        // Sanitize data
        $provider = sanitize_text_field($form_data['provider']);
        $first_name = sanitize_text_field($form_data['firstName']);
        $last_name = sanitize_text_field($form_data['lastName']);
        $street = sanitize_text_field($form_data['street']);
        $city = sanitize_text_field($form_data['city']);
        $state = sanitize_text_field($form_data['state']);
        $zipcode = sanitize_text_field($form_data['zipcode']);
        $comment_content = sanitize_textarea_field($form_data['comment']);
        $service = sanitize_textarea_field($form_data['service']);
        $rating = sanitize_textarea_field($form_data['rating']);
        $ucity = sanitize_textarea_field($form_data['ucity']);
        $ustate = sanitize_textarea_field($form_data['ustate']);
        
        $user_city_state = $ucity . ", " . $ustate;

        // Insert comment data
        $comment_data = array(
            'comment_post_ID' => $provider, // Provider as the post ID
            'comment_author' => $first_name . ' ' . $last_name,
            'comment_content' => $comment_content,
            'comment_type' => 'review',
            'comment_approved' => 0, // Automatically approve the comment
        );

        $comment_id = wp_insert_comment($comment_data);

        if ($comment_id) {
            // Add custom meta fields
            add_comment_meta($comment_id, 'commnt_street_address', $street);
            add_comment_meta($comment_id, 'city', $city);
            add_comment_meta($comment_id, 'state', $state);
            add_comment_meta($comment_id, 'zipcode', $zipcode);
            add_comment_meta($comment_id, 'provider_type', $service);
            add_comment_meta($comment_id, 'star', $rating);
            add_comment_meta($comment_id, 'comment_city', $user_city_state);

            wp_send_json_success('Review submitted successfully!');
        } else {
            wp_send_json_error('There was an error submitting the review.');
        }
    }
}



// Add AJAX actions for logged-in and non-logged-in users
add_action('wp_ajax_submit_review', 'handle_review_submission');
add_action('wp_ajax_nopriv_submit_review', 'handle_review_submission');


