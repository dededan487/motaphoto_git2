<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- J'ouvre la balise HTML et déclare les attributs de langue du site -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <!-- J'ajoute la balise méta pour définir le jeu de caractères du site, basé sur les paramètres de WordPress -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- J'ajoute la balise méta pour définir la largeur de l'affichage et l'échelle initiale pour les appareils mobiles -->

    <title>
        <?php bloginfo('name'); ?> |
        <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
    </title>
    <!-- J'ajoute le titre de la page, comprenant le nom du site et la description de la page d'accueil ou le titre de la page actuelle -->

    <?php wp_head(); ?>
    <!-- J'appelle la fonction wp_head() pour inclure les scripts et les styles nécessaires dans l'en-tête du site -->
</head>

<body <?php body_class(); ?>>
<!-- J'ouvre la balise body et j'ajoute des classes dynamiques qui dépendent de la page affichée -->

    <nav id="navigation">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Titre">
        <!-- J'ajoute une image du logo en utilisant le chemin du modèle de thème -->

        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="menu-icon"></span>
        </button>

        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'main-menu',
                'menu_id' => 'primary-menu',
            )
        );
        ?>
        <!-- J'appelle la fonction wp_nav_menu() pour afficher le menu de navigation principal, basé sur l'emplacement "main-menu" -->

    </nav>

    <?php afficher_shortcode_dans_entete(); ?>
    <!-- J'appelle la fonction personnalisée "afficher_shortcode_dans_entete()" pour afficher un shortcode spécifique dans l'en-tête -->
