<?php
$query_reviews_args = array(
    'post_type'      => 'providers',
    'posts_per_page' => -1            
);
$query = new WP_Query($query_reviews_args);
$city = FormatData($city);
$state = strtoupper($state);


?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">Compare <?php echo FormatData($type) ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?>, <?php echo $state ?> </span></h2>
                    <p class="PClass"> Still can’t decide? Use our side-by-side comparison chart to make an informed decision.</p>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
                <div
                    class="w-full h-auto rounded-t-md rounded-b-md flex md:flex-row flex-row items-stretch">
                    <div class="md:w-96 min-w-[50px]  bg-[#215690]">
                        <div
                            class="border-r-0 md:border-b-0 bg-gray-200 border-b md:border-r grid justify-center md:p-5 p-3 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-gray-200">.</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[75px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white">Connection Type</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Max Download Speed</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Data Caps</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Contract Term</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Setup Fee</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Early Termination Fee</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Equipment Rental Fee</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Monthly Price</h4>
                            </div>
                        </div>
                        <div
                            class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                            <div>
                                <h4 class="md:text-base text-xs text-center text-white mb-2">Order Now</h4>
                            </div>
                        </div>

                    </div>
                    <div class="flex  flex-row w-full md:overflow-hidden overflow-x-scroll">

                        <?php
                            $query_compair = get_query_var('providers_query');
                            if ($query_compair->have_posts()) {
                                while ($query_compair->have_posts()) {
                                    $query_compair->the_post();
                                    $i++;
                                    set_query_var('provider_index', $i);
                                    $servicesInfo = get_field('services_info');
                                    $type = get_query_var('type');
                                    $isSpeed = $type === "tv";
                                    if($isSpeed){
                                        $speed =  $servicesInfo["tv_services"]["summary_speed"];
                                        $feature =  $servicesInfo["tv_services"]["summary_features"];
                                        $price =  $servicesInfo["tv_services"]["price"];
                                    }else{
                                        $speed =  $servicesInfo["internet_services"]["summary_speed"];
                                        $feature =  $servicesInfo["internet_services"]["summary_features"];
                                        $price =  $servicesInfo["internet_services"]["price"];
                                    }

                                    $internet_services =  $servicesInfo["internet_services"];
                                    $home_security_services =  $servicesInfo["home_security_services"];
                                    $landline_services =  $servicesInfo["landline_services"];
                                    $tv_services =  $servicesInfo["tv_services"];
                                    $internet_tv_bundles =  $servicesInfo["internet_tv_bundles"];
            
                                //  var_dump($internet_services);
                                $price =  $internet_services['price'];
                                $setup_fee =  $internet_services['setup_fee'];
                                $connection_type =  $internet_services['connection_type'];
                                $early_termination_fee =  $internet_services['early_termination_fee'];
                                $equipment_rental_fee =  $internet_services['equipment_rental_fee'];
                                $contract =  $internet_services['contract'];
                                $data_caps =  $internet_services['data_caps'];

                            ?>
                        <div class="min-w-[120px] md:w-full dtable">
                            <div
                                class="w-full bg-gray-200 md:border-r border-r-0 md:border-b-0 border-b border grid justify-center md:p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <select id="provider" name="provider" class="bg-transparent border border-gray-300  text-black text-sm  outline-none border-none focus:!ring-blue-500 focus:!border-blue-500 block w-full p-[13px]">
                                        <option value="">Choose your provider</option>
                                        <?php
                                        if ($query->have_posts()) {
                                            while ($query->have_posts()) {
                                                $query->the_post();
                                                    ?><option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option><?php
                                                }
                                            } else {
                                                echo '<option>No providers found.</option>';
                                            }
                                            wp_reset_postdata();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs">Satellite</p>
                                </div>
                            </div>
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $speed ?> Mbps</p>
                                </div>
                            </div>
                            <div
                                class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center md:col-span-3">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $connection_type ?></p>
                                </div>
                            </div>
                            <div class="w-full grid md:border-r justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $data_caps ?></p>
                                </div>
                            </div>
                            <div class="w-full grid md:border-r border-b justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $contract ?></p>
                                </div>
                            </div>
                            <div class="w-full grid md:border-r border-b justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $setup_fee?></p>
                                </div>
                            </div>
                            <div class="w-full grid md:border-r border-b justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $early_termination_fee ?></p>
                                </div>
                            </div>
                            <div class="w-full grid md:border-r border-b justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><?php echo $equipment_rental_fee ?></p>
                                </div>
                            </div>
                            <div class="w-full grid md:border-r border-b justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs">$<?php echo $price ?></p>
                                </div>
                            </div>
                            <div class="w-full grid md:border-r border-b justify-center md:p-5 p-2 md:h-auto !h-[80px] items-center">
                                <div>
                                    <p class="text-center md:text-base text-xs"><a href="<?php the_permalink()?>">View
                                            Plans</a></p>
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
            </div>
        </div>
    </div>
</section>