<?php
$desc = get_sub_field( 'desc' );
$select_home_page_atrium = get_sub_field( 'select_home_page_atrium' );
?>
<?php 
		$args = array(
			'post_type'      => 'atriums',   
			'posts_per_page' => 1,           
			'post_status'    => 'publish', 
			'orderby' => 'date',
            'order' => 'DESC',
           'post__in'       => array($select_home_page_atrium)
		);
	
        $posts = get_posts($args);
       
     foreach ($posts as $post) {
         
    setup_postdata($post);
     $image_url = get_the_post_thumbnail_url($post->ID, 'full');
     $permalink = get_permalink($post->ID);
		
		?>
<!-- ACF:- design_page_atrium_section -->
          <section class="scroll-section site-container">
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
                  <span class="hero-letter text-black"> A </span>
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
                  <span class="hero-letter text-black">I </span>
                </div>
              </div>
              <div class="home-atrium-post-desc">
               <?php echo $desc; ?>
              </div>
              <div class="home-atrium-post">
                <a
                  href="<?php echo $permalink; ?>"
                  class="flex flex-col lg:flex-row justify-between w-full lg:items-center home-atrium-post-anchor gap-y-5"
                >
                  <span
                    class="home-atrium-post-no inline-flex gap-5 fs-3xl items-center"
                    >01
                    <span class="home-atrium-post-icon">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg" alt="" />
                    </span>
                  </span>
                  <span
                    class="home-atrium-post-img w-[5rem] h-[5rem] lg:w-[10vw] lg:h-[10vw] bg-contain bg-no-repeat relative"
                    style="
                      background: url('<?php echo $image_url; ?>');
                    "
                  >
                    <div
                      class="home-atrium-post-overlay absolute inset-0 bg-black/20"
                    ></div>
                  </span>
                  <span class="fs-3xl atrium-title-home">
                    <?php the_title(); ?>
                  </span>
                </a>
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
                  <span class="hero-letter text-black"> T </span>
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
                  <span class="hero-letter text-black"> U </span>
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
                  <span class="hero-letter text-black"> R </span>
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
                  <span class="hero-letter text-black"> M </span>
                </div>
              </div>
            </div>
          </section>
          <?php 
}
wp_reset_postdata();
 ?>