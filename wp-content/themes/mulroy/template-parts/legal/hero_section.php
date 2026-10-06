<?php
$page_title = get_sub_field("page_name");
$description_text = get_sub_field("description_text");
?>
<!-- template-parts/legal/hero_section.php -->
<section class="legal__section border-bottom-legal" style="background:#f7ede5;">
  <div class="page-sect-content">
    <div class="legal__text">
      <h1><?php echo $page_title; ?></h1>
    </div>
    <div class="legal__text__info">
      <p>
        <?php echo $description_text; ?>
      </p>
    </div>
  </div>
</section>
<!-- End template-parts/legal/hero_section.php -->