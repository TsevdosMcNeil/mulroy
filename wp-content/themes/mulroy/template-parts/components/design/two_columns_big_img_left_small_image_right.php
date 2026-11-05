<?php

$left_post  = get_sub_field('left_side_design_post_url');
$right_post = get_sub_field('right_side_design_post_url');

$left_image  = get_sub_field('left_side_design_image');
$right_image = get_sub_field('right_side_design_image');

?>

<!-- template-parts/components/design/two_columns_big_img_left_small_image_right.php -->
<section class="scroll-section site-container bg-site container-py no_min_height_mobile design__page__section__padding">

  <div class="flex flex-col h-full lg:grid grid-cols-12 inside__design">
    <?php if ($left_post): ?>
      <div class="col-start-1 col-end-6 self-center">
        <?php
        get_template_part(
          'template-parts/components/design/project-card',
          null,
          [
            'post_id' => $left_post?->ID,
            'image'   => $left_image,
          ]
        );
        ?>
      </div>
    <?php endif; ?>

    <div class="col-start-4 col-end-13 self-center">
      <?php if ($right_post): ?>
        <div class="flex items-center h-full">
          <?php
          get_template_part(
            'template-parts/components/design/project-card',
            null,
            [
              'post_id' => $right_post?->ID,
              'image'   => $right_image,
            ]
          );
          ?>
        </div>
      <?php endif; ?>
    </div>

  </div>

</section>