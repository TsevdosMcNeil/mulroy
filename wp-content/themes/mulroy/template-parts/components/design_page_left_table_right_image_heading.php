<?php
$right_heading = get_sub_field('right_heading');
$right_desc = get_sub_field('right_desc');
$right_image = get_sub_field('right_image');
?>
<!-- template-parts/components/design_page_left_table_right_image_heading.php -->
<section class="scroll-section site-container bg-site no_min_height_mobile consistent__space__single__project__mobile table__single__design" style="min-height:auto;">
  <div
    class="flex pt-[2rem] lg:pt-0 flex-col lg:grid grid-cols-12 h-full my-custom-grid lg:gap-y-0">
    <div class="col-span-12">
      <table class="lg:max-w-[30vw] archive-table">
        <tr class="head-row">
          <th class="text-start w-1/2"></th>
          <th class="text-start"></th>
        </tr>
        <?php if (have_rows('left_side_extra_info')):
          while (have_rows('left_side_extra_info')) : the_row();
            $name = get_sub_field('name');
            $value = get_sub_field('value');
        ?>
            <tr class="data-row">
              <?php if ($name): ?>
                <td class="letter__spacing__custom__-1px"><?php echo $name; ?></td>
              <?php endif; ?>
              <?php if ($value): ?>
                <td class="letter__spacing__custom__-1px"><?php echo $value; ?></td>
              <?php endif; ?>
            </tr>
        <?php
          endwhile;
        endif;
        ?>
      </table>
    </div>
    <div class="col-start-6 col-end-13">
      <div class="atrium-post-desc-text fs-2xl lg:max-w-[60vw] section__copy__content letter__spacing__custom__-2px">
        <?php echo $right_desc; ?>
      </div>
    </div>
    <div
      class="col-start-6 col-end-11 mt-4 mb-0 lg:mb-8"
      id="atrium-post-right-text-image">
      <?php
      get_template_part(
        'template-parts/components/column-image',
        null,
        [
          'image'   => $right_image,
          'heading' => $right_heading,
          'container_class' => 'w-full mb-[12px]'
        ]
      );
      ?>
    </div>
  </div>
</section>
<!-- End template-parts/components/design_page_left_table_right_image_heading.php -->