<?php
// TEMPORARY FIX - Replace the script loading section in functions.php

function empc_load_scripts_fixed() {
    // BLINDAJE: No cargar nada en admin, cron, ajax o REST
    if (is_admin() || wp_doing_ajax() || wp_doing_cron() || defined('REST_REQUEST')) {
        return;
    }

    // Detectar página para React
    $should_load_react = is_front_page() || is_home() || is_page_template('page-tiendas-online.php') || is_page_template('page-service.php') || is_page_template('page-calculator.php');

    if ($should_load_react) {
        // Cargar assets
        $react_css = get_template_directory_uri() . '/react-app/assets/styles.css';
        $react_js = get_template_directory_uri() . '/react-app/assets/app.js';
        $react_css_path = EMPC_THEME_DIR . '/react-app/assets/styles.css';
        $react_js_path = EMPC_THEME_DIR . '/react-app/assets/app.js';

        // CSS
        if (file_exists($react_css_path)) {
            wp_enqueue_style('empc-react-styles', $react_css, [], filemtime($react_css_path));
        }

        // JS - sin type="module" para evitar conflictos
        if (file_exists($react_js_path)) {
            wp_enqueue_script('empc-react', $react_js, [], filemtime($react_js_path), [
                'strategy' => 'defer',
                'in_footer' => true
            ]);
        }

        // Datos para React - inline para asegurar carga
        $data = [
            'siteUrl' => home_url(),
            'restUrl' => get_rest_url(),
            'nonce' => wp_create_nonce('wp_rest'),
            'isLoggedIn' => is_user_logged_in(),
            'postConfig' => null
        ];
        
        wp_add_inline_script('empc-react', 'window.empcData = ' . json_encode($data) . ';', []);
    }

    // Estilos base del tema
    wp_enqueue_style('empc-theme-style', get_stylesheet_uri(), [], EMPC_THEME_VERSION);
}
add_action('wp_enqueue_scripts', 'empc_load_scripts_fixed');

// Reemplazar la función original temporalmente
remove_action('wp_enqueue_scripts', 'empc_load_scripts');
?>
