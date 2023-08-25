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

  // Enqueue les styles pour le menu de navigation
  wp_enqueue_style('styles2', get_template_directory_uri() . '/css/customs.css');

  // Enqueue le style principal
  wp_enqueue_style('styler', get_template_directory_uri() . '/style.css');

  // Enqueue le script pour filtrer les photos
  wp_enqueue_script('filter-photos', get_template_directory_uri() . '/js/filter-photos.js', array(), '1.0', true);

  // Transmettre des données JavaScript au script filter-photos.js
  wp_localize_script(
    'filter-photos',
    'filter_photos',
    array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('filter-photos-nonce')
    )
  );
}

add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');



// Cette fonction affiche le contenu d'un shortcode dans l'en-tête du site WordPress.
function afficher_shortcode_dans_entete()
{
  echo do_shortcode('[simple_modal]');
}

//fonction Pour les images carrées




function load_more_photos_scripts()
{
  // Charge le script 'load-more-photos.js' avec jQuery comme dépendance
  wp_enqueue_script('load-more-photos', get_template_directory_uri() . '/js/load-more-photos.js', array('jquery'), '1.0', true);

  // Transmet des données JavaScript au script 'load-more-photos.js'
  wp_localize_script(
    'load-more-photos',
    'load_more_photos',
    array(
      'ajax_url' => admin_url('admin-ajax.php'),
      // URL de l'API AJAX de WordPress
      'nonce' => wp_create_nonce('load-more-photos-nonce') // Génère un jeton de sécurité
    )
  );
}
// Ajoute l'action pour enregistrer et charger les scripts
add_action('wp_enqueue_scripts', 'load_more_photos_scripts');

function load_more_photos()
{
  // Vérifie le jeton de sécurité pour les requêtes AJAX
  check_ajax_referer('load-more-photos-nonce', 'security');

  // Récupère le numéro de page à charger depuis les données POST
  $paged = $_POST['page'];

  // Paramètres de la requête WP_Query pour récupérer les photos
  $args = array(
    'post_type' => 'photos',
    // Type de contenu personnalisé 'photos'
    'posts_per_page' => 12,
    // Nombre de photos par page
    'paged' => $paged, // Numéro de page
  );

  // Exécute la requête WP_Query
  $query = new WP_Query($args);

  // Vérifie si des photos sont trouvées dans la requête
  if ($query->have_posts()):
    while ($query->have_posts()):
      $query->the_post();
      ?>
      <!-- Affiche le lien vers la page de la photo et le titre de la photo -->
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <!-- Affiche la miniature de la photo -->
      <div class="related-thumbnail">
        <?php the_post_thumbnail('thumbnail'); ?>
        <?php the_title(); ?>
      </div>
      <?php
    endwhile;
    wp_reset_postdata();
  else:
    echo 'No more photos.'; // Aucune photo trouvée
  endif;

  die(); // Termine l'exécution du script
}
// Ajoute l'action pour gérer la requête AJAX lorsque l'utilisateur est connecté
add_action('wp_ajax_load_more_photos', 'load_more_photos');
// Ajoute l'action pour gérer la requête AJAX lorsque l'utilisateur n'est pas connecté
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


//------------- fonction de filtrage ------------------
function filter_photos()
{
  check_ajax_referer('load-more-photos-nonce', 'nonce'); // Vérifie le jeton de sécurité

  $category = $_POST['category']; // Catégorie sélectionnée dans le champ
  $format = $_POST['format']; // Format sélectionné dans le champ
  $order = $_POST['order']; // Récupérer la valeur de l'ordre de tri depuis les données POST

  // Paramètres de la requête WP_Query
  $args = array(
    'post_type' => 'photos',
    'posts_per_page' => 12,
    'paged' => 1,
    'orderby' => 'meta_value_num', // Tri par valeur numérique (année)
    'meta_key' => 'annee', //tri pour l'année    
    'order' => $order, // Utilisation de la valeur sélectionnée
  );

  // Si une catégorie est sélectionnée, ajouter la taxonomie à la requête
  if (!empty($category)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'categorie_photo',
        'field' => 'term_id',
        'terms' => $category,
      ),
    );
  }

  // Si un format est sélectionné, ajouter la taxonomie à la requête
  if (!empty($format)) {
    // Si une taxonomie "format" existe

    $args['tax_query'][] = array(
      'taxonomy' => 'format',
      'field' => 'slug',
      'terms' => $format,
    );

  }


  // Exécuter la requête WP_Query
  $query = new WP_Query($args);

  if ($query->have_posts()):
    while ($query->have_posts()):
      $query->the_post();
      // Affiche les photos filtrées de la même manière que dans load_more_photos()
      ?>
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <div class="related-thumbnail">
        <?php the_post_thumbnail('thumbnail'); ?>
        <?php the_title(); ?>
      </div>
      <?php
    endwhile;
    wp_reset_postdata();
  else:
    echo 'Aucune photo trouvée.';
  endif;

  die(); // Terminer le script AJAX
}

add_action('wp_ajax_filter_photos', 'filter_photos'); // Action pour utilisateur connecté
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos'); // Action pour utilisateur non connecté
