<?php // Opening PHP tag - nothing should be before this, not even whitespace

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Templates comments
 *
 * see https://codex.wordpress.org/Sidebars
 * see https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/comments/
 * see https://developer.wordpress.org/reference/functions/post_password_required/
 * see https://developer.wordpress.org/reference/functions/dynamic_sidebar/
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'theme_parent' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>

        <ol class="commentlist">
            <?php wp_list_comments( array( 'callback' => 'theme_parent_comment', 'style' => 'ol' ) ); ?>
        </ol><!-- .commentlist -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="navigation" role="navigation">
            <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'theme_parent' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'theme_parent' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'theme_parent' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php comment_form(); ?>

</div><!-- #comments .comments-area -->