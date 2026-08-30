<?php
/**
 * Landing SSR: Redacción de contenidos web en León.
 * El contenido comercial vive en esta plantilla para no depender de la BD.
 *
 * @package EMPC
 */

get_header();
$blog_price = function_exists('empc_commercial_price') ? empc_commercial_price('content', 'blogArticle') : null;
$service_price = function_exists('empc_commercial_price') ? empc_commercial_price('content', 'servicePage') : null;
$landing_price = function_exists('empc_commercial_price') ? empc_commercial_price('content', 'commercialLanding') : null;
$website_price = function_exists('empc_commercial_price') ? empc_commercial_price('content', 'standardWebsite') : null;
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <?php while (have_posts()) : the_post(); ?>
        <article class="max-w-7xl mx-auto px-6 py-20 lg:py-24 space-y-20">
            <section class="grid lg:grid-cols-[1.1fr_0.9fr] gap-12 items-start">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595] text-[10px] font-bold uppercase tracking-widest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E29595]"></span>
                        Contenidos web en León
                    </div>
                    <div class="space-y-5 max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">Redacción de contenidos web y artículos de blog en León</h1>
                        <p class="text-xl text-slate-400 leading-relaxed">Redacto páginas de servicio, landings y artículos de blog en León. Trabajo los textos para que sean claros, estructurados y estén listos para WordPress.</p>
                        <p class="text-lg text-slate-300 leading-relaxed">Parto de tus objetivos, tu forma de trabajar y la información real de tu negocio para construir contenidos útiles, comprensibles y coherentes con tu web.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=contenidos-web')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold hover:brightness-110">Solicitar presupuesto</a>
                </div>
                <aside class="rounded-[2rem] border border-white/10 bg-[#1F2937]/50 p-6 md:p-8 shadow-2xl space-y-5">
                    <h2 class="text-2xl font-bold text-white">Textos pensados para publicar</h2>
                    <p class="text-slate-400 leading-relaxed">Me ocupo de ordenar la información y convertirla en páginas y artículos que puedas revisar antes de publicarlos.</p>
                    <ul class="space-y-3 text-slate-300">
                        <li>• Requisitos y objetivos del contenido</li>
                        <li>• Arquitectura H1–H3 y llamadas a la acción</li>
                        <li>• Redacción y una ronda de revisión</li>
                        <li>• Entrega en documento o borrador WordPress</li>
                    </ul>
                </aside>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Qué puedo redactar</p><h2 class="text-3xl md:text-4xl font-bold text-white">Contenidos para explicar y presentar tu negocio</h2><p class="text-slate-400 leading-relaxed">Adapto el formato al objetivo de cada pieza y dejo claro qué información necesito para trabajarla.</p></div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Páginas de servicio</h3><p class="text-sm text-slate-400">Textos para explicar qué haces, para quién y cuál es el siguiente paso.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Landings comerciales</h3><p class="text-sm text-slate-400">Una estructura enfocada en una oferta concreta, con contexto y CTA.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Artículos de blog</h3><p class="text-sm text-slate-400">Artículos informativos con una organización fácil de leer y revisar.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Webs pequeñas</h3><p class="text-sm text-slate-400">Contenido coordinado para sitios estándar de cuatro o cinco páginas.</p></div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Cómo trabajo</p><h2 class="text-3xl md:text-4xl font-bold text-white">Un proceso claro antes de entregar el texto</h2></div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">01</span><h3 class="text-xl font-bold text-white mt-2">Tomo requisitos</h3><p class="text-slate-400 mt-2">Recojo el objetivo, el público, los servicios, el tono y la información que debe aparecer.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">02</span><h3 class="text-xl font-bold text-white mt-2">Investigo lo básico</h3><p class="text-slate-400 mt-2">Reviso la información disponible y el contexto necesario para no redactar a ciegas.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">03</span><h3 class="text-xl font-bold text-white mt-2">Ordeno y redacto</h3><p class="text-slate-400 mt-2">Defino la arquitectura H1–H3, desarrollo el contenido y sitúo el CTA dentro del recorrido.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">04</span><h3 class="text-xl font-bold text-white mt-2">Reviso contigo</h3><p class="text-slate-400 mt-2">Incluyo una ronda de revisión para ajustar datos, matices y prioridades antes de entregar.</p></div>
                </div>
                <p class="text-slate-400 leading-relaxed max-w-4xl">Cada texto pasa por un proceso de redacción, adaptación al negocio, estructuración y revisión para mantener claridad y un criterio profesional.</p>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Experiencia editorial aplicada</p><p class="text-slate-400 leading-relaxed">Además de desarrollar y mantener proyectos WordPress, gestiono medios propios como <a href="https://lasrecetasdeemma.es/" target="_blank" rel="noopener noreferrer" class="text-[#E29595] font-semibold">Las Recetas de Emma</a>, donde trabajo la planificación, redacción, maquetación, actualización y publicación de contenidos.</p><p class="text-slate-400 leading-relaxed">También cuento con experiencia real redactando contenidos por encargo para proyectos de terceros, adaptando la estructura, el tono y el nivel de detalle a cada temática y medio.</p><p class="text-slate-400 leading-relaxed">Esta combinación me permite abordar tanto los textos comerciales de una página web como artículos informativos preparados para su revisión y publicación en WordPress.</p></div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Precios orientativos</p><h2 class="text-3xl md:text-4xl font-bold text-white">Un punto de partida claro para cada formato</h2><p class="text-slate-400 leading-relaxed">El presupuesto final depende del alcance acordado y de la información disponible.</p></div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Artículo de blog</h3><p class="text-[#E29595] font-bold"><?php echo esc_html(empc_price_label($blog_price)); ?> hasta 1.000 palabras</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Página de servicio</h3><p class="text-[#E29595] font-bold"><?php echo esc_html(empc_price_label($service_price)); ?></p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Landing comercial</h3><p class="text-[#E29595] font-bold"><?php echo esc_html(empc_price_label($landing_price)); ?></p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Sitio web estándar</h3><p class="text-[#E29595] font-bold"><?php echo esc_html(empc_price_label($website_price)); ?> de 4–5 páginas</p></div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Qué incluye y qué se presupuesta aparte</p><h2 class="text-3xl md:text-4xl font-bold text-white">El alcance queda definido antes de empezar</h2></div>
                <div class="grid lg:grid-cols-2 gap-6">
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-xl font-bold text-white mb-3">Incluido en el alcance acordado</h3><ul class="space-y-2 text-slate-400"><li>• Toma de requisitos e investigación básica</li><li>• Arquitectura de contenidos H1–H3</li><li>• Redacción, CTA y una ronda de revisión</li><li>• Entrega en documento o borrador WordPress</li></ul></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-xl font-bold text-white mb-3">Presupuesto adicional</h3><ul class="space-y-2 text-slate-400"><li>• Investigación avanzada o entrevistas</li><li>• Material gráfico y estrategia SEO avanzada</li><li>• Revisiones adicionales o publicación recurrente</li><li>• Contenidos regulados o especializados</li></ul></div>
                </div>
                <p class="text-slate-400 leading-relaxed">La carga o publicación en WordPress es opcional: solo la realizo si me facilitas acceso y la has contratado expresamente.</p>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Trabajo coordinado</p><h2 class="text-3xl md:text-4xl font-bold text-white">El contenido debe encajar con la web</h2><p class="text-slate-400 leading-relaxed">Si la web necesita una estructura nueva, puedo coordinar el contenido con el <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>">diseño web</a>. El <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>">mantenimiento WordPress</a> supervisa copias de seguridad, actualizaciones y tareas destinadas a mantener la estabilidad técnica de tu web. Si necesitas ordenar decisiones antes de escribir, consulta la <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/consultor-wordpress/')); ?>">consultoría WordPress</a>.</p></div>
            </section>

            <section id="faq" class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Preguntas frecuentes</p><h2 class="text-3xl md:text-4xl font-bold text-white">Dudas habituales sobre la redacción</h2></div>
                <div class="space-y-4 max-w-4xl">
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-white font-bold mb-2">¿Con qué frecuencia conviene publicar?</h3><p class="text-slate-400">No existe una frecuencia universal. Uno o dos artículos mensuales pueden ser una cadencia sostenible para pequeños negocios, pero debe adaptarse a los objetivos, recursos y demanda real de cada proyecto.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-white font-bold mb-2">¿Tengo que facilitar toda la información?</h3><p class="text-slate-400">Necesito una base suficiente para entender el negocio, aunque puedo ayudarte a ordenar lo que ya tienes y señalar la información que falte.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><h3 class="text-white font-bold mb-2">¿Podéis publicar el texto en mi web?</h3><p class="text-slate-400">Puedo entregarlo como documento o borrador WordPress. La publicación es opcional y requiere acceso facilitado y contratación expresa de esa tarea.</p></div>
                </div>
            </section>

            <section class="rounded-3xl border border-[#E29595]/20 bg-[#E29595]/5 p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6"><div class="space-y-3 max-w-2xl"><h2 class="text-3xl font-bold text-white">Cuéntame qué contenido necesitas</h2><p class="text-slate-400">Indica el tipo de página o artículo, el objetivo y la información disponible.</p></div><a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=contenidos-web')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold">Solicitar presupuesto</a></section>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
