<?php 
/*
Template Name: Archive Design Page
*/
get_header(); 
global $post;

?>
<?php
    $post_id = get_the_ID(); 
    $post = get_post($post_id);
  	
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
          <section class="py-4 lg:py-[2vw] bg-site design__archive__section" id="design-top">
            <div class="flex flex-col lg:grid grid-cols-12 gap-[7vw]">
				<div class="design__archive__hover__image__container">
					<img src="https://beta.mulroy.tm-studio.co.uk/wp-content/uploads/2025/07/Russet-House_06_LR.jpg" />
				</div>
              <div class="col-span-12 site-container">
                <h2 class="fs-3xl">ARCHIVE</h2>
              </div>
              <div class="col-start-6 col-end-13 px-[2rem] lg:pr-10">
                <div class="archive-desc fs-2xl">
                  <?php echo get_field("right_only_content_text"); ?>
                </div>
              </div>
              <div class="col-start-6 col-end-13 px-[2rem] lg:pr-10 table__desgin__archive">
                <table class="w-full archive-table" id="designTable">
  <thead>
    <tr class="head-row">
      <th class="text-start w-1/2 cursor-pointer" data-type="text">
		  <div class="inner__th">
			  
		  
		  NAME 
		  <svg class="table__archive__arrow" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10"/>
			</svg>
			  </div>
		</th>
      <th class="text-start cursor-pointer" class="table__archive__arrow" data-type="number">
		  <div class="inner__th">
		  YEAR 
		  <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10"/>
			</svg>
			  </div>
	</th>
		<th class="text-start cursor-pointer topology__column" class="table__archive__arrow" data-type="text">
		  <div class="inner__th">
		  TYPOLOGY 
		  <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10"/>
			</svg>
			  </div>
	</th>
			<th class="text-start cursor-pointer location__column" class="table__archive__arrow " data-type="text">
		  <div class="inner__th">
		  LOCATION 
		  <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10"/>
			</svg>
			  </div>
	</th>
    </tr>
  </thead>
  <tbody>
	  <?php
	  $project_list = get_field("design_list");
	  ?>
	  
	  
	  <?php if($project_list):
	  		foreach($project_list as $list):
	  			$project_name = $list['project_name'];
	  			$year = $list['year'];
	  			$hover_image = $list['hover_image'];
	  			$url = $list['url'];
	  $typology = $list['typology'];
	  $location = $list['location'];
	  ?>
	  
	  <tr class="data-row" data-image="<?php echo $hover_image;?>">
        <td><a href="<?php echo get_permalink($url); ?>"><?php echo esc_html($project_name); ?>
			<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10"/>
			</svg>
			</a></td>
        <td><?php echo esc_html($year); ?></td>
		  <td class="typorolog__td"><?php echo esc_html($typology); ?></td>
		  <td class="locatoin__td"><?php echo esc_html($location); ?></td>
      </tr>
	  
	  <?php endforeach; endif; ?>
    <?php 
    $args = array(
      'post_type'      => 'designs',   
      'posts_per_page' => -1,           
      'post_status'    => 'publish', 
      'orderby'        => 'ID',              
      'order'          => 'DESC',  
    );
    $atriums_query = new WP_Query($args);
    if ($atriums_query->have_posts()) : 
      while ($atriums_query->have_posts()) : $atriums_query->the_post();
        $published_date = get_the_date('Y');
        $project_name = get_field("design_type");
	  ?>
<!--       <tr class="data-row" data-image="<?php echo get_the_post_thumbnail_url();?>">
        <td><a href="<?php echo get_permalink(); ?>"><?php echo esc_html($project_name); ?>
			<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10"/>
			</svg>
			</a></td>
        <td><?php echo esc_html($published_date); ?></td>
      </tr> -->
    <?php 
      endwhile;
    endif;
    wp_reset_postdata();
    ?>
  </tbody>
</table>

              </div>
              <div
                class="col-span-12 site-container"
                id="atrium-post-navigation"
              >
                <div class="flex justify-between">
                  <a href="/design">
                    <span>
                      <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                        class="site__arrow post__arrow arrow__right"
                        alt=""
                      />
                    </span>
                  </a>
                  <a href="#design-top">
                    <span>
                      <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                        class="site__arrow post__arrow arrow__up"
                        alt=""
                      />
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </section>
          
<?php get_footer(); ?>