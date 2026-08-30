<?php
/**
 * Generic Page Template
 * HTML inicial para páginas comerciales y editoriales.
 */
get_header();
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <?php while (have_posts()) : the_post(); ?>
        <?php $slug = get_post_field('post_name', get_the_ID()); ?>

        <article class="max-w-7xl mx-auto px-6 py-20">
            <?php if ($slug === 'presupuesto-web') : ?>
                <section class="grid lg:grid-cols-2 gap-12 items-start">
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FF007A]/10 border border-[#FF007A]/20 text-[#FF007A]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#FF007A] animate-pulse"></span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Territorio: León</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white"><?php the_title(); ?></h1>
                        <p class="text-xl text-slate-400 max-w-2xl">
                            Calcula el coste de tu proyecto con una estimación rápida y transparente.
                            Elige el tipo de web, añade extras y revisa un rango orientativo antes de hablar conmigo.
                        </p>
                        <ul class="space-y-3 text-slate-300">
                            <li>• Presupuesto orientativo con ajustes según alcance real</li>
                            <li>• Opciones para web básica, media o tienda online</li>
                            <li>• Extras de SEO, mantenimiento, diseño y React</li>
                        </ul>
                    </div>

                    <div class="lg:sticky lg:top-28">
                        <div id="island-pricing-calculator"></div>
                    </div>
                </section>

            <?php elseif ($slug === 'contacta-conmigo') : ?>
                <section class="space-y-10">
                    <div class="max-w-3xl space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E29595] animate-pulse"></span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Contacto directo</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-white"><?php the_title(); ?></h2>
                    </div>

                    <div class="prose prose-invert prose-lg max-w-4xl text-slate-300">
                        <?php the_content(); ?>
                    </div>

                    <div class="pt-6">
                        <div id="island-contact-form"></div>
                    </div>
                </section>

            <?php elseif ($slug === 'mantenimiento-wordpress-leon' || $slug === 'alquiler-pagina-web-empresas-y-autonomos') : ?>
                <section class="prose prose-invert prose-lg max-w-4xl mx-auto text-slate-300">
                    <?php if ($slug === 'alquiler-pagina-web-empresas-y-autonomos') : ?>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-8"><?php the_title(); ?></h1>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </section>

            <?php elseif ($slug === 'consultor-wordpress') : ?>
                <section class="space-y-14">
                    <div class="grid lg:grid-cols-[1.1fr_0.9fr] gap-10 items-start">
                        <div class="space-y-6">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595] text-[10px] font-bold uppercase tracking-widest">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#E29595]"></span>
                                Consultoría WordPress en León
                            </div>
                            <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">Consultor WordPress en León</h1>
                            <p class="text-xl text-slate-400 leading-relaxed">Te ayudo a entender qué ocurre en tu WordPress y a ordenar las decisiones técnicas antes de contratar o ejecutar cambios.</p>
                            <p class="text-lg text-slate-300 leading-relaxed">La consultoría es un servicio de orientación profesional y trato directo con Emma para empresas, autónomos y propietarios de webs que necesitan criterio para avanzar.</p>
                            <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=consultoria-wordpress')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-[#E29595] text-slate-950 font-bold hover:brightness-110">Solicitar una valoración</a>
                        </div>
                        <aside class="rounded-3xl border border-white/10 bg-[#1F2937]/50 p-6 md:p-8 space-y-4">
                            <h2 class="text-2xl font-bold text-white">¿Cuándo puede ayudarte?</h2>
                            <ul class="space-y-3 text-slate-300"><li>• No sabes por qué tu web falla o se comporta de forma extraña.</li><li>• Tienes varias opciones y necesitas compararlas.</li><li>• Quieres revisar una propuesta antes de aceptarla.</li><li>• Necesitas priorizar mejoras técnicas con un presupuesto limitado.</li></ul>
                        </aside>
                    </div>

                    <section class="space-y-6">
                        <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Qué puedes obtener</p><h2 class="text-3xl md:text-4xl font-bold text-white">Claridad para tomar decisiones sobre WordPress</h2><p class="text-slate-400 leading-relaxed">Una revisión profesional sirve para separar el problema real de los síntomas, identificar dependencias y decidir qué conviene hacer primero. El alcance se concreta según el caso; la consultoría no implica ejecutar todos los cambios.</p></div>
                        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4"><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Entender</h3><p class="text-sm text-slate-400">Revisar el contexto de la web y traducir el problema a decisiones comprensibles.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Priorizar</h3><p class="text-sm text-slate-400">Distinguir lo urgente, lo importante y lo que puede esperar.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Comparar</h3><p class="text-sm text-slate-400">Valorar alternativas técnicas, propuestas o cambios de proveedor.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Planificar</h3><p class="text-sm text-slate-400">Ordenar los siguientes pasos de acuerdo con las necesidades del negocio.</p></div></div>
                    </section>

                    <section class="space-y-6"><div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Ámbitos de trabajo</p><h2 class="text-3xl md:text-4xl font-bold text-white">En qué puedo orientarte</h2></div><div class="grid lg:grid-cols-2 gap-4"><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-xl font-bold text-white mb-2">Diagnóstico WordPress</h3><p class="text-slate-400 leading-relaxed">Revisión del problema que describes, del contexto técnico disponible y de las posibles líneas de actuación.</p></div><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-xl font-bold text-white mb-2">Revisión de propuestas</h3><p class="text-slate-400 leading-relaxed">Ayuda para leer el alcance, detectar dependencias y formular preguntas antes de contratar un proyecto.</p></div><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-xl font-bold text-white mb-2">Mejoras técnicas</h3><p class="text-slate-400 leading-relaxed">Orientación sobre estructura, rendimiento, seguridad, actualizaciones o mantenimiento, sin convertir la consulta en una promesa de resultado.</p></div><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-xl font-bold text-white mb-2">WordPress y WooCommerce</h3><p class="text-slate-400 leading-relaxed">Si tu proyecto incluye una tienda, podemos revisar las decisiones técnicas relacionadas con el sitio y su gestión según el alcance real.</p></div></div></section>

                    <section class="space-y-6"><div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Cómo se plantea</p><h2 class="text-3xl md:text-4xl font-bold text-white">Una conversación centrada en tu caso</h2></div><div class="grid md:grid-cols-3 gap-4"><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6"><span class="text-[#E29595] text-xs font-bold">01</span><h3 class="text-xl font-bold text-white mt-2">Contexto</h3><p class="text-slate-400 mt-2">Cuéntame qué quieres conseguir, qué has probado y qué información tienes.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6"><span class="text-[#E29595] text-xs font-bold">02</span><h3 class="text-xl font-bold text-white mt-2">Revisión</h3><p class="text-slate-400 mt-2">Analizamos la cuestión concreta y las alternativas que tengan sentido.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6"><span class="text-[#E29595] text-xs font-bold">03</span><h3 class="text-xl font-bold text-white mt-2">Siguientes pasos</h3><p class="text-slate-400 mt-2">Decidimos si necesitas ejecutar cambios, contratar otro servicio o seguir investigando.</p></div></div></section>

                    <section class="space-y-6"><div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Límites del servicio</p><h2 class="text-3xl md:text-4xl font-bold text-white">La consultoría no sustituye a otros profesionales</h2><p class="text-slate-400 leading-relaxed">La orientación técnica no constituye asesoramiento jurídico, fiscal ni de protección de datos. La ejecución de desarrollos, migraciones, redacciones, cambios editoriales o intervenciones urgentes se valora de forma independiente cuando proceda.</p></div></section>

                    <section class="space-y-6"><div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Servicios relacionados</p><h2 class="text-3xl md:text-4xl font-bold text-white">Cada necesidad tiene su página</h2></div><div class="grid md:grid-cols-3 gap-4"><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Diseño web</h3><p class="text-sm text-slate-400">Para crear o reconstruir una web corporativa, consulta el <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>">servicio de diseño web</a>.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Tiendas online</h3><p class="text-sm text-slate-400">Si tu proyecto incluye comercio electrónico, consulta el <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/tiendas-online-leon/')); ?>">servicio de tiendas online</a>.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Mantenimiento WordPress</h3><p class="text-sm text-slate-400">Para revisiones recurrentes de una web ya publicada, consulta el <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>">mantenimiento WordPress</a>.</p></div></div></section>

                    <section class="rounded-3xl border border-[#E29595]/20 bg-[#E29595]/5 p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6"><div><h2 class="text-3xl font-bold text-white mb-2">Cuéntame qué necesitas decidir</h2><p class="text-slate-400">Describe tu WordPress, el problema o la propuesta que quieres revisar.</p></div><a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=consultoria-wordpress')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-[#E29595] text-slate-950 font-bold">Solicitar una valoración</a></section>
                </section>

            <?php else : ?>
                <section class="prose prose-invert prose-lg max-w-4xl mx-auto text-slate-300">
                    <?php if ($slug === 'mas-informacion-sobre-las-cookies') : ?>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-8"><?php echo esc_html(get_the_title()); ?></h1>
                    <?php endif; ?>
                    <?php if ($slug === 'aviso-legal') : ?>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-8"><?php echo esc_html(get_the_title()); ?></h1>
                    <?php endif; ?>
                    <?php if ($slug === 'consultor-wordpress') : ?>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-8">Consultor WordPress en León</h1>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </section>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
