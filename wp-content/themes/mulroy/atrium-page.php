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
			   <div class="custom-cursor" id="custom-cursor">
				  
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
                  <span class="hero-letter"> A </span>
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
                  <span class="hero-letter"> I </span>
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
                  <span class="hero-letter"> T </span>
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
                  <span class="hero-letter"> U </span>
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
                  <span class="hero-letter"> R </span>
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
                  <span class="hero-letter"> M </span>
                </div>
              </div>
            </div>
          </section>
          <section class="scroll-section site-container bg-site container-py no_min_height_mobile pt-0">
            <div class="flex flex-col justify-center lg:justify-start h-full">
              <div class="flex flex-col md:grid grid-cols-12 md:pl-[2vw]">
                <div
                  class="news-sect-description fs-2xl col-start-6 col-end-13 section__copy__content max-w-[90%]"
                >
                  <?php the_content(); ?>
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
						'post__in'       => $selected_atrium_posts
					);
                    $atriums_query = new WP_Query($args);
					if ($atriums_query->have_posts()) : 
					    $i=1;
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
                          <span class="atrium-date"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT)  ?> </span>
                          <span class="news-post-title"
                            ><?php echo get_the_title(); ?>
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
<?php get_footer(); ?>