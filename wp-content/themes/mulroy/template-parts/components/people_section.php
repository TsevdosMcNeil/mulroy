<?php
// ACF sub field: heading (string)
$heading = get_sub_field( 'heading' );

// ACF sub field: peoples (Relationship or Post Object field that returns array of post objects or IDs)
$people_field = get_sub_field('list_of_peoples');

// Prepare query args depending on whether an ACF people list exists
$args = array(
    'post_type'      => 'peoples',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'ASC',
);

// If ACF 'peoples' field provided, use that order (supports array of IDs or WP_Post objects)
if ( $people_field && is_array( $people_field ) ) {
    $ids = array();
    foreach ( $people_field as $p ) {
        if ( is_object( $p ) && isset( $p->ID ) ) {
            $ids[] = $p->ID;
        } elseif ( is_numeric( $p ) ) {
            $ids[] = intval( $p );
        }
    }
    if ( ! empty( $ids ) ) {
        $args = array(
            'post_type'      => 'peoples',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'post__in'       => $ids,
            'orderby'        => 'post__in', // preserve ACF order
        );
    }
}

$atriums_query = new WP_Query( $args );

if ( $atriums_query->have_posts() ) :

    // Print heading if provided
    if ( ! empty( $heading ) ) : ?>
        <header class="people-section-heading mb-8">
            <h2 class="fs-3xl"><?php echo esc_html( $heading ); ?></h2>
        </header>
    <?php endif;

    // column layout pattern (repeats every 4)
    $col_classes = array(
        1 => 'col-span-3 pt-0 lg:pt-8',
        2 => 'col-start-8 col-end-11 pt-0 lg:pt-[7vw] lg:pl-0',
        3 => 'col-start-3 col-end-6 pt-0 lg:pt-[7vw] lg:pl-[0]',
        4 => 'col-start-10 col-end-13 pt-0 lg:pt-[10vw] lg:pt-8',
    );
    ?>

    <section class="scroll-section site-container bg-site container-py no_min_height_mobile consistent__space__single__project__mobile" id="people-most-left-sect">
        <div class="section-inner-container gap-y-[80px] lg:gap-y-auto">

            <?php
            $index = 0;
            while ( $atriums_query->have_posts() ) : $atriums_query->the_post();
                $index++;
                $position = get_field( 'position' );
                $hover_picture = get_field( 'hover_picture' );
                $picture = get_field( 'picture' );

                // repeat layout every 4
                $pos = ( $index % 4 === 0 ) ? 4 : ( $index % 4 );
                $col_class = isset( $col_classes[ $pos ] ) ? $col_classes[ $pos ] : $col_classes[1];
                ?>
                <div class="<?php echo esc_attr( $col_class ); ?>">
                    <a class="person-card relative w-full flex flex-col" href="<?php the_permalink(); ?>">
                        <div class="img-1 w-full inset-0 absolute">
                            <?php if ( $hover_picture ) : ?>
                                <img src="<?php echo esc_url( $hover_picture ); ?>" alt="<?php echo esc_attr( get_the_title() . ' hover' ); ?>">
                            <?php endif; ?>
                        </div>

                        <div class="img-2 w-full mb-4">
                            <?php if ( $picture ) : ?>
                                <img src="<?php echo esc_url( $picture ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                            <?php endif; ?>
                        </div>

                        <h2 class="person-name fs-2xl">
                            <?php the_title(); ?>
                            <span>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/media/Arrow.svg' ); ?>" class="site__arrow person-icon" alt="">
                            </span>
                        </h2>

                        <?php if ( $position ) : ?>
                            <h3 class="person-position uppercase"><?php echo esc_html( $position ); ?></h3>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endwhile; // end loop ?>

        </div> <!-- .section-inner-container -->
    </section>

<?php
endif;

wp_reset_postdata();
?>
