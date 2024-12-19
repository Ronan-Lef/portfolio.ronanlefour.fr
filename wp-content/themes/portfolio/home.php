<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<main id="portfolio-gallery" class="gallery">
    <div class="gallery-grid">
        
        <?php 
        // Configuration des arguments pour la requête
        $args = array(
            'post_type' => 'accueil', // Type de contenu personnalisé 'accueil'
            'posts_per_page' => 10,   // Affiche jusqu'à 10 éléments
            'orderby' => 'menu_order', // Trie par l'ordre personnalisé
            'order' => 'ASC'          // Ordre croissant
        );

        // Initialisation de la requête
        $query = new WP_Query($args);

        if ($query->have_posts()) : 
            while ($query->have_posts()) : $query->the_post(); 
                $image = get_field('dessin');       // Récupère l'image via ACF
                $link = get_field('redirection');  // Récupère le lien de redirection via ACF
                if ($image && $link) : ?>
                    <!-- Dessin avec lien -->
                    <div class="gallery-item">
                        <a href="<?php echo esc_url($link); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </a>
                    </div>
                <?php 
                endif; 
            endwhile; 
            wp_reset_postdata();
        else : ?>
            <p class="no-items">Aucun dessin trouvé pour le moment.</p>
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
