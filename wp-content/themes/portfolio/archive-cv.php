<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<main class="cv-container">
    <?php 
    // Configuration des arguments pour récupérer l'article "cv"
    $args = array(
        'post_type'      => 'cv',       // Type de contenu personnalisé
        'posts_per_page' => 1,          // Affiche le premier article "cv"
        'post_status'    => 'publish',  // Uniquement les articles publiés
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            // Récupère le contenu de l'article
            $content = get_the_content();

            // Recherche automatique d'un lien vers un fichier PDF dans le contenu
            $pdf_url = '';
            if (preg_match('/<a[^>]+href=["\']([^"\']+\.pdf)["\']/i', $content, $matches)) {
                $pdf_url = $matches[1]; // Extrait l'URL du PDF
            }

            if ($pdf_url) : ?>
                <!-- Affiche le PDF dans un iframe -->
                <iframe 
                    class="cv-embed" 
                    src="<?php echo esc_url($pdf_url); ?>#view=FitH" 
                    type="application/pdf" 
                    title="<?php echo esc_attr(get_the_title()); ?>">
                </iframe>
            <?php else : ?>
                <p>Aucun fichier PDF trouvé dans cet article.</p>
            <?php endif;

        endwhile; 
        wp_reset_postdata();
    else : ?>
        <p>Aucun CV trouvé pour le moment.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
