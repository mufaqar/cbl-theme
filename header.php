<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- <meta name="robots" content="noindex, nofollow" /> -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
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
        <div id="menu" class="sm:w-2/3 bg-gray-100 w-full sm:bg-white shadow-xl !h-[50px] sm:shadow-none z-10 sm:justify-end sm:static absolute left-0 sm:py-0 py-7 sm:px-0 px-5 flex items-center">
            <?php wp_nav_menu( array( 
                'theme_location' => 'main', 
                'container'      => '',
                'container_class'=> 'flex flex-col space-y-4',
                'menu_class'     => 'flex sm:flex-row flex-col sm:items-center md:gap-[3vw] gap-5',
            )); 
            ?>
        </div>
    </nav>
</header>
