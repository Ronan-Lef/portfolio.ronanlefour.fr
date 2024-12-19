<?php
/*
Template Name: Nouveau Travail Perso
*/

// Vérification des droits administrateurs
if (!current_user_can('administrator')) {
    wp_die("Vous n'avez pas l'autorisation d'accéder à cette page.");
}

// Traitement du formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_text_field($_POST['post_title']);
    $content = wp_kses_post($_POST['post_content']);
    $category_id = intval($_POST['post_category']);

    if ($title && $content && $category_id) {
        // Création du nouveau post
        $post_id = wp_insert_post(array(
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'travaux-perso',
            'post_category' => array($category_id),
        ));

        if ($post_id) {
            // Redirection après l'ajout
            wp_redirect(site_url('/travaux-perso'));
            exit;
        }
    }
}

get_header();
?>

<main id="nouveau-travail-perso-page">
    <div class="add-container">
        <form method="post" class="add-form">
            <!-- Titre -->
            <label for="post_title">Titre</label>
            <input type="text" id="post_title" name="post_title" placeholder="Titre du travail" required>

            <!-- Description -->
            <label for="post_content">Description</label>
            <?php
            wp_editor(
                '',
                'post_content',
                array(
                    'textarea_name' => 'post_content',
                    'textarea_rows' => 10,
                    'media_buttons' => true,
                )
            );
            ?>

            <!-- Catégorie -->
            <label for="post_category">Catégorie</label>
            <select id="post_category" name="post_category" required>
                <option value="">Sélectionner une catégorie</option>
                <?php
                $categories = get_categories(array(
                    'hide_empty' => false,
                ));
                foreach ($categories as $category) :
                    ?>
                    <option value="<?php echo esc_attr($category->term_id); ?>">
                        <?php echo esc_html($category->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Bouton Ajouter -->
            <button type="submit">Ajouter</button>
        </form>
    </div>
</main>

<?php get_footer(); ?>