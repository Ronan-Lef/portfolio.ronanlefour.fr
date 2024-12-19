<?php
function portfolio_theme_setup() {
    // Support des menus
    register_nav_menus(array(
        'menu-un' => __('Menu Un'),
    ));

    // Support des images de mise en avant
    add_theme_support('post-thumbnails');

    // Ajout des styles
    wp_enqueue_style('portfolio-style', get_stylesheet_uri());

    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Asap:wght@600&family=Roboto:wght@400&display=swap', false);
}
add_action('after_setup_theme', 'portfolio_theme_setup');

function get_dynamic_page_title() {
    // Vérifie si c'est la page d'accueil
    if (is_front_page()) {
        return 'Accueil';
    }

    // Si c'est une page, retourne son titre
    if (is_page()) {
        return get_the_title(); // Affiche le titre de la page
    }

    // Si c'est un type de contenu personnalisé, retourne le label singulier
    if ($post_type = get_post_type()) {
        $post_type_obj = get_post_type_object($post_type);
        return $post_type_obj->labels->singular_name ?? get_the_title();
    }

    // Par défaut, retourne le titre de la page ou de l'article
    return get_the_title() ?: 'Page en construction';
}

add_theme_support('post-thumbnails');

