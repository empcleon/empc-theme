<?php
/**
 * Template Name: Mantenimiento WordPress León
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
                        <span>Mantenimiento continuo</span>
                    </div>

                    <div class="space-y-4 max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">Mantenimiento WordPress en León para empresas y autónomos</h1>
                        <h2 class="text-xl md:text-2xl text-slate-400 leading-relaxed">
                            Mantenimiento técnico recurrente para WordPress y WooCommerce.
                        </h2>
                        <p class="text-lg text-slate-300 leading-relaxed max-w-2xl">
                            Mantener una web no consiste solo en actualizar botones. Revisamos actualizaciones, copias, seguridad, rendimiento y posibles incidencias dentro del plan contratado, con un alcance que puedas entender antes de elegir.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=mantenimiento-wordpress')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold hover:brightness-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#E29595] focus-visible:ring-offset-[#121826]">
                            Pedir presupuesto
                        </a>
                        <a href="#planes-mantenimiento" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl border border-white/10 text-white hover:border-[#E29595]/40 hover:text-[#E29595] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#E29595] focus-visible:ring-offset-[#121826]">
                            Ver planes
                        </a>
                    </div>
                </div>

                <aside class="rounded-[2rem] border border-white/10 bg-[#1F2937]/50 p-6 md:p-8 shadow-2xl space-y-5">
                    <h2 class="text-2xl font-bold text-white">Qué puedes esperar</h2>
                    <p class="text-slate-400 leading-relaxed">
                        El servicio se centra en mantener la web actualizada, segura y supervisada, con tareas de soporte y restauración cuando el plan o el contexto lo permitan.
                    </p>
                    <ul class="space-y-3 text-slate-300">
                        <li>• Actualizaciones de WordPress, plugins y tema</li>
                        <li>• Copias de seguridad y restauración</li>
                        <li>• Seguridad, limpieza y tareas de mantenimiento</li>
                        <li>• Soporte técnico y revisión de incidencias</li>
                    </ul>
                </aside>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Beneficios</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Lo esencial, explicado por bloques</h2>
                    <p class="text-slate-400 leading-relaxed">
                        Las tarjetas siguientes resumen el contenido útil del servicio sin convertirlo en una lista interminable.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Seguridad</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Protección, comprobación de alertas y medidas para dificultar intrusiones.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Actualizaciones</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Mantenimiento de núcleo, plugins y tema con revisión de compatibilidades.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Copias de seguridad</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Backups automáticos y soporte si hay que restaurar un sitio.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Soporte</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Asesoramiento técnico y atención ante incidencias dentro del alcance contratado.</p>
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Qué incluye</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Prestaciones agrupadas por área</h2>
                </div>

                <div class="grid lg:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Actualizaciones y soporte</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Actualización de WordPress</li>
                            <li>• Actualización de plugins</li>
                            <li>• Actualización de plantilla</li>
                            <li>• Soporte técnico y asesoramiento</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Seguridad y emergencias</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Medidas de seguridad y antispam</li>
                            <li>• Limpieza básica de incidencias</li>
                            <li>• Revisión de incidencias dentro del alcance contratado</li>
                            <li>• Restauración de sitio si procede</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Copias y mantenimiento interno</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Copias de seguridad automáticas</li>
                            <li>• Limpieza de base de datos</li>
                            <li>• Eliminación de revisiones y spam</li>
                            <li>• Monitorización del estado de la web</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3">
                        <h3 class="text-xl font-bold text-white">Rendimiento e informes</h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li>• Optimización WPO</li>
                            <li>• Enlaces rotos y redirecciones</li>
                            <li>• Pequeñas actualizaciones</li>
                            <li>• Informe mensual en los planes que lo contemplan</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section id="planes-mantenimiento" class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Planes</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Tarjetas comparables con el contenido publicado</h2>
                    <p class="text-slate-400 leading-relaxed">
                        Los importes que aparecen abajo son los publicados en el contenido original. Los precios se muestran sin IVA porque así aparecen en la página heredada.
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="rounded-3xl border border-white/10 bg-[#1F2937]/60 p-6 space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">Plan Básico</p>
                            <h3 class="text-2xl font-bold text-white">39€ / mes</h3>
                            <p class="text-sm text-slate-400">Páginas Web</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Actualización WordPress, plugins y plantilla</li>
                            <li>• Back up automática y monitorización</li>
                            <li>• Solución de incidencias y limpieza de base de datos</li>
                            <li>• Ajustes técnicos menores e informe mensual</li>
                        </ul>
                        <p class="text-xs text-slate-400">Frecuencia: mensual</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=mantenimiento-wordpress')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">
                            Contratar
                        </a>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-[#1F2937]/60 p-6 space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">Plan Medio</p>
                            <h3 class="text-2xl font-bold text-white">55€ / mes</h3>
                            <p class="text-sm text-slate-400">Páginas Web</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Todo lo del plan básico</li>
                            <li>• Copia de seguridad automática</li>
                            <li>• Monitorización de estado web</li>
                            <li>• Revisión de incidencias y ajustes técnicos menores</li>
                        </ul>
                        <p class="text-xs text-slate-400">Frecuencia: mensual</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=mantenimiento-wordpress')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">
                            Contratar
                        </a>
                    </div>

                    <div class="rounded-3xl border border-[#E29595]/30 bg-[#1F2937]/70 p-6 space-y-4 ring-1 ring-[#E29595]/10">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">Plan Plus</p>
                            <h3 class="text-2xl font-bold text-white">100€ / mes</h3>
                            <p class="text-sm text-slate-400">Tienda online</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Todo lo del plan medio</li>
                            <li>• Copia de seguridad automática</li>
                            <li>• Mantenimiento técnico de tiendas WooCommerce e informe mensual</li>
                        </ul>
                        <p class="text-xs text-slate-400">Frecuencia: mensual</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=mantenimiento-wordpress')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">
                            Contratar
                        </a>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-[#1F2937]/60 p-6 space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E29595]">Plan Premium</p>
                            <h3 class="text-2xl font-bold text-white">199€ / mes</h3>
                            <p class="text-sm text-slate-400">Tienda online</p>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-300">
                            <li>• Todo lo del plan plus</li>
                            <li>• Copias de seguridad e intervención técnica según alcance</li>
                            <li>• Gestión para WooCommerce e informe mensual</li>
                        </ul>
                        <p class="text-xs text-slate-400">Frecuencia: mensual</p>
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=mantenimiento-wordpress')); ?>" class="inline-flex min-h-11 items-center justify-center px-4 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold text-sm">
                            Contratar
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl border border-amber-400/20 bg-amber-400/10 p-5 text-amber-100 text-sm leading-relaxed">
                    Nota: la fuente original mezcla una exclusión general de gestión de contenidos con referencias a actualización de contenido en los planes Plus y Premium. Para no presentar una promesa ambigua, la gestión editorial queda fuera de estos planes hasta confirmar su alcance; cualquier trabajo de contenidos se presupuesta aparte.
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Mantenimiento avanzado</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Prestaciones adicionales en superficie separada</h2>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Seguridad extra</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Plugins obsoletos, antispam, antivirus y medidas de protección más regulares.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Base de datos</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Limpieza, borrado de revisiones, eliminación de spam y reparación de incidencias.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Rendimiento</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Optimización WPO, enlaces rotos, redirecciones y mejoras de estabilidad.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Soporte ampliado</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Restauración del sitio, incidencias técnicas y añadidos de funcionalidades según presupuesto.</p>
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Qué no está incluido</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Exclusiones reales a dejar claras</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Contenido y redacción</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">La gestión de contenidos y cambios no aparece como incluida de forma general en la página original.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">SEO</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">El posicionamiento SEO no forma parte del mantenimiento estándar, salvo la optimización de velocidad del plan Premium.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Hosting y dominio</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">No están incluidos en el mantenimiento; se tratan aparte si hacen falta cambios o migraciones.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Licencias y migraciones</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Licencias de plugins/plantillas y cambios de hosting o dominio requieren presupuesto específico.</p>
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Servicios relacionados</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Cuando necesitas algo distinto</h2>
                    <p class="text-slate-400 leading-relaxed">El mantenimiento recurrente no sustituye a una web nueva ni a una sesión de asesoramiento puntual. Cada necesidad tiene su servicio y su alcance.</p>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Diseño web nuevo</h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">Si necesitas crear o reconstruir una web para presentar tu negocio y captar contactos, consulta el servicio de diseño web.</p>
                        <a class="text-[#E29595] font-bold" href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>">Ver diseño web en León</a>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <h3 class="text-lg font-bold text-white mb-2">Consultoría puntual</h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">Si buscas analizar una duda o recibir asesoramiento concreto sin contratar mantenimiento recurrente, consulta la página de consultoría WordPress.</p>
                        <a class="text-[#E29595] font-bold" href="<?php echo esc_url(home_url('/consultor-wordpress/')); ?>">Ver consultoría WordPress</a>
                    </div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Preguntas frecuentes</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Respuestas útiles sobre el mantenimiento</h2>
                </div>

                <div class="space-y-3">
                    <details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <summary class="cursor-pointer list-none text-white font-bold">¿Realizas mantenimiento de hosting?</summary>
                        <p class="mt-3 text-sm text-slate-400 leading-relaxed">No. El hosting se contrata por tu cuenta, aunque se puede ayudar con la gestión si hace falta.</p>
                    </details>
                    <details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <summary class="cursor-pointer list-none text-white font-bold">¿Es necesario contrato de permanencia?</summary>
                        <p class="mt-3 text-sm text-slate-400 leading-relaxed">La fuente heredada menciona periodicidades mensual, trimestral, semestral y anual, pero la duración y las condiciones concretas deben confirmarse en el presupuesto. No se presenta aquí una permanencia cerrada.</p>
                    </details>
                    <details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <summary class="cursor-pointer list-none text-white font-bold">¿Cuándo se paga el servicio?</summary>
                        <p class="mt-3 text-sm text-slate-400 leading-relaxed">Por adelantado, según los meses contratados.</p>
                    </details>
                    <details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5">
                        <summary class="cursor-pointer list-none text-white font-bold">¿Da igual dónde esté alojado el sitio?</summary>
                        <p class="mt-3 text-sm text-slate-400 leading-relaxed">El alojamiento se revisa como parte del contexto técnico. Si requiere una migración o una intervención específica, se presupuesta aparte.</p>
                    </details>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/10 bg-[#1F2937]/60 p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="space-y-3 max-w-2xl">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">CTA final</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Si quieres revisarlo contigo, escríbeme</h2>
                    <p class="text-slate-400 leading-relaxed">Cuéntame qué necesitas y revisamos el plan más adecuado para tu WordPress o WooCommerce.</p>
                </div>
                <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=mantenimiento-wordpress')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold hover:brightness-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#E29595] focus-visible:ring-offset-[#121826]">
                    Contactar ahora
                </a>
            </section>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
