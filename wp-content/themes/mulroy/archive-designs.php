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
    <div class="col-span-12 site-container">
      <h1 class="fs-3xl">PROJECT ARCHIVE</h1>
    </div>
    <div class="col-start-6 col-end-13 px-[2rem] lg:pr-10">
      <div class="archive-desc fs-2xl">
        <?php echo get_field("right_only_content_text"); ?>
      </div>
    </div>
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
    <?php
    // Typology column toggle. Not saved yet (existing pages) = shown; only an explicit "off" hides it.
    $show_typology = !metadata_exists('post', get_the_ID(), 'show_typology_column')
      || (bool) get_field('show_typology_column');
    ?>
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
            <?php if ($show_typology): ?>
            <th class="text-start cursor-pointer topology__column" class="table__archive__arrow" data-type="text">
              <div class="inner__th secondary-titles">
                TYPOLOGY
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10" />
                </svg>
              </div>
            </th>
            <?php endif; ?>
            <th class="text-start cursor-pointer topology__column" class="table__archive__arrow" data-type="text">
              <div class="inner__th secondary-titles">
                SECTOR
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
              $year = $list['year'] ?? '';
              $hover_image = $list['hover_image'] ?? '';
              $typology = $list['typology'] ?? '';
              $location = $list['location'] ?? '';

              // Project Page (meta name "url"): ID, or WP_Post for legacy return format.
              // Only a published Project page counts as linked (no links to drafts/private/deleted pages).
              $project_page = $list['url'] ?? '';
              $project_page_id = $project_page instanceof WP_Post ? $project_page->ID : absint($project_page);
              $is_linked = $project_page_id
                && get_post_type($project_page_id) === 'designs'
                && get_post_status($project_page_id) === 'publish';
              $url = $is_linked ? get_permalink($project_page_id) : '';

              if ($is_linked) {
                // The selected Project page is the single source of truth: its title and its
                // current design_sector terms. Saved manual Name/Sector values are ignored.
                $project_name = get_the_title($project_page_id);
                $sector_terms = get_the_terms($project_page_id, 'design_sector');
                $sector_terms = is_array($sector_terms) ? $sector_terms : [];
              } else {
                // No Project page: manual name (plain text) and manually selected Sector terms.
                $project_name = trim((string) ($list['project_name'] ?? ''));
                $sector_terms = (array) ($list['sector'] ?? []);
              }

              // Sector terms may be term IDs or WP_Term objects (depending on the return format).
              $sector_names = [];
              foreach ($sector_terms as $sector_term) {
                $sector_term = $sector_term instanceof WP_Term ? $sector_term : get_term(absint($sector_term), 'design_sector');
                if ($sector_term instanceof WP_Term) {
                  $sector_names[] = $sector_term->name;
                }
              }
              $sector = implode(', ', $sector_names);
          ?>
              <?php if ($url): ?>
                <tr class="data-row" data-image="<?php echo esc_url($hover_image); ?>">
                  <td>
                    <a href="<?php echo esc_url($url); ?>" class="secondary-titles">
                      <?php echo esc_html($project_name); ?>
                      <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.8715 6.28544L0 6.28544M11.8715 6.28544L6.0268 12.0943M11.8715 6.28544L6.0268 0.476562" stroke="black" stroke-width="1.34354" stroke-miterlimit="10" />
                      </svg>
                    </a>
                  </td>
                  <td class="secondary-titles"><?php echo esc_html($year); ?></td>
                  <?php if ($show_typology): ?>
                    <td class="typorolog__td secondary-titles"><?php echo esc_html($typology); ?></td>
                  <?php endif; ?>
                  <td class="typorolog__td secondary-titles"><?php echo esc_html($sector); ?></td>
                  <td class="locatoin__td secondary-titles"><?php echo esc_html($location); ?></td>
                </tr>
              <?php else: ?>
                <tr class="data-row" data-image="<?php echo esc_url($hover_image); ?>">
                  <td>
                    <div class="secondary-titles">
                      <?php echo esc_html($project_name); ?>
                    </div>
                  </td>
                  <td class="secondary-titles"><?php echo esc_html($year); ?></td>
                  <?php if ($show_typology): ?>
                    <td class="typorolog__td secondary-titles"><?php echo esc_html($typology); ?></td>
                  <?php endif; ?>
                  <td class="typorolog__td secondary-titles"><?php echo esc_html($sector); ?></td>
                  <td class="locatoin__td secondary-titles"><?php echo esc_html($location); ?></td>
                </tr>
              <?php endif; ?>
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
        'top_anchor' => "#design-top"
      ]
    );
    ?>
  </div>
</section>
<?php get_template_part('template-parts/legal-components'); ?>
<!-- End archive-designs.php -->
<?php get_footer(); ?>