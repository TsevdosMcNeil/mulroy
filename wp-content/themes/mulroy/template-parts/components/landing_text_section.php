<?php
/**
 * Landing Text Section
 *
 * Left heading and/or right heading, an optional large lead paragraph and
 * up to two columns of body copy in the right half of the grid.
 * Border: "full" = full-width line, "right" = line from column 6 to the
 * right edge (sub-section), "none" = no line.
 */
$border_style  = get_sub_field('border_style') ?: 'full';
$left_heading  = get_sub_field('left_heading');
$right_heading = get_sub_field('right_heading');
$lead          = get_sub_field('lead');
$left_column   = get_sub_field('left_column');
$right_column  = get_sub_field('right_column');

if (!$left_heading && !$right_heading && !$lead && !$left_column && !$right_column) {
  return;
}

$section_class = 'landing-text-section scroll-section bg-site no_min_height_mobile pt-[3rem] lg:pt-[6.25vw]';
$right_border  = $border_style === 'right';
?>
<!-- template-parts/components/landing_text_section.php -->
<section class="<?php echo esc_attr($section_class); ?>">
  <div class="<?php echo $border_style === 'full' ? 'border-t border-black' : ''; ?>">
    <div class="site-container flex flex-col lg:grid grid-cols-12 gap-y-6 lg:gap-y-0 pt-6 lg:pt-[2.08vw]">

      <div class="col-start-1 col-end-6">
        <?php if ($left_heading) : ?>
          <h2 class="fs-2xl letter__spacing__custom__-2px lg:max-w-[23vw]">
            <?php echo esc_html($left_heading); ?>
          </h2>
        <?php endif; ?>
      </div>

      <div class="col-start-6 col-end-13 flex flex-col gap-y-6 lg:gap-y-[3.125vw] <?php echo $right_border ? 'border-t border-black pt-6 lg:pt-[2.08vw] lg:-mr-8' : ''; ?>">

        <?php if ($right_heading) : ?>
          <h2 class="fs-2xl letter__spacing__custom__-2px lg:max-w-[47.5vw] <?php echo ($lead || $left_column || $right_column) ? 'lg:mb-[0.9vw]' : ''; ?>">
            <?php echo esc_html($right_heading); ?>
          </h2>
        <?php endif; ?>

        <?php if ($lead) : ?>
          <div class="landing-text-section__lead fs-2xl letter__spacing__custom__-2px lg:pr-[2.08vw]">
            <?php echo wp_kses_post($lead); ?>
          </div>
        <?php endif; ?>

        <?php if ($left_column || $right_column) : ?>
          <div class="landing-text-section__columns flex flex-col lg:grid grid-cols-2 gap-y-4 lg:gap-x-[1.04vw] lg:max-w-[47.4vw]">
            <div class="landing-text-section__copy fs-base letter__spacing__custom__-1px">
              <?php echo wp_kses_post($left_column); ?>
            </div>
            <?php if ($right_column) : ?>
              <div class="landing-text-section__copy fs-base letter__spacing__custom__-1px">
                <?php echo wp_kses_post($right_column); ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/landing_text_section.php -->
