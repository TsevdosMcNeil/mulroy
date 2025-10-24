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
          <section
            class="scroll-section site-container bg-site container-py no_min_height_mobile design__page__section__padding"
            id="big-img-right-small-img-left"
			style="min-height:auto;"
          >
            <div class="flex flex-col lg:grid grid-cols-12 gap-y-10 h-full inside__design gap-x-5">
              <div class="small-img col-start-2 col-end-7">
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
              <div class="col-start-7 col-end-13">
                <a
                  class="home-project-section project-img h-full block"
                  href="<?php echo $right_side_design_post_url; ?>"
                >
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
          </section>