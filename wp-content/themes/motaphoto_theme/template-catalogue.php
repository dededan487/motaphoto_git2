<?php
/*
Template Name: Catalog Template
*/

// Inclure l'en-tête du site
get_header();
?>
<?php require 'templates_parts/header_bandeau.php'; ?>

<main id="main" class="site-main" role="main">

    <div id="primary" class="content-area">

        <div class="filtres">
            <!-- Ajout des champs de filtre -->
            <!-- Champ de sélection pour les catégories -->
            <select id="category-filter" class="filter-range">
                <option value="">Toutes les catégories</option>
                <?php
                // Récupérer la liste des termes de la taxonomie 'categorie_photo'
                $categories = get_terms('categorie_photo');
                foreach ($categories as $category) {
                    echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                }
                ?>
            </select>
            <!-- Champ de sélection pour les formats -->
            <select id="format-filter" class="filter-range">
                <option value="">Tous les formats</option>
                <option value="paysage">Paysage</option>
                <option value="portrait">Portrait</option>
            </select>
            <span></span>
            <!-- Champ de sélection pour l'ordre de tri -->
            <select id="order-filter" class="filter-range">
                <option value="DESC">Plus récentes</option>
                <option value="ASC">Plus anciennes</option>
            </select>
        </div>

        <div id="catalog"> <!-- Cette balise englobe les photos chargées via AJAX -->
            <!-- Boucle pour afficher les photos du CPT "photos" -->
            <?php
            // Arguments pour la requête WP_Query
            $args = array(
                'post_type' => 'photos',
                // Utiliser le CPT "photos"
                'posts_per_page' => 12,
                // Nombre de photos à afficher par page
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Pagination
            );

            // Créer une nouvelle requête WP_Query
            $query = new WP_Query($args);

            // Si des photos sont trouvées
            if ($query->have_posts()):
                // Boucle pour afficher chaque photo
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <div class="related-thumbnail image-galerie">
                        <h3 class="titre_categorie">
                            <span class="titre1">
                                <?php the_title(); ?>
                            </span> <!-- Affiche le titre de l'article -->
                            <span class="categorie1">
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'categorie_photo');
                                if ($categories && !is_wp_error($categories)) {
                                    echo '<p>';
                                    foreach ($categories as $category) {
                                        echo $category->name . ' '; // Affiche les catégories du CPT
                                    }
                                    echo '</p>';
                                }
                                ?>
                            </span>
                        </h3>
                        
                        <div class="eye-icon">
                            <a href="<?php the_permalink(); ?>" class="liens">&#128065;</a>
                            <!-- Lien vers la photo (icône d'œil) -->

                        </div>

                        <span class="screen-icon liens" data-fancybox="gallery"
                            data-src="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"> &#128437;
                        </span>

                        <?php the_post_thumbnail('full'); ?> <!-- Afficher la photo -->
                    </div>

                    <?php
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


    </div><!-- #primary -->
</main><!-- #main -->
</div>


<?php
// Inclure le pied de page du site
get_footer();
?>