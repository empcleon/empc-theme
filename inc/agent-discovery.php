<?php
/**
 * Static, human-curated discovery document for language models.
 *
 * This is descriptive only: it does not expose actions, credentials or
 * autonomous write capabilities.
 */

defined('ABSPATH') || exit;

/**
 * Return the maintained llms.txt document.
 */
function empc_llms_txt_content(): string
{
    return <<<'LLMS'
# EMPC

> Diseño web, tiendas online, mantenimiento WordPress y mejora de rendimiento para pequeños negocios. Servicio profesional con base en León y atención remota en España.

## Servicios

- [Diseño web en León](https://empc.es/diseno-web-leon/): páginas web corporativas y profesionales desde 900 € + IVA.
- [Landing pages](https://empc.es/diseno-landing-pages/): páginas de captación desde 600 € + IVA.
- [Tiendas online](https://empc.es/freelance-diseno-tienda-online-leon/): WooCommerce inicial desde 1.800 € + IVA.
- [Mantenimiento WordPress](https://empc.es/mantenimiento-wordpress-leon/): mantenimiento desde 49 €/mes + IVA.
- [Optimización de rendimiento](https://empc.es/optimizacion-de-velocidad-wordpress-freelance/): WPO desde 300 € + IVA.
- [Consultoría](https://empc.es/contacta-conmigo/?tipo=consultoria): consultoría técnica a 75 €/hora + IVA.

Los precios son orientativos y el alcance final se confirma antes de contratar.

## Información útil

- [Cómo trabajo](https://empc.es/#proceso)
- [Preguntas frecuentes](https://empc.es/#preguntas)
- [Blog](https://empc.es/blog/)
- [Contacto](https://empc.es/contacta-conmigo/)

## Interacción

Las solicitudes de presupuesto y contacto son revisadas por una persona. Este documento no habilita compras, reservas, cambios de pedidos ni acciones autónomas.
LLMS;
}

/**
 * Serve /llms.txt without rewrites or database changes.
 */
function empc_maybe_serve_llms_txt(): void
{
    $path = wp_parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    if ($path !== '/llms.txt') {
        return;
    }

    status_header(200);
    header('Content-Type: text/plain; charset=UTF-8');
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: public, max-age=3600');
    echo empc_llms_txt_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    exit;
}
add_action('template_redirect', 'empc_maybe_serve_llms_txt', 0);
