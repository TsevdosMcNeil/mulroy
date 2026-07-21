<?php
$heading = get_sub_field( 'heading' );
$desc = get_sub_field( 'desc' );
$image = get_sub_field( 'image' );
?>

<!-- ACF:- two_column_left_heading_right_image_and_text -->
<section class="scroll-section bg-site no_min_height_mobile consistent__space__single__project__mobile">
            <div
              class="flex flex-col lg:grid grid-cols-12 h-full site-container my-custom-grid"
            >
              <div class="col-span-12">
				  <div class='page-bar-padding'>
                <h2 class="fs-3xl uppercase letter__spacing__custom__-3-25px"><?php echo $heading; ?></h2>
					  
				  </div>
              </div>
              <div class="col-start-6 col-end-13">
                <div class="page__desc fs-2xl section__copy__content letter__spacing__custom__-2px">
                  <?php echo $desc; ?>
                </div>
              </div>
              <div class="col-start-6 col-end-13">
                <a class="home-project-section h-full project-img">
                  <div
                    class="image-container"
                   
                  >
					<img src='<?php echo $image; ?>' alt='studio-page-mulroy'/>
					</div>
                </a>
              </div>
            </div>
          </section>