<?php
// Inside the Dynamic Blocks loop the text comes from the block. Templates can
// also pass it in, e.g. single.php prints a news item's editor text with it.
$content = $args['content'] ?? get_sub_field('content');

if (!$content) {
  return;
}
?>
<!-- template-parts/components/right_only_text_paragraph.php -->
<section class="scroll-section site-container bg-site no_min_height_mobile">
  <div
    class="flex flex-col lg:grid grid-cols-12"
    style="grid-template-rows: min-content 1fr">
    <div class="col-start-6 col-end-11 mb-8">
      <div
        class="atrium-post-desc-text fs-2xl section__copy__content letter__spacing__custom__-2px">
        <?php
        // Passed-in text is already filtered by the caller (the_content), so
        // embeds such as YouTube iframes are kept.
        echo isset($args['content']) ? $content : wp_kses_post($content);
        ?>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/right_only_text_paragraph.php -->