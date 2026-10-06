<?php
$privacy_policy_text = get_sub_field("privacy_policy_text");
$information_block = get_sub_field("information_block");
?>
<!-- template-parts/legal/privacy_policy_section.php -->
<section class="privacy__policy__section border-bottom-legal" style="background:#f7ede5;">
  <div class="page-sect-content gap-[1.1rem]">
    <div class="privacy__policy__text">
      <h1><?php echo $privacy_policy_text ?></h1>
    </div>
    <div class="info__section__privacy__policy">
      <?php if ($information_block): ?>
        <?php foreach ($information_block as $index => $info_block):
          $heading = $info_block['heading'];
          $description = $info_block['description'];
        ?>
          <div class="info__box">
            <p><?php echo $heading; ?></p>
            <p>
              <?php echo $description; ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- End template-parts/legal/privacy_policy_section.php -->