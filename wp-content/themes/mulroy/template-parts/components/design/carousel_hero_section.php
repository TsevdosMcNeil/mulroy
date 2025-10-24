        <!-- hero section -->
          <section class="scroll-section site-container h-[100vh] design__header">
			  <div class="design__cursor">
				  
			  </div>
            <div class="carousel-container">
<!--               <div class="hero-overlay" style="z-index: 2"></div> -->
              <div class="carousel-wrapper">
                <?php if( have_rows('slides') ):  
                 while( have_rows('slides') ) : the_row();
                 $image = get_sub_field('image');
                 $heading = get_sub_field('heading');
				  $design_type = get_sub_field("design_type");
				 
                 ?>
                <div class="slide">
                  <img
                    src="<?php echo $image; ?>"
                    loading="eager"
                    alt="Slide 1"
					   class='slider__item_img'
                  />
                  <div class="slide-content site-container">
					 <a href="<?php echo $heading->guid; ?>" class='slider-title-link'> 
						
<h2 class='slide-title'>
	<span class='project-caption font-bold text-[14px]' style="letter-spacing:3.6px;">
	<?php echo $design_type; ?>
	</span>
	<div class="new_class">
		

<span class='fs-2xl'>
	<?php echo $heading->post_title; ?>
	</span>

<span class="inline-flex items-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow_white.svg" class="site__arrow" alt="">
                      </span>
			</div>
</h2>
</a>
                  </div>
                </div>
                <?php 
                 endwhile;
                 endif;
                 ?>
                
              </div>
              <button class="nav-button prev">
                <img
                  src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow_white.svg"
                  alt=""
                  class="arrow__right site__arrow"
                />
              </button>
              <button class="nav-button next">
                <img
                  src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow_white.svg"
                  alt=""
                  class="site__arrow"
                />
              </button>
            </div>
            <div class="hero-content design-hero-content">
              <div class="content-sect">
                <div class="page-title title-start text-bg">
                  <svg
                    width="203"
                    height="240"
                    viewBox="0 0 203 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M85.256 240H0.248004V0.0959627H85.256C155.48 0.0959627 202.184 48.144 202.184 120.048C202.184 191.952 155.48 240 85.256 240ZM85.256 215.808C141.704 215.808 172.28 177.84 172.28 120.048C172.28 60.576 140.024 24.288 85.256 24.288H28.808V215.808H85.256Z"
                      fill="#fff"
                    />
                  </svg>
                  <span class="hero-letter"> D </span>
                </div>
                <div class="page-title title-start text-bg">
                  <svg
                    width="30"
                    height="240"
                    viewBox="0 0 30 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M29.144 240H0.248004V0.0959627H29.144V240Z"
                      fill="#fff"
                    />
                  </svg>
                  <span class="hero-letter"> I </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-center text-bg">
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
                      fill="#fff"
                    />
                  </svg>
                  <span class="hero-letter"> E </span>
                </div>
                <div class="page-title title-center text-bg">
                  <svg
                    width="210"
                    height="249"
                    viewBox="0 0 210 249"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M110.336 248.032C45.152 248.032 0.800002 197.968 0.800002 123.712C0.800002 49.792 46.16 0.0639742 111.68 0.0639742C164.768 0.0639742 196.688 28.96 205.424 73.984H176.528C170.144 43.744 147.968 24.592 111.68 24.592C60.272 24.592 30.368 63.904 30.368 123.712C30.368 183.856 59.6 223.504 110.672 223.504C150.992 223.504 180.896 198.64 180.896 159.664V147.232H124.112V124.384H209.12V244H186.272L183.584 204.016C174.512 229.552 142.592 248.032 110.336 248.032Z"
                      fill="#fff"
                    />
                  </svg>
                  <span class="hero-letter"> G </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-end text-bg">
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
                      fill="#fff"
                    />
                  </svg>
                  <span class="hero-letter"> S </span>
                </div>
                <div class="page-title title-end text-bg">
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
                      fill="#fff"
                    />
                  </svg>
                  <span class="hero-letter"> N </span>
                </div>
              </div>
            </div>
          </section>