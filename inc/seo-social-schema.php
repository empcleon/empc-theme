<?php

defined('ABSPATH') || exit;

if (!function_exists('empc_seo_rank_math_active')) {
    function empc_seo_rank_math_active(): bool
    {
        return defined('RANK_MATH_VERSION');
    }
}

if (!function_exists('empc_seo_service_slugs')) {
    function empc_seo_service_slugs(): array
    {
        return [
            'diseno-web-leon',
            'tiendas-online-leon',
            'mantenimiento-wordpress-leon',
            'alquiler-pagina-web-empresas-y-autonomos',
        ];
    }
}

if (!function_exists('empc_seo_current_service_config')) {
    function empc_seo_current_service_config(): array
    {
        if (!is_singular()) {
            return [];
        }

        $raw = get_post_meta(get_the_ID(), '_empc_service_config', true);
        if (is_string($raw) && $raw !== '') {
            $decoded = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        if (is_array($raw)) {
            return $raw;
        }

        $slug = (string) get_post_field('post_name', get_the_ID());
        $service_configs = [
            'diseno-web-leon' => 'get_diseno_web_leon_config',
            'tiendas-online-leon' => 'get_tiendas_online_config',
            'seo-local-leon' => 'get_seo_local_leon_config',
        ];

        if (!empty($service_configs[$slug]) && function_exists($service_configs[$slug])) {
            $config = call_user_func($service_configs[$slug]);
            return is_array($config) ? $config : [];
        }

        return [];
    }
}

if (!function_exists('empc_seo_title_override')) {
    function empc_seo_title_override(): string
    {
        if (!is_singular('post')) {
            return '';
        }

        $slug = (string) get_post_field('post_name', get_the_ID());
        $overrides = [
            'pedidos-en-woocommerce-mediante-pasarelas-de-pago' => 'Cambiar estado de pedidos WooCommerce por pasarela | EMPC',
            'webs-para-imprentas-leon' => 'Web para imprentas en León: presupuestos y archivos | EMPC',
            'reservas-online-clinicas-leon' => 'Sistema de reservas online para clínicas en León | EMPC',
            'comercio-local-panaderia-leon' => 'Tiendas de barrio en León: venta online local | EMPC',
            'webs-restaurantes-leon-booking' => 'Webs para restaurantes en León: reservas online | EMPC',
            'seo-local-leon' => 'SEO local en León: mejora tu posición en Google Maps | EMPC',
            'pedido-a-un-cliente-con-enlace-directo-al-pago' => 'Crear pedidos WooCommerce con enlace de pago | EMPC',
            'formato-condicional-de-una-celda-excel' => 'Formato condicional en Excel según otra celda | EMPC',
            'tienda-online-con-tienda-fisica' => 'Tienda online y tienda física: comercio local | EMPC',
        ];

        return $overrides[$slug] ?? '';
    }
}

if (!function_exists('empc_seo_preferred_title')) {
    function empc_seo_preferred_title(): string
    {
        $site_name = 'EMPC';
        if (empc_is_laboratorio_ia_request()) {
            return function_exists('empc_laboratorio_ia_title') ? empc_laboratorio_ia_title() : 'Laboratorio IA: prompts y workflows en español | EMPC';
        }

        if (is_front_page()) {
            return 'Diseño Web y Mantenimiento WordPress en León | EMPC';
        }

        if (is_home()) {
            return 'Blog | EMPC';
        }

        if (is_singular('post')) {
            $title_override = empc_seo_title_override();
            return $title_override !== '' ? $title_override : get_the_title() . ' | ' . $site_name;
        }

        if (is_category()) {
            return single_cat_title('', false) . ' | ' . $site_name;
        }

        if (is_page('contacta-conmigo')) {
            return get_the_title() . ' | ' . $site_name;
        }

        if (is_page()) {
            $service_config = empc_seo_current_service_config();
            if (!empty($service_config['seo']['title'])) {
                return wp_strip_all_tags((string) $service_config['seo']['title']);
            }

            if (!empty($service_config['hero']['title'])) {
                $hero_title = trim(wp_strip_all_tags((string) $service_config['hero']['title']) . ' ' . wp_strip_all_tags((string) ($service_config['hero']['highlight'] ?? '')));
                if ($hero_title !== '') {
                    return $hero_title . ' | EMPC';
                }
            }

            return get_the_title() . ' | ' . $site_name;
        }

        if (is_tag()) {
            return single_tag_title('', false) . ' | ' . $site_name;
        }

        if (is_404()) {
            return 'Página no encontrada | ' . $site_name;
        }

        return $site_name;
    }
}

        if (!function_exists('empc_seo_current_context')) {
    function empc_seo_current_context(): array
    {
        $home_title = 'Diseño Web y Mantenimiento WordPress en León | EMPC';
        $home_description = 'Diseño web y mantenimiento WordPress en León. EMPC crea webs rápidas, claras y orientadas a captar clientes.';
        $site_description = trim((string) get_bloginfo('description'));
        $site_name = 'EMPC';

        $context = [
            'kind' => 'page',
            'title' => empc_seo_preferred_title(),
            'description' => $site_description !== '' ? $site_description : $home_description,
            'canonical' => home_url('/'),
            'og_type' => 'website',
            'schema_page_type' => 'WebPage',
            'schema_main_type' => 'WebPage',
            'schema_page_name' => empc_seo_preferred_title(),
            'schema_page_description' => $site_description !== '' ? $site_description : $home_description,
            'site_name' => $site_name,
            'service_type' => '',
            'service_page' => false,
            'image_alt' => $site_name . ' · Webs, tiendas online y mantenimiento WordPress',
            'image_preference' => 'fallback',
        ];

        if (empc_is_laboratorio_ia_request()) {
            $context['kind'] = 'laboratorio';
            $context['title'] = function_exists('empc_laboratorio_ia_title') ? empc_laboratorio_ia_title() : 'Laboratorio IA: prompts y workflows en español | EMPC';
            $context['description'] = function_exists('empc_laboratorio_ia_description') ? empc_laboratorio_ia_description() : 'Explora prompts, recursos y workflows de inteligencia artificial probados por EMPC, con ejemplos, compatibilidad, fecha de revisión y límites conocidos.';
            $context['canonical'] = function_exists('empc_laboratorio_ia_canonical') ? empc_laboratorio_ia_canonical() : home_url('/laboratorio-ia/');
            $context['og_type'] = 'website';
            $context['schema_page_type'] = 'WebPage';
            $context['schema_main_type'] = 'WebPage';
            $context['schema_page_name'] = $context['title'];
            $context['schema_page_description'] = $context['description'];
            return $context;
        }

        if (is_front_page()) {
            $context['kind'] = 'home';
            $context['title'] = $home_title;
            $context['description'] = $home_description;
            $context['canonical'] = home_url('/');
            $context['og_type'] = 'website';
            $context['schema_page_type'] = 'HomePage';
            $context['schema_main_type'] = 'HomePage';
            $context['schema_page_name'] = $home_title;
            $context['schema_page_description'] = $home_description;
            return $context;
        }

        if (is_home()) {
            $context['kind'] = 'blog';
            $context['title'] = 'Blog | EMPC';
            $context['description'] = $site_description !== '' ? $site_description : 'Blog de EMPC con artículos, tutoriales y casos prácticos.';
            $context['canonical'] = home_url('/blog/');
            $context['og_type'] = 'website';
            $context['schema_page_type'] = 'WebPage';
            $context['schema_main_type'] = 'WebPage';
            $context['schema_page_name'] = 'Blog';
            $context['schema_page_description'] = $context['description'];
            return $context;
        }

        if (is_singular('post')) {
            $context['kind'] = 'post';
            $context['title'] = empc_seo_preferred_title();
            $context['description'] = empc_trim_description(get_the_excerpt(), wp_strip_all_tags(get_post_field('post_content', get_the_ID())), 220);
            $context['canonical'] = get_permalink();
            $context['og_type'] = 'article';
            $context['schema_page_type'] = 'WebPage';
            $context['schema_main_type'] = 'BlogPosting';
            $context['schema_page_name'] = get_the_title();
            $context['schema_page_description'] = $context['description'];
            return $context;
        }

        if (is_category()) {
            $term = get_queried_object();
            if ($term instanceof WP_Term) {
                $term_desc = trim((string) term_description($term));
                $context['kind'] = 'category';
                $context['title'] = single_cat_title('', false) . ' | EMPC';
                $context['description'] = $term_desc !== '' ? wp_strip_all_tags($term_desc) : 'Archivo de categoría de EMPC.';
                $link = get_term_link($term);
                if (!is_wp_error($link)) {
                    $context['canonical'] = $link;
                }
                $context['og_type'] = 'website';
                $context['schema_page_type'] = 'WebPage';
                $context['schema_main_type'] = 'WebPage';
                $context['schema_page_name'] = single_cat_title('', false);
                $context['schema_page_description'] = $context['description'];
            }
            return $context;
        }

        if (is_page()) {
            $context['title'] = empc_seo_preferred_title();
            $context['description'] = empc_trim_description(get_the_excerpt(), wp_strip_all_tags(get_post_field('post_content', get_the_ID())), 220);
            $context['canonical'] = get_permalink();
            $context['schema_page_name'] = get_the_title();
            $context['schema_page_description'] = $context['description'];

            if (is_page('contacta-conmigo')) {
                $context['kind'] = 'contact';
                $context['og_type'] = 'website';
                $context['schema_main_type'] = 'ContactPage';
                $context['schema_page_type'] = 'ContactPage';
            } elseif (in_array(get_post_field('post_name', get_the_ID()), empc_seo_service_slugs(), true) || !empty(empc_seo_current_service_config())) {
                $context['kind'] = 'service';
                $context['og_type'] = 'website';
                $context['schema_main_type'] = 'Service';
                $context['schema_page_type'] = 'WebPage';
                $context['service_page'] = true;
                $context['service_type'] = empc_seo_service_type_label((string) get_post_field('post_name', get_the_ID()));

                $service_config = empc_seo_current_service_config();
                if (!empty($service_config['seo']['description'])) {
                    $context['description'] = wp_strip_all_tags((string) $service_config['seo']['description']);
                } elseif (!empty($service_config['hero']['description'])) {
                    $context['description'] = wp_strip_all_tags((string) $service_config['hero']['description']);
                }

                if (!empty($service_config['seo']['title'])) {
                    $context['title'] = wp_strip_all_tags((string) $service_config['seo']['title']);
                } elseif (!empty($service_config['hero']['title'])) {
                    $hero_title = trim(wp_strip_all_tags((string) $service_config['hero']['title']) . ' ' . wp_strip_all_tags((string) ($service_config['hero']['highlight'] ?? '')));
                    if ($hero_title !== '') {
                        $context['title'] = $hero_title . ' | EMPC';
                    }
                }

                $context['schema_page_name'] = get_the_title();
                $context['schema_page_description'] = $context['description'];
            }
        }

        return $context;
    }
}

if (!function_exists('empc_trim_description')) {
    function empc_trim_description($primary, $fallback = '', int $max_length = 220): string
    {
        foreach ([$primary, $fallback] as $text) {
            $text = is_string($text) ? wp_strip_all_tags(trim($text)) : '';
            $text = preg_replace('/\s+/u', ' ', $text) ?? $text;
            if ($text !== '') {
                return function_exists('mb_substr') ? mb_substr($text, 0, $max_length) : substr($text, 0, $max_length);
            }
        }

        return '';
    }
}

if (!function_exists('empc_seo_service_type_label')) {
    function empc_seo_service_type_label(string $slug): string
    {
        return match ($slug) {
            'diseno-web-leon' => 'Diseño web',
            'tiendas-online-leon' => 'Tiendas online',
            'mantenimiento-wordpress-leon' => 'Mantenimiento WordPress',
            'alquiler-pagina-web-empresas-y-autonomos' => 'Alquiler de web',
            default => 'Servicio web',
        };
    }
}

if (!function_exists('empc_seo_site_data')) {
    function empc_seo_site_data(): array
    {
        $home = home_url('/');
        $logo = get_template_directory_uri() . '/react-app/assets/logo-transparent.png';
        $logo_path = EMPC_THEME_DIR . '/react-app/assets/logo-transparent.png';
        $logo_size = [951, 262];
        if (file_exists($logo_path)) {
            $image_size = @getimagesize($logo_path);
            if (is_array($image_size) && !empty($image_size[0]) && !empty($image_size[1])) {
                $logo_size = [(int) $image_size[0], (int) $image_size[1]];
            }
        }

        return [
            'name' => 'EMPC',
            'url' => $home,
            'email' => 'info@empc.es',
            'website_id' => rtrim($home, '/') . '/#website',
            'organization_id' => rtrim($home, '/') . '/#organization',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $logo,
                'width' => $logo_size[0],
                'height' => $logo_size[1],
            ],
            'sameAs' => [
                'https://www.facebook.com/empcleon',
                'https://github.com/empcleon',
            ],
            'areaServed' => [
                '@type' => 'Place',
                'name' => 'León',
            ],
        ];
    }
}

if (!function_exists('empc_seo_social_image_data')) {
    function empc_seo_social_image_data(): array
    {
        $fallback_url = get_template_directory_uri() . '/assets/images/empc-og-default.png';
        $fallback_path = EMPC_THEME_DIR . '/assets/images/empc-og-default.png';
        $fallback_width = 1200;
        $fallback_height = 630;
        if (file_exists($fallback_path)) {
            $size = @getimagesize($fallback_path);
            if (is_array($size) && !empty($size[0]) && !empty($size[1])) {
                $fallback_width = (int) $size[0];
                $fallback_height = (int) $size[1];
            }
        }

        $image = [
            'url' => $fallback_url,
            'width' => $fallback_width,
            'height' => $fallback_height,
            'alt' => 'EMPC · Webs, tiendas online y mantenimiento WordPress',
            'source' => 'fallback',
        ];

        if (!is_singular() || post_password_required()) {
            return $image;
        }

        $post_id = get_the_ID();
        if ($post_id && has_post_thumbnail($post_id)) {
            $thumbnail_id = get_post_thumbnail_id($post_id);
            $src = wp_get_attachment_image_src($thumbnail_id, 'full');
            if (is_array($src) && !empty($src[0])) {
                $image = [
                    'url' => $src[0],
                    'width' => !empty($src[1]) ? (int) $src[1] : $fallback_width,
                    'height' => !empty($src[2]) ? (int) $src[2] : $fallback_height,
                    'alt' => trim((string) get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)) ?: get_the_title($post_id),
                    'source' => 'featured',
                ];
            }
        }

        return $image;
    }
}

if (!function_exists('empc_seo_schema_image_object')) {
    function empc_seo_schema_image_object(array $image): array
    {
        return [
            '@type' => 'ImageObject',
            'url' => $image['url'] ?? '',
            'width' => (int) ($image['width'] ?? 0),
            'height' => (int) ($image['height'] ?? 0),
        ];
    }
}

if (!function_exists('empc_seo_json_ld_entities')) {
    function empc_seo_json_ld_entities(): array
    {
        $context = empc_seo_current_context();
        $site = empc_seo_site_data();
        $image = empc_seo_social_image_data();
        $canonical = !empty($context['canonical']) ? $context['canonical'] : home_url('/');
        $page_id = rtrim($canonical, '/') . '#webpage';
        $organization_id = $site['organization_id'];
        $website_id = $site['website_id'];

        $entities = [];

        $entities['Organization'] = [
            '@type' => ['Organization', 'ProfessionalService'],
            '@id' => $organization_id,
            'name' => $site['name'],
            'url' => $site['url'],
            'email' => $site['email'],
            'logo' => $site['logo'],
            'sameAs' => $site['sameAs'],
            'areaServed' => $site['areaServed'],
        ];

        $entities['WebSite'] = [
            '@type' => 'WebSite',
            '@id' => $website_id,
            'url' => $site['url'],
            'name' => $site['name'],
            'publisher' => [
                '@id' => $organization_id,
            ],
            'inLanguage' => get_locale(),
        ];

        $page_entity = [
            '@type' => $context['schema_page_type'] ?? 'WebPage',
            '@id' => $page_id,
            'url' => $canonical,
            'name' => $context['schema_page_name'] ?? $context['title'],
            'description' => $context['schema_page_description'] ?? $context['description'],
            'isPartOf' => [
                '@id' => $website_id,
            ],
            'about' => [
                '@id' => $organization_id,
            ],
            'primaryImageOfPage' => empc_seo_schema_image_object($image),
            'inLanguage' => get_locale(),
        ];

        if (($context['schema_main_type'] ?? '') === 'HomePage') {
            $page_entity['@type'] = 'HomePage';
            $page_entity['mainEntity'] = [
                '@id' => $organization_id,
            ];
        } elseif (($context['schema_main_type'] ?? '') === 'ContactPage') {
            $page_entity['@type'] = 'ContactPage';
            $page_entity['mainEntity'] = [
                '@id' => $organization_id,
            ];
        } elseif (($context['schema_main_type'] ?? '') === 'Service') {
            $service_type = $context['service_type'] !== '' ? $context['service_type'] : get_the_title();
            $service_id = rtrim($canonical, '/') . '#service';
            $entities['Service'] = [
                '@type' => 'Service',
                '@id' => $service_id,
                'name' => get_the_title(),
                'url' => $canonical,
                'description' => $context['description'],
                'serviceType' => $service_type,
                'provider' => [
                    '@id' => $organization_id,
                ],
                'areaServed' => $site['areaServed'],
            ];
            $page_entity['mainEntity'] = [
                '@id' => $service_id,
            ];
        } elseif (($context['schema_main_type'] ?? '') === 'BlogPosting') {
            $author_id = get_the_author_meta('ID');
            $author_name = $author_id ? get_the_author_meta('display_name', $author_id) : get_bloginfo('name');
            $page_entity['@type'] = 'WebPage';
            $entities['BlogPosting'] = [
                '@type' => 'BlogPosting',
                '@id' => rtrim($canonical, '/') . '#article',
                'headline' => get_the_title(),
                'name' => get_the_title(),
                'description' => $context['description'],
                'url' => $canonical,
                'datePublished' => get_the_date(DATE_W3C),
                'dateModified' => get_the_modified_date(DATE_W3C),
                'author' => [
                    '@type' => 'Person',
                    'name' => $author_name,
                ],
                'publisher' => [
                    '@id' => $organization_id,
                ],
                'image' => empc_seo_schema_image_object($image),
                'mainEntityOfPage' => [
                    '@id' => $page_id,
                ],
            ];
            $page_entity['mainEntity'] = [
                '@id' => rtrim($canonical, '/') . '#article',
            ];
        }

        $entities['WebPage'] = $page_entity;

        return $entities;
    }
}

if (!function_exists('empc_seo_render_json_ld')) {
    function empc_seo_render_json_ld(): void
    {
        if (!empty($GLOBALS['empc_front_page_pagination_404'])) {
            return;
        }

        $graph = empc_seo_json_ld_entities();
        if (empty($graph)) {
            return;
        }

        echo '<script type="application/ld+json">' . wp_json_encode([
            '@context' => 'https://schema.org',
            '@graph' => array_values($graph),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}

if (!function_exists('empc_seo_render_social_meta')) {
    function empc_seo_render_social_meta(): void
    {
        $context = empc_seo_current_context();
        $image = empc_seo_social_image_data();
        $title = $context['title'] ?? wp_get_document_title();
        $description = $context['description'] ?? '';
        $canonical = $context['canonical'] ?? home_url('/');
        $type = $context['og_type'] ?? 'website';

        echo '<meta property="og:type" content="' . esc_attr($type) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        if ($description !== '') {
            echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        }
        echo '<meta property="og:url" content="' . esc_url($canonical) . '" />' . "\n";
        echo '<meta property="og:site_name" content="EMPC" />' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image['url']) . '" />' . "\n";
        echo '<meta property="og:image:width" content="' . esc_attr((string) $image['width']) . '" />' . "\n";
        echo '<meta property="og:image:height" content="' . esc_attr((string) $image['height']) . '" />' . "\n";
        echo '<meta property="og:image:alt" content="' . esc_attr($image['alt']) . '" />' . "\n";
        if (str_starts_with($image['url'], 'https://')) {
            echo '<meta property="og:image:secure_url" content="' . esc_url($image['url']) . '" />' . "\n";
        }

        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '" />' . "\n";
        if ($description !== '') {
            echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
        }
        echo '<meta name="twitter:image" content="' . esc_url($image['url']) . '" />' . "\n";
        echo '<meta name="twitter:image:alt" content="' . esc_attr($image['alt']) . '" />' . "\n";
    }
}

if (!function_exists('empc_seo_rank_math_filters')) {
    function empc_seo_merge_rank_math_organization(array $data): array
    {
        $site = empc_seo_site_data();
        $organization_id = $site['organization_id'];
        $organization = [
            '@type' => ['Organization', 'ProfessionalService'],
            '@id' => $organization_id,
            'name' => $site['name'],
            'url' => $site['url'],
            'email' => $site['email'],
            'logo' => $site['logo'],
            'sameAs' => $site['sameAs'],
            'areaServed' => $site['areaServed'],
        ];

        if (is_front_page()) {
            foreach ($data as $key => $node) {
                if (!is_array($node)) {
                    continue;
                }

                $types = (array) ($node['@type'] ?? []);
                if (array_intersect(['Article', 'BlogPosting', 'NewsArticle'], $types)) {
                    unset($data[$key]);
                }
            }
        }

        $blog_posting_found = false;
        foreach ($data as $node) {
            if (!is_array($node)) {
                continue;
            }

            $types = (array) ($node['@type'] ?? []);
            if (in_array('BlogPosting', $types, true)) {
                $blog_posting_found = true;
                break;
            }
        }

        $is_real_post = get_post_type(get_the_ID()) === 'post';
        if ($is_real_post && !$blog_posting_found) {
            foreach ($data as $key => $node) {
                if (!is_array($node) || ($node['@type'] ?? null) !== '') {
                    continue;
                }

                $node_id = (string) ($node['@id'] ?? '');
                $has_editorial_fields = isset($node['headline'], $node['datePublished'], $node['author'])
                    && str_contains($node_id, '#richSnippet');
                if ($has_editorial_fields) {
                    $data[$key]['@type'] = 'BlogPosting';
                    $blog_posting_found = true;
                    break;
                }
            }
        }

        $organization_found = false;
        foreach ($data as $key => $node) {
            if (!is_array($node) || ($node['@id'] ?? '') !== $organization_id) {
                if (is_front_page() && ($node['@id'] ?? '') === rtrim(home_url('/'), '/') . '/#webpage') {
                    $data[$key]['@type'] = 'HomePage';
                }
                continue;
            }

            if (!$organization_found) {
                $data[$key] = array_merge($node, $organization);
                unset($data[$key]['address'], $data[$key]['location'], $data[$key]['openingHours'], $data[$key]['image']);
                $organization_found = true;
            } else {
                unset($data[$key]);
            }
        }

        if (!$organization_found) {
            $data['Organization'] = $organization;
        }

        $place_id = rtrim($site['url'], '/') . '/#place';
        foreach ($data as $key => $node) {
            if (!is_array($node) || ($node['@id'] ?? '') !== $place_id) {
                continue;
            }

            $referenced = false;
            foreach ($data as $reference_key => $reference_node) {
                if ($reference_key === $key || !is_array($reference_node)) {
                    continue;
                }

                $encoded = wp_json_encode($reference_node);
                if (is_string($encoded) && str_contains($encoded, '"@id":"' . $place_id . '"')) {
                    $referenced = true;
                    break;
                }
            }

            if (!$referenced) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    function empc_seo_rank_math_filters(): void
    {
        add_filter('rank_math/json_ld/disable_search', '__return_true');

        add_filter('rank_math/json_ld', function (array $data, $jsonld = null): array {
            if (!empty($GLOBALS['empc_front_page_pagination_404'])) {
                return [];
            }

            return empc_seo_merge_rank_math_organization($data);
        }, 9999, 1);

        add_filter('rank_math/frontend/title', function ($title) {
            $context = empc_seo_current_context();
            return !empty($context['title']) ? $context['title'] : $title;
        }, 20);

        add_filter('rank_math/frontend/robots', function ($robots = []) {
            if (empc_is_laboratorio_ia_request() && (is_404() || !empty($GLOBALS['empc_laboratorio_ia_is_404']))) {
                return ['noindex', 'follow'];
            }

            return $robots;
        }, 20);

        add_filter('rank_math/frontend/description', function ($description) {
            $context = empc_seo_current_context();
            return !empty($context['description']) ? $context['description'] : $description;
        }, 20);

        add_filter('rank_math/frontend/canonical', function ($canonical) {
            $context = empc_seo_current_context();
            return !empty($context['canonical']) ? $context['canonical'] : $canonical;
        }, 20);

        add_filter('rank_math/opengraph/type', function ($type = null) {
            $context = empc_seo_current_context();
            return !empty($context['og_type']) ? $context['og_type'] : $type;
        }, 20);

        add_filter('rank_math/opengraph/url', function ($url) {
            $context = empc_seo_current_context();
            return !empty($context['canonical']) ? $context['canonical'] : $url;
        }, 20);

        add_filter('rank_math/opengraph/facebook/image', function ($image) {
            $data = empc_seo_social_image_data();
            return !empty($data['url']) ? $data['url'] : $image;
        }, 20);

        add_filter('rank_math/opengraph/facebook/image_array', function ($attachment) {
            $data = empc_seo_social_image_data();
            return [
                'url' => $data['url'],
                'width' => $data['width'],
                'height' => $data['height'],
                'alt' => $data['alt'],
                'type' => 'image/png',
            ];
        }, 20);

        add_filter('rank_math/opengraph/twitter/card_type', function ($type = null) {
            return 'summary_large_image';
        }, 20);

        add_filter('rank_math/opengraph/twitter/image', function ($image) {
            $data = empc_seo_social_image_data();
            return !empty($data['url']) ? $data['url'] : $image;
        }, 20);

        add_filter('rank_math/opengraph/twitter/image_array', function ($attachment) {
            $data = empc_seo_social_image_data();
            return [
                'url' => $data['url'],
                'width' => $data['width'],
                'height' => $data['height'],
                'alt' => $data['alt'],
                'type' => 'image/png',
            ];
        }, 20);
    }
}

if (empc_seo_rank_math_active()) {
    empc_seo_rank_math_filters();
} else {
    add_action('wp_head', 'empc_seo_render_social_meta', 20);
    add_action('wp_head', 'empc_seo_render_json_ld', 21);
}
