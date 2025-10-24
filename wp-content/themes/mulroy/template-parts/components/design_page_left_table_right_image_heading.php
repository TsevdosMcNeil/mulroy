<?php
$right_heading = get_sub_field( 'right_heading' );
$right_desc = get_sub_field( 'right_desc' );
$right_image = get_sub_field( 'right_image' );
?>
<!-- 1st section -->
          <section class="scroll-section site-container bg-site no_min_height_mobile consistent__space__single__project__mobile" style="min-height:auto;">
            <div
              class="flex pt-[2rem] lg:pt-0 flex-col lg:grid grid-cols-12 h-full my-custom-grid lg:gap-y-0"
            >
              <div class="col-span-12">
                <table class="lg:max-w-[30vw] archive-table">
                  <tr class="head-row">
                    <th class="text-start w-1/2"></th>
                    <th class="text-start"></th>
                  </tr>
                  <?php if( have_rows('left_side_extra_info') ):  
                 while( have_rows('left_side_extra_info') ) : the_row();
                 
                 $value = get_sub_field('value');
                 ?>
                  <tr class="data-row">
                    <td><?php echo $value; ?></td>
                  </tr>
                  <?php 
                 endwhile;
                 endif;
                 ?>
                </table>
              </div>
              <div class="col-start-6 col-end-13">
                <div class="atrium-post-desc-text fs-2xl lg:max-w-[60vw] section__copy__content">
                  <?php echo $right_desc; ?>
                </div>
              </div>
              <div
                class="col-start-6 col-end-11 mt-4 mb-0 lg:mb-8"
                id="atrium-post-right-text-image"
              >
                <div
                  class="w-full image-container mb-[12px]"
                 
                >
<img src='<?php echo $right_image; ?>'/>
</div>
                <span class="post-caption">
                  <?php echo $right_heading; ?></span
                >
              </div>
            </div>
          </section>