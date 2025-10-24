<?php
$heading = get_sub_field( 'heading' );
$image = get_sub_field( 'image' );
?>
          <section class="scroll-section site-container bg-site container-py no_min_height_mobile consistent__space__single__project__mobile">
            <div class="flex flex-col lg:grid grid-cols-12 h-full">
              <div
                class="col-start-2 col-end-12"
                id="atrium-post-banner-image"
              >
                <div class="project-center">
                  <div
                    class="image-container"
                   
                  >
	<img src='<?php echo $image; ?>'/>
</div>
                  <span class="post-caption"><?php echo $heading; ?></span>
                </div>
              </div>
            </div>
            
          </section>