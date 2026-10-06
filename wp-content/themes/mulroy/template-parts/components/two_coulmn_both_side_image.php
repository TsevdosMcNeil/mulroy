<?php
$left_side_image = get_sub_field('left_side_image');
$left_side_heading = get_sub_field('left_side_heading');
$right_side_image = get_sub_field('right_side_image');
$right_side_heading = get_sub_field('right_side_heading');
?>
<!-- template-parts/components/two_coulmn_both_side_image.php -->
<section class="scroll-section bg-site site-container no_min_height_mobile pt-[2rem] consistent__space__single__project__mobile" style="min-height:auto;">
  <div class="flex flex-col justify-between h-full">
    <div class="section-inner-container py-0 lg:py-8 gap-y-[5rem] lg:gap-y-0">
      <div class="col-start-2 col-end-6 h-full">
        <div class="flex flex-col w-full h-full justify-end">
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
      <div class="col-start-7 col-end-13 pb-0 lg:pb-8">
        <div class="flex flex-col w-full justify-end h-full">
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
    </div>
  </div>
</section>
<!-- End template-parts/components/two_coulmn_both_side_image.php -->