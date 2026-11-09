<?php
/**
 * Fills a Design Category landing page with its starter content
 * (inc/landing-seeds/<term-slug>.php), so the page doesn't have to be
 * built block by block.
 *
 * Two ways to run it:
 *   - Admin:  Designs > Categories > Edit "Home Extensions" > "Fill with starter content"
 *   - WP-CLI: wp mulroy seed-landing home-extensions [--force]
 *
 * It never overwrites a page that already has blocks unless --force is used
 * (CLI only). Images are left empty: add them after seeding.
 */

if (!defined('ABSPATH')) {
  exit;
}

/** Path of the seed file for a term slug, or '' if there isn't one. */
function mulroy_landing_seed_file($slug)
{
  $file = get_template_directory() . '/inc/landing-seeds/' . sanitize_file_name($slug) . '.php';
  return file_exists($file) ? $file : '';
}

/** First published page using a given page template. */
function mulroy_landing_page_by_template($template)
{
  $pages = get_pages([
    'meta_key'   => '_wp_page_template',
    'meta_value' => $template,
    'number'     => 1,
  ]);
  return $pages ? get_permalink($pages[0]) : '';
}

/** Links and IDs the seed content needs, resolved on this site. */
function mulroy_landing_seed_context()
{
  $terms = [];
  foreach (get_terms(['taxonomy' => 'design_category', 'hide_empty' => false]) as $term) {
    $link = get_term_link($term);
    if (!is_wp_error($link)) {
      $terms[$term->slug] = $link;
    }
  }

  // People: Andrew Mulroy if found. Add the second person in the admin.
  $people = get_posts([
    'post_type'      => 'peoples',
    'post_status'    => 'publish',
    'title'          => 'Andrew Mulroy',
    'posts_per_page' => 1,
    'fields'         => 'ids',
  ]);

  return [
    'terms'    => $terms,
    'contact'  => mulroy_landing_page_by_template('contact-page.php'),
    'projects' => mulroy_landing_page_by_template('design-page.php'),
    'people'   => $people,
  ];
}

/**
 * Seed a term. Returns number of blocks added, or WP_Error.
 */
function mulroy_seed_landing($term_slug, $force = false)
{
  if (!function_exists('update_field')) {
    return new WP_Error('no_acf', 'ACF is not active.');
  }

  $term = get_term_by('slug', $term_slug, 'design_category');
  if (!$term) {
    return new WP_Error('no_term', sprintf('Category "%s" not found.', $term_slug));
  }

  $file = mulroy_landing_seed_file($term->slug);
  if (!$file) {
    return new WP_Error('no_seed', sprintf('No starter content for "%s" (inc/landing-seeds/%s.php).', $term->slug, $term->slug));
  }

  $acf_id   = 'term_' . $term->term_id;
  $existing = get_field('components', $acf_id, false);

  if (!empty($existing) && !$force) {
    return new WP_Error('has_content', sprintf('"%s" already has %d blocks. Use --force to replace them.', $term->name, count($existing)));
  }

  $builder = require $file;
  $rows    = $builder(mulroy_landing_seed_context());

  // Use the field key (Dynamic Blocks > components): the field has no
  // value yet on this term, so ACF can't resolve it by name.
  update_field('field_67b9367026865', $rows, $acf_id);

  return count($rows);
}

/* -------------------------------------------------------------------------
 * Admin button on the category edit screen
 * ---------------------------------------------------------------------- */

add_action('design_category_edit_form', function ($term) {
  if (!mulroy_landing_seed_file($term->slug) || !current_user_can('manage_categories')) {
    return;
  }

  $has_blocks = !empty(get_field('components', 'term_' . $term->term_id, false));
  if ($has_blocks) {
    return;
  }

  $url = wp_nonce_url(
    admin_url('admin-post.php?action=mulroy_seed_landing&term_id=' . $term->term_id),
    'mulroy_seed_landing_' . $term->term_id
  );
  ?>
  <div class="notice notice-info inline" style="margin:20px 0;padding:12px 15px;">
    <p><strong>This landing page is empty.</strong> Fill it with the starter content from the Figma design (text only, images to add afterwards)?</p>
    <p><a href="<?php echo esc_url($url); ?>" class="button button-primary">Fill with starter content</a></p>
  </div>
  <?php
}, 5);

add_action('admin_post_mulroy_seed_landing', function () {
  $term_id = isset($_GET['term_id']) ? absint($_GET['term_id']) : 0;

  if (!$term_id || !current_user_can('manage_categories')) {
    wp_die('Not allowed.');
  }

  check_admin_referer('mulroy_seed_landing_' . $term_id);

  $term   = get_term($term_id, 'design_category');
  $result = $term && !is_wp_error($term) ? mulroy_seed_landing($term->slug) : new WP_Error('no_term', 'Category not found.');

  $redirect = add_query_arg(
    [
      'taxonomy'      => 'design_category',
      'tag_ID'        => $term_id,
      'post_type'     => 'designs',
      'mulroy_seeded' => is_wp_error($result) ? 'error' : $result,
    ],
    admin_url('term.php')
  );

  if (is_wp_error($result)) {
    set_transient('mulroy_seed_error_' . get_current_user_id(), $result->get_error_message(), 60);
  }

  wp_safe_redirect($redirect);
  exit;
});

add_action('admin_notices', function () {
  if (!isset($_GET['mulroy_seeded'])) {
    return;
  }

  if ($_GET['mulroy_seeded'] === 'error') {
    $message = get_transient('mulroy_seed_error_' . get_current_user_id());
    echo '<div class="notice notice-error is-dismissible"><p>' . esc_html($message ?: 'Could not add the starter content.') . '</p></div>';
    return;
  }

  printf(
    '<div class="notice notice-success is-dismissible"><p>%s</p></div>',
    esc_html(sprintf('Added %d blocks. Now add the images (hero and the 5 image blocks), the second person and the FAQ questions.', absint($_GET['mulroy_seeded'])))
  );
});

/* -------------------------------------------------------------------------
 * WP-CLI: wp mulroy seed-landing <slug> [--force]
 * ---------------------------------------------------------------------- */

if (defined('WP_CLI') && WP_CLI) {
  WP_CLI::add_command('mulroy seed-landing', function ($args, $assoc) {
    $slug   = $args[0] ?? '';
    $result = mulroy_seed_landing($slug, !empty($assoc['force']));

    if (is_wp_error($result)) {
      WP_CLI::error($result->get_error_message());
    }

    WP_CLI::success(sprintf('Added %d blocks to "%s". Add the images next.', $result, $slug));
  }, [
    'shortdesc' => 'Fill a Design Category landing page with its starter content.',
    'synopsis'  => [
      ['type' => 'positional', 'name' => 'slug', 'description' => 'Category slug, e.g. home-extensions'],
      ['type' => 'flag', 'name' => 'force', 'optional' => true, 'description' => 'Replace existing blocks'],
    ],
  ]);
}
