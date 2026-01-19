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
 * Cargar assets de React (Siempre versión compilada para estabilidad)
 */
function empc_load_scripts()
{
    // Cargamos siempre los archivos generados en 'react-app'
    $react_css = get_template_directory_uri() . '/react-app/assets/main.css';
    $react_js = get_template_directory_uri() . '/react-app/assets/app.js';

    // Importante: La ruta base para validar file_exists debe ser del sistema de archivos, no URL
    $react_css_path = EMPC_THEME_DIR . '/react-app/assets/main.css';
    $react_js_path = EMPC_THEME_DIR . '/react-app/assets/app.js';

    if (file_exists($react_css_path)) {
        wp_enqueue_style('empc-react-styles', $react_css, [], filemtime($react_css_path));
    }

    if (file_exists($react_js_path)) {
        wp_enqueue_script('empc-react', $react_js, [], filemtime($react_js_path), true);
    }

    // Estilos del tema base
    wp_enqueue_style('empc-theme-style', get_stylesheet_uri(), [], EMPC_THEME_VERSION);
}
add_action('wp_enqueue_scripts', 'empc_load_scripts');

/**
 * Filtro para añadir type="module" (necesario para Vite y módulos ES)
 */
function empc_script_type_module($tag, $handle, $src)
{
    if (in_array($handle, ['vite-client', 'empc-react'])) {
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

    wp_localize_script('empc-react', 'empcData', $data);
}
add_action('wp_enqueue_scripts', 'empc_localize_data');

/**
 * REST API Endpoint para Formulario de Contacto
 */
add_action('rest_api_init', function () {
    register_rest_route('empc/v1', '/contact', [
        'methods' => 'POST',
        'callback' => 'empc_handle_contact_form',
        'permission_callback' => '__return_true' // Validamos nonce manualmente si es necesario, o lo dejamos abierto con rate limit (pendiente)
    ]);
});

function empc_handle_contact_form($request)
{
    $params = $request->get_json_params();

    // Validar datos básicos
    if (empty($params['email']) || empty($params['message'])) {
        return new WP_Error('missing_params', 'Faltan datos obligatorios', ['status' => 400]);
    }

    $to = 'empcleon@gmail.com';
    $subject = 'Nuevo Lead Web: ' . sanitize_text_field($params['name']);
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    $message = "
    <h2>Nuevo mensaje de contacto</h2>
    <p><strong>Nombre:</strong> " . sanitize_text_field($params['name']) . "</p>
    <p><strong>Email:</strong> " . sanitize_email($params['email']) . "</p>
    <p><strong>Servicio:</strong> " . sanitize_text_field($params['service']) . "</p>
    <p><strong>Mensaje:</strong><br>" . nl2br(sanitize_textarea_field($params['message'])) . "</p>
    <hr>
    <p><small>Enviado desde empc.es</small></p>
    ";

    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        return new WP_REST_Response(['status' => 'success', 'message' => 'Email enviado correctamente'], 200);
    } else {
        return new WP_Error('cant_send', 'Error al enviar email', ['status' => 500]);
    }
}
