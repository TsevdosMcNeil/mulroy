<?php
$image  = $args['image'] ?? null;
if ($image):
?>
<!-- template-parts/components/hero/background.php -->
<div class="hero-background">
  <?php
  $attachment_id = is_numeric($image)
    ? (int) $image
    : attachment_url_to_postid($image);

  if ($attachment_id) {
    // WordPress attachment ID
    echo wp_get_attachment_image(
      $attachment_id,
      'full',
      false,
      [
        'class'         => 'hero-background-image',
        'loading'       => 'eager',
        'fetchpriority' => 'high',
      ]
    );
  } else {
    // Fallback for image URLs
  ?>
    <img
      src="<?php echo esc_url($image); ?>"
      class="hero-background-image"
      alt=""
      loading="eager"
      fetchpriority="high">
  <?php
  }
  ?>
</div>
<!-- End template-parts/components/hero/background.php -->
<?php
endif;
?>