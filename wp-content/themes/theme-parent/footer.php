<?php // Opening PHP tag - nothing should be before this, not even whitespace

/**
 * Templates footer
 *
 * see https://developer.wordpress.org/reference/functions/is_active_sidebar/
 * see https://developer.wordpress.org/reference/functions/dynamic_sidebar/
 * see https://developer.wordpress.org/reference/functions/current_user_can/
 * see https://developer.wordpress.org/reference/functions/admin_url/
 * see https://developer.wordpress.org/reference/functions/_e/
 * see https://developer.wordpress.org/reference/functions/wp_nav_menu/
 * see https://developer.wordpress.org/reference/functions/apply_filters/
 * see https://developer.wordpress.org/reference/functions/wp_footer/
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

?>

        <footer id="footer" class="widget-area" role="contentinfo">
            <?php
            if ( is_active_sidebar( 'footer' ) ):
                dynamic_sidebar( 'footer' );
            else:
                if ( current_user_can( 'edit_theme_options' ) ):
                    ?>
                    <div class="private-message">
                        <a href="<?php echo admin_url( 'widgets.php' ); ?>"><?php _e( 'Add some widgets to the footer.', 'theme_parent' ); ?></a>
                    </div>
                    <?php
                endif;
            endif;

            wp_nav_menu( apply_filters( 'theme_parent_footer_menu', array(
                'theme_location'  => 'footer',
                'container'       => 'nav',
                'container_id'    => 'footer-menu-wrapper',
                'container_class' => 'site-navigation',
                'menu_id'         => 'footer-menu',
                'menu_class'      => 'menu',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                // Pas de sous menus dans le pied de page...
                'depth'           => 1,
                'fallback_cb'     => false,
            )));
            ?>
        </footer><!-- #footer -->

        <?php wp_footer(); ?>
    </body>
</html>
