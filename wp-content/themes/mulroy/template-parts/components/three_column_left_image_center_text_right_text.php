<?php
$desc_right = get_sub_field('desc_right');
$desc_center = get_sub_field('desc_center');
$image = get_sub_field('image');
?>
<!-- template-parts/components/three_column_left_image_center_text_right_text.php -->
<section id="three-column-left-image-center-text-right-text"
  class="scroll-section site-container 
  bg-site no_min_height_mobile 
  consistent__space__single__project__mobile">
  <div class="flex flex-col lg:grid grid-cols-12 gap-y-10 h-full">
    <div class="col-start-2 col-end-6">
      <div
        class="three_column_left_image_portrait">
        <?php
          get_template_part(
            'template-parts/components/column-image',
            null,
            [
                'image' => $image,
            ]
          );
        ?>
      </div>
    </div>
    <div class="big-img col-start-7 col-end-13">
      <div
        class="flex-col lg:flex-row flex justify-between items-center h-full gap-5">
        <div class="studio-page-text-content letter__spacing__custom__-1px">
          <?php echo $desc_center; ?>
        </div>
        <div class="studio-page-text-content letter__spacing__custom__-1px">
          <?php echo $desc_right; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/three_column_left_image_center_text_right_text.php -->