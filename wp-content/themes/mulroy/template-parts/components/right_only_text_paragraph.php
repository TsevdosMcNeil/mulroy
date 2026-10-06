<?php

$content = get_sub_field('content');

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
        <?php echo wp_kses_post($content); ?>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/right_only_text_paragraph.php -->