<?php
/**
 * Landing Featured Projects
 *
 * Staggered grid of project cards (repeats every 4):
 *   1. landscape, right half
 *   2. landscape, left        3. portrait, right (same row)
 *   4. large feature card, subtitle + arrow always visible
 * (Cards 1-3 reveal the subtitle on hover, like the rest of the site.)
 *
 * Source:
 *   - "auto":   latest projects in the current Design Category
 *               (or the categories chosen in "Categories" when used elsewhere)
 *   - "manual": hand-picked projects, each with an optional image override
 */
$source          = get_sub_field('source') ?: 'auto';
$number          = (int) (get_sub_field('number_of_projects') ?: 4);
$categories      = get_sub_field('categories');
$manual_projects = get_sub_field('projects');

$cards = [];

if ($source === 'manual') {
  foreach ((array) $manual_projects as $row) {
    $project = $row['project'] ?? null;
    $post_id = is_object($project) ? $project->ID : (int) $project;

    if ($post_id && get_post_status($post_id) === 'publish') {
      $cards[] = [
        'post_id' => $post_id,
        'image'   => $row['image'] ?? null,
      ];
    }
  }
} else {
  $term_ids = [];

  if ($categories) {
    foreach ((array) $categories as $category) {
      $term_ids[] = is_object($category) ? $category->term_id : (int) $category;
    }
  } elseif (is_tax('design_category')) {
    $term_ids[] = get_queried_object_id();
  }

  if ($term_ids) {
    $project_ids = get_posts([
      'post_type'      => 'designs',
      'post_status'    => 'publish',
      'posts_per_page' => $number,
      'fields'         => 'ids',
      'no_found_rows'  => true,
      'tax_query'      => [
        [
          'taxonomy' => 'design_category',
          'field'    => 'term_id',
          'terms'    => $term_ids,
        ],
      ],
    ]);

    foreach ($project_ids as $post_id) {
      $cards[] = [
        'post_id' => $post_id,
        'image'   => null,
      ];
    }
  }
}

if (!$cards) {
  return;
}

// Position in the 4-card pattern => grid + image ratio classes.
$pattern = [
  1 => [
    'class'           => 'lg:col-start-6 lg:col-end-11',
    'image_container' => 'aspect-[7/5] overflow-hidden',
  ],
  2 => [
    'class'           => 'lg:col-start-1 lg:col-end-6',
    'image_container' => 'aspect-[4/3] overflow-hidden',
  ],
  3 => [
    'class'           => 'lg:col-start-9 lg:col-end-12',
    'image_container' => 'aspect-[3/4] overflow-hidden',
  ],
  4 => [
    // Feature card: subtitle always visible (others reveal it on hover).
    'class'           => 'lg:col-start-2 lg:col-end-8 landing-featured-projects__feature',
    'image_container' => 'aspect-[13/12] overflow-hidden',
  ],
];
?>
<!-- template-parts/components/landing_featured_projects.php -->
<section class="landing-featured-projects scroll-section site-container bg-site no_min_height_mobile pt-8 lg:pt-[4.17vw]">
  <div class="flex flex-col lg:grid grid-cols-12 gap-y-12 lg:gap-y-[6.8vw] lg:gap-x-[1.04vw]">
    <?php foreach ($cards as $index => $card) :
      $pos   = ($index % 4) + 1;
      $style = $pattern[$pos];
      $image = $card['image'];

      // Fall back to the featured image, passed as an ID array so the
      // card applies its image classes (object-cover etc.).
      if (!$image && has_post_thumbnail($card['post_id'])) {
        $image = ['ID' => get_post_thumbnail_id($card['post_id'])];
      }
    ?>
      <div class="<?php echo esc_attr($style['class']); ?>">
        <?php
        get_template_part(
          'template-parts/components/design/project-card',
          null,
          [
            'post_id'         => $card['post_id'],
            'image'           => $image,
            'class'           => 'flex flex-col',
            'image_class'     => 'w-full h-full',
            'image_container' => $style['image_container'],
          ]
        );
        ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<!-- End template-parts/components/landing_featured_projects.php -->
