<?php
/**
 * Renders the "Dynamic Blocks" (components) flexible content field.
 *
 * Optional $args['post_id']: where to read the field from. Defaults to the
 * current post. Pass a WP_Term (or 'term_123') to render a term's blocks,
 * e.g. on the design_category landing pages.
 *
 * Optional $args['exclude_layouts']: layout names to skip, e.g. the news
 * page (single.php) prints its own hero and skips 'hero_section'.
 */
$post_id         = $args['post_id'] ?? false;
$exclude_layouts = $args['exclude_layouts'] ?? [];

if (!have_rows('components', $post_id)) {
    return;
}

while (have_rows('components', $post_id)) {
    the_row();

    $layout = get_row_layout();

    if (!$layout || in_array($layout, $exclude_layouts, true)) {
        continue;
    }

    $template = 'template-parts/components/' . $layout . '.php';

    if (locate_template($template)) {
        get_template_part(
            'template-parts/components/' . $layout
        );
    }
}
