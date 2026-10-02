<?php

$top_selected_heading = get_sub_field('top_selected_heading');
$desc                  = get_sub_field('desc');
$design_image          = get_sub_field('design_image');
$design_post           = get_sub_field('design_post_url');

?>
<!-- template-parts/components/design/top_selected_right_side_design_project.php -->
<section class="scroll-section bg-site no_min_height_mobile design__page__section__padding">
  <div class="flex flex-col lg:grid grid-cols-12 site-container">

    <?php if ($top_selected_heading): ?>
      <div class="col-span-12">
        <h2 class="fs-3xl page-bar-padding letter__spacing__custom__-3-25px">
          <?php echo $top_selected_heading; ?>
        </h2>
      </div>
    <?php endif; ?>

    <?php if ($desc): ?>
      <div class="col-start-6 col-end-12">
        <div class="page__desc fs-2xl section__copy__content letter__spacing__custom__-2px">
          <?php echo $desc; ?>
        </div>
      </div>
    <?php endif; ?>

    <div class="col-start-1 col-end-13">
      <?php
      get_template_part(
          'template-parts/components/design/project-card',
          null,
          [
              'post_id'         => $design_post?->ID,
              'image'           => $design_image,
              'class'           => 'h-full',
              'image_container' => 'lg:h-[82vh] overflow-hidden sm:h-auto',
              'image_class'     => 'object-cover',
          ]
      );
      ?>
    </div>

  </div>
</section>
<!-- End template-parts/components/design/top_selected_right_side_design_project.php -->