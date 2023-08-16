<?php
function register_my_menu()
{
  register_nav_menu('main-menu', 'Menu principal');
}
add_action('after_setup_theme', 'register_my_menu');

function enqueue_scripts_and_styles()
{

  // Enqueue les styles pour le menu de navigation
  wp_enqueue_style('menu-styles', get_template_directory_uri() . '/styles_css_rajout/style_menu_nav.css');

  // Enqueue le style principal
  wp_enqueue_style('styler', get_template_directory_uri() . '/style.css');

}
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');


// Cette fonction affiche le contenu d'un shortcode dans l'en-tête du site WordPress.
function afficher_shortcode_dans_entete()
{
  echo do_shortcode('[simple_modal]');
}