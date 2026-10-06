<?php

if (!have_rows('legal_page_components')) {
    return;
}

while (have_rows('legal_page_components')) {
    the_row();

    $layout = get_row_layout();

    if (!$layout) {
        continue;
    }

    $template = 'template-parts/legal/' . $layout . '.php';

    if (locate_template($template)) {
        get_template_part(
            'template-parts/legal/' . $layout
        );
    }
}