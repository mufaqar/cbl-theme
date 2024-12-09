<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CBL_Theme
 */

get_header();
$post_id = get_the_ID();
$meta_description = get_post_meta($post_id, '_yoast_wpseo_metadesc', true);
$thumbnail_url = get_the_post_thumbnail_url($post_id, 'full'); // 'full' or other sizes
$thumbnail_id = get_post_thumbnail_id(); // Get the ID of the featured image
$caption = wp_get_attachment_caption($thumbnail_id);

?>

<main class="bg-[#215690]">
	<header class="py-12">
		<div class="px-4 mx-auto w-full max-w-screen-xl text-center">
			<span class="block mb-4 font-semibold text-white">Published <time class="font-normal text-gray-500 dark:text-gray-400" pubdate class="uppercase" datetime="2022-03-08" title="August 3rd, 2022"><?php echo get_the_date('F j, Y'); ?></time></span>
			<h1 class="mx-auto mb-4 max-w-2xl text-2xl text-white font-extrabold leading-none sm:text-3xl lg:text-4xl"><?php the_title()?></h1>
			<p class="text-lg font-normal text-gray-500 dark:text-gray-400"><?php echo esc_html($meta_description) ?></p>
		</div>
	</header>
</main>


<div class="flex relative max-w-[900px] w-full z-20 justify-between px-4 mx-auto bg-white rounded mb-20">
    <article class="w-full max-w-none format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
        <div class="flex mb-5 flex-col lg:flex-row justify-between lg:items-center py-6 border-t border-b border-gray-200 dark:border-gray-700 not-format">
            <span class="text-base mb-4 lg:mb-0 font-normal text-gray-500 dark:text-gray-400">
                By <a href="#" rel="author" class="font-bold text-gray-900 no-underline hover:underline capitalize"><?php echo get_the_author(); ?></a> in <a href="<?php echo get_home_url(); ?>" class="font-normal text-gray-500 dark:text-gray-400 no-underline hover:underline">Cablemovers</a>
            </span>
            <aside aria-label="Share social media">
                <a
                    href="<?php echo esc_url("#"); ?>" target="_blank"
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
                    href="<?php echo esc_url("#"); ?>" target="_blank"
                    class="inline-flex items-center py-2 px-6 mr-2 text-xs font-medium text-gray-900 no-underline bg-white rounded-lg border border-gray-200 focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                >
                <svg version="1.1" id="Layer_1" width="24px" height="24px" viewBox="0 0 24 24" class="mr-2 w-4 h-4" xml:space="preserve"><path d="M14.095479,10.316482L22.286354,1h-1.940718l-7.115352,8.087682L7.551414,1H1l8.589488,12.231093L1,23h1.940717  l7.509372-8.542861L16.448587,23H23L14.095479,10.316482z M11.436522,13.338465l-0.871624-1.218704l-6.924311-9.68815h2.981339  l5.58978,7.82155l0.867949,1.218704l7.26506,10.166271h-2.981339L11.436522,13.338465z"/></svg>
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

        <section>
            <?php
                if (have_posts()) : 
                    while (have_posts()) : the_post();
                        echo '<p>' . get_the_excerpt() . '</p>';
                    endwhile; 
                endif;
            ?>
        </section>
       

        <figure class="py-6">
            <?php
               if ($thumbnail_url) {
                echo '<img src="' . esc_url($thumbnail_url) . '" alt="Post Thumbnail">';
               }
            ?>
            <figcaption class="text-center mt-2"><?php echo esc_html($caption) ?></figcaption>
        </figure>

        <section class="the_content">
            <?php echo get_the_content(); ?>
        </section>
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
