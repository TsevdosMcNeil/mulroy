<?php
$heading = get_sub_field('heading');
$image = get_sub_field('image');
?>
<!-- template-parts/components/centered_banner_image_with_caption.php -->
<section class="scroll-section site-container bg-site container-py no_min_height_mobile consistent__space__single__project__mobile">
  <div class="flex flex-col lg:grid grid-cols-12 h-full">
    <div
      class="col-start-2 col-end-12"
      id="atrium-post-banner-image">
      <div class="project-center">
      <?php
          get_template_part(
            'template-parts/components/column-image',
            null,
            [
              'image'   => $image,
              'heading' => $heading,
            ]
          );
        ?>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/centered_banner_image_with_caption.php -->