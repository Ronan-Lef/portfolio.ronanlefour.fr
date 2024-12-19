<?php
/**
 * Template Name: Éditer Projet Personnel
 */
if (!current_user_can('administrator')) {
    wp_redirect(home_url());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = intval($_POST['post_id']);
    if ($post_id && check_admin_referer('edit_projet_perso', 'edit_nonce')) {
        // Mise à jour des champs ACF
        update_field('titre_projet', sanitize_text_field($_POST['titre_projet']), $post_id);
        update_field('introduction_projet', sanitize_textarea_field($_POST['introduction_projet']), $post_id);
        update_field('description_projet', sanitize_textarea_field($_POST['description_projet']), $post_id);
        update_field('reseaux_projet', esc_url_raw($_POST['reseaux_projet']), $post_id);
        update_field('annonces_projet', sanitize_textarea_field($_POST['annonces_projet']), $post_id);

        wp_redirect(site_url('/projet-perso'));
exit;

    }
}

$post_id = intval($_GET['post_id']);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<main id="edit-projet-perso">
    <section class="edit-project-form">
        <?php if (current_user_can('administrator')) : ?>
            <form action="" method="POST">
                <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
                <?php wp_nonce_field('edit_projet_perso', 'edit_nonce'); ?>
                
                <!-- Champ Titre -->
                <label for="titre_projet">Titre du projet</label>
                <input type="text" id="titre_projet" name="titre_projet" value="<?php echo esc_attr(get_field('titre_projet', $post_id)); ?>" required>
                
                <!-- Champ Introduction -->
                <label for="introduction_projet">Introduction</label>
                <textarea id="introduction_projet" name="introduction_projet"><?php echo esc_textarea(get_field('introduction_projet', $post_id)); ?></textarea>
                
                <!-- Champ Description -->
                <label for="description_projet">Description</label>
                <textarea id="description_projet" name="description_projet"><?php echo esc_textarea(get_field('description_projet', $post_id)); ?></textarea>
                
                <!-- Champ Réseaux -->
                <label for="reseaux_projet">Lien vers les réseaux</label>
                <input type="url" id="reseaux_projet" name="reseaux_projet" value="<?php echo esc_url(get_field('reseaux_projet', $post_id)); ?>">
                
                <!-- Champ Annonces -->
                <label for="annonces_projet">Annonces</label>
                <textarea id="annonces_projet" name="annonces_projet"><?php echo esc_textarea(get_field('annonces_projet', $post_id)); ?></textarea>
                
                <!-- Bouton Enregistrer -->
                <button type="submit">Enregistrer les modifications</button>
            </form>
        <?php else : ?>
            <p>Vous n'êtes pas autorisé à accéder à cette page.</p>
        <?php endif; ?>
    </section>
</main>


<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
