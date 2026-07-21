<?php
$video_url = get_sub_field( 'video_url' );
$image = get_sub_field( 'image' );
?>

     <!-- hero section -->
          <section class="scroll-section" id="news-top">
            <div class="hero-background"></div>
            <div class="hero-overlay z-20"></div>
            <div class="hero-content">
              <div class="video-player w-full h-full overflow-hidden">
                <video
                  class="top-0 relative z-[-1] md:left-0 xl:w-full bg-gray-400 bg-cover bg-center h-full xl:h-auto"
                  autoplay=""
                  muted=""
                  loop=""
                  playsinline=""
                >
                  <source
                    src="<?php echo $video_url; ?>"
                    type="video/mp4"
                  />

                  <img
                    src="<?php echo $image; ?>"
                    alt="Hero"
                    class="w-full h-full object-cover"
                  />
                </video>
              </div>
            </div>
            <div class="news-post-hero-content site-container z-20">
              <h3 class="fs-lg"><?php echo $published_date = get_the_date('F j, Y'); ?></h3>
              <h2 class="fs-3xl lg:max-w-[35vw]">
                <?php the_title(); ?>
              </h2>
            </div>
          </section>