<?php 
    $fast_providers = get_query_var('fast_provider_details'); 
    $city = FormatData($city);
    $state = strtoupper($state);

    /*Text for Landline */
    if ($type === 'landline'): ?>
<section>
    <div class="container mx-auto px-4">
        <div class="mb-5">
            <h2 class="text-2xl font-bold capitalize leading-10">How We Measure Home Phone Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?>, <?php echo $state ?> </span></h2>
            <div class="mt-1">
                <p>Offering a cheap home phone line isn’t enough to convince our professional team at CableMovers of a
                    provider’s quality. We look at a number of amenities and services to ensure you are only getting the
                    best landline phone service. That may include any combination of: </p>
                <ul class="__list pl-5 mt-2">
                    <li>
                        <strong>Internet Requirements: </strong> Do the landline home phone service providers in
                        <?php echo $city ?>, <?php echo $state ?>, require you to have internet access to install or use
                        the lines being offered?
                    </li>
                    <li> <strong>Hidden Fees & Taxes:</strong> Does signing up for the landline home service providers
                        mean paying hidden fees that increase over time or are there any local taxes not worked into the
                        monthly price advertised? </li>
                    <li>
                        <strong>Audio Quality:</strong> Are you getting pristine audio for your landline service so you
                        can easily hear people on the other end of the line, regardless of where they are in the world?
                    </li>
                    <li>
                        <strong>Transparent Pricing & Contracts:</strong> Do the telephone service providers require
                        extended contracts? What about pricing? Is the total price you pay broken down into what you’re
                        receiving in a clear and transparent way?
                    </li>
                    <li>
                        <strong>Real Customer Support:</strong> If you have an issue with your home phone line, will you
                        speak with a human representative for the service provider instead of a robot or audio prompts?
                    </li>
                </ul>
                <p class="mt-2">The last factor we consider when getting a landline is the company's amenities. Items
                    like call forwarding, voicemail, caller ID, blocking spam calls, setting “do not disturb,” and
                    similar features can make all the difference for your unique landline needs. </p>
                <p class="mt-2">Once we clearly understand these items, we rank the top home phone service providers in
                    <?php echo $city ?>, <?php echo $state ?> for you to select at your leisure.
                </p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mx-auto px-4">
        <div class="mb-5">
            <h2 class="text-2xl font-bold capitalize leading-10">Get the Best Landline Phone Service in <span
                    class="text-[#ef9831]"><?php echo $city ?>, <?php echo $state ?> </span></h2>
            <div class="mt-1">
                <p>Stop wasting time pouring through hours of overly hyped online marketing and get the trusted
                    comparison our professional agents provide. At CableMovers, we save you time and money by uncovering
                    the home phone service providers in <?php echo $city ?>, <?php echo $state ?> perfect for your
                    unique personal and business needs. </p>
                <p class="mt-2">Call our agents today, and let’s find the perfect landline solution whether you’ve just
                    moved to the area or need a 24/7 connection to friends, family, and emergency services. Together, we
                    can find an affordable and amenity-rich telephone service provider you can count on. </p>
            </div>
        </div>
    </div>
</section>

<?php endif  ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <?php  if ($type === 'internet'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">Fastest <?php echo FormatData($type) ?> Providers in
                <span class="text-[#ef9831]"><?php echo $city ?>, <?php echo $state ?></span>
            </h2>
            <p class="PClass"> Whether you need high speed internet for streaming in 4K resolution
                or playing online multiplayer games <?php echo $fast_providers[0]['title']; ?> provides fastest internet
                connection in <?php echo $city ?> with download speed of up to
                <?php echo $fast_providers[0]['speed']; ?> for just <?php echo $fast_providers[0]['price']; ?> per month
                which is perfect for households with multiple users and heavy data consumption and can
                cater to the needs of heavy internet users, streamers and online gamers.</p>
            <p class="PClass"><?php echo $fast_providers[1]['title']; ?> internet is renowned for its
                high speed capabilities making it an excellent choice for gamers and streamers. With download speeds of
                up to <?php echo $fast_providers[0]['speed']; ?> making it one of the fastest internet service provider
                in <?php echo $city ?>. Price begins at <?php echo $fast_providers[0]['price']; ?> per month.</p>
            <p class="PClass">Take a look at the fastest internet providers in your area sorted by
                speed (high to low). </p>
            <?php elseif ($type === 'tv'): ?>
            <h2 class="text-2xl font-bold capitalize leading-10">Highest Rated <?php echo FormatData($type) ?> Providers
                in <span class="text-[#ef9831]"><?php echo $city ?> </span></h2>
            <p class="PClass">Below is our curated list of the cable TV providers we know that offer
                quality service and reasonable pricing. Each one has exceptional customer service and online user
                reviews so you can enjoy the football, latest films, and local TV stations you love. </p>
            <?php else: ?>
            <?php endif; ?>
        </div>
        <div class="md:w-full min-w-fit grid grid-cols-5 bg-[#215690] md:grid-cols-5">
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
            <?php if ($type === 'internet'): ?>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Fast Package</h4>
                </div>
            </div>
            <?php endif; ?>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title"><?php if ($type === 'internet'): ?> Download
                        Speed <?php else: ?> # of Channels <?php endif; ?></h4>
                </div>
            </div>
            <div class="tborder">
                <div>
                    <h4 class="tabbox_title">Price</h4>
                </div>
            </div>
        </div>
        <div class="grid shadow-xl">

            <?php
                    $query_fast = get_query_var('providers_query');
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

                        // var_dump($internet_services);
                        $price =  $services['price'];
                        $summary_speed =  $services['summary_speed'];
                        $connection_type =  $services['connection_type'];
                        $fast_package =  $services['fast_package'];
                        ?>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto dtable">
                <div class="w-full h-auto flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full w-full grid grid-cols-5 md:grid-cols-5">
                        <div class="tborder">
                            <div>
                                <p class="tb_title"><a target="_blank"
                                        href=""><?php the_title()?></a></p>
                            </div>
                        </div>
                        <div class="tborder">
                            <?php echo $connection_type ?> </div>
                        <?php if ($type === 'internet'): ?> <div class="tborder">
                            <?php echo $fast_package ?></div> <?php endif; ?>

                        <div class="tborder">
                       
                            <?php echo $type === 'internet' ? $summary_speed."Mbps" : '# of Channels'; ?>
                        
                        </div>
                        <div class="tborder">
                            $<?php echo $price ?></div>
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