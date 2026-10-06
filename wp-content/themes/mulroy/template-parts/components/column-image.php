<?php

$image           = $args['image'] ?? null;
$heading         = $args['heading'] ?? null;
$image_class     = $args['image_class'] ?? '';
$container_class = $args['container_class'] ?? 'w-full';
$image_size      = $args['image_size'] ?? 'large';

$image_wrap      = ($args['image_wrap'] ?? '') !== 'none';

$image_id  = null;
$image_url = null;

if (is_array($image) && !empty($image['ID'])) {
  // ACF Image Array.
  $image_id = $image['ID'];
} elseif (is_numeric($image)) {
  // WordPress attachment ID.
  $image_id = (int) $image;
} elseif (is_string($image) && $image) {
  // Legacy image URL.
  $image_url = $image;
  $image_id  = attachment_url_to_postid($image);
}

?>
<!-- template-parts/components/column-image.php -->
<?php if ($image_wrap): ?>
<div class="<?php echo esc_attr($container_class); ?> image-container">
<?php endif; ?>

  <?php if ($image_id): ?>
    <?php
    echo wp_get_attachment_image(
      $image_id,
      $image_size,
      false,
      [
        'class' => $image_class,
      ]
    );
    ?>
  <?php elseif ($image_url): ?>
    <!-- Legacy fallback for an image URL that cannot be resolved
             to a WordPress Media Library attachment. -->
    <img
      src="<?php echo esc_url($image_url); ?>"
      alt=""
      class="<?php echo esc_attr($image_class); ?>"
      loading="lazy" />
  <?php endif; ?>

<?php if ($image_wrap): ?>
</div>
<?php endif; ?>

<?php if ($heading): ?>
  <span class="post-caption">
    <?php echo esc_html($heading); ?>
  </span>
<?php endif; ?>
<!-- End template-parts/components/column-image.php -->