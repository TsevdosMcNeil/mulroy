<?php
get_header();
?>
<!-- single.php -->
<?php
if (get_post_type() === 'post') :
  // News item page: hero (date letters + title), the editor text (the same
  // text the News page list shows), then any Dynamic Blocks added in the
  // admin. A "Hero section" block only sets the hero image here; without one
  // the featured image is used.
  get_template_part(
    'template-parts/components/hero/posts',
    null,
    [
      'hero_image' => mulroy_news_hero_image(),
    ]
  );

  get_template_part(
    'template-parts/components/right_only_text_paragraph',
    null,
    [
      'content' => apply_filters('the_content', get_the_content()),
    ]
  );

  get_template_part(
    'template-parts/components',
    null,
    [
      'exclude_layouts' => ['hero_section'],
    ]
  );

  // Back arrow: the page-navigation script sends visitors back to where they
  // came from; this href is the fallback (e.g. opened from Google).
  $referer   = wp_get_referer();
  $same_site = $referer && wp_parse_url($referer, PHP_URL_HOST) === wp_parse_url(home_url(), PHP_URL_HOST);

  get_template_part(
    'template-parts/post-navigation',
    null,
    [
      'id'         => 'news-post-navigation',
      'back_url'   => $same_site ? $referer : mulroy_news_page_url(),
      'top_anchor' => '#news-top',
    ]
  );
else :
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
endif;
?>
<!-- End single.php -->
<?php get_footer(); ?>
