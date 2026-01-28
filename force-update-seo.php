<?php
require_once(dirname(__FILE__) . '/../../../wp-load.php');
ini_set('display_errors', 1);

function check_json($data, $path = '')
{
    $encoded = json_encode($data, JSON_UNESCAPED_UNICODE);
    if ($encoded === false) {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                check_json($v, $path . "[$k]");
            }
        } else {
            echo "BAD UTF-8 at $path: " . mb_detect_encoding($data) . " - " . bin2hex($data) . "<br>";
        }
    } else {
        // Valid
    }
}

$config = get_seo_local_leon_config();
$full_encoded = json_encode($config, JSON_UNESCAPED_UNICODE);

if ($full_encoded === false) {
    echo "<h1>JSON FAILED</h1>";
    echo "Error: " . json_last_error_msg() . "<br>";
    check_json($config, 'config');
} else {
    echo "<h1>JSON SUCCESS</h1>";
    echo "Length: " . strlen($full_encoded) . "<br>";
    if (function_exists('empc_insert_service_page')) {
        $id = empc_insert_service_page('SEO Local en León', 'seo-local-leon', $config);
        echo "Updated post $id<br>";

        $meta = get_post_meta($id, '_empc_service_config', true);
        echo "Meta length: " . strlen($meta) . "<br>";
        $data = json_decode($meta, true);
        echo "Keys: " . implode(', ', array_keys($data));
    }
}
