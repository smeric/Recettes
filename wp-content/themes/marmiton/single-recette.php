<?php // Opening PHP tag - nothing should be before this, not even whitespace

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Default pages template
 *
 * @see https://developer.wordpress.org/reference/functions/get_header/
 * @see https://developer.wordpress.org/reference/functions/_e/
 * @see https://developer.wordpress.org/reference/functions/get_sidebar/
 * @see https://developer.wordpress.org/reference/functions/get_footer/
 */

get_header(); ?>

<main id="main" role="main" aria-label="<?php _e( 'Main page content', 'theme_parent' ); ?>">
    <?php
    /**
     * Start the Loop
     *
     * @see https://codex.wordpress.org/The_Loop
     * @see https://developer.wordpress.org/themes/basics/the-loop/
     *
     * @see https://developer.wordpress.org/reference/functions/have_posts/
     * @see https://developer.wordpress.org/reference/functions/the_post/
     * @see https://developer.wordpress.org/reference/functions/get_post_type/
     * @see https://developer.wordpress.org/reference/functions/the_ID/
     * @see https://developer.wordpress.org/reference/functions/post_class/
     * @see https://developer.wordpress.org/reference/functions/has_post_thumbnail/
     * @see https://developer.wordpress.org/reference/functions/the_post_thumbnail/
     * @see https://developer.wordpress.org/reference/functions/_e/
     * @see https://developer.wordpress.org/reference/functions/the_permalink/
     * @see https://developer.wordpress.org/reference/functions/get_term_by/
     * @see https://developer.wordpress.org/reference/functions/the_title_attribute/
     * @see https://developer.wordpress.org/reference/functions/esc_url/
     * @see https://developer.wordpress.org/reference/functions/sanitize_text_field/
     * @see https://developer.wordpress.org/reference/functions/esc_attr_x/
     * @see https://developer.wordpress.org/reference/functions/the_title/
     * @see https://developer.wordpress.org/reference/functions/wp_kses/
     * @see https://developer.wordpress.org/reference/functions/the_content/
     * @see https://developer.wordpress.org/reference/functions/esc_html_e/
     * @see https://developer.wordpress.org/reference/functions/get_footer/
     *
     * @see https://www.advancedcustomfields.com/resources/get_field/
     */

    if ( have_posts() && function_exists( 'get_field' ) ) : while ( have_posts() ) : the_post();
        // Custom fields
        $ingredients = get_field( 'liste_des_ingredients' );
        $cuisson = get_field( 'temps_de_cuisson' );
        $etapes = get_field( 'etapes' );
        ?><section id="<?php echo get_post_type(); ?>-<?php the_ID() ?>" <?php post_class( 'entry' ) ?>>
            <header class="entry__header"><?php
                // check if the post or page has a Featured Image assigned to it.
                if ( has_post_thumbnail() ) {
                    ?><figure class="entry__image"><?php
                            the_post_thumbnail( 'full' );
                    ?></figure><?php
                }
                ?><h1 class="entry__title"><?php
                    the_title();
                    if ( $cuisson )
                        ?><span class="recette__temps-de-cuisson">&#x1F551; <?php echo $cuisson; ?></span>
                </h1>
            </header>
            <div class="entry__content">
                <h2 class="entry__subtitle"><?php _e( 'Ingrédients', 'marmiton' ); ?></h2><?php
                // Liste des ingrédients
                ?><ul class="liste-ingredients"><?php
                    foreach( $ingredients as $ingredient ){
                        ?><li class="liste-ingredients__ingredient">
                            <figure><?php
                                $term = get_term_by( 'term_taxonomy_id', $ingredient['ingredient'] );
                                $image = get_field('image', $term);
                                if ( ! empty( $image ) ){
                                    ?><img src="<?php echo 
    esc_url( $image['sizes']['thumbnail'] ); ?>" alt="<?php echo 
    esc_attr( $image['alt'] ); ?>" width="<?php echo (int) $image['sizes']['thumbnail-width']; ?>" height="<?php echo (int) $image['sizes']['thumbnail-height']; ?>" class="liste-ingredients__image" /><?php
                                }
                                ?><figcaption class="liste-ingredients__description"><?php
                                    if ( $name = sanitize_text_field( $term->name ) )
                                        echo $name;
                                    if ( $q = sanitize_text_field( $ingredient['quantite'] ) )
                                        echo ' : ' . $q;
                                ?></figcaption><?php
                            ?></figure>
                        </li><?php
                    }
                ?></ul>
                <h2 class="entry__subtitle"><?php _e( 'Steps', 'marmiton' ); ?></h2><?php
                // Liste des étapes
                ?><ol class="liste-etapes"><?php
                    foreach( $etapes as $etape ){
                        ?><li class="liste-etapes__etape">
                            <?php echo wp_kses( $etape['une_etape'], array(
                                'br' => array(),
                                'em' => array(),
                                'strong' => array(),
                                'p' => array(),
                            ) ); ?>
                        </li><?php
                    }
                ?></ol><?php
            ?></div>
        </section>
    <?php endwhile; else : ?>
        <?php
        /**
         * 404 : content not found
         */
        ?>
        <section id="<?php echo get_post_type(); ?>-<?php the_ID() ?>" <?php post_class( 'entry' ) ?>>
            <h1 class="entry__title"><?php esc_html_e( 'Nothing found', 'theme_parent' ); ?></h1>
            <div class="entry__content">
                <?php esc_html_e( 'Sorry but the page you are looking for can not be found.', 'theme_parent' ); ?>
            </div>
        </section>
    <?php
    /**
     * End the Loop
     */
    endif; ?>
</main><!-- #main-content -->

<?php get_footer(); ?>
