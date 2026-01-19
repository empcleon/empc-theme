<?php
/**
 * EMPC Theme - Functions
 * 
 * Tema híbrido WordPress + React
 * 
 * @package EMPC_Theme
 */

// Constantes
define('EMPC_THEME_VERSION', '1.0.0');
define('EMPC_THEME_DIR', get_template_directory());
define('EMPC_THEME_URI', get_template_directory_uri());

/**
 * Configuración inicial del tema
 */
function empc_theme_setup()
{
    // Soporte para título del sitio
    add_theme_support('title-tag');

    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');

    // Soporte para HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);

    // Registrar menú
    register_nav_menus([
        'primary' => __('Menú Principal', 'empc-theme'),
        'footer' => __('Menú Footer', 'empc-theme')
    ]);
}
add_action('after_setup_theme', 'empc_theme_setup');

/**
 * Cargar assets de React
 */
function empc_enqueue_scripts()
{
    $react_css = EMPC_THEME_DIR . '/react-app/assets/styles.css';
    $react_js = EMPC_THEME_DIR . '/react-app/assets/app.js';

    // CSS de React
    if (file_exists($react_css)) {
        wp_enqueue_style(
            'empc-react-styles',
            EMPC_THEME_URI . '/react-app/assets/styles.css',
            [],
            filemtime($react_css)
        );
    }

    // JavaScript de React
    if (file_exists($react_js)) {
        wp_enqueue_script(
            'empc-react-app',
            EMPC_THEME_URI . '/react-app/assets/app.js',
            [],
            filemtime($react_js),
            true
        );
    }

    // Estilos del tema
    wp_enqueue_style(
        'empc-theme-style',
        get_stylesheet_uri(),
        [],
        EMPC_THEME_VERSION
    );
}
add_action('wp_enqueue_scripts', 'empc_enqueue_scripts');

/**
 * Añadir type="module" al script de React
 */
function empc_script_type_module($tag, $handle, $src)
{
    if ($handle === 'empc-react-app') {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'empc_script_type_module', 10, 3);

/**
 * Shortcode para insertar la app React en cualquier página
 */
function empc_react_shortcode($atts)
{
    return '<div id="root" class="empc-react-container"></div>';
}
add_shortcode('empc_react', 'empc_react_shortcode');

/**
 * Pasar datos de WordPress a React
 */
function empc_localize_data()
{
    $data = [
        'siteUrl' => home_url(),
        'restUrl' => rest_url('wp/v2/'),
        'nonce' => wp_create_nonce('wp_rest'),
        'isLoggedIn' => is_user_logged_in()
    ];

    wp_localize_script('empc-react-app', 'empcData', $data);
}
add_action('wp_enqueue_scripts', 'empc_localize_data');
