<?php
/*
Template Name: CPT Perso
template Podt Type: post, page, product
*/
?>

<?php get_header(); ?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


                <div class="entry-content">
                    <div class="format_single">
                        <header class="entry-header">
                            <h1>
                                <?php the_title(); ?> <!-- Affiche le titre de l'article -->
                            </h1>
                        </header>

                        <p><strong>Référence :</strong>
                            <?php echo get_field('reference'); ?> <!-- Affiche le champ "reference" du CPT -->
                        </p>

                        <?php
                        $categories = get_the_terms(get_the_ID(), 'categorie_photo');
                        if ($categories && !is_wp_error($categories)) {
                            echo '<p><strong>Categories :</strong> ';
                            foreach ($categories as $category) {
                                echo $category->name . ' '; // Affiche les catégories du CPT
                            }
                            echo '</p>';
                        }
                        ?>

                        <?php
                        $formats = get_the_terms(get_the_ID(), 'format');
                        if ($formats && !is_wp_error($formats)) {
                            echo '<p><strong>Formats :</strong> ';
                            foreach ($formats as $format) {
                                echo $format->name . ' '; // Affiche les formats du CPT
                            }
                            echo '</p>';
                        }
                        ?>

                        <p><strong>Type :</strong>
                            <?php echo get_field('type'); ?> <!-- Affiche le champ "type" du CPT -->
                        </p>

                        <p><strong>Année :</strong>
                            <?php echo get_field('annee'); ?> <!-- Affiche le champ "annee" du CPT -->
                        </p>
                    </div>

                    <div class="photo-container">
                        <?php the_post_thumbnail('full'); ?> <!-- Affiche l'image à la taille "full" -->
                    </div>

                </div>

                <?php the_content(); ?> <!-- Affiche le contenu de l'article -->
                <div class="pied_image">
                    <span class="texte_img"> Cette photo vous intéresse ? </span>
                    <!-- Bouton pour ouvrir la popup -->
                    <button class="open-popup"
                        data-reference="<?php echo esc_attr(get_field('reference')); ?>">Contact</button>

                    <!-- Ajout des miniatures et boutons de pagination -->
                    <div class="pagination-container">
                        <!--conteneur pour les miniatures et les boutons de pagination -->
                        <?php
                        // Ouvre une balise PHP pour exécuter du code PHP à l'intérieur du HTML
                    
                        $previous_photo = get_previous_post();
                        // Récupère l'article précédent dans le flux de publications
                    
                        $next_photo = get_next_post();
                        // Récupère l'article suivant dans le flux de publications
                        ?>

                        <?php if ($previous_photo): ?>
                            <!-- vérifie si un article précédent existe -->

                            <a href="<?php echo get_permalink($previous_photo->ID); ?>"
                                class="previous-photo thumbnail-preview">
                                <!-- lien vers l'article précédent avec la classe "previous-photo" et "thumbnail-preview" -->
                                <span class="pagination-label">&larr;</span>
                                <!--  chevron pointant vers la gauche -->
                                <?php echo get_the_post_thumbnail($previous_photo->ID, 'thumbnail'); ?>
                                <!-- miniature de l'article précédent avec la taille "thumbnail" -->
                            </a>
                        <?php endif; ?>
                        <!-- Ferme la structure conditionnelle pour l'article précédent -->

                        <?php if ($next_photo): ?>
                            <!-- vérifie si un article suivant existe -->

                            <a href="<?php echo get_permalink($next_photo->ID); ?>" class="next-photo thumbnail-preview">
                                <!-- lien vers l'article suivant avec la classe "next-photo" et "thumbnail-preview" -->
                                <span class="pagination-label"> &rarr; </span>
                                <!-- chevron pointant vers la droite -->
                                <?php echo get_the_post_thumbnail($next_photo->ID, 'thumbnail'); ?>
                                <!-- miniature de l'article suivant avec la taille "thumbnail" -->
                            </a>
                        <?php endif; ?>
                        <!-- Ferme la structure conditionnelle pour l'article suivant -->
                    </div>
                    <!-- Ferme le conteneur des miniatures et boutons de pagination -->
                </div>
                <?php get_template_part('templates_parts/photo_block'); ?>
                <!-- Inclut le template pour les photos apparentées -->
            </article>

        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?> <!-- Inclut le footer -->

<?php wp_footer(); ?> <!-- Inclut le script du footer -->

<!-- Script jQuery pour ouvrir la modale et préremplir le champ "RÉF. PHOTO" -->
<script>
    jQuery(document).ready(function (jQuery) {
        jQuery('.open-popup').click(function () {
            var reference = jQuery(this).data('reference');
            // Ouvrir la modale 
            jQuery('#myModal').show();

            // Préremplir le champ "RÉF. PHOTO" du formulaire de contact
            jQuery('#ref_photo').val(reference);

        });
    });
</script>

</body>

</html> <!-- Fin du document HTML -->