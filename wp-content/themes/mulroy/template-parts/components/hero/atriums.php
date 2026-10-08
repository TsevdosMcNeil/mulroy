<?php
$hero_image  = $args['hero_image'] ?? null;
$heading     = $args['heading'] ??  null;
?>
<!-- template-parts/components/hero/atriums.php -->
<section class="scroll-section site-container hero-section-height" id="atrium-top">
  <div class="custom-cursor" id="custom-cursor"></div>
  <?php if ($hero_image) : 
    get_template_part(
      'template-parts/components/background-image',
      null,
      [
        'image' => $hero_image,
      ]
    );
  endif; ?>
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