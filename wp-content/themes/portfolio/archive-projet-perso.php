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

<main id="projet-perso">
    <section class="projects-gallery">
        <div class="projects-container">
            <?php
            $args = array(
                'post_type' => 'projet-perso',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <!-- Carte de projet -->
                    <a href="<?php the_permalink(); ?>" class="project-card">
                        <div class="project-card-thumbnail">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('small'); ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <!-- Overlay avec extrait -->
                            <div class="project-card-overlay">
                                <div class="project-card-details">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endwhile; 
                wp_reset_postdata();
            else : ?>
                <p class="no-projects">Aucun projet trouvé pour l'instant.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
