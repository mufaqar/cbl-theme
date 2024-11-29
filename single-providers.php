<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

    get_header();

    $phone = get_field( "pro_phone" );
    $logoArray = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
    $logoUrl = esc_url( $logoArray[0]);
    $currentYear = date("Y");
    $currentMonth = date('F');
    $price = get_field( "pro_price" );
    $features = get_field( "features" );
    $features_banner = get_field( "banner_image" );
    $pros = get_field( "pros" );
    $cons = get_field( "cons" );
    $order_online = get_field( "order_online" );
    $disclambers = get_field( "disclambers" );
    

?>
<section class="relative pbanner" style="background-image: url('<?php echo $features_banner ?>')">
    <div class="overlay_wrapper">
        <div class="container mx-auto px-4 flex md:flex-row flex-col gap-7 items-center">
            <div class="md:w-1/2 w-full py-10 text-white">
                <a href="/providers/att">
                    <img
                        alt="Feature Image"
                        loading="lazy"
                        width="140"
                        height="50"
                        class="plogo"
                        decoding="async"
                        data-nimg="1"
                        src="<?php echo $logoUrl ?>"
                        style="color: transparent; filter: invert(1); mix-blend-mode: exclusion;"
                    />
                </a>
                <h1 class="text-3xl md:text-5xl md:leading-tight font-bold text-white"><span class="text-[#ef9831]"><?php echo the_title(); ?> </span>Plans and Pricing for <?php echo $currentMonth ?>, <?php echo $currentYear ?></h1>
                <div class="features text-white mb-5 single_content">
                    <?php echo $features ?>
                </div>
                <h5 class="text-xl font-bold text-white">Price Starting At</h5>
                <h2 class="md:text-4xl text-3xl font-extrabold text-white my-4 flex items-start">
                    <span class="md:text-3xl text-base">$</span><?php echo $price ?>
                    <span class="grid">
                        <span class="md:text-3xl text-base"><sub>/mo</sub></span>
                    </span>
                </h2>
                <a class="bg-[#ef9831] rounded-3xl md:text-4xl text-base font-bold text-white w-fit px-3 py-1.5 flex items-center gap-3 mb-4" href="<?php 
                    if($order_online){
                        echo $order_online;
                    }else{
                        echo $phone;
                    }
                ?>">
                    <?php
                        if(!$order_online){ ?>
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z"
                                ></path>
                            </svg>
                        <?php } ?>
                    
                    <?php if($order_online){ echo "Order Online"; }else{ echo $phone; } ?>
                </a>
            </div>
            <div class="md:w-1/2 w-full md:block hidden">
            </div>
        </div>
    </div>
</section>

<section class="bgmain px-4 py-5 shadow-sm border-y border-zinc-400/20 z-50">
    <div class="container mx-auto flex justify-center items-center md:text-4xl text-xl font-bold uppercase text-white">
        <div class="grid items-center md:justify-end justify-center"><?php if($order_online){ echo "Simply Click And"; }else{ echo "Call Now to Order"; } ?> </div>
        <div class="items-center justify-start flex gap-3">
            <?php
                if(!$order_online){ ?>
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="ml-5 md:text-4xl text-2xl font-normal" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"
                    ></path>
                </svg>
            <?php } ?>
            <a href="tel:<?php echo $phone ?>" class="ml-1.5">
                <?php if($order_online){ echo " Order Online"; }else{ echo $phone; } ?> 
            </a>
        </div>
    </div>
</section>

<!-- Internet Plans -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold"><?php echo the_title(); ?> Internet Plans</h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5"><?php _e('Swipe Left to See All →', 'your-theme-textdomain'); ?></div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-4 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white"><?php _e('Package', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2"><?php _e('Speed Up To', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white"><?php _e('Price', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2"><?php _e('Order Now', 'your-theme-textdomain'); ?></h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        
                        

                        <?php if( have_rows('internet_plans') ): ?>
                            <?php while( have_rows('internet_plans') ): the_row(); 
                                $package = get_sub_field('package');
                                $Speeds = get_sub_field('Speeds');
                                $speed_info = get_sub_field('speed_info');
                                $price = get_sub_field('price');
                                $price_info = get_sub_field('price_info');
                                ?>
                                <div class="w-full flex md:flex-row flex-col dtable">
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                        <div><p class="text-center md:text-base text-xs"><?php echo $package ?></p></div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $Speeds ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $speed_info; ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $price ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $price_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                                        <div>
                                            <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo $phone ?>">
                                                <?php echo $phone ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TV Plans -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold"><?php echo the_title(); ?> TV Plans</h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-4 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Package</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Channels</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Price</h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Order Now</h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        <?php if( have_rows('tv_plans') ): ?>
                            <?php while( have_rows('tv_plans') ): the_row(); 
                                $package = get_sub_field('package');
                                $Speeds = get_sub_field('Speeds');
                                $speed_info = get_sub_field('speed_info');
                                $price = get_sub_field('price');
                                $price_info = get_sub_field('price_info');
                                ?>
                                <div class="w-full flex md:flex-row flex-col dtable">
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div><p class="text-center md:text-base text-xs"><?php echo $package ?></p></div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $Speeds ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $speed_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $price ?></p>
                                            <p class="text-center md:text-xs text-xs">*<?php echo $price_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo $phone ?>">
                                                <?php echo $phone ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><p class="text-sm font-[Roboto] mt-10"></p></div>
    </div>
</section>

<!-- Internet and Phone Bundles -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">
                <?php echo the_title(); ?> Internet and Phone Bundles
            </h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-5 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Package</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Speed Up To</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Voice</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Price</h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Order Now</h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        <?php if( have_rows('internet_and_phone_bundles') ): ?>
                            <?php while( have_rows('internet_and_phone_bundles') ): the_row(); 
                                $package = get_sub_field('package');
                                $Speeds = get_sub_field('Speeds');
                                $speed_info = get_sub_field('speed_info');
                                $price = get_sub_field('price');
                                $price_info = get_sub_field('price_info');
                                $voice = get_sub_field('voice');
                                $voice_info = get_sub_field('voice_info');
                                ?>
                                <div class="w-full flex md:flex-row flex-col dtable">
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div><p class="text-center md:text-base text-xs"><?php echo $package ?></p></div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $Speeds ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $speed_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $price ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $price_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $voice ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $voice_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo $phone ?>">
                                            <?php echo $phone ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><p class="text-sm font-[Roboto] mt-10"></p></div>
    </div>
</section>

<!-- Internet and Mobile Bundles -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">
                <?php echo the_title(); ?> Internet and Mobile Bundles
            </h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-5 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Package</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Speed Up To</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Voice</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Price</h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Order Now</h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        <?php if( have_rows('internet_and_mobile_bundles') ): ?>
                            <?php while( have_rows('internet_and_mobile_bundles') ): the_row(); 
                                $package = get_sub_field('package');
                                $Speeds = get_sub_field('Speeds');
                                $speed_info = get_sub_field('speed_info');
                                $price = get_sub_field('price');
                                $price_info = get_sub_field('price_info');
                                $voice = get_sub_field('voice');
                                $voice_info = get_sub_field('voice_info');
                                ?>
                                <div class="w-full flex md:flex-row flex-col dtable">
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div><p class="text-center md:text-base text-xs"><?php echo $package ?></p></div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $Speeds ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $speed_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $price ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $price_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $voice ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $voice_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo $phone ?>">
                                            <?php echo $phone ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><p class="text-sm font-[Roboto] mt-10"></p></div>
    </div>
</section>

<!-- Internet And TV Bundles -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">
                <?php echo the_title(); ?> Internet And TV Bundles
            </h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-5 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Package</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Speed Up To</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Voice</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Price</h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Order Now</h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        <?php if( have_rows('internet_and_tv_bundles') ): ?>
                            <?php while( have_rows('internet_and_tv_bundles') ): the_row(); 
                                $package = get_sub_field('package');
                                $Speeds = get_sub_field('Speeds');
                                $speed_info = get_sub_field('speed_info');
                                $price = get_sub_field('price');
                                $price_info = get_sub_field('price_info');
                                $channels = get_sub_field('channels');
                                $channels_info = get_sub_field('channels_info');
                                ?>
                                <div class="w-full flex md:flex-row flex-col dtable">
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div><p class="text-center md:text-base text-xs"><?php echo $package ?></p></div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $Speeds ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $speed_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $price ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $price_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $channels ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $channels_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo $phone ?>">
                                            <?php echo $phone ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><p class="text-sm font-[Roboto] mt-10"></p></div>
    </div>
</section>

<!-- Internet, TV &amp; Phone Bundles -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">
                <?php echo the_title(); ?>
                Internet, TV &amp; Phone Bundles
            </h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-6 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Package</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Speed Up To</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Channels</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Voice</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Price</h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Order Now</h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        <?php if( have_rows('internet_tv_phone_bundles') ): ?>
                            <?php while( have_rows('internet_tv_phone_bundles') ): the_row(); 
                                $package = get_sub_field('package');
                                $Speeds = get_sub_field('Speeds');
                                $speed_info = get_sub_field('speed_info');
                                $price = get_sub_field('price');
                                $price_info = get_sub_field('price_info');
                                $channels = get_sub_field('channels');
                                $channels_info = get_sub_field('channels_info');
                                $voice = get_sub_field('voice');
                                $voice_info = get_sub_field('voice_info');
                                ?>
                                <div class="w-full flex md:flex-row flex-col dtable">
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div><p class="text-center md:text-base text-xs"><?php echo $package ?></p></div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $Speeds ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $speed_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $channels ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $channels_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $voice ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $voice_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $price ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $price_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo $phone ?>">
                                            <?php echo $phone ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><p class="text-sm font-[Roboto] mt-10"></p></div>
    </div>
</section>


<!-- home-security -->
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold">
                <?php echo the_title(); ?>
               Home Security Bundles
            </h2>
            <div class="w-fit hint mx-auto block md:hidden mt-5">Swipe Left to See All →</div>
        </div>
        <div>
            <div class="w-full lg:max-w-[1200px] mx-auto h-auto">
                <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex md:flex-col flex-row items-stretch">
                    <div class="md:w-full min-w-fit grid md:grid-cols-3 grid-cols-1 bg-[#215690]">
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Package</h4></div>
                        </div>
                        <div class="md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white">Price</h4></div>
                        </div>
                        <div class="grid justify-center md:p-5 p-2 md:h-auto h-[120px] items-center">
                            <div><h4 class="md:text-base text-xs font-bold text-center text-white mb-2">Order Now</h4></div>
                        </div>
                    </div>
                    <div class="flex md:flex-col flex-row w-full md:overflow-hidden overflow-x-scroll">
                        <?php if( have_rows('home_security_bundles') ): ?>
                            <?php while( have_rows('home_security_bundles') ): the_row(); 
                                $package = get_sub_field('package');
                                $Speeds = get_sub_field('Speeds');
                                $speed_info = get_sub_field('speed_info');
                                $price = get_sub_field('price');
                                $price_info = get_sub_field('price_info');
                                $channels = get_sub_field('channels');
                                $channels_info = get_sub_field('channels_info');
                              
                                ?>
                                <div class="w-full flex md:flex-row flex-col dtable">
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div><p class="text-center md:text-base text-xs"><?php echo $package ?></p></div>
                                    </div>
                                    <div class="w-full md:border-r border-r-0 md:border-b-0 border-b grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <p class="text-center md:text-base text-xs font-bold"><?php echo $price ?></p>
                                            <p class="text-center md:text-xs text-xs"><?php echo $price_info ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full grid justify-center md:p-5 p-2 md:h-auto h-[120px] overflow-hidden items-center">
                                        <div>
                                            <a class="md:text-base text-[9px] font-medium text-white bg-[#ef9831] hover:bg-[#215690] md:px-3 px-[5px] py-1.5 rounded-3xl block w-[90px] md:w-[140px] text-center mx-auto" href="tel:<?php echo $phone ?>">
                                            <?php echo $phone ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><p class="text-sm font-[Roboto] mt-10"></p></div>
    </div>
</section>


<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10"><h2 class="text-2xl font-bold">Switch to <?php echo the_title(); ?> And Get Benefits You’ll Love</h2></div>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-7">
       
            <?php if (have_rows('features_block')):
                while (have_rows('features_block')):

                    the_row();
                    $title = get_sub_field('title');
                    $details = get_sub_field('details');
                    $icon = get_sub_field('icon');
                    ?>
                            <div class="block rounded-xl border border-gray-100 px-8 py-10 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                                    <span class="text-4xl !text-[#215690] text-center block w-fit mx-auto">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                fill-rule="evenodd"
                                                d="M6.97 2.47a.75.75 0 011.06 0l4.5 4.5a.75.75 0 01-1.06 1.06L8.25 4.81V16.5a.75.75 0 01-1.5 0V4.81L3.53 8.03a.75.75 0 01-1.06-1.06l4.5-4.5zm9.53 4.28a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V7.5a.75.75 0 01.75-.75z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </span>
                                <h2 class="mt-5 text-xl font-bold text-center"><?php echo $title; ?></h2>
                                <p class="mt-5 text-base text-center"><?php echo $details; ?></p>
                            </div>

                        <?php
                endwhile; ?>               
            <?php
            endif; ?>
           
        </div>
    </div>
</section>

<section class="mt-16">
    <div class="container mx-auto px-4">
        <div class="">
            <?php if (have_rows('block')): ?>
                <div class="block">
                    <?php while (have_rows('block')):
                        the_row();
                            $heading = get_sub_field('heading');
                            $content = get_sub_field('content');
                        ?>
                            <div class="inner_block">
                                <h2 class="block_heading"><?php echo $heading; ?></h2>
                                <div class="block_content"><?php echo $content; ?></div>
                            </div>
                        <?php
                    endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="mt-8">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 grid-cols-1">
            <div class="bg-gray-200 p-8 pros">
                <h2 class="text-2xl font-bold mb-4">Pros</h2>
                <?php echo $pros ?>
            </div>
            <div class="bg-gray-100 p-8 cons">
                <h2 class="text-2xl font-bold mb-4">Cons</h2>
                <?php echo $cons ?>
            </div>
        </div>
    </div>
</section>

<?php if($disclambers){ ?>
    <section class="container mx-auto px-4">
        <?php echo $disclambers ?>
    </section>
<?php } ?>


<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold"><?php echo the_title(); ?> FAQ’s</h2>
        </div>
        <div class="grid gap-10">
            <?php
                if( have_rows('faq’s') ):
                    while( have_rows('faq’s') ) : the_row();
                        $question = get_sub_field('question');
                        $answer = get_sub_field('answer');
                    ?>
                        <div class="faq-item w-full h-fit border border-[#F0F0F0] rounded-[10px] p-[30px] shadow-[0_15px_15px_rgba(0,0,0,0.05)]">
                            <div class="faq-question flex justify-between cursor-pointer">
                                <p class="text-lg font-semibold"><?php echo $question ?></p>
                                <span class="faq-icon text-lightBlue">
                                    <svg
                                        stroke="currentColor"
                                        fill="currentColor"
                                        stroke-width="0"
                                        viewBox="0 0 1024 1024"
                                        class="faq-arrow transform transition duration-200 rotate-0"
                                        height="24"
                                        width="24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <defs></defs>
                                        <path d="M474 152m8 0l60 0q8 0 8 8l0 704q0 8-8 8l-60 0q-8 0-8-8l0-704q0-8 8-8Z"></path>
                                        <path d="M168 474m8 0l672 0q8 0 8 8l0 60q0 8-8 8l-672 0q-8 0-8-8l0-60q0-8 8-8Z"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="faq-answer hidden mt-5">
                                <p class="text-base font-medium"><?php echo $answer ?></p>
                            </div>
                        </div>
                    <?php
                    endwhile;
                else : endif;
            ?>
        </div>
    </div>
</section>


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


<?php
get_footer();
