<?php
/**
 * Landing CTA Links
 *
 * Large right-column links separated by lines
 * (e.g. "Discuss Your Project", "View Residential Projects").
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
              class="landing-cta-links__link group flex items-center justify-between py-4 lg:py-[1.6vw]">
              <span class="fs-2xl letter__spacing__custom__-2px"><?php echo esc_html($link['title']); ?></span>
              <?php
              get_template_part(
                'template-parts/components/icons/arrow',
                null,
                [
                  'container_class' => 'landing-cta-links__arrow inline-flex',
                  'arrow_class'     => 'site__arrow',
                ]
              );
              ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<!-- End template-parts/components/landing_cta_links.php -->
