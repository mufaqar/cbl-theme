<?php
/**
 * Template Part: Providers Section
 *
 * Variables:
 * - $type: Type of providers (e.g., internet, landline)
 * - $city: City name
 * - $state: State name
 * - $query: WP_Query object for providers
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">
                <?php echo FormatData($type); ?> Providers in 
                <span class="text-[#ef9831]"><?php echo esc_html($city); ?>, <?php echo esc_html($state); ?></span>
            </h2>
        </div>

        <?php
        if ($query->have_posts()) {
            $i = 0; // Initialize provider index
            while ($query->have_posts()) {
                $query->the_post();
                $i++;
                set_query_var('provider_index', $i);
                get_template_part('template-parts/provider', 'card'); // Load provider card template
            }
        } else {
            echo '<p>No providers found with the specified zip codes.</p>';
        }
        // Reset post data
        wp_reset_postdata();
        ?>

        <div>
            <p class="text-sm font-[Roboto] mt-10">
                *DISCLAIMER: Availability vary by service address. Not all offers
                available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may
                apply.
            </p>
        </div>
    </div>
</section>
