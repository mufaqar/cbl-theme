<?php
$index = get_query_var('provider_index');
$phone = get_field( "pro_phone" );
$logoArray = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$logoUrl = esc_url( $logoArray[0]);

$type = get_query_var('type');
$servicesInfo = get_field('services_info');


if ($type == 'internet') {
    $services = $servicesInfo["internet_services"];
} elseif ($type == 'tv') {
    $services = $servicesInfo["tv_services"];
    $channels = $services['channels'];
} elseif ($type == 'landline') {
    $services = $servicesInfo["landline_services"];
} else {
    $services = $servicesInfo["home_security_services"];
}

//var_dump($services);

// var_dump($services);
$price =  $services['price'];
$speed =  $services['speed'];
$phone =  $services['phone'];
$view_link =  $services['view_more'];
$deals =  $services['deals'];
$features = $services['features'];
$pacakge_info = $services['pacakge_info'];
$features_items  = explode(',', $features); 








?>


<div class="grid gap-7 mb-7">
    <div class="w-full h-auto shadow-xl border rounded-t-md rounded-b-md flex flex-col">
        <div class="md:w-full min-w-fit bg-[#215690] flex justify-between items-center">
            <h2 class="text-base font-bold text-center text-white p-5"><span> <?php echo $index ?> </span>-
                <?php the_title()?></h2>
            <h2 class="text-base font-bold text-center text-white p-5"> <?php  if($deals){ echo $deals; }?></h2>
        </div>
        <div class="md:w-full w-full grid grid-cols-1 dtable  <?php echo $type == 'home-security' || $type == 'landline' ? 'md:grid-cols-4' : 'md:grid-cols-5'; ?> flex-col ">
            <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                <a target="_blank" href="<?php the_permalink()?>">
                    <img alt="Feature Image" loading="lazy" width="140" height="50" decoding="async" data-nimg="1"
                        src="<?php echo $logoUrl ?>" style="color: transparent;" />
                </a>
            </div>
            <?php if (!in_array($type, ['home-security', 'landline'])) : ?>
                <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                    <div class="text-center">
                        <p class="tch"><?php echo $type == 'tv' ? 'Channels' : 'Speed from'; ?></p>
                        <span class="tcd">
                            <?php echo $type == 'tv' ? $channels."+" : $speed . ' Mbps'; ?>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5 px-3">
                    <?php  display_features_list($features_items);   ?>
            </div>
            <div class="md:border-r border-r-0 md:border-b-0 border-b grid items-center justify-center p-5">
                <div>
                    <p class="tch"> <?php echo $type == 'home-security'  ? 'Monitoring' : 'Pricing'; ?> starts from  </p>
                    <p class="tcd"><span class="font-extrabold text-[#215690] font-[Roboto] text-xl">
                            $<?php echo $price; ?> </span> /mo.</p>
                            <?php if (in_array($type, ['landline'])) : ?>
                            <p class="tch text-sm">
                            <?php echo $pacakge_info; ?></p>
                            <?php endif; ?>
                </div>
            </div>
            <?php echo render_provider_buttons($phone, $view_link); ?>
        </div>
    </div>
</div>