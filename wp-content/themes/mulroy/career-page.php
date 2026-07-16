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
                <p>
					<?php echo $description_info; ?>
                </p>
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

          


<?php get_footer(); ?>