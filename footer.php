<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CBL_Theme
 */

 $navLinks = [
  [
      'name' => 'About Us',
      'link' => '/about-us',
  ],
  [
      'name' => 'Contact Us',
      'link' => '/contact-us',
  ],
  [
      'name' => 'Privacy Policy',
      'link' => '/privacy-policy',
  ],
  [
      'name' => 'Do Not Sell My Information',
      'link' => '/do-not-sell-my-information',
  ],
  [
      'name' => 'Terms And Conditions',
      'link' => '/terms-and-conditions',
  ]
];

$providersData = [
  [
      'name' => 'Spectrum',
      'link' => '/providers/spectrum',
  ],
  [
      'name' => 'Mediacom',
      'link' => '/providers/mediacom',
  ],
  [
      'name' => 'Xfinity',
      'link' => '/providers/xfinity',
  ],
  [
      'name' => 'Optimum',
      'link' => '/providers/optimum',
  ],
  [
      'name' => 'Cox',
      'link' => '/providers/cox',
  ],
  [
      'name' => 'Astound Broadband',
      'link' => '/providers/astound-broadband',
  ],
  [
      'name' => 'TDS',
      'link' => '/providers/tds',
  ],
  [
      'name' => 'Frontier',
      'link' => '/providers/frontier',
  ],
  [
      'name' => 'Windstream',
      'link' => '/providers/windstream',
  ],
  [
      'name' => 'Verizon',
      'link' => '/providers/verizon',
  ],
  [
      'name' => 'CenturyLink',
      'link' => '/providers/centurylink',
  ],
  [
      'name' => 'EarthLink',
      'link' => '/providers/earthlink',
  ],
  [
      'name' => 'Brightspeed',
      'link' => '/providers/brightspeed',
  ],
  [
      'name' => 'AT&T',
      'link' => '/providers/att',
  ],
  [
      'name' => 'HughesNet',
      'link' => '/providers/hughesnet',
  ],
  [
      'name' => 'Viasat',
      'link' => '/providers/viasat',
  ],
  [
      'name' => 'DISH',
      'link' => '/providers/dish',
  ],
  [
      'name' => 'DIRECTV',
      'link' => '/providers/directv',
  ],
  [
      'name' => 'WOW!',
      'link' => '/providers/wow',
  ],
  [
      'name' => 'T-Mobile',
      'link' => '/providers/t-mobile',
  ],
  [
      'name' => 'Rise Broadband',
      'link' => '/providers/rise-broadband',
  ]
];



?>
<div class="bread_crumb_wrapper"><?php cbl_breadcrumb();  ?></div>

<footer class="bg-[#000] pt-16 pb-4">
    <div class="container mx-auto px-4 grid md:grid-cols-5 grid-cols-1 gap-5">
        <!-- Footer Logo and Description -->
        <div class="col-span-2">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="https://www.cablemovers.net/_next/image?url=%2Flogo.png&w=256&q=75"
                    alt="Cable Movers footer logo" height="56" width="254" />
            </a>
            <p class="text-sm font-normal text-white/75 mt-5">
                All names, logos, trademarks displayed are the sole property of their respective owners; cablemovers.net
                employs these trademarks solely for the purpose of describing the products and services provided by each
                respective trademark holder. We offer information for comparative purposes and do not directly provide
                internet and TV services, nor do we endorse one service provider over another. We are financially
                supported by compensation from our internet and TV partners.
            </p>
            <ul class="flex gap-5 mt-5">
                <li>

                    <a href="https://www.facebook.com/cablemovers.net" class="text-white/75 hover:text-white text-2xl"
                        target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6">
                            <path
                                d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24h-1.918c-1.506 0-1.798.716-1.798 1.765v2.314h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/cablemovers" class="text-white/75 hover:text-white text-2xl"
                        target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.723-.951.564-2.005.974-3.127 1.195-.897-.956-2.178-1.555-3.594-1.555-2.717 0-4.92 2.203-4.92 4.917 0 .386.043.762.127 1.124-4.09-.205-7.719-2.165-10.148-5.144-.424.725-.666 1.567-.666 2.465 0 1.702.867 3.204 2.188 4.086-.806-.026-1.566-.247-2.228-.616v.062c0 2.377 1.693 4.356 3.946 4.804-.413.112-.849.171-1.296.171-.317 0-.626-.031-.928-.088.627 1.956 2.444 3.379 4.6 3.419-1.683 1.319-3.808 2.104-6.115 2.104-.398 0-.791-.023-1.176-.069 2.179 1.397 4.768 2.212 7.548 2.212 9.054 0 14.002-7.496 14.002-13.986 0-.213-.004-.425-.013-.636.961-.694 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/company/cablemovers-net"
                        class="text-white/75 hover:text-white text-2xl" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.23 0h-20.46c-.97 0-1.77.8-1.77 1.77v20.46c0 .97.8 1.77 1.77 1.77h20.46c.97 0 1.77-.8 1.77-1.77v-20.46c0-.97-.8-1.77-1.77-1.77zm-14.53 20.45h-3.77v-11.64h3.77v11.64zm-1.89-13.29c-1.21 0-2.18-.98-2.18-2.18s.98-2.18 2.18-2.18 2.18.98 2.18 2.18-.97 2.18-2.18 2.18zm15.45 13.29h-3.77v-5.66c0-1.35-.03-3.08-1.88-3.08-1.88 0-2.17 1.47-2.17 2.98v5.75h-3.77v-11.64h3.62v1.59h.05c.5-.96 1.74-1.98 3.58-1.98 3.83 0 4.54 2.52 4.54 5.8v6.22z" />
                        </svg>
                    </a>
                </li>
            </ul>

        </div>
        <!-- Providers Section -->
        <div class="col-span-2">
            <h6 class="text-lg font-normal text-white mb-5">
                PROVIDERS
            </h6>

            <?php wp_nav_menu( array( 'theme_location' => 'footer', 
                'container'      => '',
                'container_class'=> 'flex flex-col space-y-4',
                'menu_class'     => 'space-y-4',
                 ) ); ?>




        </div>
        <!-- Company Section -->
        <div>
            <h6 class="text-lg font-normal text-white mb-5">
                COMPANY
            </h6>


            <?php wp_nav_menu( array( 'theme_location' => 'company','fallback_cb'=> 'fallbackmenu1' ) ); ?>

        </div>
    </div>
    <!-- Footer Bottom Section -->
    <div class="container mx-auto px-4 mt-12 pt-4 border-t border-white/20">
        <p class="text-sm font-normal text-white/75">
            Copyright © 2024 CableMovers.net. All rights reserved.
        </p>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");

    menuToggle.addEventListener("click", function() {
        menu.classList.toggle("hidden");
    });
});
</script>
<!-- Scripts  -->
<script>


</script>
<!-- X Scripts X -->



</body>

</html>