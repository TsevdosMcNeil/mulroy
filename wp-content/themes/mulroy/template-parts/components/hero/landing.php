<?php
$hero_image = $args['hero_image'] ?? null;
$heading    = $args['heading'] ?? null;

if (!$heading && is_tax()) {
  $heading = single_term_title('', false);
}
?>
<!-- template-parts/components/hero/landing.php -->
<section class="landing-hero relative isolate overflow-hidden site-container h-[60vh] lg:h-[28.125vw] lg:min-h-[420px]" id="landing-top">
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
  <div class="relative h-full flex flex-col justify-between pt-[5rem] pb-6 lg:pt-[2.08vw] lg:pb-[2.08vw]">
    <?php if ($heading) : ?>
      <h1 class="fs-2xl letter__spacing__custom__-2px text-white lg:max-w-[23vw]">
        <?php echo wp_kses_post($heading); ?>
      </h1>
    <?php endif; ?>
    <a href="#landing-content" class="landing-hero__scroll self-end inline-flex items-center gap-2 text-white text-[14px]" data-barba-prevent>
      <span class="text-white text-[14px]"><?php esc_html_e('Scroll', 'mulroy'); ?></span>
      <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M0.5 0.5L4 4L7.5 0.5" stroke="white" />
      </svg>
    </a>
  </div>
</section>
<div id="landing-content"></div>
<!-- End template-parts/components/hero/landing.php -->
