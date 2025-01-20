<?php

// global $wp_query;

// // Get all query variables
// $query_vars = $wp_query->query_vars;

// print "<pre>";
// print_r($query_vars);

$state = get_query_var('state');
$city = get_query_var('city');
$zipcode = get_query_var('zipcode');

$URL = '';

// Check if the state, city, and zipcode exist and build the URL accordingly
if ($state && $city && $zipcode) {
    // All three exist: state, city, and zipcode
    $URL = "$state/$city/$zipcode/";
} elseif ($state && $city) {
    // Only state and city exist
    $URL = "$state/$city/";
} elseif ($state) {
    // Only state exists
    $URL = "$state/";
} else {
    // None of the parameters exist
    $URL = '/';
}



    $links = [
        'Internet Providers' => home_url('/internet/' . $URL),
        'TV Providers' => home_url('/tv/' . $URL),
        'Landline Providers' => home_url('/landline/' . $URL),
        'Home Security' => home_url('/home-security/' . $URL),
    ];


?>



<section class="bg-[#215690] py-4 shadow-sm border-y border-zinc-400/20 sticky top-0">
    <div class="container mx-auto px-4 flex md:flex-row flex-col gap-5 justify-between items-center">
        <div class="text-white md:text-base text-xs">Explore Home Services in 
<?php if (empty($zipcode)): ?>
    <?php if (!empty($city)): ?>
        <?php echo FormatData($city); ?>,
    <?php endif; ?>
 
<?php endif; ?>

<?php if (!empty($zipcode)): ?>
    <?php echo $zipcode; ?>,
    <?php endif; ?>



<?php echo strtoupper($state) ?> 




</div>
        <div>
            <ul class="flex md:gap-3 gap-1.5 items-center">
                <?php foreach ($links as $label => $href): ?>
                    <li>
                        <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="<?php echo $href; ?>">
                            <?php echo $label; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>