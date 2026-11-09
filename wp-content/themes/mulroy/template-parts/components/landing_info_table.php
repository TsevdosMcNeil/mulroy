<?php
/**
 * Landing Info Table
 *
 * Right-column list of label / description rows separated by lines
 * (e.g. "An Integrated Architectural Service", "Areas of Specialism").
 * A row with a link becomes clickable (e.g. link to another category page).
 */
$rows = get_sub_field('rows');

if (!$rows) {
  return;
}
?>
<!-- template-parts/components/landing_info_table.php -->
<section class="landing-info-table scroll-section site-container bg-site no_min_height_mobile pt-6 lg:pt-[2.08vw]">
  <div class="flex flex-col lg:grid grid-cols-12">
    <div class="col-start-6 col-end-13">
      <ul class="landing-info-table__list border-t border-b border-black">
        <?php foreach ($rows as $row) :
          $label       = $row['label'] ?? '';
          $description = $row['description'] ?? '';
          $link        = $row['link'] ?? null;
          $url         = is_array($link) ? ($link['url'] ?? '') : '';
          $target      = is_array($link) && !empty($link['target']) ? $link['target'] : '_self';
          $tag         = $url ? 'a' : 'div';

          if (!$label && !$description) {
            continue;
          }
        ?>
          <li class="landing-info-table__row border-t border-black first:border-t-0">
            <<?php echo $tag; ?>
              class="landing-info-table__inner flex flex-col lg:grid grid-cols-[29.2%_1fr] gap-y-1 py-3 lg:py-[1.2vw] <?php echo $url ? 'is-link' : ''; ?>"
              <?php if ($url) : ?>
                href="<?php echo esc_url($url); ?>"
                target="<?php echo esc_attr($target); ?>"
              <?php endif; ?>>
              <span class="fs-base uppercase letter__spacing__custom__-1px"><?php echo esc_html($label); ?></span>
              <span class="fs-base letter__spacing__custom__-1px"><?php echo esc_html($description); ?></span>
            </<?php echo $tag; ?>>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<!-- End template-parts/components/landing_info_table.php -->
