<?php get_header(); ?>

<main id="primary" class="content-area">
    <div id="main" class="site-main" role="main">

        <?php
        // Le contenu de la page d'accueil
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>

    </div><!-- #main -->
</main><!-- #primary -->

<?php get_footer(); ?>
