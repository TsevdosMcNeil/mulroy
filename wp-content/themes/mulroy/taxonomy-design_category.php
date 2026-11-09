<?php
/**
 * Design Category landing page (e.g. /architecture/home-extensions/).
 *
 * Content comes from the "Dynamic Blocks" field on the term itself
 * (Designs > Categories > Edit), so the landing pages are built with the
 * same ACF blocks as the rest of the site.
 */
get_header();

$term = get_queried_object();
?>
<!-- taxonomy-design_category.php -->
<?php
get_template_part(
  'template-parts/components',
  null,
  [
    'post_id' => $term,
  ]
);
?>
<!-- End taxonomy-design_category.php -->
<?php get_footer(); ?>
