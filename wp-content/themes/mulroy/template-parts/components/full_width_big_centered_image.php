<?php
$image = get_sub_field('image');
?>
<!-- template-parts/components/full_width_big_centered_image.php -->
<section class="scroll-section container-py site-container bg-site no_min_height_mobile consistent__space__single__project__mobile">
  <div class="grid grid-cols-12 h-full">
    <div class="col-start-1 col-end-[-1] lg:col-start-2 lg:col-end-12">
      <?php
      get_template_part(
        'template-parts/components/column-image',
        null,
        [
          'image'   => $image,
        ]
      );
      ?>
    </div>
  </div>
</section>
<!-- End template-parts/components/full_width_big_centered_image.php -->