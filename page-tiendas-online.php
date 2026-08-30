<?php
/**
 * Template Name: Tiendas Online León
 * Description: Landing SSR para tiendas online con WooCommerce.
 */

get_header();
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <?php while (have_posts()) : the_post(); ?>
        <article class="max-w-7xl mx-auto px-6 py-20 lg:py-24 space-y-16">
            <section class="grid lg:grid-cols-[1.1fr_0.9fr] gap-12 items-start">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-[10px] font-bold uppercase tracking-widest">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
                        <span>Tiendas online en León</span>
                    </div>
                    <div class="space-y-4 max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">Diseño de tiendas online en León con WooCommerce</h1>
                        <h2 class="text-xl md:text-2xl text-slate-400 leading-relaxed">Una tienda online propia para organizar productos, pedidos y pagos con claridad.</h2>
                        <p class="text-lg text-slate-300 leading-relaxed max-w-2xl">Creo tiendas con WooCommerce para empresas y autónomos que necesitan vender por internet, renovar una instalación existente o dejar de depender de una solución que ya no encaja con su negocio.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=tienda-online')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-emerald-400 text-[#121826] font-bold hover:brightness-110">Solicitar una valoración</a>
                        <a href="#incluye" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl border border-white/10 text-white hover:border-emerald-300/50 hover:text-emerald-300">Ver qué incluye</a>
                    </div>
                </div>
                <aside class="rounded-[2rem] border border-white/10 bg-[#1F2937]/50 p-6 md:p-8 shadow-2xl space-y-5">
                    <h2 class="text-2xl font-bold text-white">Para quién es</h2>
                    <p class="text-slate-400 leading-relaxed">Para negocios con productos o servicios que quieren presentar un catálogo, recibir pedidos y gestionar su venta online con una base propia.</p>
                    <ul class="space-y-3 text-slate-300">
                        <li>• Comercios y marcas que empiezan a vender online</li>
                        <li>• Empresas que necesitan renovar su tienda</li>
                        <li>• Autónomos con catálogo y venta directa</li>
                        <li>• Proyectos que necesitan WooCommerce y WordPress</li>
                    </ul>
                </aside>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">La decisión</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Qué problema puede resolver una tienda propia</h2>
                    <p class="text-slate-400 leading-relaxed">Una tienda online permite centralizar catálogo, pedidos y cobros en un espacio que el negocio puede administrar. No elimina la necesidad de trabajo comercial, logística o atención al cliente, pero ayuda a ordenar el proceso de venta.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Catálogo entendible</h3><p class="text-sm text-slate-400 leading-relaxed">Productos organizados por categorías, fichas con información útil y variantes cuando el artículo las necesita.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Compra ordenada</h3><p class="text-sm text-slate-400 leading-relaxed">Carrito y proceso de compra preparados según los datos, pagos y condiciones que defina el proyecto.</p></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Gestión propia</h3><p class="text-sm text-slate-400 leading-relaxed">WooCommerce permite administrar productos y pedidos desde WordPress, con formación básica sobre lo acordado.</p></div>
                </div>
            </section>

            <section id="incluye" class="space-y-6">
                <div class="max-w-3xl space-y-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">Alcance</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Qué puede incluir el servicio</h2>
                    <p class="text-slate-400 leading-relaxed">El alcance se concreta antes de empezar. Estas son áreas habituales de una implementación WooCommerce; cada proyecto se presupuesta según sus necesidades.</p>
                </div>
                <div class="grid lg:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3"><h3 class="text-xl font-bold text-white">Catálogo y productos</h3><ul class="space-y-2 text-sm text-slate-300"><li>• Estructura de categorías y atributos</li><li>• Productos simples y variables</li><li>• Variantes, precios, imágenes y stock según información disponible</li><li>• Carga inicial acordada y revisión de fichas</li></ul></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3"><h3 class="text-xl font-bold text-white">Carrito y pedidos</h3><ul class="space-y-2 text-sm text-slate-300"><li>• Carrito y proceso de compra</li><li>• Estados de pedido y correos básicos de WooCommerce</li><li>• Datos de facturación y entrega según el negocio</li><li>• Gestión básica para el cliente</li></ul></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3"><h3 class="text-xl font-bold text-white">Pagos y envíos</h3><ul class="space-y-2 text-sm text-slate-300"><li>• Configuración de métodos de pago disponibles</li><li>• Reglas de envío que el cliente pueda definir</li><li>• Pruebas del flujo de compra</li><li>• Integraciones externas solo si se presupuesta su configuración</li></ul></div>
                    <div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-3"><h3 class="text-xl font-bold text-white">Base técnica</h3><ul class="space-y-2 text-sm text-slate-300"><li>• Diseño adaptable a móvil</li><li>• Estructura técnica y contenidos preparados para SEO básico</li><li>• Revisión de rendimiento y seguridad dentro del alcance</li><li>• Explicación de la gestión acordada</li></ul></div>
                </div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">Lo que necesitamos definir</p><h2 class="text-3xl md:text-4xl font-bold text-white">Productos, pagos y logística no se improvisan</h2><p class="text-slate-400 leading-relaxed">Para preparar una valoración útil necesito conocer el catálogo, las variantes, los impuestos aplicables, los destinos, las formas de pago y quién se ocupará de preparar y entregar los pedidos.</p></div>
                <div class="grid md:grid-cols-2 gap-4"><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Información del negocio</h3><p class="text-sm text-slate-400 leading-relaxed">El cliente debe aportar textos, imágenes, precios, datos fiscales y condiciones comerciales que quiera publicar. La redacción, fotografía, traducción o carga masiva se valoran aparte si hacen falta.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Terceros y obligaciones</h3><p class="text-sm text-slate-400 leading-relaxed">Pasarelas, transportistas, licencias, fiscalidad, asesoramiento legal y logística dependen de proveedores o decisiones del negocio. La integración técnica se concreta por separado.</p></div></div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">Proceso</p><h2 class="text-3xl md:text-4xl font-bold text-white">Cómo se organiza el proyecto</h2></div>
                <div class="grid md:grid-cols-2 gap-4"><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-emerald-300 text-xs font-bold">01</span><h3 class="text-xl font-bold text-white mt-2">Valoración inicial</h3><p class="text-slate-400 mt-2">Reviso el punto de partida, el catálogo, las funcionalidades y las dependencias externas.</p></div><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-emerald-300 text-xs font-bold">02</span><h3 class="text-xl font-bold text-white mt-2">Alcance y presupuesto</h3><p class="text-slate-400 mt-2">Definimos qué se incluye, qué debe aportar el cliente y qué tareas quedan fuera.</p></div><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-emerald-300 text-xs font-bold">03</span><h3 class="text-xl font-bold text-white mt-2">Construcción y pruebas</h3><p class="text-slate-400 mt-2">Configuro WooCommerce, preparo las plantillas acordadas y pruebo el recorrido de compra.</p></div><div class="rounded-2xl border border-white/10 bg-slate-900/60 p-6"><span class="text-emerald-300 text-xs font-bold">04</span><h3 class="text-xl font-bold text-white mt-2">Entrega y siguiente paso</h3><p class="text-slate-400 mt-2">Explico la gestión pactada y, si necesitas continuidad, podemos valorar mantenimiento técnico posterior.</p></div></div>
            </section>

            <section class="space-y-6">
                <div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">Diferencias</p><h2 class="text-3xl md:text-4xl font-bold text-white">Tienda online, web corporativa o marketplace</h2></div>
                <div class="grid md:grid-cols-3 gap-4"><div class="rounded-2xl border border-emerald-300/20 bg-emerald-400/5 p-5"><h3 class="text-lg font-bold text-white mb-2">Tienda online</h3><p class="text-sm text-slate-400 leading-relaxed">Catálogo, carrito, pedidos, pagos y envíos con una solución de comercio electrónico.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Web corporativa</h3><p class="text-sm text-slate-400 leading-relaxed">Presenta servicios y facilita contactos, pero no necesita el flujo completo de una compra online. Consulta el <a class="text-emerald-300 font-semibold" href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>">diseño web</a>.</p></div><div class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><h3 class="text-lg font-bold text-white mb-2">Marketplace</h3><p class="text-sm text-slate-400 leading-relaxed">Aporta alcance y reglas propias, pero dependes de sus condiciones. Una tienda propia ofrece otro nivel de control y responsabilidad.</p></div></div>
            </section>

            <section class="space-y-6"><div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">Después del lanzamiento</p><h2 class="text-3xl md:text-4xl font-bold text-white">WooCommerce necesita mantenimiento</h2><p class="text-slate-400 leading-relaxed">WordPress, WooCommerce, plugins, pagos y temas requieren revisiones. Si quieres delegar actualizaciones, copias, seguridad y soporte técnico recurrente, consulta el servicio de <a class="text-emerald-300 font-semibold" href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>">mantenimiento WordPress</a>.</p></div></section>

            <section id="faq" class="space-y-6"><div class="max-w-3xl space-y-3"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">Preguntas frecuentes</p><h2 class="text-3xl md:text-4xl font-bold text-white">Preguntas sobre una tienda WooCommerce</h2></div><div class="space-y-3"><details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><summary class="cursor-pointer list-none text-white font-bold">¿Puedo empezar con pocos productos?</summary><p class="mt-3 text-sm text-slate-400 leading-relaxed">Sí. El catálogo inicial, las categorías y la posibilidad de ampliar productos se definen en el alcance del proyecto.</p></details><details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><summary class="cursor-pointer list-none text-white font-bold">¿Quién configura los pagos y envíos?</summary><p class="mt-3 text-sm text-slate-400 leading-relaxed">La configuración técnica puede formar parte del proyecto, pero las cuentas, contratos, tarifas y condiciones dependen del negocio y de cada proveedor.</p></details><details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><summary class="cursor-pointer list-none text-white font-bold">¿Se incluye la carga de productos?</summary><p class="mt-3 text-sm text-slate-400 leading-relaxed">La carga inicial se concreta antes de presupuestar. Una carga masiva, la redacción o la creación de fotografías pueden requerir un alcance adicional.</p></details><details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><summary class="cursor-pointer list-none text-white font-bold">¿La tienda queda lista para vender?</summary><p class="mt-3 text-sm text-slate-400 leading-relaxed">La entrega depende de que estén disponibles productos, precios, textos, medios de pago, reglas de envío y obligaciones legales. El presupuesto especifica qué se configura y qué debe completar el cliente.</p></details><details class="rounded-2xl border border-white/10 bg-[#1F2937]/50 p-5"><summary class="cursor-pointer list-none text-white font-bold">¿Qué ocurre después?</summary><p class="mt-3 text-sm text-slate-400 leading-relaxed">Puedes gestionar la tienda con la formación acordada o solicitar mantenimiento técnico posterior como servicio independiente.</p></details></div></section>

            <section class="rounded-[2rem] border border-emerald-300/20 bg-emerald-400/5 p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6"><div class="space-y-3 max-w-2xl"><p class="text-[11px] font-bold uppercase tracking-[0.25em] text-emerald-300">Siguiente paso</p><h2 class="text-3xl md:text-4xl font-bold text-white">Cuéntame qué quieres vender</h2><p class="text-slate-400 leading-relaxed">Indica el tipo de productos, el número aproximado de referencias y lo que necesitas mejorar. Prepararé la siguiente conversación con el alcance real del proyecto.</p></div><a href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=tienda-online')); ?>" class="inline-flex items-center justify-center min-h-11 px-6 py-3 rounded-xl bg-emerald-400 text-[#121826] font-bold hover:brightness-110">Solicitar una valoración</a></section>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
