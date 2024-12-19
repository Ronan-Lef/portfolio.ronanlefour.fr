<?php
/**
 * Template Name: Nouveau Travail MMI
 * Description: Template pour ajouter un nouveau travail MMI
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<main id="new-mmi-project">
    <section class="new-project-form">
        <?php if (current_user_can('administrator')) : ?>
            <?php
            // Inclure les fonctions nécessaires pour la gestion des fichiers multimédia
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            
            // Vérifie si le formulaire a été soumis
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_project_nonce']) && wp_verify_nonce($_POST['new_project_nonce'], 'add_new_project')) {
                // Récupère les données du formulaire
                $title = sanitize_text_field($_POST['project_title']);
                $content = wp_kses_post($_POST['post_content']); // Contenu avec balises autorisées
                
                // Crée un nouvel article de type "Travaux MMI"
                $new_post_id = wp_insert_post(array(
                    'post_type' => 'travaux-mmi',
                    'post_title' => $title,
                    'post_content' => $content,
                    'post_status' => 'publish',
                ));

                if ($new_post_id) {
                    // Sauvegarde des images via les champs ACF
                    for ($i = 1; $i <= 20; $i++) {
                        if (!empty($_FILES['image_projet_' . $i]['name'])) {
                            // Charge l'image dans la bibliothèque et l'associe au champ ACF
                            $attachment_id = media_handle_upload('image_projet_' . $i, $new_post_id);
                            if (!is_wp_error($attachment_id)) {
                                update_field('image_projet_' . $i, $attachment_id, $new_post_id);
                            }
                        }
                    }

                    // Redirection vers la page Travaux MMI
                    wp_redirect(site_url('/travaux-mmi/'));
                    exit;
                } else {
                    echo '<p class="error-message">Erreur lors de la création du projet.</p>';
                }
            }
            ?>

            <!-- Formulaire d'ajout de projet -->
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="project_title">Titre du projet</label>
                <input type="text" name="project_title" id="project_title" required>

                <label for="post_content">Description du projet</label>
                <?php
                wp_editor(
                    '', // Contenu initial vide
                    'post_content',
                    [
                        'textarea_name' => 'post_content',
                        'textarea_rows' => 10,
                        'media_buttons' => true,
                    ]
                );
                ?>

                <?php for ($i = 1; $i <= 20; $i++) : ?>
                    <label for="image_projet_<?php echo $i; ?>">Image <?php echo $i; ?></label>
                    <input type="file" name="image_projet_<?php echo $i; ?>" id="image_projet_<?php echo $i; ?>">
                <?php endfor; ?>

                <?php wp_nonce_field('add_new_project', 'new_project_nonce'); ?>
                <button type="submit">Ajouter le projet</button>
            </form>
        <?php else : ?>
            <p>Seuls les administrateurs peuvent ajouter un projet.</p>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
