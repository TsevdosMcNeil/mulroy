<?php
$video_url = get_sub_field( 'video_url' );
$image = get_sub_field( 'image' );
$design_type = get_field( 'design_type' );
?>

     <!-- hero section -->
          <section class="scroll-section video-hero hero-section-height" style="padding-bottom:0;" id="news-top">
			  <div class="custom-cursor" id="custom-cursor">
				  
			  </div>
            <div class="hero-background"></div>
            <div class="hero-overlay z-20"></div>
            <div class="hero-content hero__content__single__design py-0">
              <div class="video-player w-full h-full overflow-hidden">
				  <?php if($video_url): ?>
				  <video
                  class="top-0 relative  h-full object-cover z-[-1] md:left-0 xl:w-full bg-gray-400 bg-cover bg-center h-full"
                  autoplay=""
                  muted=""
                  loop=""
                  playsinline=""
                >
                  <source
                    src="<?php echo $video_url; ?>"
                    type="video/mp4"
                  />

                 
                </video>
				  <?php else: ?>
				  
				  <img
                    src="<?php echo $image; ?>"
                    alt="Hero"
                    class="w-full h-full object-cover"
                  />
				  <?php endif; ?>
                
				   
              </div>
            </div>
            <div class="news-post-hero-content site-container z-20">
              <h3 class="fs-lg uppercase"><?php echo $design_type; ?></h3>
              <h2 class="fs-3xl lg:max-w-[35vw] mt-4">
                <?php the_title(); ?>
              </h2>
            </div>
          </section>