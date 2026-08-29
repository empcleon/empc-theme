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
    EMPC_THEME_DIR . '/inc/seo-social-schema.php',
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

    if (is_front_page() || is_page('contacta-conmigo') || strpos($content, 'id="island-') !== false || $template === 'page-service.php' || $has_meta) {
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

if (!function_exists('empc_force_specific_page_templates')) {
    function empc_force_specific_page_templates(string $template): string
    {
        $routes = [
            'contacta-conmigo' => 'page-contacta-conmigo.php',
            'mantenimiento-wordpress-leon' => 'page-mantenimiento-wordpress-leon.php',
            'alquiler-pagina-web-empresas-y-autonomos' => 'page-alquiler-pagina-web-empresas-y-autonomos.php',
        ];

        foreach ($routes as $slug => $file) {
            if (is_page($slug)) {
                $located = locate_template($file);
                if ($located) {
                    return $located;
                }
            }
        }

        return $template;
    }
}

add_filter('template_include', 'empc_force_specific_page_templates');

if (!function_exists('empc_cleanup_request_path')) {
    function empc_cleanup_request_path(): string
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        return '/' . trim($path, '/');
    }
}

if (!function_exists('empc_cleanup_query_args')) {
    function empc_cleanup_query_args(): array
    {
        $query = [];
        parse_str(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_QUERY) ?? '', $query);
        return is_array($query) ? $query : [];
    }
}

if (!function_exists('empc_canonical_blog_redirect')) {
    function empc_canonical_blog_redirect(): void
    {
        if (is_admin() || wp_doing_ajax() || wp_doing_cron() || (defined('REST_REQUEST') && REST_REQUEST)) {
            return;
        }

        $path = trim(empc_cleanup_request_path(), '/');
        $query = empc_cleanup_query_args();

        $needs_redirect = in_array($path, ['blog-nuevo', 'blog-empc'], true)
            || (isset($query['page_id']) && (string) $query['page_id'] === '30607');

        if (!$needs_redirect) {
            return;
        }

        unset($query['page_id']);
        $target = home_url('/blog/');
        if (!empty($query)) {
            $target = add_query_arg($query, $target);
        }

        wp_safe_redirect($target, 301);
        exit;
    }
}

add_action('template_redirect', 'empc_canonical_blog_redirect', 0);

if (!function_exists('empc_reject_front_page_pagination')) {
    function empc_reject_front_page_pagination(): void
    {
        if (!is_front_page() || !is_paged()) {
            return;
        }

        global $wp_query;
        $wp_query->set_404();
        $GLOBALS['empc_front_page_pagination_404'] = true;
        status_header(404);
        nocache_headers();
    }
}

add_action('template_redirect', 'empc_reject_front_page_pagination', 1);

if (!function_exists('empc_disable_front_page_pagination_canonical_redirect')) {
    function empc_disable_front_page_pagination_canonical_redirect($redirect_url, $requested_url)
    {
        if (!empty($GLOBALS['empc_front_page_pagination_404'])) {
            return false;
        }

        return $redirect_url;
    }
}

add_filter('redirect_canonical', 'empc_disable_front_page_pagination_canonical_redirect', 10, 2);

if (!function_exists('empc_remove_front_page_pagination_canonical')) {
    function empc_remove_front_page_pagination_canonical($canonical)
    {
        if (!empty($GLOBALS['empc_front_page_pagination_404'])) {
            return false;
        }

        return $canonical;
    }
}

add_filter('rank_math/frontend/canonical', 'empc_remove_front_page_pagination_canonical', 999);

if (!function_exists('empc_remove_front_page_pagination_core_canonical')) {
    function empc_remove_front_page_pagination_core_canonical(): void
    {
        if (empty($GLOBALS['empc_front_page_pagination_404'])) {
            return;
        }

        remove_action('wp_head', 'rel_canonical');

        global $wp_filter;
        $callbacks = $wp_filter['rank_math/head']->callbacks ?? [];
        foreach ($callbacks as $priority => $hooks) {
            foreach ($hooks as $hook) {
                $callback = $hook['function'] ?? null;
                if (is_array($callback) && isset($callback[1]) && $callback[1] === 'canonical') {
                    remove_action('rank_math/head', $callback, $priority);
                }
            }
        }
    }
}

add_action('wp_head', 'empc_remove_front_page_pagination_core_canonical', -1);

if (!function_exists('empc_seo_cleanup_robots_context')) {
    function empc_seo_cleanup_robots_context(): array
    {
        $noindex_nofollow = [
            'forums',
            'members',
            'dashboard',
            'photos',
            'groups',
            'register',
            'activate',
            'news-feed',
            'moderation',
            'registrar-en-plataforma',
        ];

        $noindex_follow = [
            'terms-of-service',
            'privacy-policy',
        ];

        $path = trim(empc_cleanup_request_path(), '/');
        if (in_array($path, $noindex_nofollow, true)) {
            return ['noindex' => true, 'nofollow' => true];
        }

        if (in_array($path, $noindex_follow, true)) {
            return ['noindex' => true, 'follow' => true];
        }

        return [];
    }
}

if (!function_exists('empc_theme_wp_robots')) {
    function empc_theme_wp_robots(array $robots): array
    {
        $cleanup = empc_seo_cleanup_robots_context();
        if (!empty($cleanup)) {
            $robots = array_merge($robots, $cleanup);
        }

        if (empc_is_laboratorio_ia_request() && !empty($GLOBALS['empc_laboratorio_ia_is_404'])) {
            $robots['noindex'] = true;
            $robots['follow'] = true;
            unset($robots['index'], $robots['nofollow']);
        }

        return $robots;
    }
}

add_filter('wp_robots', 'empc_theme_wp_robots', 20);

if (!function_exists('empc_theme_rank_math_robots')) {
    function empc_theme_rank_math_robots($robots)
    {
        if (!is_array($robots)) {
            return $robots;
        }

        $cleanup = empc_seo_cleanup_robots_context();
        if (!empty($cleanup)) {
            $robots = array_merge($robots, $cleanup);
        }

        if (empc_is_laboratorio_ia_request() && !empty($GLOBALS['empc_laboratorio_ia_is_404'])) {
            $robots['noindex'] = true;
            $robots['follow'] = true;
            unset($robots['index'], $robots['nofollow']);
        }

        return $robots;
    }
}

add_filter('rank_math/frontend/robots', 'empc_theme_rank_math_robots', 20);

if (!function_exists('empc_archive_canonical_url')) {
    function empc_archive_canonical_url(): string
    {
        if (is_home()) {
            return home_url('/blog/');
        }

        if (is_category()) {
            $term = get_queried_object();
            if ($term instanceof WP_Term) {
                $link = get_term_link($term);
                if (!is_wp_error($link)) {
                    return $link;
                }
            }
        }

        return '';
    }
}

add_filter('rank_math/frontend/canonical', function ($canonical) {
    $archive_canonical = empc_archive_canonical_url();
    return $archive_canonical !== '' ? $archive_canonical : $canonical;
});

add_action('wp_head', function (): void {
    if (defined('RANK_MATH_VERSION')) {
        return;
    }

    $canonical = empc_archive_canonical_url();
    if ($canonical === '') {
        return;
    }

    echo '<link rel="canonical" href="' . esc_url($canonical) . '" />' . "\n";
}, 2);

if (!function_exists('empc_sitemap_excluded_page_ids')) {
    function empc_sitemap_excluded_page_ids(): array
    {
        $slugs = [
            'blog-nuevo',
            'blog-empc',
            'forums',
            'members',
            'dashboard',
            'photos',
            'groups',
            'register',
            'activate',
            'news-feed',
            'moderation',
            'registrar-en-plataforma',
            'terms-of-service',
            'privacy-policy',
        ];

        $ids = [];
        foreach ($slugs as $slug) {
            $page = get_page_by_path($slug);
            if ($page instanceof WP_Post && 'page' === $page->post_type) {
                $ids[] = (int) $page->ID;
            }
        }

        return array_values(array_unique(array_filter($ids)));
    }
}

add_filter('wp_sitemaps_posts_query_args', function (array $args, string $post_type): array {
    if ('page' !== $post_type) {
        return $args;
    }

    $excluded = empc_sitemap_excluded_page_ids();
    if (empty($excluded)) {
        return $args;
    }

    $args['post__not_in'] = array_values(array_unique(array_merge($args['post__not_in'] ?? [], $excluded)));
    return $args;
}, 10, 2);

add_filter('rank_math/sitemap/posts_to_exclude', function ($posts_to_exclude) {
    $excluded = empc_sitemap_excluded_page_ids();
    if (empty($excluded)) {
        return $posts_to_exclude;
    }

    return array_values(array_unique(array_merge(wp_parse_id_list($posts_to_exclude), $excluded)));
});

if (!function_exists('empc_rank_math_exclude_post_tag_sitemap')) {
    function empc_rank_math_exclude_post_tag_sitemap($exclude, $type)
    {
        if ('post_tag' === $type) {
            return true;
        }

        return $exclude;
    }
}

add_filter('rank_math/sitemap/exclude_taxonomy', 'empc_rank_math_exclude_post_tag_sitemap', 10, 2);

if (!function_exists('empc_exclude_post_tag_from_wp_sitemaps')) {
    function empc_exclude_post_tag_from_wp_sitemaps(array $taxonomies): array
    {
        unset($taxonomies['post_tag']);
        return $taxonomies;
    }
}

add_filter('wp_sitemaps_taxonomies', 'empc_exclude_post_tag_from_wp_sitemaps');

if (!function_exists('empc_refresh_rank_math_sitemap_cache_once')) {
    function empc_refresh_rank_math_sitemap_cache_once(): void
    {
        if (!class_exists('RankMath\\Sitemap\\Cache')) {
            return;
        }

        $cache_version = 'post-tag-exclusion-20260829';
        if ($cache_version === get_option('empc_sitemap_cache_version')) {
            return;
        }

        \RankMath\Sitemap\Cache::invalidate_storage();
        update_option('empc_sitemap_cache_version', $cache_version, false);
    }
}

add_action('init', 'empc_refresh_rank_math_sitemap_cache_once', 20);

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

if (!function_exists('empc_get_request_text')) {
    function empc_get_request_text($value, int $max_length = 0): ?string
    {
        if (is_array($value) || is_object($value)) {
            return null;
        }

        $value = sanitize_text_field((string) $value);
        $value = preg_replace('/\s+/u', ' ', trim($value)) ?? trim($value);

        if ($max_length > 0) {
            $length = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
            if ($length > $max_length) {
                return null;
            }
        }

        return $value;
    }
}

if (!function_exists('empc_get_request_textarea')) {
    function empc_get_request_textarea($value, int $max_length = 0): ?string
    {
        if (is_array($value) || is_object($value)) {
            return null;
        }

        $value = sanitize_textarea_field((string) $value);
        $value = trim($value);

        if ($max_length > 0) {
            $length = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
            if ($length > $max_length) {
                return null;
            }
        }

        return $value;
    }
}

if (!function_exists('empc_mail_header_value')) {
    function empc_mail_header_value(string $value, int $max_length = 0): string
    {
        $value = preg_replace('/[\r\n<>]+/', ' ', $value) ?? $value;
        $value = preg_replace('/\s+/u', ' ', trim($value)) ?? trim($value);

        if ($max_length > 0) {
            if (function_exists('mb_substr')) {
                $value = mb_substr($value, 0, $max_length);
            } elseif (strlen($value) > $max_length) {
                $value = substr($value, 0, $max_length);
            }
        }

        return $value;
    }
}

if (!function_exists('empc_has_declined_consent')) {
    function empc_has_declined_consent(array $data): bool
    {
        foreach (['consent', 'privacyConsent', 'acceptPrivacy', 'acepto', 'acceptance'] as $key) {
            if (array_key_exists($key, $data)) {
                $value = filter_var($data[$key], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                if ($value !== true) {
                    return true;
                }
            }
        }

        return false;
    }
}

if (!function_exists('empc_rate_limit_request')) {
    function empc_rate_limit_request(string $endpoint, int $limit, int $window_seconds): ?WP_REST_Response
    {
        $fingerprint_source = implode('|', [
            $endpoint,
            (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown'),
            (string) ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown'),
        ]);
        $fingerprint = hash_hmac('sha256', $fingerprint_source, wp_salt('auth'));
        $transient_key = 'empc_rl_' . substr($fingerprint, 0, 24);
        $bucket = get_transient($transient_key);
        $now = time();

        if (!is_array($bucket) || empty($bucket['window_start']) || ($now - (int) $bucket['window_start']) >= $window_seconds) {
            set_transient($transient_key, [
                'count' => 1,
                'window_start' => $now,
            ], $window_seconds);

            return null;
        }

        $count = (int) ($bucket['count'] ?? 0) + 1;
        if ($count > $limit) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Demasiadas solicitudes. Espera un momento e inténtalo de nuevo.',
            ], 429);
        }

        $bucket['count'] = $count;
        $bucket['window_start'] = (int) $bucket['window_start'];
        set_transient($transient_key, $bucket, $window_seconds);

        return null;
    }
}

if (!function_exists('empc_get_meta_description')) {
    function empc_get_meta_description(): string
    {
        if (defined('RANK_MATH_VERSION')) {
            return '';
        }

        if (empc_is_laboratorio_ia_request()) {
            return 'Laboratorio IA EMPC: prompts, workflows y recursos prácticos para explorar ideas con una interfaz compacta y clara.';
        }

        if (is_page('mantenimiento-wordpress-leon')) {
            return 'Mantenimiento WordPress en León con planes mensuales, copias de seguridad, actualizaciones, seguridad, soporte y tareas avanzadas para sitios WordPress y WooCommerce.';
        }

        if (is_page('alquiler-pagina-web-empresas-y-autonomos')) {
            return 'Alquiler de página web para empresas y autónomos con planes escalables, hosting, dominio y mantenimiento según el contenido publicado en la página.';
        }

        if (is_front_page() || is_home()) {
            return 'Diseño web y mantenimiento WordPress en León. EMPC crea webs rápidas, claras y orientadas a captar clientes.';
        }

        if (is_singular()) {
            $post = get_queried_object();
            if ($post instanceof WP_Post) {
                $excerpt = trim(wp_strip_all_tags(get_the_excerpt($post)));
                if ($excerpt !== '') {
                    return wp_trim_words($excerpt, 26, '…');
                }

                $content = trim(wp_strip_all_tags((string) $post->post_content));
                if ($content !== '') {
                    return wp_trim_words($content, 26, '…');
                }

                $title = trim((string) get_the_title($post));
                if ($title !== '') {
                    return $title . ' | EMPC';
                }
            }
        }

        $site_description = trim((string) get_bloginfo('description'));
        return $site_description !== '' ? $site_description : (string) get_bloginfo('name');
    }
}

if (!function_exists('empc_output_meta_description')) {
    function empc_output_meta_description(): void
    {
        if (empc_is_laboratorio_ia_request() || empc_seo_rank_math_active()) {
            return;
        }

        $description = empc_get_meta_description();
        if ($description === '') {
            return;
        }

        echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
    }
}

add_action('wp_head', 'empc_output_meta_description', 1);

add_action('rest_api_init', function () {
    register_rest_route('empc/v1', '/contact', [
        'methods' => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'callback' => function (WP_REST_Request $request) {
            $rate_limit = empc_rate_limit_request('contact', 5, 600);
            if ($rate_limit instanceof WP_REST_Response) {
                return $rate_limit;
            }

            $data = empc_normalize_frontend_payload($request);
            if (!is_array($data)) {
                return empc_rest_error('Solicitud no válida.', 400);
            }

            if (empc_has_declined_consent($data)) {
                return empc_rest_error('Debes aceptar la política de privacidad para continuar.', 400);
            }

            $honeypot = empc_get_request_text($data['website'] ?? $data['company_website'] ?? '', 120);
            if ($honeypot === null) {
                return empc_rest_error('Solicitud no válida.', 400);
            }
            if ($honeypot !== '') {
                return empc_rest_error('No se ha podido procesar la solicitud.', 400);
            }

            $name = empc_get_request_text($data['name'] ?? $data['nombre'] ?? '', 80);
            $email_input = empc_get_request_text($data['email'] ?? '', 120);
            $phone = empc_get_request_text($data['telefono'] ?? $data['phone'] ?? '', 30);
            $service = empc_get_request_text($data['service'] ?? $data['tipo'] ?? '', 120);
            $message = empc_get_request_textarea($data['message'] ?? $data['mensaje'] ?? '', 3000);
            $budget = empc_get_request_text($data['presupuesto'] ?? '', 20);

            if ($name === null || $email_input === null || $phone === null || $service === null || $message === null || $budget === null) {
                return empc_rest_error('Solicitud no válida.', 400);
            }

            $email = sanitize_email($email_input);
            if (!is_email($email)) {
                return empc_rest_error('El correo electrónico no es válido.', 400);
            }

            if ($name === '' || $service === '' || $message === '') {
                return empc_rest_error('Faltan campos obligatorios en el formulario de contacto.', 400);
            }

            if (mb_strlen($name) > 80 || mb_strlen($email) > 120 || mb_strlen($phone) > 30 || mb_strlen($service) > 120 || mb_strlen($message) > 3000 || mb_strlen($budget) > 20) {
                return empc_rest_error('Algunos campos superan la longitud permitida.', 400);
            }

            $subject = empc_mail_header_value(sprintf('[EMPC] Nuevo contacto: %s', $service), 120);
            $reply_to_name = empc_mail_header_value($name, 80);
            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                sprintf('Reply-To: %s <%s>', $reply_to_name !== '' ? $reply_to_name : 'EMPC', $email),
            ];

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
            $rate_limit = empc_rate_limit_request('budget', 3, 600);
            if ($rate_limit instanceof WP_REST_Response) {
                return $rate_limit;
            }

            $data = empc_normalize_frontend_payload($request);
            if (!is_array($data)) {
                return empc_rest_error('Solicitud no válida.', 400);
            }

            if (empc_has_declined_consent($data)) {
                return empc_rest_error('Debes aceptar la política de privacidad para continuar.', 400);
            }

            $honeypot = empc_get_request_text($data['website'] ?? $data['company_website'] ?? '', 120);
            if ($honeypot === null) {
                return empc_rest_error('Solicitud no válida.', 400);
            }
            if ($honeypot !== '') {
                return empc_rest_error('No se ha podido procesar la solicitud.', 400);
            }

            $name = empc_get_request_text($data['name'] ?? $data['nombre'] ?? '', 80);
            $email_input = empc_get_request_text($data['email'] ?? '', 120);
            $budget_data = $data['budget_data'] ?? null;

            if ($name === null || $email_input === null || !is_array($budget_data)) {
                return empc_rest_error('Solicitud no válida.', 400);
            }

            $type = empc_get_request_text($budget_data['type'] ?? '', 120);
            $mode = empc_get_request_text($budget_data['mode'] ?? '', 60);
            $features = $budget_data['features'] ?? [];
            $estimated_range = $budget_data['estimated_range'] ?? [];

            if ($type === null || $mode === null || !is_array($features) || !is_array($estimated_range)) {
                return empc_rest_error('Solicitud no válida.', 400);
            }

            $email = sanitize_email($email_input);
            if (!is_email($email)) {
                return empc_rest_error('El correo electrónico no es válido.', 400);
            }

            if ($name === '' || $type === '') {
                return empc_rest_error('Faltan campos obligatorios para calcular el presupuesto.', 400);
            }

            if (mb_strlen($name) > 80 || mb_strlen($email) > 120 || mb_strlen($type) > 120 || mb_strlen($mode) > 60) {
                return empc_rest_error('Algunos campos superan la longitud permitida.', 400);
            }

            $clean_features = [];
            foreach ($features as $feature) {
                $clean_feature = empc_get_request_text($feature, 40);
                if ($clean_feature === null) {
                    return empc_rest_error('Solicitud no válida.', 400);
                }
                if ($clean_feature !== '') {
                    $clean_features[] = $clean_feature;
                }
            }
            if (count($clean_features) > 15) {
                return empc_rest_error('Demasiadas funcionalidades seleccionadas.', 400);
            }

            $min = isset($estimated_range['min']) ? filter_var($estimated_range['min'], FILTER_VALIDATE_INT) : null;
            $max = isset($estimated_range['max']) ? filter_var($estimated_range['max'], FILTER_VALIDATE_INT) : null;
            if ($min === false || $max === false || $min === null || $max === null || $min < 0 || $max < 0 || $max < $min) {
                return empc_rest_error('El rango estimado no es válido.', 400);
            }

            $subject = empc_mail_header_value(sprintf('[EMPC] Presupuesto solicitado: %s', $type), 120);
            $reply_to_name = empc_mail_header_value($name, 80);
            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                sprintf('Reply-To: %s <%s>', $reply_to_name !== '' ? $reply_to_name : 'EMPC', $email),
            ];

            $body = implode("\n", array_filter([
                'Nueva solicitud de presupuesto desde la web EMPC.',
                'Nombre: ' . $name,
                'Email: ' . $email,
                'Tipo: ' . $type,
                $mode !== '' ? 'Modo: ' . $mode : '',
                !empty($clean_features) ? 'Extras: ' . implode(', ', $clean_features) : '',
                'Rango estimado: ' . $min . '€ - ' . $max . '€',
            ]));

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
    if (defined('RANK_MATH_VERSION')) {
        return $title;
    }

    if (function_exists('empc_seo_preferred_title')) {
        return empc_seo_preferred_title();
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
