<?php
/** Template Name: Contact Us */

get_header();
?>

<section class="py-24 bg-[#215690]">
    <div class="container mx-auto px-4">
        <h1 class="sm:text-5xl text-4xl leading-normal font-semibold text-white text-center">Contact Us</h1>
    </div>
</section>

<section class="pb-16 -mt-12">
    <div class="container mx-auto px-4">
        <div class="w-full flex items-center justify-center">
            <form class="bg-white shadow-xl rounded py-10 lg:px-28 px-8">
                <h3 class="md:text-3xl text-xl font-bold leading-7 text-center">Have question?</h3>
                <p class="text-xl font-normal mt-3">We’re here to help. Leave a message and we’ll get you an answer soon.</p>
                <div class="md:flex w-full gap-5 items-center mt-12">
                    <div class="md:w-1/2 flex flex-col">
                        <label class="text-base font-semibold leading-none">Name</label>
                        <input
                            name="name"
                            tabindex="0"
                            arial-label="Please input name"
                            type="name"
                            class="text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-indigo-700 mt-4 bg-gray-100 border rounded border-gray-200 placeholder-gray-100"
                            placeholder="Please input name"
                        />
                    </div>
                    <div class="md:w-1/2 flex flex-col md:mt-0 mt-7">
                        <label class="text-base font-semibold leading-none">Email</label>
                        <input
                            name="email"
                            type="email"
                            class="text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-indigo-700 mt-4 bg-gray-100 border rounded border-gray-200 placeholder-gray-100"
                            placeholder="Please input email address"
                        />
                    </div>
                </div>
                <div class="md:flex w-full gap-5 items-center mt-8">
                    <div class="md:w-1/2 flex flex-col">
                        <label class="text-base font-semibold leading-none">Phone number</label>
                        <input
                            name="phone"
                            type="tel"
                            class="text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-indigo-700 mt-4 bg-gray-100 border rounded border-gray-200 placeholder-gray-100"
                            placeholder="Phone number"
                        />
                    </div>
                    <div class="md:w-1/2 flex flex-col md:mt-0 mt-7">
                        <label class="text-base font-semibold leading-none">Subject</label>
                        <select name="subject" id="subject" class="text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-indigo-700 mt-4 bg-gray-100 border rounded border-gray-200 placeholder-gray-100">
                            <option>Select a Subject</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="New Service for my Home">New Service for my Home</option>
                            <option value="ISP: New/Update Listing">ISP: New/Update Listing</option>
                            <option value="Advertising Opportunities">Advertising Opportunities</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="w-full flex flex-col mt-8">
                        <label class="text-base font-semibold leading-none">Comments</label>
                        <textarea
                            name="comment"
                            tabindex="0"
                            aria-label="leave a Comments"
                            role="textabbox"
                            class="h-36 text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-indigo-700 mt-4 bg-gray-100 border rounded border-gray-200 placeholder-gray-100 resize-none"
                        ></textarea>
                    </div>
                </div>
                <div class="flex items-center justify-center w-full"><input type="submit" class="mt-9 text-base font-semibold leading-none text-white py-4 px-10 bg-[#ef9831] hover:bg-[#215690]" value="SUBMIT" /></div>
            </form>
        </div>
    </div>
</section>




                                            


<?php get_footer(); ?>
