<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- <meta name="robots" content="noindex, nofollow" /> -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php wp_body_open(); ?>
<?php check_header();?>

<header class="h-auto shadow py-4 font-[Roboto]">
    <nav class="max-w-[1110px] w-full mx-auto px-4 flex flex-row-reverse sm:flex-row items-center justify-between">
        <div class="sm:hidden flex items-center">
            <button id="menu-toggle">
                <i class="rx-hamburger">Menu</i>
            </button>
        </div>
        <div class="sm:pl-0 sm:w-1/3 w-full">
            <a href="<?php bloginfo('url'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo1.png" alt="<?php bloginfo('name'); ?>" width="120" height="34" class="w-20 md:w-44" />
            </a>
        </div>
        <div id="menu" class="sm:w-2/3 bg-gray-100 w-full sm:bg-white shadow-xl sm:shadow-none z-10 sm:justify-end sm:static absolute left-0 sm:py-0 py-7 sm:px-0 px-5 flex items-center">
            <ul class="flex sm:flex-row flex-col sm:items-center md:gap-[3vw] gap-5">
                <li class="menu-item" data-submenu="submenu-tv">
                    <a href="#" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">TV</a>
                    <ul id="submenu-tv" class="submenu bg-transparent sm:bg-white pl-5 sm:pl-0 border-l sm:border-none mt-1 md:!mt-0 md:absolute static top-[3.7rem] md:w-40 w-full grid gap-3 z-50 md:shadow-xl">
                        <li><a href="/providers/spectrum" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Spectrum</a></li>
                        <li><a href="/providers/dish" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">DISH</a></li>
                        <li><a href="/providers/directv" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">DIRECTV</a></li>
                        <li><a href="/providers/optimum" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Optimum</a></li>
                        <li><a href="/providers/cox" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Cox</a></li>
                        <li><a href="/providers/xfinity" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Xfinity</a></li>
                    </ul>
                </li>
                <li class="menu-item" data-submenu="submenu-internet">
                    <a href="#" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Internet</a>
                    <ul id="submenu-internet" class="submenu bg-transparent sm:bg-white pl-5 sm:pl-0 border-l sm:border-none mt-1 md:!mt-0 md:absolute static top-[3.7rem] md:w-40 w-full grid gap-3 z-50 md:shadow-xl">
                        <li><a href="/providers/att" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">AT&T</a></li>
                        <li><a href="/providers/spectrum" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Spectrum</a></li>
                        <li><a href="/providers/frontier" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Frontier</a></li>
                        <li><a href="/providers/windstream" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Windstream</a></li>
                        <li><a href="/providers/centurylink" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">CenturyLink</a></li>
                        <li><a href="/providers/earthlink" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">EarthLink</a></li>
                        <li><a href="/providers/hughesnet" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Hughesnet</a></li>
                        <li><a href="/providers/viasat" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Viasat</a></li>
                        <li><a href="/providers/t-mobile" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">T-Mobile</a></li>
                    </ul>
                </li>
                <li class="menu-item" data-submenu="submenu-home_security">
                    <a href="#" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Home Security</a>
                    <ul id="submenu-home_security" class="submenu bg-transparent sm:bg-white pl-5 sm:pl-0 border-l sm:border-none mt-1 md:!mt-0 md:absolute static top-[3.7rem] md:w-40 w-full grid gap-3 z-50 md:shadow-xl">
                        <?php  $args = array(
                                'post_type'      => 'providers', // Custom post type name
                                'posts_per_page' => -1, // Number of posts to display
                                'order'          => 'DESC', // Order of the posts
                                'providers_types'        => 'home-security' // Order by date
                            );

                            // Custom query to fetch posts
                            $providers_query = new WP_Query($args);

                            // The Loop
                            if ($providers_query->have_posts()) :
                                while ($providers_query->have_posts()) : $providers_query->the_post();
                                ?>   <li><a href="<?php the_permalink()?>" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]"><?php the_title()?></a></li><?php 
                                endwhile;
                            else :
                                echo '<p>No providers found.</p>';
                            endif;

                            // Reset post data to avoid conflicts
                            wp_reset_postdata();
                            ?>
                    </ul>
                </li>
                <li><a href="<?php echo home_url('/providers'); ?>" class="text-base font-normal text-[#215690] hover:text-[#ef9831] font-[Roboto]">Providers</a></li>
                <!-- <li><a href="tel:833-592-0098" class="items-center gap-2 text-[#ef9831] font-[Roboto] flex justify-end">
                    <i class="lu-phone-call">
                        <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none">
                            <path d="M16.5562 12.9062L16.1007 13.359C16.1007 13.359 15.0181 14.4355 12.0631 11.4972C9.10812 8.55901 10.1907 7.48257 10.1907 7.48257L10.4775 7.19738C11.1841 6.49484 11.2507 5.36691 10.6342 4.54348L9.37326 2.85908C8.61028 1.83992 7.13596 1.70529 6.26145 2.57483L4.69185 4.13552C4.25823 4.56668 3.96765 5.12559 4.00289 5.74561C4.09304 7.33182 4.81071 10.7447 8.81536 14.7266C13.0621 18.9492 17.0468 19.117 18.6763 18.9651C19.1917 18.9171 19.6399 18.6546 20.0011 18.2954L21.4217 16.883C22.3806 15.9295 22.1102 14.2949 20.8833 13.628L18.9728 12.5894C18.1672 12.1515 17.1858 12.2801 16.5562 12.9062Z" fill="#1C274C"/>
                        </svg>
                    </i>
                    <span class="text-base font-normal">833-592-0098</span>
                </a></li> -->
            </ul>
            <?php wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container'      => 'nav',
                'container_class'=> 'flex flex-col space-y-4',
                'menu_class'     => 'space-y-4',
                'walker'         => new Tailwind_Nav_Walker(),
            ) ); ?>
        </div>
    </nav>
</header>
