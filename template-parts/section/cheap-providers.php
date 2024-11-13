<section class="my-8">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Cheap <?php echo $type ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <?php 
               if ($type === 'internet'): ?>
            <p class="PClass">
                Affordability is essential when choosing your internet service provider. Cable Movers picks {insert
                lowest priced internet providers name} as the cheapest internet option in <?php echo $city ?>. {Insert
                lowest priced internet providers name} offers inexpensive and budget friendly internet plans without
                sacrificing performance. Their monthly plans begins at {enter price} per month making them a great
                choice for individuals and families looking to save on their internet bills.
            </p>
            <p class="PClass">
                {Insert 2nd cheap provider name} is another cheap internet service option offering high speed internet
                plans as low as {enter price} per month to fit into any budget. To help you choose the right internet
                provider for your home we have listed all providers available in {enter city name} and sorted them by
                price (low to high).
            </p>
            <?php elseif ($type === 'tv'): ?>
            <p class="PClass"> Affordability is essential when choosing your internet service provider. Cable Movers
                picks {insert lowest priced internet providers name} as the cheapest internet option in {enter city
                name}. {Insert lowest priced internet providers name} offers inexpensive and budget friendly internet
                plans without sacrificing performance. Their monthly plans begins at {enter price} per month making them
                a great choice for individuals and families looking to save on their internet bills.
            <p>
            <p class="PClass"> {Insert 2nd cheap provider name} is another cheap internet service option offering high
                speed internet plans as low as {enter price} per month to fit into any budget. To help you choose the
                right internet provider for your home we have listed all providers available in {enter city name} and
                sorted them by price (low to high).</p>


            <?php elseif ($type === 'landline'): ?>

            <p class="PClass"> Our recommendation for the cheap landline provider in Glendale, CA is {insert top
                provider}. Starting at just {enter landline price} per month would give you unlimited nationwide
                calling, readable voicemail using transcription services as well as three-way calling when you need to
                catch up with friends and family members.
            <p>
            <p class="PClass"> {Insert second rated provider} is another pick for cheap landline provider in {insert
                city name}. Its landline service revolves around unlimited local calls for just {enter price} per month
                without any hidden fees or surcharges. {Provider name} offers month to month service and doesn’t lock
                its customer in contracts and in most cases; landline phone has to be bundled with high speed internet.
                International calling packages are available as an ad-on.</p>
            <p class="PClass">While we rank the different landline providers in Glendale, CA, by their amenities and
                support, we also provide a detailed list of top services based on price. This way, you always have an
                affordable solution for a new home landline. Below is our list of the cheap home phone providers in
                Glendale, CA we know you can trust. Each meets our unique quality, support, price, and dependability
                criteria, so you won’t suffer dropped calls or spotty local service. </p>

            <?php elseif ($type === 'home-security'): ?>

            <p class="PClass">The home security companies in {insert city name} mentioned above are known countrywide
                for their exceptional reputation, which is also why they’re a bit higher on price point But If you are
                looking for affordable yet reliable home security systems in {insert city name}, we have several
                budget-friendly options for you.
            <p>
            <p class="PClass"> While each system has distinct features, they are all known for providing 24/7
                monitoring, intrusion detection, and a price that most homeowners can afford. In addition to affordable
                pricing, these companies also offer flexible payment plans and low-cost equipment options. This allows
                you to start low and then gradually increase your security system’s components such as security cameras,
                smart locks, etc. without breaking the bank.</p>
            <p class="PClass">Here’s a list of the cheapest home security systems in {insert city name}, ranked from the
                lowest to highest price. </p>

            <?php endif ?>




        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690]">
            <div class="border-r grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white">Provider</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">Cheap Package</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">
                        <?php if ($type === 'internet'): ?> Download Speed <?php else: ?> # of Channels <?php endif; ?>
                    </h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">Contract</h4>
                </div>
            </div>
            <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                <div>
                    <h4 class="md:text-base text-xs text-center text-white mb-2">Price</h4>
                </div>
            </div>
        </div>
        <div class="grid">
            <?php
                  $query_cheep = get_query_var('providers_query');
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
                            

                        //    print "<pre>";
                        //    print_r($services);
                        //    print "</pre>";
                        $price =  $services['price'];
                        $summary_speed =  $services['summary_speed'];
                        $connection_type =  $services['connection_type'];
                        $cheap_package =  $services['cheap_package'];
                        $contract =  $services['contract'];
                            
                            
                            
                            ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto bg-[#fafafa]">
                <div class="md:w-full w-full grid grid-cols-5">
                    <div
                        class="border-l border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><a target="_blank" href="/providers/xfinity">
                                    <?php the_title()?> </a></p>
                        </div>
                    </div>

                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><?php echo $cheap_package ?> </p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><?php echo $summary_speed ?> </p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs"><?php echo $contract ?> </p>
                        </div>
                    </div>
                    <div class="border-r border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                        <div>
                            <p class="text-center md:text-base text-xs">$<?php echo $price ?> </p>
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