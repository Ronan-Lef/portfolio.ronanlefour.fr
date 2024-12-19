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

<main id="mmi-projects">

    <?php
    $args = array(
        'post_type' => 'travaux-mmi', // Type de publication personnalisé
        'posts_per_page' => -1,       // Récupérer tous les articles
        'orderby' => 'menu_order',    // Trier par l'ordre personnalisé
        'order' => 'ASC',             // Ordre croissant (ordre défini dans le back-end)
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
    ?>

            <section class="project-container">
                <div class="projects-banner">
                    <h2><?php the_title(); ?></h2>
                </div>

                <div class="project-content">
                    <!-- Galerie d'images responsive -->
                    <div class="gallery-images">
                    <?php 
                    for ($i = 1; $i <= 20; $i++) {
                        $image = get_field('image_projet_' . $i); 
                        if ($image) : 
                    ?>
                        <div class="gallery-item">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" onclick="openLightbox('<?php echo esc_url($image['url']); ?>')">
                        </div>
                    <?php 
                        endif; 
                    } 
                    ?>
                    </div>
                </div>

                <!-- Zone de texte modifiable par l'administrateur -->
                <div class="project-description">
    <?php echo wpautop(get_the_content()); ?>
</div>


                <!-- Bouton Éditer, visible seulement pour les administrateurs -->
                <?php if (current_user_can('administrator')) : ?>
                    <div class="edit-project-button">
                        <a href="<?php echo site_url('/modifier-travail-mmi/?post_id=' . get_the_ID()); ?>" class="edit-button">
                            Éditer
                        </a>
                    </div>
                <?php endif; ?>

            </section>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>

    <!-- Bouton d'ajout de projet pour l'administrateur -->
    <?php if (current_user_can('administrator')) : ?>
        <div class="add-project-button">
            <a href="<?php echo site_url('/nouveau-travail-mmi'); ?>" class="btn-add-project">Ajouter un nouveau projet</a>
        </div>
    <?php endif; ?>


    <!-- Conteneur de la lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="close">&times;</span>
        <img class="lightbox-image" id="lightbox-img" src="" alt="">
    </div>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

<!-- JavaScript pour ouvrir et fermer la lightbox -->
<script>
function openLightbox(src) {
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    lightboxImg.src = src;
    lightbox.style.display = "flex";
}

function closeLightbox() {
    const lightbox = document.getElementById("lightbox");
    lightbox.style.display = "none";
}
</script>

</body>
</html>
