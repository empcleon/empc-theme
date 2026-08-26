<?php
/**
 * WP 7.0 Preparation Verifier for EMPC Theme
 * 
 * Este script verifica mecánicamente si los cambios necesarios para WP 7.0
 * están aplicados en el archivo functions.php.
 */

$functions_file = __DIR__ . '/functions.php';
$content = file_get_contents($functions_file);

$checks = [
    'Abilities API Support' => strpos($content, "add_theme_support('wp-7-abilities'") !== false,
    'Script Module Filter' => strpos($content, "strpos(\$handle, 'empc-react') !== false") !== false,
    'Type Module Injection' => strpos($content, "return '<script type=\"module\" src=\"' . esc_url(\$src) . '\"></script>';") !== false,
];

echo "🚀 VERIFICADOR DE COMPATIBILIDAD WP 7.0\n";
echo "========================================\n";

$all_passed = true;
foreach ($checks as $name => $passed) {
    echo ($passed ? "✅" : "❌") . " $name\n";
    if (!$passed) $all_passed = false;
}

if ($all_passed) {
    echo "\n🎉 ¡TODO LISTO! El tema EMPC está técnicamente preparado para WordPress 7.0.\n";
} else {
    echo "\n⚠️ ATENCIÓN: Faltan componentes críticos en functions.php.\n";
}
