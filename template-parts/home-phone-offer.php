<h2 class="md:text-2xl text-2xl font-semibold mb-5">Top Landline Home Phone Provider Deals</h2>    
  <div class="grid md:grid-cols-4 gap-5">
            <?php
               $index = 0;
                $args = array(
                    'post_type'      => 'providers', // Custom post type name
                    'posts_per_page' => 4, // Number of posts to display
                    'order'          => 'DESC', // Order of the posts
                    'providers_types'  => 'landline' ,
                     'meta_key'       => 'services_info_landline_services_price', 
                    'orderby'        => 'meta_value_num'
                );

                // Custom query to fetch posts
                $providers_query = new WP_Query($args);

                // The Loop
                if ($providers_query->have_posts()) :
                    while ($providers_query->have_posts()) : $providers_query->the_post();
                    $index++;

					$phone = get_field( "pro_phone" );
                    $logoArray = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                    $logoUrl = esc_url( $logoArray[0]);
                    $servicesInfo = get_field('services_info');
                    $type = get_query_var('type');

                    // print "<pre>";
                    // print_r($servicesInfo);
                    // print "</pre>";

                    $speed =  $servicesInfo["landline_services"]["summary_speed"];
                    $features_items = explode(',', $servicesInfo["landline_services"]["features"]);
                    $price = $servicesInfo["landline_services"]["price"];


                ?>

                <div class="grid  gap-7 mb-7">
                    <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex flex-col">
                        <div class="md:w-full min-w-fit bg-[#215690] flex justify-between items-center">
                            <h2 class="text-base font-bold text-center text-white p-5"><span> <?php echo $index ?> </span>- <?php the_title()?></h2>
                            <h2 class="text-base font-bold text-center text-white p-5"></h2>
                        </div>
                        <div class="md:w-full w-full grid grid-cols-1 dtable  flex-col">
                            <div class=" border-b grid items-center justify-center p-5">
                                <a target="_blank" href="<?php the_permalink()?>">
                                    <img
                                        alt="Feature Image"
                                        loading="lazy"
                                        width="140"
                                        height="50"
                                        decoding="async"
                                        data-nimg="1"
                                        src="<?php echo $logoUrl ?>"
                                        style="color: transparent;"
                                    />
                                </a>
                            </div>
                            
                            <div class="border-b grid items-center justify-center p-5 px-3">
                                <?php  display_features_list($features_items);   ?>
                            </div>
                            <div class="  border-b grid items-center justify-center p-5">
                                <div>
                                    <p class="tch">Pricing starts from</p>
                                    <p class="tcd"><span class="font-extrabold text-[#215690] font-[Roboto] text-xl"> $<?php echo $price; ?> </span> /mo.</p>
                                </div>
                            </div>
                            <?php echo render_provider_buttons($phone, $view_link); ?>
                        </div>
                    </div>
                </div>

                <?php 

                endwhile;
                else :
                    echo '<p>No providers found.</p>';
                endif;

                // Reset post data to avoid conflicts
                wp_reset_postdata();
                ?>

</div>