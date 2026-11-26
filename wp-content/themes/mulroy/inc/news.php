<?php
/**
 * News (WordPress "posts", renamed to News in the admin).
 *
 * Each news item has its own page (single.php): hero, the editor text and
 * then any Dynamic Blocks the editors add. These helpers are shared by the
 * single page, the News page list and the "load more" AJAX list.
 *
 * The single pages can be turned off in Fento > Single post pages. Then the
 * News list has no links, the home page links to the item on the News page,
 * and the plugin redirects the old URLs here.
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * URL of the page that lists the news (the page using the "News Page"
 * template). Falls back to /news/.
 */
function mulroy_news_page_url()
{
  static $url = null;

  if ($url !== null) {
    return $url;
  }

  $pages = get_pages([
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'news-page.php',
    'number'     => 1,
  ]);

  $url = $pages ? get_permalink($pages[0]) : home_url('/news/');

  return $url;
}

/**
 * Hero image for a news item: the image of its "Hero section" block if the
 * editors added one, otherwise the featured image.
 *
 * @return int|string|null Attachment ID or URL (what background-image.php takes).
 */
function mulroy_news_hero_image($post_id = null)
{
  $post_id    = $post_id ?: get_the_ID();
  $components = function_exists('get_field') ? get_field('components', $post_id) : null;

  if (is_array($components)) {
    foreach ($components as $row) {
      if (($row['acf_fc_layout'] ?? '') === 'hero_section' && !empty($row['hero_image'])) {
        $image = $row['hero_image'];
        return is_array($image) ? ($image['ID'] ?? $image['url'] ?? null) : $image;
      }
    }
  }

  $thumbnail_id = get_post_thumbnail_id($post_id);

  return $thumbnail_id ?: null;
}

/**
 * Whether news items have their own page.
 *
 * Controlled from Fento > Single post pages (fento-wordpress-configuration
 * plugin). Without the plugin the pages stay on.
 */
function mulroy_news_has_single_pages()
{
  return !function_exists('fento_wp_configuration_single_posts_disabled')
    || !fento_wp_configuration_single_posts_disabled();
}

/**
 * Anchor of a news item on the News page. Matches the id of its
 * <section> in template-parts/news/list-item.php.
 */
function mulroy_news_item_anchor($post = null)
{
  return sanitize_title(get_the_title($post));
}

/**
 * Where a news item links to: its own page, or its place on the News page
 * when the single pages are turned off.
 */
function mulroy_news_item_url($post = null)
{
  if (mulroy_news_has_single_pages()) {
    return get_permalink($post);
  }

  return mulroy_news_page_url() . '#' . mulroy_news_item_anchor($post);
}

/**
 * With the single pages turned off, the plugin redirects news URLs and post
 * archives. Send them to the News page (and to the item's place on it).
 */
add_filter('fento_wp_configuration_posts_list_url', function () {
  return mulroy_news_page_url();
});

add_filter('fento_wp_configuration_single_post_url', function ($url, $post) {
  return mulroy_news_page_url() . '#' . mulroy_news_item_anchor($post);
}, 10, 2);
