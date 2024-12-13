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