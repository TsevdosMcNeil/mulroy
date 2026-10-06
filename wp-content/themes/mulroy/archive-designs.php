<?php
/*
Template Name: Archive Design Page
*/
get_header();
?>
<!-- archive-designs.php -->
<?php
get_template_part('template-parts/components');

//Not sure if this is still needed
$relative_path = '2025/07/Russet-House_06_LR.jpg';

$attachment_id = attachment_url_to_postid(
  wp_upload_dir()['baseurl'] . '/' . $relative_path
);

?>
<section class="py-4 lg:py-[2vw] bg-site design__archive__section" id="design-top">
  <div class="flex flex-col lg:grid grid-cols-12 gap-[7vw]">
    <?php
    if ($attachment_id) {
      get_template_part(
        'template-parts/components/column-image',
        null,
        [
          'image'           => $attachment_id,
          'container_class' => 'design__archive__hover__image__container',
        ]
      );
    }
    ?>

    <div class="col-span-12 site-container">
      <h2 class="fs-3xl">ARCHIVE</h2>
    </div>
    <div class="col-start-6 col-end-13 px-[2rem] lg:pr-10">
      <div class="archive-desc fs-2xl">
        <?php echo get_field("right_only_content_text"); ?>
      </div>
    </div>
    <div class="col-start-6 col-end-13 px-[2rem] lg:pr-10 table__desgin__archive">
      <table class="w-full archive-table" id="designTable">
        <thead>
          <tr class="head-row">
            <th class="text-start w-1/2 cursor-pointer" data-type="text">
              <div class="inner__th secondary-titles">
                NAME
                <svg class="table__archive__arrow" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10" />
                </svg>
              </div>
            </th>
            <th class="text-start cursor-pointer" class="table__archive__arrow" data-type="number">
              <div class="inner__th secondary-titles">
                YEAR
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10" />
                </svg>
              </div>
            </th>
            <th class="text-start cursor-pointer topology__column" class="table__archive__arrow" data-type="text">
              <div class="inner__th secondary-titles">
                TYPOLOGY
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10" />
                </svg>
              </div>
            </th>
            <th class="text-start cursor-pointer location__column" class="table__archive__arrow " data-type="text">
              <div class="inner__th secondary-titles">
                LOCATION
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10" />
                </svg>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $project_list = get_field("design_list");
          ?>
          <?php if ($project_list):
            foreach ($project_list as $list):
              $project_name = $list['project_name'];
              $year = $list['year'];
              $hover_image = $list['hover_image'];
              $url = $list['url'];
              $typology = $list['typology'];
              $location = $list['location'];
          ?>
              <tr class="data-row" data-image="<?php echo $hover_image; ?>">
                <td><a href="<?php echo get_permalink($url); ?>" class="secondary-titles"><?php echo esc_html($project_name); ?>
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10" />
                    </svg>
                  </a></td>
                <td class="secondary-titles"><?php echo esc_html($year); ?></td>
                <td class="typorolog__td secondary-titles"><?php echo esc_html($typology); ?></td>
                <td class="locatoin__td secondary-titles"><?php echo esc_html($location); ?></td>
              </tr>
          <?php endforeach;
          endif; ?>
          <?php
          $args = array(
            'post_type'      => 'designs',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'ID',
            'order'          => 'DESC',
          );
          $atriums_query = new WP_Query($args);
          if ($atriums_query->have_posts()) :
            while ($atriums_query->have_posts()) : $atriums_query->the_post();
              $published_date = get_the_date('Y');
              $project_name = get_field("design_type");
          ?>
              <!--       <tr class="data-row" data-image="<?php echo get_the_post_thumbnail_url(); ?>">
        <td><a href="<?php echo get_permalink(); ?>"><?php echo esc_html($project_name); ?>
			<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10"/>
			</svg>
			</a></td>
        <td><?php echo esc_html($published_date); ?></td>
      </tr> -->
          <?php
            endwhile;
          endif;
          wp_reset_postdata();
          ?>
        </tbody>
      </table>

    </div>
<?php
get_template_part(
  'template-parts/post-navigation',
  null,
  [
    'id'         => 'atrium-post-navigation',
    'class'      => 'col-span-12 site-container',
    'back_url'   => '/design',
    'top_anchor' => "#studio-top"
  ]
);
?>
  </div>
</section>
<?php get_template_part('template-parts/legal-components'); ?>
<!-- End archive-designs.php -->
<?php get_footer(); ?>