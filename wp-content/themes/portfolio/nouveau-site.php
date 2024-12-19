<?php
/**
 * Template Name: Nouveau Site
 * Description: Template pour ajouter un nouveau site web.
 */
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

<main id="new-site">
    <section class="add-site-form">
         <?php if (current_user_can('administrator')) : ?>
            <?php
            // Inclure les fonctions nécessaires pour la gestion des fichiers multimédia
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            
            // Vérifie si le formulaire a été soumis
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_site_nonce']) && wp_verify_nonce($_POST['new_site_nonce'], 'add_new_site')) {
                // Récupère les données du formulaire
                $title = sanitize_text_field($_POST['site_title']);
                $content = wp_kses_post($_POST['site_description']); // Contenu avec balises autorisées
                $link = esc_url_raw($_POST['site_link']); // Lien du site

                // Crée un nouvel article de type "Site Web"
                $new_post_id = wp_insert_post(array(
                    'post_type' => 'site-web',
                    'post_title' => $title,
                    'post_content' => $content,
                    'post_status' => 'publish',
                ));

                if ($new_post_id) {
                    // Sauvegarde le lien du site (champ personnalisé ACF ou meta)
                    update_field('site_link', $link, $new_post_id);

                    // Sauvegarde des images (par exemple image desktop et image mobile)
                    for ($i = 1; $i <= 2; $i++) {
                        if (!empty($_FILES['site_image_' . $i]['name'])) {
                            // Charge l'image dans la bibliothèque et l'associe au champ ACF
                            $attachment_id = media_handle_upload('site_image_' . $i, $new_post_id);
                            if (!is_wp_error($attachment_id)) {
                                update_field('site_image_' . $i, $attachment_id, $new_post_id);
                            }
                        }
                    }

                    // Redirection vers la page des sites web
                    wp_redirect(site_url('/site-web/'));
                    exit;
                } else {
                    echo '<p class="error-message">Erreur lors de la création du site.</p>';
                }
            }
            ?>

            <!-- Formulaire d'ajout de site -->
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="site_title">Titre du site</label>
                <input type="text" name="site_title" id="site_title" required class="add-site-form-input">

                <label for="site_description">Description du site</label>
                <?php
                wp_editor(
                    '', // Contenu initial vide
                    'site_description',
                    [
                        'textarea_name' => 'site_description',
                        'textarea_rows' => 10,
                        'media_buttons' => true,
                    ]
                );
                ?>

                <label for="site_link">Lien du site</label>
                <input type="url" name="site_link" id="site_link" required class="add-site-form-input">

                <?php for ($i = 1; $i <= 2; $i++) : ?>
                    <label for="site_image_<?php echo $i; ?>">Image <?php echo $i === 1 ? 'Desktop' : 'Mobile'; ?></label>
                    <input type="file" name="site_image_<?php echo $i; ?>" id="site_image_<?php echo $i; ?>" class="add-site-form-input">
                <?php endfor; ?>

                <?php wp_nonce_field('add_new_site', 'new_site_nonce'); ?>
                <button type="submit" class="add-site-form-button">Ajouter le site</button>
            </form>
        <?php else : ?>
            <p>Seuls les administrateurs peuvent ajouter un site.</p>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
