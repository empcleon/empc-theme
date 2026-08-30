<?php
/**
 * Landing SSR: Reparación WordPress en León.
 * El contenido comercial vive en esta plantilla para no depender de la BD.
 */
get_header();
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <?php while (have_posts()) : the_post(); ?>
        <article class="max-w-7xl mx-auto px-6 py-20 lg:py-24 space-y-20">
            <section class="grid lg:grid-cols-[1.1fr_0.9fr] gap-12 items-start">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595] text-[10px] font-bold uppercase tracking-widest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E29595]"></span>
                        Reparación WordPress en León
                    </div>
                    <div class="space-y-5 max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">Reparación de WordPress y WooCommerce en León</h1>
                        <p class="text-xl text-slate-400 leading-relaxed">Reviso incidencias concretas en WordPress y WooCommerce para localizar qué ocurre, definir el trabajo necesario y evitar cambios a ciegas.</p>
                        <p class="text-lg text-slate-300 leading-relaxed">Si tu web falla, primero hablamos del problema y del alcance. No accedo ni realizo trabajos sin tu consentimiento y sin presupuesto y aceptación previos.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=reparacion-wordpress')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold hover:brightness-110">Solicitar revisión de mi WordPress</a>
                </div>
                <aside class="rounded-[2rem] border border-white/10 bg-[#1F2937]/50 p-6 md:p-8 shadow-2xl space-y-5">
                    <h2 class="text-2xl font-bold text-white">Una incidencia concreta</h2>
                    <p class="text-slate-400 leading-relaxed">Este servicio está pensado para recuperar el funcionamiento de una instalación existente, no para sustituir el mantenimiento recurrente ni para crear una web nueva.</p>
                    <ul class="space-y-3 text-slate-300">
                        <li>• Revisión del problema y del contexto técnico</li>
                        <li>• Presupuesto previo antes de comenzar</li>
                        <li>• Copia recuperable cuando sea técnicamente posible</li>
                        <li>• Validación del resultado y límites explicados</li>
                    </ul>
                </aside>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Qué puedo revisar</p><h2 class="text-3xl md:text-4xl font-bold text-white">Fallos habituales en WordPress y WooCommerce</h2><p class="text-slate-400 leading-relaxed">Cada caso necesita comprobarse antes de decidir la intervención. Estos son ejemplos de incidencias que puedo valorar.</p></div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Errores críticos</h3><p class="text-sm text-slate-400">Pantalla blanca, errores 500, mensajes inesperados o una web que deja de cargar.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Actualizaciones</h3><p class="text-sm text-slate-400">Fallos posteriores a actualizar WordPress, plugins, temas o WooCommerce.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Plugins y temas</h3><p class="text-sm text-slate-400">Conflictos, funciones que desaparecen o cambios que rompen una parte concreta.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Formularios y envíos</h3><p class="text-sm text-slate-400">Formularios que no envían, errores de validación o avisos que no llegan.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Tienda y checkout</h3><p class="text-sm text-slate-400">Carrito, checkout, pedidos, pagos o pasarelas que no funcionan como deberían.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Seguridad y recuperación</h3><p class="text-sm text-slate-400">Lentitud anormal, malware, redirecciones, migraciones incompletas o recuperación tras averías.</p></div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Cómo se trabaja</p><h2 class="text-3xl md:text-4xl font-bold text-white">Revisión, presupuesto, reparación y validación</h2></div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">01</span><h3 class="text-xl font-bold text-white mt-2">Cuéntame el problema</h3><p class="text-slate-400 mt-2">Indica qué ha ocurrido, cuándo empezó y qué cambios se hicieron antes del fallo.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">02</span><h3 class="text-xl font-bold text-white mt-2">Valoración previa</h3><p class="text-slate-400 mt-2">Si para localizar la causa es necesario acceder a la instalación y realizar un diagnóstico técnico, te indicaré previamente su coste.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">03</span><h3 class="text-xl font-bold text-white mt-2">Presupuesto y aceptación</h3><p class="text-slate-400 mt-2">Tras revisar el caso, te indicaré si la reparación es viable, qué trabajo requiere y cuánto costaría antes de comenzar.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-[#E29595] text-xs font-bold">04</span><h3 class="text-xl font-bold text-white mt-2">Intervención y pruebas</h3><p class="text-slate-400 mt-2">Antes de modificar la instalación se obtiene o verifica una copia recuperable siempre que el estado técnico y el acceso al servidor lo permitan. Después se valida el alcance acordado.</p></div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">WooCommerce</p><h2 class="text-3xl md:text-4xl font-bold text-white">Cuidar una tienda durante la reparación</h2><p class="text-slate-400 leading-relaxed">Una tienda activa necesita revisar no solo el código, sino también pedidos, pagos y cambios recientes.</p></div>
                <div class="grid lg:grid-cols-2 gap-4"><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6"><h3 class="text-xl font-bold text-white mb-2">Pedidos posteriores a la copia</h3><p class="text-slate-400 leading-relaxed">Antes de restaurar una tienda se revisan los pedidos posteriores a la copia y se planifica cómo preservarlos cuando sea técnicamente posible.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6"><h3 class="text-xl font-bold text-white mb-2">Pagos y checkout</h3><p class="text-slate-400 leading-relaxed">Las pruebas se realizan dentro del alcance acordado. Las cuentas, credenciales y condiciones de las pasarelas siguen dependiendo del negocio y de sus proveedores.</p></div></div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Precio orientativo</p><h2 class="text-3xl md:text-4xl font-bold text-white">Trabajos técnicos desde 60 €/hora + IVA</h2><p class="text-slate-400 leading-relaxed">La tarifa se aplica cuando resulte procedente y no representa un precio cerrado para cualquier reparación. El coste final depende del diagnóstico, el alcance y las tareas necesarias.</p></div>
                <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6"><p class="text-slate-300 leading-relaxed">No todas las incidencias se resuelven del mismo modo. Tras revisar el caso, te indicaré si la reparación es viable, qué trabajo requiere y cuánto costaría antes de comenzar.</p></div>
            </section>

            <section class="space-y-6"><div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#E29595]">Límites honestos</p><h2 class="text-3xl md:text-4xl font-bold text-white">Qué queda fuera de esta página</h2><p class="text-slate-400 leading-relaxed">El resultado depende del estado de la instalación, los accesos, las copias, el proveedor de hosting, las licencias, los datos y los servicios externos. No se puede asegurar de antemano que una incidencia tenga solución ni que todos los datos puedan recuperarse.</p><p class="text-slate-400 leading-relaxed">Si buscas prevención y seguimiento recurrente, consulta el <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>">mantenimiento WordPress</a>. Para analizar opciones antes de actuar, consulta la <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/consultor-wordpress/')); ?>">consultoría WordPress</a>. Para crear o renovar una web, revisa el <a class="text-[#E29595] font-semibold" href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>">diseño web</a>.</p></div></section>

            <section class="rounded-3xl border border-[#E29595]/20 bg-[#E29595]/5 p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6"><div class="space-y-3 max-w-2xl"><h2 class="text-3xl font-bold text-white">Cuéntame qué problema tiene tu web</h2><p class="text-slate-400">Indica el error, los cambios recientes y lo que necesitas recuperar.</p></div><a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=reparacion-wordpress')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-[#E29595] text-[#121826] font-bold">Pedir valoración de la incidencia</a></section>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
