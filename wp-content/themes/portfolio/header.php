<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Asap:wght@500;600&display=swap" rel="stylesheet">

</head>
<body <?php body_class(); ?>>

<header class="main-header">
    <div class="header-container">
        <!-- Section gauche avec le logo et le nom -->
        <div class="header-left">
            <a href="<?php echo home_url(); ?>" class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo-dark.svg" alt="Logo">
                <span class="site-name">Ronan Lefour</span>
            </a>
        </div>
        
        <!-- Section droite avec le titre de la page -->
        <div class="header-right">
            <h1 class="page-title"><?php echo get_dynamic_page_title(); ?></h1>
        </div>
    </div>
</header>
