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

<?php if (have_rows('legal_page_components')): ?>
        <?php
        $count = 1;
        while (have_rows('legal_page_components')): the_row(); ?>
            <?php if (get_row_layout() == 'hero_section'): ?>
				<?php 
					$page_title = get_sub_field("page_name");
					$description_text = get_sub_field("description_text");
				?>
            <section class="legal__section border-bottom-legal" style="background:#f7ede5;">
            <div class="page-sect-content">
              <div class="legal__text">
                <h1><?php echo $page_title; ?></h1>
              </div>
              <div class="legal__text__info">
                <p>
                  <?php echo $description_text; ?>
                </p>
              </div>
            </div>
          </section>
          
			<?php elseif (get_row_layout() == 'company_information'): ?>
				<?php
					$company_information_title = get_sub_field("company_information_title");
					$info_text_block = get_sub_field("info_text_block");
				?>
		 <section class="company__info__section border-bottom-legal" style="background:#f7ede5;">
            <div class="page-sect-content gap-[1.1rem]">
              <div class="company__info__heading">
                <h1><?php echo $company_information_title; ?></h1>
              </div>
				<div class="company__block__container">
					
				<?php if ($info_text_block): ?>
            		<?php foreach ($info_text_block as $index => $block):
               		$description = $block['description_info'];
                ?>
				<div class="company__info__text__1">
                <p>
                  <?php echo $description; ?>
                </p>
              </div>
				<?php endforeach; ?>
          		<?php endif; ?>
				</div>
            </div>
          </section>

			<?php elseif (get_row_layout() == 'credits_section'): ?>
				<?php
					$credit_section_text = get_sub_field("credit_section_text");
					$website_column = get_sub_field("website_column");
					$mullroy_team = get_sub_field("mullroy_team");
					$photographers = get_sub_field("photographers");
				?>

			<section class="credits__section border-bottom-legal" style="background:#f7ede5;">
            <div class="page-sect-content gap-[1.1rem]">
              <div class="credit__text">
                <h1><?php echo $credit_section_text; ?></h1>
              </div>
              <div class="website__holder">
				  
				  <p>MULROY TEAM</p>
				  <?php if ($mullroy_team): ?>
            		<?php foreach ($mullroy_team as $index => $team_column):
               		$row_text = $team_column['row_text'];
                ?>
                <p><?php echo $row_text; ?></p>
				 <?php endforeach; ?>
          		<?php endif; ?>
				  
                
              </div>
              <div class="mullroy__team">
                <p>PHOTOGRAPHERS</p>
				  <?php if ($photographers): ?>
            	<?php foreach ($photographers as $index => $photo_column):
               		$row_text = $photo_column['row_text'];
                ?>
                <p><?php echo $row_text; ?></p>
				 <?php endforeach; ?>
          		<?php endif; ?>
              </div>
              <div class="photographers">
				  
				  <p>WEBSITE</p>
				<?php if ($website_column): ?>
            		<?php foreach ($website_column as $index => $web_column):
               		$row_text = $web_column['row_text'];
                ?>
                <p><?php echo $row_text; ?></p>
				 <?php endforeach; ?>
          		<?php endif; ?>
				  
                
              </div>
            </div>
          </section>

			<?php elseif (get_row_layout() == 'privacy_policy_section'): ?>
				<?php
					$privacy_policy_text = get_sub_field("privacy_policy_text");
					$information_block = get_sub_field("information_block");
				?>

		<section class="privacy__policy__section border-bottom-legal" style="background:#f7ede5;">
            <div class="page-sect-content gap-[1.1rem]">
              <div class="privacy__policy__text">
                <h1><?php echo $privacy_policy_text ?></h1>
              </div>
              <div class="info__section__privacy__policy">
				  <?php if ($information_block): ?>
            		<?php foreach ($information_block as $index => $info_block):
               		$heading = $info_block['heading'];
				    $description = $info_block['description'];
                ?>
				   <div class="info__box">
                  <p><?php echo $heading; ?></p>
                  <p>
                    <?php echo $description; ?>
                  </p>
                </div>
				 <?php endforeach; ?>
          		<?php endif; ?>
              </div>
            </div>
          </section>

			<?php elseif (get_row_layout() == 'environment_and_social_policy'): ?>
				<?php
					$social_policy_text = get_sub_field("social_policy_text");
					$information_block = get_sub_field("information_block");
				?>


		 <section
            class="environment__social__policy__section border-bottom-legal"
				  style="background:#f7ede5;"
          >
            <div class="page-sect-content gap-[1.1rem]">
              <div class="environment__social__policy__text">
                <h1><?php echo $social_policy_text; ?></h1>
              </div>
              <div class="info__section__privacy__policy">
				  <?php if ($information_block): ?>
            		<?php foreach ($information_block as $index => $info_block):
               		$heading = $info_block['heading'];
				    $description = $info_block['description'];
                ?>
				   <div class="info__box">
                  <p><?php echo $heading; ?></p>
                  <p>
                    <?php echo $description; ?>
                  </p>
                </div>
				 <?php endforeach; ?>
          		<?php endif; ?>
              </div>
            </div>
          </section>

			<?php elseif (get_row_layout() == 'faq_section'): ?>
				<?php
					$faq_text = get_sub_field("faq_text");
					$faq_card = get_sub_field("faq_card");
				?>

		<section class="faq__section" style="background:#f7ede5;">
            <div class="page-sect-content gap-[1.1rem]">
              <div class="faq__text">
                <h1><?php echo $faq_text; ?></h1>
              </div>
              <div class="faq_accordion__container">
				  <?php if ($faq_card): ?>
            		<?php foreach ($faq_card as $index => $card):
               		$faq_question = $card['faq_question'];
				    $faq_answer = $card['faq_answer'];
                ?>
                <div class="faq__card">
                  <label for="<?php echo $index; ?>" class="faq__question">
                    <div class="arrow_icon"></div>
                    <p>
                      <?php echo $faq_question; ?>
                    </p>
                  </label>
                  <input id="<?php echo $index; ?>" type="checkbox" class="checkbox" />
                  <div class="faq__answer">
                    <p>
                      <?php echo $faq_answer; ?>
                    </p>
                  </div>
                </div>

				 <?php endforeach; ?>
          		<?php endif; ?>
              </div>
            </div>
          </section>


            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
          <div class="page-bar md:py-[1vw] hover-dark-blue bg-site">
            <a href="/design-archive" class="page-bar-link">
              <span class="content letter__spacing__custom__-3-25px"> Archive </span>
              <span class="arrow-content"
                ><img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" class="w-5 md:w-10"
              /></span>
            </a>
          </div>	
         
<?php get_footer(); ?>