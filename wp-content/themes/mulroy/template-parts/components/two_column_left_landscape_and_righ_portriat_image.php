<?php
$left_side_image = get_sub_field( 'left_side_image' );
$left_side_heading = get_sub_field( 'left_side_heading' );
$right_side_image = get_sub_field( 'right_side_image' );
$right_side_heading = get_sub_field( 'right_side_heading' );
?>
<!-- 3rd section -->
          <section class="scroll-section bg-site site-container container-py no_min_height_mobile consistent__space__single__project__mobile" style="min-height:auto;">
            <div class="section-inner-container gap-y-[5rem] lg:gap-y-0">
              <div class="col-start-2 col-end-7">
                <div class="flex flex-col w-full justify-center h-full">
                  <div
                    class="w-full image-container"
                   
                  >
					<img src='<?php echo $left_side_image; ?>'/>
					</div>
                  <span class="post-caption">
                    <?php echo $left_side_heading; ?></span
                  >
                </div>
              </div>
              <div class="col-start-8 col-end-12">
                <div class="project-center">
                  <div
                    class="w-full image-container"
                  
                  >
<img src='<?php echo $right_side_image; ?>' class='portrait-img'/>
</div>
                  <span class="post-caption">
                    <?php echo $right_side_heading; ?></span
                  >
                </div>
              </div>
            </div>
          </section>