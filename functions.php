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

        // Localizamos el script justo después de encolarlo para asegurar que el handle existe
        $data = [
            'siteUrl' => home_url(),
            'restUrl' => get_rest_url(), // Devuelve la raíz de la API (ej: /wp-json/)
            'nonce' => wp_create_nonce('wp_rest'),
            'isLoggedIn' => is_user_logged_in()
        ];
        wp_localize_script('empc-react', 'empcData', $data);
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
        // Para que wp_localize_script funcione con módulos, necesitamos definir la variable global manualmente
        // ya que type="module" aísla el scope.
        // Pero wp_localize_script imprime <script>var empcData = ...</script> ANTES del script del handle.
        // Como el script del handle es module, puede leer window.empcData.
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

/* Eliminamos la función separada para evitar condiciones de carrera */

/**
 * REST API Endpoint para Formulario de Contacto
 */
add_action('rest_api_init', function () {
    register_rest_route('empc/v1', '/contact', [
        'methods' => 'POST',
        'callback' => 'empc_handle_contact_form',
        'permission_callback' => '__return_true' // Validamos nonce manualmente si es necesario, o lo dejamos abierto con rate limit (pendiente)
    ]);

    register_rest_route('empc/v1', '/budget', [
        'methods' => 'POST',
        'callback' => 'empc_handle_budget',
        'permission_callback' => '__return_true'
    ]);
});

function empc_handle_budget($request)
{
    $params = $request->get_json_params();
    $name = sanitize_text_field($params['name']);
    $email = sanitize_email($params['email']);
    $budget_data = $params['budget_data'];

    if (empty($name) || empty($email)) {
        return new WP_Error('missing_params', 'Faltan campos obligatorios', ['status' => 400]);
    }

    // Componer Email para el Admin
    $to = 'empcleon@gmail.com';
    $subject = '💰 Nuevo Lead Calculadora: ' . $name;

    $features_list = implode(', ', $budget_data['features']);

    $message = "
    <h2>Nuevo cálculo de presupuesto</h2>
    <p><strong>Nombre:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <hr>
    <h3>Detalles del Proyecto:</h3>
    <ul>
        <li><strong>Tipo:</strong> {$budget_data['type']}</li>
        <li><strong>Extras:</strong> $features_list</li>
        <li><strong>Rango Estimado:</strong> {$budget_data['estimated_range']['min']}€ - {$budget_data['estimated_range']['max']}€</li>
    </ul>
    <p><small>Enviado desde el Post de la Calculadora</small></p>
    ";

    $headers = ['Content-Type: text/html; charset=UTF-8'];

    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        return new WP_REST_Response(['status' => 'success', 'message' => 'Presupuesto enviado'], 200);
    } else {
        return new WP_Error('cant_send', 'Error al enviar email', ['status' => 500]);
    }
}

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

    // For debugging local environment: simulate success
    $sent = wp_mail($to, $subject, $message, $headers);
    // $sent = true;

    if ($sent) {
        return new WP_REST_Response(['status' => 'success', 'message' => 'Email enviado correctamente'], 200);
    } else {
        return new WP_Error('cant_send', 'Error al enviar email', ['status' => 500]);
    }
}

/**
 * Auto-insertor de Contenido (MVP)
 * Se ejecuta en 'init' y comprueba si existe el post.
 */
add_action('init', function () {
    // Evitar ejecutar en cada carga si ya existe
    if (get_page_by_title('¿Cuánto cuesta una web en León? Guía de precios 2026', OBJECT, 'post')) {
        return;
    }

    $city = 'León';
    $json_config = '{
      "post_type": "blog",
      "seo_keywords": ["presupuesto web León", "precio diseño web León", "empc servicios"],
      "primary_cta": "island-budget-calculator",
      "related_service": "desarrollo-wordpress",
      "featured_image_alt": "Calculando presupuesto de desarrollo web en León",
      "island_data": {
        "calculator_mode": "full",
        "base_pack_highlight": "esencial"
      }
    }';

    $content = '
    <!-- wp:html -->
    <p>Si estás buscando un desarrollador en <strong>' . $city . '</strong>, te habrás dado cuenta de que los precios varían enormemente. Desde opciones "low-cost" que terminan siendo caras, hasta presupuestos de agencias que se escapan de la realidad de una pyme.</p>

    <h2>Los 3 pilares que definen el precio de tu web</h2> 
    <p>En EMPC no solo instalamos una plantilla. Usamos una arquitectura <strong>híbrida de WordPress + React</strong> para asegurar que tu web no solo sea bonita, sino que vuele. Los tres factores que más influyen son:</p> 
    <ul> 
        <li><strong>Rendimiento (WPO):</strong> Una web que carga en < 1s posiciona mejor en ' . $city . '.</li> 
        <li><strong>Funcionalidad:</strong> No es lo mismo una web informativa que una con sistema de reservas real.</li> 
        <li><strong>Escalabilidad:</strong> Que tu web pueda crecer sin romperse.</li> 
    </ul>

    <div id="island-budget-calculator" class="my-12">
        <!-- React Island Mount Point -->
        <div class="p-4 bg-slate-800 rounded animate-pulse">Cargando calculadora...</div>
    </div>

    <h2>Nuestros Packs de Referencia en ' . $city . '</h2> 
    <p>Aunque cada proyecto es único, estos son los puntos de partida habituales para negocios de la zona:</p>

    <div class="overflow-x-auto my-8">
        <table class="w-full text-left border-collapse"> 
            <thead> 
                <tr class="border-b border-slate-700"> 
                    <th class="p-4 font-bold text-white">Pack</th> 
                    <th class="p-4 font-bold text-white">Desde</th> 
                    <th class="p-4 font-bold text-white">Ideal para...</th> 
                </tr> 
            </thead> 
            <tbody class="text-slate-300"> 
                <tr class="border-b border-slate-800"> 
                    <td class="p-4 font-medium text-white">Web Esencial</td> 
                    <td class="p-4">900€</td> 
                    <td class="p-4">Profesionales y pequeños negocios locales.</td> 
                </tr> 
                <tr class="border-b border-slate-800"> 
                    <td class="p-4 font-medium text-white">Web Pro (React)</td> 
                    <td class="p-4">1.800€</td> 
                    <td class="p-4">Empresas que necesitan velocidad extrema y SEO.</td> 
                </tr> 
                <tr> 
                    <td class="p-4 font-medium text-white">App a Medida</td> 
                    <td class="p-4">3.500€</td> 
                    <td class="p-4">Sistemas de reservas o catálogos complejos.</td> 
                </tr> 
            </tbody> 
        </table>
    </div>

    <h2>Conclusión: No compres solo una web, compra una herramienta</h2> 
    <p>En ' . $city . ', la competencia digital está creciendo. Una web lenta construida con Elementor o Divi ya no es suficiente. El stack de <strong>Antigravity</strong> te da la ventaja competitiva que necesitas.</p>
    <!-- /wp:html -->
    ';

    $post_id = wp_insert_post([
        'post_title' => '¿Cuánto cuesta una web en ' . $city . '? Guía de precios 2026',
        'post_content' => $content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_category' => [1], // Categoría por defecto
        'post_excerpt' => 'Guía actualizada de precios de desarrollo web en León. Descubre cuánto cuesta realmente una web profesional y qué factores influyen.'
    ]);

    if ($post_id) {
        update_post_meta($post_id, '_empc_react_config', $json_config);
    }
});
