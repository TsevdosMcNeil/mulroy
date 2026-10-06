<?php
$desc = get_sub_field('desc');
$image = get_sub_field('image');
?>
<!-- template-parts/components/landscape-img-right-text-left.php -->
<section id="landscape-img-right-text-left"
  class="scroll-section site-container bg-site container-py no_min_height_mobile consistent__space__single__project__mobile">
  <div class="flex flex-col lg:grid grid-cols-12 gap-y-10 h-full">
    <div class="col-start-2 col-end-5 flex h-full items-center">
      <div class="letter__spacing__custom__-1px">
        <?php echo $desc; ?>
      </div>
    </div>
    <div class="col-start-6 col-end-12">
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
<!-- End template-parts/components/landscape-img-right-text-left.php -->