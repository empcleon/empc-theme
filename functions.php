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

// Include service pages helpers
require_once EMPC_THEME_DIR . '/inc/service-pages-config.php';
require_once EMPC_THEME_DIR . '/inc/service-pages-data.php';

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
 * Cargar assets de React (Desarrollo con Vite o producción con assets compilados)
 */
function empc_load_scripts()
{
    // BLINDAJE: No cargar nada en admin, cron, ajax o REST
    if (is_admin() || wp_doing_ajax() || wp_doing_cron() || defined('REST_REQUEST')) {
        return;
    }

    // DETECTAR MODO DESARROLLO
    // TEMPORAL: Desactivado para usar assets compilados
    $vite_dev_server = 'http://localhost:5173';
    $is_dev_mode = false; // Cambiado a false para usar producción

    // 2. JS (React Logic) - CARGA CONDICIONAL (WPO)
    // Solo cargamos el runtime de React si realmente hay componentes ("islas") en la página
    $should_load_react = false;

    if (is_front_page()) {
        $should_load_react = true; // Home suele tener Calculadora o Contacto
    } elseif (is_singular()) {
        global $post;
        // Si el post tiene configuración de React explícita, cargamos
        if (get_post_meta($post->ID, '_empc_react_config', true) || get_post_meta($post->ID, '_empc_service_config', true)) {
            $should_load_react = true;
        }
    }

    if ($should_load_react) {
        if ($is_dev_mode) {
            // MODO DESARROLLO: Cargar desde Vite
            // Las rutas deben coincidir con el 'base' configurado en vite.config.ts
            wp_enqueue_script('vite-client', $vite_dev_server . '/wp-content/themes/empc-theme/react-app/@vite/client', [], null, false);
            wp_enqueue_script('empc-react-main', $vite_dev_server . '/wp-content/themes/empc-theme/react-app/src/main.tsx', [], null, true);
        } else {
            // MODO PRODUCCIÓN: Cargar assets compilados
            $react_css = get_template_directory_uri() . '/react-app/assets/main.css';
            $react_js = get_template_directory_uri() . '/react-app/assets/app.js';

            $react_css_path = EMPC_THEME_DIR . '/react-app/assets/main.css';
            $react_js_path = EMPC_THEME_DIR . '/react-app/assets/app.js';

            // CSS - Preload para mejorar LCP
            if (file_exists($react_css_path)) {
                wp_enqueue_style('empc-react-styles', $react_css, [], filemtime($react_css_path));
                // Añadir preload hint
                add_action('wp_head', function () use ($react_css) {
                    echo '<link rel="preload" href="' . esc_url($react_css) . '" as="style">';
                }, 1);
            }

            // JS - Con defer para no bloquear renderizado
            if (file_exists($react_js_path)) {
                wp_enqueue_script('empc-react', $react_js, [], filemtime($react_js_path), [
                    'strategy' => 'defer',
                    'in_footer' => true
                ]);
            }
        }

        // Localizamos el script justo después de encolarlo para asegurar que el handle existe
        $data = [
            'siteUrl' => home_url(),
            'restUrl' => get_rest_url(), // Devuelve la raíz de la API (ej: /wp-json/)
            'nonce' => wp_create_nonce('wp_rest'),
            'isLoggedIn' => is_user_logged_in(),
            'postConfig' => null
        ];

        // Si estamos en un single post o página, intentamos cargar su configuración específica
        if (is_singular()) {
            global $post;
            $raw_config = get_post_meta($post->ID, '_empc_react_config', true);
            if ($raw_config) {
                // Decodificamos y volvemos a codificar para asegurar que sea un objeto JS válido
                $data['postConfig'] = json_decode($raw_config);
            }
        }

        wp_localize_script('empc-react', 'empcData', $data);
    }

    // Estilos del tema base (style.css) - necesario para reset y estilos base
    // Es muy pequeño (914 bytes) así que el bloqueo es mínimo
    wp_enqueue_style('empc-theme-style', get_stylesheet_uri(), [], EMPC_THEME_VERSION);

    // --- LIMPIEZA WPO (Fase 4) ---
    // Eliminamos estilos basura de WordPress que no usamos (Gutenberg)
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style'); // Si hubiera restos de Woo
        wp_dequeue_style('global-styles'); // El inline CSS gigante de WP 5.9+
    }
}
add_action('wp_enqueue_scripts', 'empc_load_scripts');

// --- SHORTCODES ---

// Shortcode: [empc_booking phone="34612345678" business="Mi Negocio"]
function empc_booking_shortcode($atts)
{
    // 1. Extraer atributos con valores por defecto
    $a = shortcode_atts([
        'phone' => '34626195795', // Default EMPCLEON phone
        'business' => 'EMPC Ingeniería',
        'city' => 'León'
    ], $atts);

    // 2. Definir Configuración para React
    // La pasamos como objeto global window.empcConfig
    $config = [
        'nonce' => wp_create_nonce('wp_rest'),
        'restUrl' => get_rest_url(),
        'city' => sanitize_text_field($a['city']),
        'businessPhone' => sanitize_text_field($a['phone']),
        'businessName' => sanitize_text_field($a['business']),
        'timezone' => 'Europe/Madrid'
    ];

    $json_config = json_encode($config);

    // 3. Renderizar HTML + JS de Config
    // Nota: Usamos un div con ID único.
    ob_start();
    ?>
    <script>
        window.empcConfig = <?php echo $json_config; ?>;
    </script>
    <div id="empc-booking-root" class="my-8 min-h-[400px]"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('empc_booking', 'empc_booking_shortcode');


/**
 * Filtro para añadir type="module" (necesario para Vite y módulos ES)
 */
function empc_script_type_module($tag, $handle, $src)
{
    if (in_array($handle, ['vite-client', 'empc-react', 'empc-react-main'])) {
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
    // Callback de seguridad (validar Nonce)
    $auth_callback = function ($request) {
        $nonce = $request->get_header('x-wp-nonce');
        return wp_verify_nonce($nonce, 'wp_rest');
    };

    register_rest_route('empc/v1', '/contact', [
        'methods' => 'POST',
        'callback' => 'empc_handle_contact_form',
        'permission_callback' => $auth_callback
    ]);

    register_rest_route('empc/v1', '/budget', [
        'methods' => 'POST',
        'callback' => 'empc_handle_budget',
        'permission_callback' => $auth_callback
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
 * Auto-insertor de Contenido (MVP) - OPTIMIZADO
 * Se ejecuta solo una vez por versión de contenido para evitar sobrecarga de memoria
 */
/**
 * Auto-insertor de Contenido (Disparador Manual)
 * URL Trigger: /wp-admin/admin.php?empc_install_content=1
 */
add_action('admin_init', function () {
    // Verificar permisos de admin
    if (!current_user_can('manage_options')) {
        return;
    }

    $content_version = '2.4';

    // Verificar si necesita actualización comparando versiones
    $db_version = get_option('empc_content_version', '0');
    if ($db_version === $content_version) {
        return; // Ya está actualizado
    }


    // --- 1. Crear Categorías ---
    $categories = [
        'WordPress para negocio' => 'wordpress-negocio',
        'SEO local' => 'seo-local',
        'Reservas y automatización' => 'reservas-y-automatizacion',
        'Rendimiento / WPO' => 'rendimiento-wpo',
    ];


    $cat_ids = [];
    foreach ($categories as $name => $slug) {
        $term = term_exists($slug, 'category');
        if (!$term) {
            $term = wp_insert_term($name, 'category', ['slug' => $slug]);
        }
        if (!is_wp_error($term)) {
            // wp_insert_term devuelve array; term_exists puede devolver array o int/null
            $term_id = is_array($term) ? $term['term_id'] : $term;
            if ($term_id) {
                $cat_ids[$slug] = $term_id;
            }
        }
    }
    // Fallback ID
    $default_cat = 1;

    // --- 2. Crear Páginas Base ---
    // Pagina Blog
    if (!get_page_by_title('Blog')) {
        wp_insert_post([
            'post_type' => 'page',
            'post_title' => 'Blog',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_name' => 'blog'
        ]);
    }
    // Pagina Home
    if (!get_page_by_title('Inicio')) {
        $home_id = wp_insert_post([
            'post_type' => 'page',
            'post_title' => 'Inicio',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_name' => 'home'
        ]);
        // Página: Nuestro Método (Method Island)
        $method_page = get_page_by_title('Nuestro Método', OBJECT, 'page');
        if (!$method_page) {
            $method_id = wp_insert_post([
                'post_title' => 'Nuestro Método',
                'post_name' => 'nuestro-metodo',
                'post_content' => '<!-- wp:html --><div id="island-method-page"></div><!-- /wp:html -->',
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
            if ($method_id && !is_wp_error($method_id)) {
                update_post_meta($method_id, '_empc_react_config', '{"post_type":"page","page_id":"nuestro-metodo","primary_cta":"island-method-page"}');
            }
        }

        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    // Ajustar lectura
    $blog_page = get_page_by_title('Blog');
    if ($blog_page)
        update_option('page_for_posts', $blog_page->ID);

    // Permalinks
    if (get_option('permalink_structure') !== '/%postname%/') {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        update_option('permalink_structure', '/%postname%/');
        flush_rewrite_rules();
    }


    // --- 3. Inserción de Posts ---

    // Función Helper para insertar O ACTUALIZAR (Búsqueda por SLUG más robusta)
    $insert_empc_post = function ($title, $slug, $content, $excerpt, $cat_slug, $json_config) use ($cat_ids, $default_cat) {
        // Buscar por SLUG (más fiable que el título que puede cambiar)
        $args = [
            'name' => $slug,
            'post_type' => 'post',
            'post_status' => 'any',
            'numberposts' => 1
        ];
        $existing_posts = get_posts($args);
        $existing_post = !empty($existing_posts) ? $existing_posts[0] : null;

        $cat_id = isset($cat_ids[$cat_slug]) ? $cat_ids[$cat_slug] : $default_cat;

        $post_data = [
            'post_title' => $title,
            'post_name' => $slug,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => [$cat_id],
            'post_excerpt' => $excerpt
        ];

        if ($existing_post) {
            $post_data['ID'] = $existing_post->ID;
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }

        // CRÍTICO: Siempre actualizar el meta, incluso si el post ya existía
        // Esto corrige posts antiguos que no tienen _empc_react_config
        if ($post_id && !is_wp_error($post_id)) {
            if ($json_config) {
                update_post_meta($post_id, '_empc_react_config', $json_config);
            }
            return $post_id;
        }

        return false;
    };

    // Post TEST: Debug
    $insert_empc_post(
        '00. TEST DE VERIFICACIÓN (Ignorar)',
        'debug-test-post',
        '<!-- wp:paragraph --><p>Si ves esto, el código se actualiza correctamente.</p><!-- /wp:paragraph -->',
        'Debug Post',
        'wordpress-negocio',
        null
    );

    // Post 1: Guía de Precios
    $insert_empc_post(
        '¿Cuánto cuesta una web en León? Guía de precios 2026',
        'cuanto-cuesta-web-leon',
        '<!-- wp:html -->
        <p>Si estás buscando un desarrollador en <strong>León</strong>, te habrás dado cuenta de que los precios varían enormemente. Desde opciones "low-cost" que terminan siendo caras, hasta presupuestos de agencias que se escapan de la realidad de una pyme.</p> <h2>Los 3 pilares que definen el precio de tu web</h2> <p>En EMPC no solo instalamos una plantilla. Usamos una arquitectura <strong>híbrida de WordPress + React</strong> para asegurar que tu web no solo sea bonita, sino que vuele.</p> <ul> <li><strong>Rendimiento (WPO)</strong></li> <li><strong>Funcionalidad</strong></li> <li><strong>Escalabilidad</strong></li> </ul> <div id="island-budget-calculator" class="my-12"> <div class="p-4 bg-slate-800 rounded animate-pulse">Cargando calculadora...</div> </div> <h2>Nuestros Packs de Referencia en León</h2> <div class="overflow-x-auto my-8"> <table class="w-full text-left border-collapse"> <thead> <tr class="border-b border-slate-700"> <th class="p-4 font-bold text-white">Pack</th> <th class="p-4 font-bold text-white">Desde</th> <th class="p-4 font-bold text-white">Ideal para...</th> </tr> </thead> <tbody class="text-slate-300"> <tr class="border-b border-slate-800"> <td class="p-4 font-medium text-white">Web Esencial</td> <td class="p-4">900€</td> <td class="p-4">Profesionales y pequeños negocios locales.</td> </tr> <tr class="border-b border-slate-800"> <td class="p-4 font-medium text-white">Web Pro (React)</td> <td class="p-4">1.800€</td> <td class="p-4">Empresas que necesitan velocidad extrema y SEO.</td> </tr> <tr> <td class="p-4 font-medium text-white">App a Medida</td> <td class="p-4">3.500€</td> <td class="p-4">Sistemas de reservas o catálogos complejos.</td> </tr> </tbody> </table> </div> <h2>Conclusión: No compres solo una web, compra una herramienta</h2> <p>En León, la competencia digital está creciendo. El stack de <strong>Antigravity</strong> te da la ventaja competitiva que necesitas.</p> <!-- /wp:html -->',
        'Guía actualizada de precios de desarrollo web en León. Descubre cuánto cuesta realmente una web profesional y qué factores influyen.',
        'wordpress-negocio',
        '{ "post_type": "blog", "seo_keywords": ["presupuesto web León", "precio diseño web León"], "primary_cta": "island-budget-calculator", "island_data": { "calculator_mode": "full", "base_pack_highlight": "esencial" } }'
    );

    // Post 2: SEO Local
    $insert_empc_post(
        'SEO Local en León: Guía para que tu negocio aparezca el primero en Google Maps',
        'seo-local-leon',
        '<!-- wp:html --> <h1>SEO Local en León: Guía para que tu negocio aparezca el primero en Google Maps</h1> <p>Si tienes un negocio en <strong>León</strong>, estar en la primera página de Google no es un lujo, es una necesidad.</p> <h2>¿Por qué el SEO en León es diferente?</h2> <p>No es lo mismo intentar posicionar una web a nivel nacional que querer ser el referente en la provincia de León.</p> <div id="island-budget-calculator" class="my-12 p-8 bg-blue-50 border-2 border-blue-200 rounded-3xl text-center"> <div class="p-4 bg-slate-800 rounded animate-pulse text-white">Cargando calculadora SEO...</div> </div> <h2>De la búsqueda a la visita: La importancia del stack técnico</h2> <p>En <strong>EMPC</strong>, utilizamos el stack <strong>Antigravity (WordPress + React)</strong>. Esto permite que tu web sea tan rápida que Google la premie.</p> <!-- /wp:html -->',
        'Descubre las claves del SEO Local en León para 2026. Cómo posicionar tu negocio en Google Maps y superar a la competencia en tu barrio.',
        'seo-local',
        '{ "post_type": "blog", "post_id": "seo-local-leon", "seo_keywords": ["SEO local León", "aparecer en Google Maps León"], "primary_cta": "island-budget-calculator", "island_data": { "calculator_mode": "local-seo-focus", "highlight_feature": "google-maps-optimization" } }'
    );

    // Post 4: Reservas Clínicas
    $insert_empc_post(
        'Sistema de reservas online en León: Cómo digitalizar tu clínica o centro de servicios',
        'reservas-online-clinicas-leon',
        '<!-- wp:html --> <h1>Sistema de reservas online en León: Cómo digitalizar tu clínica o centro de servicios</h1> <p>Para una clínica en <strong>León</strong>, el tiempo es el activo más valioso. Si todavía gestionas tus citas por WhatsApp, pierdes dinero.</p> <div id="island-budget-calculator" class="my-10 p-8 bg-emerald-50 rounded-3xl border-2 border-emerald-200"> <h3 class="text-2xl font-bold text-emerald-900 mb-4">Calcula el ROI de tu sistema de reservas</h3> <div class="p-4 bg-emerald-800 rounded animate-pulse text-white text-center">Cargando calculadora ROI...</div> </div> <h2>WordPress vs. Apps a medida</h2> <p>En <strong>EMPC</strong> usamos la robustez de WordPress para gestionar tus servicios y la velocidad de React para reservas instantáneas.</p> <!-- /wp:html -->',
        'Automatiza las citas de tu clínica en León con un sistema de reservas integrado en tu web.',
        'reservas-y-automatizacion',
        '{ "post_type": "blog", "post_id": "reservas-online-clinicas-leon", "seo_keywords": ["sistema de reservas online León", "web para clínicas León"], "primary_cta": "island-budget-calculator", "island_data": { "calculator_mode": "booking-focus", "niche": "health-and-wellness", "feature_highlight": "calendar-sync" } }'
    );

    // Post 5: Imprentas
    $insert_empc_post(
        'Web para imprentas en León: Cómo automatizar presupuestos y recibir archivos sin caos',
        'webs-para-imprentas-leon',
        '<!-- wp:html --> <h1>Web para imprentas en León: Cómo automatizar presupuestos y recibir archivos sin caos</h1> <p>El sector de las artes gráficas en <strong>León</strong> pierde tiempo presupuestando manualmente.</p> <h2>La calculadora de presupuestos: Tu comercial 24/7</h2> <p>Mediante nuestra tecnología de <strong>React</strong>, creamos formularios dinámicos.</p> <div id="island-budget-calculator" class="my-10 p-8 bg-orange-50 rounded-3xl border-2 border-orange-200"> <h3 class="text-2xl font-bold text-orange-900 mb-4">¿Cuánto cuesta digitalizar tu imprenta?</h3> <div class="p-4 bg-orange-800 rounded animate-pulse text-white text-center">Cargando calculador de Imprenta...</div> </div> <h2>Antigravity: Rendimiento para catálogos pesados</h2> <p>Al usar el tema <strong>Antigravity</strong> en <strong>León</strong>, garantizamos que tu catálogo cargue al instante.</p> <!-- /wp:html -->',
        'Automatiza la recepción de pedidos en tu imprenta de León. Calculadoras de precios dinámicas.',
        'wordpress-negocio',
        '{ "post_type": "blog", "post_id": "webs-para-imprentas-leon", "seo_keywords": ["web para imprentas León", "presupuesto imprenta online"], "primary_cta": "island-budget-calculator", "island_data": { "calculator_mode": "printing-niche", "feature_highlight": "file-upload-logic" } }'
    );

    // Post 6: WPO
    $insert_empc_post(
        'Mi web en WordPress carga lenta: Guía WPO para negocios de León',
        'wpo-wordpress-leon',
        '<!-- wp:html --> <h1>Mi web en WordPress carga lenta: Guía WPO para negocios de León</h1> <p>Si tu web tarda más de 3 segundos en cargar, pierdes la mitad de tus posibles clientes en <strong>León</strong>.</p> <div id="island-budget-calculator" class="my-10 p-8 bg-indigo-900 rounded-3xl text-white shadow-2xl"> <h3 class="text-2xl font-black mb-4 text-indigo-300">¿Quieres una web que vuele?</h3> <div class="p-4 bg-indigo-700/50 rounded animate-pulse text-center">Cargando calculadora WPO...</div> </div> <h2>La solución Antigravity</h2> <p>El resultado es una web instantánea, con transiciones fluidas que parecen una aplicación móvil.</p> <!-- /wp:html -->',
        'Guía de optimización WPO para negocios en León. Descubre por qué tu web carga lenta.',
        'rendimiento-wpo',
        '{ "post_type": "blog", "post_id": "wpo-wordpress-leon", "seo_keywords": ["web lenta León", "WPO WordPress León"], "primary_cta": "island-budget-calculator", "island_data": { "calculator_mode": "performance-focus", "feature_highlight": "speed-optimization", "promo_code": "LEON-RAPIDO" } }'
    );

    // Post 7: Restaurantes (Updated with Booking Island)
    $insert_empc_post(
        'Webs para Restaurantes en León: Cómo llenar tus mesas sin descolgar el teléfono',
        'webs-restaurantes-leon-booking', // Nuevo slug
        '<!-- wp:html --> <h1>Webs para Restaurantes en León: Cómo llenar tus mesas sin descolgar el teléfono</h1> <p>En una ciudad con la competencia gastronómica de <strong>León</strong>, desde las tapas del Barrio Húmedo hasta los manteles del Cid, el éxito de un restaurante ya no solo depende de la cocina. Depende de lo fácil que sea para un cliente reservar una mesa un viernes por la noche desde su móvil.</p> <h2>El fin de las llamadas perdidas y los PDFs lentos</h2> <p>Muchos negocios en León siguen confiando en el teléfono o en subir un PDF de la carta que tarda siglos en cargar. Con nuestra arquitectura <strong>Antigravity (WordPress + React)</strong>, eliminamos la fricción. Ofrecemos una experiencia instantánea donde el cliente ve la disponibilidad real y confirma su reserva en segundos.</p> <h3>¿Qué hace único a nuestro sistema de reservas?</h3> <ul> <li><strong>Calendario Inteligente:</strong> Gestión visual de días, bloqueando fechas pasadas y optimizado para el ritmo de León.</li> <li><strong>Slots de tiempo reales:</strong> El sistema sabe qué horas han pasado y solo ofrece huecos disponibles para hoy.</li> <li><strong>Confirmación vía WhatsApp:</strong> Una vez reservado, el sistema genera un mensaje automático para que el cliente y el dueño estén conectados al instante.</li> <li><strong>Velocidad de carga 98/100:</strong> Tu web será la más rápida de la provincia, algo que Google premia con mejores posiciones.</li> </ul> <div class="my-12 p-6 bg-slate-50 rounded-3xl border-2 border-slate-100 shadow-inner"> <h3 class="text-center text-xl font-bold text-slate-900 mb-6">Prueba aquí nuestra Isla de Reservas (Demo León)</h3> [empc_booking phone="34600111222" business="Asador Casa Pepe" city="León"] <p class="text-center text-xs text-slate-400 mt-6 italic">Esta es una simulación real de lo que tus clientes verán en tu web: rapidez, claridad y contacto directo por WhatsApp.</p> </div> <h2>Tecnología leonesa para negocios que no quieren límites</h2> <p>Al integrar este <strong>Booking Island</strong> en tu web de <strong>León</strong>, no solo ahorras tiempo en gestión; estás mejorando tu imagen de marca. Un sistema que funciona bien en el móvil transmite la misma calidad que tus platos. Es el momento de dejar de ser "uno más" en Google Maps para ser el primero en reservas.</p> <h2>¿Preparado para digitalizar tu restaurante?</h2> <p>Si quieres ver cómo este sistema de reservas puede adaptarse a tu menú, tus horarios y tu local en León, usa nuestra calculadora de presupuestos o contacta directamente con nosotros.</p> <!-- /wp:html -->',
        'En León, tu presencia digital es tu primera mesa. Descubre cómo nuestro sistema de reservas vía WhatsApp llena tu restaurante automáticamente.',
        'reservas-y-automatizacion',
        '{ "post_type": "blog", "post_id": "webs-restaurantes-leon-booking", "category": { "slug": "reservas-y-automatizacion", "name": "Reservas y automatización" }, "seo_keywords": ["reservas online restaurantes León", "web para hostelería León", "sistema reservas whatsapp restaurante", "digitalizar restaurante León"], "primary_cta": "empc-booking-island", "island_data": { "mode": "production", "feature_highlight": "whatsapp-integration", "performance_score": 98 } }'
    );

    // Post 8: Tiendas
    $insert_empc_post(
        'Tiendas de barrio en León: Cómo competir con los grandes desde el mostrador digital',
        'comercio-local-panaderia-leon',
        '<!-- wp:html --> <h1>Tiendas de barrio en León: Cómo competir con los grandes desde el mostrador digital</h1> <p>Una panadería artesana en El Ejido tiene algo que Amazon no tiene: cercanía.</p> <h2>El "Click & Collect" leonés</h2> <p>Necesitas una web rápida donde tus clientes puedan "apartar" productos.</p> <div id="island-budget-calculator" class="my-10 p-8 bg-amber-50 rounded-3xl border-2 border-amber-200"> <h3 class="text-2xl font-bold text-amber-900 mb-4">Lleva tu mostrador a Internet</h3> <div class="p-4 bg-amber-800/10 rounded animate-pulse text-center text-amber-700">Cargando calculadora Comercio...</div> </div> <!-- /wp:html -->',
        'Soluciones web reales para el pequeño comercio de León. Click & Collect y gestión sencilla.',
        'wordpress-negocio',
        '{ "post_type": "blog", "post_id": "comercio-local-panaderia-leon", "seo_keywords": ["web para comercios León", "panadería online León"], "primary_cta": "island-budget-calculator", "island_data": { "calculator_mode": "local-shop-focus", "feature_highlight": "click-and-collect-logic" } }'
    );

    // Post 9: Demo Hostelería
    $insert_empc_post(
        'Especial Hostelería en León (Simulación de Reservas)',
        'demo-reservas-restaurantes-leon',
        '<!-- wp:html --> <h1>¿Tu restaurante en León sigue perdiendo clientes por culpa del teléfono?</h1> <p>Imagínate esto: es viernes noche y el teléfono no para de sonar.</p> <h2>La diferencia entre un formulario y un Sistema de Reservas</h2> <p>Un sistema real permite recibir una confirmación inmediata.</p> <div class="not-prose my-12 p-2 bg-gradient-to-br from-slate-100 to-white rounded-3xl shadow-inner border border-slate-200"> <div id="island-booking" class="font-sans antialiased"></div> <p class="text-center text-xs text-slate-400 mt-4 italic">Simulación de reserva real: Prueba a seleccionar un servicio y una hora para ver la fluidez del sistema.</p> </div> <h2>Tecnología de León para la hostelería de León</h2> <p>En <strong>EMPC</strong> no solo instalamos software; diseñamos experiencias.</p> <!-- /wp:html -->',
        'Demo interactiva de reservas para restaurantes en León. Digitaliza tu local del Húmedo sin pagar comisiones.',
        'reservas-y-automatizacion',
        '{ "post_type": "blog", "post_id": "demo-reservas-restaurantes-leon", "seo_keywords": ["reservas online restaurantes León", "digitalizar restaurante León"], "primary_cta": "island-booking", "island_data": { "mode": "demo-mode", "venue_type": "restaurant", "location": "León Centro" } }'
    );

    // SERVICE PAGE: Diseño Web León
    empc_insert_service_page(
        'Diseño Web en León',
        'diseno-web-leon',
        get_diseno_web_leon_config()
    );

    // SERVICE PAGE: Tiendas Online
    if (function_exists('get_tiendas_online_config')) {
        empc_insert_service_page(
            'Tiendas Online en León',
            'tiendas-online-leon',
            get_tiendas_online_config(),
            'page-tiendas-online.php'
        );
    }

    // Página dedicada de Calculadora de Presupuestos
    $calc_page_exists = get_page_by_title('Calculadora de Presupuesto Web', OBJECT, 'page');
    if (!$calc_page_exists) {
        $calc_page_content = '<!-- wp:html -->
<div id="island-pricing-calculator"></div>
<!-- /wp:html -->';

        $calc_page_id = wp_insert_post([
            'post_title' => 'Calculadora de Presupuesto Web',
            'post_name' => 'presupuesto-web',
            'post_content' => $calc_page_content,
            'post_status' => 'publish',
            'post_type' => 'page'
        ]);

        if ($calc_page_id && !is_wp_error($calc_page_id)) {
            update_post_meta($calc_page_id, '_empc_react_config', json_encode([
                'post_type' => 'page',
                'page_id' => 'presupuesto-web',
                'calculator_page' => true
            ], JSON_UNESCAPED_UNICODE));
        }
    }

    // --- FIN ---

    // DEBUG: Comentado para producción
    /*
    add_action('admin_notices', function () {
        global $content_version;
        echo '<div class="notice notice-info is-dismissible" style="border-left-color: #f59e0b; padding: 20px;">
                <h3 style="margin: 0; color: #b45309;">⚠️ DEBUG ACTIVO</h3>
                <p style="font-size: 1.2em;">El código de <strong>EMPC Theme</strong> se está ejecutando correctamente.</p>
                <p>Versión de Contenido: <strong>' . $content_version . '</strong></p>
              </div>';
    });
    */

    // Marcar versión
    update_option('empc_content_version', $content_version);
});

