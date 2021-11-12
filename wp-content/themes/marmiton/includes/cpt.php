<?php

/**
 * Custom post types.
 */

function marmiton_register_cpts() {

    /**
     * Post Type: Recettes.
     */

    $labels = [
        "name" => __( "Recettes", "marmiton" ),
        "singular_name" => __( "Recette", "marmiton" ),
        "menu_name" => __( "Recettes", "marmiton" ),
        "all_items" => __( "Toutes les recettes", "marmiton" ),
        "add_new" => __( "Ajouter une nouvelle", "marmiton" ),
        "add_new_item" => __( "Ajouter une nouvelle recette", "marmiton" ),
        "edit_item" => __( "Modifier la recette", "marmiton" ),
        "new_item" => __( "Nouvelle recette", "marmiton" ),
        "view_item" => __( "Voir la recette", "marmiton" ),
        "view_items" => __( "Voir les recettes", "marmiton" ),
        "search_items" => __( "Recherche de recettes", "marmiton" ),
        "not_found" => __( "Aucune recette trouvée", "marmiton" ),
        "not_found_in_trash" => __( "Aucune recette trouvée dans la corbeille", "marmiton" ),
        "parent" => __( "Recette parente :", "marmiton" ),
        "featured_image" => __( "Image de mise en avant pour cette recette", "marmiton" ),
        "set_featured_image" => __( "Définir l’image de mise en avant pour cette recette", "marmiton" ),
        "remove_featured_image" => __( "Retirer l’image de mise en avant pour cette recette", "marmiton" ),
        "use_featured_image" => __( "Utiliser comme image de mise en avant pour cette recette", "marmiton" ),
        "archives" => __( "Archives des recettes", "marmiton" ),
        "insert_into_item" => __( "Insérer dans la recette", "marmiton" ),
        "uploaded_to_this_item" => __( "Téléverser sur cette recette", "marmiton" ),
        "filter_items_list" => __( "Filtrer la liste des recettes", "marmiton" ),
        "items_list_navigation" => __( "Navigation de liste des recettes", "marmiton" ),
        "items_list" => __( "Liste des recettes", "marmiton" ),
        "attributes" => __( "Attributs des recettes", "marmiton" ),
        "name_admin_bar" => __( "Recette", "marmiton" ),
        "item_published" => __( "Recette publiée", "marmiton" ),
        "item_published_privately" => __( "Recette publiée en privé.", "marmiton" ),
        "item_reverted_to_draft" => __( "Recette repassée en brouillon.", "marmiton" ),
        "item_scheduled" => __( "Recette planifiée", "marmiton" ),
        "item_updated" => __( "Recette mise à jour.", "marmiton" ),
        "parent_item_colon" => __( "Recette parente :", "marmiton" ),
    ];

    $args = [
        "label" => __( "Recettes", "marmiton" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "recette", "with_front" => true ],
        "query_var" => true,
        "menu_icon" => "dashicons-food",
        "supports" => [ "title", "thumbnail", "excerpt", "revisions", "author" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "recette", $args );
}

add_action( 'init', 'marmiton_register_cpts' );


/**
 * Custom taxonomies.
 */

function marmiton_register_taxonomies() {

    /**
     * Taxonomy: Types.
     */

    $labels = [
        "name" => __( "Types", "marmiton" ),
        "singular_name" => __( "Type", "marmiton" ),
        "menu_name" => __( "Types", "marmiton" ),
        "all_items" => __( "Tous les types", "marmiton" ),
        "edit_item" => __( "Modifier le type", "marmiton" ),
        "view_item" => __( "Voir le type", "marmiton" ),
        "update_item" => __( "Mettre à jour le nom du type", "marmiton" ),
        "add_new_item" => __( "Ajouter un nouveau type", "marmiton" ),
        "new_item_name" => __( "Nom du nouveau type", "marmiton" ),
        "parent_item" => __( "Type parent", "marmiton" ),
        "parent_item_colon" => __( "Type parent :", "marmiton" ),
        "search_items" => __( "Recherche de types", "marmiton" ),
        "popular_items" => __( "Types populaires", "marmiton" ),
        "separate_items_with_commas" => __( "Séparer les types avec des virgules", "marmiton" ),
        "add_or_remove_items" => __( "Ajouter ou supprimer des types", "marmiton" ),
        "choose_from_most_used" => __( "Choisir parmi les types les plus utilisés", "marmiton" ),
        "not_found" => __( "Aucun type trouvé", "marmiton" ),
        "no_terms" => __( "Aucun type", "marmiton" ),
        "items_list_navigation" => __( "Navigation de liste de types", "marmiton" ),
        "items_list" => __( "Liste de types", "marmiton" ),
        "back_to_items" => __( "Retourner aux types", "marmiton" ),
    ];


    $args = [
        "label" => __( "Types", "marmiton" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'type-recette', 'with_front' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "type_recette",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "type_recette", [ "recette" ], $args );

    /**
     * Taxonomy: Ingrédients.
     */

    $labels = [
        "name" => __( "Ingrédients", "marmiton" ),
        "singular_name" => __( "Ingrédient", "marmiton" ),
        "menu_name" => __( "Ingredients", "marmiton" ),
        "all_items" => __( "Tous les ingrédients", "marmiton" ),
        "edit_item" => __( "Modifier l’ingrédient", "marmiton" ),
        "view_item" => __( "Voir l’ingrédient", "marmiton" ),
        "update_item" => __( "Mettre à jour le nom de l’ingrédient", "marmiton" ),
        "add_new_item" => __( "Ajouter un nouvel ingrédient", "marmiton" ),
        "new_item_name" => __( "Nom du nouvel ingrédient", "marmiton" ),
        "parent_item" => __( "Ingrédient parent", "marmiton" ),
        "parent_item_colon" => __( "Ingrédient parent :", "marmiton" ),
        "search_items" => __( "Recherche d’ingrédients", "marmiton" ),
        "popular_items" => __( "Ingrédients populaires", "marmiton" ),
        "separate_items_with_commas" => __( "Séparer les ingrédients avec des virgules", "marmiton" ),
        "add_or_remove_items" => __( "Ajouter ou supprimer des ingrédients", "marmiton" ),
        "choose_from_most_used" => __( "Choisir parmi les ingrédients les plus utilisés", "marmiton" ),
        "not_found" => __( "Aucun ingrédient trouvé", "marmiton" ),
        "no_terms" => __( "Aucun ingrédient", "marmiton" ),
        "items_list_navigation" => __( "Navigation de liste d’ingrédients", "marmiton" ),
        "items_list" => __( "Liste d’ingrédients", "marmiton" ),
        "back_to_items" => __( "Retourner aux ingrédients", "marmiton" ),
    ];


    $args = [
        "label" => __( "Ingrédients", "marmiton" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'ingredient', 'with_front' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "ingredient",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
        "meta_box_cb" => false,
    ];
    register_taxonomy( "ingredient", [ "recette" ], $args );
}
add_action( 'init', 'marmiton_register_taxonomies' );
