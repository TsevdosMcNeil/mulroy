<?php
$company_information_title = get_sub_field("company_information_title");
$info_text_block = get_sub_field("info_text_block");
?>
<!-- template-parts/legal/company_information.php -->
<section class="company__info__section border-bottom-legal" style="background:#f7ede5;">
  <div class="page-sect-content gap-[1.1rem]">
    <div class="company__info__heading">
      <h1><?php echo $company_information_title; ?></h1>
    </div>
    <div class="company__block__container">

      <?php if ($info_text_block): ?>
        <?php foreach ($info_text_block as $index => $block):
          $description = $block['description_info'];
        ?>
          <div class="company__info__text__1">
            <p>
              <?php echo $description; ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- End template-parts/legal/company_information.php -->