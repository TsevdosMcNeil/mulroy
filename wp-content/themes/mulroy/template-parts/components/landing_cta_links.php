<?php
/**
 * Landing CTA Links
 *
 * Large right-column links separated by lines
 * (e.g. "Discuss Your Project", "View Residential Projects").
 * Hover: the row fills with light grey (odd rows) or blue (even rows)
 * and the arrow fades in, as in the Figma prototype.
 */
$links = get_sub_field('links');

if (!$links) {
  return;
}
?>
<!-- template-parts/components/landing_cta_links.php -->
<section class="landing-cta-links scroll-section site-container bg-site no_min_height_mobile pt-6 lg:pt-[2.08vw]">
  <div class="flex flex-col lg:grid grid-cols-12">
    <div class="col-start-6 col-end-13">
      <ul class="border-t border-b border-black">
        <?php foreach ($links as $row) :
          $link = $row['link'] ?? null;

          if (!is_array($link) || empty($link['url'])) {
            continue;
          }
        ?>
          <li class="border-t border-black first:border-t-0">
            <a
              href="<?php echo esc_url($link['url']); ?>"
              target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
              class="landing-cta-links__link flex items-center justify-between gap-4 py-4 px-3 lg:py-[1.6vw] lg:px-[0.94vw]">
              <span class="fs-2xl letter__spacing__custom__-2px"><?php echo esc_html($link['title']); ?></span>
              <svg class="landing-cta-links__arrow" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M0 16H34M19 1L34 16L19 31" stroke="currentColor" stroke-width="1.5" vector-effect="non-scaling-stroke" />
              </svg>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<!-- End template-parts/components/landing_cta_links.php -->
