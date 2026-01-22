<?php
/**
 * Template Name: Service Page
 * Description: Template for service pages with React Islands
 */

get_header();
?>

<div id="service-page-container">
    <?php
    while (have_posts()):
        the_post();

        // Get service page configuration from post meta
        $service_config = get_post_meta(get_the_ID(), '_empc_service_config', true);

        if ($service_config) {
            $config = json_decode($service_config, true);

            // Output islands containers with data attributes
            ?>

            <!-- Hero Island -->
            <div id="service-hero-island"
                data-config='<?php echo esc_attr(json_encode($config['hero'], JSON_UNESCAPED_UNICODE)); ?>'>
            </div>

            <!-- Stats Bar Island -->
            <?php if (isset($config['stats'])): ?>
                <div id="service-stats-island"
                    data-config='<?php echo esc_attr(json_encode($config['stats'], JSON_UNESCAPED_UNICODE)); ?>'>
                </div>
            <?php endif; ?>

            <!-- Features Grid Island -->
            <?php if (isset($config['features'])): ?>
                <div id="service-features-island"
                    data-config='<?php echo esc_attr(json_encode($config['features'], JSON_UNESCAPED_UNICODE)); ?>'>
                </div>
            <?php endif; ?>

            <!-- Pricing Cards Island -->
            <?php if (isset($config['pricing'])): ?>
                <div id="service-pricing-island"
                    data-config='<?php echo esc_attr(json_encode($config['pricing'], JSON_UNESCAPED_UNICODE)); ?>'>
                </div>
            <?php endif; ?>

            <!-- Process Timeline Island -->
            <?php if (isset($config['process'])): ?>
                <div id="service-process-island"
                    data-config='<?php echo esc_attr(json_encode($config['process'], JSON_UNESCAPED_UNICODE)); ?>'>
                </div>
            <?php endif; ?>

            <!-- Testimonials Island -->
            <?php if (isset($config['testimonials'])): ?>
                <div id="service-testimonials-island"
                    data-config='<?php echo esc_attr(json_encode($config['testimonials'], JSON_UNESCAPED_UNICODE)); ?>'>
                </div>
            <?php endif; ?>

            <!-- FAQ Island -->
            <?php if (isset($config['faq'])): ?>
                <div id="service-faq-island"
                    data-config='<?php echo esc_attr(json_encode($config['faq'], JSON_UNESCAPED_UNICODE)); ?>'>
                </div>
            <?php endif; ?>

            <!-- CTA Form Island -->
            <?php if (isset($config['cta'])): ?>
                <div id="service-cta-island"
                    data-config='<?php echo esc_attr(json_encode($config['cta'], JSON_UNESCAPED_UNICODE)); ?>'>
                </div>
            <?php endif; ?>

            <?php
        } else {
            // Fallback: display post content
            the_content();
        }
    endwhile;
    ?>
</div>

<?php
// Schema.org markup for Service pages
$schema = [
    "@context" => "https://schema.org",
    "@type" => "Service",
    "name" => get_the_title(),
    "provider" => [
        "@type" => "LocalBusiness",
        "name" => "EMPC",
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => "León",
            "addressCountry" => "ES"
        ]
    ],
    "areaServed" => [
        "@type" => "City",
        "name" => "León"
    ],
    "description" => get_the_excerpt()
];
?>
<script type="application/ld+json">
<?php echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); ?>
</script>

<?php
// Breadcrumbs schema
$breadcrumbs = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => [
        [
            "@type" => "ListItem",
            "position" => 1,
            "name" => "Inicio",
            "item" => home_url()
        ],
        [
            "@type" => "ListItem",
            "position" => 2,
            "name" => "Servicios",
            "item" => home_url('/servicios')
        ],
        [
            "@type" => "ListItem",
            "position" => 3,
            "name" => get_the_title(),
            "item" => get_permalink()
        ]
    ]
];
?>
<script type="application/ld+json">
<?php echo json_encode($breadcrumbs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); ?>
</script>

<?php
get_footer();
