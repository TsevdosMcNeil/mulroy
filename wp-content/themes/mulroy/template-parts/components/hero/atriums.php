<?php
$hero_image  = $args['hero_image'] ?? null;
$heading     = $args['heading'] ??  null;


// Get all published Atrium posts ordered by newest first
$all_atriums = get_posts([
  'post_type'      => 'atriums',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'fields'         => 'ids',
]);

// Find the position of the current Atrium post
$atrium_number = array_search(get_the_ID(), $all_atriums);

if ($atrium_number !== false) {
  $atrium_number = str_pad($atrium_number + 1, 2, '0', STR_PAD_LEFT);
} else {
  $atrium_number = '01';
}
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
    <?php if ($atrium_number) : ?>
      <h2 class="fs-lg uppercase">
        <?php echo esc_html('ATRIUM ' . $atrium_number); ?>
      </h2>
    <?php endif; ?>
    <h1 class="fs-3xl lg:max-w-[35vw] mt-4 letter__spacing__custom__-3-25px"><?php the_title(); ?></h1>
  </div>
</section>
<!-- End template-parts/components/hero/atriums.php -->