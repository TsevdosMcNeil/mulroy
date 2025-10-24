<?php
$heading = get_sub_field( 'heading' );
$desc = get_sub_field( 'desc' );
$photo = get_sub_field( 'photo' );
?>
         <section
            class="scroll-section site-container bg-site no_min_height_mobile"
          >
            <div
              class="flex flex-col lg:grid grid-cols-12"
              style="grid-template-rows: min-content 1fr"
            >
              <div class="col-start-6 col-end-13 mb-8">
                <div class="atrium-post-desc-text fs-2xl section__copy__content">
                  <?php echo $desc; ?>
                </div>
              </div>
              <div
                class="col-start-6 col-end-13 h-full"
                id="atrium-post-right-text-image"
              >
                <div
                  class="w-full image-container mb-[12px]" >
	<img src='<?php echo $photo; ?>'/>
</div>
                <span class="post-caption"> <?php echo $heading; ?></span>
              </div>
            </div>
          </section>