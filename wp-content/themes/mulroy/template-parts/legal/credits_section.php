<?php
$credit_section_text = get_sub_field("credit_section_text");
$website_column = get_sub_field("website_column");
$mullroy_team = get_sub_field("mullroy_team");
$photographers = get_sub_field("photographers");
?>
<!-- template-parts/legal/credits_section.php -->
<section class="credits__section border-bottom-legal" style="background:#f7ede5;">
  <div class="page-sect-content gap-[1.1rem]">
    <div class="credit__text">
      <h1><?php echo $credit_section_text; ?></h1>
    </div>
    <div class="website__holder">

      <p>MULROY TEAM</p>
      <?php if ($mullroy_team): ?>
        <?php foreach ($mullroy_team as $index => $team_column):
          $row_text = $team_column['row_text'];
        ?>
          <p><?php echo $row_text; ?></p>
        <?php endforeach; ?>
      <?php endif; ?>


    </div>
    <div class="mullroy__team">
      <p>PHOTOGRAPHERS</p>
      <?php if ($photographers): ?>
        <?php foreach ($photographers as $index => $photo_column):
          $row_text = $photo_column['row_text'];
        ?>
          <p><?php echo $row_text; ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div class="photographers">

      <p>WEBSITE</p>
      <?php if ($website_column): ?>
        <?php foreach ($website_column as $index => $web_column):
          $row_text = $web_column['row_text'];
        ?>
          <p><?php echo $row_text; ?></p>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>
</section>


<!-- End template-parts/legal/credits_section.php -->