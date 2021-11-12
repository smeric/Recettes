<?php // Opening PHP tag - nothing should be before this, not even whitespace

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Enqueue parent and child theme stylesheets.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see https://developer.wordpress.org/reference/functions/get_template_directory_uri/
 * @see https://developer.wordpress.org/reference/functions/get_stylesheet_directory_uri/
 * @see https://developer.wordpress.org/reference/functions/wp_get_theme/
 *
 * @return void
 */
function marmiton_enqueue_styles() {
    wp_enqueue_style(
        'theme_parent-style', // This is the parent theme stylesheet id.
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'marmiton-style', // This is the child theme stylesheet id.
        get_stylesheet_directory_uri() . '/style.css',
        array( 'theme_parent-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
// @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
add_action( 'wp_enqueue_scripts', 'marmiton_enqueue_styles' );


/**
 * Setup Child Theme's textdomain.
 *
 * @see https://developer.wordpress.org/reference/functions/load_child_theme_textdomain/
 * @see https://developer.wordpress.org/reference/functions/get_stylesheet_directory/
 * @see https://developer.wordpress.org/reference/functions/add_theme_support/
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 *
 * @return void
 */
function marmiton_theme_setup() {
    load_child_theme_textdomain( 'marmiton', get_stylesheet_directory() . '/languages' );

    add_theme_support( 'post-thumbnails', array( 'post', 'recette' ) );
    // Définit la taille de la vighette nommée 'post-thumbnail' qui est crée par défaut.
    //set_post_thumbnail_size( 100, 100, true );

    // Ajout d'autres tailles si besoin
    //add_image_size( 'type1-thumbnail', 207, 207, true );
    //add_image_size( 'type2-thumbnail', 320, 206, true );
    //add_image_size( 'type3-thumbnail', 154, 99, true );

    add_theme_support( 'customize-selective-refresh-widgets' );
}
// @see https://developer.wordpress.org/reference/hooks/after_setup_theme/
add_action( 'after_setup_theme', 'marmiton_theme_setup' );

/**
 * Add tags to the header
 *
 * @return void
 */
function marmiton_wp_head(){
    /**
     * Adapte automatiquement la largeur de viewport à la valeur de device-width du terminal.
     * Le zoom initial, minimal et maximal est fixé à 1.
     * Le zoom est interdit.
     * @see http://www.alsacreations.com/article/lire/1490-comprendre-le-viewport-dans-le-web-mobile.html
     * @see http://media-queries.aliasdmc.fr/meta_viewport_et_viewport_css_mobile.php
     *
     * La balise <meta> autorise ces valeurs :
     *
     * width
     *  Largeur de fenêtre viewport. La propriété width accepte comme valeur un entier
     *  positif ou le mot clé device-width qui correspond à la largeur de l'appareil disponible.
     * height
     *  Hauteur de fenêtre viewport. La propriété height accepte comme valeur un entier
     *  positif ou le mot clé device-height qui correspond à la hauteur de l'appareil disponible.
     * initial-scale
     *  Niveau de zoom initial (par exemple initial-scale="1.0"). 0.0 < initial-scale <= 10.0
     * minimum-scale
     *  Niveau de zoom minimal (par exemple minimum-scale="0.5"). 0.0 < minimum-scale <= 10.0
     * maximum-scale
     *  Niveau de zoom maximal (par exemple maximum-scale="3.0"). Attention, la valeur "1.0" interdit
     *  le zoom et peut rendre vos pages inaccessibles. 0.0 < maximum-scale <= 10.0
     * user-scalable
     *  Possibilité à l'utilisateur de zoomer (par exemple user-scalable="yes"). Attention, la valeur
     *  "no" interdit le zoom et peut rendre vos pages inaccessibles
     * target-densitydpi
     *  Choix de résolution, en dpi, de l'affichage général (spécifique Webkit et semble avoir été abandonné)
     *  Valeurs possibles :
     *  device-dpi : Indique que la densité de pixels d'origine de l'appareil doit être utilisée.
     *               Mise à l'échelle par défaut ne se produit jamais.
     *  high-dpi : Indique que le contenu est destiné aux écrans à haute densité.
     *  medium-dpi : Indique que le contenu est destiné aux écrans de moyenne densité.
     *  low-dpi : Indique que le contenu est destiné aux écrans à faible densité.
     *  Nombre entier positif : Indique une valeur dpi entre 70 et 400 pour l'utiliser comme cible dpi.
     *
     * @since _basique 0.1.0
     **/
    $meta_values = apply_filters( '_basique_viewport_values', array(
        'width'         => 'device-width',
        'initial-scale' => '1.0',
        'minimum-scale' => '1.0',
        'maximum-scale' => '1.0',
        'user-scalable' => 'no',
        'minimal-ui'    => '', // Réduit l’interface Safari mobile au minimum sous iOS 7.
    ));
    $meta_value = array();
    foreach ( $meta_values as $key => $value ) {
        $meta_value[] = $key . ( '' !== $value ? '=' . $value : '' );
    }
    $meta = PHP_EOL . "\t\t" . '<meta name="viewport" content="' . implode( ', ', $meta_value ) . '">' . PHP_EOL;
    echo apply_filters( '_basique_viewport_meta', $meta );

    /**
     * Force le moteur de rendu de la dernière version disponible d'Internet Explorer
     * ou l'utilisation de Chrome Frame si installé sur le poste client.
     * @see http://www.alsacreations.com/astuce/lire/1437-comment-interdire-le-mode-de-compatibilite-sur-ie.html
     *
     * @since _basique 0.1.0
     **/
    $ie = PHP_EOL . "\t\t" . '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">' . PHP_EOL;
    echo apply_filters( '_basique_ie_x_ua_compatible', $ie );
    
    /**
     * Favicons
     **/
    ?><link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ba0800">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><?php

}
add_action( 'wp_head', 'marmiton_wp_head', 1 );

/**
 * Gutenberg scripts and styles
 *
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 */
function marmiton_gutenberg_scripts() {
    // Enqueue block editor styles
    wp_enqueue_style(
        'marmiton-gutenberg-editor-styles',
        get_stylesheet_directory_uri() . '/assets/css/editor.css',
        [],
        null
    );
    // Ajout de Google fonts à Gutenberg
    wp_enqueue_style(
        'marmiton-block-editor-fonts',
        '//fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Libre+Franklin:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap',
        [],
        null
    );
}
add_action( 'enqueue_block_editor_assets', 'marmiton_gutenberg_scripts' );

/**
 * Déclaration et utilisation des scripts spécifiques au thème enfant
 *
 * @since marmiton 0.1.0
 **/
function marmiton_enqueue_scripts() {
    // Déclaration et utilisation de scripts Javascript spécifiques au thème enfant
    //wp_register_script( 'marmiton-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), filemtime( get_stylesheet_directory().'/assets/js/scripts.js' ), true );
    //wp_enqueue_script( 'marmiton-scripts' );

    // Google fonts
    wp_enqueue_style( 'marmiton-fonts', '//fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Libre+Franklin:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap', [], null );
}
add_action( 'wp_enqueue_scripts', 'marmiton_enqueue_scripts' );



/**
 * Include functionalities
 */
// Custom post type and taxonomies
include_once( 'includes/cpt.php' );
// Custom blocks
include_once( 'includes/acf.php' );
