<?php
/**
 * Front Page Template
 * HTML inicial servido por WordPress con islas React para la interacción
 */
get_header();
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <section id="home" class="max-w-7xl mx-auto px-6 pt-24 pb-24 grid lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#E29595] animate-pulse"></span>
                <span class="text-[10px] font-bold uppercase tracking-widest">Desarrollo web y soporte técnico local</span>
            </div>

            <div class="space-y-4 max-w-2xl">
                <h1 class="text-5xl md:text-7xl font-serif text-white leading-tight">
                    Desarrollo web WordPress y <br>
                    <span class="text-[#E29595] italic">mantenimiento técnico en León</span>
                </h1>
                <p class="text-xl text-slate-400 max-w-xl leading-relaxed font-light">
                    Webs claras, tiendas online y soporte técnico para empresas y autónomos de León.
                    <span class="text-[#E29595] font-medium"> Trato directo y sin jerga innecesaria.</span>
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-2">
                <a href="<?php echo esc_url(home_url('/contacta-conmigo/')); ?>" class="px-10 py-4 bg-[#E29595] text-[#121826] font-bold rounded-2xl hover:scale-105 transition-all shadow-[0_20px_40px_-10px_rgba(226,149,149,0.4)] flex items-center justify-center gap-2 uppercase tracking-widest text-sm">
                    Iniciar Proyecto
                </a>
                <a href="#servicios" class="px-10 py-4 bg-white/5 text-white font-bold rounded-2xl border border-white/10 hover:bg-white/10 transition-all flex items-center justify-center gap-2 backdrop-blur-xl uppercase tracking-widest text-sm">
                    Ver Servicios
                </a>
            </div>
        </div>

        <div class="relative bg-[#1F2937]/50 border border-white/10 rounded-[2.5rem] p-8 backdrop-blur-2xl shadow-2xl min-h-[420px] flex items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-tr from-[#E29595]/5 to-transparent rounded-[2.5rem] pointer-events-none"></div>
            <div class="relative z-10 text-center space-y-4 max-w-sm">
                <p class="text-slate-500 font-mono text-sm">EMPC · WordPress + React</p>
                <p class="text-slate-300 text-lg leading-relaxed">
                    Diseño web, mantenimiento y automatización con un enfoque técnico y directo.
                </p>
                <p class="text-xs text-slate-500 uppercase tracking-[0.2em]">
                    Soluciones web pensadas para tu negocio
                </p>
            </div>
        </div>
    </section>

    <section id="metodo" class="py-24 bg-slate-900 border-t border-white/5">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-semibold uppercase mb-4">
                    Estrategia de Implementación
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Una base técnica clara, <br>
                    <span class="text-slate-300">fácil de mantener.</span>
                </h2>
                <p class="text-slate-300 max-w-2xl mx-auto leading-relaxed">
                    Ajustamos la base técnica al proyecto y al alojamiento disponible, con una estructura clara y fácil de mantener.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article class="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl text-center">
                    <div class="w-16 h-16 bg-slate-700 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl text-blue-400">01</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">1. WordPress</h3>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        WordPress permite gestionar el contenido y mantener una base clara para el proyecto.
                    </p>
                    <span class="inline-block mt-5 bg-blue-600 text-[10px] font-bold px-2 py-1 rounded text-white">PHP</span>
                </article>

                <article class="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl text-center">
                    <div class="w-16 h-16 bg-slate-700 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl text-purple-400">02</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">2. Integraciones</h3>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Cuando hace falta, conectamos los datos y servicios necesarios para que cada parte cumpla su función.
                    </p>
                    <a href="<?php echo esc_url(home_url('/consultor-wordpress/')); ?>" class="inline-flex min-h-11 items-center justify-center mt-5 rounded-lg border border-purple-400/60 px-4 py-2 text-sm font-bold text-purple-200 underline decoration-purple-300 underline-offset-4 transition hover:bg-purple-500/10 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-300">Analizar una integración</a>
                    <span class="inline-block mt-5 bg-purple-600 text-[10px] font-bold px-2 py-1 rounded text-white">JSON</span>
                </article>

                <article class="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl text-center">
                    <div class="w-16 h-16 bg-slate-700 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl text-rose-400">03</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">3. Interacción</h3>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Añadimos componentes interactivos solo cuando aportan utilidad real al usuario.
                    </p>
                    <span class="inline-block mt-5 bg-rose-500 text-[10px] font-bold px-2 py-1 rounded text-white">REACT</span>
                </article>
            </div>
        </div>
    </section>

    <section id="servicios" class="max-w-7xl mx-auto px-6 py-24 border-t border-white/5">
        <div class="mb-16">
            <h2 class="text-4xl font-serif text-white mb-4">Servicios web para <span class="text-[#E29595]">empresas y autónomos</span></h2>
            <p class="max-w-2xl text-slate-400 italic">Diseño, tiendas online, mantenimiento y consultoría con un enfoque directo.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <article class="md:col-span-2 bg-[#1F2937]/30 border border-white/5 rounded-[2.5rem] p-10 hover:border-[#E29595]/30 transition-all duration-300 relative overflow-hidden">
                <div class="relative z-10 space-y-4">
                    <h3 class="text-3xl font-serif text-white">Diseño y desarrollo <span class="text-[#E29595]">WordPress</span></h3>
                    <p class="text-slate-400 max-w-md leading-relaxed">
                        Páginas web claras, fáciles de administrar y adaptadas a las necesidades reales de tu negocio.
                    </p>
                    <a href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>" class="inline-flex mt-2 text-[#E29595] font-bold">Ver diseño web →</a>
                </div>
            </article>

            <article class="bg-[#E29595] rounded-[2.5rem] p-10 shadow-[0_20px_40px_-15px_rgba(226,149,149,0.3)] flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-[#121826] leading-tight">Mantenimiento WordPress</h3>
                    <p class="text-sm text-[#121826]/80 mt-4">Actualizaciones, copias y soporte técnico para webs ya publicadas.</p>
                    <a href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>" class="inline-flex mt-5 text-[#121826] font-bold">Ver mantenimiento →</a>
                </div>
            </article>

            <article class="bg-[#1F2937]/30 border border-white/5 rounded-[2.5rem] p-8 hover:border-[#E29595]/30 transition-all duration-300">
                <h3 class="text-2xl font-serif text-white mb-4">Consultoría WordPress</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Orientación para entender problemas y ordenar decisiones antes de implementar.</p>
                <a href="<?php echo esc_url(home_url('/consultor-wordpress/')); ?>" class="inline-flex mt-5 text-[#E29595] font-bold">Ver consultoría →</a>
            </article>

            <article class="bg-[#1F2937]/30 border border-white/5 rounded-[2.5rem] p-8 hover:border-[#E29595]/30 transition-all duration-300">
                <h3 class="text-2xl font-serif text-white mb-4">Tiendas online</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Catálogo, carrito y proceso de compra con WooCommerce según el alcance del proyecto.</p>
                <a href="<?php echo esc_url(home_url('/tiendas-online-leon/')); ?>" class="inline-flex mt-5 text-[#E29595] font-bold">Ver tiendas online →</a>
            </article>


        </div>
    </section>

    <section id="demos" class="py-24 bg-slate-900 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/10 text-rose-400 text-xs font-semibold tracking-wide uppercase mb-4">
                    Diferenciación técnica
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    React para lo interactivo, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-orange-400">HTML para lo esencial.</span>
                </h2>
                <p class="text-slate-300 max-w-2xl mx-auto text-lg leading-relaxed">
                    La portada sirve contenido útil directamente en HTML. Cuando hace falta interacción real, se monta una isla React encima sin duplicar la página.
                </p>
            </div>

            <div class="space-y-10">
                <section aria-labelledby="budget-calculator-heading" class="rounded-[2rem] border border-white/10 bg-[#1F2937]/35 p-3 md:p-6 shadow-2xl shadow-black/20">
                    <div class="flex flex-col gap-2 border-b border-white/10 px-3 pb-5 md:px-5">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-[10px] font-bold uppercase tracking-[0.22em] text-[#E29595]">Demo 01 · Presupuesto inteligente</span>
                            <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider text-slate-400">Configurador por pasos</span>
                        </div>
                        <h3 id="budget-calculator-heading" class="text-2xl font-serif text-white md:text-3xl">Define el alcance antes de hablar</h3>
                        <p class="max-w-2xl text-sm leading-relaxed text-slate-400">Selecciona el tipo de proyecto y las funcionalidades que realmente necesitas. Sin formularios interminables ni estimaciones opacas.</p>
                    </div>
                    <div class="pt-3 md:pt-5">
                        <div id="island-budget-calculator"></div>
                    </div>
                </section>

                <section aria-labelledby="pricing-calculator-heading" class="rounded-[2rem] border border-white/10 bg-[#1F2937]/35 p-3 md:p-6 shadow-2xl shadow-black/20">
                    <div class="flex flex-col gap-2 border-b border-white/10 px-3 pb-5 md:px-5">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-[10px] font-bold uppercase tracking-[0.22em] text-[#E29595]">Demo 02 · Inversión orientativa</span>
                            <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider text-slate-400">Calculadora en tiempo real</span>
                        </div>
                        <h3 id="pricing-calculator-heading" class="text-2xl font-serif text-white md:text-3xl">Compara opciones y extras</h3>
                        <p class="max-w-2xl text-sm leading-relaxed text-slate-400">Explora cómo cambian la inversión, los servicios adicionales y el plazo estimado según tu elección.</p>
                    </div>
                    <div class="pt-3 md:pt-5">
                        <div id="island-pricing-calculator"></div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section id="contacto" class="py-24 bg-[#121826] relative border-t border-white/5">
        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-heading font-bold text-white mb-4">Hablemos de tu proyecto</h2>
                <p class="text-slate-300 font-light">
                    Cuéntame qué necesitas y te responderé con una propuesta técnica directa.
                </p>
            </div>

            <div id="island-contact-form"></div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
