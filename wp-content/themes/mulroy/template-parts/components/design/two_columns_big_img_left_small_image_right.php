<?php
$left_side_design_name = get_sub_field( 'left_side_design_name' );
$left_side_design_title = get_sub_field( 'left_side_design_title' );
$left_side_design_image = get_sub_field( 'left_side_design_image' );
$left_side_design_post_url = get_sub_field( 'left_side_design_post_url' );
$right_side_design_name = get_sub_field( 'right_side_design_name' );
$right_side_design_title = get_sub_field( 'right_side_design_title' );
$right_side_design_image = get_sub_field( 'right_side_design_image' );
$right_side_design_post_url = get_sub_field( 'right_side_design_post_url' );
?> 
<!-- big img left small image right -->
          <section class="scroll-section site-container bg-site container-py no_min_height_mobile design__page__section__padding">
            <div class="flex flex-col h-full lg:grid grid-cols-12 inside__design">
              <div class="col-start-1 col-end-6 self-center">
                <a class="home-project-section project-img" href="<?php echo $left_side_design_post_url; ?>">
                  <div
                    class="image-container mb-4"
                   
                  >
	<img src='<?php echo $left_side_design_image; ?>' alt='mulroy design'/>
</div>
                  <span class="project-caption font-bold text-[14px]">
                    <?php echo $left_side_design_name; ?></span
                  >
                  <h2 class="project-sect-title">
                    <span class="fs-2xl">
                      <?php echo $left_side_design_title; ?>
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
              <div class="col-start-4 col-end-13 self-center">
                <div class="flex items-center h-full">
                  <a class="home-project-section project-img" href="<?php echo $right_side_design_post_url; ?>" >
                    <div
                      class="image-container mb-4"
                     
                    >
	<img src='<?php echo $right_side_design_image; ?>' alt='mulroy design'/>
</div>
                    <span class="project-caption font-bold text-[14px]">
                      <?php echo $right_side_design_name; ?></span
                    >
                    <h2 class="project-sect-title">
                      <span class="fs-2xl">
                        <?php echo $right_side_design_title; ?>
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
            </div>
          </section>