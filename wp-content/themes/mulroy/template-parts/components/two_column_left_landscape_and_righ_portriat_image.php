<?php
$left_side_image = get_sub_field('left_side_image');
$left_side_heading = get_sub_field('left_side_heading');
$right_side_image = get_sub_field('right_side_image');
$right_side_heading = get_sub_field('right_side_heading');
?>
<!-- template-parts/components/two_column_left_landscape_and_righ_portriat_image.php -->
<section class="scroll-section bg-site site-container container-py no_min_height_mobile consistent__space__single__project__mobile" style="min-height:auto;">
  <div class="section-inner-container gap-y-[5rem] lg:gap-y-0">
    <div class="col-start-2 col-end-7">
      <div class="flex flex-col w-full justify-center h-full">
        <?php
        get_template_part(
          'template-parts/components/column-image',
          null,
          [
            'image'   => $left_side_image,
            'heading' => $left_side_heading,
          ]
        );
        ?>
      </div>
    </div>

    <div class="col-start-8 col-end-12">
      <div class="project-center">
        <?php
        get_template_part(
          'template-parts/components/column-image',
          null,
          [
            'image'       => $right_side_image,
            'heading'     => $right_side_heading,
            'image_class' => 'portrait-img',
          ]
        );
        ?>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/two_column_left_landscape_and_righ_portriat_image.php -->