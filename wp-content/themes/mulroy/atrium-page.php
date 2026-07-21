<?php 
/*
Template Name: Atrium Page
*/
get_header(); 
global $post;

?>
<?php
    $post_id = get_the_ID(); 
    $post = get_post($post_id);
  	
?>
           <section class="scroll-section site-container hero-section-height">
			   <div class="custom-cursor" id="custom-cursor" style="filter: brightness(0);">
				  
			  </div>
            <div class="hero-background bg-accent"></div>
            <div class="hero-content">
              <div class="content-sect">
                <div class="page-title title-start text-black">
                  <svg
                    width="228"
                    height="241"
                    viewBox="0 0 228 241"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M227.848 240.5H197.608L171.064 173.636H56.152L29.608 240.5H0.712001L97.816 0.595963H130.408L227.848 240.5ZM161.656 149.78L114.28 29.492H113.272L65.56 149.78H161.656Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> A </span>
                </div>
                <div class="page-title title-start text-black">
                  <svg
                    width="30"
                    height="241"
                    viewBox="0 0 30 241"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M29.144 240.5H0.248004V0.595963H29.144V240.5Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> I </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-center text-black">
                  <svg
                    width="209"
                    height="240"
                    viewBox="0 0 209 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M118.712 240H89.816V24.288H0.440002V0.0959627H208.424V24.288H118.712V240Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> T </span>
                </div>
                <div class="page-title title-center text-black">
                  <svg
                    width="195"
                    height="245"
                    viewBox="0 0 195 245"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M97.656 244.032C35.832 244.032 0.552003 207.072 0.552003 141.552V0.0959627H29.448V143.904C29.448 193.296 54.312 219.504 97.656 219.504C140.328 219.504 165.864 195.312 165.864 143.904V0.0959627H194.76V142.224C194.76 208.08 159.816 244.032 97.656 244.032Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> U </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-end text-black">
                  <svg
                    width="188"
                    height="240"
                    viewBox="0 0 188 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M187.4 240H154.808L92.648 142.896H28.808V240H0.248004V0.0959627H92.648C147.08 0.0959627 176.984 25.632 176.984 71.328C176.984 106.944 153.464 131.136 121.544 138.528L187.4 240ZM90.968 118.704C126.248 118.704 147.752 103.248 147.752 71.328C147.752 40.752 126.584 24.288 90.968 24.288H28.808V118.704H90.968Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> R </span>
                </div>
                <div class="page-title title-end text-black">
                  <svg
                    width="237"
                    height="240"
                    viewBox="0 0 237 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M236.456 240H208.568V29.664H207.896L129.944 240H106.424L28.472 29.664H27.8V240H0.248004V0.0959627H44.936L118.856 202.368H119.528L193.448 0.0959627H236.456V240Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> M </span>
                </div>
              </div>
            </div>
          </section>
          <section class="scroll-section site-container bg-site container-py no_min_height_mobile pt-0">
            <div class="flex flex-col justify-center lg:justify-start h-full">
              <div class="flex flex-col md:grid grid-cols-12 md:pl-[2vw]">
                <div
                  class="news-sect-description fs-2xl col-start-6 col-end-13 section__copy__content max-w-[90%] letter__spacing__custom__-2px"
                >
                  <?php echo get_field("right_side_content_text"); ?>
                </div>
                <div class="hover-image-section col-span-2">
                  <div
                    class="w-[30vw] h-[20vw] news-post-image"
                    style="
                      background-image: url('<?php echo get_template_directory_uri(); ?>/assets/media/atrium-post-hero.png');
                    "
                  ></div>
                </div>
                <div class="col-start-6 col-end-13">
                  <div class="col-start-3 col-end-7">
                    <ul class="flex flex-col">
	<?php 
	$selected_atrium_posts = get_field( 'selected_atrium_posts' );

	$args = array(
		'post_type'      => 'atriums',   
		'posts_per_page' => -1,           
		'post_status'    => 'publish', 
		'post__in'       => $selected_atrium_posts,
		'meta_key'       => 'atrium_order',      // ACF field name
		'orderby'        => 'meta_value_num',    // Order by number
		'order'          => 'ASC'
	);

	$atriums_query = new WP_Query($args);

	if ($atriums_query->have_posts()) : 
		$i = 1;
		while ($atriums_query->have_posts()) : $atriums_query->the_post();
			$featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
			$published_date = get_the_date('d-m-Y');
	?>
			<li class="news-post__items">
				<a
					href="<?php echo get_permalink(); ?>"
					class="home-news-post-item"
					data-image="<?php echo $featured_image_url; ?>"
				>
					<span class="atrium-date letter__spacing__custom__-2px"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></span>
					<span class="news-post-title letter__spacing__custom__-2px">
						<?php echo get_the_title(); ?>
						<span>
							<img
								src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
								alt=""
								class="site__arrow home-news-post-arrow"
							/>
						</span>
					</span>
				</a>
			</li>
	<?php 
			$i++;
		endwhile;
	endif;
	?>
</ul>

                  </div>
                </div>
              </div>
            </div>
          </section>


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