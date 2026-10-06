<?php
$heading = get_sub_field('heading');
$desc = get_sub_field('desc');
$image = get_sub_field('image');
?>
<!-- template-parts/components/two_column_left_text_right_image.php -->
<section class="scroll-section site-container bg-site no_min_height_mobile consistent__space__single__project__mobile">
  <div class="flex flex-col gap-y-[3rem] lg:grid grid-cols-12">
    <div class="flex justify-start col-start-3 col-end-6 h-full items-center">
      <div class="flex letter__spacing__custom__-1px" style="height: fit-content">
        <?php echo $desc; ?>
      </div>
    </div>

    <div class="flex flex-col col-start-8 col-end-12 justify-center">
      <?php
      get_template_part(
        'template-parts/components/column-image',
        null,
        [
          'image'       => $image,
          'heading'     => $heading,
          'image_class' => 'portrait-img',
        ]
      );
      ?>
    </div>

  </div>
</section>
<!-- End template-parts/components/two_column_left_text_right_image.php -->