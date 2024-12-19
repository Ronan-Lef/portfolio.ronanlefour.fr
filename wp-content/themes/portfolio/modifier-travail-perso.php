<?php
/*
Template Name: Modifier Travail Perso
*/

// Vérification des droits administrateurs
if (!current_user_can('administrator')) {
    wp_die("Vous n'avez pas l'autorisation d'accéder à cette page.");
}

// Récupération des articles de type "travaux-perso"
$args = array(
    'post_type' => 'travaux-perso',
    'posts_per_page' => -1,
    'post_status' => 'publish',
);
$query = new WP_Query($args);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mettre à jour les articles
    $post_id = intval($_POST['post_id']);
    $new_title = sanitize_text_field($_POST['post_title']);
    $new_content = wp_kses_post($_POST['post_content']);

    if ($post_id) {
        // Mise à jour du contenu et du titre
        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => $new_title,
            'post_content' => $new_content,
        ));

        wp_redirect(site_url('/travaux-perso'));
        exit;
    }
}

get_header();
?>

<main id="modifier-travail-perso-page">
    <div class="edit-container">
        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <form method="post" class="edit-form">
                    <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">

                    <!-- Titre -->
                    <label for="post_title_<?php echo get_the_ID(); ?>">Titre</label>
                    <input type="text" id="post_title_<?php echo get_the_ID(); ?>" name="post_title" value="<?php echo esc_attr(get_the_title()); ?>" required>

                    <!-- Description -->
                    <label for="post_content_<?php echo get_the_ID(); ?>">Description</label>
                    <?php
                    wp_editor(
                        get_the_content(),
                        'post_content_' . get_the_ID(),
                        array(
                            'textarea_name' => 'post_content',
                            'textarea_rows' => 10,
                            'media_buttons' => true,
                        )
                    );
                    ?>

                    <button type="submit">Enregistrer les modifications</button>
                </form>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
