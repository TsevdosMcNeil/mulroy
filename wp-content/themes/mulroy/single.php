<?php 
get_header();
?>
<!-- single.php -->
<?php
get_template_part('template-parts/components');

get_template_part(
  'template-parts/post-navigation',
  null,
  [
    'id'         => 'atrium-post-navigation',
    'back_url'   => esc_url(wp_get_referer()),
    'top_anchor' => "#top"
  ]
);     
?>
<!-- End single.php -->
<?php get_footer(); ?>