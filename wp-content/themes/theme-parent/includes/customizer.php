<?php
/**
 * Customizr controls
 *
 * @see https://developer.wordpress.org/themes/customize-api/
 **/
function theme_parent_customizer_settings( $wp_customize ) {
    // Colors section
    $wp_customize->add_section(
        'theme_parent_colors',
        array(
            'title'    => __( 'Colors','plugin-de-test' ),
            'priority' => 30,
        )
    );

    // settings
    $wp_customize->add_setting(
        'background_color',
        array(
            'default'   => '#ffffff',
            'transport' => 'postMessage',
        )
    );

    // controls
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'background_color',
            array(
                'label'    => __( 'Background Color','plugin-de-test' ),
                'section'  => 'theme_parent_colors',
                'settings' => 'background_color',
            )
        )
    );

    // Sidebar section
    $wp_customize->add_section(
        'theme_parent_sidebar',
        array(
            'title'    => __( 'Sidebar','plugin-de-test' ),
            'priority' => 40,
        )
    );

    // settings
    $wp_customize->add_setting(
        'theme_parent_sidebar_display',
        array(
            'default'   => 'show',
            'transport' => 'postMessage',
        )
    );

    // controls
    $wp_customize->add_control(
        'theme_parent_sidebar_display',
        array(
            'label' => 'Button Display',
            'section' => 'theme_parent_sidebar',
            'settings' => 'theme_parent_sidebar_display',
            'type' => 'radio',
            'choices' => array(
                'show' => 'Show sidebar',
                'hide' => 'Hide sidebar',
            ),
        )
    );

    $wp_customize->selective_refresh->add_partial(
        'theme_parent_sidebar_display',
        array(
            'selector' => '.primary-sidebar',
            'render_callback' => 'theme_parent_display_sidebar',
        )
    );

    // make some core functionalities modification instantaneous !
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector' => '.site-title',
        'render_callback' => 'theme_parent_customize_partial_blogname',
    ) );
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'theme_parent_customize_partial_blogdescription',
    ) );
}
// @see https://developer.wordpress.org/reference/hooks/customize_register/
add_action( 'customize_register', 'theme_parent_customizer_settings' );

// @see https://developer.wordpress.org/reference/functions/is_customize_preview/
if ( is_customize_preview() || ! function_exists( 'theme_parent_rewrite_catch_style' )){
    add_action( 'wp_head', 'theme_parent_customizer_css');
}
else {
    add_action( 'theme_parent_external_css', 'theme_parent_customizer_external_css' );
}
// used for the customizer preview and in case plugin de test is not active
// @see https://developer.wordpress.org/reference/functions/get_theme_mod/
function theme_parent_customizer_css(){
    ?>
        <style type="text/css">
            body { background: #<?php echo get_theme_mod('background_color', 'ffffff'); ?>; }
        </style>
    <?php
}
// uses the dynamic style sheet from plugin de test
function theme_parent_customizer_external_css(){
    ?> body {background: #<?php echo get_theme_mod('background_color', 'ffffff'); ?>;}<?php
}

add_action( 'customize_preview_init', 'theme_parent_customizer' );
function theme_parent_customizer() {
    wp_enqueue_script(
        'theme_parent_customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array( 'jquery','customize-preview' ),
        '',
        true
    );
}