<?php 

/** Template Name: FrontPage */
 get_header();

?>

<!-- Hero Section -->
<section class="min-h-screen h-full flex items-center bg-cover bg-center bg-no-repeat bg-blend-overlay bg-black/50" style="background-image: url('https://www.cablemovers.net/images/slide3.jpg');">
  <div class="container mx-auto px-4 gap-7 items-center">
    <div class="py-10">
      <h1 class="text-3xl md:text-5xl text-center md:leading-tight font-semibold text-white">Find the Best  <span class="text-[#ef9831]">TV, Internet, Landline and Home Security providers </span> in Your Area.</h1>
      <p class="text-[22px] text-center md:px-24 font-normal text-white my-5">Compare Top Providers, plans and deals by ZIP code.</p>
      <?php get_template_part('template-parts/search', 'form'); ?>
    </div>
    <div class=""></div>
  </div>
</section>

<!-- TV Providers / Internet Providers -->
<section class="pt-16">
  <div class="max-w-[1110px] w-full mx-auto px-4">
        <div class="providers_slides">
             <?php
                    // Arguments for the WP Query
                    $args = array(
                        'post_type'      => 'providers', // Custom post type name
                        'posts_per_page' => -1, // Number of posts to display
                        'order'          => 'DESC', // Order of the posts
        
                    );
                    // Custom query to fetch posts
                    $providers_query = new WP_Query($args);
                    // The Loop
                    if ($providers_query->have_posts()) :
                        while ($providers_query->have_posts()) : $providers_query->the_post();
                            get_template_part('template-parts/box', 'provider_slide');
                        endwhile;
                    else :
                        echo '<p>No providers found.</p>';
                    endif;

                    // Reset post data to avoid conflicts
                    wp_reset_postdata();
                ?>

          </div>
    </div>


</section>
<div class="max-w-[1110px] w-full mx-auto h-[1px] bg-black/20 my-10"></div>

<!-- How it Works? -->
<section class="py-16">
  <div class="max-w-[1110px] w-full mx-auto px-4">
    <div class="mb-10">
      <h2 class="text-center md:text-4xl text-2xl font-semibold">How it Works?</h2>
    </div>
    <div class="relative grid gap-7 md:grid-cols-3">
      <!-- Step 1 -->
      <div class="w-full py-5 bg-white rounded-3xl">
        <div class="mt-5">
          <span class="block">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="text-6xl text-[#215690] mx-auto" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </span>
          <h2 class="mt-5 text-center text-2xl font-semibold">Search</h2>
          <div>
            <p class="px-5 mt-5 text-base text-center">Find providers in your area with a simple zip code search.</p>
          </div>
        </div>
      </div>
      <!-- Step 2 -->
      <div class="w-full py-5 bg-white rounded-3xl">
        <div class="mt-5">
          <span class="block">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="text-6xl text-[#215690] mx-auto" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.01 2c-1.93 0-3.5 1.57-3.5 3.5 0 1.58 1.06 2.903 2.5 3.337v7.16c-.001.179.027 1.781 1.174 2.931C6.892 19.64 7.84 20 9 20v2l4-3-4-3v2c-1.823 0-1.984-1.534-1.99-2V8.837c1.44-.434 2.5-1.757 2.5-3.337 0-1.93-1.571-3.5-3.5-3.5zm0 5c-.827 0-1.5-.673-1.5-1.5S5.183 4 6.01 4s1.5.673 1.5 1.5S6.837 7 6.01 7zm13 8.163V7.997C19.005 6.391 17.933 4 15 4V2l-4 3 4 3V6c1.829 0 2.001 1.539 2.01 2v7.163c-1.44.434-2.5 1.757-2.5 3.337 0 1.93 1.57 3.5 3.5 3.5s3.5-1.57 3.5-3.5c0-1.58-1.06-2.903-2.5-3.337zm-1 4.837c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5 1.5.673 1.5 1.5-.673 1.5-1.5 1.5z"></path>
            </svg>
          </span>
          <h2 class="mt-5 text-center text-2xl font-semibold">Compare</h2>
          <div>
            <p class="px-5 mt-5 text-base text-center">Compare plans and prices from available providers in your area.</p>
          </div>
        </div>
      </div>
      <!-- Step 3 -->
      <div class="w-full py-5 bg-white rounded-3xl">
        <div class="mt-5">
          <span class="block">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="text-6xl text-[#215690] mx-auto" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </span>
          <h2 class="mt-5 text-center text-2xl font-semibold">Order</h2>
          <div>
            <p class="px-5 mt-5 text-base text-center">Give us a call, we’ll help you setup your service.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Divider -->
  <div class="max-w-[1110px] w-full mx-auto h-[1px] bg-black/20 my-16"></div>


</section>



<!-- Why Choose Cable Movers? -->
<section class="py-16  bg-[#F3FAFF]">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="text-center md:text-4xl text-2xl font-bold">Why Choose Cable Movers?</h2>
            <p class="text-xl font-normal my-4">
                Finding TV and Internet Service Providers is complex and time consuming but cable movers make the search process so easy and simple that saves you time and money. Here’s why you should shop with us.
            </p>
        </div>
        <div class="mt-8 grid md:grid-cols-2 grid-cols-1 gap-7">
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 640 512" class="h-10 w-10 text-[#215690]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5l-20.9 16.2L512 316.8V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2zm22.8 124.4l-51.7 40.2C263 274.4 217.3 268 193.7 235.6c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48V352h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8l-134.2-123zM16 128c-8.8 0-16 7.2-16 16V352c0 17.7 14.3 32 32 32H64c17.7 0 32-14.3 32-32V128H16zM48 320a16 16 0 1 1 0 32 16 16 0 1 1 0-32zM544 128V352c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V144c0-8.8-7.2-16-16-16H544zm32 208a16 16 0 1 1 32 0 16 16 0 1 1 -32 0z"
                    ></path>
                </svg>
                <h2 class="mt-4 text-xl font-bold">Convenience</h2>
                <p class="mt-1 text-base">
                    Cable Movers can simplify the task of setting up your Internet or TV service. Instead of searching individual provider sites do all your research, compare plans and order service all on one site.
                </p>
            </div>
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="h-10 w-10 text-[#215690]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"
                    ></path>
                </svg>
                <h2 class="mt-4 text-xl font-bold">Time Savings</h2>
                <p class="mt-1 text-base">Cable Movers can help you save time. Enter your zip code once and compare all options available at your address.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" class="h-10 w-10 text-[#215690]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zm64 320H64V320c35.3 0 64 28.7 64 64zM64 192V128h64c0 35.3-28.7 64-64 64zM448 384c0-35.3 28.7-64 64-64v64H448zm64-192c-35.3 0-64-28.7-64-64h64v64zM288 160a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"
                    ></path>
                </svg>
                <h2 class="mt-4 text-xl font-bold">Cost Savings</h2>
                <p class="mt-1 text-base">Instead of tracking offers from multiple provider websites, compare current prices in real time at Cable Movers and get the best deal that fit your budget.</p>
            </div>
            <div class="block rounded-xl border border-gray-100 p-8 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="h-10 w-10 text-[#215690]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M224 256A128 128 0 1 1 224 0a128 128 0 1 1 0 256zM209.1 359.2l-18.6-31c-6.4-10.7 1.3-24.2 13.7-24.2H224h19.7c12.4 0 20.1 13.6 13.7 24.2l-18.6 31 33.4 123.9 36-146.9c2-8.1 9.8-13.4 17.9-11.3c70.1 17.6 121.9 81 121.9 156.4c0 17-13.8 30.7-30.7 30.7H285.5c-2.1 0-4-.4-5.8-1.1l.3 1.1H168l.3-1.1c-1.8 .7-3.8 1.1-5.8 1.1H30.7C13.8 512 0 498.2 0 481.3c0-75.5 51.9-138.9 121.9-156.4c8.1-2 15.9 3.3 17.9 11.3l36 146.9 33.4-123.9z"
                    ></path>
                </svg>
                <h2 class="mt-4 text-xl font-bold">Expert Advice</h2>
                <p class="mt-1 text-base">Our trained agents can answer any service related question and recommend the best options available in your area.</p>
            </div>
        </div>
    </div>
</section>



<?php get_footer() ?>