<footer>
    <div class="footer-container">
        <!-- Message de remerciement -->
        <p class="footer-message">Merci et à bientôt !</p>
        <p class="footer-copyright">&copy; <?php echo date("Y"); ?> Créé par Ronan Lefour</p>

        <!-- Icônes de réseaux sociaux -->
        <div class="footer-social">
            <a href="mailto:ronan@example.com" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/img/gmail-icon.svg" alt="Email">
            </a>
            <a href="tel:+33612345678" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/img/phone-icon.svg" alt="Phone">
            </a>
            <a href="https://www.linkedin.com/in/ronanlefour" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/img/linkedin-icon.svg" alt="LinkedIn">
            </a>
            <a href="https://www.behance.net/ronanlefour" target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/img/behance-icon.svg" alt="Behance">
            </a>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
