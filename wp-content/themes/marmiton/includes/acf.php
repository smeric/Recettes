<?php
/**
 * Bloc qui affiche la liste de recettes
 **/
function marmiton_acf_blocks_init() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'liste_recettes',
            'title'             => __('Liste de recettes'),
            'description'       => __('Ce bloc affiche une liste des dernières recettes publiées.'),
            'render_template'   =>  get_stylesheet_directory() . '/bloc-templates/liste-recettes.php',
            'category'          => 'theme',
            'icon'              => 'food',
            'keywords'          => array( 'liste', 'recette' ),
        ));
    }
}
add_action( 'acf/init', 'marmiton_acf_blocks_init' );
