<?php wp_footer(); ?>

<footer id="footer" class="site-footer" role="contentinfo">
    <div class="footer-content">
        <div class="footer-links">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('mentions-legales'))); ?>">Mentions légales</a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('RGPD'))); ?>">Vie privée</a>

        </div>
        <p class="footer-text">Tous droits réservés</p>
    </div>

    <div id="lightbox-overlay" class="lightbox-overlay"></div>

<div id="lightbox" class="lightbox">
    <span class="close-lightbox">&times;</span>
    <div class="lightbox-content">
        <div class="lightbox-image-container">
            <img src="" alt="" class="lightbox-image">
            <span class="photo-title"></span>
        </div>
        <div class="lightbox-info1">
            
            <div class="lightbox-navigation">
                <span class="pagination-label previous-photo">&larr;</span>
                <span class="pagination-label next-photo">&rarr;</span>
            </div>
        </div>
    </div>
</div>

</footer>

</body>

</html>