<?php
$hero_image  = $args['hero_image'] ?? null;
$heading     = $args['heading'] ??  null;
?>
<!-- template-parts/components/hero/atriums.php -->
<section class="scroll-section site-container hero-section-height" id="atrium-top">
  <div class="custom-cursor" id="custom-cursor"></div>
  <?php if ($hero_image) : ?>
    <div class="hero-background">
      <?php
      if (is_numeric($hero_image)) {
        // WordPress attachment ID
        echo wp_get_attachment_image(
          (int) $hero_image,
          'full',
          false,
          [
            'class'         => 'hero-background-image',
            'alt'           => '',
            'aria-hidden'   => 'true',
            'loading'       => 'eager',
            'fetchpriority' => 'high',
          ]
        );
      } else {
        // Fallback for image URLs
      ?>
        <img
          src="<?php echo esc_url($hero_image); ?>"
          class="hero-background-image"
          alt=""
          aria-hidden="true"
          loading="eager"
          fetchpriority="high">
      <?php
      }
      ?>
    </div>
  <?php endif; ?>
  <div class="hero-overlay"></div>
  <div class="atrium-hero-content site-container">
    <?php if ($heading) : ?>
      <h2 class="fs-lg uppercase">
        <?php echo wp_kses_post($heading); ?>
      </h2>
    <?php endif; ?>
    <h1 class="fs-3xl lg:max-w-[35vw] mt-4 letter__spacing__custom__-3-25px"><?php the_title(); ?></h1>
  </div>
</section>
<!-- End template-parts/components/hero/atriums.php -->