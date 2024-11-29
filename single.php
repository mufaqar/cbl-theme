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

<main class="bg-[#215690]">
	<header class="py-12">
		<div class="px-4 mx-auto w-full max-w-screen-xl text-center">
			<span class="block mb-4 font-semibold text-white">Published <time class="font-normal text-gray-500 dark:text-gray-400" pubdate class="uppercase" datetime="2022-03-08" title="August 3rd, 2022">August 3, 2022, 2:20am EDT</time></span>
			<h1 class="mx-auto mb-4 max-w-2xl text-2xl text-white font-extrabold leading-none sm:text-3xl lg:text-4xl"><?php the_title()?></h1>
			<p class="text-lg font-normal text-gray-500 dark:text-gray-400">Before going digital, you might scribbling down some ideas in a sketchbook.</p>
		</div>
	</header>
</main>


<div class="flex relative max-w-[900px] w-full z-20 justify-between px-4 mx-auto bg-white rounded mb-20">
    <article class="w-full max-w-none format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
        <div class="flex mb-5 flex-col lg:flex-row justify-between lg:items-center py-6 border-t border-b border-gray-200 dark:border-gray-700 not-format">
            <span class="text-base mb-4 lg:mb-0 font-normal text-gray-500 dark:text-gray-400">
                By <a href="#" rel="author" class="font-bold text-gray-900 no-underline hover:underline">Jese Leos</a> in <a href="#" class="font-normal text-gray-500 dark:text-gray-400 no-underline hover:underline">World News</a>
            </span>
            <aside aria-label="Share social media">
                <a
                    href="#"
                    class="inline-flex items-center py-2 px-6 mr-2 text-xs font-medium text-gray-900 no-underline bg-white rounded-lg border border-gray-200 focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                >
                    <svg class="mr-2 w-4 h-4" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"
                        />
                    </svg>
                    Share
                </a>
                <a
                    href="#"
                    class="inline-flex items-center py-2 px-6 mr-2 text-xs font-medium text-gray-900 no-underline bg-white rounded-lg border border-gray-200 focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                >
                    <svg class="mr-2 w-4 h-4" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                        />
                    </svg>
                    Tweet
                </a>
                <button
                    type="button"
                    class="inline-flex items-center py-2 px-6 text-xs font-medium text-gray-900 no-underline bg-white rounded-lg border border-gray-200 focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                >
                    <svg class="mr-2 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            fill-rule="evenodd"
                            d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    Copy link
                </button>
            </aside>
        </div>
        <p class="lead">Flowbite is an open-source library of UI components built with the utility-first classes from Tailwind CSS. It also includes interactive elements such as dropdowns, modals, datepickers.</p>
        <p>Before going digital, you might benefit from scribbling down some ideas in a sketchbook. This way, you can think things through before committing to an actual design project.</p>
        <p>
            But then I found a <a href="https://flowbite.com">component library based on Tailwind CSS called Flowbite</a>. It comes with the most commonly used UI components, such as buttons, navigation bars, cards, form elements, and more
            which are conveniently built with the utility classes from Tailwind CSS.
        </p>
        <figure class="py-6">
            <img src="https://flowbite.s3.amazonaws.com/typography-plugin/typography-image-1.png" alt="" class="mx-auto w-full" />
            <figcaption class="text-center mt-2">Digital art by Anonymous</figcaption>
        </figure>
        <h2 class="font-semibold mb-2 text-xl">Getting started with Flowbite</h2>
        <p class="mb-1">First of all you need to understand how Flowbite works. This library is not another framework. Rather, it is a set of components based on Tailwind CSS that you can just copy-paste from the documentation.</p>
        <p class="mb-1">It also includes a JavaScript file that enables interactive components, such as modals, dropdowns, and datepickers which you can optionally include into your project via CDN or NPM.</p>
        <p class="mb-1">
            You can check out the <a href="https://flowbite.com/docs/getting-started/quickstart/">quickstart guide</a> to explore the elements by including the CDN files into your project. But if you want to build a project with Flowbite I
            recommend you to follow the build tools steps so that you can purge and minify the generated CSS.
        </p>
        <p class="mb-1">
            You'll also receive a lot of useful application UI, Publisher UI, and e-commerce pages that can help you get started with your projects even faster. You can check out this
            <a href="https://flowbite.com/docs/components/tables/">comparison table</a> to better understand the differences between the open-source and pro version of Flowbite.
        </p>
        <h2 class="font-semibold mb-2 text-xl">When does design come in handy?</h2>
        <p class="mb-1">While it might seem like extra work at a first glance, here are some key moments in which prototyping will come in handy:</p>
        <ol>
            <li>
                <strong>Usability testing</strong>. Does your user know how to exit out of screens? Can they follow your intended user journey and buy something from the site you’ve designed? By running a usability test, you’ll be able to
                see how users will interact with your design once it’s live;
            </li>
            <li><strong>Involving stakeholders</strong>. Need to check if your GDPR consent boxes are displaying properly? Pass your prototype to your data protection team and they can test it for real;</li>
            <li><strong>Impressing a client</strong>. Prototypes can help explain or even sell your idea by providing your client with a hands-on experience;</li>
            <li><strong>Communicating your vision</strong>. By using an interactive medium to preview and test design elements, designers and developers can understand each other — and the project — better.</li>
        </ol>
    </article>
</div>


<!-- <main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'cbl_theme' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'cbl_theme' ) . '</span> <span class="nav-title">%title</span>',
			)
		);

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

</main>#main -->


	

<?php get_footer(); ?>
