<?php
$left_side_image = get_sub_field( 'left_side_image' );
$left_side_heading = get_sub_field( 'left_side_heading' );
$right_side_image = get_sub_field( 'right_side_image' );
$right_side_heading = get_sub_field( 'right_side_heading' );
?>
          <!-- 7nth section -->
          <section class="scroll-section bg-site site-container no_min_height_mobile pt-[2rem] consistent__space__single__project__mobile" style="min-height:auto;">
            <div class="flex flex-col justify-between h-full">
              <div class="section-inner-container py-0 lg:py-8 gap-y-[5rem] lg:gap-y-0">
                <div class="col-start-2 col-end-6 h-full">
                  <div class="flex flex-col w-full h-full justify-end">
                    <div
                      class="w-full image-container"
                     
                    >
<img src='<?php echo $left_side_image; ?>' class='portrait-img'/>
</div>
                    <span class="post-caption">
                      <?php echo $left_side_heading; ?></span
                    >
                  </div>
                </div>
                <div class="col-start-7 col-end-13 pb-0 lg:pb-8">
                  <div class="flex flex-col w-full justify-end h-full">
                    <div
                      class="w-full image-container"
                     
                    >
<img src='<?php echo $right_side_image; ?>'/>
</div>
                    <span class="post-caption">
                      <?php echo $right_side_heading ?></span
                    >
                  </div>
                </div>
              </div>
            </div>
          </section>
             <!-- page-bottom links -->

