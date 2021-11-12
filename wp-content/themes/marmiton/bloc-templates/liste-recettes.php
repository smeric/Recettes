<?php

/**
 * Block Template pour liste de recettes.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'bloc-recettes-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'is-flex-container wp-block-post-template bloc-recettes';
if ( ! empty( $block['className'] ) ) {
    $className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $className .= ' align' . $block['align'];
}
$columns = get_field('columns') ? get_field('columns') : 3;
$className .= ' columns-' . $columns;

$posts_per_page = get_field('posts_per_page');

$args = array(
    'post_type'      => 'recette',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_page,
);
$custom_query = new WP_Query( $args );

//print_r($custom_query);
//die();

?><ul id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>"><?php
    if( $custom_query->have_posts() ):
        while( $custom_query->have_posts() ):
            $custom_query->the_post();
            ?><li><?php
                if ( has_post_thumbnail() ) {
                    ?><figure class="alignwide wp-block-post-featured-image"><?php
                        if ( $is_preview ) {
                            the_post_thumbnail( 'full' );
                        }
                        else {
                            ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a><?php
                        }
                    ?></figure><?php
                }
                ?><h2 class="wp-block-post-title"><?php
                    if ( $is_preview ) {
                        the_title();
                    }
                    else {
                        ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php
                    }
                ?></h2>
                <div class="wp-block-post-excerpt">
                    <?php the_excerpt(); ?>
                    <p class="wp-block-post-excerpt__more-text"><?php
                        if ( $is_preview ) {
                            _e( 'Read more...', 'marmiton' );
                        }
                        else {
                            ?><a class="wp-block-post-excerpt__more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read more...', 'marmiton' ); ?></a><?php
                        }
                    ?></p>
                </div>
            </li><?php
        endwhile;
    endif;
?></ul>