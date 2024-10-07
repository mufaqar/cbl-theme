<div class="block rounded-xl border border-gray-100 p-3 shadow-xl transition hover:border-[#215690]/10 hover:shadow-[#215690]/10  ">
  <a href="<?php the_permalink() ?>" class="flex flex-col justify-center items-center">
    <?php if (has_post_thumbnail()) {
      the_post_thumbnail('full');
    } else { ?>
      <img src="<?php bloginfo('template_directory'); ?>/images/img5.jpg" alt="<?php the_title() ?>" class="w-[144px]" />
    <?php } ?>
    <h2 class="mt-4 text-lg  text-center"><?php the_title() ?></h2>
  </a>
</div>