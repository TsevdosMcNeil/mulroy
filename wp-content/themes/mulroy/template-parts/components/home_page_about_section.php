<?php
$heading      = get_sub_field('heading');
$heading_link = get_sub_field('heading_link');
$hover_colour = get_sub_field('heading_hover_colour') ?: 'orange';
$desc         = get_sub_field('desc');
$image        = get_sub_field('image');

$heading_url    = (is_array($heading_link) && !empty($heading_link['url'])) ? $heading_link['url'] : '';
$heading_target = (is_array($heading_link) && !empty($heading_link['target'])) ? $heading_link['target'] : '_self';

// Same hover classes as the other home page headings (News = orange, Studio = light blue)
$hover_classes = [
  'orange'     => 'hover-orange',
  'blue'       => 'hover-dark-blue',
  'light-blue' => 'hover-blue',
  'grey'       => 'hover-grey',
];
$hover_class = $hover_classes[$hover_colour] ?? 'hover-orange';
?>

<!-- template-parts/components/home_page_about_section.php -->
<section
  class="scroll-section bg-site border-bottom no_min_height_mobile"
  id="about-section">

  <?php if ($heading && $heading_url): ?>
  <div class="page-bar md:py-[1vw] <?php echo esc_attr($hover_class); ?>">
    <a
      href="<?php echo esc_url($heading_url); ?>"
      target="<?php echo esc_attr($heading_target); ?>"
      class="page-bar-link">
      <span class="content letter__spacing__custom__-3-25px"><?php echo esc_html($heading); ?></span>
      <?php
        get_template_part(
          'template-parts/components/icons/arrow',
          null,
          [
            'container_class' => 'arrow-content',
            'arrow_class'     => 'w-5 md:w-10',
          ]
        );
      ?>
    </a>
  </div>
  <?php elseif ($heading): ?>
  <div class="page-bar md:py-[1vw]">
    <span class="large-title"><?php echo esc_html($heading); ?></span>
  </div>
  <?php endif; ?>

  <div class="page-sect-content">

    <!-- Text and image in the right half, left half empty (as in the Home Page News Section) -->
    <div class="section__copy__content flex flex-col
      lg:grid grid-cols-12 col-span-12
      gap-y-5">
      <?php if ($desc): ?>
      <div class="page-sect-desc letter__spacing__custom__-2px
        col-span-12 lg:col-start-6 lg:col-end-13">
        <?php echo wp_kses_post($desc); ?>
      </div>
      <?php endif; ?>
      <?php if ($image): ?>
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
      <?php endif; ?>
    </div>

  </div>
</section>
<!-- End template-parts/components/home_page_about_section.php -->