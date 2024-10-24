<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="header-container">
            <a href="<?php echo home_url(); ?>" class="logo">
                <!-- Ici, tu pourrais ajouter un logo ou laisser le texte du site -->
                <img src="path/to/your/logo.png" alt="Logo">
            </a>
            <nav>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-un', // Ce sera "Menu Un"
                    'menu_class' => 'main-menu',
                ));
                ?>
            </nav>
        </div>
    </header>
