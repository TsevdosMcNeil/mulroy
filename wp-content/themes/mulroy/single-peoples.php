<?php 
get_header(); 
global $post;

?>
<?php
    $post_id = get_the_ID(); 
    $post = get_post($post_id);
  	$position = get_field( 'position' );
	$hover_picture = get_field( 'hover_picture' );
	$picture = get_field( 'picture' );
?>
<?php
if ( have_rows( 'components' ) ) :
		while ( have_rows( 'components' ) ) : the_row();
			
			if ( get_row_layout() == 'hero_section' ) {
					include get_theme_file_path( 'template-parts/components/hero_section.php' );
			}
			if ( get_row_layout() == 'right_only_content_block' ) {
					include get_theme_file_path( 'template-parts/components/right_only_content_block.php' );
			}
			if ( get_row_layout() == 'two_column_left_image_right_text' ) {
					include get_theme_file_path( 'template-parts/components/two_column_left_image_right_text.php' );
			}
			if ( get_row_layout() == 'two_column_left_text_right_image' ) {
					include get_theme_file_path( 'template-parts/components/two_column_left_text_right_image.php' );
			}
			if ( get_row_layout() == 'centered_banner_image_with_caption' ) {
					include get_theme_file_path( 'template-parts/components/centered_banner_image_with_caption.php' );
			}
			if ( get_row_layout() == 'two_column_left_heading_right_image_and_text' ) {
					include get_theme_file_path( 'template-parts/components/two_column_left_heading_right_image_and_text.php' );
			}
			if ( get_row_layout() == 'three_column_left_image_center_text_right_text' ) {
					include get_theme_file_path( 'template-parts/components/three_column_left_image_center_text_right_text.php' );
			}
			if ( get_row_layout() == 'landscape-img-right-text-left' ) {
					include get_theme_file_path( 'template-parts/components/landscape-img-right-text-left.php' );
			}
			if ( get_row_layout() == 'full_width_big_centered_image' ) {
					include get_theme_file_path( 'template-parts/components/full_width_big_centered_image.php' );
			}
			if ( get_row_layout() == 'three_column_right_image_center_text_left_text' ) {
					include get_theme_file_path( 'template-parts/components/three_column_right_image_center_text_left_text.php' );
			}
			if ( get_row_layout() == 'people_section' ) {
					include get_theme_file_path( 'template-parts/components/people_section.php' );
			}
			if ( get_row_layout() == 'carousel_hero_section' ) {
					include get_theme_file_path( 'template-parts/components/carousel_hero_section.php' );
			}
			if ( get_row_layout() == 'home_page_studio_section' ) {
					include get_theme_file_path( 'template-parts/components/home_page_studio_section.php' );
			}
			if ( get_row_layout() == 'home_page_design_section' ) {
					include get_theme_file_path( 'template-parts/components/home_page_design_section.php' );
			}
		    if ( get_row_layout() == 'home_page_news_section' ) {
					include get_theme_file_path( 'template-parts/components/home_page_news_section.php' );
			}
			if ( get_row_layout() == 'home_page_atrium_section' ) {
					include get_theme_file_path( 'template-parts/components/home_page_atrium_section.php' );
			}
			if ( get_row_layout() == 'video_hero_section' ) {
					include get_theme_file_path( 'template-parts/components/video_hero_section.php' );
			}
			if ( get_row_layout() == 'design_page_left_table_right_image_heading' ) {
					include get_theme_file_path( 'template-parts/components/design_page_left_table_right_image_heading.php' );
			}
			if ( get_row_layout() == 'two_column_left_full_image_with_heading_right_text' ) {
					include get_theme_file_path( 'template-parts/components/two_column_left_full_image_with_heading_right_text.php' );
			}
		    if ( get_row_layout() == 'two_column_left_landscape_and_righ_portriat_image' ) {
					include get_theme_file_path( 'template-parts/components/two_column_left_landscape_and_righ_portriat_image.php' );
			}
			if ( get_row_layout() == 'two_coulmn_both_side_image' ) {
					include get_theme_file_path( 'template-parts/components/two_coulmn_both_side_image.php' );
			}
			
	   endwhile;
	endif; 
?>
        <div class="scroll-section py-8 pt-[5rem] lg:h-[100vh] lg:pt-0 lg:py-12 bg-site">
          <a
            href="studio"
            class="absolute person-profile-cross z-20 lg:top-[1vw] lg:right-[1vw] top-[1rem] right-[2rem]"
            ><span>
              <img
                src="<?php echo get_template_directory_uri(); ?>/assets/media/X.svg"
                class="site__arrow w-[2.5rem] lg:w-[1.5rem]"
                alt=""
              /> </span
          ></a>
          <section class="site-container bg-site h-full">
            <div class="section-inner-container ">
              <div class="col-start-1 col-end-5">
                <div
                  class="img-1 w-full h-[30rem] lg:h-full bg-cover image-container" style='background-image:url("<?php echo $picture; ?>")'
                
                >
</div>
              </div>
              <div class="col-start-8 col-end-13">
                <div
                  class="person-profile flex justify-between flex-col h-full"
                >
                  <div class="person-content">
                    <div class="person-bio mb-10">
                      <h2 class="person-name fs-3xl"><?php echo get_the_title(); ?></h2>
                      <h3 class="person-page-position fs-xl">DIRECTOR</h3>
                    </div>
                    <div class="person-desc">
                      <?php the_content(); ?>
                    </div>
                  </div>
                  <div class="persons-nav flex justify-between mt-10 lg:mt-0">
                      <?php $next_post = get_next_post();  $prev_post = get_previous_post(); ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class='gray-hover-icon'>
                      <span
                        ><img
                          src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                          class="site__arrow rotate-180"
                          alt="site-arrow"
                      /></span>
                    </a>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class='gray-hover-icon'>
                      <span
                        ><img
                          src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                          class="site__arrow"
                          alt="site-arrow"
                      /></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
<?php get_footer(); ?>