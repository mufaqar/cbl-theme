<?php
$query_compair = get_query_var('providers_query'); 



$city = FormatData($city);
$state = strtoupper($state);


?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">Compare <?php echo FormatData($type) ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?>, <?php echo $state ?> </span></h2>
            <p class="PClass"> Still can’t decide? Use our side-by-side comparison chart to make an informed decision.
            </p>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
                <div class="w-full h-auto rounded-t-md rounded-b-md flex md:flex-row flex-row items-stretch">
                    <div class="md:w-96 min-w-[50px]  bg-[#215690] htable">
                        <div
                            class="border-r-0 md:border-b-0 bg-gray-200 border-b md:border-r grid justify-center md:p-5 p-3 md:h-auto !h-[80px] items-center">
                            <h4 class="md:text-base text-xs text-center text-gray-200">.</h4>

                        </div>

                        <div class="ctborder">
                            <h4> Connection Type</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Max Download Speed</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Data Caps</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Contract Term</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Setup Fee</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Early Termination Fee</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Equipment Rental Fee</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Monthly Price</h4>
                        </div>
                        <div class="ctborder">
                            <h4>Order Now</h4>
                        </div>

                    </div>
                    <div class="flex  flex-row w-full md:overflow-hidden overflow-x-scroll">

                        <?php
                           $providers = [ ['id' => 1  ], ['id' => 2 ] ];
                           foreach ($providers as  $provider) {

                           $i = $provider['id'];
                          
                                    // $servicesInfo = get_field('services_info');
                                    // $type = get_query_var('type');
                                    // $isSpeed = $type === "tv";
                                    // if($isSpeed){
                                    //     $speed =  $servicesInfo["tv_services"]["summary_speed"];
                                    //     $feature =  $servicesInfo["tv_services"]["summary_features"];
                                    //     $price =  $servicesInfo["tv_services"]["price"];
                                    // }else{
                                    //     $speed =  $servicesInfo["internet_services"]["summary_speed"];
                                    //     $feature =  $servicesInfo["internet_services"]["summary_features"];
                                    //     $price =  $servicesInfo["internet_services"]["price"];
                                    // }

                                    // $internet_services =  $servicesInfo["internet_services"];
                                    // $home_security_services =  $servicesInfo["home_security_services"];
                                    // $landline_services =  $servicesInfo["landline_services"];
                                    // $tv_services =  $servicesInfo["tv_services"];
                                    // $internet_tv_bundles =  $servicesInfo["internet_tv_bundles"];
            
                                //  var_dump($internet_services);
                                // $price =  $internet_services['price'];
                                // $setup_fee =  $internet_services['setup_fee'];
                                // $connection_type =  $internet_services['connection_type'];
                                // $early_termination_fee =  $internet_services['early_termination_fee'];
                                // $equipment_rental_fee =  $internet_services['equipment_rental_fee'];
                                // $contract =  $internet_services['contract'];
                                // $data_caps =  $internet_services['data_caps'];

                            ?>
                        <div class="min-w-[120px] md:w-full dtable">
                            <div
                                class="w-full bg-gray-200 md:border-r border-r-0 md:border-b-0 border-b border grid justify-center md:p-2 md:h-auto !h-[80px] items-center ">
                                <div>
                                    <select id="provider_<?php echo $i ?>" name="provider_<?php echo $i ?>"
                                        data-target="dtable_<?php echo $i ?>"
                                        class="provider-select bg-transparent border border-gray-300  text-black text-sm  outline-none border-none focus:!ring-blue-500 focus:!border-blue-500 block w-full p-[13px]">
                                        <option value="">Choose your provider</option>
                                        <?php
                                        if ($query_compair->have_posts()) {
                                            while ($query_compair->have_posts()) {
                                                $query_compair->the_post();
                                                    ?><option value="<?php echo get_the_ID(); ?>">
                                            <?php echo the_title(); ?></option><?php
                                                }
                                            } else {
                                                echo '<option>No providers found.</option>';
                                            }
                                            wp_reset_postdata();
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="dtable_<?php echo $i ?>">
                                <div class="provider-item">
                                    <p>Satellite</p>
                                </div>
                                <div class="provider-item">
                                    <p><?php echo $speed ?> Mbps</p>
                                </div>
                                <div class="provider-item ">
                                    <p><?php echo $connection_type ?></p>

                                </div>
                                <div class="provider-item">
                                    <p><?php echo $data_caps ?></p>

                                </div>
                                <div class="provider-item">
                                    <p><?php echo $contract ?></p>

                                </div>
                                <div class="provider-item">
                                    <p><?php echo $setup_fee?></p>

                                </div>
                                <div class="provider-item">
                                    <p><?php echo $early_termination_fee ?></p>

                                </div>
                                <div class="provider-item">
                                    <p><?php echo $equipment_rental_fee ?></p>

                                </div>
                                <div class="provider-item">
                                    <p>$<?php echo $price ?></p>

                                </div>
                                <div class="provider-item">
                                    <p><a href="<?php the_permalink()?>">View
                                            Plans</a></p>

                                </div>
                            </div>
                        </div>
                        <?php
                                   # code...
                           }
                                
                             
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>