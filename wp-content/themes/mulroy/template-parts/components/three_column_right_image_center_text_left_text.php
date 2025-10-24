<?php
$desc_right = get_sub_field( 'desc_right' );
$desc_center = get_sub_field( 'desc_center' );
$image = get_sub_field( 'image' );
?>
          <section
            class="scroll-section site-container bg-site border-b border-black container-py no_min_height_mobile consistent__space__single__project__mobile"
				   id='three-column-right-image-center-text-left-text'
          >
            <div class="section-inner-container">
              <div class="col-start-2 col-end-8">
                <div
                  class="flex-col lg:flex-row flex justify-between items-center h-full gap-5"
                >
                  <div class="studio-page-text-content">
                    <?php echo $desc_right; ?>
                  </div>
                  <div class="studio-page-text-content">
                    <?php echo $desc_center; ?>
                  </div>
                </div>
              </div>
              <div class="col-start-9 col-end-13">
                <div
                  class="image-container"
                 
                >
				  <img src='<?php echo $image; ?>' alt='studio-mulroy'/>
				  </div>
              </div>
            </div>
          </section>