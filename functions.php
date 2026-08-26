<?php
/**
 * EMPC Theme Functions
 * Integración con WordPress 7.0 y Abilities API
 */

define('EMPC_THEME_DIR', get_template_directory());
define('EMPC_THEME_URI', get_template_directory_uri());

/**
 * Configuración básica del tema
 */
function empc_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    
    // Soporte para la nueva Abilities API de WP 7.0
    add_theme_support('abilities');
    
    register_nav_menus([
        'primary' => __('Menú Principal', 'empc-theme'),
        'footer' => __('Menú Footer', 'empc-theme')
    ]);
}
add_action('after_setup_theme', 'empc_theme_setup');

/**
 * 🤖 INTEGRACIÓN OFICIAL CON LA ABILITIES API (EMPC REACT THEME)
 */
add_action('wpai_register_features', function ($registry) {
    if (function_exists('wp_register_ability')) {
        wp_register_ability('empc/analyze-island-content', [
            'label'       => __('Analizar Servicio EMPC', 'empc-theme'),
            'description' => __('Expone la configuración JSON de las islas de React a Gemini.', 'empc-theme'),
            'category'    => 'site',
            'execute_callback' => function () {
                global $post;
                if (!$post) return [];

                $config = get_post_meta($post->ID, '_empc_service_config', true);
                if (empty($config)) {
                    $config = get_post_meta($post->ID, '_empc_react_config', true);
                }

                return [
                    'servicio'          => $post->post_title,
                    'detalles_tecnicos' => !empty($config) ? (is_string($config) ? json_decode($config, true) : $config) : null,
                    'contexto_marca'    => 'EMPC - Consultoría y desarrollo en León'
                ];
            },
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]);
    }
});

/**
 * Áreas de escritura para la IA
 */
add_action('init', function () {
    add_post_type_support('page', 'excerpt');
    add_post_type_support('page', 'custom-fields');
});

/**
 * Carga limpia de assets en el frontend (Optimización WPO)
 */
function empc_enqueue_react_assets()
{
    // Blindaje Admin / AJAX / REST
    if (is_admin() || wp_doing_ajax() || wp_doing_cron() || defined('REST_REQUEST')) {
        return;
    }

    // CSS de Tailwind siempre necesario para Header/Footer
    $react_css = get_template_directory_uri() . '/react-app/assets/main.css';
    $react_css_path = EMPC_THEME_DIR . '/react-app/assets/main.css';
    if (file_exists($react_css_path)) {
        wp_enqueue_style('empc-react-styles', $react_css, [], filemtime($react_css_path));
    }

    // Lógica de carga condicional
    global $post;
    $content = isset($post->post_content) ? $post->post_content : '';
    $template = get_post_meta(get_the_ID(), '_wp_page_template', true);
    $has_meta = get_post_meta(get_the_ID(), '_empc_service_config', true) || get_post_meta(get_the_ID(), '_empc_react_config', true);

    if (is_front_page() || strpos($content, 'id="island-') !== false || $template === 'page-service.php' || $has_meta) {
        $react_js = get_template_directory_uri() . '/react-app/assets/app.js';
        $react_js_path = EMPC_THEME_DIR . '/react-app/assets/app.js';
        
        if (file_exists($react_js_path)) {
            wp_enqueue_script('empc-react', $react_js, [], filemtime($react_js_path), [
                'strategy' => 'defer',
                'in_footer' => true
            ]);

            wp_localize_script('empc-react', 'empcData', [
                'apiUrl' => get_rest_url(null, 'wp/v2/'),
                'themeUri' => get_template_directory_uri(),
                'siteUrl' => home_url()
            ]);
        }
    }
}
add_action('wp_enqueue_scripts', 'empc_enqueue_react_assets');

/**
 * Compatibilidad con módulos ESM de React Islands en WP 7.0
 */
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if (strpos($handle, 'empc-react') !== false) {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}, 10, 3);

/**
 * Laboratorio IA EMPC — ruta local sin tocar producción
 */
if (!function_exists('empc_is_laboratorio_ia_request')) {
    function empc_is_laboratorio_ia_request(): bool
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $path = trim($path, '/');

        return $path === 'laboratorio-ia' || str_starts_with($path, 'laboratorio-ia/');
    }
}

add_action('wp_enqueue_scripts', function () {
    if (!empc_is_laboratorio_ia_request()) {
        return;
    }

    $react_css = get_template_directory_uri() . '/react-app/assets/main.css';
    $react_css_path = EMPC_THEME_DIR . '/react-app/assets/main.css';

    if (file_exists($react_css_path)) {
        wp_enqueue_style('empc-lab-main', $react_css, [], filemtime($react_css_path));
    }
}, 4);

add_filter('pre_get_document_title', function ($title) {
    if (empc_is_laboratorio_ia_request()) {
        return 'Laboratorio IA: prompts y workflows en español | EMPC';
    }

    return $title;
});

add_filter('body_class', function ($classes) {
    if (empc_is_laboratorio_ia_request()) {
        $classes[] = 'laboratorio-ia-page';
    }

    return $classes;
});

// SEO handled by the Laboratory IA template.

add_action('template_redirect', function () {
    if (!empc_is_laboratorio_ia_request()) {
        return;
    }

    $template = locate_template('page-laboratorio-ia.php');
    if (!$template) {
        status_header(500);
        wp_die(__('No se encontró la plantilla del Laboratorio IA.', 'empc-theme'));
    }

    global $wp_query;
    $wp_query->is_404 = false;
    status_header(200);
    nocache_headers();

    include $template;
    exit;
}, 1);
