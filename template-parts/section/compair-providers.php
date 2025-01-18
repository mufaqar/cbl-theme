<?php
$query_compair = get_query_var('providers_query'); 
$compairs = get_query_var('query_compair'); 







//var_dump ($query_compair);



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


                        <?php
                          // echo $type;

                            // Fields definition for each category
                            $fields = [];

                            if ($type === 'internet') {
                                $fields = [
                                    'Select Provider',
                                    'Connection Type',
                                    'Max Download Speed',
                                    'Data Caps',
                                    'Contract Term',
                                    'Setup Fee',
                                    'Early Termination Fee',
                                    'Equipment Rental Fee',
                                    'Monthly Price',
                                    'Order Now',
                                ];
                            } elseif ($type === 'tv') {
                                $fields = [
                                    'Select Provider',
                                    'Connection Type',
                                    'Channels',
                                    'Free Premium Channels',
                                    'Contract',
                                    'Setup Fee',
                                    'Early Termination Fee',
                                    'Broadcast TV Fee',
                                    'Monthly Price',
                                    'Order Now',
                                ];
                            } else {
                                // Default or other category fields
                                $fields = [
                                    'Select Provider',
                                    'Installation Type',
                                    'Home Automation',
                                    'Mobile App',
                                    'Contract Term',
                                    'Setup Fee',
                                    'Early Termination Fee',
                                    'Type of Monitoring',
                                    'Monthly Price',
                                    'Order Now',
                                ];
                            }

                           
                            foreach ($fields as $field) {
                                echo " <div class='ctborder'><h4>$field</h4></div>";
                            }
                           
                            ?>


                    </div>
                    <div class="flex  flex-row w-full md:overflow-hidden overflow-x-scroll">


                        <div class="min-w-[120px] md:w-full dtable">

                            <div class="flex flex-row">


                                <?php
                          $providers = [ ['id' => 1  ], ['id' => 2 ] ];
                          foreach ($providers as  $provider) {

                          $i = $provider['id'];

                            ?>
                                <div class="provider-item md:w-1/2 w-full">
                                    <select id="provider_<?php echo $i ?>" name="provider_<?php echo $i ?>"
                                        data-type="<?php echo $type; ?>"
                                        data-target="dtable_<?php echo $i ?>"
                                        class="provider-select bg-transparent border border-gray-300  text-black text-sm  outline-none border-none focus:!ring-blue-500 focus:!border-blue-500 block w-full p-[13px]">
                                        <?php
                                            if ($query_compair->have_posts()) {
                                                $option_index = 0;
                                                while ($query_compair->have_posts()) {
                                                    $query_compair->the_post();
                                                    $option_index++;
                                                        ?><option value="<?php echo get_the_ID(); ?>" 
                                            <?php if ($i == 2 && $option_index == 2) { echo "selected"; } ?>>
                                            <?php echo the_title(); ?></option><?php
                                                    }
                                                } else {
                                                    echo '<option>No providers found.</option>';
                                                }
                                            wp_reset_postdata();
                                            ?>
                                    </select>
                                </div>
                                <?php  } ?>

                            </div>

                            <div class="flex flex-row">
                                <?php  

                                 
                                    // The Query
                                    $j = 0;
                                  
                                    if ($compairs->have_posts()) :
                                        while ($compairs->have_posts()) :
                                            $compairs->the_post();
                                            $j++;

                                            // Get ACF field data
                                            $servicesInfo = get_field('services_info');
                                            $type = get_query_var('type');

                                            // Initialize an empty array
                                            $data = [];

                                            // Handle service types dynamically
                                            if ($type == 'internet') {
                                                $services = $servicesInfo["internet_services"];
                                              //  var_dump($services);
                                                $data = [
                                                    'connection_type' => $services['connection_type'] ?? 'N/A',
                                                    'summary_speed' => $services['summary_speed']." Mbps" ?? 'N/A',
                                                    'data_caps' => $services['data_caps'] ?? 'N/A',
                                                    'contract' => $services['contract'] ?? 'N/A',
                                                    'setup_fee' => "$".$services['setup_fee'] ?? 'N/A',
                                                    'early_termination_fee' =>"$".$services['early_termination_fee'] ?? 'N/A',
                                                    'equipment_rental_fee' => "$".$services['equipment_rental_fee'] ?? 'N/A',
                                                    'price' => "$ ".$services['price'] ?? 'N/A'
                                                ];
                                            } elseif ($type == 'tv') {
                                                $services = $servicesInfo["tv_services"];
                                                $data = [
                                                    'connection_type' => $services['connection_type'] ?? 'N/A',
                                                    'channels' => $services['channels']."+" ?? 'N/A',
                                                    'free_premium_channels' => $services['free_premium_channels'] ?? 'N/A',
                                                    'contract' => $services['contract'] ?? 'N/A',
                                                    'setup_fee' => "$".$services['setup_fee'] ?? 'N/A',
                                                    'early_termination_fee' => "$".$services['early_termination_fee'] ?? 'N/A',
                                                    'broadcast_tv_fee' => "$".$services['broadcast_tv_fee'] ?? 'N/A',
                                                    'price' => "$".$services['price'] ?? 'N/A',
                                                ];
                                            } elseif ($type == 'landline') {
                                                $services = $servicesInfo["landline_services"];
                                                $data = [
                                                    'connection_type' => $services['connection_type'] ?? 'N/A',
                                                    'channels' => $services['channels']."+" ?? 'N/A',
                                                    'free_premium_channels' => $services['free_premium_channels'] ?? 'N/A',
                                                    'contract' => $services['contract'] ?? 'N/A',
                                                    'setup_fee' => $services['setup_fee'] ?? 'N/A',
                                                    'early_termination_fee' => $services['early_termination_fee'] ?? 'N/A',
                                                    'broadcast_tv_fee' => $services['broadcast_tv_fee'] ?? 'N/A',
                                                    'price' => $services['price'] ?? 'N/A',
                                                ];
                                            } else {
                                                $services = $servicesInfo["home_security_services"];
                                                $data = [
                                                    'connection_type' => $services['connection_type'] ?? 'N/A',
                                                    'channels' => $services['channels']."+" ?? 'N/A',
                                                    'free_premium_channels' => $services['free_premium_channels']."+" ?? 'N/A',
                                                    'contract' => $services['contract'] ?? 'N/A',
                                                    'setup_fee' => "$".$services['setup_fee'] ?? 'N/A',
                                                    'early_termination_fee' => "$".$services['early_termination_fee'] ?? 'N/A',
                                                    'broadcast_tv_fee' => "$".$services['broadcast_tv_fee'] ?? 'N/A',
                                                    'price' => "$".$services['price'] ?? 'N/A',
                                                ];
                                            }

                                            $view_link = $services['view_more'] ?? '#';
                                    ?>

                                <div class="dtable_<?php echo $j ?> md:w-1/2 w-full">
                                    <?php foreach ($data as $key => $value) : ?>
                                    <div class="provider-item">
                                        <p><?php echo esc_html($value); ?></p>
                                    </div>
                                    <?php endforeach; ?>

                                    <div class="provider-item">
                                        <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#ef9831] hover:bg-[#215690]"
                                            href="<?php echo $view_link; ?>">
                                            View Plans
                                        </a>

                                    </div>
                                </div>

                                <?php
                                    endwhile;
                                else :
                                    echo '<p>No providers found.</p>';
                                endif;

                                // Reset Post Data
                                wp_reset_postdata();
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>