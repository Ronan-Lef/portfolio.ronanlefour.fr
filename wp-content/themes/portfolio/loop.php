<?php get_header(); ?>
<div class="content-container">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <article>
            <h1><?php the_title(); ?></h1>
            <div class="featured-image">
            <?php if (get_post_type() !== 'projet-perso') : ?>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
            </div>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; else: ?>
        <p>Aucun contenu disponible</p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>

