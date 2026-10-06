<?php


$arrow_class     = $args['arrow_class'] ?? '';
$container_class = $args['container_class'] ?? '';

?>
<!-- template-parts/components/icons/arrow.php -->
<span class="<?php echo esc_attr($container_class); ?>">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" 
    alt=""
    class="<?php echo esc_attr($arrow_class); ?>" />
</span>

<!-- End template-parts/components/icons/arrow.php -->