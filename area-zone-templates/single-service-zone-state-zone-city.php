<?php

    global $wp_query;
    $state = $wp_query->query_vars['zone_state'];
    $city = $wp_query->query_vars['zone_city'];
    $zipcode = $wp_query->query_vars['post_slug'];
    $type =$wp_query->query_vars['service'];
    $zip_codes_to_search = get_zipcodes_by_city($city);
    $provider_ids = create_meta_query_for_zipcodes($zip_codes_to_search, $type);  
    $total_provider = count($provider_ids);    
    $Top_Provider_Details = Top_Provider_Details($provider_ids, $type);
    add_filter('wpseo_title', 'Generate_Title_For_City');
    add_filter('wpseo_metadesc', 'Generate_Description_For_City');
    add_filter('wpseo_canonical', 'Generate_Canonical_Tag');

    add_filter('wpseo_opengraph_url', 'generate_og_url');
    add_filter('wpseo_opengraph_title', 'Generate_Title_For_City');

    get_header();      
   
    $city = FormatData($city);
    $state = strtoupper($state);    
    $fast_provider_details = Fast_Provider_Details($provider_ids, $type);
    $cheap_provider_details = Cheap_provider_details($provider_ids,$type);
    $Best_Provider_Details = Best_Provider_Details($provider_ids);
    set_query_var('fast_provider_details', $fast_provider_details);
    set_query_var('cheap_provider_details', $Best_Provider_Details);
    set_query_var('Best_Provider_Details', $Best_Provider_Details);    
    $total_services_type = count_service_types($provider_ids); 
    if ($type == "home-security")
        {
            $meta_type = "home_security";
        }
        else {
            $meta_type = $type;
        }
    if (!empty($provider_ids)) {    
            $query_args = array(
                    'post_type'      => 'providers',
                    'posts_per_page' => -1,
                    'post__in'       => $provider_ids, 
                    'orderby'        => 'post__in',             
                );
                $query = new WP_Query($query_args);

                $query_compairs = array(
                    'post_type'      => 'providers',
                    'posts_per_page' => 2,
                    'post__in'       => $provider_ids, 
                    'orderby'        => 'post__in',             
                );
                $query_compair = new WP_Query($query_compairs);

                $query_args_cheep = array(
                    'post_type'      => 'providers',
                    'posts_per_page' => -1,
                    'post__in'       => $provider_ids, 
                    'orderby'        => 'post__in', 
                    'orderby'        => 'meta_value_num', // Order by meta value as a number
                    'meta_key'       => 'services_info_'.$meta_type.'_services_price',      // The meta key to sort by
                    'order'          => 'ASC',             
                );
                $query_cheep = new WP_Query($query_args_cheep);

                $query_args_fast = array(
                    'post_type'      => 'providers',
                    'posts_per_page' => -1,
                    'post__in'       => $provider_ids, 
                    'orderby'        => 'post__in', 
                    'orderby'        => 'meta_value_num', // Order by meta value as a number
                    'meta_key'       => 'services_info_'.$type.'_services_summary_speed',  
                    'order'          => 'DESC',             
                );
                $query_fast = new WP_Query($query_args_fast);
        
            } else {
            echo 'No providers match the criteria.';
        } 



    ?>

<section class="min-h-[40vh] flex items-center bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-col items-center">
            <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
                <?php echo FormatData($type) ?> <?php echo get_display_text_by_type($type); ?>  in<br />
                <span class="text-[#ef9831]"><?php echo $city?>, <?php echo $state?> </span>
            </h1>
            <p class="text-xl text-center font-[Roboto] my-5">Enter your zip so we can find the best <?php echo FormatData($type) ?>
            <?php echo get_display_text_by_type($type); ?>  in your area:</p>
            <?php get_template_part('template-parts/filter', 'form'); ?>
        </div>
    </div>
</section>
<?php get_template_part( 'template-parts/types', 'routing' ); ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10"><?php echo FormatData($type) ?> <?php echo get_display_text_by_type($type); ?> in 
            <span class="text-[#ef9831]"><?php echo $city?>, <?php echo $state?> </span>
            </h2>
        </div>
        <?php
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $i++;
                        set_query_var('provider_index', $i);     
                        get_template_part( 'template-parts/provider', 'card' );
                    }
                } else {
                    echo 'No providers found with the specified zip codes.';
                }                
                // Reset post data
                wp_reset_postdata();
            ?>
        <div>
            <p class="text-sm font-[Roboto] mt-10">*DISCLAIMER: Availability vary by service address. not all offers
                available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may
                apply.</p>
        </div>
    </div>
</section>



<?php 

        get_template_part( 'template-parts/section/best', 'providers' ); 
        set_query_var('cheap_provider_query', $query_cheep);
        set_query_var('cheap_provider_details', $cheap_provider_details);
        get_template_part( 'template-parts/section/cheap', 'providers' );
        if ($type === 'internet') :
            set_query_var('providers_query', $query_fast);
            get_template_part('template-parts/section/fast', 'providers');
        endif;
        
        set_query_var('query_compair', $query_compair);
        if ($type !== 'landline') :   
        set_query_var('providers_query', $query); get_template_part( 'template-parts/section/compair', 'providers' );
    endif;
        get_template_part( 'template-parts/section/text', 'providers' );
        set_query_var('providers_query', $query);get_template_part( 'template-parts/section/summary', 'providers' ); 
        if ($type !== 'home-security' && $type !== 'landline') {
            set_query_var('provider_ids', $provider_ids);
            get_template_part('template-parts/section/types', 'technology');
        }
        
        set_query_var('review_query', $query_reviews); get_template_part( 'template-parts/section/review', 'providers' );
        
?>




<?php get_footer();