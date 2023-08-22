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
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <!-- Lien vers la photo -->
                    <div class="related-thumbnail">
                        <?php the_post_thumbnail('thumbnail'); ?> <!-- Afficher la miniature de la photo -->
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

        <!--------------------Ajout des champs de filtre ------------------------->
        <!-- Champ de sélection pour les catégories -->
        <select id="category-filter">
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
        <select id="format-filter">
            <option value="">Tous les formats</option>
            <option value="paysage">Paysage</option>
            <option value="portrait">Portrait</option>
        </select>

        <!-- Champ de sélection pour l'ordre de tri -->
        <select id="order-filter">
            <option value="DESC">Plus récentes</option>
            <option value="ASC">Plus anciennes</option>
        </select>




    </main><!-- #main -->
</div><!-- #primary -->

<?php
// Inclure le pied de page du site
get_footer();
?>