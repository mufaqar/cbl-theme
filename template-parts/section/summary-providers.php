<?php  $city = FormatData($city);
    $state = strtoupper($state); ?>
<!-- Summary Of Providers -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">Summary of <?php echo FormatData($type) ?> Providers in <span
                    class="text-[#ef9831]"><?php echo $city ?>, <?php echo $state ?></span></h2>

            <?php if ( $type === 'internet'): ?>
            <p class="PClass"> When it comes to finding Internet service provider, <?php echo $city ?>,
                <?php echo $state ?> is served by a robust selection of home phone service providers each with its own
                strengths. Whether you prioritize speed, affordability, or reliability, you can find internet providers
                in <?php echo $city ?>, <?php echo $state ?> that suit your specific needs. Compare the available
                options,
                consider your budget, and choose the one that fits your requirements for a seamless online experience.
            <p>

                <?php elseif ( $type === 'landline'): ?>
            <p class="PClass"> The next time you’re moving to the area or need to set up a dedicated landline service
                for your side hustle, rely on our list of the top landline home service providers in the area. We do the
                hard work for you so you can quickly get a landline and move on with your day.
            <p>
            <p class="PClass"> Whatever landline home service providers you choose, be sure to ask about bundled
                services. That is where our trained agents at CableMovers can help. Call us today, and we’ll compare all
                the available telephone service providers in your area, finding the best deal and assisting with the
                setup process.</p>
            <?php elseif ($type === 'home-security'): ?>
            <p class="PClass"> As household names in the industry, these home security service providers in
                <?php echo $city ?> provide a range of products that are affordable and effective in protecting your
                home. With
                flexible plans and low-cost monitoring subscriptions, your wallet won’t hurt too much. What’s more, you
                can add more accessories to your security system over time.</p>
            <p class="PClass"> Remember that affordable doesn’t always mean low quality. Some of the companies we have
                mentioned are extremely economical, offer excellent customer support, and protect your home at a price
                that fits your budget. We have done the hard work. Now it’s up to you to choose a home security company
                in <?php echo $city ?> that delivers peace of mind without straining your finances.</p>
            <?php else: ?>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
            <?php endif; ?>

        </div>

        <div class="w-full lg:max-w-[1200px] mx-auto h-auto mb-6">
            <div
                class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                <div
                    class="md:w-full min-w-[50px] grid <?php echo $type == 'home-security' || $type == 'landline' ? 'md:grid-cols-6' : 'md:grid-cols-7'; ?> grid-cols-1 bg-[#215690] htable">
                    <div class="tborder tborder">
                        <div>
                            <h4 class="tabbox_title">Provider</h4>
                        </div>
                    </div>
                    <?php if (!in_array($type, ['landline', 'home-security'])) : ?>
                    <div class="tborder tborder">
                        <div>
                            <h4 class="tabbox_title">Connection Type</h4>
                        </div>
                    </div>
                    <div class="tborder tborder">
                        <div>
                            <h4 class="tabbox_title">
                                <?php echo $type === 'internet' ? 'Max Download Speed' : '# of Channels'; ?></h4>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="tborder tborder  md:col-span-3 col-span-1">
                        <div>
                            <h4 class="tabbox_title">Features</h4>
                        </div>
                    </div>
                    <div class="tborder tborder">
                        <div>
                            <h4 class="tabbox_title">Price</h4>
                        </div>
                    </div>

                    <?php if (in_array($type, ['landline', 'home-security'])) : ?>

                    <div class="tborder">
                        <div>
                            <h4 class="tabbox_title">Order Now</h4>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
                <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                    <?php
                                 $query = get_query_var('providers_query');
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $i++;
                                        set_query_var('provider_index', $i);
                                        $servicesInfo = get_field('services_info');
                                        $type = get_query_var('type');
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
                                        $summary_speed =  $services['summary_speed'];
                                        $connection_type =  $services['connection_type'];
                                        $summary_features =  $services['summary_features'];

                                    ?>

                    <div
                        class="min-w-[120px] md:w-full grid <?php echo $type == 'home-security' || $type == 'landline' ? 'md:grid-cols-6' : 'md:grid-cols-7'; ?> grid-cols-1  dtable">
                        <div class="tborder">
                            <div>
                                <p class="tb_heading"><a target="_blank" href="<?php the_permalink()?>">
                                        <?php the_title()?> </a></p>
                            </div>
                        </div>
                        <?php if (!in_array($type, ['landline', 'home-security'])) : ?>
                        <div class="tborder">
                            <div>
                                <p class="tb_heading"><?php echo $connection_type ?></p>
                            </div>
                        </div>
                        <div class="tborder">
                            <div>
                                <p class="tb_heading">
                                    <?php echo $summary_speed ?><?php echo $type === 'internet' ? ' Mbps' : ''; ?></p>
                            </div>
                        </div>
                        <?php endif ; ?>
                        <div class="tborder  md:col-span-3 col-span-1 ">
                            <div>
                                <p class="tb_heading"><?php echo $summary_features ?></p>
                            </div>
                        </div>
                        <div class="tborder">
                            <div>
                                <p class="tb_heading">$<?php echo $price ?>/mo</p>
                            </div>
                        </div>
                        <?php if (in_array($type, ['landline', 'home-security'])) : ?>
                        <?php echo render_provider_buttons($phone, $view_link); ?>
                        <?php endif ?>

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

</section>