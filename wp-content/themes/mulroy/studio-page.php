<?php 
/*
Template Name: Studio Page
*/
get_header(); 
?>
<!-- studio-page.php -->
<div class="P_page" data-page="studio" style="display:none;"></div>
<?php
get_template_part('template-parts/components');
get_template_part('template-parts/legal-components');
get_template_part(
  'template-parts/post-navigation',
  null,
  [
    'id'         => 'atrium-post-navigation',
    'class'      => 'site-container bg-site container-py',
    'top_anchor' => "#studio-top"
  ]
);
?>
<!-- End studio-page.php -->
<?php get_footer(); ?>