<?php
/**
 * Service Pages Configuration & Helper Functions
 * Scalable system for managing service pages with React Islands
 */

/**
 * Insert or update a service page with React Islands configuration
 * 
 * @param string $title Page title
 * @param string $slug Page slug
 * @param array $config Service configuration array
 * @return int|false Post ID or false on failure
 */
function empc_insert_service_page($title, $slug, $config, $template = 'page-service.php')
{
    // Check if page already exists
    $existing_page = get_page_by_title($title, OBJECT, 'page');

    $page_data = [
        'post_title' => $title,
        'post_name' => $slug,
        'post_content' => '', // Content handled by page-service.php template
        'post_status' => 'publish',
        'post_type' => 'page',
        'page_template' => $template
    ];

    if ($existing_page) {
        $page_data['ID'] = $existing_page->ID;
        $page_id = wp_update_post($page_data);
    } else {
        $page_id = wp_insert_post($page_data);
    }

    if ($page_id && !is_wp_error($page_id)) {
        // Store service configuration as post meta - con caracteres UTF-8 sin escapar
        // IMPORTANTE: Usar wp_slash para evitar que update_post_meta elimine los escapes del JSON
        update_post_meta($page_id, '_empc_service_config', wp_slash(json_encode($config, JSON_UNESCAPED_UNICODE)));
        update_post_meta($page_id, '_empc_react_config', wp_slash(json_encode([
            'post_type' => 'page',
            'page_id' => $slug,
            'service_page' => true
        ], JSON_UNESCAPED_UNICODE)));

        return $page_id;
    }

    return false;
}

/**
 * Get service page configuration
 * 
 * @param int $page_id Page ID
 * @return array|null Configuration array or null if not found
 */
function empc_get_service_config($page_id)
{
    $config_json = get_post_meta($page_id, '_empc_service_config', true);

    if ($config_json) {
        return json_decode($config_json, true);
    }

    return null;
}
