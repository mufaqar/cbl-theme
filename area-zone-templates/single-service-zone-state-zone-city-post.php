<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

get_header();

$state = get_query_var('state');
$city = get_query_var('city');
$zipcode = get_query_var('zipcode');
$type = get_query_var('type');



$args = array(
    'post_type' => 'providers', 
    'posts_per_page' => -1,    
    'meta_query' => array(
        array(
            'key'     => 'internet_services', 
            'value'   => $zipcode,   
            'compare' => 'LIKE'   
        ),
    ),
    'tax_query' => array(
        array(
            'taxonomy' => 'providers_types',
            'field'    => 'slug',
            'terms'    => $type,
        ),
    ),
);

?>



<section class="min-h-[40vh] flex items-center bg-gray-50"> 
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-col items-center">
            <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
            <?php echo $type ?> Providers in <br />
                ZIP Code <span class="text-[#ef9831]"><?php echo $zipcode ?></span>
            </h1>
            <p class="text-xl text-center font-[Roboto] my-5">Enter your zip so we can find the best <?php echo $type ?> Providers in your area:</p>
            <?php get_template_part('template-parts/filter', 'form'); ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/types', 'routing' ); ?>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10"><?php echo $type ?> Providers in <span class="text-[#ef9831]"><?php echo $zipcode ?> </span></h2>
        </div>
        <?php
        // Query the posts
            $query = new WP_Query($args);
            $i = 0;
            if ($query->have_posts()) {
                while ($query->have_posts()) { $query->the_post(); $i++; set_query_var('provider_index', $i);     
                    get_template_part( 'template-parts/provider', 'card' );
                }
            } else {
                echo 'No providers found with the specified zip code.';
            }
            // Reset post data
            wp_reset_postdata();
        ?>
        <div><p class="text-sm font-[Roboto] mt-10">*DISCLAIMER: Availability vary by service address. not all offers available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may apply.</p></div>
    </div>
</section>



<?php

get_footer();
