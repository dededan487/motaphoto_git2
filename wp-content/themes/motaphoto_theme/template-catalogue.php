<?php
/*
Template Name: Catalog Template
*/

// Inclure l'en-tête du site
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div id="catalog"> <!-- Cette balise englobe les photos chargées via AJAX -->
            <!-- Boucle pour afficher les photos du CPT "photos" -->
            <?php
            // Arguments pour la requête WP_Query
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => 12,
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
            );

            // Créer une nouvelle requête WP_Query
            $query = new WP_Query($args);

            // Si des photos sont trouvées
            if ($query->have_posts()):
                // Compteur pour suivre le nombre d'images dans le bloc
                $counter = 0;

                // Boucle pour afficher chaque photo
                while ($query->have_posts()):
                    $query->the_post();

                    if ($counter % 2 === 0) {
                        // Ouvrir un nouveau bloc d'images pour chaque paire d'images
                        echo '<div class="image-block">';
                    }
                    ?>
                    <!-- Lien entourant l'icône pour activer la lightbox -->
                    <div class="related-thumbnail">
                        <a href="<?php the_permalink(); ?>" class="lightbox-trigger">
                            <span class="lightbox-icon">&#128269;</span>
                            <?php the_post_thumbnail('full', array('title' => get_the_title())); ?>
                        </a>
                    </div>
                    <?php
                    $counter++;

                    if ($counter % 2 === 0 || $counter === $query->post_count) {
                        // Fermer le bloc d'images si le compteur atteint 2 ou si c'est la dernière image
                        echo '</div>';
                    }
                endwhile;
                wp_reset_postdata(); // Réinitialiser les données de la requête
            else:
                echo 'Aucune photo trouvée.'; // Afficher un message si aucune photo n'est trouvée
            endif;
            ?>
        </div>

        <div id="load-more">
            <button id="load-more-button">Charger plus</button>
        </div>

        <!-- Ajout des champs de filtre (à conserver comme dans votre code) -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// Inclure le pied de page du site
get_footer();
?>
