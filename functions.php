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


/**
 * Configuración Automática de Lectura y Permalinks (MVP Setup)
 */
add_action('init', function () {
    // 1. Asegurar que existe la página "Blog"
    $blog_page_title = 'Blog';
    $blog_page_check = get_page_by_title($blog_page_title);
    $blog_page_id = null;

    if (!isset($blog_page_check->ID)) {
        $blog_page_id = wp_insert_post([
            'post_type' => 'page',
            'post_title' => $blog_page_title,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_name' => 'blog'
        ]);
    } else {
        $blog_page_id = $blog_page_check->ID;
    }

    // 2. Asegurar que existe la página "Home" (para que front-page.php funcione como estática)
    $home_page_title = 'Inicio';
    $home_page_check = get_page_by_title($home_page_title);
    $home_page_id = null;

    if (!isset($home_page_check->ID)) {
        $home_page_id = wp_insert_post([
            'post_type' => 'page',
            'post_title' => $home_page_title,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_name' => 'home'
        ]);
    } else {
        $home_page_id = $home_page_check->ID;
    }

    // 3. Configurar Ajustes de Lectura
    $needs_flush = false;

    if (get_option('show_on_front') !== 'page') {
        update_option('show_on_front', 'page');
        $needs_flush = true;
    }
    if (get_option('page_on_front') != $home_page_id) {
        update_option('page_on_front', $home_page_id);
        $needs_flush = true;
    }
    if (get_option('page_for_posts') != $blog_page_id) {
        update_option('page_for_posts', $blog_page_id);
        $needs_flush = true;
    }

    // 4. Configurar Permalinks (Pretty URLs)
    if (get_option('permalink_structure') !== '/%postname%/') {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        update_option('permalink_structure', '/%postname%/');
        $needs_flush = true;
    }

    // Force flush if any option changed OR if it seems we haven't flushed for the blog page setup yet
    if ($needs_flush || !get_option('empc_rewrites_flushed_v1')) {
        flush_rewrite_rules();
        update_option('empc_rewrites_flushed_v1', true);
    }

    // DEBUG TOOL: ?empc_debug=1
    // Permite ver si la página existe y qué reglas de reescritura hay activas
    if (isset($_GET['empc_debug'])) {
        echo '<pre style="background:#fff; color:#000; padding:20px; z-index:9999; position:relative;">';
        echo '<h1>EMPC Debugger</h1>';
        echo '<strong>Show on Front:</strong> ' . get_option('show_on_front') . "\n";
        echo '<strong>Page on Front ID:</strong> ' . get_option('page_on_front') . "\n";
        echo '<strong>Page for Posts ID:</strong> ' . get_option('page_for_posts') . "\n";
        echo '<strong>Permalink Structure:</strong> ' . get_option('permalink_structure') . "\n";

        $blog_page = get_page_by_path('blog'); // Try by path
        if (!$blog_page)
            $blog_page = get_page_by_title('Blog'); // Try by title fallback

        echo "---------------------------------------------------\n";
        echo "CHECKING 'BLOG' PAGE:\n";
        if ($blog_page) {
            echo " - ID: " . $blog_page->ID . "\n";
            echo " - Title: " . $blog_page->post_title . "\n";
            echo " - Name (Slug): " . $blog_page->post_name . "\n";
            echo " - Status: " . $blog_page->post_status . "\n";
            echo " - GUID: " . $blog_page->guid . "\n";
        } else {
            echo " - RESULT: NOT FOUND! (Wordpress hasn't created it yet)\n";
        }

        echo "---------------------------------------------------\n";
        echo "REWRITE TYPES CHECK:\n";
        global $wp_rewrite;
        echo " - Using Permalinks: " . ($wp_rewrite->using_permalinks() ? 'YES' : 'NO') . "\n";
        echo " - Rewrite Rules Array: " . (empty($wp_rewrite->rules) ? 'EMPTY (Problem!)' : 'OK (' . count($wp_rewrite->rules) . ' rules)') . "\n";

        echo '</pre>';
        exit;
    }


    // 5. Insertar Post de Ejemplo (Si no existe)
    if (!get_page_by_title('¿Cuánto cuesta una web en León? Guía de precios 2026', OBJECT, 'post')) {
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
    }
});

/**
 * Insertar Post #2: SEO Local
 */
add_action('init', function () {
    if (!get_page_by_title('SEO Local en León: Guía para que tu negocio aparezca el primero en Google Maps', OBJECT, 'post')) {
        $json_config = '{
          "post_type": "blog",
          "post_id": "seo-local-leon",
          "seo_keywords": ["SEO local León", "aparecer en Google Maps León", "posicionamiento web León"],
          "primary_cta": "island-budget-calculator",
          "location_context": {
            "city": "León",
            "province": "León",
            "neighborhoods": ["Eras de Renueva", "Barrio Húmedo", "El Ejido", "Centro"]
          },
          "island_data": {
            "calculator_mode": "local-seo-focus",
            "highlight_feature": "google-maps-optimization"
          }
        }';

        $content = '
        <!-- wp:html -->
        <h1>SEO Local en León: Guía para que tu negocio aparezca el primero en Google Maps</h1>

        <p>Si tienes un negocio en <strong>León</strong>, ya sea una clínica en Eras de Renueva o una imprenta cerca de la Catedral, estar en la primera página de Google no es un lujo, es una necesidad. En 2026, el "boca a boca" empieza en el móvil.</p>

        <h2>¿Por qué el SEO en León es diferente?</h2>
        <p>No es lo mismo intentar posicionar una web a nivel nacional que querer ser el referente en la provincia de León. El <strong>SEO Local</strong> se basa en la relevancia geográfica. Google necesita saber que tu negocio no solo es el mejor, sino que está cerca del usuario que busca.</p>

        <h3>3 claves para dominar el mercado leonés:</h3>
        <ul>
            <li><strong>Optimización de Google Business Profile:</strong> Tu ficha de Google Maps es tu nuevo escaparate en la Calle Ancha.</li>
            <li><strong>Velocidad de carga (WPO):</strong> Con las conexiones móviles actuales en zonas rurales o interiores de León, una web rápida (hecha con React) marca la diferencia entre un cliente que te llama y uno que se va a la competencia.</li>
            <li><strong>Citas locales:</strong> Aparecer en directorios de confianza de Castilla y León refuerza tu autoridad.</li>
        </ul>

        <div id="island-budget-calculator" class="my-12 p-8 bg-blue-50 border-2 border-blue-200 rounded-3xl text-center">
             <!-- React Island Mount Point -->
             <div class="p-4 bg-slate-800 rounded animate-pulse text-white">Cargando calculadora SEO...</div>
        </div>

        <h2>De la búsqueda a la visita: La importancia del stack técnico</h2>
        <p>Muchos negocios en León cometen el error de usar plantillas pesadas que tardan siglos en cargar. En <strong>EMPC</strong>, utilizamos el stack <strong>Antigravity (WordPress + React)</strong>. Esto permite que tu web sea tan rápida que Google la premie con mejores posiciones, asegurando que los clientes de León te encuentren antes que a nadie.</p>

        <h2>Micro-nichos en León: Un océano azul</h2>
        <p>Hemos detectado que sectores como las <strong>imprentas locales</strong>, <strong>clínicas de salud</strong> y <strong>negocios de reservas</strong> en la provincia tienen una competencia digital baja. Es el momento ideal para invertir en una web que no solo sea informativa, sino que automatice tus ventas.</p>
        <!-- /wp:html -->
        ';

        $post_id = wp_insert_post([
            'post_title' => 'SEO Local en León: Guía para que tu negocio aparezca el primero en Google Maps',
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => [1],
            'post_excerpt' => 'Descubre las claves del SEO Local en León para 2026. Cómo posicionar tu negocio en Google Maps y superar a la competencia en tu barrio.'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_empc_react_config', $json_config);
        }
    }
});


/**
 * Gestión de Categorías y Post #4: Reservas
 */
add_action('init', function () {
    // 1. Crear Categorías
    $categories = [
        'WordPress para negocio' => 'wordpress-negocio',
        'SEO local' => 'seo-local',
        'Reservas y automatización' => 'reservas-automatizacion',
        'Rendimiento / WPO' => 'rendimiento-wpo'
    ];

    $cat_ids = [];
    foreach ($categories as $name => $slug) {
        $term = term_exists($slug, 'category');
        if (!$term) {
            $term = wp_insert_term($name, 'category', ['slug' => $slug]);
        }
        if (!is_wp_error($term)) {
            $cat_ids[$slug] = $term['term_id'];
        }
    }

    // 2. Recategorizar Posts Existentes
    // Post 1: Guía de Precios -> WordPress para negocio
    $post1 = get_page_by_title('¿Cuánto cuesta una web en León? Guía de precios 2026', OBJECT, 'post');
    if ($post1 && isset($cat_ids['wordpress-negocio'])) {
        wp_set_post_categories($post1->ID, [$cat_ids['wordpress-negocio']]);
    }

    // Post 2: SEO Local -> SEO local
    $post2 = get_page_by_title('SEO Local en León: Guía para que tu negocio aparezca el primero en Google Maps', OBJECT, 'post');
    if ($post2 && isset($cat_ids['seo-local'])) {
        wp_set_post_categories($post2->ID, [$cat_ids['seo-local']]);
    }

    // 3. Insertar Post #4: Reservas
    if (!get_page_by_title('Sistema de reservas online en León: Cómo digitalizar tu clínica o centro de servicios', OBJECT, 'post')) {
        $json_config = '{
          "post_type": "blog",
          "post_id": "reservas-online-clinicas-leon",
          "category": {
            "slug": "reservas-y-automatizacion",
            "name": "Reservas y automatización"
          },
          "seo_keywords": ["sistema de reservas online León", "web para clínicas León", "automatización citas León"],
          "primary_cta": "island-budget-calculator",
          "island_data": {
            "calculator_mode": "booking-focus",
            "niche": "health-and-wellness",
            "feature_highlight": "calendar-sync"
          }
        }';

        $content = '
        <!-- wp:html -->
        <h1>Sistema de reservas online en León: Cómo digitalizar tu clínica o centro de servicios</h1>

        <p>Para una clínica de fisioterapia en Eras de Renueva o un centro de estética en el centro de <strong>León</strong>, el tiempo es el activo más valioso. Si todavía gestionas tus citas por WhatsApp o teléfono, estás perdiendo eficiencia y, lo más importante, clientes que quieren reservar a las 11 de la noche desde su sofá.</p>

        <h2>¿Por qué tu negocio en León necesita autonomía en las reservas?</h2>
        <p>La digitalización en León está avanzando rápido. Un sistema de reservas integrado en tu web no es solo un formulario; es un empleado que trabaja 24/7 sin errores. Con el stack de <strong>Antigravity (WordPress + React)</strong>, la experiencia de usuario es tan fluida que el proceso de reserva se completa en menos de 30 segundos.</p>

        <h3>Ventajas competitivas de automatizar tus citas:</h3>
        <ul>
            <li><strong>Sincronización total:</strong> Conecta tu web con Google Calendar para evitar solapamientos.</li>
            <li><strong>Pagos integrados:</strong> Reduce el ausentismo cobrando una señal o el total de la sesión por adelantado.</li>
            <li><strong>Recordatorios automáticos:</strong> Envío de emails o notificaciones para que nadie olvide su cita en León.</li>
        </ul>

        <div id="island-budget-calculator" class="my-10 p-8 bg-emerald-50 rounded-3xl border-2 border-emerald-200">
             <h3 class="text-2xl font-bold text-emerald-900 mb-4">Calcula el ROI de tu sistema de reservas</h3>
             <p class="text-emerald-800 mb-6">Descubre cuánto podrías ahorrar automatizando la gestión de citas de tu clínica en León.</p>
             <!-- React Island Mount Point -->
             <div class="p-4 bg-emerald-800 rounded animate-pulse text-white text-center">Cargando calculadora ROI...</div>
        </div>

        <h2>WordPress vs. Apps a medida: El enfoque híbrido</h2>
        <p>En <strong>EMPC</strong> no te obligamos a elegir. Usamos la robustez de WordPress para gestionar tus servicios y la velocidad de React para que el calendario de reservas sea instantáneo, sin recargas de página molestas. Es la solución perfecta para negocios en León que buscan profesionalidad sin la complejidad de una App pesada.</p>

        <h2>Optimizado para el SEO local de León</h2>
        <p>No solo creamos el sistema; nos aseguramos de que cuando alguien busque "fisioterapeuta en León" o "reserva cita dentista León", tu clínica aparezca en los primeros resultados gracias a nuestra estructura de datos optimizada.</p>
        <!-- /wp:html -->
        ';

        $post_id = wp_insert_post([
            'post_title' => 'Sistema de reservas online en León: Cómo digitalizar tu clínica o centro de servicios',
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => isset($cat_ids['reservas-automatizacion']) ? [$cat_ids['reservas-automatizacion']] : [1],
            'post_excerpt' => 'Automatiza las citas de tu clínica en León con un sistema de reservas integrado en tu web. Ahorra tiempo y evita no-shows con recordatorios automáticos.'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_empc_react_config', $json_config);
        }
    }
});

/**
 * Insertar Post #5: Web para Imprentas
 */
add_action('init', function () {
    if (!get_page_by_title('Web para imprentas en León: Cómo automatizar presupuestos y recibir archivos sin caos', OBJECT, 'post')) {
        $json_config = '{
          "post_type": "blog",
          "post_id": "webs-para-imprentas-leon",
          "category": {
            "slug": "wordpress-para-negocio",
            "name": "WordPress para negocio"
          },
          "seo_keywords": ["web para imprentas León", "presupuesto imprenta online", "automatización pedidos imprenta"],
          "primary_cta": "island-budget-calculator",
          "island_data": {
            "calculator_mode": "printing-niche",
            "feature_highlight": "file-upload-logic"
          }
        }';

        $content = '
        <!-- wp:html -->
        <h1>Web para imprentas en León: Cómo automatizar presupuestos y recibir archivos sin caos</h1>

        <p>El sector de las artes gráficas en <strong>León</strong> se enfrenta a un reto constante: la pérdida de tiempo en presupuestar trabajos que nunca llegan. Si tu imprenta sigue recibiendo archivos pesados por email y calculando precios a mano, estás perdiendo dinero cada hora.</p>

        <h2>La calculadora de presupuestos: Tu comercial 24/7 en León</h2>
        <p>Una imprenta moderna en León necesita que el cliente pueda autogestionarse. Mediante nuestra tecnología de <strong>React</strong>, podemos crear formularios dinámicos que calculan el precio según el gramaje, el acabado y la cantidad de forma instantánea, sin que tú tengas que mover un dedo.</p>

        <h3>Funcionalidades críticas para tu imprenta digital:</h3>
        <ul>
            <li><strong>Carga de archivos pesados:</strong> Integración directa para que los artes finales lleguen a tu servidor o nube sin colapsar el correo.</li>
            <li><strong>Lógica de precios compleja:</strong> Descuentos por volumen y suplementos por urgencia calculados en tiempo real.</li>
            <li><strong>Estado del pedido:</strong> Un área de cliente donde los negocios de León puedan ver si su trabajo está en "Corte", "Impresión" o "Listo para recoger".</li>
        </ul>

        <div id="island-budget-calculator" class="my-10 p-8 bg-orange-50 rounded-3xl border-2 border-orange-200">
             <h3 class="text-2xl font-bold text-orange-900 mb-4">¿Cuánto cuesta digitalizar tu imprenta?</h3>
             <p class="text-orange-800 mb-6">Usa nuestro configurador para ver el coste de implementar un sistema de pedidos automático en tu web.</p>
             <!-- React Island Mount Point -->
             <div class="p-4 bg-orange-800 rounded animate-pulse text-white text-center">Cargando calculador de Imprenta...</div>
        </div>

        <h2>Antigravity: Rendimiento para catálogos pesados</h2>
        <p>Las webs de imprentas suelen fallar por el peso de las imágenes y la lentitud de los selectores. Al usar el tema <strong>Antigravity</strong> en <strong>León</strong>, garantizamos que tu catálogo de productos cargue al instante, mejorando la retención del usuario y, por tanto, tus ventas.</p>

        <h2>Posicionamiento SEO para imprentas leonesas</h2>
        <p>Gracias a nuestra integración con <strong>Rank Math</strong>, cada producto de tu catálogo estará optimizado para que cuando alguien en León busque "imprimir tarjetas de visita" o "cartelería gran formato León", tu negocio sea la primera opción.</p>
        <!-- /wp:html -->
        ';

        // Intentar obtener ID de categoría por slug, si no default
        $cat_ids = [];
        $term = get_term_by('slug', 'wordpress-negocio', 'category');
        if ($term)
            $cat_ids[] = $term->term_id;
        else
            $cat_ids[] = 1;

        $post_id = wp_insert_post([
            'post_title' => 'Web para imprentas en León: Cómo automatizar presupuestos y recibir archivos sin caos',
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => $cat_ids,
            'post_excerpt' => 'Automatiza la recepción de pedidos en tu imprenta de León. Calculadoras de precios dinámicas y subida de archivos pesados con Antigravity.'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_empc_react_config', $json_config);
        }
    }
});
/**
 * Insertar Post #6: WPO y Velocidad
 */
add_action('init', function () {
    if (!get_page_by_title('Mi web en WordPress carga lenta: Guía WPO para negocios de León', OBJECT, 'post')) {
        $json_config = '{
          "post_type": "blog",
          "post_id": "wpo-wordpress-leon",
          "category": {
            "slug": "rendimiento-wpo",
            "name": "Rendimiento / WPO"
          },
          "seo_keywords": ["web lenta León", "WPO WordPress León", "Core Web Vitals León", "optimizar velocidad web"],
          "primary_cta": "island-budget-calculator",
          "island_data": {
            "calculator_mode": "performance-focus",
            "feature_highlight": "speed-optimization",
            "promo_code": "LEON-RAPIDO"
          }
        }';

        $content = '
        <!-- wp:html -->
        <h1>Mi web en WordPress carga lenta: Guía WPO para negocios de León</h1>

        <p>¿Sabías que si tu web tarda más de 3 segundos en cargar, la mitad de tus posibles clientes en <strong>León</strong> cerrarán la pestaña antes de verte? En un mercado local cada vez más digitalizado, la velocidad no es un lujo; es el factor que decide si vendes tú o tu competencia en la Calle Ancha.</p>

        <h2>El coste real de una web lenta en León</h2>
        <p>Google utiliza los llamados <strong>Core Web Vitals</strong> para medir la experiencia de usuario. Si tu negocio en León ofrece una experiencia lenta, Google te penalizará bajándote en los resultados de búsqueda. Además, una web pesada consume más datos móviles, algo crítico para usuarios que te buscan mientras pasean por el centro de la ciudad.</p>

        <h3>¿Por qué falla tu WordPress actual?</h3>
        <ul>
            <li><strong>Exceso de Plugins:</strong> El uso de constructores como Elementor o Divi añade miles de líneas de código innecesario.</li>
            <li><strong>Imágenes sin optimizar:</strong> Subir fotos directamente de la cámara sin pasar por herramientas de compresión.</li>
            <li><strong>Hosting mal configurado:</strong> No aprovechar la potencia de servidores locales o cachés de alto nivel.</li>
        </ul>

        <div id="island-budget-calculator" class="my-10 p-8 bg-indigo-900 rounded-3xl text-white shadow-2xl">
            <h3 class="text-2xl font-black mb-4 text-indigo-300">¿Quieres una web que vuele?</h3>
            <p class="mb-6">Calcula cuánto costaría migrar tu sitio actual al stack de <strong>Antigravity</strong> y mejorar tus métricas de Google de inmediato.</p>
            <!-- React Island Mount Point -->
            <div class="p-4 bg-indigo-700/50 rounded animate-pulse text-center">Cargando calculadora WPO...</div>
        </div>

        <h2>La solución Antigravity: React al servicio de tu velocidad</h2>
        <p>A diferencia de las agencias tradicionales en León que solo instalan plantillas, en <strong>EMPC</strong> hemos desarrollado el tema <strong>Antigravity</strong>. Al separar la visualización (React) de la gestión (WordPress), eliminamos el "ruido" técnico. El resultado es una web instantánea, con transiciones fluidas que parecen una aplicación móvil.</p>

        <h2>Checklist de WPO para tu pyme en León</h2>
        <ol>
            <li><strong>Mide tus tiempos:</strong> Usa PageSpeed Insights para ver tu nota actual.</li>
            <li><strong>Limpia tu base de datos:</strong> Elimina revisiones antiguas y comentarios spam.</li>
            <li><strong>Implementa WebP:</strong> Cambia tus PNGs pesados por formatos modernos de última generación.</li>
        </ol>

        <p>Si este checklist te parece chino, no te preocupes. Estamos aquí en <strong>León</strong> para ayudarte a que tu tecnología sea un motor, no un freno.</p>
        <!-- /wp:html -->
        ';

        // Intentar obtener ID de categoría por slug, si no default
        $cat_ids = [];
        $term = get_term_by('slug', 'rendimiento-wpo', 'category');
        if ($term)
            $cat_ids[] = $term->term_id;
        else
            $cat_ids[] = 1;

        $post_id = wp_insert_post([
            'post_title' => 'Mi web en WordPress carga lenta: Guía WPO para negocios de León',
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => $cat_ids,
            'post_excerpt' => 'Guía de optimización WPO para negocios en León. Descubre por qué tu web carga lenta y cómo los Core Web Vitals afectan a tu posicionamiento.'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_empc_react_config', $json_config);
        }
    }
});

/**
 * Insertar Post #7: Restaurantes (Barrio Húmedo/Romántico)
 */
add_action('init', function () {
    if (!get_page_by_title('Webs para restaurantes en León: Más allá del PDF de la carta', OBJECT, 'post')) {
        $json_config = '{
          "post_type": "blog",
          "post_id": "web-restaurantes-leon",
          "category": {
            "slug": "reservas-y-automatizacion",
            "name": "Reservas y automatización"
          },
          "seo_keywords": ["web para restaurantes León", "carta digital interactiva León", "reservas mesa online León"],
          "primary_cta": "island-budget-calculator",
          "island_data": {
            "calculator_mode": "restaurant-focus",
            "feature_highlight": "interactive-menu-module",
            "upsell": "google-maps-pack"
          }
        }';

        $content = '
        <!-- wp:html -->
        <h1>Webs para restaurantes en León: Más allá del PDF de la carta</h1>

        <p>En una ciudad con la cultura gastronómica de <strong>León</strong>, desde las tapas del Húmedo hasta los restaurantes del Romántico, tu presencia digital es tu primera mesa. Si tu cliente todavía tiene que descargar un PDF pesado para ver tus precios, estás perdiendo reservas.</p>

        <h2>La evolución: Menús interactivos con React</h2>
        <p>Con el stack <strong>Antigravity</strong>, transformamos tu carta en una experiencia fluida. Gracias a React, los clientes pueden filtrar por alérgenos o ver platos del día de forma instantánea, sin esperas ni recargas de página. Es la tecnología de las grandes cadenas, adaptada a la hostelería leonesa.</p>

        <h3>¿Qué necesita tu restaurante para destacar en León?</h3>
        <ul>
            <li><strong>Reservas inteligentes:</strong> Un sistema que gestione turnos y evite el "no-show".</li>
            <li><strong>SEO Gastronómico:</strong> Aparecer cuando alguien busca "dónde comer cocido maragato" o "mejores tapas en León".</li>
            <li><strong>Velocidad móvil:</strong> Tus clientes te buscan en la calle, con 4G limitado; tu web debe ser la más rápida.</li>
        </ul>

        <div id="island-budget-calculator" class="my-10 p-8 bg-red-50 rounded-3xl border-2 border-red-200">
             <h3 class="text-2xl font-bold text-red-900 mb-4">¿Digitalizamos tu cocina?</h3>
             <p class="text-red-800 mb-6">Calcula cuánto cuesta integrar un sistema de reservas y carta interactiva en tu local de León.</p>
             <!-- React Island Mount Point -->
             <div class="p-4 bg-red-800/20 rounded animate-pulse text-center text-red-700">Cargando calculadora Restauración...</div>
        </div>
        <!-- /wp:html -->
        ';

        // Intentar obtener ID de categoría por slug, si no default
        $cat_ids = [];
        $term = get_term_by('slug', 'reservas-automatizacion', 'category');
        if ($term)
            $cat_ids[] = $term->term_id;
        else
            $cat_ids[] = 1;

        $post_id = wp_insert_post([
            'post_title' => 'Webs para restaurantes en León: Más allá del PDF de la carta',
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => $cat_ids,
            'post_excerpt' => 'Digitaliza tu restaurante en León. Menús interactivos, reservas online y SEO local para captar más clientes en el Húmedo y el Romántico.'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_empc_react_config', $json_config);
        }
    }
});

/**
 * Insertar Post #8: Comercio Local / Panaderías
 */
add_action('init', function () {
    if (!get_page_by_title('Tiendas de barrio en León: Cómo competir con los grandes desde el mostrador digital', OBJECT, 'post')) {
        $json_config = '{
          "post_type": "blog",
          "post_id": "comercio-local-panaderia-leon",
          "category": {
            "slug": "wordpress-para-negocio",
            "name": "WordPress para negocio"
          },
          "seo_keywords": ["web para comercios León", "panadería online León", "encargos web comercio local"],
          "primary_cta": "island-budget-calculator",
          "island_data": {
            "calculator_mode": "local-shop-focus",
            "feature_highlight": "click-and-collect-logic"
          }
        }';

        $content = '
        <!-- wp:html -->
        <h1>Tiendas de barrio en León: Cómo competir con los grandes desde el mostrador digital</h1>

        <p>Una panadería artesana en el barrio de El Ejido o una tienda de productos de León tiene algo que Amazon no tiene: cercanía. Pero para que esa cercanía funcione en 2026, tus clientes en <strong>León</strong> deben poder encontrarte y reservar sus productos desde el móvil.</p>

        <h2>El "Click & Collect" leonés</h2>
        <p>No necesitas un ecommerce complejo. Necesitas una web rápida donde tus clientes habituales vean el pan especial del día o el stock de productos de temporada y puedan "apartarlo" para recogerlo al salir del trabajo. Eso es lo que logramos con <strong>Antigravity</strong>: tecnología útil para el día a día.</p>

        <h3>Claves para el pequeño comercio en León:</h3>
        <ul>
            <li><strong>Ficha de Google Maps optimizada:</strong> Para que "panadería cerca de mí" sea tu negocio.</li>
            <li><strong>Actualización fácil:</strong> Cambia tus productos destacados desde el móvil con WordPress en segundos.</li>
            <li><strong>Fidelización local:</strong> Contacto directo por WhatsApp integrado en tu isla de React.</li>
        </ul>

        <div id="island-budget-calculator" class="my-10 p-8 bg-amber-50 rounded-3xl border-2 border-amber-200">
             <h3 class="text-2xl font-bold text-amber-900 mb-4">Lleva tu mostrador a Internet</h3>
             <p class="text-amber-800 mb-6">Obtén un presupuesto para una web sencilla, rápida y efectiva para tu comercio en León.</p>
             <!-- React Island Mount Point -->
             <div class="p-4 bg-amber-800/10 rounded animate-pulse text-center text-amber-700">Cargando calculadora Comercio...</div>
        </div>
        <!-- /wp:html -->
        ';

        // Intentar obtener ID de categoría por slug, si no default
        $cat_ids = [];
        $term = get_term_by('slug', 'wordpress-negocio', 'category');
        if ($term)
            $cat_ids[] = $term->term_id;
        else
            $cat_ids[] = 1;

        $post_id = wp_insert_post([
            'post_title' => 'Tiendas de barrio en León: Cómo competir con los grandes desde el mostrador digital',
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => $cat_ids,
            'post_excerpt' => 'Soluciones web reales para el pequeño comercio de León. Click & Collect, visibilidad en Google Maps y gestión sencilla para panaderías y tiendas locales.'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_empc_react_config', $json_config);
        }
    }

    // 10. Insertar Post #9 "Especial Hostelería en León (Simulación de Reservas)"
    if (!get_page_by_title('Especial Hostelería en León (Simulación de Reservas)', OBJECT, 'post')) {
        $json_config = '{
          "post_type": "blog",
          "post_id": "demo-reservas-restaurantes-leon",
          "category": {
            "slug": "reservas-y-automatizacion",
            "name": "Reservas y automatización"
          },
          "seo_keywords": ["reservas online restaurantes León", "digitalizar restaurante León", "sistema de turnos hostelería"],
          "primary_cta": "island-booking",
          "island_data": {
            "mode": "demo-mode",
            "venue_type": "restaurant",
            "location": "León Centro"
          }
        }';

        $content = '
        <!-- wp:html -->
        <h1>¿Tu restaurante en León sigue perdiendo clientes por culpa del teléfono?</h1>
        <p>Imagínate esto: es viernes noche, tu local en el Barrio Húmedo está a tope y el teléfono no para de sonar. No puedes atenderlo, y cada llamada perdida es una mesa vacía para mañana. En <strong>León</strong>, los clientes ya no quieren esperar; quieren reservar su mesa mientras se toman una corta en la plaza.</p>
        <h2>La diferencia entre un formulario y un Sistema de Reservas</h2> <p>Muchos negocios cometen el error de poner un simple correo de contacto. Eso no es digitalizar. Un sistema real, construido con <strong>React y Antigravity</strong>, permite al cliente ver la disponibilidad en tiempo real y recibir una confirmación inmediata.</p>
        <h3>¿Por qué esta demo es el futuro de tu local?</h3> <ul> <li><strong>Cero esperas:</strong> El cliente elige día y hora en 3 clicks.</li> <li><strong>Optimizado para móviles:</strong> Perfecto para el turista que busca "dónde cenar en León" desde su smartphone.</li> <li><strong>Sin comisiones por cubierto:</strong> Es tu tecnología, en tu propia web.</li> </ul>
        <div class="my-12 p-2 bg-gradient-to-br from-slate-100 to-white rounded-3xl shadow-inner border border-slate-200">
            <div id="island-booking"></div>
            <p class="text-center text-xs text-slate-400 mt-4 italic">Simulación de reserva real: Prueba a seleccionar un servicio y una hora para ver la fluidez del sistema.</p>
        </div>
        <h2>Tecnología de León para la hostelería de León</h2> <p>En <strong>EMPC</strong> no solo instalamos software; diseñamos experiencias. Al usar este sistema de reservas, liberas a tu personal de las llamadas y aseguras que tu base de datos de clientes crezca cada día, permitiéndote enviar promociones en San Froilán o Semana Santa de forma automática.</p>
        <!-- /wp:html -->
        ';

        // Intentar obtener ID de categoría por slug
        $cat_ids = [];
        $term = get_term_by('slug', 'reservas-y-automatizacion', 'category');
        if ($term)
            $cat_ids[] = $term->term_id;
        else
            $cat_ids[] = 1;

        $post_id = wp_insert_post([
            'post_title' => 'Especial Hostelería en León (Simulación de Reservas)',
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => $cat_ids,
            'post_excerpt' => 'Demo interactiva de reservas para restaurantes en León. Digitaliza tu local del Húmedo sin pagar comisiones.'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_empc_react_config', $json_config);
        }
    }
});
