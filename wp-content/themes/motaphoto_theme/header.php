<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?php bloginfo('name'); ?> |
        <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
    </title>


    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

        <nav id="navigation">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Titre">
        
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'main-menu',
                    'menu_id' => 'primary-menu',
                )
            );
            ?>
        </nav>

        
        <div class="header-container">
        
            <img src="<?php echo get_template_directory_uri(); ?>/assets/nathalie-11.jpeg" alt="Main Photo"
                class="main-photo" id="nathalie">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/Titre%20header.png" alt="Titre"
                class="header-title-image">
        </div>

<?php afficher_shortcode_dans_entete(); ?>


 

       