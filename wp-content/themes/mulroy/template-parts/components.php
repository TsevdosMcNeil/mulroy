<?php

if (!have_rows('components')) {
    return;
}

while (have_rows('components')) {
    the_row();

    $layout = get_row_layout();

    if (!$layout) {
        continue;
    }

    $template = 'template-parts/components/' . $layout . '.php';

    if (locate_template($template)) {
        get_template_part(
            'template-parts/components/' . $layout
        );
    }
}