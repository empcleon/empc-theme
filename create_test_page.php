<?php
// Load WordPress
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');

$page_title = 'Test Soberana Theme';
$page_slug = 'test-soberana';
$template = 'page-test-soberana.php';
$user_id = 1; // Assign to admin

$page_check = get_page_by_path($page_slug);
$page_id = $page_check->ID ?? 0;

if ($page_id == 0) {
    $post = array(
        'post_title' => $page_title,
        'post_name' => $page_slug,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => $user_id,
        'post_type' => 'page',
    );
    $page_id = wp_insert_post($post);
    if (is_wp_error($page_id)) {
        echo "Error creating page: " . $page_id->get_error_message() . "\n";
        exit(1);
    }
    echo "Page created successfully. ID: " . $page_id . "\n";
} else {
    echo "Page already exists. ID: " . $page_id . "\n";
    // Ensure it's published if it was trash/draft
    $update = array('ID' => $page_id, 'post_status' => 'publish');
    wp_update_post($update);
}

// Set Template
$current_template = get_post_meta($page_id, '_wp_page_template', true);
if ($current_template !== $template) {
    update_post_meta($page_id, '_wp_page_template', $template);
    echo "Template updated to: " . $template . "\n";
} else {
    echo "Template is already set correctly.\n";
}

echo "URL: " . get_permalink($page_id) . "\n";
?>