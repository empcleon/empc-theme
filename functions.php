<?php
/**
 * EMPC Theme Functions
 * Integración con WordPress 7.0 y Abilities API
 */

define('EMPC_THEME_DIR', get_template_directory());
define('EMPC_THEME_URI', get_template_directory_uri());

foreach ([
    EMPC_THEME_DIR . '/inc/service-pages-data.php',
    EMPC_THEME_DIR . '/inc/service-pages-config.php',
] as $empc_include_file) {
    if (file_exists($empc_include_file)) {
        require_once $empc_include_file;
    }
}

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

            $shared_frontend_data = [
                'themeUri'  => get_template_directory_uri(),
                'siteUrl'   => home_url('/'),
                'restUrl'   => esc_url_raw(rest_url()),
                'nonce'     => wp_create_nonce('wp_rest'),
                'isLoggedIn' => is_user_logged_in(),
                'postConfig' => null,
            ];

            wp_localize_script('empc-react', 'empcData', array_merge($shared_frontend_data, [
                'apiUrl' => esc_url_raw(rest_url('wp/v2/')),
            ]));

            wp_localize_script('empc-react', 'empcConfig', array_merge($shared_frontend_data, [
                'apiUrl' => esc_url_raw(rest_url()),
            ]));
        }
    }
}
add_action('wp_enqueue_scripts', 'empc_enqueue_react_assets');

/**
 * REST helpers for the public forms.
 */
if (!function_exists('empc_normalize_frontend_payload')) {
    function empc_normalize_frontend_payload(WP_REST_Request $request): array
    {
        $payload = $request->get_json_params();
        if (!is_array($payload)) {
            $payload = [];
        }

        return array_merge($request->get_params(), $payload);
    }
}

if (!function_exists('empc_mail_recipient')) {
    function empc_mail_recipient(): string
    {
        $recipient = get_option('admin_email');
        return is_email($recipient) ? $recipient : get_bloginfo('admin_email');
    }
}

if (!function_exists('empc_rest_error')) {
    function empc_rest_error(string $message, int $status = 400): WP_REST_Response
    {
        return new WP_REST_Response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}

add_action('rest_api_init', function () {
    register_rest_route('empc/v1', '/contact', [
        'methods' => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'callback' => function (WP_REST_Request $request) {
            $data = empc_normalize_frontend_payload($request);

            $name = sanitize_text_field((string) ($data['name'] ?? $data['nombre'] ?? ''));
            $email = sanitize_email((string) ($data['email'] ?? ''));
            $phone = sanitize_text_field((string) ($data['telefono'] ?? $data['phone'] ?? ''));
            $service = sanitize_text_field((string) ($data['service'] ?? $data['tipo'] ?? ''));
            $message = sanitize_textarea_field((string) ($data['message'] ?? $data['mensaje'] ?? ''));
            $budget = sanitize_text_field((string) ($data['presupuesto'] ?? ''));
            $consent = !empty($data['consent']) || !empty($data['privacyConsent']) || !empty($data['acceptPrivacy']) || !empty($data['acepto']);

            if ($name === '' || $email === '' || $service === '' || $message === '') {
                return empc_rest_error('Faltan campos obligatorios en el formulario de contacto.', 400);
            }

            if (!is_email($email)) {
                return empc_rest_error('El correo electrónico no es válido.', 400);
            }

            if (!$consent && isset($data['consent']) || !$consent && isset($data['privacyConsent'])) {
                return empc_rest_error('Debes aceptar la política de privacidad para continuar.', 400);
            }

            $subject = sprintf('[EMPC] Nuevo contacto: %s', $service);
            $body = implode("\n", array_filter([
                'Nuevo mensaje recibido desde la web EMPC.',
                'Nombre: ' . $name,
                'Email: ' . $email,
                $phone !== '' ? 'Teléfono: ' . $phone : '',
                'Servicio: ' . $service,
                $budget !== '' ? 'Presupuesto: ' . $budget : '',
                '',
                'Mensaje:',
                $message,
            ]));

            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                'Reply-To: ' . $name . ' <' . $email . '>',
            ];

            $sent = wp_mail(empc_mail_recipient(), $subject, $body, $headers);

            if (!$sent) {
                return empc_rest_error('No se ha podido enviar el mensaje. Inténtalo de nuevo más tarde.', 500);
            }

            return rest_ensure_response([
                'success' => true,
                'message' => 'Mensaje enviado correctamente.',
            ]);
        },
    ]);

    register_rest_route('empc/v1', '/budget', [
        'methods' => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'callback' => function (WP_REST_Request $request) {
            $data = empc_normalize_frontend_payload($request);

            $name = sanitize_text_field((string) ($data['name'] ?? $data['nombre'] ?? ''));
            $email = sanitize_email((string) ($data['email'] ?? ''));
            $budget_data = $data['budget_data'] ?? [];
            if (!is_array($budget_data)) {
                $budget_data = [];
            }

            $type = sanitize_text_field((string) ($budget_data['type'] ?? ''));
            $mode = sanitize_text_field((string) ($budget_data['mode'] ?? ''));
            $estimated_range = $budget_data['estimated_range'] ?? [];
            $features = $budget_data['features'] ?? [];

            if ($name === '' || $email === '' || $type === '') {
                return empc_rest_error('Faltan campos obligatorios para calcular el presupuesto.', 400);
            }

            if (!is_email($email)) {
                return empc_rest_error('El correo electrónico no es válido.', 400);
            }

            $features_text = '';
            if (is_array($features)) {
                $features_text = implode(', ', array_map('sanitize_text_field', $features));
            } else {
                $features_text = sanitize_text_field((string) $features);
            }

            $range_text = '';
            if (is_array($estimated_range)) {
                $min = isset($estimated_range['min']) ? (int) $estimated_range['min'] : null;
                $max = isset($estimated_range['max']) ? (int) $estimated_range['max'] : null;
                if ($min !== null && $max !== null) {
                    $range_text = $min . '€ - ' . $max . '€';
                }
            }

            $subject = sprintf('[EMPC] Presupuesto solicitado: %s', $type);
            $body = implode("\n", array_filter([
                'Nueva solicitud de presupuesto desde la web EMPC.',
                'Nombre: ' . $name,
                'Email: ' . $email,
                'Tipo: ' . $type,
                $mode !== '' ? 'Modo: ' . $mode : '',
                $features_text !== '' ? 'Extras: ' . $features_text : '',
                $range_text !== '' ? 'Rango estimado: ' . $range_text : '',
            ]));

            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                'Reply-To: ' . $name . ' <' . $email . '>',
            ];

            $sent = wp_mail(empc_mail_recipient(), $subject, $body, $headers);

            if (!$sent) {
                return empc_rest_error('No se ha podido enviar el presupuesto. Inténtalo de nuevo más tarde.', 500);
            }

            return rest_ensure_response([
                'success' => true,
                'message' => 'Presupuesto enviado correctamente.',
            ]);
        },
    ]);
});

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
