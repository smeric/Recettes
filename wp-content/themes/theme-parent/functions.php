<?php // Opening PHP tag - nothing should be before this, not even whitespace

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Enqueue this theme stylesheet.
 *
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see https://developer.wordpress.org/reference/functions/get_template_directory_uri/
 * @see https://developer.wordpress.org/reference/functions/add_action/
 *
 * @return void
 */
function theme_parent_enqueue_styles() {
    wp_enqueue_style(
        'theme_parent-style', // This is the theme stylesheet id.
        get_template_directory_uri() . '/style.css'
    );
}
// @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
add_action( 'wp_enqueue_scripts', 'theme_parent_enqueue_styles' );


/**
 * Theme setup.
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 *
 * @return void
 */
function theme_parent_theme_setup() {
    /**
     * Setup theme_parent Theme's textdomain.
     *
     * @see https://developer.wordpress.org/reference/functions/load_theme_textdomain/
     * @see https://developer.wordpress.org/reference/functions/get_template_directory/
     *
     * Declare textdomain for this child theme.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain( 'theme_parent', get_template_directory() . '/languages' );

    /**
     * Utilisation de code HTML5 valide.
     *
     * @see https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     * @see https://developer.wordpress.org/reference/functions/apply_filters/
     */
    add_theme_support( 'html5', apply_filters( 'theme_parent_html5_support_args', array(
        'search-form',
        'comment-list',
        'comment-form',
        'gallery',
        'caption',
        'script',
        'style',
    )));

    /**
     * Title tag theme support
     *
     * @see https://developer.wordpress.org/reference/functions/add_theme_support/
     * @see https://codex.wordpress.org/Title_Tag
     */
    add_theme_support( 'title-tag' );

    // Adding Custom Logo support
    // @see https://developer.wordpress.org/themes/functionality/custom-logo/
    /**
     * Adding Custom Logo support
     *
     * @see https://developer.wordpress.org/themes/functionality/custom-logo/
     * @see https://developer.wordpress.org/reference/functions/apply_filters/
     */
    add_theme_support( 'custom-logo', apply_filters( 'theme_parent_custom_logo_args', array(
        // Expected logo width and height in pixels.
        // A custom logo can also use built-in image sizes, such as thumbnail, or custom image size.
        'width'                => 300,
        'height'               => 300,
        // Whether to allow for a flexible width and height.
        'flex-height'          => true,
        'flex-width'           => true,
        // Classes(s) of elements to hide. It can pass an array of class names here for all elements constituting header text that could be replaced by a logo.
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true,
    )));

    /**
     * Ce thème utilise des menus WordPress dans les deux barres latérales (sidebar)
     * de l'entête (header) et du pied de page (footer).
     *
     * @see https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus( array(
        'header' => __( 'Header menu', 'theme_parent' ),
        'footer' => __( 'Footer menu', 'theme_parent' ),
    ) );
}
// see https://developer.wordpress.org/reference/hooks/after_setup_theme/
add_action( 'after_setup_theme', 'theme_parent_theme_setup' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @see theme_parent_customizer_settings()
 * @see https://developer.wordpress.org/reference/functions/bloginfo/
 *
 * @return void
 */
function theme_parent_customize_partial_blogname(){
    bloginfo( 'name' );
}

/**
 * Render the site description for the selective refresh partial.
 *
 * @see theme_parent_customizer_settings()
 * @see https://developer.wordpress.org/reference/functions/bloginfo/
 *
 * @return void
 */
function theme_parent_customize_partial_blogdescription(){
    bloginfo( 'description' );
}

/**
 * Register our sidebars and widgetized areas.
 *
 * @see https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @return void
 */
function theme_parent_widgets_init() {
    register_sidebar(array(
        'name'          => __( 'Header', 'theme_parent' ),
        'id'            => 'header',
        'description'   => __( 'The header widgets area.', 'theme_parent' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">'.PHP_EOL,
        'after_widget'  => '</div>'.PHP_EOL,
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>' . PHP_EOL,
    ));
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'theme_parent' ),
        'id'            => 'sidebar',
        'description'   => __( 'The sidebar widgets area.', 'theme_parent' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">'.PHP_EOL,
        'after_widget'  => '</div>' . PHP_EOL,
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>' . PHP_EOL,
    ));
    register_sidebar(array(
        'name'          => __( 'Footer', 'theme_parent' ),
        'id'            => 'footer',
        'description'   => __( 'The footer widgets area.', 'theme_parent' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">'.PHP_EOL,
        'after_widget'  => '</div>'.PHP_EOL,
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>' . PHP_EOL,
    ));
}
// see https://developer.wordpress.org/reference/hooks/widgets_init/
add_action( 'widgets_init', 'theme_parent_widgets_init' );

/**
 * Used as a callback in include/customizer.php to display the sidebar if a checkbox is checked
 *
 * @see https://developer.wordpress.org/reference/functions/get_theme_mod/
 * @see https://developer.wordpress.org/reference/functions/is_active_sidebar/
 * @see https://developer.wordpress.org/reference/functions/dynamic_sidebar/
 * @see https://developer.wordpress.org/reference/functions/current_user_can/
 * @see https://developer.wordpress.org/reference/functions/admin_url/
 * @see https://developer.wordpress.org/reference/functions/_e/
 *
 * @return void
 */
function theme_parent_display_sidebar(){
    if( get_theme_mod( 'theme_parent_sidebar_display', 'show' ) == 'show' ) :
        if ( is_active_sidebar( 'sidebar' ) ):
            dynamic_sidebar( 'sidebar' );
        else:
            if ( current_user_can( 'edit_theme_options' ) ):
                ?>
                <div class="private-message">
                    <a href="<?php echo admin_url( 'widgets.php' ); ?>"><?php _e( 'Add some widgets to the sidebar.', 'theme_parent' ); ?></a>
                </div>
                <?php
            endif;
        endif;
    endif;
}

/**
 * Ajoute les information WAI ARIA aux menu de l'entête (header) et du pied de page (footer).
 *
 * @link http://www.lesintegristes.net/2008/12/09/introduction-a-wai-aria-traduction/
 * @see https://developer.wordpress.org/reference/functions/__/
 * @see https://developer.wordpress.org/reference/functions/apply_filters/
 * @see https://developer.wordpress.org/reference/functions/add_filter/
 *
 * @param string $nav_menu Le contenu HTML du menu de navigation.
 * @param object $args Arguments de {@see wp_nav_menu()}.
 * @return string $nav_menu Contenu HTML du menu mis à jour.
 **/
function theme_parent_wp_nav_menu( $nav_menu, $args ) {
    $nav_menu = preg_replace( '/<nav/', '<nav role="navigation"', $nav_menu );
    if( 'header' === $args->theme_location ){
        $nav_menu = preg_replace( '/<nav/', '<nav aria-label="' . __( 'Primary navigation', 'theme_parent' ) . '"', $nav_menu );
    }
    elseif( 'footer' === $args->theme_location ){
        $nav_menu = preg_replace( '/<nav/', '<nav aria-label="' . __( 'Secondary navigation', 'theme_parent' ) . '"', $nav_menu );
    }

    /**
     * Filtre appliqué au contenu HTML des menus de navigation.
     *
     * @param string $nav_menu Le contenu HTML du menu de navigation.
     * @param object $args Arguments de {@see wp_nav_menu()}.
     **/
    $nav_menu = apply_filters( 'theme_parent_wp_nav_menu', $nav_menu, $args );

    return $nav_menu;
}
// @see https://developer.wordpress.org/reference/hooks/wp_nav_menu/
add_filter( 'wp_nav_menu', 'theme_parent_wp_nav_menu', 10, 2 );

/**
 * Pluggable function : display a comment (see in comments.php template file)
 *
 * @see https://developer.wordpress.org/reference/functions/comment_class/
 * @see https://developer.wordpress.org/reference/functions/comment_ID/
 * @see https://developer.wordpress.org/reference/functions/_e/
 * @see https://developer.wordpress.org/reference/functions/comment_author_link/
 * @see https://developer.wordpress.org/reference/functions/edit_comment_link/
 * @see https://developer.wordpress.org/reference/functions/get_avatar/
 * @see https://developer.wordpress.org/reference/functions/get_comment_author_link/
 * @see https://developer.wordpress.org/reference/functions/esc_url/
 * @see https://developer.wordpress.org/reference/functions/get_comment_link/
 * @see https://developer.wordpress.org/reference/functions/get_comment_time/
 * @see https://developer.wordpress.org/reference/functions/get_comment_date/
 * @see https://developer.wordpress.org/reference/functions/comment_text/
 * @see https://developer.wordpress.org/reference/functions/comment_reply_link/
 *
 * @param [object] $comment
 * @param [array] $args
 * @param [int] $depth
 * @return void
  */
if ( ! function_exists( 'theme_parent_comment' ) ) {
    function theme_parent_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', 'theme_parent' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'theme_parent' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
                break;
            default :
            // Proceed with normal comments.
            global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <header class="comment-meta comment-author vcard">
                    <?php
                        echo get_avatar( $comment, 44 );
                        printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'theme_parent' ) . '</span>' : ''
                        );
                        printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s at %2$s', 'theme_parent' ), get_comment_date(), get_comment_time() )
                        );
                    ?>
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'theme_parent' ); ?></p>
                <?php endif; ?>

                <section class="comment-content comment">
                    <?php comment_text(); ?>
                    <?php edit_comment_link( __( 'Edit', 'theme_parent' ), '<p class="edit-link">', '</p>' ); ?>
                </section><!-- .comment-content -->

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'theme_parent' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </article><!-- #comment-## -->
        <?php
            break;
        endswitch; // end comment_type check
    }
}

/**
 * Ajouter des classes au body.
 *
 * @see https://developer.wordpress.org/reference/functions/get_theme_mod/
 * @see https://developer.wordpress.org/reference/functions/apply_filters/
 * @see https://developer.wordpress.org/reference/functions/add_filter/
 *
 * @param   array  $classes  Les classes qui apparaissent dans la balise body.
 * @return  array  $classes
 */
function theme_parent_body_classes( $classes ) {
    $classes[] = 'start-theme_parent-classes';

    // En fonction de la présence ou non des sidebars
    if ( get_theme_mod( 'theme_parent_sidebar_display', 'show' ) != 'show' ) {
        $classes[] = 'hidden-sidebar';
    }

    $classes[] = 'end-theme_parent-classes';

    /**
     * Filtre appliqué à la liste des classes appliquées au tag body.
     *
     * @param array $classes Liste des classes appliquées au tag body.
     **/
    $classes = apply_filters( 'theme_parent_body_classes', $classes );

    return $classes;
}
// @see https://developer.wordpress.org/reference/hooks/body_class/
add_filter( 'body_class', 'theme_parent_body_classes' );


/**
 * Include theme functionalities
 */
include_once( 'includes/customizer.php' );



