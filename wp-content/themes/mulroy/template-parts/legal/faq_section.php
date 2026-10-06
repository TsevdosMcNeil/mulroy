<?php
$faq_text = get_sub_field("faq_text");
$faq_card = get_sub_field("faq_card");
?>
<!-- template-parts/legal/faq_section.php -->
<section class="faq__section" style="background:#f7ede5;">
  <div class="page-sect-content gap-[1.1rem]">
    <div class="faq__text">
      <h1><?php echo $faq_text; ?></h1>
    </div>
    <div class="faq_accordion__container">
      <?php if ($faq_card): ?>
        <?php foreach ($faq_card as $index => $card):
          $faq_question = $card['faq_question'];
          $faq_answer = $card['faq_answer'];
        ?>
          <div class="faq__card">
            <label for="<?php echo $index; ?>" class="faq__question">
              <div class="arrow_icon"></div>
              <p>
                <?php echo $faq_question; ?>
              </p>
            </label>
            <input id="<?php echo $index; ?>" type="checkbox" class="checkbox" />
            <div class="faq__answer">
              <p>
                <?php echo $faq_answer; ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- End template-parts/legal/faq_section.php -->