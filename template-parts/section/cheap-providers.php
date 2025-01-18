<?php 
    $cheap_providers = get_query_var('cheap_provider_details'); 
    $city = FormatData($city);
    $state = strtoupper($state);


?>

<section class="my-8">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Cheap <?php echo FormatData($type) ?> Providers in
                <span class="text-[#ef9831]"><?php echo $city ?>, <?php echo $state ?> </span>
            </h2>
            <?php 
               if ($type === 'internet'): ?>
            <p class="PClass">
                Affordability is essential when choosing your internet service provider. Cable Movers picks
                <?php echo $cheap_providers[0]['title']; ?> as the cheapest internet option in <?php echo $city ?>.
                <?php echo $cheap_providers[0]['title']; ?> offers inexpensive and budget friendly internet plans
                without
                sacrificing performance. Their monthly plans begins at <?php echo $cheap_providers[0]['price']; ?> per
                month making them a great
                choice for individuals and families looking to save on their internet bills.
            </p>
            <p class="PClass">
                <?php echo $cheap_providers[1]['title']; ?> is another cheap internet service option offering high speed
                internet
                plans as low as <?php echo $cheap_providers[1]['price']; ?> per month to fit into any budget. To help
                you choose the right internet
                provider for your home we have listed all providers available in <?php echo $city ?> and sorted them by
                price (low to high).
            </p>
            <?php elseif ($type === 'tv'): ?>
            <p class="PClass">
                CableMovers has compiled a list of cheap TV service providers in  <?php echo $city; ?>,  <?php echo $state; ?> and choose <?php echo $cheap_providers[0]['title']; ?>  as the best cheap cable TV provider. <?php echo $cheap_providers[0]['title']; ?> TV package cost  <?php echo $cheap_providers[0]['price']; ?> per month and provides over  <?php echo $cheap_providers[0]['channels']; ?> channels. Most of these channels are HD (High Definition) and include channels like CNN, USA, Hallmark, HGTV, Food Network, TNT, Bravo, ESPN, 
            
            Discovery and Cartoon Network etc. A DVR service is available to record anything you want and a TV App access to watch your favorite shows and movies on the go.
            </p><p class="PClass">
Another Cheap TV service option is <?php echo $cheap_providers[1]['title']; ?> which is a <?php echo $cheap_providers[1]['connection']; ?> based Cable TV provider. <?php echo $cheap_providers[1]['title']; ?> is advertised at <?php echo $cheap_providers[1]['price']; ?> per month with over <?php echo $cheap_providers[1]['channels']; ?> plus channels including your locals and top movies, sports, news, music and lifestyle channels. A DVR (Digital Video Recorder) is included in the service free of charge and can record multiple shows at any given time. 
</p><p class="PClass">
If you want to save a few extra bucks on your cable TV service choose from the following providers sorted by price low to high.

           

            <?php elseif ($type === 'landline'): ?>

            <p class="PClass"> Our recommendation for the cheap landline provider in <?php echo $city; ?>, <?php echo $state; ?> is
                <?php echo $cheap_providers[0]['title']; ?>. Starting at just
                <?php echo $cheap_providers[0]['price']; ?> per month would give you unlimited nationwide
                calling, readable voicemail using transcription services as well as three-way calling when you need to
                catch up with friends and family members.
            <p>
            <p class="PClass"> <?php echo $cheap_providers[1]['title']; ?> is another pick for cheap landline provider
                in <?php echo $city; ?>. Its landline service revolves around unlimited local calls for just
                <?php echo $cheap_providers[1]['price']; ?> per month
                without any hidden fees or surcharges. <?php echo $cheap_providers[1]['title']; ?> offers month to month
                service and doesn’t lock
                its customer in contracts and in most cases; landline phone has to be bundled with high speed internet.
                International calling packages are available as an ad-on.</p>
            <p class="PClass">While we rank the different landline providers in <?php echo $city; ?>, <?php echo $state; ?> by their amenities and
                support, we also provide a detailed list of top services based on price. This way, you always have an
                affordable solution for a new home landline. Below is our list of the cheap home phone providers in
                <?php echo $city; ?>, <?php echo $state; ?> we know you can trust. Each meets our unique quality, support, price, and dependability
                criteria, so you won’t suffer dropped calls or spotty local service. </p>

            <?php elseif ($type === 'home-security'): ?>

            <p class="PClass">The home security companies in <?php echo $city; ?> mentioned above are known countrywide
                for their exceptional reputation, which is also why they’re a bit higher on price point But If you are
                looking for affordable yet reliable home security systems in <?php echo $city; ?>, we have several
                budget-friendly options for you.
            <p>
            <p class="PClass"> While each system has distinct features, they are all known for providing 24/7
                monitoring, intrusion detection, and a price that most homeowners can afford. In addition to affordable
                pricing, these companies also offer flexible payment plans and low-cost equipment options. This allows
                you to start low and then gradually increase your security system’s components such as security cameras,
                smart locks, etc. without breaking the bank.</p>
            <p class="PClass">Here’s a list of the cheapest home security systems in <?php echo $city; ?>, ranked from
                the
                lowest to highest price. </p>

            <?php endif ?>




        </div>
        <div
            class="md:w-full min-w-fit grid <?php echo $type == 'home-security' || $type == 'landline' ? 'grid-cols-4' : 'grid-cols-5'; ?>  bg-[#215690] htable ">
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Provider</h4>
                </div>
            </div>
            <div class="tborder tborder">
                <div>
                    <h4 class="tabbox_title">Cheap Package</h4>
                </div>
            </div>
            <?php if (!in_array($type, ['landline', 'home-security'])) : ?>
            <div class="tborder tborder">
                <div>
                    <h4 class="tabbox_title">
                        <?php if ($type === 'internet'): ?> Download Speed <?php else: ?> # of Channels <?php endif; ?>
                    </h4>
                </div>
            </div>
            <?php endif ?>
            <?php if ($type !== 'home-security') : ?>
            <div class="tborder tborder">
                <div>
                    <h4 class="tabbox_title">Contract</h4>
                </div>
            </div>
            <?php endif ?>
            <div class="tborder tborder">
                <div>
                    <h4 class="tabbox_title">Price</h4>
                </div>
            </div>
            <?php if ($type === 'home-security') : ?>
            <div class="tborder tborder">
                <div>
                    <h4 class="tabbox_title">Order Now</h4>
                </div>
            </div>
            <?php  endif ?>
        </div>
        <div class="grid shadow-xl">
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
                            

                        //var_dump($services);
                        $price =  $services['price'];
                        $summary_speed =  $services['summary_speed'];
                        $channels =  $services['channels'];
                        $connection_type =  $services['connection_type'];
                        $cheap_package =  $services['cheap_package'];
                        $cheap_speed =  $services['cheap_speed'];
                        $contract =  $services['contract'];
                            
                            
                        ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto dtable ">
                <div
                    class="md:w-full w-full grid <?php echo $type == 'home-security' || $type == 'landline' ? 'grid-cols-4' : 'grid-cols-5'; ?>   ">
                    <div class="tborder">
                        <p class="tb_title">
                            <a target="_blank" href="<?php the_permalink()?>"> <?php the_title()?> </a>
                        </p>
                    </div>
                    <div class="tborder">
                        <p class="tb_heading"><?php echo $cheap_package ?></p>
                    </div>
                    <?php if (!in_array($type, ['landline', 'home-security'])) : ?>
                    <div class="tborder">
                       
                            <?php echo $type === 'tv' ? $channels."+" : $cheap_speed." Mbps"; ?>
                     
                    </div>
                    <?php endif ?>
                    <?php if ($type !== 'home-security') : ?>
                    <div class="tborder">
                        <p class="tb_heading"><?php echo $contract ?> </p>
                    </div>
                    <?php  endif ?>
                    <div class="tborder">
                        <p class="tb_heading">$<?php echo $price ?> </p>
                    </div>
                    <?php if ($type === 'home-security') : ?>
                    <div class="tborder">
                        <a class="text-base text-white font-[Roboto] uppercase px-5 py-2.5 bg-[#ef9831] hover:bg-[#215690]"
                            href="<?php the_permalink()?>">
                            View Plans
                        </a>
                    </div>
                    <?php endif ?>
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