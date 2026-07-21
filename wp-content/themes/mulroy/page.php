<?php 
/*
Template Name: Default Page
*/
get_header(); 
global $post;

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
			
if ( get_row_layout() == 'privacy_policy_section_global' ) {
					include get_theme_file_path( 'template-parts/privacy-policy-section.php' );
			}
	   endwhile;
	endif; 
?>
<?php get_footer(); ?>