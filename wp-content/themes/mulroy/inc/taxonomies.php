<?php
/**
 * Designs taxonomies: Categories (with landing pages) and Sectors.
 *
 * - design_category: public, each term has its own landing page rendered by
 *   taxonomy-design_category.php using the "Dynamic Blocks" (components) field.
 * - design_sector:   admin-only grouping (no front-end archive).
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * URL base for the category landing pages, e.g. /architecture/home-extensions/.
 * Change it here, then visit Settings > Permalinks once (or bump
 * MULROY_TAXONOMY_VERSION) to flush the rewrite rules.
 */
if (!defined('MULROY_DESIGN_CATEGORY_SLUG')) {
  define('MULROY_DESIGN_CATEGORY_SLUG', 'architecture');
}

/**
 * Bump this whenever the taxonomy settings or default terms change so the
 * rewrite rules are flushed and missing terms are created once.
 */
define('MULROY_TAXONOMY_VERSION', '1.0.0');

function mulroy_register_design_taxonomies()
{
  register_taxonomy(
    'design_category',
    ['designs'],
    [
      'labels' => [
        'name'              => __('Categories', 'mulroy'),
        'singular_name'     => __('Category', 'mulroy'),
        'menu_name'         => __('Categories', 'mulroy'),
        'all_items'         => __('All Categories', 'mulroy'),
        'edit_item'         => __('Edit Category', 'mulroy'),
        'view_item'         => __('View Landing Page', 'mulroy'),
        'update_item'       => __('Update Category', 'mulroy'),
        'add_new_item'      => __('Add New Category', 'mulroy'),
        'new_item_name'     => __('New Category Name', 'mulroy'),
        'search_items'      => __('Search Categories', 'mulroy'),
        'not_found'         => __('No categories found.', 'mulroy'),
        'back_to_items'     => __('← Back to Categories', 'mulroy'),
      ],
      'public'            => true,
      'publicly_queryable' => true,
      'hierarchical'      => true,
      'show_ui'           => true,
      'show_in_menu'      => true,
      'show_in_nav_menus' => true,
      'show_admin_column' => true,
      'show_in_rest'      => true,
      'show_tagcloud'     => false,
      'query_var'         => true,
      'rewrite'           => [
        'slug'         => MULROY_DESIGN_CATEGORY_SLUG,
        'with_front'   => false,
        'hierarchical' => false,
      ],
    ]
  );

  register_taxonomy(
    'design_sector',
    ['designs'],
    [
      'labels' => [
        'name'          => __('Sectors', 'mulroy'),
        'singular_name' => __('Sector', 'mulroy'),
        'menu_name'     => __('Sectors', 'mulroy'),
        'all_items'     => __('All Sectors', 'mulroy'),
        'edit_item'     => __('Edit Sector', 'mulroy'),
        'update_item'   => __('Update Sector', 'mulroy'),
        'add_new_item'  => __('Add New Sector', 'mulroy'),
        'new_item_name' => __('New Sector Name', 'mulroy'),
        'search_items'  => __('Search Sectors', 'mulroy'),
        'not_found'     => __('No sectors found.', 'mulroy'),
      ],
      // No landing pages for sectors: keep them out of the front end.
      'public'             => false,
      'publicly_queryable' => false,
      'hierarchical'       => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => false,
      'show_admin_column'  => true,
      'show_in_rest'       => true,
      'show_tagcloud'      => false,
      'query_var'          => false,
      'rewrite'            => false,
    ]
  );
}
add_action('init', 'mulroy_register_design_taxonomies');

/**
 * Create the default terms once and flush rewrite rules after a version bump.
 * Existing terms are never renamed or deleted.
 */
function mulroy_seed_design_taxonomies()
{
  if (get_option('mulroy_taxonomy_version') === MULROY_TAXONOMY_VERSION) {
    return;
  }

  $defaults = [
    'design_category' => [
      'home-extensions'          => 'Home Extensions',
      'basements'                => 'Basements',
      'renovations'              => 'Renovations',
      'listed-buildings'         => 'Listed Buildings',
      'sustainable-architecture' => 'Sustainable Architecture',
    ],
    'design_sector' => [
      'residential' => 'Residential',
      'commercial'  => 'Commercial',
      'educational' => 'Educational',
    ],
  ];

  foreach ($defaults as $taxonomy => $terms) {
    foreach ($terms as $slug => $name) {
      if (!term_exists($slug, $taxonomy)) {
        wp_insert_term($name, $taxonomy, ['slug' => $slug]);
      }
    }
  }

  flush_rewrite_rules(false);
  update_option('mulroy_taxonomy_version', MULROY_TAXONOMY_VERSION);
}
add_action('init', 'mulroy_seed_design_taxonomies', 20);

/**
 * Landing pages are built from blocks, not a paginated post list:
 * send /architecture/<term>/page/N/ back to the landing page.
 */
add_action('template_redirect', function () {
  if (is_tax('design_category') && get_query_var('paged') > 1) {
    wp_safe_redirect(get_term_link(get_queried_object()), 301);
    exit;
  }
});
