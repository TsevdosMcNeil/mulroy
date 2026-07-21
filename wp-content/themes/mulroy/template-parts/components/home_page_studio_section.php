<?php
$heading = get_sub_field( 'heading' );
$heading_link = get_sub_field( 'heading_link' );
$left_side_sub_heading = get_sub_field( 'left_side_sub_heading' );
$desc = get_sub_field( 'desc' );
$image = get_sub_field( 'image' );
?>
<!-- ACF:- home_page_studio_section -->
          <section
            class="scroll-section bg-site border-bottom no_min_height_mobile"
            id="studio-section"
          >
            <div class="page-bar xl:py-[1vw] hover-blue">
              <a href="<?php echo $heading_link; ?>" class="page-bar-link">
                <span class="content letter__spacing__custom__-3-25px"> <?php echo $heading; ?> </span>
                <span class="arrow-content"
                  ><img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" class="w-5 md:w-10"
                /></span>
              </a>
            </div>
            <div class="page-sect-content">
              <div
                class="section__copy__content flex flex-col lg:grid grid-cols-12 col-span-12 gap-y-5"
              >
                <div class="page-sect-desc col-span-5 letter__spacing__custom__-2px"><?php echo $left_side_sub_heading; ?></div>
                <div class="page-sect-desc col-span-7 letter__spacing__custom__-2px">
                  <?php echo $desc; ?>
                </div>
              </div>
              <div
                class="col-span-12 lg:col-start-6 lg:col-end-13 h-full"
              >
                <div class="image-container-wrapper">
                  <div
                    class="image-container bg-contain-mb">
					<img src='<?php echo $image; ?>' alt='mulroy-studio'/>
					</div>
                </div>
              </div>
            </div>
          </section>