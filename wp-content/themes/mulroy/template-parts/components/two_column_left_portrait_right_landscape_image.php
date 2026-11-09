<?php
$left_side_image = get_sub_field('left_side_image');
$left_side_heading = get_sub_field('left_side_heading');
$right_side_image = get_sub_field('right_side_image');
$right_side_heading = get_sub_field('right_side_heading');
?>
<!-- template-parts/components/two_column_left_portrait_right_landscape_image.php -->
<section class="scroll-section bg-site site-container no_min_height_mobile pt-8 lg:pt-[4.17vw] consistent__space__single__project__mobile" style="min-height:auto;">
  <div class="flex flex-col lg:grid grid-cols-12 items-center gap-y-[3rem] lg:gap-y-0">
    <div class="col-start-1 col-end-5">
      <?php
      get_template_part(
        'template-parts/components/column-image',
        null,
        [
          'image'       => $left_side_image,
          'heading'     => $left_side_heading,
          'image_class' => 'portrait-img',
        ]
      );
      ?>
    </div>
    <div class="col-start-6 col-end-11">
      <?php
      get_template_part(
        'template-parts/components/column-image',
        null,
        [
          'image'   => $right_side_image,
          'heading' => $right_side_heading,
        ]
      );
      ?>
    </div>
  </div>
</section>
<!-- End template-parts/components/two_column_left_portrait_right_landscape_image.php -->
