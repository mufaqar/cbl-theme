<?php 


global $wp_query;

$state = $wp_query->query_vars['zone_state'];
$city = $wp_query->query_vars['zone_city'];
$zipcode = $wp_query->query_vars['post_slug'];
$type =$wp_query->query_vars['service'];
$state = strtoupper($state);


add_filter('wpseo_title', 'Generate_Title_For_Zipcode');
add_filter('wpseo_metadesc', 'Generate_Description_For_Zipcode');
add_filter('wpseo_canonical', 'Generate_Canonical_Tag', 10);
get_header(); ?>

<?php
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



$query_args_cheep = array(
    'post_type'      => 'providers',
    'posts_per_page' => -1,
    'post__in'       => $provider_ids, 
    'orderby'        => 'post__in', 
    'orderby'        => 'meta_value_num', // Order by meta value as a number
    'meta_key'       => 'services_info_'.$type.'_services_price',      // The meta key to sort by
    'order'          => 'ASC',  
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
$query_cheep = new WP_Query($query_args_cheep);




$query_args_fast = array(
    'post_type'      => 'providers',
    'posts_per_page' => -1,
    'post__in'       => $provider_ids, 
    'orderby'        => 'post__in', 
    'orderby'        => 'meta_value_num', // Order by meta value as a number
    'meta_key'       => 'services_info_internet_services_summary_speed',      // The meta key to sort by
    'order'          => 'DESC',   
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
$query_fast = new WP_Query($query_args_fast);



?>



<section class="min-h-[40vh] flex items-center bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-col items-center">
            <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
                <?php echo FormatData($type) ?> Providers in <br />
                ZIP Code <span class="text-[#ef9831]"><?php echo $zipcode ?></span>
            </h1>
            <p class="text-xl text-center font-[Roboto] my-5">Enter your zip so we can find the best
                <?php echo FormatData($type) ?>
                Providers in your area:</p>
            <?php get_template_part('template-parts/filter', 'form'); ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/types', 'routing' ); ?>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10"><?php echo FormatData($type) ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $zipcode ?> </span></h2>
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
        <div>
            <p class="text-sm font-[Roboto] mt-10">*DISCLAIMER: Availability vary by service address. not all offers
                available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may
                apply.</p>
        </div>
    </div>
</section>


<!-- Cheep ZIP Sections -->
<section class="my-8">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the Cheap
                <?php echo str_replace(['-'], ' ', $type); ?> Providers in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div
            class="md:w-full min-w-fit grid <?php if ($type !== 'home-security' && $type !== 'landline'): ?>grid-cols-3<?php else: ?> grid-cols-2 <?php endif; ?> bg-[#215690] htable">
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Provider</h4>
                </div>
            </div>

            <?php if ($type !== 'home-security' && $type !== 'landline'): ?>
            <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="tabbox_title">
                        <?php echo $type === 'internet' ? 'Max Download Speed' : '# of Channels'; ?>
                    </h4>
                </div>
            </div>
            <?php endif; ?>

            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Starting Price</h4>
                </div>
            </div>
        </div>
        <div class="grid shadow-xl">
            <?php
                if ($query_cheep->have_posts()) {
                    while ($query_cheep->have_posts()) {
                        $query_cheep->the_post();
                        $i++;
                        set_query_var('provider_index', $i);
                        $price = get_field( "pro_price" );
                        $servicesInfo = get_field('services_info');
                        if ($type == 'internet') {
                            $services = $servicesInfo["internet_services"];
                        } elseif ($type == 'tv') {
                            $services = $servicesInfo["tv_services"];
                        } elseif ($type == 'landline') {
                            $services = $servicesInfo["landline_services"];
                        } else {
                            $services = $servicesInfo["home_security_services"];
                        }
                
                    $price =  $services['price'];
                    $channels =  $services['channels']."+";
                    $summary_speed =  $services['summary_speed'];
                    $connection_type =  $services['connection_type'];
                    $cheap_package =  $services['cheap_package'];
                    $cheap_speed =  $services['cheap_speed'];
                    $contract =  $services['contract'];
            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto dtable">
                <div
                    class="md:w-full w-full grid <?php if ($type !== 'home-security' && $type !== 'landline'): ?>grid-cols-3<?php else: ?> grid-cols-2 <?php endif; ?>">
                    <div class="tborder">
                        <div>
                            <p class="tb_title"><a target="_blank" href="/providers/xfinity">
                                    <?php the_title()?> </a></p>
                        </div>
                    </div>


                    <?php if ($type !== 'home-security' && $type !== 'landline'): ?>
                    <div class="tborder">
                        <div>
                        
                                <?php echo $type === 'tv' ? $channels : $cheap_speed." Mbps"; ?>
                           
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="tborder">
                        <div>
                           $<?php echo $price ?> 
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
                    } else {
                        echo 'No providers found with the specified zip codes.';
                    }
                    
                    // Reset post data
                    wp_reset_postdata();
                ?>
        </div>
    </div>
</section>


<!-- Fast ZIP Sections -->
<?php if ($type === 'internet'): ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <?php 
                    if ($type === 'internet'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">Fastest <?php echo FormatData($type) ?> Providers in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?></span>
            </h2>

            <?php elseif ($type === 'tv'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">Highest Rated <?php echo FormatData($type) ?> Providers
                in <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span></h2>
            <p class="PClass">Below is our curated list of the cable TV providers we know that offer
                quality service and reasonable pricing. Each one has exceptional customer service and online user
                reviews so you can enjoy the football, latest films, and local TV stations you love. </p>
            <?php else: ?>
            <?php endif; ?>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-4 bg-[#215690] md:grid-cols-4 htable">
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Provider</h4>
                </div>
            </div>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Connection </h4>
                </div>
            </div>

            <div class="tborder">
                <div>
                    <h4 class="tabbox_title"><?php if ($type === 'internet'): ?> Max
                        Download Speed <?php else: ?> # of Channels <?php endif; ?></h4>
                </div>
            </div>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Upload Speed</h4>
                </div>
            </div>
        </div>
        <div class="grid shadow-xl">
            <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }

                          // var_dump($services);
                            $price =  $services['fast_price'];
                            $speed =  $services['speed'];
                            $summary_speed =  $services['summary_speed'];
                            $channels =  $services['channels'];
                            $connection_type =  $services['connection_type'];
                            $fast_package =  $services['fast_package'];
                            $upload_speed =  $services['upload_speed'];

                            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto dtable">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-4 md:grid-cols-4">
                        <div class="tborder">
                            <div>
                                <p class="tb_title"><a target="_blank"
                                    href="<?php the_permalink()?>"><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="tborder">
                            <?php echo $connection_type ?>
                        </div>
                        <div class="tborder">
                            <?php echo $type === 'tv' ? $channels : $summary_speed." Mbps"; ?>
                        </div>
                        <div class="tborder">
                            <?php echo $type === 'tv' ? $speed : $upload_speed." Mbps"; ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- What are the Best ZIP Section  -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the Best
                <?php echo str_replace(['-'], ' ', $type); ?> Providers in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div
            class="md:w-full min-w-fit grid  bg-[#215690] grid-cols-3 htable">
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Provider</h4>
                </div>
            </div>
            
            <div class="tborder col-span-2">
                <div>
                    <h4 class="tabbox_title">Best For</h4>
                </div>
            </div>
        </div>
        <div class="grid shadow-xl">
            <?php
                    if ($query_fast->have_posts()) {
                        while ($query_fast->have_posts()) {
                            $query_fast->the_post();
                            $i++;
                            set_query_var('provider_index', $i);
                            $servicesInfo = get_field('services_info');
                            if ($type == 'internet') {
                                $services = $servicesInfo["internet_services"];
                            } elseif ($type == 'tv') {
                                $services = $servicesInfo["tv_services"];
                            } elseif ($type == 'landline') {
                                $services = $servicesInfo["landline_services"];
                            } else {
                                $services = $servicesInfo["home_security_services"];
                            }

                        //var_dump($services);
                        $price =  $services['price'];
                        $summary_speed =  $services['summary_speed'];
                        $connection_type =  $services['connection_type'];
                        $fast_package =  $services['fast_package'];
                        $best_for =  $services['best_for'];
                        ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto ">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div
                        class="md:w-full w-full grid grid-cols-3 dtable">
                        <div class="tborder">
                            <div>
                                <p class="tb_heading"><a target="_blank"
                                        href="<?php the_permalink()?>"><?php the_title()?></a></p>
                            </div>
                        </div>

                  
                        <div class="tborder col-span-2">
                            <?php echo $best_for ?>
                        </div>


                    </div>
                </div>
            </div>
            <?php
                        }
                    } else {
                        echo 'No providers found with the specified zip codes.';
                    }
                    
                    // Reset post data
                    wp_reset_postdata();
                ?>
        </div>
    </div>
</section>


<!-- Fee Sections -->
<?php if ($type === 'internet'): ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the <?php echo FormatData($type) ?> Fees in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-4 bg-[#215690] md:grid-cols-4 htable">
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Provider</h4>
                </div>
            </div>
            <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="tabbox_title">Equipment Rental Fee</h4>
                </div>
            </div>
            <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="tabbox_title">Setup Fee</h4>
                </div>
            </div>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Early Termination Fee</h4>
                </div>
            </div>
        </div>
        <div class="grid shadow-xl">
            <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }



                            // var_dump($services);
                            $price =  $services['price'];
                            $early_termination_fee =  $services['early_termination_fee'];
                            $setup_fee =  $services['setup_fee'];
                            $equipment_rental_fee =  $services['equipment_rental_fee'];
                            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto dtable">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-4 md:grid-cols-4">
                        <div class="tborder">
                            <div>
                                <p class="tb_heading"><a target="_blank"
                                        href="<?php the_permalink()?>"><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="tborder">
                            $<?php echo $equipment_rental_fee ?>
                        </div>
                        <div class="tborder">
                            $<?php echo $setup_fee ?>
                        </div>
                        <div class="tborder">
                            $<?php echo $early_termination_fee ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($type === 'tv'): ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the Cable TV Fees in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690] md:grid-cols-5 htable">
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Provider</h4>
                </div>
            </div>
            <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="tabbox_title">Setup Fee</h4>
                </div>
            </div>
            <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="tabbox_title">Equipment Rental Fee</h4>
                </div>
            </div>
            <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="tabbox_title">Early Termination Fee</h4>
                </div>
            </div>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Broadcast Fee</h4>
                </div>
            </div>
        </div>
        <div class="grid shadow-xl">
            <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }



                            // var_dump($services);
                            $price =  $services['price'];
                            $early_termination_fee =  $services['early_termination_fee'];
                            $setup_fee =  $services['setup_fee'];
                            $equipment_rental_fee =  $services['equipment_rental_fee'];
                            $broadcast_tv_fee =  $services['broadcast_tv_fee'];
                            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto dtable">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-5 md:grid-cols-5">
                        <div class="tborder">
                            <div>
                                <p class="tb_heading"><a target="_blank"
                                        href="<?php the_permalink()?>"><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="tborder">
                            $<?php echo $setup_fee ?>
                        </div>
                        <div class="tborder">
                            $<?php echo $equipment_rental_fee ?>
                        </div>
                        <div class="tborder">
                            $<?php echo $early_termination_fee ?>
                        </div>
                        <div class="tborder">
                            $<?php echo $broadcast_tv_fee ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($type === 'home-security' || $type === 'landline'): ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">What are the
                <?php if ($type === 'landline'): ?>Landline Home Phone <?php endif; ?>
                <?php if ($type === 'home-security'): ?>Home Security Systems<?php endif; ?>
                Fees in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-3 bg-[#215690] md:grid-cols-3 htable">
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Provider</h4>
                </div>
            </div>
            <div class="grid border-r justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="tabbox_title">Setup Fee</h4>
                </div>
            </div>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Early Termination Fee</h4>
                </div>
            </div>
        </div>
        <div class="grid shadow-xl">
            <?php
                        if ($query_fast->have_posts()) {
                            while ($query_fast->have_posts()) {
                                $query_fast->the_post();
                                $i++;
                                set_query_var('provider_index', $i);
                                $servicesInfo = get_field('services_info');
                                if ($type == 'internet') {
                                    $services = $servicesInfo["internet_services"];
                                } elseif ($type == 'tv') {
                                    $services = $servicesInfo["tv_services"];
                                } elseif ($type == 'landline') {
                                    $services = $servicesInfo["landline_services"];
                                } else {
                                    $services = $servicesInfo["home_security_services"];
                                }



                            // var_dump($services);
                            $price =  $services['price'];
                            $early_termination_fee =  $services['early_termination_fee'];
                            $setup_fee =  $services['setup_fee'];
                            $equipment_rental_fee =  $services['equipment_rental_fee'];
                            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto dtable">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-3 md:grid-cols-3">
                        <div class="tborder">
                            <div>
                                <p class="tb_heading"><a target="_blank"
                                        href="<?php the_permalink()?>"><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="tborder">
                            $<?php echo $setup_fee ?>
                        </div>
                        <div class="tborder">
                            $<?php echo $early_termination_fee ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                            }
                        } else {
                            echo 'No providers found with the specified zip codes.';
                        }
                        
                        // Reset post data
                        wp_reset_postdata();
                    ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- Summary Of Providers -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">Summary of <?php echo str_replace(['-'], ' ', $type); ?> Providers in
                <span class="text-[#ef9831]"><?php echo $zipcode ?>, <?php echo $state ?> </span>
            </h2>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
                <div
                    class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div
                        class="md:w-full min-w-[50px] grid <?php echo $type == 'home-security' || $type == 'landline' ? 'md:grid-cols-4' : 'md:grid-cols-5'; ?> grid-cols-1 bg-[#215690] htable">
                        <div class="tborder">
                            <h4 class="tabbox_title">Provider</h4>
                        </div>
                        <div class="tborder ">
                            <h4 class="tabbox_title">
                                <?php echo $type === 'home-security'  ? 'Connection' : 'Features'; ?>
                            </h4>
                        </div>
                        <?php if (!in_array($type, ['landline', 'home-security'])) : ?>
                        <div class="tborder">
                            <h4 class="tabbox_title">
                                <?php echo $type === 'internet' ? 'Max Download Speed' : 'Channels'; ?>
                            </h4>
                        </div>
                        <?php endif ?>

                        <div class="tborder">
                            <div>
                                <h4 class="tabbox_title"> Price</h4>
                            </div>
                        </div>
                        <div class="tborder">
                            <div>
                                <h4 class="tabbox_title">Contact</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll ">

                        <?php
                            
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $i++;
                                        set_query_var('provider_index', $i);
                                        $servicesInfo = get_field('services_info');
                                        $type = get_query_var('type');
                                        $phone = get_field( "pro_phone" );

                                        $servicesInfo = get_field('services_info');
                                        if ($type == 'internet') {
                                            $services = $servicesInfo["internet_services"];
                                        } elseif ($type == 'tv') {
                                            $services = $servicesInfo["tv_services"];
                                        } elseif ($type == 'landline') {
                                            $services = $servicesInfo["landline_services"];
                                        } else {
                                            $services = $servicesInfo["home_security_services"];
                                        }

                                  // print_r($services);
                                       $phone =  $services['phone'];
                                       $view_link =  $services['view_more'];
                                       
                                        $price =  $services['price'];
                                        $channels =  $services['channels'];
                                        $summary_speed =  $services['summary_speed'];
                                        $connection_type =  $services['connection_type'];
                                        $summary_features =  $services['summary_features'];
                                        $features = $services['summary_features'];
                                        $features_items  = explode(',', $features); 
                                       
                                    ?>
                        <div
                            class="min-w-[120px] md:w-full grid <?php echo $type == 'home-security' || $type == 'landline' ? 'md:grid-cols-4' : 'md:grid-cols-5'; ?> dtable ">
                            <div class="tborder">
                                <div>
                                    <p class="tb_heading"><a target="_blank" href="<?php the_permalink()?>">
                                            <?php the_title()?> </a> </p>
                                </div>
                            </div>
                            <div class=" tborder  ">
                                <div class="tb_heading">
                                   
                                <?php
                                if ($type != 'home-security' ) {
                                    display_features_list($features_items);
                                } else {
                                    echo $connection_type;
                                }
                                ?>


                                </div>
                            </div>
                            <?php if (!in_array($type, ['landline', 'home-security'])) : ?>
                            <div class="tborder">
                                <div>
                                    <p class="tb_heading">
                                        <?php echo $type === 'tv' ? $channels : $summary_speed." Mbps"; ?>
                                    </p>
                                </div>
                            </div>
                            <?php endif ?>
                            <div class="tborder">
                                <div>
                                    <p class="tb_heading">$<?php echo $price ?>/mo</p>
                                </div>
                            </div>
                            <div class="tborder">
                                <?php echo render_provider_buttons("", $view_link); ?>
                            </div>
                        </div>
                        <?php
                                    }
                                } else {
                                    echo 'No providers found with the specified zip codes.';
                                }
                                
                                // Reset post data
                                wp_reset_postdata();
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FAQ’s -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">FAQs</h2>
        </div>
        <div class="grid gap-10">
            <?php
                // Define an array of FAQs
                $total_providers_count = $query_fast->found_posts;
                $first_provider = $query_fast->posts[0];
                $servicesInfo = get_field('services_info', $first_provider->ID);

                if ($servicesInfo) {
                    // Determine the services based on the type
                    if ($type == 'internet') {
                        $services = $servicesInfo["internet_services"];
                    } elseif ($type == 'tv') {
                        $services = $servicesInfo["tv_services"];
                    } elseif ($type == 'landline') {
                        $services = $servicesInfo["landline_services"];
                    } else {
                        $services = $servicesInfo["home_security_services"];
                    }
               
                
                    $first_provider_title = get_the_title($first_provider->ID);
                    $price = $services['price'];
                    $channels = $services['channels'] . "+";
                    $summary_speed = $services['summary_speed'];
                    

                }
                
                $faqs;
                $internet_faqs = [
                    [
                        "question" => "1. Who is the Best Internet Service Provider in $zipcode",
                        "answer" => "$total_providers_count Internet service providers are available in $zipcode Based on the availability $first_provider_title is the best internet service provider in  $zipcode"
                    ],
                    [
                        "question" => "2. Who is the fastest Internet service provider in  $zipcode?",
                        "answer" => "$first_provider_title is the fastest internet service provider in {$zipcode} and offers max download speeds up to {$summary_speed}Mbps in select areas."
                    ],
                    [
                        "question" => "3. Who is the cheapest Internet service provider in $zipcode?",
                        "answer" => "$first_provider_title is the cheapest internet service provider in {$zipcode} with price starting from {$price}"
                    ],
                    [
                        "question" => "4. What is the typical internet speed options offered in $zipcode?",
                        "answer" => "In {$zipcode} internet speed options can vary among internet service providers but most plans include speeds from 25 mbps to 5000 mbps."
                    ],
                    [
                        "question" => "5. How do I check the availability of Internet service providers in $zipcode?",
                        "answer" => "To check Internet service providers availability, <button id='changeLocationBtn2' >Enter your zip code</button> to find the best internet options available to you."
                    ]
                ];
                $tv_faqs = [
                    [
                        "question" => "1. How do I check the availability of TV service providers in $zipcode",
                        "answer" => "To check TV service providers availability, <button id='changeLocationBtn2' >Enter your zip code</button> to find the best TV options available to you."
                    ],
                    [
                        "question" => "2. How do I setup TV service in my new home in $zipcode",
                        "answer" => " To setup TV service in your new home, contact the above listed service providers, inquire about their plans and select the plan that works for you."
                    ],
                    [
                        "question" => "3. Can I get TV service without any contract in $zipcode",
                        "answer" => "Yes. A few TV service providers in {$zipcode} offer no contract or month to month services. Call the providers to know more."
                    ],
                    [
                        "question" => "4. Who is the Best TV Service Provider in $zipcode",
                        "answer" => "{$total_providers_count} TV service providers are available in {$zipcode} Based on the availability and pricing {$first_provider_title} is the best TV service provider in {$zipcode}."
                    ],
                    [
                        "question" => "5.	Who is the cheapest TV service provider in $zipcode",
                        "answer" => "{$first_provider_title} is the cheapest TV service provider in {$zipcode} with price starting from {$price}"
                    ],
                ];
                $landline_faqs = [
                    [
                        "question" => "1.	What is a Landline?",
                        "answer" => "A landline is a type of home phone service that transmits audio data over a wire (typically copper, cable or fiber) and comes with features like Caller ID, Call Forwarding, Call Blocking and Three-way calling."
                    ],
                    [
                        "question" => "2.	Who is the Best Landline Phone Service Provider in $zipcode",
                        "answer" => "$total_providers_count landline service providers are available in Zip Code {$zipcode}. Based on the availability {$first_provider_title}  is the best landline phone service provider in $zipcode"
                    ],
                    [
                        "question" => "3.	Can I get Landline Phone Service without Internet in $zipcode",
                        "answer" => "Yes. You can get a landline home phone service without internet in Zip Code $zipcode as many providers offer traditional landline phone service options which requires a separate line and don’t require an internet connection."
                    ],
                    [
                        "question" => "4.	Who is the cheapest Internet service provider in $zipcode",
                        "answer" => "{$total_providers_count} is the cheapest landline home phone service provider in Zip Code {$zipcode} with price starting from $price."
                    ],
                    [
                        "question" => "5.	How do I check the availability of Landline Phone service providers in $zipcode",
                        "answer" => "To check Landline Phone service providers availability, <button id='changeLocationBtn2' >Enter your zip code</button> to find the best Landline options available to you."
                    ],
                ];
                $home_security_faqs = [
                    [
                        "question" => "1.	What are home security systems?",
                        "answer" => "Home security systems are used to protect theft and burglaries and include a central hub, entryway sensors, glass break sensors and motion sensors, security indoor and outdoor cameras, video doorbells and home automation devices."
                    ],
                    [
                        "question" => "2.	What are the most affordable security systems in $zipcode, $state?",
                        "answer" => "(insert lowest provider name) topped our list as the most affordable home security system in $zipcode with price starting from (insert lowest provider price) per month."
                    ],
                    [
                        "question" => "3.	What are the most affordable security systems in $zipcode, $state?",
                        "answer" => "From In house 24/7 monitoring team to controlling everything from a single mobile app, Vivint is rated the best home security system in $zipcode, $state. "
                    ] ,
                    [
                        "question" => "4.	Can I install my own security system?",
                        "answer" => "While DIY is on the rise, we highly recommend professional installation for the home security systems for a seamless integration between different devices."
                    ],
                    [
                        "question" => "5.	Do I have to sign a contract for home security?",
                        "answer" => "Security companies like ADT and Vivint may require a contract while other providers such as Ring, SimpliSafe offer DIY solutions that never require a contract."
                    ],
                    [
                        "question" => "6.	What Home Security Providers are Available in $zipcode, $state?",
                        "answer" => "Availability varies for Home Security systems. To check availability, <button id='changeLocationBtn2' >Enter your zip code</button> to find the best security companies available to you."
                    ] 
                ];
 
                if ($type === 'tv'):
                    $faqs = $tv_faqs;
                elseif ($type === 'internet'):
                    $faqs = $internet_faqs;
                elseif ($type === 'landline'):
                    $faqs = $landline_faqs;
                else:
                    $faqs = $home_security_faqs;
                endif;

                // Loop through the FAQs array
                foreach ($faqs as $faq) {
                    $question = $faq['question'];
                    $answer = $faq['answer'];
            ?>
            <div
                class="faq-item w-full h-fit border border-[#F0F0F0] rounded-[10px] p-[30px] shadow-[0_15px_15px_rgba(0,0,0,0.05)]">
                <div class="faq-question flex justify-between cursor-pointer">
                    <p class="text-lg font-semibold"><?php echo $question; ?></p>
                    <span class="faq-icon text-lightBlue">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
                            class="faq-arrow transform transition duration-200 rotate-0" height="24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M474 152m8 0l60 0q8 0 8 8l0 704q0 8-8 8l-60 0q-8 0-8-8l0-704q0-8 8-8Z"></path>
                            <path d="M168 474m8 0l672 0q8 0 8 8l0 60q0 8-8 8l-672 0q-8 0-8-8l0-60q0-8 8-8Z"></path>
                        </svg>
                    </span>
                </div>
                <div class="faq-answer hidden mt-5">
                    <p class="text-base font-medium"><?php echo $answer; ?></p>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>


<?php get_template_part('template-parts/loc','model'); ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach((item) => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const arrow = item.querySelector('.faq-arrow');

        question.addEventListener('click', () => {
            // Close all other open FAQ items
            faqItems.forEach((otherItem) => {
                const otherAnswer = otherItem.querySelector('.faq-answer');
                const otherArrow = otherItem.querySelector('.faq-arrow');
                if (otherItem !== item) {
                    otherAnswer.classList.add('hidden');
                    otherArrow.classList.remove('rotate-45');
                }
            });

            // Toggle the clicked item
            answer.classList.toggle('hidden');
            arrow.classList.toggle('rotate-45');
        });
    });
});
</script>

<?php get_footer();