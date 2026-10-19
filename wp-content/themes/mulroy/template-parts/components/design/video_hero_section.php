<?php

$video_url = get_sub_field('video_url');
$image     = get_sub_field('image');

$image_id  = null;
$image_url = null;

// Support the new ACF Image Array format.
if (is_array($image) && !empty($image['ID'])) {
  $image_id  = $image['ID'];
  $image_url = $image['url'] ?? wp_get_attachment_image_url($image_id, 'full');

  // Backwards compatibility with the old ACF Image URL format.
} elseif (is_string($image) && $image) {
  $image_url = $image;
  $image_id  = attachment_url_to_postid($image);
}

//error_log(print_r($image_url));

?>

<!-- template-parts/components/design/video_hero_section.php -->
<section class="scroll-section" id="news-top">

  <div class="hero-background"></div>
  <div class="hero-overlay z-20"></div>

  <div class="hero-content">
    <div class="video-player w-full h-full overflow-hidden">

      <?php if ($video_url): ?>

        <video
          class="top-0 relative z-[-1] md:left-0 xl:w-full bg-gray-400 bg-cover bg-center h-full xl:h-auto"
          autoplay
          src="<?php echo esc_url($video_url); ?>"
          muted
          loop
          playsinline
          <?php if ($image_url): ?>
          poster="<?php echo esc_url($image_url); ?>"
          <?php endif; ?>>
        </video>

      <?php elseif ($image_id): ?>

        <?php
        echo wp_get_attachment_image(
          $image_id,
          'full',
          false,
          [
            'class' => 'w-full h-full object-cover',
          ]
        );
        ?>

      <?php elseif ($image_url): ?>

        <!-- Legacy fallback for an image URL that cannot be resolved
             to a WordPress Media Library attachment. -->
        <img
          src="<?php echo esc_url($image_url); ?>"
          alt=""
          class="w-full h-full object-cover" />

      <?php endif; ?>

    </div>
  </div>

  <div class="news-post-hero-content design-post-hero-content site-container z-20">

    <h3 class="fs-lg">
      <?php echo esc_html(get_the_date('F j, Y')); ?>
    </h3>

    <h2 class="fs-3xl lg:max-w-[35vw]">
      <?php the_title(); ?>
    </h2>

  </div>

</section>
<!-- template-parts/components/design/video_hero_section.php -->