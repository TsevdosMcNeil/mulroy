<?php
$heading = get_sub_field( 'heading' );
$desc = get_sub_field( 'desc' );
$image = get_sub_field( 'image' );
?>          <!-- 2nd section -->
          <section class="scroll-section bg-site site-container container-py no_min_height_mobile consistent__space__single__project__mobile" style="min-height:auto;">
            <div class="section-inner-container h-full">
              <div
                class="col-start-1 col-end-8 lg:self-center"
                id="news-post-page-left-img-right-text"
              >
                <div
                  class="flex flex-col lg:flex-row items-center w-full gap-y-5"
                >
                  <div class="flex flex-col w-full">
                    <div
                      class="w-full bg-no-repeat bg-start lg:bg-center bg-cover min-h-[40vw] project-mobile-responsive"
                      style="
                        background-image: url('<?php echo $image; ?>');
                      "
                    ></div>
					  <?php if($heading): ?>
                    <span class="post-caption">
                     <?php echo $heading; ?></span
                    >
					  <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-start-9 col-end-13">
                <div class="flex justify-center w-full h-full items-center">
                  <div class="lg:max-w-[28vw]">
                    <?php echo $desc; ?>
                  </div>
                </div>
              </div>
            </div>
          </section>