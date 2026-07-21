<?php
$top_heading = get_sub_field( 'top_heading' );
$top_heading_link = get_sub_field( 'top_heading_link' );
$bottom_heading = get_sub_field( 'bottom_heading' );
$desc = get_sub_field( 'desc' );
$bottom_link = get_sub_field( 'bottom_link' );
$choose_designs = get_sub_field( 'choose_designs' );
?>
<?php 

					 $args = array(
						'post_type'      => 'designs',   
						'posts_per_page' => 3,           
						'post_status'    => 'publish', 
						'orderby' => 'ID',              
                        'order' => 'DESC',
                        'post__in'       => $choose_designs
					);
                    $atriums_query = new WP_Query($args);
                    $data = $atriums_query->get_posts();
                    if($data[0]->ID){
    					$featured_image_url_0 = get_the_post_thumbnail_url($data[0]->ID, 'full');
    					$design_type_0 = get_field( 'design_type',$data[0]->ID );
    					$title_0 =$data[0]->post_title;
    					$permalink_0 = get_permalink($data[0]->ID);
                    }
                    
                    

					?>
<!-- ACF:- home_page_design_section -->
          <section class="bg-site scroll-section no_min_height_mobile" id="design-section">
            <div class="page-bar md:py-[1vw] hover-dark-blue">
              <a href="<?php echo $top_heading_link; ?>" class="page-bar-link">
                <span class="content letter__spacing__custom__-3-25px"><?php echo $top_heading; ?> </span>
                <span class="arrow-content"
                  ><img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" class="w-5 md:w-10"
                /></span>
              </a>
            </div>
            <div class="page-sect-content">
              <div
                class="page-sect-info flex flex-col lg:grid col-span-12 my-10 md:my-[2vw] gap-y-5"
              >
                <div class="page-heading col-span-5"></div>
                <div class="page-sect-desc col-span-7 letter__spacing__custom__-2px">
                 <?php echo $desc; ?>
                </div>
              </div>
              <div class="col-span-12 lg:col-start-6 lg:col-end-[-1]">
                <a
                  class="design-project-item flex flex-col gap-y-1 w-full h-full"
                  href="<?php echo $permalink_0; ?>"
                >
                  <div
                    class="image-container mb-2">
					<img src="<?php echo $featured_image_url_0; ?>" alt='mulroy-design-project'/>
</div>
                  <span class="project-caption font-bold text-[14px] uppercase">
                    <?php echo $design_type_0; ?></span
                  >
                  <h2
                    class="project-sect-title fs-2xl"
                  >
                    <?php echo $title_0; ?>
                    <span class="inline-flex">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" class="site__arrow" alt="" />
                    </span>
                  </h2>
                </a>
              </div>
            </div>
          </section>
          
                    <!-- All Project Section -->
          <section
            id="all-project"
            class="bg-site border-bottom pb-0 no_min_height_mobile"
          >
            <div class="section-container-grid-two-row lg:pb-10 lg:gap-[1.5rem]">
                <?php 
                if($data[1]->ID){
                        $ids = $data[1]->ID;
    					$featured_image_url_1 = get_the_post_thumbnail_url($ids, 'full');
    					$design_type_1 = get_field( 'design_type',$ids );
    					$title_1 =$data[1]->post_title;
    					$permalink_1 = get_permalink($ids);
                ?>
              <div class="col-span-12 lg:col-start-2 lg:col-end-7 lg:pt-0">
                <a
                  class="home-project-section flex flex-col gap-y-2 col-span-6 lg:col-start-4 lg:col-end-7 h-full"
                  href="<?php echo $permalink_1; ?>"
                >
                  <div
                    class="image-container mb-1"
                 
                  >
					  <img src='<?php echo $featured_image_url_1; ?>' alt='mulroy-design-project' />

</div>
                  <span class="project-caption font-bold text-[14px] uppercase">
                     <?php echo $design_type_1; ?></span
                  >
                  <h2 class="project-sect-title fs-2xl">
                    <?php echo $title_1; ?>
                    <span class="inline-flex">
                      <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                        alt=""
                        class="site__arrow"
                      />
                    </span>
                  </h2>
                </a>
              </div>
              <?php } ?>
              <?php 
                if($data[2]->ID){
                        $ids = $data[2]->ID;
    					$featured_image_url_2 = get_the_post_thumbnail_url($ids, 'full');
    					$design_type_2 = get_field( 'design_type',$ids );
    					$title_2 =$data[2]->post_title;
    					$permalink_2 = get_permalink($ids);
                ?>
              <div class="col-span-6 lg:col-start-7 lg:col-end-[-1] h-full">
                <a
                  class="home-project-section flex flex-col gap-y-2 col-span-6 lg:col-start-5 lg:col-end-7 h-full "
                  href="<?php echo $permalink_2; ?>"
                >
                  <div
                    class="image-container mb-1"
                   
                  >
					<img src='<?php echo $featured_image_url_2;?>' alt='mulroy-desing-project'/>
					</div>
                  <span class="project-caption font-bold text-[14px] uppercase">
                    <?php echo $design_type_2; ?></span
                  >
                  <h2 class="project-sect-title">
                    <span class="fs-2xl">
                      <?php echo $title_2; ?>
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
               <?php } ?>
            </div>
            <div class="page-bar md:py-[1vw] hover-dark-blue">
              <a href="<?php echo $bottom_link; ?>" class="page-bar-link">
                <span class="content letter__spacing__custom__-3-25px"> <?php echo $bottom_heading; ?> </span>
                <span class="arrow-content"
                  ><img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" class="w-5 md:w-10"
                /></span>
              </a>
            </div>
          </section>