<?php // Opening PHP tag - nothing should be before this, not even whitespace

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Default pages template
 *
 * see https://developer.wordpress.org/reference/functions/get_header/
 * see https://developer.wordpress.org/reference/functions/_e/
 * see https://developer.wordpress.org/reference/functions/get_sidebar/
 * see https://developer.wordpress.org/reference/functions/get_footer/
 */

get_header(); ?>

<main id="main" role="main" aria-label="<?php _e( 'Main page content', 'theme_parent' ); ?>">
    <?php
    /**
     * Start the Loop
     *
     * see https://codex.wordpress.org/The_Loop
     * see https://developer.wordpress.org/themes/basics/the-loop/
     * see https://developer.wordpress.org/reference/functions/have_posts/
     * see https://developer.wordpress.org/reference/functions/the_post/
     * see https://developer.wordpress.org/reference/functions/get_post_type/
     * see https://developer.wordpress.org/reference/functions/the_ID/
     * see https://developer.wordpress.org/reference/functions/post_class/
     * see https://developer.wordpress.org/reference/functions/the_permalink/
     * see https://developer.wordpress.org/reference/functions/the_title_attribute/
     * see https://developer.wordpress.org/reference/functions/esc_attr_x/
     * see https://developer.wordpress.org/reference/functions/the_title/
     * see https://developer.wordpress.org/reference/functions/the_content/
     * see https://developer.wordpress.org/reference/functions/wp_link_pages/
     * see https://developer.wordpress.org/reference/functions/esc_html_e/
     * see https://developer.wordpress.org/reference/functions/get_sidebar/
     * see https://developer.wordpress.org/reference/functions/get_footer/
     */

    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section id="<?php echo get_post_type(); ?>-<?php the_ID() ?>" <?php post_class( 'entry' ) ?>>
            <h1 class="entry__title">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute( array(
                    'before' => esc_attr_x( 'Permanent link to ', 'Before post title on permalink title attribute', 'theme_parent' ),
                    'after'  => esc_attr_x( '', 'After post title on permalink title attribute', 'theme_parent' ),
                )); ?>"><?php the_title(); ?></a>
            </h1>
            <div class="entry__content">
                <?php the_content(); ?>
                <?php wp_link_pages(); ?>
            </div>
        </section>
        <?php
        /**
         * Start navigation between posts in singular templates
         *
         * see https://developer.wordpress.org/reference/functions/is_singular/
         * see https://developer.wordpress.org/reference/functions/is_page/
         * see https://developer.wordpress.org/reference/functions/esc_html__/
         *
         * see https://digwp.com/2016/10/wordpress-post-navigation-redux/
         * see https://developer.wordpress.org/reference/functions/the_post_navigation/
         * alternatively see https://developer.wordpress.org/reference/functions/the_posts_navigation/
         */
        ?>
        <?php if ( is_singular() && ! is_page() ) : ?>
            <?php the_post_navigation(
                array(
                    'screen_reader_text' => esc_html__( 'Navigation', 'theme_parent' ),
                )
            ); ?>
        <?php endif; ?>
        <?php
        /**
         * End navigation between posts
         */

        /**
         * Start comments
         *
         * If comments are open or we have at least one comment, load up the comment template.
         *
         * see https://developer.wordpress.org/reference/functions/comments_open/
         * see https://developer.wordpress.org/reference/functions/get_comments_number/
         * see https://developer.wordpress.org/reference/functions/comments_template/
         */
        ?>
        <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
        <?php
        /**
         * End comments
         */
        ?>
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

    <?php
    /**
     * Start navigation between pages in paginated archives pages
     *
     * see https://developer.wordpress.org/reference/functions/is_archive/
     * see https://developer.wordpress.org/reference/functions/is_home/
     * see https://developer.wordpress.org/reference/functions/esc_html__/
     *
     * see https://digwp.com/2016/10/wordpress-post-navigation-redux/
     * see https://developer.wordpress.org/reference/functions/the_posts_pagination/
     * alternatively see https://developer.wordpress.org/reference/functions/the_posts_navigation/
     */
    ?>
    <?php if ( is_archive() || is_home() ) : ?>
        <?php the_posts_pagination(
            array(
                'screen_reader_text' => esc_html__( 'Navigation', 'theme_parent' ),
            )
        ); ?>
    <?php endif; ?>

</main><!-- #main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
