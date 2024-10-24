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
