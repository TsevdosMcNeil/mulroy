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
			  <div class="custom-cursor" id="custom-cursor">
				  
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
                  <span class="hero-letter"> N </span>
                </div>
                <div class="page-title title-start text-black">
                  <svg
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
                  </svg>
                  <span class="hero-letter"> W </span>
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
                  <span class="hero-letter"> E </span>
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
                  <span class="hero-letter"> S </span>
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
                  <div class="atrium-post-desc-text fs-2xl section__copy__content">
                    	<?php 
                    	$content = $post->post_content;
                    	$content = preg_replace('/<p>\s*<\/p>/', '', $content); 
                        $content = preg_replace('/<p>(.*?)<\/p>/is', '$1', $content); 
                        echo $content;
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
					 <div class='mt-6 w-full lg:w-[28vw]' >
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
                        class="news-page-post-overlay absolute inset-0"
                      ></div>
                    </div>
                  </div>
                </a>
              </section>
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
         
<?php get_footer(); ?>