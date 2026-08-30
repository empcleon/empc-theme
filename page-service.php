<?php
/**
 * Template Name: Service Page
 * Description: Template for service pages with progressive HTML rendering
 */

get_header();

$config = [];
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $service_config = get_post_meta(get_the_ID(), '_empc_service_config', true);
        if ($service_config) {
            $decoded = json_decode($service_config, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $config = $decoded;
            }
        }
    }
    rewind_posts();

    if (is_page('diseno-web-leon') && function_exists('empc_diseno_web_leon_safe_config')) {
        $config = empc_diseno_web_leon_safe_config();
    }
    if (is_page('tiendas-online-leon') && function_exists('empc_commercial_price')) {
        $config['pricing'] = [
            'title' => 'Precios orientativos de tiendas WooCommerce',
            'description' => 'Importes para nuevos proyectos. El presupuesto final concreta el alcance y se muestra sin IVA.',
            'tiers' => [
                ['title' => 'Tienda WooCommerce inicial', 'price' => empc_price_label(empc_commercial_price('ecommerce', 'initial', 'price')), 'description' => 'Una base de comercio electrónico según el alcance acordado.', 'features' => ['WooCommerce', 'Catálogo, carrito y proceso de compra']],
                ['title' => 'Tienda avanzada', 'price' => empc_price_label(empc_commercial_price('ecommerce', 'advanced', 'price')), 'description' => 'Para sincronizaciones o integraciones.', 'features' => ['Integraciones según alcance', 'Presupuesto detallado']],
                ['title' => 'Proyecto a medida', 'price' => 'Presupuesto a medida', 'description' => 'Necesidades complejas o dependencias externas.', 'features' => ['ERP/CRM', 'Sincronización de stock', 'Automatizaciones']],
            ],
            'note' => 'Las pasarelas, transportistas, licencias, fiscalidad y asesoramiento legal se valoran según el proyecto.',
        ];
    }
}
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="max-w-7xl mx-auto px-6 py-20 space-y-20">
            <?php $slug = (string) get_post_field('post_name', get_the_ID()); ?>
            <?php $hero = $config['hero'] ?? []; ?>
            <section class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <?php if (!empty($hero['badge'])) : ?>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595] text-[10px] font-bold uppercase tracking-widest">
                            <?php echo esc_html(is_array($hero['badge']) ? ($hero['badge']['text'] ?? '') : $hero['badge']); ?>
                        </div>
                    <?php endif; ?>
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                        <?php echo esc_html($hero['title'] ?? get_the_title()); ?>
                        <?php if (!empty($hero['highlight'])) : ?>
                            <span class="text-[#E29595] italic"><?php echo esc_html($hero['highlight']); ?></span>
                        <?php endif; ?>
                    </h1>
                    <?php if (!empty($hero['description'])) : ?>
                        <p class="text-xl text-slate-400 max-w-2xl leading-relaxed">
                            <?php echo wp_kses_post($hero['description']); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($hero['bulletPoints']) && is_array($hero['bulletPoints'])) : ?>
                        <ul class="space-y-3 text-slate-300">
                            <?php foreach ($hero['bulletPoints'] as $bullet) : ?>
                                <li>• <?php echo esc_html($bullet['text'] ?? ''); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <?php if (!empty($hero['ctaPrimary'])) : ?>
                            <?php $cta_href = $slug === 'diseno-web-leon' ? home_url('/contacta-conmigo/?tipo=diseno-web') : home_url('/contacta-conmigo/'); ?>
                            <a href="<?php echo esc_url($cta_href); ?>" class="px-8 py-4 bg-[#E29595] text-[#121826] font-bold rounded-2xl uppercase tracking-widest text-sm text-center">
                                <?php echo esc_html($hero['ctaPrimary']['text'] ?? 'Solicitar presupuesto'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($hero['ctaSecondary'])) : ?>
                            <a href="#faq" class="px-8 py-4 bg-white/5 text-white font-bold rounded-2xl border border-white/10 uppercase tracking-widest text-sm text-center">
                                <?php echo esc_html($hero['ctaSecondary']['text'] ?? 'Ver proceso'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-[#1F2937]/50 border border-white/10 rounded-[2.5rem] p-8 shadow-2xl">
                    <div class="space-y-5">
                        <h2 class="text-2xl font-bold text-white">Resumen rápido</h2>
                        <p class="text-slate-400 leading-relaxed">
                            <?php echo esc_html(get_the_title()); ?> se presenta aquí con HTML inicial útil, mientras la parte interactiva queda reservada a las islas que realmente lo necesitan.
                        </p>
                        <?php if (!empty($config['stats']['stats']) && is_array($config['stats']['stats'])) : ?>
                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <?php foreach ($config['stats']['stats'] as $stat) : ?>
                                    <div class="bg-slate-900/60 rounded-2xl p-4 border border-white/5">
                                        <div class="text-2xl font-bold text-white"><?php echo esc_html(($stat['number'] ?? '') . ($stat['suffix'] ?? '')); ?></div>
                                        <div class="text-xs uppercase tracking-widest text-slate-500 mt-1"><?php echo esc_html($stat['label'] ?? ''); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <?php if (!empty($config['features']['features']) && is_array($config['features']['features'])) : ?>
                <section>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['features']['title'] ?? 'Ventajas'); ?></h2>
                        <?php if (!empty($config['features']['description'])) : ?>
                            <p class="text-slate-400 max-w-3xl"><?php echo esc_html($config['features']['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                        <?php foreach ($config['features']['features'] as $feature) : ?>
                            <div class="bg-[#1F2937]/30 border border-white/5 rounded-3xl p-6">
                                <h3 class="text-white text-xl font-bold mb-2"><?php echo esc_html($feature['title'] ?? ''); ?></h3>
                                <p class="text-slate-400 leading-relaxed"><?php echo esc_html($feature['description'] ?? ''); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($config['pricing']['tiers']) && is_array($config['pricing']['tiers'])) : ?>
                <section>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['pricing']['title'] ?? 'Planes'); ?></h2>
                        <?php if (!empty($config['pricing']['description'])) : ?>
                            <p class="text-slate-400 max-w-3xl"><?php echo esc_html($config['pricing']['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="grid md:grid-cols-3 gap-6">
                        <?php foreach ($config['pricing']['tiers'] as $tier) : ?>
                            <div class="rounded-3xl p-6 border <?php echo !empty($tier['highlighted']) ? 'border-[#E29595]/50 bg-[#E29595]/10' : 'border-white/10 bg-[#1F2937]/30'; ?>">
                                <h3 class="text-white text-2xl font-bold mb-2"><?php echo esc_html($tier['title'] ?? ''); ?></h3>
                                <div class="text-[#E29595] font-bold mb-3"><?php echo esc_html($tier['price'] ?? ''); ?></div>
                                <p class="text-slate-400 mb-4"><?php echo esc_html($tier['description'] ?? ''); ?></p>
                                <?php if (!empty($tier['features']) && is_array($tier['features'])) : ?>
                                    <ul class="space-y-2 text-sm text-slate-300">
                                        <?php foreach ($tier['features'] as $item) : ?>
                                            <li>• <?php echo esc_html($item); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($config['process']['steps']) && is_array($config['process']['steps'])) : ?>
                <section>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['process']['title'] ?? 'Proceso'); ?></h2>
                        <?php if (!empty($config['process']['description'])) : ?>
                            <p class="text-slate-400 max-w-3xl"><?php echo esc_html($config['process']['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <?php foreach ($config['process']['steps'] as $step) : ?>
                            <div class="bg-slate-900/60 border border-white/5 rounded-3xl p-6">
                                <div class="text-[#E29595] text-xs font-bold uppercase tracking-widest mb-2"><?php echo esc_html($step['step'] ?? ''); ?></div>
                                <h3 class="text-white text-xl font-bold mb-2"><?php echo esc_html($step['title'] ?? ''); ?></h3>
                                <p class="text-slate-400"><?php echo esc_html($step['description'] ?? ''); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($config['testimonials']['testimonials']) && is_array($config['testimonials']['testimonials'])) : ?>
                <section>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['testimonials']['title'] ?? 'Testimonios'); ?></h2>
                    </div>
                    <div class="grid md:grid-cols-3 gap-6">
                        <?php foreach ($config['testimonials']['testimonials'] as $testimonial) : ?>
                            <blockquote class="bg-[#1F2937]/30 border border-white/5 rounded-3xl p-6 text-slate-300">
                                <p class="leading-relaxed">“<?php echo esc_html($testimonial['text'] ?? ''); ?>”</p>
                                <footer class="mt-4 text-sm text-slate-500">
                                    <?php echo esc_html(($testimonial['author'] ?? '') . (!empty($testimonial['company']) ? ' — ' . $testimonial['company'] : '')); ?>
                                </footer>
                            </blockquote>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($slug === 'diseno-web-leon') : ?>
                <section>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-white mb-3">Servicios relacionados</h2>
                        <p class="text-slate-400 max-w-3xl">Si tu proyecto ya existe o necesita una solución distinta, estas páginas explican servicios separados del diseño de una web nueva.</p>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-[#1F2937]/30 border border-white/5 rounded-3xl p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Mantenimiento WordPress</h3>
                            <p class="text-slate-400 leading-relaxed mb-4">Para webs que ya están publicadas y necesitan actualizaciones, seguridad, copias o soporte recurrente.</p>
                            <a class="text-[#E29595] font-bold" href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>">Ver mantenimiento WordPress</a>
                        </div>
                        <div class="bg-[#1F2937]/30 border border-white/5 rounded-3xl p-6">
                            <h3 class="text-white text-xl font-bold mb-2">Tiendas online</h3>
                            <p class="text-slate-400 leading-relaxed mb-4">Para proyectos que necesitan catálogo, carrito, pagos y gestión de pedidos mediante una solución de comercio electrónico.</p>
                            <a class="text-[#E29595] font-bold" href="<?php echo esc_url(home_url('/tiendas-online-leon/')); ?>">Ver tiendas online</a>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($config['faq']['faqs']) && is_array($config['faq']['faqs'])) : ?>
                <section id="faq">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['faq']['title'] ?? 'FAQ'); ?></h2>
                    </div>
                    <div class="space-y-4 max-w-4xl">
                        <?php foreach ($config['faq']['faqs'] as $faq) : ?>
                            <div class="bg-slate-900/60 border border-white/5 rounded-2xl p-6">
                                <h3 class="text-white font-bold mb-2"><?php echo esc_html($faq['question'] ?? ''); ?></h3>
                                <p class="text-slate-400"><?php echo esc_html($faq['answer'] ?? ''); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($config['cta'])) : ?>
                <section class="pt-8">
                    <div id="service-cta-island" data-config='<?php echo esc_attr(json_encode($config['cta'], JSON_UNESCAPED_UNICODE)); ?>'></div>
                    <?php if ($slug === 'diseno-web-leon') : ?>
                        <p class="text-center mt-6"><a class="text-[#E29595] font-bold" href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=diseno-web')); ?>">Ir al formulario de diseño web</a></p>
                    <?php endif; ?>
                </section>
            <?php endif; ?>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
