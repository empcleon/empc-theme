<?php
/**
 * Fuente única de precios comerciales autorizados.
 * El JSON se comparte con las calculadoras React.
 */
function empc_commercial_pricing(): array
{
    static $pricing = null;
    if (is_array($pricing)) {
        return $pricing;
    }

    $path = EMPC_THEME_DIR . '/data/commercial-pricing.json';
    $raw = is_readable($path) ? file_get_contents($path) : false;
    $decoded = is_string($raw) ? json_decode($raw, true) : null;
    $pricing = is_array($decoded) ? $decoded : [];
    return $pricing;
}

function empc_commercial_price(string ...$keys): ?float
{
    $value = empc_commercial_pricing();
    foreach ($keys as $key) {
        if (!is_array($value) || !array_key_exists($key, $value)) {
            return null;
        }
        $value = $value[$key];
    }
    if (is_array($value) && array_key_exists('price', $value)) {
        $value = $value['price'];
    }
    return is_numeric($value) ? (float) $value : null;
}

function empc_price_label(?float $price, string $qualifier = 'desde', string $period = ''): string
{
    if ($price === null) {
        return 'Presupuesto a medida';
    }
    $formatted = number_format($price, 0, ',', '.');
    $suffix = $period !== '' ? ' €/'. $period : ' €';
    return ($qualifier !== '' ? $qualifier . ' ' : '') . $formatted . $suffix . ' + IVA';
}
