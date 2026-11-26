<?php
/**
 * Publish / unpublish the Design Category landing pages.
 *
 * Only the landing page (/architecture/<slug>/) is affected. The category
 * itself keeps working: Designs can still be assigned to it, and it still
 * shows in the admin, the Design List filters and the featured projects.
 *
 * Unpublished landing page:
 * - Visitors get the 404 page, like an unpublished post.
 * - Logged-in users who can manage categories still see it (a preview), with
 *   a notice in the admin bar. The preview is sent with noindex/nocache.
 * - Left out of the XML sitemaps (Yoast and core) and removed from menus.
 * - Rows of a Landing Info Table that link to it are printed without the link.
 *
 * Status is stored in the term meta `mulroy_landing_status` ('draft' when
 * unpublished, no meta when published), so existing categories stay
 * published.
 *
 * Admin: Designs > Categories has a "Landing page" column with
 * Publish / Unpublish row links, and the add and edit forms have a
 * "Landing page" field.
 */

if (!defined('ABSPATH')) {
  exit;
}

const MULROY_LANDING_STATUS_META = 'mulroy_landing_status';

/**
 * Whether a category's landing page is published.
 *
 * @param WP_Term|int $term Term or term ID.
 */
function mulroy_landing_is_published($term)
{
  $term_id = $term instanceof WP_Term ? $term->term_id : (int) $term;

  return get_term_meta($term_id, MULROY_LANDING_STATUS_META, true) !== 'draft';
}

/**
 * Publish or unpublish a category's landing page.
 */
function mulroy_landing_set_published($term_id, $published)
{
  $term_id = (int) $term_id;

  if (mulroy_landing_is_published($term_id) === (bool) $published) {
    return;
  }

  if ($published) {
    delete_term_meta($term_id, MULROY_LANDING_STATUS_META);
  } else {
    update_term_meta($term_id, MULROY_LANDING_STATUS_META, 'draft');
  }

  // Rebuild the Yoast sitemaps with the change.
  if (class_exists('WPSEO_Sitemaps_Cache') && method_exists('WPSEO_Sitemaps_Cache', 'clear')) {
    WPSEO_Sitemaps_Cache::clear(['design_category']);
  }
}

/**
 * IDs of the categories whose landing page is unpublished.
 *
 * @return int[]
 */
function mulroy_landing_unpublished_ids()
{
  static $ids = null;

  if ($ids === null) {
    $ids = get_terms([
      'taxonomy'   => 'design_category',
      'hide_empty' => false,
      'fields'     => 'ids',
      'meta_key'   => MULROY_LANDING_STATUS_META,
      'meta_value' => 'draft',
    ]);
    $ids = is_wp_error($ids) ? [] : array_map('intval', $ids);
  }

  return $ids;
}

/**
 * Whether the current user can see unpublished landing pages.
 */
function mulroy_landing_can_preview()
{
  return is_user_logged_in() && current_user_can(get_taxonomy('design_category')->cap->manage_terms);
}

/**
 * Whether a URL is the landing page of an unpublished category, for the
 * current visitor (editors see everything, so it's always false for them).
 */
function mulroy_landing_url_is_hidden($url)
{
  if (!$url || mulroy_landing_can_preview()) {
    return false;
  }

  $path = untrailingslashit((string) wp_parse_url($url, PHP_URL_PATH));

  foreach (mulroy_landing_unpublished_ids() as $term_id) {
    $link = get_term_link($term_id, 'design_category');

    if (!is_wp_error($link) && untrailingslashit((string) wp_parse_url($link, PHP_URL_PATH)) === $path) {
      return true;
    }
  }

  return false;
}

/* -------------------------------------------------------------------------
 * Front end
 * ---------------------------------------------------------------------- */

/**
 * Unpublished landing page: 404 for visitors, preview for editors.
 * Runs before the /page/N/ redirect in taxonomies.php.
 */
add_action('template_redirect', function () {
  if (!is_tax('design_category')) {
    return;
  }

  $term = get_queried_object();

  if (!$term instanceof WP_Term || mulroy_landing_is_published($term)) {
    return;
  }

  if (mulroy_landing_can_preview()) {
    nocache_headers();
    add_filter('wp_robots', 'wp_robots_no_robots');
    add_filter('wpseo_robots', function () {
      return 'noindex, nofollow';
    });
    return;
  }

  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  nocache_headers();
}, 1);

/**
 * Admin bar notice while an editor previews an unpublished landing page.
 */
add_action('admin_bar_menu', function ($admin_bar) {
  if (is_admin() || !is_tax('design_category')) {
    return;
  }

  $term = get_queried_object();

  if (!$term instanceof WP_Term || mulroy_landing_is_published($term)) {
    return;
  }

  $admin_bar->add_node([
    'id'    => 'mulroy-landing-unpublished',
    'title' => '<span style="color:#f0b849;">' . esc_html__('Unpublished landing page: only editors can see it', 'mulroy') . '</span>',
    'href'  => get_edit_term_link($term->term_id, 'design_category', 'designs'),
  ]);
}, 100);

/**
 * Remove unpublished landing pages from the menus (menu items added as a
 * Category, or as a custom link to the landing page URL).
 */
add_filter('wp_nav_menu_objects', function ($items) {
  if (mulroy_landing_can_preview() || !mulroy_landing_unpublished_ids()) {
    return $items;
  }

  $hidden_ids = [];

  foreach ($items as $item) {
    $is_hidden_term = $item->type === 'taxonomy'
      && $item->object === 'design_category'
      && in_array((int) $item->object_id, mulroy_landing_unpublished_ids(), true);

    if ($is_hidden_term || mulroy_landing_url_is_hidden($item->url)) {
      $hidden_ids[] = (int) $item->ID;
    }
  }

  if (!$hidden_ids) {
    return $items;
  }

  // Drop the item and anything nested under it.
  do {
    $count = count($hidden_ids);
    foreach ($items as $item) {
      if (in_array((int) $item->menu_item_parent, $hidden_ids, true) && !in_array((int) $item->ID, $hidden_ids, true)) {
        $hidden_ids[] = (int) $item->ID;
      }
    }
  } while (count($hidden_ids) !== $count);

  return array_values(array_filter($items, function ($item) use ($hidden_ids) {
    return !in_array((int) $item->ID, $hidden_ids, true);
  }));
});

/**
 * Yoast SEO: leave unpublished landing pages out of the sitemap.
 */
add_filter('wpseo_exclude_from_sitemap_by_term_ids', function ($ids) {
  return array_merge((array) $ids, mulroy_landing_unpublished_ids());
});

/**
 * WordPress core sitemaps (when Yoast's are off): same.
 */
add_filter('wp_sitemaps_taxonomies_query_args', function ($args, $taxonomy) {
  if ($taxonomy === 'design_category' && mulroy_landing_unpublished_ids()) {
    $args['exclude'] = array_merge((array) ($args['exclude'] ?? []), mulroy_landing_unpublished_ids());
  }

  return $args;
}, 10, 2);

/* -------------------------------------------------------------------------
 * Admin: Designs > Categories
 * ---------------------------------------------------------------------- */

/**
 * Status label, for the list column and notices.
 */
function mulroy_landing_status_label($published)
{
  return $published ? __('Published', 'mulroy') : __('Unpublished', 'mulroy');
}

/**
 * URL of the Publish / Unpublish row link.
 */
function mulroy_landing_toggle_url($term_id, $publish)
{
  return wp_nonce_url(
    add_query_arg(
      [
        'action'  => 'mulroy_landing_status',
        'term_id' => (int) $term_id,
        'publish' => $publish ? 1 : 0,
      ],
      admin_url('admin-post.php')
    ),
    'mulroy_landing_status_' . (int) $term_id
  );
}

// "Landing page" column, after the name.
add_filter('manage_edit-design_category_columns', function ($columns) {
  $new = [];

  foreach ($columns as $key => $label) {
    $new[$key] = $label;
    if ($key === 'name') {
      $new['mulroy_landing'] = __('Landing page', 'mulroy');
    }
  }

  return $new;
});

add_filter('manage_design_category_custom_column', function ($content, $column, $term_id) {
  if ($column !== 'mulroy_landing') {
    return $content;
  }

  $published = mulroy_landing_is_published($term_id);

  return sprintf(
    '<span style="color:%s;font-weight:600;">%s</span>',
    $published ? '#008a20' : '#b32d2e',
    esc_html(mulroy_landing_status_label($published))
  );
}, 10, 3);

// Publish / Unpublish row link; "View" becomes "Preview" when unpublished.
add_filter('design_category_row_actions', function ($actions, $term) {
  if (!current_user_can(get_taxonomy('design_category')->cap->manage_terms)) {
    return $actions;
  }

  $published = mulroy_landing_is_published($term);

  if (!$published && isset($actions['view'])) {
    $actions['view'] = sprintf(
      '<a href="%s" aria-label="%s">%s</a>',
      esc_url(get_term_link($term)),
      esc_attr(sprintf(__('Preview the &#8220;%s&#8221; landing page', 'mulroy'), $term->name)),
      esc_html__('Preview', 'mulroy')
    );
  }

  $actions['mulroy_landing_status'] = sprintf(
    '<a href="%s">%s</a>',
    esc_url(mulroy_landing_toggle_url($term->term_id, !$published)),
    $published ? esc_html__('Unpublish', 'mulroy') : esc_html__('Publish', 'mulroy')
  );

  return $actions;
}, 10, 2);

// Row link handler.
add_action('admin_post_mulroy_landing_status', function () {
  $term_id = isset($_GET['term_id']) ? absint($_GET['term_id']) : 0;

  if (!$term_id || !current_user_can(get_taxonomy('design_category')->cap->manage_terms)) {
    wp_die(esc_html__('Not allowed.', 'mulroy'));
  }

  check_admin_referer('mulroy_landing_status_' . $term_id);

  $term = get_term($term_id, 'design_category');

  if (!$term || is_wp_error($term)) {
    wp_die(esc_html__('Category not found.', 'mulroy'));
  }

  $publish = !empty($_GET['publish']);
  mulroy_landing_set_published($term_id, $publish);

  $back = wp_get_referer() ?: admin_url('edit-tags.php?taxonomy=design_category&post_type=designs');
  $back = remove_query_arg(['mulroy_landing', 'mulroy_landing_term'], $back);

  wp_safe_redirect(add_query_arg(
    [
      'mulroy_landing'      => $publish ? 'published' : 'unpublished',
      'mulroy_landing_term' => $term_id,
    ],
    $back
  ));
  exit;
});

add_action('admin_notices', function () {
  if (empty($_GET['mulroy_landing']) || empty($_GET['mulroy_landing_term'])) {
    return;
  }

  $term = get_term(absint($_GET['mulroy_landing_term']), 'design_category');

  if (!$term || is_wp_error($term)) {
    return;
  }

  $message = $_GET['mulroy_landing'] === 'published'
    ? __('The “%s” landing page is published.', 'mulroy')
    : __('The “%s” landing page is unpublished. Visitors get a 404; you can still preview it while logged in.', 'mulroy');

  printf(
    '<div class="notice notice-success is-dismissible"><p>%s</p></div>',
    esc_html(sprintf($message, $term->name))
  );
});

/**
 * The status select, shared by the add and edit forms.
 */
function mulroy_landing_status_select($published)
{
  ?>
  <select name="mulroy_landing_status" id="mulroy_landing_status">
    <option value="publish" <?php selected($published); ?>><?php esc_html_e('Published', 'mulroy'); ?></option>
    <option value="draft" <?php selected(!$published); ?>><?php esc_html_e('Unpublished (404 for visitors)', 'mulroy'); ?></option>
  </select>
  <?php
  wp_nonce_field('mulroy_landing_status_form', 'mulroy_landing_status_nonce');
}

// Add form: new categories start unpublished, so an empty landing page
// doesn't go live before it has content.
add_action('design_category_add_form_fields', function () {
  ?>
  <div class="form-field term-mulroy-landing-status-wrap">
    <label for="mulroy_landing_status"><?php esc_html_e('Landing page', 'mulroy'); ?></label>
    <?php mulroy_landing_status_select(false); ?>
    <p><?php esc_html_e('Publish it when its Dynamic Blocks are ready. Designs can be assigned to the category either way.', 'mulroy'); ?></p>
  </div>
  <?php
});

// Edit form.
add_action('design_category_edit_form_fields', function ($term) {
  $published = mulroy_landing_is_published($term);
  ?>
  <tr class="form-field term-mulroy-landing-status-wrap">
    <th scope="row"><label for="mulroy_landing_status"><?php esc_html_e('Landing page', 'mulroy'); ?></label></th>
    <td>
      <?php mulroy_landing_status_select($published); ?>
      <p class="description">
        <?php esc_html_e('Unpublished: the landing page shows a 404 to visitors and is removed from the sitemap and menus. You can still preview it while logged in. Designs can be assigned to the category either way.', 'mulroy'); ?>
        <a href="<?php echo esc_url(get_term_link($term)); ?>" target="_blank" rel="noopener"><?php echo $published ? esc_html__('View', 'mulroy') : esc_html__('Preview', 'mulroy'); ?></a>
      </p>
    </td>
  </tr>
  <?php
});

/**
 * Save the field. Only when the form sent it, so Quick Edit (which doesn't
 * have the field) leaves the status alone.
 */
function mulroy_landing_save_status_field($term_id)
{
  if (
    !isset($_POST['mulroy_landing_status'], $_POST['mulroy_landing_status_nonce'])
    || !wp_verify_nonce(sanitize_key($_POST['mulroy_landing_status_nonce']), 'mulroy_landing_status_form')
    || !current_user_can(get_taxonomy('design_category')->cap->manage_terms)
  ) {
    return;
  }

  mulroy_landing_set_published($term_id, sanitize_key($_POST['mulroy_landing_status']) !== 'draft');
}
add_action('created_design_category', 'mulroy_landing_save_status_field');
add_action('edited_design_category', 'mulroy_landing_save_status_field');

// Notice at the top of the edit screen of an unpublished category.
add_action('design_category_pre_edit_form', function ($term) {
  if (mulroy_landing_is_published($term)) {
    return;
  }
  ?>
  <div class="notice notice-warning inline" style="margin:20px 0;padding:12px 15px;">
    <p>
      <strong><?php esc_html_e('This landing page is unpublished.', 'mulroy'); ?></strong>
      <?php esc_html_e('Visitors get a 404. Change “Landing page” to Published below, or use Publish in the Categories list, when it is ready.', 'mulroy'); ?>
    </p>
    <p>
      <a href="<?php echo esc_url(mulroy_landing_toggle_url($term->term_id, true)); ?>" class="button button-primary"><?php esc_html_e('Publish now', 'mulroy'); ?></a>
      <a href="<?php echo esc_url(get_term_link($term)); ?>" class="button" target="_blank" rel="noopener"><?php esc_html_e('Preview', 'mulroy'); ?></a>
    </p>
  </div>
  <?php
});
