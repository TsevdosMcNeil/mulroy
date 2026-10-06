<?php
$heading = get_sub_field('heading');
$desc = get_sub_field('desc');
$image = get_sub_field('image');
?>
<!-- template-parts/components/two_column_left_image_right_text.php -->
<section class="scroll-section 
  site-container container-py 
  bg-site no_min_height_mobile 
  consistent__space__single__project__mobile"
>
  <div class="flex flex-col lg:grid grid-cols-12 gap-y-[3rem]">

    <div id="atrium-post-center-image-text"
      class="col-start-3 col-end-7">
      <div class="project-center">

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

    <div class="col-start-9 col-end-12 self-center">
      <div class="text-start letter__spacing__custom__-1px">
        <?php echo $desc; ?>
      </div>
    </div>

  </div>
</section>
<!-- End template-parts/components/two_column_left_image_right_text.php -->