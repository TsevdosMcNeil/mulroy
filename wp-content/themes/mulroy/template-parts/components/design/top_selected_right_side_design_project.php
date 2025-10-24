<?php
$top_selected_heading = get_sub_field( 'top_selected_heading' );
$desc = get_sub_field( 'desc' );
$design_name = get_sub_field( 'design_name' );
$design_title = get_sub_field( 'design_title' );
$design_image = get_sub_field( 'design_image' );
$design_post_url = get_sub_field( 'design_post_url' );
?>
          <section class="scroll-section bg-site no_min_height_mobile design__page__section__padding">
            <div
              class="flex flex-col lg:grid grid-cols-12 site-container"
            >
				<?php if($top_selected_heading): ?>
              <div class="col-span-12">
                <h2 class="fs-3xl page-bar-padding"><?php echo $top_selected_heading; ?></h2>
              </div>
				<?php endif; ?>
				<?php if($desc): ?>
              <div class="col-start-6 col-end-12">
                <div class="page__desc fs-2xl section__copy__content">
                  <?php echo $desc; ?>
                </div>
              </div>
				<?php endif; ?>
              <div class="col-start-1 col-end-13">
                <a class="home-project-section project-img h-full" href="<?php echo $design_post_url; ?>">
                  <div
                    class="image-container mb-4 lg:h-[82vh] overflow-hidden sm:h-auto"
                   
                  >
	<img src='<?php echo $design_image; ?>' alt='design mulroy project' class="object-cover"/>
</div>
                  <span class="project-caption font-bold text-[14px]">
                    <?php echo $design_name; ?></span
                  >
                  <h2 class="project-sect-title">
                    <span class="fs-2xl">
                      <?php echo $design_title; ?>
                      <span class="inline-flex items-center">
                        <img
                          src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                          class="site__arrow"
                          alt=""
                        />
                      </span>
                    </span>
                  </h2>
                </a>
              </div>
            </div>
          </section>