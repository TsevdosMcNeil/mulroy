<?php
    $paged = isset($_POST['page']) ? $_POST['page'] : 1;
    
    $args = array(
    'post_type' => 'post',            
    'posts_per_page' => 3,           
    'category_name' => 'news',       
    'orderby' => 'date',              
    'order' => 'DESC', 
	'paged'          => $paged
);

$news_query = new WP_Query($args);

if ($news_query->have_posts()) :
    while ($news_query->have_posts()) : $news_query->the_post();
     $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');   
?>

              <section class="scroll-section col-span-12 no_min_height_mobile" >
                <a
                 
                  class="flex flex-col h-full justify-around gap-y-5 lg:grid grid-cols-12 news-post__item gap-x-5"
                >
                  <div class="col-span-5">
                    <div class="news-content">
                      <h2 class="news-heading fs-2xl">
                        <?php echo get_the_title(); ?>
<!--                         <span
                          ><img
                            src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                            class="site__arrow news-heading-icon"
                            alt=""
                        /></span> -->
                      </h2>
                      <h3 class="news-date"><?php echo get_the_date('F j, Y'); ?></h3>
						<div class='mt-4 w-full lg:w-[28vw]'>
							
						  <?php echo the_content(); ?>
							
						</div>
						
                    </div>
                  </div>
                  <div
                    class="col-start-6 col-end-13"
                    id="atrium-post-right-text-image"
                  >
                    <div
                      class="w-full relative bg-no-repeat bg-center bg-cover min-h-[40vh] lg:min-h-[40vw]"
                      style="
                        background-image: url(' <?php echo $featured_image_url; ?>');
                      "
                    >
                      <div
                        class="news-page-post-overlay absolute inset-0 bg-black/20"
                      ></div>
                    </div>
                  </div>
                </a>
              </section>
   <?php
    endwhile;
    endif;
   ?>