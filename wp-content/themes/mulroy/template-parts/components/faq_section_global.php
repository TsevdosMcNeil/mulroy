<?php
/**
 * FAQ Section Global
 *
 * Dynamic Blocks version of the Legal page FAQ (same fields and accordion
 * markup/CSS), placed in the right column. Also prints FAQPage structured data.
 */
$faq_text = get_sub_field('faq_text');
$faq_card = get_sub_field('faq_card');

if (!$faq_card) {
  return;
}

$faq_id = 'faq-' . get_row_index();
$schema = [];
?>
<!-- template-parts/components/faq_section_global.php -->
<section class="faq-section-global scroll-section bg-site no_min_height_mobile pt-[3rem] lg:pt-[6.25vw]">
  <div class="site-container flex flex-col lg:grid grid-cols-12">
    <div class="col-start-6 col-end-13 border-t border-black pt-6 lg:pt-[2.08vw] lg:-mr-8">
      <?php if ($faq_text) : ?>
        <h2 class="fs-2xl letter__spacing__custom__-2px mb-6 lg:mb-[3.6vw]"><?php echo esc_html($faq_text); ?></h2>
      <?php endif; ?>

      <div class="faq-section-global__list lg:mr-8 border-b border-black">
        <?php foreach ($faq_card as $index => $card) :
          $question = $card['faq_question'] ?? '';
          $answer   = $card['faq_answer'] ?? '';
          $input_id = $faq_id . '-' . $index;

          if (!$question) {
            continue;
          }

          $schema[] = [
            '@type'          => 'Question',
            'name'           => wp_strip_all_tags($question),
            'acceptedAnswer' => [
              '@type' => 'Answer',
              'text'  => wp_strip_all_tags($answer),
            ],
          ];
        ?>
          <div class="faq__card faq-section-global__card border-t border-black pt-4 lg:pt-[1.2vw]">
            <label for="<?php echo esc_attr($input_id); ?>" class="faq__question">
              <div class="arrow_icon"></div>
              <p><?php echo esc_html($question); ?></p>
            </label>
            <input id="<?php echo esc_attr($input_id); ?>" type="checkbox" class="checkbox" />
            <div class="faq__answer">
              <?php echo wp_kses_post(wpautop($answer)); ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php if ($schema) : ?>
  <script type="application/ld+json">
    <?php echo wp_json_encode([
      '@context'   => 'https://schema.org',
      '@type'      => 'FAQPage',
      'mainEntity' => $schema,
    ]); ?>
  </script>
<?php endif; ?>
<!-- End template-parts/components/faq_section_global.php -->
