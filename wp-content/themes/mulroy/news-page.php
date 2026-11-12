<?php 
/*
Template Name: News Page
*/
get_header(); 
global $post;
// href="<?php echo get_permalink(); 
?>
<?php
    $post_id = get_the_ID(); 
    $post = get_post($post_id);
?>
           <!-- hero section -->
          <section class="scroll-section site-container hero-section-height">
			  <div class="custom-cursor new_header_curosr" id="custom-cursor">
				  
			  </div>
            <div class="hero-background bg-orange"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
              <div class="content-sect">
                <div class="page-title title-start text-black">
                  <svg
                    width="193"
                    height="240"
                    viewBox="0 0 193 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M192.44 240H165.56L29.144 35.376H28.472V240H0.248004V0.0959627H35.864L163.88 191.616H164.552V0.0959627H192.44V240Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> N </span>
                </div>
                <div class="page-title title-start text-black">
<!--                   <svg
                    width="311"
                    height="240"
                    viewBox="0 0 311 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M242.656 240H209.728L155.632 38.4H154.96L100.528 240H67.936L0.400001 0.0959627H30.976L86.08 204.048H86.752L140.848 0.0959627H171.424L225.856 204.048H226.528L281.296 0.0959627H310.192L242.656 240Z"
                      fill="black"
                    />
                  </svg> -->
					
<svg width="310" height="240"  class="menu-icon menu__icno__news__w" viewBox="0 0 310 240" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M242.258 239.904H209.33L155.234 38.304H154.562L100.13 239.904H67.5376L0.00156339 1.54037e-05H30.5776L85.6816 203.952H86.3536L140.45 1.54037e-05H171.026L225.458 203.952H226.13L280.898 1.54037e-05H309.794L242.258 239.904Z" fill="black"/>
</svg>

                  <span class="hero-letter text-black lg:color-auto menu__icno__news__w__letter"> W </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-end text-black">
                  <svg
                    width="163"
                    height="240"
                    viewBox="0 0 163 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M162.536 240H0.248004V0.0959627H162.2V24.288H28.808V107.952H147.416V132.48H28.808V215.808H162.536V240Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> E </span>
                </div>
                <div class="page-title title-end text-black">
                  <svg
                    width="187"
                    height="249"
                    viewBox="0 0 187 249"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M99.912 248.032C43.8 248.032 4.152 222.832 0.792002 173.104H28.68C32.04 208.048 58.584 224.848 99.576 224.848C133.848 224.848 159.048 208.384 159.048 179.488C159.048 158.32 146.616 146.224 115.368 140.176L69.672 131.104C29.016 123.712 8.52 103.888 8.52 68.944C8.52 28.96 43.128 0.0639742 92.184 0.0639742C142.92 0.0639742 177.528 21.904 182.232 65.584H154.344C150.312 38.704 126.456 23.248 92.52 23.248C58.248 23.248 36.744 42.064 36.744 67.936C36.744 90.448 48.504 99.856 79.416 105.904L126.456 115.648C167.448 124.048 186.936 143.2 186.936 178.144C186.936 219.472 150.648 248.032 99.912 248.032Z"
                      fill="black"
                    />
                  </svg>
                  <span class="hero-letter text-black lg:color-auto"> S </span>
                </div>
              </div>
            </div>
          </section>
          <!-- News list -->
          <section
            class="scroll-container site-container bg-site no_min_height_mobile"
          >
            <div class="flex h-full flex-col lg:grid grid-cols-12 gap-y-[5rem] lg:gap-y-[3vw]" id="all-the-news-list">
              <section
                class=" lg:grid grid-cols-12 col-span-12 self-center"
                style="grid-template-rows: min-content 1fr"
              >
                <div class="col-start-6 col-end-13 self-start">
                  <div class="atrium-post-desc-text fs-2xl section__copy__content letter__spacing__custom__-2px">
                    	<?php 
//                     	$content = $post->post_content;
//                     	$content = preg_replace('/<p>\s*<\/p>/', '', $content); 
//                         $content = preg_replace('/<p>(.*?)<\/p>/is', '$1', $content); 
                        echo get_field("right_side_content_text");
                    	?>
                  </div>
                </div>
              </section>
<?php
$show_selected_news = get_field( 'show_selected_news' );
$args = array(
    'post_type' => 'post',            
    'posts_per_page' => -1,           
    'category_name' => 'news',       
    'orderby' => 'date',              
    'order' => 'DESC', 
    'post__in'       => $show_selected_news
);
$news_query = new WP_Query($args);

if ($news_query->have_posts()) :
    while ($news_query->have_posts()) : $news_query->the_post();
     $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');   
?>

              <?php get_template_part('template-parts/news/list-item'); ?>
   <?php
    endwhile;
    endif;
   ?>
            </div>
          </section>
          <!-- news-link -->
          <div class="site-container pb-[40px] bg-site">
            <div class="flex w-full items-start">
              <button id="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>" class="cross-anchorr">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/media/plus_icon.svg" alt="" class='plus_icon_news' />
              </button>
            </div>
            
          </div>


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