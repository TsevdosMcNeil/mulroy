<?php 
/*
Template Name: Design Page
*/
get_header(); 
global $post;

?>
<?php
    $post_id = get_the_ID(); 
    $post = get_post($post_id);
  	
?>
<?php
if ( have_rows( 'design_blocks' ) ) :
		while ( have_rows( 'design_blocks' ) ) : the_row();
			
			if ( get_row_layout() == 'hero_section' ) {
					include get_theme_file_path( 'template-parts/components/design/hero_section.php' );
			}
			if ( get_row_layout() == 'video_hero_section' ) {
					include get_theme_file_path( 'template-parts/components/design/video_hero_section.php' );
			}
			if ( get_row_layout() == 'carousel_hero_section' ) {
					include get_theme_file_path( 'template-parts/components/design/carousel_hero_section.php' );
			}
			
			if ( get_row_layout() == 'top_selected_right_side_design_project' ) {
					include get_theme_file_path( 'template-parts/components/design/top_selected_right_side_design_project.php' );
			}
			if ( get_row_layout() == 'two_columns_big_image_right_small_image_left' ) {
					include get_theme_file_path( 'template-parts/components/design/two_columns_big_image_right_small_image_left.php' );
			}
		    if ( get_row_layout() == 'two_columns_landscape_img_left_portrait_right' ) {
					include get_theme_file_path( 'template-parts/components/design/two_columns_landscape_img_left_portrait_right.php' );
			}
			if ( get_row_layout() == 'two_columns_big_img_left_small_image_right' ) {
					include get_theme_file_path( 'template-parts/components/design/two_columns_big_img_left_small_image_right.php' );
			}
			if ( get_row_layout() == 'two_columns_big_img_left_landscap_img_right' ) {
					include get_theme_file_path( 'template-parts/components/design/two_columns_big_img_left_landscap_img_right.php' );
			}
		
			
	   endwhile;
	endif; 
?>

          <div class="page-bar md:py-[1vw] hover-dark-blue bg-site">
            <a href="/design-archive" class="page-bar-link">
              <span class="content"> Archive </span>
              <span class="arrow-content"
                ><img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" class="w-5 md:w-10"
              /></span>
            </a>
          </div>	
         
<?php get_footer(); ?>