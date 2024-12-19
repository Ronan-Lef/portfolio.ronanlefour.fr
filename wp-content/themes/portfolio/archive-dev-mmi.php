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

<main id="site-carousel">
<div class="carousel-container">
    <!-- Flèche gauche -->
    <button class="carousel-arrow left-arrow" onclick="scrollCarousel(-1)">&#10094;</button>

    <!-- Carrousel principal -->
    <div class="carousel-wrapper">
        <div class="carousel">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php 
                    // Récupérer le lien du champ ACF 'lien_site'
                    $lien_site = get_field('lien_site'); 
                    ?>
                    <div class="carousel-item">
                        <!-- Titre du site -->
                        <h1 class="site-title">
                            <a href="<?php echo esc_url($lien_site); ?>" target="_blank">
                                <?php the_title(); ?>
                            </a>
                        </h1>

                        <!-- Images -->
                        <div class="images-container">
                            <!-- Image 1 -->
                            <div class="image-1">
                                <?php 
                                $image_1 = get_field('image_1');
                                if ($image_1 && isset($image_1['url'])) : ?>
                                    <img src="<?php echo esc_url($image_1['url']); ?>" alt="<?php echo esc_attr($image_1['alt']); ?>">
                                <?php endif; ?>
                            </div>
                            <!-- Image 2 -->
                            <div class="image-2">
                                <?php 
                                $image_2 = get_field('image_2');
                                if ($image_2 && isset($image_2['url'])) : ?>
                                    <img src="<?php echo esc_url($image_2['url']); ?>" alt="<?php echo esc_attr($image_2['alt']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="site-description">
                            <?php the_content(); ?>
                        </div>

                        <!-- Bouton Modifier -->
                        <?php if (current_user_can('administrator')) : ?>
                            <div class="edit-site-button">
                                <a href="<?php echo site_url('/modifier-site/?post_id=' . get_the_ID()); ?>" class="btn-edit">Modifier ce site</a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Flèche droite -->
    <button class="carousel-arrow right-arrow" onclick="scrollCarousel(1)">&#10095;</button>
</div>

<!-- Bouton Ajouter un nouveau site -->
<?php if (current_user_can('administrator')) : ?>
    <div class="add-site-button">
        <a href="<?php echo site_url('/nouveau-site'); ?>" class="btn-add">Ajouter un site</a>
    </div>
<?php endif; ?>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

<script>
    let currentIndex = 0; // Index actuel dans le carousel

    function scrollCarousel(direction) {
        const carousel = document.querySelector('.carousel');
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;

        // Mise à jour de l'index
        currentIndex += direction;

        // Boucler si on dépasse les limites
        if (currentIndex < 0) {
            currentIndex = totalItems - 1; // Retour au dernier item
        } else if (currentIndex >= totalItems) {
            currentIndex = 0; // Retour au premier item
        }

        // Calcul de l'offset pour le défilement
        const offset = currentIndex * carousel.offsetWidth;

        // Appliquer le décalage
        carousel.scrollTo({
            left: offset,
            behavior: 'smooth',
        });
    }
</script>

</body>
</html>
