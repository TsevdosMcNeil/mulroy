<?php
$heading = get_sub_field('heading');
$desc = get_sub_field('desc');
$photo = get_sub_field('photo');
?>
<!-- template-parts/components/right_only_content_block.php -->
<section
  class="scroll-section site-container bg-site no_min_height_mobile">
  <div
    class="flex flex-col lg:grid grid-cols-12"
    style="grid-template-rows: min-content 1fr">
    <?php if ($desc): ?>
    <div class="col-start-6 col-end-13 mb-8">
      <div class="atrium-post-desc-text fs-2xl section__copy__content letter__spacing__custom__-2px">
        <?php echo $desc; ?>
      </div>
    </div>
    <?php endif; ?>
    <div
      class="col-start-6 col-end-13 h-full"
      id="atrium-post-right-text-image">
      <div
        class="w-full image-container mb-[12px]">
        <?php if ($photo): ?>
        <?php
          get_template_part(
            'template-parts/components/column-image',
            null,
            [
              'image'      => $photo,
              'image_wrap' => 'none'
            ]
          );
        ?>
        <?php endif; ?>
      </div>
      <?php if ($heading): ?>
        <span class="post-caption"> <?php echo $heading; ?></span>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- End template-parts/components/right_only_content_block.php -->