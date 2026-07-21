<?php 
/*
Template Name: Careers Page
*/
get_header(); 
global $post;

?>

		
<?php if (have_rows('careers_page_components')): ?>
        <?php
        $count = 1;
        while (have_rows('careers_page_components')): the_row(); ?>
            <?php if (get_row_layout() == 'career_page_hero'): ?>
				<?php 
					$careers_text = get_sub_field("careers_text");
					$description_info = get_sub_field("description_info");
					$image =  get_sub_field("image");
				?>

 			<section class="careers__hero border-bottom-legal" style="background:#f7ede5;">
            <div class="page-sect-content">
              <div class="careers__text">
                <h1><?php echo $careers_text; ?></h1>
              </div>
              <div class="careers__info__text">
              
					<?php echo $description_info; ?>
              
              </div>
              <div class="careers__info__image">
                <img src="<?php echo $image; ?>" alt="career-home" />
              </div>
            </div>
          </section>

			<?php elseif (get_row_layout() == 'current_project_section'): ?>
				<?php 
						$section_title = get_sub_field("section_title");
						$right_paragraph_text = get_sub_field("right_paragraph_text");
					?>
<section class="whats__like__mulroy__section__career" style="background:#f7ede5;">
					<div class="page-sect-content">
					<div class="job__application__text">
                		<h1><?php echo $section_title; ?></h1>
              		</div>
						<div class="what__like__mulroy__right__text__container">
							<?php echo $right_paragraph_text; ?>
						</div>
					</div>
				</section>
			<?php elseif (get_row_layout() == 'job_applications_section'): ?>
				
				<?php 
					$job_application_text = get_sub_field("job_application_text");
					$description_text = get_sub_field("description_text");
					$job_applications =  get_sub_field("job_applications");
					$small_bottom_text_info =  get_sub_field("small_bottom_text_info");
				?>

          <section class="job__application__section" style="background:#f7ede5;">
            <div class="page-sect-content">
              <div class="job__application__text">
                <h1><?php echo $job_application_text; ?></h1>
              </div>
              <div class="job__application__info">
                <div class="job__application__info__text">
                  <p>
                    <?php echo $description_text; ?>
                  </p>
                </div>
                <div class="job__application__container">
					
				 <?php if ($job_applications): ?>
            		<?php foreach ($job_applications as $index => $jobs):
               			$job_title = $jobs['job_title'];
						$job_description = $jobs['job_description'];
						$job_fields = $jobs['job_fields'];
						$apply_information = $jobs["apply_information"];
						$onoff_job = $jobs["onoff_job"];
                ?>
					<?php if($onoff_job): ?>
					<div class="job__card">
                    <label for="<?php echo $index; ?>" class="heading__title">
                      <div class="arrow_icon"></div>
                      <h2><?php echo $job_title; ?></h2>
                    </label>
                    <input type="checkbox" id="<?php echo $index; ?>" class="checkbox" />
                    <div class="job__card__body">
                      <div class="job__card__box">
                        <div class="info__text">
                          <p>
                            <?php echo $job_description; ?>
                          </p>
                        </div>
						  <div class="columns_container_application">
							  
					<?php if ($job_fields): ?>
            			<?php foreach ($job_fields as $index => $job_col):
               			$column_title = $job_col['column_title'];
						$row_text = $job_col['column_row'];
                	?>
                        <div class="job__requirements">
                          <p><?php echo $column_title ?></p>
                          <ul>
					<?php if ($row_text): ?>
            			<?php foreach ($row_text as $index => $row_text_li):
							  $text = $row_text_li['row_text'];
							  ?>
                            <li>
                              <p>
								  <?php echo $text; ?>
                              </p>
                            </li>
							 <?php endforeach; ?>
          				<?php endif; ?>
                          </ul>
                        </div>
						<?php endforeach; ?>
          				<?php endif; ?>
                        <div class="job__apply">
                          <p>HOW TO APPLY</p>
							<?php echo $apply_information; ?>
                        </div>
                      </div>
						   </div>
                    </div>
                  </div>
					<?php endif; ?>
						  					
					<?php endforeach; ?>
          		<?php endif; ?>
                </div>
                <div class="info__text__bottom">
                  <p>
                    <?php echo $small_bottom_text_info; ?>
                  </p>
                </div>
              </div>
            </div>
          </section>

            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

          

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

<?php get_footer(); ?>