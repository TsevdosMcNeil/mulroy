<?php
$heading = get_sub_field('heading');
$heading_link = get_sub_field('heading_link');
$left_side_sub_heading = get_sub_field('left_side_sub_heading');
$desc = get_sub_field('desc');
$image = get_sub_field('image');
?>
<!-- template-parts/components/home_page_studio_section.php -->
<section
  class="scroll-section bg-site border-bottom no_min_height_mobile"
  id="studio-section">
  <div class="page-bar xl:py-[1vw] hover-blue">
    <a href="<?php echo $heading_link; ?>" class="page-bar-link">
      <span class="content letter__spacing__custom__-3-25px"> <?php echo $heading; ?> </span>
      <?php
      get_template_part(
        'template-parts/components/icons/arrow',
        null,
        [
          'container_class' => 'arrow-content',
          'arrow_class' => 'w-5 md:w-10',
        ]
      );
      ?>
    </a>
  </div>
  <div class="page-sect-content">
    <div
      class="section__copy__content flex flex-col lg:grid grid-cols-12 col-span-12 gap-y-5">
      <div class="page-sect-desc col-span-5 letter__spacing__custom__-2px"><?php echo $left_side_sub_heading; ?></div>
      <div class="page-sect-desc col-span-7 letter__spacing__custom__-2px">
        <?php echo $desc; ?>
      </div>
    </div>
    <div
      class="col-span-12 lg:col-start-6 lg:col-end-13 h-full">
      <div class="image-container-wrapper">
        <?php
        get_template_part(
          'template-parts/components/column-image',
          null,
          [
            'image'   => $image,
            'container_class' => 'bg-contain-mb',
          ]
        );
        ?>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/home_page_studio_section.php -->