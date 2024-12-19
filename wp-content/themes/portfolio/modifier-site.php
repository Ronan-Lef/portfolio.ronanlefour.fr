<?php
/*
Template Name: Modifier Site
*/

if (!current_user_can('administrator')) {
    wp_die("Vous n'avez pas l'autorisation d'accéder à cette page.");
}

// Inclure le fichier nécessaire pour les uploads
require_once(ABSPATH . 'wp-admin/includes/file.php');

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Mise à jour du contenu de l'article
        $updated_content = wp_kses_post($_POST['post_content']);
        wp_update_post([
            'ID' => $post_id,
            'post_content' => $updated_content,
        ]);

        // Mise à jour du lien du site
        $site_link = esc_url_raw($_POST['site_link']);
        update_field('site_link', $site_link, $post_id);

        // Gestion des images (par exemple, image desktop et mobile)
        for ($i = 1; $i <= 2; $i++) {
            if (!empty($_FILES['site_image_' . $i]['name'])) {
                $file = $_FILES['site_image_' . $i];
                $upload = wp_handle_upload($file, ['test_form' => false]);

                if (!isset($upload['error']) && isset($upload['url'])) {
                    $attachment_id = wp_insert_attachment([
                        'post_mime_type' => $upload['type'],
                        'post_title' => sanitize_file_name($file['name']),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    ], $upload['file'], $post_id);

                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attach_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                    wp_update_attachment_metadata($attachment_id, $attach_data);

                    update_field('site_image_' . $i, $attachment_id, $post_id);
                }
            }
        }

        // Redirection après la sauvegarde
        wp_redirect(site_url('/dev-mmi/'));
        exit;
    }

    // Récupérer le contenu de l'article
    $post_content = get_post_field('post_content', $post_id);

    // Récupérer le lien du site
    $site_link = get_field('site_link', $post_id);

    // Récupérer les images associées
    $images = [];
    for ($i = 1; $i <= 2; $i++) {
        $images[] = get_field('site_image_' . $i, $post_id);
    }
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le site</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<main id="edit-site">
    <div class="edit-site-form">
        <?php if ($post_id) : ?>
            <form method="post" enctype="multipart/form-data">
                <!-- Éditeur de contenu -->
                <label for="post_content">Description du site</label>
                <?php
                wp_editor(
                    $post_content,
                    'post_content',
                    [
                        'textarea_name' => 'post_content',
                        'textarea_rows' => 10,
                        'media_buttons' => true,
                    ]
                );
                ?>

                <!-- Lien du site -->
                <label for="site_link">Lien du site</label>
                <input type="url" name="site_link" id="site_link" value="<?php echo esc_attr($site_link); ?>" required>

                <!-- Gestion des images -->
                <?php for ($i = 1; $i <= 2; $i++) : ?>
                    <label for="site_image_<?php echo $i; ?>">
                        Image <?php echo $i === 1 ? 'Desktop' : 'Mobile'; ?>
                    </label>
                    <?php if (!empty($images[$i - 1])) : ?>
                        <div style="margin-bottom: 10px;">
                            <img src="<?php echo esc_url($images[$i - 1]['url']); ?>" alt="Image actuelle" style="max-width: 200px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="site_image_<?php echo $i; ?>" id="site_image_<?php echo $i; ?>">
                <?php endfor; ?>

                <button type="submit">Enregistrer les modifications</button>
            </form>
        <?php else : ?>
            <p>Site introuvable.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
