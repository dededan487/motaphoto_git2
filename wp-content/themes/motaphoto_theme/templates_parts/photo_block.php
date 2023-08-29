<?php
// Récupère les catégories de la photo actuelle
$categories = get_the_terms(get_the_ID(), 'categorie_photo');

// Vérifie s'il existe des catégories et qu'elles ne sont pas des erreurs WP
if ($categories && !is_wp_error($categories)) {
    // Crée un tableau pour stocker les ID des catégories
    $category_ids = array();

    // Parcourt chaque catégorie pour obtenir son ID
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }

    // Requête WP_Query pour récupérer les articles des mêmes catégories
    $related_args = array(
        'post_type' => 'photos',
        // Type de contenu personnalisé 'photos'
        'posts_per_page' => 2,
        // Nombre d'articles à afficher
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie_photo',
                // Taxonomie 'categorie_photo'
                'field' => 'term_id',
                'terms' => $category_ids,
                // Utilisation des ID de catégorie récupérés
            ),
        ),
        'post__not_in' => array(get_the_ID()), // Exclure l'article actuel
    );

    // Crée une nouvelle instance WP_Query en utilisant les arguments
    $related_query = new WP_Query($related_args);

    // Vérifie si des articles apparentés ont été trouvés
    if ($related_query->have_posts()):
        ?>
        <div>
            <h2>Photos Apparentées</h2>
        </div>
        <div class="related-photos">

            <ul class="liens_apparentes">
                <?php
                // Parcourt chaque article apparenté
                while ($related_query->have_posts()):
                    $related_query->the_post();
                    ?>
                    <li>
                        <!-- Affiche un lien vers le permalien de l'article apparenté et son titre -->
                        <div class="related-thumbnail">
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
                            <?php the_post_thumbnail('full'); ?> <!-- Afficher la photo -->
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php
        // Réinitialise les données de l'article après la boucle
        wp_reset_postdata();
    endif;
}
?>