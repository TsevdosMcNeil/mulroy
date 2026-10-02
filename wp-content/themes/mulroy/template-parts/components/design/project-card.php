<?php

$post_id         = $args['post_id'] ?? null;
$image           = $args['image'] ?? null;
$class           = $args['class'] ?? '';
$image_class     = $args['image_class'] ?? '';
$image_container = $args['image_container'] ?? '';

if (!$post_id) {
  return;
}

$title    = get_the_title($post_id);
$subtitle = get_field('design_type', $post_id);

?>

<a
  class="home-project-section project-img <?php echo esc_attr($class); ?>"
  href="<?php echo esc_url(get_permalink($post_id)); ?>"
>
  <div class="image-container mb-4 <?php echo esc_attr($image_container); ?>">

    <?php if (is_array($image) && !empty($image['ID'])): ?>

      <?php echo wp_get_attachment_image(
        $image['ID'],
        'large',
        false,
        [
          'class' => $image_class,
        ]
      ); ?>

    <?php elseif (is_string($image) && $image): ?>

      <?php
      // Backwards compatibility for ACF fields still returning an image URL.
      $attachment_id = attachment_url_to_postid($image);

      if ($attachment_id) {
        echo wp_get_attachment_image($attachment_id, 'large');
      } else {
        // Legacy fallback for an image URL that cannot be resolved
        // to a WordPress Media Library attachment.
      ?>
        <img
          src="<?php echo esc_url($image); ?>"
          alt=""
          loading="lazy" />
      <?php
      }
      ?>

    <?php else: ?>

      <?php echo get_the_post_thumbnail($post_id, 'large'); ?>

    <?php endif; ?>

  </div>

  <h2 class="project-caption font-bold text-[14px] uppercase">
    <?php echo esc_html($title); ?>
  </h2>

  <h3 class="project-sect-title">
    <span class="fs-2xl">
      <?php echo esc_html($subtitle); ?>

      <span class="inline-flex items-center">
        <img
          src="<?php echo esc_url(get_template_directory_uri() . '/assets/media/Arrow.svg'); ?>"
          class="site__arrow"
          alt="" />
      </span>
    </span>
  </h3>
</a>