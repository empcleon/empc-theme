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
                <span class="text-[10px] font-bold uppercase tracking-widest">Ingeniería de autoridad</span>
            </div>

            <div class="space-y-4 max-w-2xl">
                <h1 class="text-5xl md:text-7xl font-serif text-white leading-tight">
                    Ingeniería Web <br>
                    <span class="text-[#E29595] italic">de Alto Impacto</span>
                </h1>
                <p class="text-xl text-slate-400 max-w-xl leading-relaxed font-light">
                    Transformamos negocios de León en infraestructuras tecnológicas soberanas.
                    <span class="text-[#E29595] font-medium"> Sin bloatware. Sin excusas.</span>
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
                    Arquitectura pensada para convertir
                </p>
            </div>
        </div>
    </section>

    <section id="metodo" class="py-24 border-t border-white/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div class="aspect-[4/5] bg-[#1F2937]/50 rounded-[3rem] border border-white/10 overflow-hidden relative">
                <div class="absolute inset-0 bg-[#E29595]/10 mix-blend-overlay"></div>
                <div class="w-full h-full bg-gradient-to-br from-[#121826] via-[#1F2937] to-[#E29595]/20 flex items-center justify-center p-10 text-center">
                    <p class="text-slate-400 font-mono text-sm max-w-xs">
                        [Foto profesional / imagen corporativa opcional]
                    </p>
                </div>
            </div>

            <div class="space-y-8">
                <h2 class="text-4xl font-serif text-white">Más que código: <span class="text-[#E29595]">estrategia</span></h2>
                <p class="text-slate-400 text-lg leading-relaxed">
                    Soy Emma, arquitecta de software y CEO. No vendo horas de programación: diseño soluciones de negocio basadas en tecnología robusta.
                    Mi enfoque combina rapidez de prototipado con una base técnica sólida.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 bg-[#E29595]/10 border border-[#E29595]/20 rounded-3xl hover:bg-[#E29595]/20 transition-colors duration-300">
                        <h3 class="text-white font-bold mb-2">CTO-as-a-Service</h3>
                        <p class="text-sm text-slate-400">Dirección técnica interina para negocios que necesitan criterio y ejecución.</p>
                    </div>
                    <div class="p-6 bg-[#1F2937]/50 border border-white/5 rounded-3xl hover:border-white/20 transition-colors duration-300">
                        <h3 class="text-white font-bold mb-2">Stack moderno</h3>
                        <p class="text-sm text-slate-400">WordPress, React e integraciones pensadas para mantener el control.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="servicios" class="max-w-7xl mx-auto px-6 py-24 border-t border-white/5">
        <div class="mb-16">
            <h2 class="text-4xl font-serif text-white mb-4">Servicios de <span class="text-[#E29595]">ingeniería</span></h2>
            <p class="max-w-2xl text-slate-400 italic">Arquitectura modular para el crecimiento digital.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <article class="md:col-span-2 bg-[#1F2937]/30 border border-white/5 rounded-[2.5rem] p-10 hover:border-[#E29595]/30 transition-all duration-300 relative overflow-hidden">
                <div class="relative z-10 space-y-4">
                    <h3 class="text-3xl font-serif text-white">Desarrollo Full-Stack <span class="text-[#E29595]">WP + React</span></h3>
                    <p class="text-slate-400 max-w-md leading-relaxed">
                        Mantén WordPress como base editorial y añade componentes React solo donde aportan valor real: calculadoras, formularios y demos interactivas.
                    </p>
                </div>
            </article>

            <article class="bg-[#E29595] rounded-[2.5rem] p-10 shadow-[0_20px_40px_-15px_rgba(226,149,149,0.3)] flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-[#121826] leading-tight">Auditoría WPO</h3>
                    <p class="text-sm text-[#121826]/80 mt-4">Optimización de rendimiento y orden técnico.</p>
                </div>
            </article>

            <article class="bg-[#1F2937]/30 border border-white/5 rounded-[2.5rem] p-8 hover:border-[#E29595]/30 transition-all duration-300">
                <h3 class="text-2xl font-serif text-white mb-4">Arquitectura de datos</h3>
                <p class="text-sm text-slate-400 leading-relaxed">Diseño de bases y flujos para negocio, integraciones y automatización.</p>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <article class="bg-slate-800 rounded-2xl p-8 border border-slate-700 shadow-2xl">
                    <h3 class="text-white text-2xl font-bold mb-3">Calculadoras y configuradores</h3>
                    <p class="text-slate-300 leading-relaxed">
                        La lógica compleja se mantiene en React para que el usuario tenga respuesta inmediata sin recargas.
                    </p>
                </article>
                <article class="bg-slate-800 rounded-2xl p-8 border border-slate-700 shadow-2xl">
                    <h3 class="text-white text-2xl font-bold mb-3">Flujos de contacto</h3>
                    <p class="text-slate-300 leading-relaxed">
                        Los formularios siguen siendo interactivos, con mensajes de error accesibles y protección antispam ya aplicada.
                    </p>
                </article>
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
