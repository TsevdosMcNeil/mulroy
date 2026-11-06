<?php

// 'one' shows only the left project, 'two' (default) shows both.
$project_count = get_sub_field('project_count') ?: 'two';

$left_post   = get_sub_field('left_side_design_post_url');
$left_image  = get_sub_field('left_side_design_image');

$right_post  = $project_count === 'two' ? get_sub_field('right_side_design_post_url') : null;
$right_image = $project_count === 'two' ? get_sub_field('right_side_design_image') : null;

?>

<!-- template-parts/components/design/two_columns_big_image_right_small_image_left.php -->
<section
  id="big-img-right-small-img-left"
  class="scroll-section site-container bg-site container-py no_min_height_mobile design__page__section__padding"
  style="min-height:auto;">
  <div class="flex flex-col lg:grid grid-cols-12 gap-y-10 h-full inside__design gap-x-5">

    <?php if ($left_post): ?>
      <div class="small-img col-start-2 col-end-7">
        <?php
        get_template_part(
          'template-parts/components/design/project-card',
          null,
          [
            'post_id' => $left_post->ID,
            'image'   => $left_image,
          ]
        );
        ?>
      </div>
    <?php endif; ?>

    <?php if ($right_post): ?>
      <div class="col-start-7 col-end-13">
        <?php
        get_template_part(
          'template-parts/components/design/project-card',
          null,
          [
            'post_id' => $right_post->ID,
            'image'   => $right_image,
            'class'   => 'h-full block',
          ]
        );
        ?>
      </div>
    <?php endif; ?>

  </div>
</section>
<!-- End template-parts/components/design/two_columns_big_image_right_small_image_left.php -->