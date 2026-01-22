<?php
/**
 * Template Name: Tiendas Online (React Islands)
 * Description: Landing page específica para el servicio de Tiendas Online
 */

get_header();

// 1. Obtener la configuración definida en inc/service-pages-data.php
$config = [];
if (function_exists('get_tiendas_online_config')) {
    $config = get_tiendas_online_config();
}
?>

<div id="ecommerce-page-container" class="bg-slate-900 min-h-screen">
    <?php if (empty($config)): ?>
        <div class="container mx-auto py-20 text-center text-white">
            <h1 class="text-3xl font-bold">Error de configuración</h1>
            <p>No se han podido cargar los datos de la página.</p>
        </div>
    <?php else: ?>

        <!-- Hero Section -->
        <div id="ecommerce-hero" data-config='<?php echo esc_attr(json_encode($config['hero'], JSON_UNESCAPED_UNICODE)); ?>
        '>
        </div>

        <!-- Comparison Section -->
        <?php if (isset($config['comparison'])): ?>
            <div id="ecommerce-comparison" data-config='<?php echo esc_attr(json_encode($config['comparison'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

        <!-- Features Section -->
        <?php if (isset($config['features'])): ?>
            <div id="ecommerce-features" data-config='<?php echo esc_attr(json_encode($config['features'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

        <!-- Pricing Section -->
        <?php if (isset($config['pricing'])): ?>
            <div id="ecommerce-pricing" data-config='<?php echo esc_attr(json_encode($config['pricing'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

        <!-- Platforms Section -->
        <?php if (isset($config['platforms'])): ?>
            <div id="ecommerce-platforms" data-config='<?php echo esc_attr(json_encode($config['platforms'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

        <!-- Process Section -->
        <?php if (isset($config['process'])): ?>
            <div id="ecommerce-process" data-config='<?php echo esc_attr(json_encode($config['process'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

        <!-- Case Studies Section -->
        <?php if (isset($config['caseStudies'])): ?>
            <div id="ecommerce-cases" data-config='<?php echo esc_attr(json_encode($config['caseStudies'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

        <!-- FAQ Section -->
        <?php if (isset($config['faq'])): ?>
            <div id="ecommerce-faq" data-config='<?php echo esc_attr(json_encode($config['faq'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

        <!-- CTA Form Section -->
        <?php if (isset($config['cta'])): ?>
            <div id="ecommerce-cta" data-config='<?php echo esc_attr(json_encode($config['cta'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</div>

<?php
// Schema.org
if (isset($config['seo']['schema'])) {
    echo '<script type="application/ld+json">';
    echo json_encode($config['seo']['schema'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo '</script>';
}

get_footer();
