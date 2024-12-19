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

<main id="travaux-perso-page">
    <div class="travaux-perso-container">
        <!-- Menu desktop -->
        <div class="travaux-perso-menu">
            <ul class="travaux-perso-menu-list">
                <?php
                $categories_slugs = ['personnage', 'logo', 'sketches'];
                foreach ($categories_slugs as $category_slug) :
                    $category = get_category_by_slug($category_slug);
                    if ($category) : ?>
                        <li class="travaux-perso-menu-item">
                            <a href="#<?php echo esc_attr($category_slug); ?>" class="travaux-perso-menu-link"><?php echo esc_html($category->name); ?></a>
                        </li>
                    <?php endif;
                endforeach; ?>
            </ul>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
        </div>

        <!-- Menu mobile -->
        <div class="mobile-menu-icon" id="mobile-menu-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </div>
        <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>
        <div class="mobile-menu" id="mobile-menu">
            <button class="close-mobile-menu" id="close-mobile-menu">&times;</button>
            <ul class="mobile-menu-list">
                <?php foreach ($categories_slugs as $category_slug) :
                    $category = get_category_by_slug($category_slug);
                    if ($category) : ?>
                        <li>
                            <a href="#<?php echo esc_attr($category_slug); ?>" class="mobile-menu-link"><?php echo esc_html($category->name); ?></a>
                        </li>
                    <?php endif;
                endforeach; ?>
            </ul>
        </div>

       <!-- Affichage des articles par catégorie -->
        <?php
        foreach ($categories_slugs as $category_slug) :
            $category = get_category_by_slug($category_slug);
            if ($category) :
                $args = array(
                    'category_name' => $category->slug,
                    'posts_per_page' => -1,
                    'post_type' => 'travaux-perso',
                    'post_status' => 'publish',
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    ?>
                    <h2 id="<?php echo esc_attr($category_slug); ?>" class="travaux-perso-category-title">
                        <span class="travaux-perso-category-title-text"><?php echo esc_html($category->name); ?></span>
                        <span class="travaux-perso-category-line"></span>
                    </h2>
                    <?php
                    echo '<div class="travaux-perso-gallery">';
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="travaux-perso-gallery-item">
                            <?php
                            $content = get_the_content();
                            $image = '';
                            if (preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches)) {
                                $image = $matches[1];
                            }
                            ?>
                            <img class="travaux-perso-gallery-img" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">

                            <div class="travaux-perso-description">
                                <h3 class="travaux-perso-title">&ldquo;<?php the_title(); ?>&rdquo;</h3>
                                <p class="travaux-perso-text"><?php echo wp_trim_words(wp_strip_all_tags(get_the_content()), 20); ?></p>
                            </div>
                        </div>
                    <?php endwhile;
                    echo '</div>';
                else :
                    echo '<p class="travaux-perso-no-articles">Aucun article trouvé pour "' . esc_html($category->name) . '".</p>';
                endif;

                wp_reset_postdata();
            else :
                echo '<p class="travaux-perso-category-missing">Catégorie "' . esc_html($category_slug) . '" introuvable.</p>';
            endif;
        endforeach;
        ?>
    </div>

    <?php if (current_user_can('administrator')) : ?>
    <div class="admin-buttons">
        <a href="<?php echo site_url('/modifier-travail-perso'); ?>" class="btn-edit">Modifier les Travaux Persos</a>
    </div>
<?php endif; ?>

<?php if (current_user_can('administrator')) : ?>
    <div class="add-work-container">
        <a href="<?php echo site_url('/nouveau-travail-perso'); ?>" class="btn-add-work">
            Ajouter un nouveau travail
        </a>
    </div>
<?php endif; ?>

</main>

<?php get_footer(); ?>
<?php wp_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuIcon = document.getElementById('mobile-menu-icon');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuButton = document.getElementById('close-mobile-menu');
        const menuOverlay = document.getElementById('mobile-menu-overlay');

        menuIcon.addEventListener('click', function () {
            mobileMenu.classList.add('open');
            menuOverlay.classList.add('visible');
        });

        closeMenuButton.addEventListener('click', function () {
            mobileMenu.classList.remove('open');
            menuOverlay.classList.remove('visible');
        });

        menuOverlay.addEventListener('click', function () {
            mobileMenu.classList.remove('open');
            menuOverlay.classList.remove('visible');
        });
    });
</script>

</body>
</html>
