<?php
/**
 * Template Name: Tiendas Online (React Islands)
 * Description: Landing page específica para el servicio de Tiendas Online
 */

get_header();

$config = function_exists('get_tiendas_online_config') ? get_tiendas_online_config() : [];
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <article class="max-w-7xl mx-auto px-6 py-20 space-y-20">
        <?php $hero = $config['hero'] ?? []; ?>
        <section class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <?php if (!empty($hero['badge'])) : ?>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-[10px] font-bold uppercase tracking-widest">
                        <?php echo esc_html(is_array($hero['badge']) ? ($hero['badge']['text'] ?? '') : $hero['badge']); ?>
                    </div>
                <?php endif; ?>
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                    <?php echo esc_html($hero['title'] ?? get_the_title()); ?>
                    <?php if (!empty($hero['highlight'])) : ?>
                        <span class="text-emerald-300 italic"><?php echo esc_html($hero['highlight']); ?></span>
                    <?php endif; ?>
                </h1>
                <?php if (!empty($hero['description'])) : ?>
                    <p class="text-xl text-slate-400 max-w-2xl leading-relaxed">
                        <?php echo wp_kses_post($hero['description']); ?>
                    </p>
                <?php endif; ?>
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="<?php echo esc_url(home_url('/contacta-conmigo/')); ?>" class="px-8 py-4 bg-emerald-400 text-[#121826] font-bold rounded-2xl uppercase tracking-widest text-sm text-center">
                        <?php echo esc_html($hero['ctaPrimary']['text'] ?? 'Quiero mi tienda online'); ?>
                    </a>
                    <a href="#faq" class="px-8 py-4 bg-white/5 text-white font-bold rounded-2xl border border-white/10 uppercase tracking-widest text-sm text-center">
                        <?php echo esc_html($hero['ctaSecondary']['text'] ?? 'Ver casos de éxito'); ?>
                    </a>
                </div>
            </div>

            <div class="bg-[#1F2937]/50 border border-white/10 rounded-[2.5rem] p-8 shadow-2xl">
                <h2 class="text-2xl font-bold text-white mb-4">Resumen rápido</h2>
                <p class="text-slate-400 leading-relaxed mb-6">
                    Esta página entrega su propuesta principal en HTML inicial y reserva React para las partes que realmente aportan interacción.
                </p>
                <?php if (!empty($hero['stats']) && is_array($hero['stats'])) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <?php foreach ($hero['stats'] as $stat) : ?>
                            <div class="bg-slate-900/60 rounded-2xl p-4 border border-white/5 text-center">
                                <div class="text-2xl font-bold text-white"><?php echo esc_html(($stat['number'] ?? '') . ' '); ?></div>
                                <div class="text-xs uppercase tracking-widest text-slate-500 mt-1"><?php echo esc_html($stat['label'] ?? ''); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <?php if (!empty($config['comparison']['items']) && is_array($config['comparison']['items'])) : ?>
            <section>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['comparison']['title'] ?? 'Comparativa'); ?></h2>
                    <?php if (!empty($config['comparison']['subtitle'])) : ?>
                        <p class="text-slate-400 max-w-3xl"><?php echo esc_html($config['comparison']['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="space-y-4">
                    <?php foreach ($config['comparison']['items'] as $item) : ?>
                        <div class="grid md:grid-cols-3 gap-4 bg-[#1F2937]/30 border border-white/5 rounded-2xl p-5">
                            <div class="text-white font-semibold"><?php echo esc_html($item['aspect'] ?? ''); ?></div>
                            <div class="text-slate-400"><?php echo esc_html($item['physical'] ?? ''); ?></div>
                            <div class="text-emerald-300 font-semibold"><?php echo esc_html($item['online'] ?? ''); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($config['features']['items']) && is_array($config['features']['items'])) : ?>
            <section>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['features']['title'] ?? 'Funcionalidades'); ?></h2>
                    <?php if (!empty($config['features']['description'])) : ?>
                        <p class="text-slate-400 max-w-3xl"><?php echo esc_html($config['features']['description']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php foreach ($config['features']['items'] as $feature) : ?>
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
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <?php foreach ($config['pricing']['tiers'] as $tier) : ?>
                        <div class="rounded-3xl p-6 border <?php echo !empty($tier['highlighted']) ? 'border-emerald-300/50 bg-emerald-400/10' : 'border-white/10 bg-[#1F2937]/30'; ?>">
                            <h3 class="text-white text-2xl font-bold mb-2"><?php echo esc_html($tier['title'] ?? ''); ?></h3>
                            <div class="text-emerald-300 font-bold mb-3"><?php echo esc_html($tier['price'] ?? ''); ?></div>
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

        <?php if (!empty($config['platforms']['items']) && is_array($config['platforms']['items'])) : ?>
            <section>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['platforms']['title'] ?? 'Plataformas'); ?></h2>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <?php foreach ($config['platforms']['items'] as $platform) : ?>
                        <div class="bg-[#1F2937]/30 border border-white/5 rounded-3xl p-6">
                            <h3 class="text-white text-xl font-bold mb-2"><?php echo esc_html($platform['title'] ?? ''); ?></h3>
                            <p class="text-slate-400 leading-relaxed"><?php echo esc_html($platform['description'] ?? ''); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($config['process']['steps']) && is_array($config['process']['steps'])) : ?>
            <section>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['process']['title'] ?? 'Proceso'); ?></h2>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <?php foreach ($config['process']['steps'] as $step) : ?>
                        <div class="bg-slate-900/60 border border-white/5 rounded-3xl p-6">
                            <div class="text-emerald-300 text-xs font-bold uppercase tracking-widest mb-2"><?php echo esc_html($step['step'] ?? ''); ?></div>
                            <h3 class="text-white text-xl font-bold mb-2"><?php echo esc_html($step['title'] ?? ''); ?></h3>
                            <p class="text-slate-400"><?php echo esc_html($step['description'] ?? ''); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($config['caseStudies']['items']) && is_array($config['caseStudies']['items'])) : ?>
            <section>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['caseStudies']['title'] ?? 'Casos'); ?></h2>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <?php foreach ($config['caseStudies']['items'] as $case) : ?>
                        <div class="bg-[#1F2937]/30 border border-white/5 rounded-3xl p-6">
                            <h3 class="text-white text-xl font-bold mb-2"><?php echo esc_html($case['title'] ?? ''); ?></h3>
                            <p class="text-slate-400 leading-relaxed"><?php echo esc_html($case['description'] ?? ''); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($config['faq']['items']) && is_array($config['faq']['items'])) : ?>
            <section id="faq">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-3"><?php echo esc_html($config['faq']['title'] ?? 'FAQ'); ?></h2>
                </div>
                <div class="space-y-4 max-w-4xl">
                    <?php foreach ($config['faq']['items'] as $faq) : ?>
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
                <div id="ecommerce-cta" data-config='<?php echo esc_attr(json_encode($config['cta'], JSON_UNESCAPED_UNICODE)); ?>'></div>
            </section>
        <?php endif; ?>

        <?php // Island React: simulador de impacto del Local Pack ?>
        <?php
        $local_pack = $config['localPackSimulator'] ?? [
            'id' => 'local-pack-simulator-island',
            'title' => 'Simulador de impacto del Local Pack',
            'subtitle' => 'Calcula cuántos clientes podrías ganar saliendo en el Top 3 del mapa',
            'description' => 'Introduce cuántas búsquedas mensuales tiene tu servicio y te muestro la diferencia entre <strong>no salir en el Local Pack</strong> y aparecer en el <strong>puesto #1</strong> del mapa.',
            'defaultValues' => [
                'monthlySearches' => 800,
                'conversionRate' => 0.08,
                'avgTicket' => 70,
                'currentPosition' => 'no_pack',
            ],
            'notes' => [
                'Son estimaciones basadas en CTR medios del Local Pack.',
                'Los resultados reales dependen de tu sector, reseñas y competencia.',
            ],
        ];
        ?>
        <section class="pt-8">
            <div id="local-pack-simulator-island" data-config='<?php echo esc_attr(json_encode($local_pack, JSON_UNESCAPED_UNICODE)); ?>'></div>
        </section>
    </article>
</main>

<?php get_footer(); ?>
