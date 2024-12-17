<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

get_header();
?>


<section class="min-h-[40vh] flex items-center bg-gray-50"> 
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-col items-center">
            <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">
                Internet Providers in <br />
                ZIP Code <span class="text-[#ef9831]">20001</span>
            </h1>
            <p class="text-xl text-center font-[Roboto] my-5">Enter your zip so we can find the best Internet Providers in your area:</p>
            <?php get_template_part('template-parts/filter', 'form'); ?>
        </div>
    </div>
</section>

<section class="bg-[#215690] py-4 shadow-sm border-y border-zinc-400/20 sticky top-0">
    <div class="container mx-auto px-4">
        <div>
            <ul class="flex md:gap-3 gap-1.5 items-center">
                <li>
                    <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/internet/zip-20001">Internet Providers</a>
                </li>
                <li><a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/tv/zip-20001">TV Providers</a></li>
                <li>
                    <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/internet-tv/zip-20001">
                        Internet and TV Providers
                    </a>
                </li>
                <li>
                    <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="/landline/zip-20001">Landline Providers</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold capitalize leading-10">Internet Providers in <span class="text-[#ef9831]">20001 </span></h2>
        </div>
        <div class="grid gap-7">
            <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex flex-col">
                <div class="md:w-full min-w-fit bg-[#215690] flex justify-between items-center">
                    <h2 class="text-base font-bold text-center text-white p-5"><span> 1 </span>- Xfinity</h2>
                    <h2 class="text-base font-bold text-center text-white p-5"></h2>
                </div>
                <div class="md:w-full w-full grid grid-cols-1 dtable md:grid-cols-5 flex flex-col">
                    <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                        <a target="_blank" href="/providers/xfinity">
                            <img
                                alt="Feature Image"
                                loading="lazy"
                                width="140"
                                height="50"
                                decoding="async"
                                data-nimg="1"
                                src="https://www.cablemovers.net/_next/image?url=https%3A%2F%2Fcblproject.cablemovers.net%2Fwp-content%2Fuploads%2F2023%2F08%2Fxfinity.jpg&w=256&q=75"
                                style="color: transparent;"
                            />
                        </a>
                    </div>
                    <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                        <div class="text-center">
                            <p class="tch">Speeds from</p>
                            <p class="tcd">75-1200 Mbps</p>
                        </div>
                    </div>
                    <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5 px-3">
                        <ul class="grid items-center justify-center">
                            <li class="flex gap-2 items-center">
                                <svg class="min-w-[1rem] h-4 text-[#ef9831] font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm">Fast and secure</span>
                            </li>
                            <li class="flex gap-2 items-center">
                                <svg class="min-w-[1rem] h-4 text-[#ef9831] font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm">99.9% network reliability</span>
                            </li>
                            <li class="flex gap-2 items-center">
                                <svg class="min-w-[1rem] h-4 text-[#ef9831] font-extrabold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm">Wall-to-wall WiFi coverage with xFi </span>
                            </li>
                        </ul>
                    </div>
                    <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                        <div>
                            <p class="tch">Pricing starts from</p>
                            <p class="tcd"><span class="font-extrabold text-[#215690] font-[Roboto] text-xl"> $19.99 </span> /mo.</p>
                        </div>
                    </div>
                    <?php echo render_provider_buttons("844-581-1129", "/providers/xfinity"); ?>
                </div>
            </div>
        </div>
        <div><p class="text-sm font-[Roboto] mt-10">*DISCLAIMER: Availability vary by service address. not all offers available in all areas, pricing subject to change at any time. Additional taxes, fees, and terms may apply.</p></div>
    </div>
</section>





<?php

get_footer();
