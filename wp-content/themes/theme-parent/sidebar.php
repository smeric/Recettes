<?php // Opening PHP tag - nothing should be before this, not even whitespace

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Templates sidebar
 *
 * see https://codex.wordpress.org/Sidebars
 * see https://codex.wordpress.org/Customizing_Your_Sidebar
 * see https://developer.wordpress.org/reference/functions/is_active_sidebar/
 * see https://developer.wordpress.org/reference/functions/dynamic_sidebar/
 */
?>
<aside id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
    <?php theme_parent_display_sidebar() ?>
</aside><!-- #primary-sidebar -->


