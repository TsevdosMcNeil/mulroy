<?php
/**
 * News (WordPress "posts", renamed to News in the admin).
 *
 * Each news item has its own page (single.php): hero, the editor text and
 * then any Dynamic Blocks the editors add. These helpers are shared by the
 * single page, the News page list and the "load more" AJAX list.
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
