<?php
/**
 * Template Name: Alquiler Página Web Empresas y Autónomos
 */

get_header();
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <?php while (have_posts()) : the_post(); ?>
        <article class="max-w-7xl mx-auto px-6 py-20 lg:py-24 space-y-16">
            <section class="grid lg:grid-cols-[1.1fr_0.9fr] gap-12 items-start">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595] text-[10px] font-bold uppercase tracking-widest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E29595]"></span>
                        <span>Modelo flexible</span>
                    </div>

                    <div class="space-y-4 max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">Alquiler de página web para empresas y autónomos</h1>
                        <h2 class="text-xl md:text-2xl text-slate-400 leading-relaxed">
                            Una forma de tener web o tienda online sin empezar con un gran desembolso inicial.
                        </h2>
                        <p class="text-lg text-slate-300 leading-relaxed max-w-2xl">
                            La propuesta original explica un modelo escalable para empezar rápido, añadir servicios cuando haga falta y mantener la web con una estructura clara.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=alquiler-web')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold hover:brightness-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#E29595] focus-visible:ring-offset-[#121826]">
                            Pedir propuesta
                        </a>
                        <a href="#planes-alquiler" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl border border-white/10 text-white hover:border-[#E29595]/40 hover:text-[#E29595] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#E29595] focus-visible:ring-offset-[#121826]">
                            Ver planes
                        </a>
                    </div>
                </div>

                <aside class="rounded-[2rem] border border-white/10 bg-[#1F2937]/50 p-6 md:p-8 shadow-2xl space-y-5">
                    <h2 class="text-2xl font-bold text-white">Cómo se plantea</h2>
                    <p class="text-slate-400 leading-relaxed">
                        El contenido describe un servicio pensado para arrancar con una inversión más contenida, adaptar el alcance al negocio y mantener una base web o tienda online funcional.
                    </p>
                    <ul class="space-y-3 text-slate-300">
                        <li>• Web corporativa, blog o tienda online</li>
                        <li>• Planes escalables según necesidades</li>
                        <li>• Mantenimiento, contenidos y soporte según el plan</li>
                        <li>• Enfoque para empresas, autónomos y pequeños comercios</li>
                    </ul>
                </aside>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Cómo funciona</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Proceso resumido en pasos</h2>
                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">1. Definir necesidades</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Se parte de si necesitas web corporativa, catálogo, contenidos o tienda online.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">2. Elegir un plan</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">La oferta original publica varios planes con cuotas distintas y un plan de consulta personalizada.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">3. Publicar y mantener</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">La web se entrega con mantenimiento, copias, soporte o contenidos según el plan seleccionado.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">4. Escalar cuando haga falta</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">El modelo se presenta como escalable para crecer sin rehacer la base completa.</p>
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Ventajas</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Lo más útil del modelo de alquiler</h2>
                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Menor inversión inicial</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">El propio contenido insiste en empezar sin un gran desembolso.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Mantenimiento incluido</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Los planes publicados integran actualizaciones, copias o soporte según la tarifa.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Escalabilidad</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">El texto original repite que se puede ajustar el alcance y crecer con mínimas inversiones.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Soporte y contenidos</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Algunos planes añaden publicaciones, soporte técnico y gestión de contenidos.</p>
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Qué incluye</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Prestaciones agrupadas por categorías</h2>
                </div>

                <div class="grid lg:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Base web</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Hosting y dominio incluidos en los planes publicados</li>
                            <li>• Cuentas de correo profesionales</li>
                            <li>• Diseño personalizado</li>
                            <li>• Desarrollo de 10, 15 o 20 páginas según plan</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Comunicación</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Formulario de contacto</li>
                            <li>• Blog o blog + newsletter</li>
                            <li>• Enlaces a redes sociales</li>
                            <li>• Localización y atención al cliente según el alcance acordado</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Comercio y catálogo</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Catálogo de productos o cesta</li>
                            <li>• TPV virtual en el plan de comercio</li>
                            <li>• Hasta 50 productos en el plan catalogado</li>
                            <li>• Pensado para tienda online o pequeño comercio</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Mantenimiento y soporte</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Actualizaciones de sistema</li>
                            <li>• Copias de seguridad</li>
                            <li>• Formación inicial</li>
                            <li>• Soporte técnico en los planes más completos</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section id="planes-alquiler" class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Planes</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Opciones de alquiler web</h2>
                    <p class="text-slate-400 leading-relaxed">
                        Estas opciones se preparan mediante una propuesta individual. La cuota, el alcance, la propiedad, el dominio, el hosting, el soporte y cualquier condición de permanencia se concretan antes de contratar.
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="rounded-3xl border border-white/10 bg-[#1F2937]/60 p-6 space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">EMPC&amp;SITE</p>
                            <h3 class="text-2xl font-bold text-white">Consultar propuesta</h3>
                            <p class="text-sm text-slate-400">Web corporativa</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Hosting y dominio incluidos</li>
                            <li>• 10 páginas, formulario, blog y redes</li>
                            <li>• 1 actualización de contenido mensual</li>
                            <li>• Copia de seguridad mensual y SEO: consultar propuesta</li>
                        </ul>
                        <p class="text-xs text-slate-400">Permanencia, propiedad, dominio, hosting, soporte y cuota inicial: consultar propuesta</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=alquiler-web')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">Contratar plan</a>
                    </div>

                    <div class="rounded-3xl border border-[#E29595]/30 bg-[#1F2937]/70 p-6 space-y-4 ring-1 ring-[#E29595]/10">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">EMPC&amp;CATALOG</p>
                            <h3 class="text-2xl font-bold text-white">Consultar propuesta</h3>
                            <p class="text-sm text-slate-400">Web con catálogo</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Hosting y dominio incluidos</li>
                            <li>• 10 páginas, blog + newsletter y redes</li>
                            <li>• Catálogo de productos hasta 50 unidades</li>
                            <li>• Backups quincenales, soporte y SEO: consultar propuesta</li>
                        </ul>
                        <p class="text-xs text-slate-400">Permanencia, propiedad, dominio, hosting, soporte y cuota inicial: consultar propuesta</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=alquiler-web')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">Contratar plan</a>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-[#1F2937]/60 p-6 space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">EMPC&amp;CONTENTS</p>
                            <h3 class="text-2xl font-bold text-white">Consultar propuesta</h3>
                            <p class="text-sm text-slate-400">Web y gestión de contenidos</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Hosting y dominio incluidos</li>
                            <li>• 15 páginas, blog + newsletter y redes</li>
                            <li>• 4 publicaciones de contenido al mes</li>
                            <li>• Copia de seguridad semanal y soporte técnico</li>
                        </ul>
                        <p class="text-xs text-slate-400">Alcance y condiciones: se concretan en la propuesta.</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=alquiler-web')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">Contratar plan</a>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-[#1F2937]/60 p-6 space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">EMPC&amp;COMMERCE</p>
                            <h3 class="text-2xl font-bold text-white">Consultar</h3>
                            <p class="text-sm text-slate-400">Tienda online</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Hosting y dominio incluidos</li>
                            <li>• 20 páginas, catálogo y cesta</li>
                            <li>• Conexión con TPV virtual</li>
                            <li>• 4 publicaciones al mes, backups 24h y soporte</li>
                        </ul>
                        <p class="text-xs text-slate-400">Alcance y condiciones: se concretan en la propuesta.</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=alquiler-web')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">Solicitar presupuesto</a>
                    </div>
                </div>


            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Comparación</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Resumen rápido por plan</h2>
                </div>

                <div class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-[1.3fr_repeat(4,minmax(0,1fr))] gap-3">
                        <div class="hidden md:block text-xs uppercase tracking-[0.2em] text-slate-500 px-2">Característica</div>
                        <div class="hidden md:block text-xs uppercase tracking-[0.2em] text-slate-500 px-2">SITE</div>
                        <div class="hidden md:block text-xs uppercase tracking-[0.2em] text-slate-500 px-2">CATALOG</div>
                        <div class="hidden md:block text-xs uppercase tracking-[0.2em] text-slate-500 px-2">CONTENTS</div>
                        <div class="hidden md:block text-xs uppercase tracking-[0.2em] text-slate-500 px-2">COMMERCE</div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-[1.3fr_repeat(4,minmax(0,1fr))] gap-3 items-stretch">
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-white font-medium">Páginas</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">10</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">10</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">15</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">20</div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-[1.3fr_repeat(4,minmax(0,1fr))] gap-3 items-stretch">
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-white font-medium">Contenido mensual</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">1</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">1</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">4</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">4</div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-[1.3fr_repeat(4,minmax(0,1fr))] gap-3 items-stretch">
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-white font-medium">Backups</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">Mensual</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">Quincenal</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">Semanal</div>
                        <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-4 text-slate-300">24h</div>
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Preguntas frecuentes</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Preguntas sobre la propuesta</h2>
                </div>

                <div class="space-y-3">
                    <details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <summary class="cursor-pointer list-none text-white font-bold">¿Incluye hosting y dominio?</summary>
                        <p class="mt-3 text-sm text-slate-400 leading-relaxed">Sí, aparecen como incluidos en los planes publicados.</p>
                    </details>

                    <details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <summary class="cursor-pointer list-none text-white font-bold">¿Se puede escalar el plan?</summary>
                        <p class="mt-3 text-sm text-slate-400 leading-relaxed">Sí, el texto insiste en un modelo escalable que puede crecer según necesidades.</p>
                    </details>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/10 bg-[#1F2937]/60 p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="space-y-3 max-w-2xl">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">CTA final</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Si quieres que lo ajustemos a tu negocio, escríbeme</h2>
                    <p class="text-slate-400 leading-relaxed">Te ayudo a revisar el plan más adecuado según el tipo de web, catálogo o tienda online que necesites.</p>
                </div>
                <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=alquiler-web')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold hover:brightness-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#E29595] focus-visible:ring-offset-[#121826]">
                    Contactar ahora
                </a>
            </section>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
