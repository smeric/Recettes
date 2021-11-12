<?php // Opening PHP tag - nothing should be before this, not even whitespace

/**
 * Templates header
 *
 * see https://developer.wordpress.org/reference/functions/language_attributes/
 * see https://developer.wordpress.org/reference/functions/bloginfo/
 * see https://developer.wordpress.org/reference/functions/wp_head/
 * see https://developer.wordpress.org/reference/functions/body_class/
 * see https://developer.wordpress.org/reference/functions/wp_body_open/
 * see https://developer.wordpress.org/reference/functions/has_custom_logo/
 * see https://developer.wordpress.org/reference/functions/the_custom_logo/
 * see https://developer.wordpress.org/reference/functions/get_bloginfo/
 * see https://developer.wordpress.org/reference/functions/is_front_page/
 * see https://developer.wordpress.org/reference/functions/is_paged/
 * see https://developer.wordpress.org/reference/functions/is_home/
 * see https://developer.wordpress.org/reference/functions/esc_url/
 * see https://developer.wordpress.org/reference/functions/home_url/
 * see https://developer.wordpress.org/reference/functions/is_active_sidebar/
 * see https://developer.wordpress.org/reference/functions/dynamic_sidebar/
 * see https://developer.wordpress.org/reference/functions/current_user_can/
 * see https://developer.wordpress.org/reference/functions/admin_url/
 * see https://developer.wordpress.org/reference/functions/_e/
 * see https://developer.wordpress.org/reference/functions/wp_nav_menu/
 * see https://developer.wordpress.org/reference/functions/apply_filters/
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <header id="header" class="widget-area" role="contentinfo">
            <div class="site-branding"><?php
                // Custom logo
                if ( has_custom_logo() ) {
                    ?><div class="site-logo"><?php the_custom_logo(); ?></div><?php
                }
                // Site name
                if ( get_bloginfo( 'name' ) ) {
                    if ( is_front_page() && ! is_paged() ) {
                        ?><h1 class="site-title"><?php theme_parent_customize_partial_blogname(); ?></h1><?php
                    }
                    elseif ( is_front_page() && ! is_home() ) {
                        ?><h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title-link"><?php theme_parent_customize_partial_blogname(); ?></a></h1><?php
                    }
                    else {
                        ?><p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title-link"><?php theme_parent_customize_partial_blogname(); ?></a></p><?php
                    }
                }
                // Site description
                if ( get_bloginfo( 'description' ) ) {
                    ?><p class="site-description"><?php theme_parent_customize_partial_blogdescription(); ?></p><?php
                }
            ?></div><?php
            if ( is_active_sidebar( 'header' ) ):
                dynamic_sidebar( 'header' );
            else:
                if ( current_user_can( 'edit_theme_options' ) ):
                    ?><div class="private-message">
                        <a href="<?php echo admin_url( 'widgets.php' ); ?>"><?php _e( 'Add some widgets to the header.', 'theme_parent' ); ?></a>
                    </div><?php
                endif;
            endif;

            wp_nav_menu( apply_filters( 'theme_parent_header_menu', array(
                'theme_location'  => 'header',
                'container'       => 'nav',
                'container_id'    => 'header-menu-wrapper',
                'container_class' => 'site-navigation',
                'menu_id'         => 'header-menu',
                'menu_class'      => 'menu',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                // Un seul niveau de sous menus dans l'entête...
                'depth'           => 2,
                'fallback_cb'     => false,
            )));
        ?></header><!-- #header -->
