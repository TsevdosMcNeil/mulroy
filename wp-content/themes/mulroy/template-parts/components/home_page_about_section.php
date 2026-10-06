<?php
$heading = get_sub_field('heading');
$desc    = get_sub_field('desc');
$image   = get_sub_field('image');

$description_col = $image ? 'col-span-4' : 'col-span-12';
?>

<!-- template-parts/components/home_page_about_section.php -->
<section
  class="scroll-section bg-site border-bottom no_min_height_mobile"
  id="about-section">

  <?php if ($heading): ?>
  <div class="page-bar md:py-[1vw]">
    <span class="large-title"><?php echo esc_html($heading); ?></span>
  </div>
  <?php endif; ?>

  <div class="page-sect-content">

    <div class="section__copy__content flex flex-col 
      lg:grid grid-cols-12 col-span-12 
      gap-y-5">
      <div class="page-sect-desc letter__spacing__custom__-2px
      <?php echo esc_html($description_col); ?>">
        <?php echo wp_kses_post($desc); ?>
      </div>
      <div class="image-container-wrapper 
        col-span-12 lg:col-start-6 lg:col-end-13 h-full"
      >
        <?php
        get_template_part(
          'template-parts/components/column-image',
          null,
          [
            'image'           => $image,
            'container_class' => 'bg-contain-mb',
          ]
        );
        ?>
      </div>
    </div>

  </div>
</section>
<!-- End template-parts/components/home_page_about_section.php -->