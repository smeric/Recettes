<?php /* force UTF-8 : éàè */
/**
 * @package WordPress
 * @subpackage marmiton
 *
 * Template Name: Page d'accueil sans sidebar
 *
 * @see https://developer.wordpress.org/reference/functions/get_header/
 * @see https://developer.wordpress.org/reference/functions/_e/
 * @see https://developer.wordpress.org/reference/functions/get_footer/
 **/

get_header();

?><main id="main" role="main" aria-label="<?php _e( 'Main page content', 'marmiton' ); ?>">
    <?php
    /**
     * Start the Loop
     *
     * see https://codex.wordpress.org/The_Loop
     * see https://developer.wordpress.org/themes/basics/the-loop/
     *
     * see https://developer.wordpress.org/reference/functions/have_posts/
     * see https://developer.wordpress.org/reference/functions/the_post/
     * see https://developer.wordpress.org/reference/functions/get_post_type/
     * see https://developer.wordpress.org/reference/functions/the_ID/
     * see https://developer.wordpress.org/reference/functions/post_class/
     * see https://developer.wordpress.org/reference/functions/the_content/
     * see https://developer.wordpress.org/reference/functions/wp_link_pages/
     * see https://developer.wordpress.org/reference/functions/get_footer/
     */

    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section id="<?php echo get_post_type(); ?>-<?php the_ID() ?>" <?php post_class( 'entry' ) ?>>
            <div class="entry__content">
                <?php the_content(); ?>
                <?php wp_link_pages(); ?>
            </div>
        </section>
    <?php
    /**
     * End the Loop
     */

    endwhile; endif; ?>
</main><!-- #main-content -->

<?php get_footer(); ?>

