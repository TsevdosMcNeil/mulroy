<?php
$heading = get_sub_field( 'heading' );
$desc = get_sub_field( 'desc' );
$image = get_sub_field( 'image' );
?>
<!-- ACF:- two_column_left_image_right_text -->
          <section class="scroll-section site-container container-py bg-site no_min_height_mobile consistent__space__single__project__mobile">
            <div
              class="flex flex-col lg:grid grid-cols-12 gap-y-[3rem]"
            >
              <div
                class="col-start-3 col-end-7"
                id="atrium-post-center-image-text"
              >
                <div class="project-center">
                  <div
                    class="w-full image-container ">
<img src='<?php echo $image; ?>' class='portrait-img'/>
</div>
					<?php if($heading): ?>
                  <span class="post-caption"><?php echo $heading; ?></span>
					<?php endif; ?>
                </div>
              </div>
              <div class="col-start-9 col-end-12 self-center">
                <div class="text-start letter__spacing__custom__-1px">
                  <?php echo $desc; ?>
                </div>
              </div>
            </div>
          </section>